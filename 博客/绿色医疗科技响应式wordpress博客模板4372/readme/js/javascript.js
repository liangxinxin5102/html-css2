$(function(){
  // 非本站链接跳出
  $(document).on('click','a',function(e){
    var href = $(this).attr('href');
    if(href.indexOf('http://') >= 0){
      window.open(href);
      return false;
    }
    else if(href.indexOf('javascript:') == 0 || href.indexOf('#') == 0) {
      return;
    }
    else if(href.indexOf('.html') >0) {
      window.top.location.href='../index.html#!/'+href;
    }
  });

});

function menu(parent,child) {
  var menu = parent;
  if(child != undefined){
    menu += '-' + child;
  }
  url = menu + '.html';
  hash = '../index.html?' + (Math.random() + '').substr(2) + '#!' + menu;
  //window.location.href = url;
  top.location.href = hash;
  top.location.reload(true);
}

function next() {
  var filename,$menu,parent,child;
  filename = location.href;
  filename = filename.substr(filename.lastIndexOf('/')+1);
  $menu = filename.replace('.html','');
  $menu = $menu.split('-');
  parent = $menu[0];
  child = $menu[1];
  if(child == undefined) {
    menu(parent,1);
  }
  else {
    child = parseInt(child);
    menu(parent,child + 1);
  }
}