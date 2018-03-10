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

/*Parsing new Documents*/
$(function(){
  $("#Parse").click(function(){
    $("#admin-tools> label").show();
    var dataString ='parse=1';

    $.ajax({
      type: "POST",
      url:  "parsefiles.php",
      data: dataString,
      cache:  false,
      success: function(data){
        $("#admin-tools> label").html(data).fadeOut(4000);
      }
    });
  });
});


/*update the active Documents*/
$(function(){
  $("button[name='hide']").click(function(){
    var arr={};
    var active =1;
     $("input[change='1']").each(function(){
        active =1;
        if($(this).attr('checked')== "checked"){active = 0;}
        arr[$(this).val()] = active;
    });

    $.ajax({
      type: "POST",
      url:  "hideDocuments.php",
      data: {documents:arr},
      cache:  true,
      success: function(data){
        $("#message").show();
        $("#message").html(data).fadeOut(6000);
      }
    });
    return false;
  });
});
/*checkbox click listener*/
$(document).ready(function(){
$("input[name='documents[]']").click(function(){
  if($(this).attr('change') == '1'){
      $(this).attr('change',"0");
  }else{
    $(this).attr('change','1');
  }
  if($(this).attr('checked')== "checked"){
      $(this).removeAttr('checked');
  }else{
    $(this).attr('checked', true);
  }
});
});

/*main search */
$(function(){
  $("#wildSearch").submit(function(){
    var search = $("#wildcard").val();
    search=search.trim();
    //search=search.replace(/\s\s+/g, ' ');
    search = search.replace("*","%");
    search=search.toLowerCase();
    console.log("search= "+search);
    // var dataString ='search=' + search;
    //localStorage.setItem('searchQ',search);

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



$(document).ready(function(){
  $("#advanced").click(function(){
    $("#advanced_tools").slideToggle("fast");
    $(".myform").toggle();
  });
});
