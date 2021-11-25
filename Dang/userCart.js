function checkEmpty() {
    if ($(".carItem").length == 0) {
        $(".table-responsive").hide();
        $("#emptyCart").removeClass("d-none");
    }
    else {
        $(".table-responsive").show();
        $("#emptyCart").addClass("d-none");
    }    
}

// ---------------------------------------------

// On ready
$(document).ready(function() {
    checkEmpty();
});


// On incr/decr click
$(".carQuantityBtn").click(function() {
    var carItem = $(this).closest("tr");

    var carQuantityDiv = carItem.find(".carQuantity");
    var carQuantity = parseInt(carQuantityDiv.text());
    
    if ($(this).hasClass("incr")) {
        if (carQuantity >= 10) {
            alert("You can't buy more than 10!");
            return;
        }
        
        carQuantity++;
    }
    else {
        if (carQuantity == 1) {
            var delFlag = confirm("Do you want to remove this item from your cart?");

            if (!delFlag)
                return;
        }
        
        carQuantity--;
    }
    
    //console.log("new quantity = " + carQuantity);
    
    var url = carItem.find("form").attr("action");
    var data = {
        "user_id" : carItem.attr("data-user-id"),
        "car_id"  : carItem.attr("data-car-id"),
        "quantity": carQuantity
    };

    // Send AJAX request to server, update Order's `quantity`
    $.post(url, data);

    if (carQuantity > 0) {
        carQuantityDiv.text(carQuantity);
    }
    else {
        carItem.remove();
        checkEmpty();
    }
});