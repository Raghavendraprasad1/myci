$(document).on("click", "#table_btn", function(){
    console.log("hii you are here");
    $("#simple-table").find("td:contains('Deleted')").closest('tr').addClass('strike-line');

});


// $(row).find("td:contains('Deleted')").closest('tr').addClass('strike-line');