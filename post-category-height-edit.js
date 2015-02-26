jQuery(document).ready(function($) {

	if( $.isEmptyObject( pche ) ) {

		return false;

	}

	var category_boxes = '';

	$.each( pche , function( index , category_name ) {
		
		category_boxes += ' .categorydiv div.tabs-panel#' + category_name + '-all,';
		
	});
	
	category_boxes = category_boxes.slice( 0 , -1 );
	
	var $CatBoxex = $(category_boxes);

	$CatBoxex.css({"max-height" : "none"});
	
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

	$CatBoxex.resizable({
		maxWidth: Math.floor($CatBoxex.width()),
		create: function(event, ui) {
			$(this).css({ height: CatBoxheight , width: "inherit" });
			$(this).children(".ui-icon").css("background", "url(images/resize.gif)");
		},
		stop: function(event, ui) {
			var SetCook = CookName + "=" + $CatBoxex.height() + ";expires=" + CookSetTime;
			document.cookie = SetCook
		}
	});

});
