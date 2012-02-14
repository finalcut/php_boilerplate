var AppRouter = Backbone.Router.extend({

    routes:{
        "*directory":"home",
        "*directory/list":"employeeList"
    },

    initialize:function (options) {
    },

    home:function () {
        // Since the home view never changes, we instantiate it and render it only once
        if (!this.homeView) {
            this.homeView = new HomeView();
            this.homeView.render();
        }
        $('#content').html(this.homeView.el);
    },


    employeeList:function () {
        $('#content').html('hahah');
        /*
        var employee = new Employee({id:id});
        employee.fetch({
            success:function (data) {
                // Note that we could also 'recycle' the same instance of EmployeeFullView
                // instead of creating new instances
                $('#content').html(new EmployeeFullView({model:data}).render().el);
            }
        });
        */
    }

});

tpl.loadTemplates(['home', 'employee-list-item'],
    function () {
        app = new AppRouter();
        Backbone.history.start();
    });