$("#newReview").submit(function(e) {

    e.preventDefault(); // override form's default "submit"

    var form = $(this);
    var url = form.attr('action');

    var data = {
        "user_id": "1", // TODO: get user_id from session?
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