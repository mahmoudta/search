function find_and_highlight(text) {
    var inputText = $("main");
    var innerhtml =$('main').html();
    arrlength = text.length;
    innerhtml = innerhtml.toLowerCase();
    for (var i = 0; i < arrlength; i++) {
      if(text[i] != 'a')
        var index = innerhtml.indexOf(text[i]);
    while(index >= 0) {
    innerhtml=highlight(index,innerhtml,text[i]);
    index = innerhtml.indexOf(text[i], index+23);
    }
  }
    $('main').html(innerhtml);
};


function highlight(index,innerhtml,text){
  innerhtml = innerhtml.substring(0,index) + "<span class='lightIt'>" + innerhtml.substring(index,index+text.length) + "</span>" + innerhtml.substring(index + text.length);
  return innerhtml;
}


$(document).ready(function(){
  var text=localStorage.getItem('searchQ');
  text= text.split(',');
  var css = document.createElement("style");
css.type = "text/css";
css.innerHTML = ".lightIt{ background: yellow;font-weight:bold; }";
document.head.appendChild(css);
  find_and_highlight(text);
});
