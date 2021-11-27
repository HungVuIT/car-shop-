// Session events

$("#addCartForm>button").click(function(e) {
    e.preventDefault();
    
    var form = $("#addCartForm");
    var user_id = parseInt($("body").attr("data-sess-user-id"));
    var car_id  = parseInt($("body").attr("data-car-id"));

    var url = form.attr("action");
    var data_get = {
        "req_type": "get",
        "user_id" : user_id,
        "car_id"  : car_id
    };

    //console.log("Data 1 = " + data_get.car_id);
        
    $.post(url, data_get,
        function(response, status) {
            var carQuantity = parseInt(response);
                        
            if (carQuantity >= 10) {
                alert("You can't buy more than 10!");
                return;
            }

            var data_update = {
                "req_type": "add",
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

    var user_id = parseInt($("body").attr("data-sess-user-id"));
    var car_id  = parseInt($("body").attr("data-car-id"));

    var form = $(this);
    var url = form.attr('action');

    var data = {
        "user_id": user_id,
        "car_id" : car_id,
        "review": $("#sessUserReview").val()
    }
    
    $.post(url, data,
        function(response, status) {
            $("#userReviews").append(response);    // add user's review to list of reviews
        }
    );
});



// Delete self reviews
$("#userReviews").on("click", ".delReview", function() {
    console.log("clicked!");
    var review = $(this).closest(".userReview");
    var reviewID = parseInt(review.attr("data-review-id"));
    var userID = parseInt(review.attr("data-user-id"));

    var url = "php/del_review.php";
    var data = {
        "user_id"   : userID,
        "review_id" : reviewID
    };

    console.log("Before delete, data = " + JSON.stringify(data));

    $.post(url, data);

    review.remove();
});