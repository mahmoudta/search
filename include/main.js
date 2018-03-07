$(document).ready(function(){
  $("button[name='sign-in-button']").click(function(){
    $(".sign-in").slideToggle("fast")
  });
});


$(function(){
  $("#search-post").submit(function(){
    var search = $("#search").val().toLowerCase();
    var dataString = 'search=' + search;
    console.log(dataString);

    $.ajax({
      type: "POST",
      url:  "actionSearch.php",
      data: dataString,
      cache:  true,
      success: function(data){
        $("#result").html(data);
      }
    });
    return false;
  });
});
