var AppRouter = Backbone.Router.extend({

    /*
        I am using the * at the beginning of the route becuase I don't know regex any better
        and our AppRouter is located within a subdirectory of the webserver.  Feel free to tweak
        this for your own needs if you can make it more efficient/selective.
    */
    routes:{
        "*directory":"home",
    },


    // this is intentionally left blank.  I don't really have anything to do on this examples initialization.
    initialize:function () {
    },


    // used by the routes above; basically when */directory is loaded this function is called.
    home:function () {
        // Since the home view never changes, we instantiate it and render it only once
        if (!this.homeView) {
            this.homeView = new HomeView();
            this.homeView.render();
        }
        $('#content').html(this.homeView.el);
    }
});

// here we will cache our templates; check out util.js for how this is all working.
tpl.loadTemplates(['home', 'employee-list-item'],
    function () {
        app = new AppRouter();
        Backbone.history.start();
    });