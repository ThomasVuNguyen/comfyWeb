/**
 * Script for mobile menu
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */


(function(){
	// select all variable
const smButton = document.getElementById('mmenu-btn');
const smMenu = document.getElementById('mobile-navigation');

if( !smMenu ){
	return;
}

	const smOpen = smMenu.querySelector('.mopen');
	const smClose = smMenu.querySelector('.mclose');
	smClose.style.display = 'none';

// button click event
  smButton.addEventListener('click', function( ){
	smMenu.classList.toggle( 'menu-active' );

	
	if( smButton.getAttribute('aria-expanded') === 'true' ){
		smButton.setAttribute('aria-expanded', 'false');
		smClose.style.display = 'none';
		smOpen.style.display = 'block';
	}else{
		smButton.setAttribute('aria-expanded','true');
		smClose.style.display = 'block';
		smOpen.style.display = 'none';
	}

  }); // Click event end

  // set outside the menu area 
document.addEventListener('click',function(e){
	const isInsideMenu = smMenu.contains(e.target);

	if( ! isInsideMenu){
		smMenu.classList.remove('menu-active');
		smButton.setAttribute('aria-expanded','false');
		smClose.style.display = 'none';
		smOpen.style.display = 'block';
	}

})

// add Icon has Children item

//const linkHasSub = smMenu.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');
const linkHasSub = smMenu.querySelectorAll('.menu-item-has-children > .sub-menu, .page_item_has_children > .sub-menu');


for (const child of linkHasSub) {
	var icon = document.createElement('i');
    icon.className = 'fas fa-chevron-down';
	child.parentNode.insertBefore(icon, child);
	
}

const subMenuIcon = smMenu.querySelectorAll('.menu-item-has-children > i , .page_item_has_children > i');

for (const iconset of subMenuIcon) {
	iconset.setAttribute('tabindex','0');
	
}

	const linksWithChildren = smMenu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

	for ( const link of subMenuIcon ) {
		link.addEventListener( 'click', toggleClick, true );
		link.addEventListener( 'focus', toggleFocus, true );
	//	link.addEventListener( 'blur', toggleblur, true );
	}

	function toggleFocus(e){
		
		if( ! this.parentNode.classList.contains('focus')){
			this.parentNode.classList.add('focus');
			this.parentNode.classList.remove('clicked');
		}

	}
	function toggleblur(e){
		const firstLiA = smMenu.querySelctorAll('#wsm-menu >li a');

		const firstLiaBlur = firstLiA.contains(e.target);
		console.log(firstLiA);
		
		if(firstLiaBlur){

			this.parentNode.classList.remove('focus');
		}else{
			this.parentNode.classList.add('focus');
		}
		

	}
	function toggleClick(e){
		
		if( this.parentNode.classList.contains('clicked')){
			this.parentNode.classList.remove('clicked');
		}else{
			this.parentNode.classList.add('clicked');
			this.parentNode.classList.remove('focus');
		}

	}

focusableInNav = smMenu.querySelectorAll('button, [href], [tabindex]:not([tabindex="-1"])');


	let firstFocusElement = focusableInNav[0];
	let lestFocusElement = focusableInNav[focusableInNav.length - 1];
	
	firstFocusElement.addEventListener( 'keydown', moveFocusToBottom, true );
	lestFocusElement.addEventListener( 'keydown', moveFocusToTop, true );

	function moveFocusToBottom(e) {
		if (e.key === "Tab" && e.shiftKey) {
			e.preventDefault();
			lestFocusElement.focus()
		}
	}
	function moveFocusToTop(e) {
		if (e.key === "Tab" && !e.shiftKey) {
			e.preventDefault();
			firstFocusElement.focus();
		}
	}




}())