window.HomeView = Backbone.View.extend({

    initialize:function () {
        console.log('Initializing Home View');
        this.template = _.template(tpl.get('home'));
        this.employees = new EmployeeCollection();
        this.employeeListView = new EmployeeListView({model:this.employees});
    },

    events:{
        "click #directoryListingBtn":"directoryListingBtnClick",
        "click #clearListingBtn":"clearListingBtnClick"
    },

    render:function (eventName) {
        $(this.el).html(this.template());
    },

    directoryListingBtnClick:function () {
        $('#biglist').append(this.employeeListView.render().el);
        this.employees.load();
    },
    
    clearListingBtnClick:function(){
        $('#biglist').html('');
    }

});