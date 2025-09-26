$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            url: 'reminder.php',
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    data.forEach(function(task) {
                        alert("Reminder: Task '" + task.title + "' is due at " + task.deadline);
                    });
                }
            }
        });
    }, 600000);  // Check every 10 minutes
});
