"use strict";
document.addEventListener('DOMContentLoaded', (event) => {
	var eleFooter = document.getElementById("nxt-footer");
	if(eleFooter && eleFooter.classList.contains("w-smart")){
		document.body.classList.add("smart-footer");
		nexterFooterSmart();
	}
	if(eleFooter && eleFooter.classList.contains("w-fixed") ) {
		nexterFooterFixed(eleFooter);
	}
	
	nexterNavigation();
	var headerSticky = document.querySelector( '#nxt-header.nxt-sticky' );
	if(headerSticky){
		nexterHeaderSticky( headerSticky );
	}
});

window.addEventListener('scroll', () => {
	var headerSticky = document.querySelector( '#nxt-header.nxt-sticky' );
	if(headerSticky){
		nexterHeaderSticky( headerSticky );
	}
});

window.addEventListener('resize', () => {
	var headerSticky = document.querySelector( '#nxt-header.nxt-sticky' );
	if(headerSticky){
		nexterHeaderSticky( headerSticky );
	}
});

var nexterHeaderSticky = function(elem){
	var headerHeight= elem.querySelector('.nxt-normal-header');
		headerHeight = headerHeight ? headerHeight.offsetHeight : 0;
	if(elem){
		var stickHeight = elem.querySelector(".nxt-stick-header-height");
		if( stickHeight ) {
			var offset_top = ( elem )? elem.offsetTop : 0;
			if( window.scrollY > offset_top) {
				stickHeight.style.minHeight = headerHeight+'px';
				elem.classList.add("normal-fixed-sticky");
			}else {
				stickHeight.style.minHeight = 0;
				elem.classList.remove("normal-fixed-sticky");
			}
		}else {
			headerHeight += 40;
			window.scrollY >= headerHeight ? elem.classList.add("fixed-sticky"): elem.classList.remove("fixed-sticky");
		}
	}
}

var nexterNavigation = function(){
	var links, len,
		menu = document.querySelector( '.site-navigation' );

	if ( ! menu ) {
		return false;
	}

	links = menu.getElementsByTagName( 'a' );
	len = links.length;
	
	for ( var i = 0; i < len; i++ ) {
		links[i].addEventListener( 'focus', nxtToggleFocus, true );
		links[i].addEventListener( 'blur', nxtToggleFocus, true );
	}

	function nxtToggleFocus() {
		var self = this;

		while ( -1 === self.className.indexOf( 'nxt-primary-menu' ) ) {
		
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}
			self = self.parentElement;
		}
	}
}

var nexterFooterSmart = function(){
	var bodyContent = document.querySelector('#content.site-content'),
		offPreview = "off-preview";
	var winheight = window.innerHeight || (document.documentElement || document.body).clientHeight,
		scrollTop = window.pageYOffset || (document.documentElement || document.body.parentNode || document.body).scrollTop,
		bodyOuterheight = nexterOuterHeightFind(bodyContent);
	if ((scrollTop + winheight) >= (bodyOuterheight +10) && (200 < scrollTop)) {
		document.body.classList.add(offPreview);
	}else{
		document.body.classList.remove(offPreview);
	}
}

var nexterFooterFixed = function(el){
	var content = document.getElementById("content"),
	height = nexterOuterHeightFind(el);
	
	content.style.marginBottom = height+'px';
}

var nexterOuterHeightFind = function(elm){

    var elmHeight, elmMargin;
    if(document.all) {// IE
        elmHeight = elm.currentStyle.height;
        elmMargin = parseInt(elm.currentStyle.marginTop, 10) + parseInt(elm.currentStyle.marginBottom, 10);
    } else {// Mozilla
        elmHeight = document.defaultView.getComputedStyle(elm, '').getPropertyValue('height');
        elmMargin = parseInt(document.defaultView.getComputedStyle(elm, '').getPropertyValue('margin-top')) + parseInt(document.defaultView.getComputedStyle(elm, '').getPropertyValue('margin-bottom'));
    }
	
    return (parseInt(elmHeight,10)+elmMargin);
}

window.addEventListener('scroll', (event) => {
	var eleFooter = document.getElementById("nxt-footer");
	if(eleFooter && eleFooter.classList.contains("w-smart")){
		nexterFooterSmart();
	}
	if(eleFooter && eleFooter.classList.contains("w-fixed") ) {
		nexterFooterFixed(eleFooter);
	}
});