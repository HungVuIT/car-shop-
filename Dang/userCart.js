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


// On delete click
$(".btn-danger").click(function() {
    this.closest("tr").remove();

    checkEmpty();
});



