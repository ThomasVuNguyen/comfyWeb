"use strict";
window.onload = function(){
	var nexterNotice = document.querySelector(".nexter-ext-notice .notice-dismiss");
	if( nexterNotice ){
		nexterNotice.addEventListener('click', function(){
			var request = new XMLHttpRequest();

			request.open('POST', nexter_admin_config.ajaxurl, true);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
			request.onload = function () {
			};
			request.send('action=nexter_ext_dismiss_notice&nexter_nonce=' + nexter_admin_config.ajax_nonce);
		});
	}
}