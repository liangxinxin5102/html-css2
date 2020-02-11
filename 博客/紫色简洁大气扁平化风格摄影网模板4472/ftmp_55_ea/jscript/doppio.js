function loadArticles(){
	$.get("more-articles.html", function(data) {
		document.getElementById('full-article-list').innerHTML = document.getElementById('full-article-list').innerHTML+data;
	})
	.error(function() { alert("Works only on host!"); });
}

function getSearchResults(){
	var searching = document.getElementById('search-box').value;
	$.post("search-results.html", { search_text: searching }, function(data) {
		document.getElementById('sidebar-scroll').innerHTML = data;
	})
	.error(function() { alert("Works only on host!"); });
}

function demoTool(element, inorout){
	if(inorout){
		element.className = "demo-tool comeout";
	}else{
		element.className = "demo-tool";
	}
}

if($.cookie("css")) {
	$("#main-style").attr("href",$.cookie("css"));
}

function changeColor(ell, stylesheet){
	$("#main-style").attr("href","css/"+stylesheet);
	document.getElementById('tool-color1').className = "change-color";
	document.getElementById('tool-color2').className = "change-color";
	document.getElementById('tool-color3').className = "change-color";
	document.getElementById('tool-color4').className = "change-color";
	ell.className = "change-color active";
	$.cookie("css",'css/'+stylesheet, {expires: 365, path: '/'});
	return false;
}

function changeBg(ell, background){
	document.body.style.background = "url(images/"+background+") top center";
	document.getElementById('side-top').style.background = "url(images/"+background+") top center";
	document.getElementById('side-bottom').style.background = "url(images/"+background+") top center";
	document.getElementById('tool-bg1').className = "change-bg";
	document.getElementById('tool-bg2').className = "change-bg";
	document.getElementById('tool-bg3').className = "change-bg";
	document.getElementById('tool-bg4').className = "change-bg";
	ell.className = "change-bg active";
	$.cookie("bgimg",'images/'+background, {expires: 365, path: '/'});
	return false;
}
