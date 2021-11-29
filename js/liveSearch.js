$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(event){

        if (event.key === 'Enter') {
            validateCarSearch();
        }

        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("./php_be/liveSearch.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });


    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});

function validateCarSearch() {
    var result = document.getElementById("search-keyword").value;
    if(result.length > 0){
        window.location.href='carResult.php?keyword='+ result;
    }
}
