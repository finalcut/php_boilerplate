	var  formfields = new Object();
	var questionCounter = 0;

	// stolen from an answer by Jeff Atwood on Stackoverflow.
	Object.size = function(obj) {
	    var size = 0, key;
	    for (key in obj) {
	        if (obj.hasOwnProperty(key)) size++;
	    }
	    return size;
	};


	// proper case string prptotype (JScript 5.5+)
	String.prototype.toProperCase = function()
	{
	  return this.toLowerCase().replace(/^(.)|\s(.)/g, 
	      function($1) { return $1.toUpperCase(); });
	}


	function objkeys(obj)
	{
	    var keys = [];

	    for(var key in obj)
	    {
	        keys.push(key);
	    }

	    return keys.sort();
	}


	$(document).ready(function(){
		injectQuestionForm();


		$('.newquestion').click(injectQuestionForm);


		
		$('.cancelbtn').live('click',function(){
			// save button clicked
			var obj = $(this);
			var id = obj.attr('counter');


			var qData = formfields[id];

			
			if(qData == null){
				$('#' + id).remove();
			} else {
				$('#fn'+id).val(qData.title);
				$('#ht'+id).val(qData.help);
				// TODO: select the type...
			}
			

			if(Object.size(formfields) == 0)
				injectQuestionForm();
		});



		$('.savebtn').live('click', function(){
			var obj = $(this);
			var id = obj.attr('counter');
			var x = questionToJson($('#fn'+id).val(), $('#ht'+id).val(), $('#ft'+id + ' option:selected').val(), $('input[name="option' + id + '"][value!=""]'), $('#rq'+id).attr('checked') );
			formfields[id] = x;
			drawForm();
			return false;
		});


		$('.option').live('focus', function(){
			var obj = $(this);
			var siblings = $(this).parent().children("input");
			obj.removeAttr('disabled','');
			obj.removeClass('disabled');



			if(obj.attr('count') == siblings.length)
				injectOptionField(obj.attr('counter'));
		});

		
		$('.fieldtype').live('change',function(){
			var field = $(this);
			if(field.val().indexOf("input-") == -1){ // we have a multipile choice type field
				injectOptionField(field.attr('counter'));
			}
		});		
	});

	function getEmptyJsonQuestion(){
		return questionToJson("","","input-text", [], false);
	}

	function questionToJson(title, help, type, opts, required){
		title = title == null || title.length == 0 ? 'Placeholder' : title;
		help = help == null ? '' : help;
		required = required == null ? false : required;
		cleanTitle = cleanName(title);

		if(opts.length){
			var op = [];
			for(var o=0; o<opts.length; o++){
				var obj = $(opts[o]);
				op.push(obj.val());
			}
			opts = op;
		}


		return {"title":title,"cleanTitle":cleanTitle,"help":help,"type":type,"options":opts, "required":required};
		
	}


	function escapeQuestion(str){
		return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
		
	}

	function injectOptionField(id){
		var wrapper = $('#options'+id);
		var count = parseInt(wrapper.attr('options')) + 1;
		wrapper.attr('options',count);
		var html =  '';
			html += '<input type="text" class="text option" name="option'+id + '" value="" counter="' + id + '" count="' + count + '" /><br />';

			wrapper.find('.control-group .controls').append(html);
			wrapper.removeClass('hidden');
	}


	function injectQuestionForm(questionNumber){
		var id = ++questionCounter;
		questionNumber = isNaN(questionNumber) ? id : questionNumber++;
		var form = '';
			form += '	<fieldset id="' + id + '">';
			form += '		<div class="row">';
			form += '			<div class="control-group span6">';
			form += '				<label for="fn' + id + '">Field Name:</label>';
			form += '				<div class="controls">';
			form += '				<input type="text" name="fieldname1" id="fn' + id + '" counter="' + id + '" value="">';
			form += '				</div>';
			form += '			</div>';
			form += '			<div class="control-group span6">';
			form += ' 				<label for="ht' + id + '">Help Text</label>';
			form += '				<div class="controls">';
			form += ' 					<input type="text" name="help' + id + '" id="ht'+id+'" value="">';
			form += '				</div>';
			form += '			</div>';
			form += '	  	</div>';
			form += '		<div class="row">';
			form += '			<div class="control-group span6">';
			form += '				<label for="ft' + id + '">Field Type:</label>';
			form += '				<div class="controls">';
			form += '				<select name="fieldtype' + id + '" id="ft' + id + '" counter="' + id + '" class="fieldtype">';
			form += '					<option value="input-text">Input - Text</option>';
			form += '					<option value="input-password">Input - Password</option>';
			form += '					<option value="input-phone">Input - Phone</option>';
			form += '					<option value="input-email">Input - Email</option>';
			form += '					<option value="input-url">Input - URL</option>';
			form += '					<option value="input-money">Input - Money</option>';
			form += '					<option value="input-ssn">Input - Social Security #</option>';
			form += '					<option value="input-901">Input - 901 #</option>';
			form += '					<option value="checkbox">Checkbox(s)</option>';
			form += '					<option value="radio">Radio(s)</option>';
			form += '					<option value="single-item-select">Select Single Item</option>';
			form += '					<option value="multi-item-select">Select Multi Item</option>';
			form += '					<option value="input-textarea">Textarea</option>';
			form += '				</select>';
			form += '				</div>';
			form += '			</div>';
			form += '			<div class="control-group span6">';
			form += '				<label for="rq' + id + '">';
			form += '				Required';
			form += '				</label>';
			form += '				<div class="controls">';
			form += '				<input type="checkbox" name="required' + id + '" id="rq' + id + '" counter="' + id +'" class="requirebox">';
			form += '				</div>';
			form += '			</div>';
			form += '		</div>';
			form += '		<div class="row">';
			form += '			<div class="control-group span6">';
			form += '				<button counter="' + id + '" id="save1" name="save' + id + '" class="btn btn-success savebtn"><i class="icon-cog icon-white"></i> Generate</button>';
			//form += '				<button counter="' + id + '" id="copy1" name="copy' + id + '" class="btn btn-warning copybtn"><i class="icon-share icon-white"></i> Copy</button>';
			//form += '				<button counter="' + id + '" id="edit1" name="edit' + id + '" class="btn btn-info editbtn hidden"><i class="icon-edit icon-white"></i> Edit</button>';
			//form += '				<button counter="' + id + '" id="cancel1" name="cancel' + id + '" class="btn btn-danger cancelbtn"><i class="icon-remove-circle icon-white"></i> Cancel</button>';
			//form += '				<button counter="' + id + '" id="delete1" name="cancel' + id + '" class="btn btn-danger deletebtn hidden"><i class="icon-remove icon-white"></i> Delete</button>';
			form += '			</div>';
			form += '	  	</div>';
			form += '		<div class="row span6 hidden" id="options' + id + '" options="0">';
			form += '			<div class="control-group" id="cg-options' + id + '">';
			form += '			<div class="controls" id="cg-options-conrols' + id + '">';
			form += '			</div>';
			form += '			</div>';
			form += '		</div>';
			form += '	</fieldset>';
		$('#formbuilder').remove();
		$('#theform').append(form);
	}

	function drawForm(){
		var wrapper = $('#form_html');
		var output = "";

		var keys = objkeys(formfields);
		for(var i in keys){

			var q = formfields[keys[i]];
			q.basictype = q.type;
			q.clean =  keys[i] + cleanName(q.title);
			q.id = keys[i];

			switch(q.type){
				case "input-textarea":
					q.basictype = q.type.replace('input-','');
					output += drawWrappers(q, drawTextArea(q));
					break;
				case "input-text":
				case "input-money":
				case "input-email":
				case "input-url":
				case "input-phone":
				case "input-ssn":
				case "input-901":
				case "input-password":
					q.basictype = q.type.replace('input-','');
					console.log(q.basictype);
					output +=  drawWrappers(q, drawStandardInput(q));
					break;
				case "multi-item-select":
					q.basictype = "select";
					output += drawWrappers(q, drawSelect(q,true));
					break;
				case "single-item-select":
					q.basictype = "select";
					output += drawWrappers(q, drawSelect(q,false));
					break;
				case "radio":
					q.basictype = "radio";
					output += drawRadiosAndBoxes(q);
					break;
				case "checkbox":
					q.basictype = "checkbox";
					output +=  drawRadiosAndBoxes(q);
					break;
				default:
					break;
			}
		}
		output = escapeQuestion(output);
		wrapper.html(output);
	}

	function cleanName(name){
			var temp = name;
			temp = temp.replace(/[^a-zA-Z0-9]+/g,'');
			return temp;
	}


	function drawWrappers(q, ctrl) {
		var o = '';
		o += '<div class="control-group">\n';
		o += '\t<label for="txt' + q.clean + '">'+q.title+'</label>\n';
		o += '\t<div class="controls">\n';
		o += ctrl + '\n';
		if(q.help.length > 0){
			o+= '\t\t<p class="help-block">' + q.help + '</p>\n';
		}
		o += '\t</div>\n';
		o += '</div>\n';
		return o;
		
	}

	function drawRadiosAndBoxes(q){
		var o = '<div class="control-group">\n';
			o += '\t<label class="control-label" for="options' + q.basictype.toProperCase() + 'List">' + q.title + '</label>\n';
			o += '\t<div class="controls">\n';
		var required = q.required ? " required" : "";
			for(var opt in q.options){
				var val = q.options[opt];
				o += '\t\t<label class="' + q.basictype + '">\n';
				o += '\t\t\t<input type="' + q.basictype + '" class="' + q.basictype + required +  '" id="rdo' + q.clean + val + '" name="' + q.cleanTitle + '" value="' + val + '" />\n';
				o += '\t\t\t' + val + '\n';
				o += '\t\t</label>\n';
			}
			if(q.help.length > 0){
				o+= '\t\t<p class="help-block">' + q.help + '</p>\n';
			}
			o += '\t</div>\n';
			o += '</div>\n';

		return o;
	}

	function drawSelect(q, multi){
		var required = q.required ? " required" : "";

		var o = '\t\t<select class="' + q.basictype + required + '" id="sel' + q.clean + '" name="' + q.cleanTitle + '"';
			if(multi)
				o+=' multiple="multiple" ';
			o += '>\n'
			o += drawSelectOptions(q);
			o += '\t\t</select>'
			return o;
	}

	function drawSelectOptions(q){
		var o = "";
		console.log(q.options);

		for(var opt in q.options){
			var val = q.options[opt];
			o += '\t\t\t<option value="' + val + '">' + val + '</option>\n';
		}
		return o;
		
	}


	function drawTextArea(q){
		var required = q.required ? " required" : "";
		return '\t\t<textarea class="input text' + required + '" name="' + q.cleanTitle + '" id="txt' + q.clean + '"></textarea>';
	}


	function drawStandardInput(q){
		var required = q.required ? " required" : "";
		var o = "\t\t";
		if(q.basictype == 'password'){
			o += '<input type="password" class="' + q.basictype + required + '" id="txt' + q.clean + '" name="' + q.cleanTitle + '" value="">';
		} else {
			o += '<input type="text" class="' + q.basictype + required + '" id="txt' + q.clean + '" name="' + q.cleanTitle + '" value="">';
		}
		return o;
	}




