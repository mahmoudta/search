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


$(function(){
  $("#search-post").submit(function(){
    var search = $("#search").val().toLowerCase();
    var dataString ='search=' + search;
    localStorage.setItem('searchQ',search);
    console.log(dataString);

    $.ajax({
      type: "POST",
      url:  "actionSearch.php",
      data: dataString,
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

// $('body').on('click','a',function(e){
//
//
// });

//
// function highlight(text) {
//   $(document).ready(function(){
//     console.log(text);
//     var inputText = $("main");
//     var innerhtml = $("main").innerHTML;
//     console.log(innerhtml);
//     var index = innerhtml.indexOf("text");
//     if ( index >= 0 )
//     {
//         innerhtml = innerhtml.substring(0,index) + "<span>" + innerhtml.substring(index,index+text.length) + "</span>" + innerhtml.substring(index + text.length);
//         inputText.innerHTML = innerhtml;
//     }
//   });
// };
