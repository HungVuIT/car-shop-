// On ready
$(document).ready(function() {
    
});


$("#addCartForm>button").click(function(e) {
    e.preventDefault();

    var form = $("#addCartForm");
    var user_id = parseInt($("body").attr("data-user-id"));
    var car_id  = parseInt($("body").attr("data-car-id"));

    var url = form.attr("action");
    var data_get = {
        "req_type": "get",
        "user_id" : user_id,
        "car_id"  : car_id
    };
    
    $.post(url, data_get,
        function(response, status) {
            var carQuantity = parseInt(response);

            if (carQuantity >= 10) {
                alert("You can't buy more than 10!");
                return;
            }


            carQuantity++;

            var data_update = {
                "req_type": "update",
                "user_id" : user_id,
                "car_id"  : car_id,
                "quantity": carQuantity
            };
        
            // Send AJAX request to server, update Order's `quantity`
            $.post(url, data_update);

        }
    );
});



$("#newReview").submit(function(e) {
    // override form's default "submit"
    e.preventDefault();

    var user_id = parseInt($("body").attr("data-user-id"));
    var car_id  = parseInt($("body").attr("data-car-id"));

    var form = $(this);
    var url = form.attr('action');

    var data = {
        "user_id": user_id,
        "car_id" : car_id,
        "review": $("#userReview").val()
    }

    console.log("Form data:" + data);
    
    $.post(url, data,
        function(data, status) {
            console.log("Got data = " + data);
            $("#otherReviews").append(data);    // add user's review to list of reviews
        }
    );

    
});