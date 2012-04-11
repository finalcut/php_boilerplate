window.EmployeeListView = Backbone.View.extend({

    // when called this will return an element of type tagName with class specified in className..containing whatever is in render
    tagName:'ul',

    className:'nav nav-list',


    initialize:function () {
        var self = this;

        // the bind function is part of underscore.js.  : i don't fully understand what is happening with this..
        this.model.bind("reset", this.render, this);
        this.model.bind("add", function (employee) {
            $(self.el).append(new EmployeeListItemView({model:employee}).render().el);
        });
    },

    // this actually uses the Employee List Item View (see views/employeelist.js) and iteratively draws that view
    // for each Employee element in it's EmployeeCollection model (see models/employeemodel.js).
    render:function (eventName) {
        console.log('rendering list');
        $(this.el).empty();
        _.each(this.model.models, function (employee) {
            // the view is pretty smart and receives a copy of every property within the json object availabe within the iteration.
            // in this example both firstname and lastname are provided as part of employee without any special effort on our part inside the Employee model
            $(this.el).append(new EmployeeListItemView({model:employee}).render().el);
        }, this);
        return this;
    },

});

window.EmployeeListItemView = Backbone.View.extend({
    // when called this will return an element of type tagName..containing whatever is in render
    tagName:"li",

    initialize:function () {
        this.template = _.template(tpl.get('employee-list-item'));
        this.model.bind("change", this.render, this);
        this.model.bind("destroy", this.close, this);
    },

    // this uses the template /tpl/employee-list-item.html and draws each li for the employee list.
    render:function (eventName) {
        $(this.el).html(this.template(this.model.toJSON()));
        return this;
    }

});