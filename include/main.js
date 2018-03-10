$(document).ready(function(){
  $("button[name='sign-in-button']").click(function(){
    $(".sign-in").slideToggle("fast")
  });
});

$(document).ready(function(){
  $("button[name='sign-out-button']").click(function(){
    window.location = "http://finalretrevied/logout.php";
  });
});

/*main search */
$(function(){
  $("#search-post").submit(function(){
    var search = $("#search").val().toLowerCase();
    search=search.trim();
    search=search.replace(/\s\s+/g, ' ');
    search = search.split(" ").join(",");
    // var dataString ='search=' + search;
    localStorage.setItem('searchQ',search);

    $.ajax({
      type: "POST",
      url:  "actionSearch.php",
      data: {search:search},
      cache:  true,
      success: function(data){
        $("#result").html(data);
        // $(function(){
        //   $('a').click(function(e){
        //     // e.preventDefault();
        //     highlight(search);
        //   });
        // });
      }
    });
    return false;
  });
});

$(function(){
  $("#Parse").click(function(){
    $("#admin-tools> label").show();
    var dataString ='parse=1';

    $.ajax({
      type: "POST",
      url:  "parsefiles.php",
      data: dataString,
      cache:  true,
      success: function(data){
        $("#admin-tools> label").html(data).fadeOut(4000);
      }
    });
    return false;
  });
});




$(document).ready(function(){
  $("#advanced").click(function(){
    $("#advanced_tools").slideToggle("fast");
    $(".myform").toggle();
  });
});
