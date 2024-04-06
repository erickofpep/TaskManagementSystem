(function($, pusher, assignTask) {

    var taskActionChannel = pusher.subscribe('taskAction');

    taskActionChannel.bind("App\\Events\\TaskAssigned", function(data) {

        assignTask(data.id, false);
    });

})(jQuery, pusher, assignTask);