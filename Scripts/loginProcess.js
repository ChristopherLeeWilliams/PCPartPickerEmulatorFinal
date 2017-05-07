$(document).ready(function() {
    $('#btn-login').on('click', function() {
    
        var data = {
            username: $('#username').val(),
            password: $('#password').val(),
        };
        
        $.ajax({
            type: "POST",
            url: "loginProcess.php",
            dataType: "json",
            data: data,
        })
        .done(function(data) { 
            // Code to run if the request succeeds (is done); The response is passed to the function
            console.log(data);

            // Do not do anything if there is no data
            if (!data || data.length == 0) {
                console.log("No data returned!");
                
            } else {
                if(data["status_code"]==1) {
                    console.log("Password Match");
                    $('#error').html("");
                    
                    // Session variables don't get assigned through ajax
                    // need to refresh page for now
                    window.location.href="/Final Project/index.php";
                    
                } else {
                    console.log("Invalid username or password");
                    $('#error').html("Invalid username or password");
                }
            }
        })
        .fail(function(xhr, status, errorThrown) { 
            // Code to run if the request fails; the raw request and status codes are passed to the function
            console.log("Sorry, there was a problem!");
            console.log(xhr.responseText);
        })
        .always(function(xhr, status) {
            // Code to run regardless of success or failure;
            console.log("The request is complete!");
        });
    });
    
    $('#btn-logout').on('click', function() {
    
        var data = {
            username: $('#username').val(),
            password: $('#password').val(),
        };
        
        $.ajax({
            type: "GET",
            url: "logout.php",
            success: function(data) {
                console.log("Logout Successful");
                loggedOutDisplay();
            }
        });
    
    });
});