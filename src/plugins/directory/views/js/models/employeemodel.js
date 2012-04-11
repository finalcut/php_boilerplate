window.Employee = Backbone.Model.extend({

    // I am not sure what this is used for; perhaps tracking browser history..
    urlRoot:"#employeeList",


});

window.EmployeeCollection = Backbone.Collection.extend({

    model:Employee,

    urlRoot: "#employeeList",
   
    // this is called from within the /views/home.js onclick event for the "Get List"method
    load:function(){
    	var url = 'directory/Listing';
    	console.log('loading from URL: ' + url);
    	var self = this;
    	$.ajax({
    		url:url,
    		dataType:'json',
    		success:function(data){
    			console.log('load success: ' + data.length);
                // when reset is called the object gets a new set of data
                // and I believe thanks to the bind function (see employeelist.js:13) the view is notified to re-render..
    			self.reset(data);
    		},
    		error:function(jqHXR, textStatus, errorThrown){
    			console.log(jqHXR);
    			console.log('something went wrong ' + textStatus + ' : ' + errorThrown);
    		}
    	});
    }

});