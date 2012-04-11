window.HomeView = Backbone.View.extend({

    initialize:function () {
        console.log('Initializing Home View');
        // this loads the template for the current view..
        this.template = _.template(tpl.get('home'));

        // setup a model object for our employeeCollection (which has a bunch of Employee in it; see models/employeemodel.js)
        this.employees = new EmployeeCollection();
        this.employeeListView = new EmployeeListView({model:this.employees});
    },


    // within the view we can bind events; here we bind our click events on the two buttons.
    events:{
        "click #directoryListingBtn":"directoryListingBtnClick",
        "click #clearListingBtn":"clearListingBtnClick"
    },

    // here we draw our template.. pretty straight forward for this one.
    render:function (eventName) {
        $(this.el).html(this.template());
    },

    // this is a little tricker.. we are telling this view to append the rendering of the employeeListView to a node without our view (biglist).
    directoryListingBtnClick:function () {
        // I do this here, instead of in initialize or render, becuase "biglist" isnt' available for me in either of those..
        $('#biglist').append(this.employeeListView.render().el);
        // load the list..
        this.employees.load();
    },
    
    clearListingBtnClick:function(){
        // nothing special here..
        $('#biglist').html('');
    }

});