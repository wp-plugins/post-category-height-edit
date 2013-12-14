jQuery(document).ready(function($) {

	var $CatBox = $("#category-all");
	
	$(".categorydiv div.tabs-panel#category-all").css({"max-height" : "none"});
	var CookName = 'Post-category-height-edit';
	var Cookies = document.cookie.split("; ");
	var CatBoxheight = 200;
	var CookDate = new Date();
	CookDate.setDate(CookDate.getDate() + 365);
	var CookSetTime = CookDate.toGMTString();

	for (var i = 0; i < Cookies.length; i++) {
		var str = Cookies[i].split("=");
		if (str[0] == CookName) {
			if(!isNaN(str[1])) {
				CatBoxheight = str[1];
				break;
			}
		}
	}

	$CatBox.resizable({
		maxWidth: Math.floor($CatBox.width()),
		create: function(event, ui) {
			$(this).css({ height: CatBoxheight , width: "inherit" });
			$(this).children(".ui-icon").css("background", "url(images/resize.gif)");
		},
		stop: function(event, ui) {
			var SetCook = CookName + "=" + $CatBox.height() + ";expires=" + CookSetTime;
			document.cookie = SetCook
		}
	});

});
