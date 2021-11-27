function validateCarSearch() {
    var result = document.getElementById("search-keyword").value;
    if(result.length > 0){
        window.location.href='carResult.php?keyword='+ result;
    }
}