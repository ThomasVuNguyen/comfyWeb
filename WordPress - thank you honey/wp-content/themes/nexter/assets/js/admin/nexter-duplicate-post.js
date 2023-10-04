
/********
Post Duplicate JS
********/
document.addEventListener("DOMContentLoaded", function(){
	var nexterDupPost = document.querySelectorAll(".nexter_duplicate_post");
	
	if( nexterDupPost ){
		nexterDupPost.forEach( el => {
			let mainA = el.querySelector('.nxt-post-duplicate'),
				cModal = el.querySelector('.nxt-dp-post-modal'),
				dpBtn = el.querySelector('.nxt-dp-post-btn'),
				totalCopy = el.querySelector('.nxt-dp-post-input');
				
				mainA.addEventListener('click', function(ea){
					ea.preventDefault();
					let dup_post = ea.currentTarget.closest('.nexter_duplicate_post');
					if(dup_post.classList.contains('nxt-open-popup')){
						dup_post.classList.remove('nxt-open-popup');
					}else{
						dup_post.classList.add('nxt-open-popup');
					}
				});
			
			dpBtn.addEventListener('click', function(e){
				e.preventDefault();
				var request = new XMLHttpRequest();
				request.open('POST', nexter_admin_config.ajaxurl, true);
				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				request.onload = function () {
					if (request.status >= 200 && request.status < 400) {
						var response = JSON.parse(request.response);
						if(response.success == true){
							location.reload()
						}
					}
				};
				request.send('action=nxt_duplicate_post&nexter_nonce=' + nexter_admin_config.ajax_nonce+'&original_id=' + mainA.dataset.postid+'&total='+totalCopy.value);
				
			});
		});
	}
});