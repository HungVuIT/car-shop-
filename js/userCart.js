function checkEmpty() {
    if ($(".carItem").length == 0) {
        $("#nonEmptyCart").addClass("d-none");
        $("#emptyCart").removeClass("d-none");
    }
    else {
        $("#nonEmptyCart").removeClass("d-none");
        $("#emptyCart").addClass("d-none");
    }    
}


function updatePrice(carItem, carQnty, carQntyDiv) {
    if (carQnty > 0) {        
        var carUnitPrice = parseFloat(carItem.find(".carUnitPrice").text().replace(/[, \n$]/g, ''));
        var carTotalPriceStr = (carUnitPrice * carQnty).toLocaleString(undefined, {minimumFractionDigits: 2});
        
        carItem.find(".carTotalPrice").text("$" + carTotalPriceStr);
        carQntyDiv.text(carQnty);
    }
    else {
        carItem.remove();
        checkEmpty();
    }
}

function updateTotalPrice() {
    var newTotal = 0.0;
    for (var i = 0; i < $(".carTotalPrice").length; i++) {
        var currentTotalPriceStr = $($(".carTotalPrice")[i]).text().replace(/[, \n$]/g, '');
        var currentTotalPrice = parseFloat(currentTotalPriceStr);

        newTotal += currentTotalPrice;
    }

    $("#totalPrice").text("$" + newTotal.toLocaleString(undefined, {minimumFractionDigits: 2}));
}

// ---------------------------------------------

// On ready
$(document).ready(function() {
    checkEmpty();
    updateTotalPrice();
});


// On incr/decr click
$(".carQntyBtn").click(function() {

    var carItem = $(this).closest("tr");

    var carQntyDiv = carItem.find(".carQnty");
    var carQnty = parseInt(carQntyDiv.text());
    
    var req_type;

    if ($(this).hasClass("incr")) {
        if (carQnty >= 10) {
            alert("You can't buy more than 10!");
            return;
        }

        req_type = "add";
    }
    else {
        if (carQnty == 1 && (!confirm("Do you want to remove this item from your cart?")))
            return;

        req_type = "sub";
    }
    

    var user_id = parseInt(carItem.attr("data-user-id"));
    var car_id  = parseInt(carItem.attr("data-car-id"));
    
    var url = carItem.find("form").attr("action");
    var data = {
        "req_type": req_type,
        "user_id" : user_id,
        "car_id"  : car_id,
        "quantity": carQnty
    };

    // Send AJAX request to server, update Order's `quantity`
    $.post(url, data);


    carQnty += (req_type == "add"? 1 : -1);

    updatePrice(carItem, carQnty, carQntyDiv)
    updateTotalPrice();
});