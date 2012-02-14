window.Employee = Backbone.Model.extend({

    urlRoot:"#",


});

window.EmployeeCollection = Backbone.Collection.extend({

    model:Employee,

    url:"directory/Listing",
   
    load:function(){
    	var url = this.url;
    	console.log('loading from URL: ' + url);
    	var self = this;
    	$.ajax({
    		url:url,
    		dataType:'json',
    		success:function(data){
    			console.log('load success: ' + data.length);
    			self.reset(data);
    		},
    		error:function(jqHXR, textStatus, errorThrown){
    			console.log(jqHXR);
    			console.log('something went wrong ' + textStatus + ' : ' + errorThrown);
    		}
    	});
    }

});