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
    var qsearch = search.replace(/"/g, "");
    qsearch = qsearch.replace(/'/g, "");
    qsearch = qsearch.trim();
    var temp = new Array();
    temp = qsearch.split(',');
    console.log(temp);

    localStorage.setItem('searchQ',temp);

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
        if(data == 'No documents To add'){
        $("#admin-tools> label").html(data).fadeOut(4000);
      }else{
        $("#hiding").html(data);
      }
      }
    });
    return false;
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

/*wildcard search search */
$(function(){
  $("#wildSearch").submit(function(){
    var search = $("#wildcard").val();
    search=search.trim();
    search=search.replace(/\s+/g, ',');
    search = search.replace(/[*]/g,"%");
    search=search.toLowerCase();
    var qsearch = search.replace(/[%]/g,"").replace(/[,]/g,' ');
    localStorage.setItem('searchQ',qsearch);

    $.ajax({
      type: "POST",
      url:  "actionSearch.php",
      data: {wildcard:search},
      cache:  true,
      success: function(data){
        $("#result").html(data);
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





$(function(){
  $("#advancedsearch").submit(function(){

    var expression = $("#operand").val();
    expression = expression.replace(/AND/g," * ").replace(/OR/g," + ").replace(/NOT/g," - ");
    expression=expression.trim();
    expression=expression.replace(/\s+/g, ' ');
    expression=expression.toLowerCase();
    var send = expression;
    var start=0,end =0;
    var start=expression.indexOf("(");
    var end = expression.indexOf(")");
    var first = expression.substring(start+1,end);
    if(start>=0 && end>0)
      expression =expression.substring(0,start)+expression.slice(start+1,end).replace(/\s/g,'')+expression.substring(end+1,expression.length);
    expression=expression.replace(/\s/g,",");
    // var advancedsearch = "advancedsearch="+expression;

    $.ajax({
      type: "POST",
      url:  "actionSearch.php",
      data: {advancedsearch:send},
      cache:  true,
      success: function(data){
        $("#result").html(data);
      }
    });
    return false;
  });
});
