"use strict";
document.addEventListener('DOMContentLoaded', (event) => {
	/*Welcome page FAQ*/
	var nxtPanelFaq = document.querySelectorAll('.nxt-welcome-faq .nxt-faq-section .faq-title');
	if( nxtPanelFaq ){
		nxtPanelFaq.forEach( function(ele) {
			ele.addEventListener('click', event => {
				event.preventDefault();
				var faqSec = event.currentTarget.nextElementSibling;
				if (!faqSec.classList.contains('active')) {
					event.currentTarget.parentElement.classList.add('faq-active');
					faqSec.classList.add('active');
					faqSec.style.height = 'auto';

					var height = faqSec.clientHeight + 'px';
					faqSec.style.height = '0px';
					setTimeout(function () {
						faqSec.style.height = height;
					}, 0);
				  
				} else {
					faqSec.style.height = '0px';
					faqSec.addEventListener('transitionend', function () {
						faqSec.parentElement.classList.remove('faq-active');
						faqSec.classList.remove('active');
					}, {
						once: true
					});
				}
				
			});
		});
	}
	/*Welcome page FAQ*/
	/*welcome support*/
	var nxtSupport= document.querySelector('.nxt-welcome-support-toggle');
	if( nxtSupport ){
		nxtSupport.addEventListener('click', event => {
			event.preventDefault();
			var supportContent = document.querySelector('.nxt-welcome-support-content');
			if(supportContent && !supportContent.classList.contains('active-sup')){
				supportContent.classList.add('active-sup');
				nxtSupport.classList.add('active-toggle');
				nxtSupport.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z"/></svg>';
			}else{
				supportContent.classList.remove('active-sup');
				nxtSupport.classList.remove('active-toggle');
				nxtSupport.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M202.021 0C122.202 0 70.503 32.703 29.914 91.026c-7.363 10.58-5.093 25.086 5.178 32.874l43.138 32.709c10.373 7.865 25.132 6.026 33.253-4.148 25.049-31.381 43.63-49.449 82.757-49.449 30.764 0 68.816 19.799 68.816 49.631 0 22.552-18.617 34.134-48.993 51.164-35.423 19.86-82.299 44.576-82.299 106.405V320c0 13.255 10.745 24 24 24h72.471c13.255 0 24-10.745 24-24v-5.773c0-42.86 125.268-44.645 125.268-160.627C377.504 66.256 286.902 0 202.021 0zM192 373.459c-38.196 0-69.271 31.075-69.271 69.271 0 38.195 31.075 69.27 69.271 69.27s69.271-31.075 69.271-69.271-31.075-69.27-69.271-69.27z"></path></svg>';
			}
		})
	}
	/*welcome support*/
	/*welcome Stay Updated*/
	var nxtSendEmail= document.querySelector('.nxt-send-email-update');
	if( nxtSendEmail ){
        var error_notice_Icon = '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="15.75" stroke="#FC4032" stroke-width="0.5"/><circle cx="16" cy="16" r="12" fill="#FC4032"/><rect x="15" y="9" width="2" height="10" rx="1" fill="white"/><rect x="15" y="20" width="2" height="2" rx="1" fill="white"/></svg>';
		nxtSendEmail.addEventListener('click', event => {
			event.preventDefault();
			var nxtEmail= document.querySelector('#stay-update-email');
			if(nxtEmail && nxtEmail.value!=''){
				const validateEmail = (email) => {
					return email.match(
					  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
					);
				  };
				if (validateEmail(nxtEmail.value)) {
					const webhookBody = {
						email: nxtEmail.value,
					};
					const welcomeEmailUrl = 'https://store.posimyth.com/wp-admin/?fluentcrm=1&route=contact&hash=f415f1ff-50d7-4783-9e86-66f96e75c495';
					const response = fetch(welcomeEmailUrl, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'Access-Control-Allow-Origin' : 'http://localhost/',
					},
					mode: 'no-cors',
					body: JSON.stringify(webhookBody),
					}).then((response) => {
						if (response.ok) {
                            var wrong_ID_msg = '<div class="nxt-wrong-msg-notice"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="none"><path d="M2.297 9.135L7.162 14l12-12" stroke="#14c38e" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path></svg> Successfully send mail.</div>';
                            var mailSel = document.querySelector('.nxt-welcome-stay-update');
                            nxt_message_notice(wrong_ID_msg, mailSel, true);
						}else{
                            var wrong_ID_msg = '<div class="nxt-wrong-msg-notice">'+error_notice_Icon+' There was an error! Try again later!</div>';
                            var mailSel = document.querySelector('.nxt-welcome-stay-update');
                            nxt_message_notice(wrong_ID_msg, mailSel);
						}
					});
				}else{	
                    var wrong_ID_msg = '<div class="nxt-wrong-msg-notice">'+error_notice_Icon+' Please Check Email ID</div>';
                    var mailSel = document.querySelector('.nxt-welcome-stay-update');
                    nxt_message_notice(wrong_ID_msg, mailSel);
				}
			}else{
                 var wrong_ID_msg = '<div class="nxt-wrong-msg-notice">'+error_notice_Icon+' Please Enter Email Id</div>';
                var mailSel = document.querySelector('.nxt-welcome-stay-update');
                nxt_message_notice(wrong_ID_msg, mailSel);
			}
		})
	}
	/*welcome Stay Updated*/

    function nxt_message_notice(msg = '', wrapSel){
        if(msg && wrapSel){
            if(wrapSel){
                wrapSel.insertAdjacentHTML('beforeend', msg);
                var notice_data = wrapSel.querySelector('.nxt-wrong-msg-notice');
                if(notice_data){
                    setTimeout(function(){
                        notice_data.classList.add('active-notice');
                    },50);
                    setTimeout(function(){
                       notice_data.remove();
                    },3000);
                }
            }
        }
    }
	/*welcome sys req copy*/
	var nxtCopy= document.querySelector('.sys-copy-download-btn .nxt-copy-btn');
	if( nxtCopy ){
		nxtCopy.addEventListener('click', event => {
			event.preventDefault();
			var copyText = nxtCopy.parentElement.getAttribute('data-clipboard-text');
			var textArea = document.createElement("textarea");
			textArea.value = copyText;
			textArea.style.opacity = 0;
			textArea.style.width = 0;
			textArea.style.height = 0;
			document.body.appendChild(textArea);
			textArea.select();
			try {
				var successful = document.execCommand('copy');
            	if( successful ){
					nxtCopy.innerHTML = 'Copied';
					setTimeout(() => {
						nxtCopy.innerHTML = 'Copy Info';	
					}, 2000);
				}else{

				}	
			} catch (err) {
				console.log('Oops, unable to copy');
			}
			document.body.removeChild(textArea);
		})
	}
	var nxtDownload= document.querySelector('.sys-copy-download-btn .nxt-download-btn');
	if( nxtDownload ){
		nxtDownload.addEventListener('click', event => {
			event.preventDefault();
			var copyText = nxtDownload.parentElement.getAttribute('data-clipboard-text');
			var filename = "nexter-system-info.txt";
			nxt_Download(filename, copyText);
		})
	}
	function nxt_Download(filename, text) {
		var element = document.createElement('a');
		element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
		element.setAttribute('download', filename);
	
		element.style.display = 'none';
		document.body.appendChild(element);
	
		element.click();
	
		document.body.removeChild(element);
	}
	/*welcome sys req copy*/
    /* Extra Option */
	var nxtExtActiveBtn = document.querySelectorAll('.nxt-ext-btn:not(.nxt-ext-settings)');
	if( nxtExtActiveBtn ){
		nxtExtActiveBtn.forEach(function(extension_data) {
			extension_data.addEventListener('click', event => {
				event.preventDefault();
				extension_data.classList.add('ext-loading')
				var extension_type = extension_data.getAttribute("data-ext"),
					active_deactive = extension_data.getAttribute("data-enable-disable"),
					check_active = false,
					action_ajax = 'nexter_extra_ext_deactivate';
					if(active_deactive ==='active'){
						check_active = true;
						action_ajax = 'nexter_extra_ext_active';
					}
				var request = new XMLHttpRequest();
				request.open('POST', nexter_admin_config.ajaxurl, true);
				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				request.onload = function () {
					if (request.status >= 200 && request.status < 400) {
						var response = JSON.parse(request.response);
						if(response.success == true){
						var content = document.querySelector('.nxt-'+extension_type+' span:not(.nxt-desc-icon)');
							if(check_active){
								extension_data.classList.remove('nxt-ext-active')
								extension_data.classList.add('nxt-ext-deactivate');
								content.textContent = "Deactivate";
								extension_data.setAttribute('data-enable-disable','deactive')
								extension_data.insertAdjacentHTML('afterend', '<button class="nxt-ext-btn nxt-ext-settings" data-ext="'+extension_type+'"><span><img src="'+nexter_admin_config.nexter_path +'images/panel-icon/setting.svg" alt="Setting"></span></button>');
								let extension_content = document.querySelector('.nxt-ext-settings[data-ext="'+extension_type+'"]')
								nxt_ext_settings_click(extension_content)
							}else{
								extension_data.classList.remove('nxt-ext-deactivate')
								extension_data.classList.add('nxt-ext-active');
								content.textContent = "Enable";	
								extension_data.setAttribute('data-enable-disable','active')
								document.querySelector('.nxt-ext-settings[data-ext="'+extension_type+'"]').remove();
							}
						}
						extension_data.classList.remove('ext-loading')
					}
				};
				request.send('action='+action_ajax+'&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&extension_type=' + extension_type+'&active_deactive=' + active_deactive);
			})
		});
		 document.addEventListener("click", e =>{
			/*const isClosest = e.target.closest('.nxt-ext-pop-inner');
			const isClosestMedia = e.target.closest('.supports-drag-drop');
			
			if (!isClosest && !isClosestMedia && !e.target.parentElement.classList.contains('nxt-ext-settings')) {
				var pop = document.querySelector('.nxt-ext-setting-pop');
				if(pop){
					pop.remove()
				}
			}
			*/
			const isSupTop = e.target.closest('.nxt-sup-top');
			const isSupInner = e.target.closest('.nxt-support-inner');
			const isSupBottom = e.target.closest('.nxt-support-bottom');
			const isSupToggleClosest = e.target.closest('.nxt-welcome-support-toggle');
			if ( !isSupTop && !isSupInner && !isSupBottom && !isSupToggleClosest && e.target.nodeName!='path' && e.target.nodeName!='svg') {
				const supToggle = document.querySelector('.nxt-welcome-support-toggle');
				const supportContent = document.querySelector('.nxt-welcome-support-content');
				if( supToggle && supToggle.classList.contains('active-toggle') ){
					supportContent.classList.remove('active-sup');
					supToggle.classList.remove('active-toggle');
					supToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M202.021 0C122.202 0 70.503 32.703 29.914 91.026c-7.363 10.58-5.093 25.086 5.178 32.874l43.138 32.709c10.373 7.865 25.132 6.026 33.253-4.148 25.049-31.381 43.63-49.449 82.757-49.449 30.764 0 68.816 19.799 68.816 49.631 0 22.552-18.617 34.134-48.993 51.164-35.423 19.86-82.299 44.576-82.299 106.405V320c0 13.255 10.745 24 24 24h72.471c13.255 0 24-10.745 24-24v-5.773c0-42.86 125.268-44.645 125.268-160.627C377.504 66.256 286.902 0 202.021 0zM192 373.459c-38.196 0-69.271 31.075-69.271 69.271 0 38.195 31.075 69.27 69.271 69.27s69.271-31.075 69.271-69.271-31.075-69.27-69.271-69.27z"></path></svg>';
				}
			}
		}) 
		document.addEventListener("keydown", e =>{
			if (e.keyCode == 27) {
				var pop = document.querySelector('.nxt-ext-setting-pop');
				if(pop){
					pop.remove()
				}
				const supToggle = document.querySelector('.nxt-welcome-support-toggle');
				const supportContent = document.querySelector('.nxt-welcome-support-content');
				if( supToggle && supToggle.classList.contains('active-toggle') ){
					supportContent.classList.remove('active-sup');
					supToggle.classList.remove('active-toggle');
					supToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M202.021 0C122.202 0 70.503 32.703 29.914 91.026c-7.363 10.58-5.093 25.086 5.178 32.874l43.138 32.709c10.373 7.865 25.132 6.026 33.253-4.148 25.049-31.381 43.63-49.449 82.757-49.449 30.764 0 68.816 19.799 68.816 49.631 0 22.552-18.617 34.134-48.993 51.164-35.423 19.86-82.299 44.576-82.299 106.405V320c0 13.255 10.745 24 24 24h72.471c13.255 0 24-10.745 24-24v-5.773c0-42.86 125.268-44.645 125.268-160.627C377.504 66.256 286.902 0 202.021 0zM192 373.459c-38.196 0-69.271 31.075-69.271 69.271 0 38.195 31.075 69.27 69.271 69.27s69.271-31.075 69.271-69.271-31.075-69.27-69.271-69.27z"></path></svg>';
				}
			}
		});
	}
	

	/*Settings click event*/
	var settingGoogleFont = document.querySelectorAll('.nxt-ext-settings');
	if( settingGoogleFont ){
		settingGoogleFont.forEach(function(extension_content) {	
			nxt_ext_settings_click(extension_content);
		})
	}

	function nxt_ext_settings_click(extension_content){
		extension_content.addEventListener('click', event => {
			event.preventDefault();
			var storeGFont = [],
				currentSelectVal = '';

			var pop_ele = document.querySelector('.nxt-ext-pop-inner'),
				extension_type = extension_content.getAttribute("data-ext");
			if(!pop_ele){
				var body = document.querySelector('body')
				body.insertAdjacentHTML('beforeend', '<div class="nxt-ext-setting-pop" data-type="'+extension_type+'"><div class="nxt-ext-pop-inner"><button class="ext-close-button">×</button><div class="spinner"></div></div></div>');
				pop_ele = document.querySelector('.nxt-ext-pop-inner');
			}
			var request = new XMLHttpRequest();
			request.open('POST', nexter_admin_config.ajaxurl, true);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
			request.onload = function () {
				pop_ele.querySelector('.spinner').remove();
				if (request.status >= 200 && request.status < 400) {
					var response = JSON.parse(request.response);
					if(response.success == true && response.data.content!=''){
						pop_ele.insertAdjacentHTML('beforeend', response.data.content);
						if( extension_type == 'local-google-font' ){
							nxt_ext_local_gfont(storeGFont, currentSelectVal, extension_type);
						}else if( extension_type == 'custom-upload-font' ){
							nxt_ext_custom_upload_font(extension_type, response.data.fonts)
						}else if( extension_type == 'disable-admin-setting' ){
							nxtDisAdminPop(extension_type);
						}else if( extension_type == 'wp-replace-url' ){
							nxtWPReplaceUrl(extension_type);
						}else if( extension_type == 'wp-right-click-disable' ){
							nxtWPRightClickDisable(extension_type);
						}else if(extension_type == 'google-recaptcha'){
							nxt_ext_recaptch(extension_type)
						}else if( extension_type == 'advance-performance' ){
							nxtadvanceperfo(extension_type);
						}else if( extension_type == 'disable-comments' ){
							nxtComment(extension_type);
						}else if( extension_type == 'advance-security' ){
							nxtadSecurity(extension_type);
						}else if(extension_type == 'wp-duplicate-post'){
							nxt_ext_duplicate_post(extension_type)
						}else if(extension_type == 'adobe-font'){
							nxt_ext_adobe_font(extension_type)
						}else if(extension_type == 'custom-login'){
							nxt_ext_ctm_login(extension_type)
						}
					}
				}
			};
			var action = '';
			if(extension_type == 'local-google-font'){
				action = 'nexter_ext_local_google_font_content';
			}else if(extension_type == 'custom-upload-font'){
				action = 'nexter_ext_custom_upload_font_content';
			}else if(extension_type == 'disable-admin-setting'){
				action = 'nexter_ext_disable_admin_setting_content';
			}else if(extension_type == 'wp-replace-url'){
				action = 'nexter_ext_wp_replace_url_settings';
			}else if(extension_type == 'wp-right-click-disable'){
				action = 'nexter_ext_wp_right_click_disable_settings';
			}else if(extension_type == 'google-recaptcha' ){
				action = 'nexter_ext_google_recaptcha';
			}else if(extension_type == 'advance-performance' ){
				action = 'nexter_ext_advance_performance';
			}else if(extension_type == 'disable-comments' ){
				action = 'nexter_ext_disable_comments';
			}else if(extension_type == 'advance-security' ){
				action = 'nexter_ext_advance_security';
			}else if(extension_type == 'wp-duplicate-post' ){
				action = 'nexter_ext_wp_duplicate_post_settings';
			}else if(extension_type == 'adobe-font' ){
				action = 'nexter_ext_adobe_font_settings';
			}else if(extension_type == 'custom-login' ){
				action = 'nexter_ext_custom_login_redirect';
			}
			request.send('action='+action+'&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&extension_type=' + extension_type);

			nxt_ext_close_pop(extension_type)
		});
		
	}

	//close pop setting
	function nxt_ext_close_pop(extension_type){
		var close_pop_setting = document.querySelector('.ext-close-button');
		if(close_pop_setting && extension_type){
			close_pop_setting.addEventListener('click', e => {
				e.preventDefault();
				var pop = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"]');
				if(pop){
					pop.remove()
				}
			})
		}
	}

	//Local Google Font
	function nxt_ext_local_gfont( storeGFont, currentSelectVal, extension_type ){
		var font_select = document.querySelector('#nxt-local-google-font-select');
		if( font_select ){
			font_select.addEventListener('click', event => {
				event.preventDefault();
				var select = font_select.parentElement;
				if(!select.classList.contains('active-select')){
					select.classList.add('active-select')
					font_select.removeAttribute("readonly")
					font_select.setAttribute("placeholder", 'Search...')
				}else{
					select.classList.remove('active-select')
					font_select.setAttribute("readonly",true)
					font_select.setAttribute("placeholder", '--Select Value--')
				}
			})

			var gfont_list = document.querySelector(".nxt-gfont-list"),
				gfont_list_li = gfont_list.getElementsByTagName("li");

			if(gfont_list){
				let listItems = gfont_list.querySelectorAll('li');
				if(listItems){
					listItems.forEach((item) => {
						item.addEventListener('click', e => {
							e.preventDefault();
							font_select.value = e.currentTarget.getAttribute("value")
							font_select.parentElement.classList.remove('active-select')
							font_select.setAttribute("readonly",true)
							currentSelectVal = e.currentTarget;
							document.querySelector('.nxt-add-gfont-data').disabled = false
						})
						if(item.classList.contains('hide-selected-val')){
							var data = item.getAttribute("value");
							storeGFont[data] = item
						}
					})

					//remove font
					var removeFont = document.querySelectorAll('.nxt-gfont-val .nxt-remove-gfont');
					if(removeFont){
						removeFont.forEach(function(item) {
							item.addEventListener('click', e => {
								e.preventDefault();
								var val = e.currentTarget.getAttribute('value')
								if(val && storeGFont[val]){
									storeGFont[val].classList.remove('hide-selected-val')
									delete storeGFont[val];
									e.currentTarget.parentElement.remove();
								}
							})
						});
					}
				}

				//add font list
				let font_add = document.querySelector('.nxt-add-gfont-data');
				if(font_add){
					font_add.addEventListener('click', e => {
						var font_val = font_select.value;
						if(font_val!='' && currentSelectVal){
							var selected_list = document.querySelector('.nxt-gfont-selected');
							if(selected_list){
								font_select.setAttribute("placeholder", '--Select Value--')
								storeGFont[font_val] = currentSelectVal
								currentSelectVal.classList.add('hide-selected-val');
								currentSelectVal = '';
								var add_font = '<li class="nxt-gfont-val"><div class="nxt-font-title">'+font_val+'</div><button type="button" class="nxt-remove-gfont" value="'+font_val+'"></button></li>';
								selected_list.insertAdjacentHTML('beforeend', add_font);
								font_select.value = '';
								font_add.disabled = true

								//remove font
								var removeFont = selected_list.querySelectorAll('.nxt-gfont-val .nxt-remove-gfont');
								if(removeFont){
									removeFont.forEach(function(item) {
										item.addEventListener('click', e => {
											e.preventDefault();
											var val = e.currentTarget.getAttribute('value')
											if(val && storeGFont[val]){
												storeGFont[val].classList.remove('hide-selected-val')
												delete storeGFont[val];
												e.currentTarget.parentElement.remove();
											}
										})
									});
								}
							}
						}
					})
				}
			}

			//Search font text field
			font_select.addEventListener('keyup', event => {
				var filter, i, txtValue;
				filter = font_select.value.toUpperCase();
				
				for (i = 0; i < gfont_list_li.length; i++) {
					txtValue = gfont_list_li[i].getAttribute("value");
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						gfont_list_li[i].style.display = "";
					} else {
						gfont_list_li[i].style.display = "none";
					}
				}
			});
		}
		
		//save local gfont
		var saveGFont = document.querySelector('.nxt-sync-save-gfont')
		if(saveGFont){
			saveGFont.addEventListener('click', e => {
				e.preventDefault();
				if(storeGFont){
					var Fonts = Object.keys(storeGFont);
						Fonts = JSON.stringify(Fonts)
					if(Fonts){
						saveGFont.innerHTML = 'Saving...';
						var request = new XMLHttpRequest();
						request.open('POST', nexter_admin_config.ajaxurl, true);
						request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
						request.onload = function () {
							if (request.status >= 200 && request.status < 400) {
								var response = JSON.parse(request.response);
								if(response.success == true){
									saveGFont.innerHTML = 'Saved';
									setTimeout(function(){
										saveGFont.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round" ><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>Save';
									}, 2000);
								}
							}
						};
						request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&fonts=' + Fonts+'&extension_type=' + extension_type);
					}
				}
			})
		}
	}
	window.upload_font_session = { font_name : '', lists : {} };
	//Custom Upload Font
	function nxt_ext_custom_upload_font( extension_type, session_fonts = []){
		let global_custom_font_session = session_fonts;
		//let upload_font_session = { font_name : '', lists : {} };
		var font_select_list = {'100' : 'Thin 100', '100i' : 'Thin 100 Italic','200' : 'Extra Light 200','200i' : 'Extra Light 200 Italic','300' : 'Light 300','300i' : 'Light 300 Italic','400' : 'Regular 400','400i' : 'Regular 400 Italic','500' : 'Medium 500','500i' : 'Medium 500 Italic','600' : 'Semi-Bold 600','600i' : 'Semi-Bold 600 Italic','700' : 'Bold 700','700i' : 'Bold 700 Italic','800' : 'Extra-Bold 800','800i' : 'Extra-Bold 800 Italic','900' : 'Bolder 900','900i' : 'Bolder 900 Italic'}
		//edit simple font
		nxt_edit_simple_font(extension_type, global_custom_font_session, font_select_list)
		nxt_remove_simple_font(global_custom_font_session,extension_type)

		//simple button
		var simple_font = document.querySelector('.nxt-ext-simple-font-upload');
		if(simple_font){
			simple_font.addEventListener( 'click', e => {
				e.preventDefault();
                if(nexter_admin_config && !nexter_admin_config.is_pro && global_custom_font_session.length>=5){
                    var wrong_ID_msg = '<div class="nxt-wrong-msg-notice"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="15.75" stroke="#FC4032" stroke-width="0.5"/><circle cx="16" cy="16" r="12" fill="#FC4032"/><rect x="15" y="9" width="2" height="10" rx="1" fill="white"/><rect x="15" y="20" width="2" height="2" rx="1" fill="white"/></svg><a href="https://nexterwp.com/pricing" target="_blank" style="color:#000;font-weight:bold;">Upgrade to Pro</a>&nbsp;for more than 5 Custom Fonts!</div>';
                    var popSel = document.querySelector('.nxt-ext-pop-inner');
                    if(popSel){
                        popSel.insertAdjacentHTML('beforeend', wrong_ID_msg);
                        var notice_data = popSel.querySelector('.nxt-wrong-msg-notice');
                        if(notice_data){
                            setTimeout(function(){
                                notice_data.classList.add('active-notice');
                            },50);
                            setTimeout(function(){
                                notice_data.remove();
                            },6000);
                        }
                    }
                    return false;
                }
				var selector = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"]');
				if ( selector && !selector.classList.contains('active-simple-font')) {
					selector.classList.add('active-simple-font')
					var simple_font_wrap = selector.querySelector('.nxt-simple-font-wrapper')
					if(simple_font_wrap){
						var uid = Math.random().toString(16).slice(9)
						simple_font_wrap.setAttribute('data-uid',uid)
						window.upload_font_session = { font_name : '', lists : {} };
						var font_name = simple_font_wrap.querySelector('.nxt-custom-font-name')
						if( font_name ){
							font_name.value = '';
						}
						//change old variation
						change_old_variant();
						
						//add default variation
						add_default_simple_font_variation(document.querySelector('.nxt-simple-font-inner ul li.add-font-variation'), uid, '',font_select_list)
						//default variation action
						nxt_after_add_variant_action()
					}
				}
			})
		}

		//variable button
		var variable_font = document.querySelector('.nxt-ext-variable-font-upload');
		if(variable_font){
			variable_font.addEventListener( 'click', e => {
				e.preventDefault();
                if(nexter_admin_config && !nexter_admin_config.is_pro && global_custom_font_session.length>=5){
                    var wrong_ID_msg = '<div class="nxt-wrong-msg-notice"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="15.75" stroke="#FC4032" stroke-width="0.5"/><circle cx="16" cy="16" r="12" fill="#FC4032"/><rect x="15" y="9" width="2" height="10" rx="1" fill="white"/><rect x="15" y="20" width="2" height="2" rx="1" fill="white"/></svg><a href="https://nexterwp.com/pricing" target="_blank" style="color:#000;font-weight:bold;">Upgrade to Pro</a>&nbsp;for more than 5 Custom Fonts!</div>';
                    var popSel = document.querySelector('.nxt-ext-pop-inner');
                    if(popSel){
                        popSel.insertAdjacentHTML('beforeend', wrong_ID_msg);
                        var notice_data = popSel.querySelector('.nxt-wrong-msg-notice');
                        if(notice_data){
                            setTimeout(function(){
                                notice_data.classList.add('active-notice');
                            },50);
                            setTimeout(function(){
                                notice_data.remove();
                            },6000);
                        }
                    }
                    return false;
                }
				var selector = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"]');
				if ( selector && !selector.classList.contains('active-variable-font')) {
					selector.classList.add('active-variable-font')
					var variable_font_wrap = selector.querySelector('.nxt-variable-font-wrapper')
					if(variable_font_wrap){
						var uid = Math.random().toString(16).slice(9)
						variable_font_wrap.setAttribute('data-uid',uid)
						window.upload_font_session = { font_name : '', lists : {} };
						var font_name = variable_font_wrap.querySelector('.nxt-custom-font-name')
						if( font_name ){
							font_name.value = '';
						}
						//change old variation
						change_old_variant('variable');
						//add default variation
						add_default_variable_font(document.querySelector('.nxt-variable-font-inner ul'), uid )

						nxt_after_variable_choose_file_action();
					}
				}
			})
		}

		//back Simple/Variable font button
		var back_btn = document.querySelectorAll('.nxt-back-font')
		if(back_btn){
			back_btn.forEach( function(ele) {
				ele.addEventListener( 'click', e => {
					e.preventDefault();
					var selector = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"]'),
						ele_class = ele.classList,
						sel_class = selector.classList;
					if ( ele_class.contains('nxt-back-variable-font') && selector && sel_class.contains('active-variable-font')) {
						sel_class.remove('active-variable-font')
					}
					if ( ele_class.contains('nxt-back-simple-font') && selector && sel_class.contains('active-simple-font')) {
						sel_class.remove('active-simple-font')
					}
				})
			})
		}

		//simple font add variation
		var add_variant = document.querySelector('.add-more-font-variant');
		if(add_variant){
			add_variant.addEventListener('click', event => {
				event.preventDefault();
				var uid = Math.random().toString(16).slice(9)
				//add default variation
				add_default_simple_font_variation(add_variant.parentElement, uid, '', font_select_list)
				//default variation action
				nxt_after_add_variant_action()
			})
		}

		//simple font Remove Variation
		var simple_font_inner = document.querySelector('.nxt-simple-font-inner')
		if(simple_font_inner){
			simple_font_inner.addEventListener('click', event => {
				if (event.target.classList.contains('nxt-remove-variant')) {
					event.preventDefault();
					var parentEle = event.target.parentElement,
						lists = window.upload_font_session.lists,
					 	uid = get_data_attribute(parentEle,'data-uid');
					if( lists[uid] ){
						delete lists[uid]
					}
					window.upload_font_session.lists = lists
					parentEle.remove()
				}
			})
		}

		//save Simple Custom font
		var save_upload_font = document.querySelectorAll('.nxt-upload-btn-actions .nxt-save-font');
		if(save_upload_font){
			save_upload_font.forEach( function(font_type) {
				font_type.addEventListener('click', event => {
					event.preventDefault();
                    if(nexter_admin_config && !nexter_admin_config.is_pro && global_custom_font_session.length>=5){
                        var wrong_ID_msg = '<div class="nxt-wrong-msg-notice"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="15.75" stroke="#FC4032" stroke-width="0.5"/><circle cx="16" cy="16" r="12" fill="#FC4032"/><rect x="15" y="9" width="2" height="10" rx="1" fill="white"/><rect x="15" y="20" width="2" height="2" rx="1" fill="white"/></svg><a href="https://nexterwp.com/pricing" target="_blank" style="color:#000;font-weight:bold;">Upgrade to Pro</a>&nbsp;for more than 5 Custom Fonts!</div>';
                        var popSel = document.querySelector('.nxt-ext-pop-inner');
                        if(popSel){
                            popSel.insertAdjacentHTML('beforeend', wrong_ID_msg);
                            var notice_data = popSel.querySelector('.nxt-wrong-msg-notice');
                            if(notice_data){
                                setTimeout(function(){
                                    notice_data.classList.add('active-notice');
                                },50);
                                setTimeout(function(){
                                    notice_data.remove();
                                },6000);
                            }
                        }
                        return false;
                    }

                        var simple_type = false, variable_type = false, font_wrap = '', uid ='';
                        if( font_type.classList.contains('nxt-save-simple-font') ){
                            simple_type = true;
                            variable_type = false;
                            font_wrap = document.querySelector('.nxt-simple-font-wrapper'),
                            uid = get_data_attribute(font_wrap,'data-uid');
                        }
                        if( font_type.classList.contains('nxt-save-variable-font') ){
                            simple_type = false;
                            variable_type = true;
                            font_wrap = document.querySelector('.nxt-variable-font-wrapper'),
                            uid = get_data_attribute(font_wrap,'data-uid');
                        }

                        var font_name = font_wrap.querySelector('.nxt-custom-font-name')
                        if( font_name ){
                            window.upload_font_session.font_name = font_name.value
                        }
                        
                        if(window.upload_font_session && window.upload_font_session.font_name!='' && uid){
                            font_name.classList.remove('font-name-error')
                            if(simple_type){
                                var fonts = { simplefont : window.upload_font_session, variablefont : ''}
                            }else if(variable_type){
                                var fonts = { simplefont : '', variablefont : window.upload_font_session}
                            }

                            var check_obj = global_custom_font_session.some(obj => obj.hasOwnProperty(uid))
                            if(check_obj){
                                global_custom_font_session.some(obj2 => {
                                    if(obj2!==null && obj2.hasOwnProperty(uid)){
                                        obj2[uid] =fonts
                                    }
                                })
                            }else if(!check_obj){
                                let obj1 ={}
                                obj1[uid] = fonts
                                global_custom_font_session.push(obj1)
                            }

                            font_type.innerHTML = 'Saving...';
                            var request = new XMLHttpRequest();
                            request.open('POST', nexter_admin_config.ajaxurl, true);
                            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                            request.onload = function () {
                                if (request.status >= 200 && request.status < 400) {
                                    var response = JSON.parse(request.response);
                                    if(response.success == true){
                                        font_type.innerHTML = 'Save Font';

                                        var view_lists = document.querySelector('.nxt-custom-fonts-list');
                                        if(view_lists){
                                            view_lists.innerHTML = ""
                                            var output = '';
                                            var selector = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"]')
                                            if(simple_type){
                                                selector.classList.remove('active-simple-font')
                                            }else if(variable_type){
                                                selector.classList.remove('active-variable-font')
                                            }
                                            global_custom_font_session.forEach( fonts_data => {
                                                for (const key in fonts_data) {
                                                    if(fonts_data[key].simplefont && fonts_data[key].simplefont.font_name){
                                                        simple_type = true
                                                        variable_type = false
                                                    }else if(fonts_data[key].variablefont && fonts_data[key].variablefont.font_name){
                                                        simple_type = false
                                                        variable_type = true
                                                    }
                                                    output += '<li class="custom-font-list" data-type="'+((simple_type) ? 'simple' : 'variable')+'">';
                                                        if(simple_type){
                                                            var font_variant = '', simple_font_data = fonts_data[key].simplefont;
                                                            if(simple_font_data && simple_font_data.lists){
                                                                for(const list in simple_font_data.lists){
                                                                    font_variant += (simple_font_data.lists[list].variation) ? font_select_list[simple_font_data.lists[list].variation]+', ' : '';
                                                                }
                                                            }
                                                        }else if(variable_type){
                                                            var font_variant = '', simple_font_data = fonts_data[key].variablefont;
                                                            if(simple_font_data && simple_font_data.lists){
                                                                for(const list in simple_font_data.lists){
                                                                    font_variant += (simple_font_data.lists[list].id) ? list+', ' : '';
                                                                }
                                                            }
                                                        }
                                                        
                                                        output += '<div class="font-list-data-wrap">';
                                                            output += '<div class="custom-font-name-wrap">';
                                                                output += '<div class="font-name-type-wrap">';
                                                                    if(simple_type){
                                                                        output += '<span class="display-font-type">S</span>';
                                                                    }else if(variable_type){
                                                                        output += '<span class="display-font-type">V</span>';
                                                                    }
                                                                    output += '<span class="custom-font-name">'+simple_font_data.font_name+'</span>';
                                                                output += '</div>';
                                                                output += '<div class="custom-font-action"><a href="#" class="font-edit" data-uid="'+key+'"><svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 2H2C1.73478 2 1.48043 2.10536 1.29289 2.29289C1.10536 2.48043 1 2.73478 1 3V10C1 10.2652 1.10536 10.5196 1.29289 10.7071C1.48043 10.8946 1.73478 11 2 11H9C9.26522 11 9.51957 10.8946 9.70711 10.7071C9.89464 10.5196 10 10.2652 10 10V6.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.25 1.25011C9.44891 1.0512 9.7187 0.939453 10 0.939453C10.2813 0.939453 10.5511 1.0512 10.75 1.25011C10.9489 1.44903 11.0607 1.71881 11.0607 2.00011C11.0607 2.28142 10.9489 2.5512 10.75 2.75011L6 7.50011L4 8.00011L4.5 6.00011L9.25 1.25011Z" stroke-linecap="round" stroke-linejoin="round"/></svg></a><a href="#" class="font-remove" data-uid="'+key+'"><svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 3H2.5H10.5"  stroke-linecap="round" stroke-linejoin="round"/><path d="M4 3V2C4 1.73478 4.10536 1.48043 4.29289 1.29289C4.48043 1.10536 4.73478 1 5 1H7C7.26522 1 7.51957 1.10536 7.70711 1.29289C7.89464 1.48043 8 1.73478 8 2V3M9.5 3V10C9.5 10.2652 9.39464 10.5196 9.20711 10.7071C9.01957 10.8946 8.76522 11 8.5 11H3.5C3.23478 11 2.98043 10.8946 2.79289 10.7071C2.60536 10.5196 2.5 10.2652 2.5 10V3H9.5Z" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 5.5V8.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 5.5V8.5" stroke-linecap="round" stroke-linejoin="round"/></svg></a></div>';
                                                            output += '</div>';
                                                            output += '<div class="selected-variation-list">';
                                                                output += '<span class="custom-font-variant">Variation : '+font_variant+'</span>';
                                                            output += '</div>';
                                                        output += '</div>';
                                                    output += '</li>';
                                                }
                                            })
                                            view_lists.insertAdjacentHTML('afterbegin', output);

                                            nxt_edit_simple_font(extension_type, global_custom_font_session, font_select_list)
                                            nxt_remove_simple_font(global_custom_font_session, extension_type)
                                        }
                                    }
                                }
                            };
                            request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&fonts=' + JSON.stringify(global_custom_font_session) +'&extension_type=' + extension_type);
                        }else{
                            if(font_name){
                                font_name.classList.add('font-name-error')
                            }
                        }
				})
			})
		}
	}

	function change_old_variant(type = 'simple'){
		var variant = document.querySelectorAll('.nxt-'+type+'-font-inner ul li[data-uid]');
		if(variant){
			variant.forEach( function(ele) {
				ele.remove()
			})
		}
	}

	function dynamic_select_options(select_list, val=''){
		var output ='<select class="nxt-font-variation-list">';
		output +='<option value="" '+(val=='' ? 'selected="selected"' : '')+'>Select Variation</option>';
		if(select_list){
			for(const list in select_list){
				output +='<option value="'+list+'" '+(val==list ? 'selected="selected"' : '')+'>'+select_list[list]+'</option>';
			}
		}
		output +='</select>';

		return output
	}

	function add_default_simple_font_variation(ele, uid, file_val = '', select_list, val='', file_name = '', is_edit = false){
		if(ele && uid){
			var choose_file = (file_name) ? '<span class="nxt-choose-file-name">'+file_name+'</span>' : '<span class="nxt-choose-file-name">Choose File...</span>';
			ele.insertAdjacentHTML( 'beforebegin', '<li data-uid="'+(is_edit ? uid : 'f'+uid)+'"><label class="simple-font-choose-label">'+choose_file+'<button class="simple-font-file" '+(file_val !='' ? 'value="'+file_val+'"' : '')+'>Choose File</button></label>'+dynamic_select_options(select_list, val)+'<div class="nxt-remove-variant">×</div></li>' );
		}
	}
	function nxt_after_add_variant_action(){
		var choose_upload = document.querySelectorAll('.simple-font-file:not(.load-choose)');
		if(choose_upload){
			choose_upload.forEach( function(ele) {
				nxt_simple_font_choose(ele)
			})
		}
		var change_variation = document.querySelectorAll('.nxt-font-variation-list:not(.load-select)');
		if(change_variation){
			change_variation.forEach( function(ele) {
				nxt_select_onchange_variation(ele)
			})
		}
	}


	function add_default_variable_font(ele, uid, reg_file_val = '', reg_file_name = '', ita_file_val = '', ita_file_name = '', is_edit = false){
		if(ele && uid){
			var reg_choose_file = (reg_file_name) ? '<span class="nxt-choose-file-name">'+reg_file_name+'</span>' : '<span class="nxt-choose-file-name">Choose Regular File...</span>';
			var italic_choose_file = (ita_file_name) ? '<span class="nxt-choose-file-name">'+ita_file_name+'</span>' : '<span class="nxt-choose-file-name">Choose Italic File...</span>';
			ele.insertAdjacentHTML( 'afterbegin', '<li data-uid="'+(is_edit ? uid : 'f'+uid)+'"><div class="variable-normal-choose-file" data-uid="regular"><label>Regular</label><label class="variable-font-choose-label">'+reg_choose_file+'<button class="variable-regular-file" '+(reg_file_val !='' ? 'value="'+reg_file_val+'"' : '')+'>Choose File</button></label></div><div class="variable-italic-choose-file" data-uid="italic"><label>Italic</label><label class="variable-font-choose-label">'+italic_choose_file+'<button class="variable-italic-file" '+(ita_file_val !='' ? 'value="'+ita_file_val+'"' : '')+'>Choose File</button></label></div></li>' );
		}
	}

	function nxt_after_variable_choose_file_action(){
		var choose_regular = document.querySelectorAll('.variable-regular-file:not(.load-choose)');
		if(choose_regular){
			choose_regular.forEach( function(ele) {
				nxt_simple_font_choose(ele, 'variable')
			})
		}
		var choose_italic = document.querySelectorAll('.variable-italic-file:not(.load-choose)');
		if(choose_italic){
			choose_italic.forEach( function(ele) {
				nxt_simple_font_choose(ele, 'variable')
			})
		}
	}
	
	
	function nxt_remove_simple_font(global_custom_font_session, extension_type){
		var remove_font = document.querySelectorAll('.custom-font-action .font-remove');
		if(remove_font){
			remove_font.forEach( function(ele) {
				ele.addEventListener( 'click', e => {
					e.preventDefault();
					if(confirm("Are You Sure Remove Font?")){
						var uid = e.currentTarget.getAttribute('data-uid')
						if(uid && global_custom_font_session){
							for(const item_key in global_custom_font_session){
								for(const key in global_custom_font_session[item_key]){
									if(key===uid){
										global_custom_font_session.splice(item_key, 1); 
										e.currentTarget.closest('.custom-font-list').remove()
										if(global_custom_font_session.length == 0){
											var custom_font_list = document.querySelector('.nxt-custom-fonts-list');
											if(custom_font_list){
												custom_font_list.insertAdjacentHTML( 'beforebegin','<li class="empty-font-list"><div class="empty-font-text">So Sorry!! We are not able to find what you are looking for please add the font</div></li>' );
											}
										}
										var request = new XMLHttpRequest();
										request.open('POST', nexter_admin_config.ajaxurl, true);
										request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
										request.onload = function () {
											if (request.status >= 200 && request.status < 400) {
												var response = JSON.parse(request.response);
												if(response.success == true){
												}
											}
										};
										request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&fonts=' + JSON.stringify(global_custom_font_session) +'&extension_type=' + extension_type);
									}
								}
							}
						}
					}
				})
			})
		}
	}

	function nxt_edit_simple_font(extension_type, global_custom_font_session, font_select_list){
		var edit_font = document.querySelectorAll('.custom-font-action .font-edit');
		if(edit_font){
			edit_font.forEach( function(ele) {
				ele.addEventListener( 'click', e => {
					e.preventDefault();
					var uid = e.currentTarget.getAttribute('data-uid')
					if(uid && global_custom_font_session){
						global_custom_font_session.some(obj => {
							if(obj.hasOwnProperty(uid)){
								var selector = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"]'),
									type_selector = e.currentTarget.closest('.custom-font-list'),
									font_type = type_selector.getAttribute('data-type'),
									font_wrap = '';
									if(font_type == 'simple'){
										selector.classList.add('active-simple-font')
										font_wrap = selector.querySelector('.nxt-simple-font-wrapper')
										
									}else if(font_type == 'variable'){
										selector.classList.add('active-variable-font')
										font_wrap = selector.querySelector('.nxt-variable-font-wrapper')
									}
								
								font_wrap.setAttribute('data-uid',uid)
								
								var font_name = font_wrap.querySelector('.nxt-custom-font-name')
								var upload_font_session = '';
								if( font_type == 'simple' && font_name && obj[uid].simplefont && obj[uid].simplefont.font_name ){
									font_name.value = obj[uid].simplefont.font_name
									upload_font_session = obj[uid].simplefont
								}else if(font_type == 'variable' && font_name && obj[uid].variablefont && obj[uid].variablefont.font_name){
									font_name.value = obj[uid].variablefont.font_name
									upload_font_session = obj[uid].variablefont
								}
								
								window.upload_font_session = upload_font_session
								if(font_type == 'simple'){
									//change old variation
									change_old_variant();
									//edit variation list 
									for(const edit_varient in upload_font_session.lists){
										add_default_simple_font_variation(document.querySelector('.nxt-simple-font-inner ul li.add-font-variation'), edit_varient, upload_font_session.lists[edit_varient].id, font_select_list, upload_font_session.lists[edit_varient].variation, upload_font_session.lists[edit_varient].filename, true)
									}
									//default variation action
									nxt_after_add_variant_action()
								}else if(font_type == 'variable'){
									//change old variation
									change_old_variant('variable');
									var reg_file_val = (upload_font_session.lists.regular && upload_font_session.lists.regular.id) ? upload_font_session.lists.regular.id : '',
										reg_file_name = (upload_font_session.lists.regular && upload_font_session.lists.regular.filename) ? upload_font_session.lists.regular.filename : '',
										ita_file_val = (upload_font_session.lists.italic && upload_font_session.lists.italic.id) ? upload_font_session.lists.italic.id : '',
										ita_file_name = (upload_font_session.lists.italic && upload_font_session.lists.italic.filename) ? upload_font_session.lists.italic.filename : '';
									add_default_variable_font(document.querySelector('.nxt-variable-font-inner ul'), uid, reg_file_val, reg_file_name, ita_file_val, ita_file_name, true)
									
									//default variation action
									nxt_after_variable_choose_file_action();
								}
								
							}
						})
					}
				})
			})
		}
	}

	function get_data_attribute(ele, data = null){
		if(ele && data){
			return ele.getAttribute(data);
		}
		return '';
	}

	function nxt_select_onchange_variation(ele){
		if(!ele.classList.contains('load-select')){
			ele.classList.add('load-select');
			ele.addEventListener('change', event => {
				var parentEle = event.target.parentElement,
					lists = window.upload_font_session.lists,
					uid = get_data_attribute(parentEle,'data-uid');
				if( !lists[uid] ){
					lists[uid] = Object.create( {} );
					lists[uid].variation = event.currentTarget.value;
				}else{
					lists[uid].variation = event.currentTarget.value;
				}
				window.upload_font_session.lists = lists
			})
		}
	}

	function nxt_simple_font_choose(ele, font_type = 'simple'){
		if(!ele.classList.contains('load-choose')){
			ele.classList.add('load-choose');
			ele.addEventListener('click', event => {
				event.preventDefault();
				var button = event.currentTarget,
				custom_uploader = wp.media({
					multiple: false
				}).on('select', function() {
					var attachment = custom_uploader.state().get('selection').first().toJSON();
					if(attachment && (attachment.type=='font' || attachment.type=='application')){
						button.value = attachment.id;
						button.innerHTML = 'Change';
						if(!button.previousElementSibling){
							button.insertAdjacentHTML('beforebegin', '<span class="nxt-choose-file-name">'+attachment.filename+'</span>');
						}else if(!button.previousElementSibling.classList.contains('nxt-choose-file-name')){
							button.insertAdjacentHTML('beforebegin', '<span class="nxt-choose-file-name">'+attachment.filename+'</span>');
						}else{
							button.previousElementSibling.innerHTML = attachment.filename
						}
						if(window.upload_font_session.lists){
							let lists = window.upload_font_session.lists,
								parentEle = (font_type=='variable') ? ele.parentElement.parentElement : ele.parentElement.parentElement,
								uid = get_data_attribute(parentEle,'data-uid');;
							if( !lists[uid] ){
								lists[uid] = Object.create( {} );
								lists[uid].id = attachment.id;
								lists[uid].filename = attachment.filename
							}else{
								lists[uid].id = attachment.id;
								lists[uid].filename = attachment.filename
							}
							window.upload_font_session.lists = lists
						}
					}else{
						if(button.previousElementSibling.classList.contains('nxt-choose-file-name')){
							button.previousElementSibling.remove();
							button.innerHTML = 'Choose';
						}
					}
				}).open();
			})
		}
	}
	/*Local Google Font*/

	/* WP Replace URL Start */
	function nxtWPReplaceUrl(extension_type){ 
		let nxtWPLoginPop = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"]');
		
		let mainW = nxtWPLoginPop.querySelector('.nxt-replace-url-wrap');
		if(mainW){
			let oldurl = mainW.getElementsByClassName('nxt-old-url'),
				newurl = mainW.getElementsByClassName('nxt-new-url'),
				caseS = mainW.querySelector('#case_sensitive_toggle'),
				
				btnA = mainW.querySelector('.nxt-replace-url-btn');
				
				btnA.addEventListener('click', function(e){
					e.preventDefault();
					if(oldurl[0].value && newurl[0].value){
						var fromVal = oldurl[0].value,
							toVal = newurl[0].value,
							aNonce = nexter_admin_config.ajax_nonce;
						var request = new XMLHttpRequest();
							request.open('POST', nexter_admin_config.ajaxurl, true);
							request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
						
						let caseSen = '';
							if(caseS.checked){ caseSen = "yes"; }else{ caseSen = "no"; }
								
						request.onload = function () {
							if (request.status >= 200 && request.status < 400) {
								var response = JSON.parse(request.response);
								let noteP = mainW.querySelector('.nxt-replace-url-notice');
								if(response.success == true){
									
									if(response.data.result!=0){
										noteP.classList.add('nxt-result-visible');
										//noteP.innerHTML = response.data.result+" Result(s) Found. Click Confirm Button to Replace.";
										
										noteP.innerHTML = `<span>${response.data.result} Result(s) Found.</span><span>Click Confirm Button to Replace.</span>`
										
										let cBtn = mainW.querySelector('.nxt-replace-url-confirm-btn');
										cBtn.classList.add('visible');
										
										replaceConfirmUrl(cBtn,aNonce,fromVal,toVal,caseSen,noteP)
									}else{
										noteP.innerHTML = `<span>${response.data.result} Result(s) Found.</span>`;
										noteP.classList.add('nxt-note-visible');
										setTimeout(function(){
											noteP.classList.remove('nxt-note-visible');
											noteP.innerHTML = "";
										},5000);
									}
									
								}else if(response.success == false){
									if(response.data.message){
										noteP.innerHTML = `<span>${response.data.message}</span>`;
										noteP.classList.add('nxt-note-visible');
										
										setTimeout(function(){
											noteP.classList.remove('nxt-note-visible');
											noteP.innerHTML = "";
										},5000);
										
									}
								}
							}
						};
						request.send('action=nxt_replace_url&nexter_nonce='+aNonce+'&from='+fromVal+'&to='+toVal+'&case='+caseSen);
					}else{
                        var wrong_ID_msg = '<div class="nxt-wrong-msg-notice"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="15.75" stroke="#FC4032" stroke-width="0.5"/><circle cx="16" cy="16" r="12" fill="#FC4032"/><rect x="15" y="9" width="2" height="10" rx="1" fill="white"/><rect x="15" y="20" width="2" height="2" rx="1" fill="white"/></svg> Please Enter Old And New Url</div>';
                        var popSel = document.querySelector('.nxt-ext-pop-inner');
                        if(popSel){
                            popSel.insertAdjacentHTML('beforeend', wrong_ID_msg);
                            var notice_data = popSel.querySelector('.nxt-wrong-msg-notice');
                            if(notice_data){
                                setTimeout(function(){
                                    notice_data.classList.add('active-notice');
                                },50);
                                setTimeout(function(){
                                    notice_data.remove();
                                },3000);
                            }
                        }
					}
					
				});
		}
	}


	/* Right Click Disable Function Start */
	function nxtWPRightClickDisable(extension_type){
		let nxtWPRightClick = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"]');
		let wpDisableSet = {};
		
		jQuery(document).ready(function($){
			$('input.nxt-color-pick-field').wpColorPicker();
		});
		
		
		let nxtWpDWrap = nxtWPRightClick.querySelectorAll('.nxt-wp-disable-wrap');
		nxtWpDWrap.forEach( function(nW) {
			if(nW.querySelector('.nxt-dis-input')){
				let inpBtn = nW.querySelector('.nxt-dis-input');

				if(inpBtn && inpBtn.checked){
					inpBtn.closest('.nxt-wp-disable-wrap').classList.add("active");
				}

				if(inpBtn){
					inpBtn.addEventListener("click",function(e){
						let dwrap = e.currentTarget.closest('.nxt-wp-disable-wrap');
						if(e.currentTarget.checked){
							dwrap.classList.add("active");
						}else{
							dwrap.classList.remove("active");
						}
					});
				}
			}
		});

		let nxtWPBtn = nxtWPRightClick.querySelector('.nxt-wp-disable-set-btn');
		nxtWPBtn.addEventListener('click', function(){

			let allOp = ['disable-r-click','disable-drag','disable-dev-key','disable-ser-key','disable-ctrlc-key','disable-ctrlv-key','disable-ctrla-key','disable-ctrlu-key','disable-ctrlp-key','disable-ctrlh-key','disable-ctrll-key','disable-ctrlk-key','disable-ctrlo-key','disable-ctrle-key','disable-altd-key','disable-f3-key','disable-f6-key','disable-f12-key'];
			
			let allSty = ['msg-bg-color','msg-title-color','msg-desc-color','msg-icon-color','msg-border-color','msg-icon-bg-progress'];

			let accU =[], accUser = nxtWPRightClick.querySelectorAll('input[name=nxt-e-access]');
			accUser.forEach(function(acc){
				if(acc.checked){
					accU.push(acc.value);
				}
			});
			if(accU){
				wpDisableSet = Object.assign({"disable_access" : accU});
			}
			var arraDop = [];
			allOp.forEach(function(all){
				let allTg = nxtWPRightClick.querySelector('.nxt-'+all),
				inCheck = allTg.querySelector('input[type="checkbox"]').checked,
				inText = allTg.querySelector('input[type="text"]').value,
				msgOp = all+"-msg";

				arraDop[all] = inCheck;
				arraDop[msgOp] = inText;
			});

			arraDop = Object.assign({}, arraDop);
			wpDisableSet = Object.assign( arraDop ,wpDisableSet);
			
			var arraDsty = [];
			allSty.forEach(function(all){
				let allTg = nxtWPRightClick.querySelector('.nxt-disable-'+all),
				inText = allTg.querySelector('input[type="text"]').value;
				
				arraDsty[all] = inText;
			});

			arraDsty = Object.assign({}, arraDsty);
			wpDisableSet = Object.assign( arraDsty ,wpDisableSet);
			
			let alertPos = nxtWPRightClick.querySelector('.disable-alert-pos');
			if(alertPos && alertPos.value){
				wpDisableSet = Object.assign( {'alert-pos' : alertPos.value } ,wpDisableSet);
			}else{
				wpDisableSet = Object.assign( {'alert-pos' : 'top_right' } ,wpDisableSet);
			}
			let alertDisTime = nxtWPRightClick.querySelector('.nxt-alert-disappear');
			if(alertDisTime && alertDisTime.value){
				wpDisableSet = Object.assign( {'alert-dis-time' : Number(alertDisTime.value) } ,wpDisableSet);
			}else{
				wpDisableSet = Object.assign( {'alert-dis-time' : '' } ,wpDisableSet);
			}

			var wpDisableSetN = JSON.stringify(wpDisableSet);
			
			var request = new XMLHttpRequest();
			request.open('POST', nexter_admin_config.ajaxurl, true);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
			nxtWPBtn.innerHTML = 'Saving...';
			request.onload = function () {
				if (request.status >= 200 && request.status < 400) {
					var response = JSON.parse(request.response);
					if(response.success == true){
						nxtWPBtn.innerHTML = 'Saved';
						setTimeout(function(){
							nxtWPBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round" ><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>Save';
						},2000);
					}
				}
			};
			request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&wpDisableSet=' + wpDisableSetN+'&extension_type=' + extension_type);


		});
	}
	/* Right Click Disable Function End */

	/* Replace Confirm URL Function */
	function replaceConfirmUrl(btn,nonce,fromV,toV,caseS,ntP){
		btn.addEventListener("click", function(){
			var request = new XMLHttpRequest();
				request.open('POST', nexter_admin_config.ajaxurl, true);
				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				request.onload = function () {
					if (request.status >= 200 && request.status < 400) {
						var response = JSON.parse(request.response);
						if(response.success == true){
							ntP.classList.add('nxt-confirm-res');
							ntP.innerHTML = `<span>${response.data.result} Record(s)</span><span>Replace Successfully.</span>`;
							btn.classList.remove('visible');
							setTimeout(function(){
								ntP.classList.remove('nxt-result-visible');
								ntP.classList.remove('nxt-confirm-res');
							},4000);
						}else if(response.success == false){
							
						}
					}
				}
			request.send('action=nxt_replace_confirm_url&nexter_nonce='+nonce+'&from='+fromV+'&to='+toV+'&case='+caseS);
			
		});
	}
	
	/* WP Replace URL End */

	/* Hide Admin Settings Start */
	function nxtDisAdminPop(extension_type){
		var save_btn = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"] .nxt-save-disable-admin');
		if(save_btn){
			save_btn.addEventListener('click', event => {
				event.preventDefault();
				let adminHideL = [];
				let disable_option = document.getElementsByName('nxt-disable-admin[]');
				if(disable_option){
					for (var i=0, n=disable_option.length;i<n;i++) {
						if (disable_option[i].checked) {
							adminHideL.push(disable_option[i].value);
						}
					}
					
					let adminHideLS = JSON.stringify(adminHideL);
					save_btn.innerHTML = 'Saving...';
					var request = new XMLHttpRequest();
					request.open('POST', nexter_admin_config.ajaxurl, true);
					request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
					request.onload = function () {
						if (request.status >= 200 && request.status < 400) {
							var response = JSON.parse(request.response);
							if(response.success == true){
								save_btn.innerHTML = 'Saved';
								setTimeout(function(){
									save_btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round" ><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>Save';
								}, 2000);
							}
						}
					};
					request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&adminHide=' + adminHideLS+'&extension_type=' + extension_type);
				}
			})
		}
		
	}
	/* Hide Admin Settings End */
	/* Duplicate Post Function Start */
	function nxt_ext_duplicate_post(extension_type){
		let nxtWPDupPost = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"]');
		let wpDupPostSet = {};

		let nxtWPBtn = nxtWPDupPost.querySelector('.nxt-duplicate-post-set');
		
		nxtWPBtn.addEventListener('click', function(){
			let allOp = ['nxt-duppost-access','nxt-duppost-author','nxt-duppost-date'];
			var arrDpValue = [];
			allOp.forEach(function(all){
				let allTg = nxtWPDupPost.querySelectorAll('.'+all+' input');
				allTg.forEach(function(acc){
					if(acc.checked){
						arrDpValue[all] = acc.value;
					}
				});
			});
			arrDpValue = Object.assign({}, arrDpValue);

			let dPostStatus = nxtWPDupPost.querySelector('.duplicate-post-status');
			if(dPostStatus && dPostStatus.value){
				wpDupPostSet = Object.assign( {'nxt-duppost-status' : dPostStatus.value } ,wpDupPostSet);
			}else{
				wpDupPostSet = Object.assign( {'nxt-duppost-status' : 'same' } ,wpDupPostSet);
			}

			let allInp = ['nxt-duplicate-postfix','nxt-duplicate-slug'];
			allInp.forEach(function(all){
				let allTg = nxtWPDupPost.querySelectorAll('.'+all);
				if(allTg){
					arrDpValue[all] = allTg[0].value;
				}
				
			});
			arrDpValue = Object.assign(arrDpValue, arrDpValue);
			wpDupPostSet = Object.assign( arrDpValue ,wpDupPostSet);

			var wpDupPostSetN = JSON.stringify(wpDupPostSet);
			
			var request = new XMLHttpRequest();
			request.open('POST', nexter_admin_config.ajaxurl, true);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
			nxtWPBtn.innerHTML = 'Saving...';
			request.onload = function () {
				if (request.status >= 200 && request.status < 400) {
					var response = JSON.parse(request.response);
					if(response.success == true){
						nxtWPBtn.innerHTML = 'Saved';
						setTimeout(function(){
							nxtWPBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round" ><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>Save';
						},2000);
					}
				}
			};
			request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&wpDupPostSet=' + wpDupPostSetN+'&extension_type=' + extension_type);

		});

	}
	/* Duplicate Post Function End */
	/* Adobe Font */
	function nxt_ext_adobe_font(extension_type){
		var save_btn = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"] .nxt-sync-save-adobe-font');
		if(save_btn){
			save_btn.addEventListener('click', event => {
				event.preventDefault();
				let project_id = document.getElementsByName('nxt-adobe-project-id');
				if(project_id && project_id[0] && project_id[0].value){
					var request = new XMLHttpRequest();
						request.open('POST', nexter_admin_config.ajaxurl, true);
						request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
						save_btn.innerHTML = 'Checking...';
						request.onload = function () {
							if (request.status >= 200 && request.status < 400) {
								var response = JSON.parse(request.response);
								var adobe_section = document.querySelector('.nxt-adobe-font-section');
								if(response.success == true){
									save_btn.innerHTML = 'Saved';
									if(response.data && response.data.settings && response.data.settings.render){
										if(adobe_section){
											var adobe_list = adobe_section.querySelector('.nxt-adobe-font-list');
											if(adobe_list){
												adobe_list.remove();
											}
											adobe_section.insertAdjacentHTML('beforeend', response.data.settings.render);
										}
									}
								}else{
									if(adobe_section){
										var wrong_ID_msg = '<div class="nxt-wrong-msg-notice"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="15.75" stroke="#FC4032" stroke-width="0.5"/><circle cx="16" cy="16" r="12" fill="#FC4032"/><rect x="15" y="9" width="2" height="10" rx="1" fill="white"/><rect x="15" y="20" width="2" height="2" rx="1" fill="white"/></svg>Sorry!!! Please check your Project ID in adobe kit</div>';
										adobe_section.insertAdjacentHTML('beforeend', wrong_ID_msg);
										var notice_data = adobe_section.querySelector('.nxt-wrong-msg-notice');
										if(notice_data){
											setTimeout(function(){
												notice_data.classList.add('active-notice');
											},50);
											setTimeout(function(){
												notice_data.remove();
											},3000);
										}
										var adobe_list = adobe_section.querySelector('.nxt-adobe-font-list');
										if(adobe_list){
											adobe_list.remove();
										}
									}
								}
								setTimeout(function(){
									save_btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round" ><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>Get Font';
								},800);
							}
						};
						request.send('action=nexter_ext_save_adobe_font_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&project_id=' + project_id[0].value+'&extension_type=' + extension_type);
				}
			})
		}
	}
	/* Adobe Font */

	/* Advance Performance */
	function nxtadvanceperfo(extension_type){
		var save_btn = document.querySelector('.nxt-ext-setting-pop[data-type="'+extension_type+'"] .nxt-save-advance-performance');
		if(save_btn){
			save_btn.addEventListener('click', event => {
				event.preventDefault();
				let advperfo = [];
				let disable_option = document.getElementsByName('nxt-advance-performance[]');
				if(disable_option){
					for (var i=0, n=disable_option.length;i<n;i++) {
						if (disable_option[i].checked) {
							advperfo.push(disable_option[i].value);
						}
					}
					
					let performance = JSON.stringify(advperfo);
					save_btn.innerHTML = 'Saving...';
					var request = new XMLHttpRequest();
					request.open('POST', nexter_admin_config.ajaxurl, true);
					request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
					request.onload = function () {
						if (request.status >= 200 && request.status < 400) {
							var response = JSON.parse(request.response);
							if(response.success == true){
								save_btn.innerHTML = 'Saved';
								setTimeout(function(){
									save_btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round" ><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>Save';
								}, 2000);
							}
						}
					};
					request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&advanceperfo=' + performance+'&extension_type=' + extension_type);
				}
			})
		}
		
	}
	/* Advance Performance */
	/* Google Recaptcha */
	function nxt_ext_recaptch(extension_type){
		var recapsave = document.querySelector('.nxt-recaptcha-save'),
		recapWrap = document.querySelector('.nxt-recaptch-wrap'),
		nxtrecap = recapWrap.querySelector('#nxtrecapver'),
		testDiv = '';

		if(nxtrecap){
			nxtrecap.addEventListener('click', e => {
				e.preventDefault();
				document.querySelector('.nxtcptch-test-results').remove();
				
				let newdiv = document.createElement("div");
				newdiv.setAttribute( 'id' , 'nxtcptch-test-block' );
				newdiv.setAttribute( 'class' , 'nxtcptch-test-recap' );

				if( document.getElementById('nxtcptch-test-block') == null ){
					nxtrecap.parentNode.insertBefore( newdiv , nxtrecap.nextSibling );
				}
				let testDiv = document.getElementById('nxtcptch-test-block')

				var request = new XMLHttpRequest();
				request.open('POST', nexter_admin_config.ajaxurl, true);
				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				request.onload = function () {
					if (request.status >= 200 && request.status < 400) {
						var response = JSON.parse(request.response);
						if(response.success == true && response.data.content != ''){
							testDiv.innerHTML = response.data.content;
							nxtrecap.style.display = 'none';
						}

						var elements = document.querySelectorAll('.nexter-recaptcha-v2,.nexter-recaptcha-invisible');
						
						if(elements.length != 0){
							elements.forEach( el => {
								var divid =  el.getAttribute('data-id'),
									recpdiv = el.querySelector('.nexter-recaptcha')
								
								if( recpdiv != null ){
									nxtrecptchDisplay(divid);

									if(el.classList.contains('nexter-recaptcha-invisible')){
										var index = recpdiv.getAttribute( 'data-nxtcptch-index' );
										grecaptcha.execute( index );
									}
								}
							})
						}else{
							nxtrecptchprepare();
						}
						nxt_varify_key();
					}
				};
				request.send('action=nxtcptch_test_keys&nexter_nonce=' + nexter_admin_config.ajax_nonce);
			})
		}

		

		if(recapsave){
			recapsave.addEventListener('click', e => {
				e.preventDefault();
				var recpver = recapWrap.querySelector( 'input[name=nexter_recaptcha_version]:checked'),
					recasiteKey = recapWrap.querySelector('input[name=nexter_re_public_key]'),
					recasecKey = recapWrap.querySelector('input[name=nexter_re_private_key]'),
					recapveri = recapWrap.querySelector('input[name=recaptch_verify]'),
					recapena = document.getElementsByName('nexter_recaptcha_enable'),
					recptheme = recapWrap.querySelector( 'input[name=nexter_recaptcha_theme]:checked'),
					recpinvi = recapWrap.querySelector( 'input[name=nexter_recaptcha_invisi]:checked'),
					recapData = { version : '' , siteKey : '' , secretKey : '' , formType : [] , invisi : '' , keyverify : '' , recapTheme : '' };

				if(recpver && recpver.value){
					recapData.version = recpver.value
				}
				if(recasiteKey && recasiteKey.value ){
					recapData.siteKey = recasiteKey.value;
				}
				if(recasiteKey && recasecKey.value ){
					recapData.secretKey = recasecKey.value;
				}
				if(recapena){
					for(var i = 0; i < recapena.length; i++){
						recapena[i].checked ? recapData.formType.push(recapena[i].value):"";
					}
				}
				if(recpinvi && recpinvi.value ){
					recapData.invisi = recpinvi.value;
				}
				
				if(recapveri && recapveri.value ){
					recapData.keyverify = recapveri.value;
				}

				if(recptheme && recptheme.value){
					recapData.recapTheme = recptheme.value
				}

				if(recapData){
					recapsave.innerHTML = 'Saving...';
					var request = new XMLHttpRequest();
					request.open('POST', nexter_admin_config.ajaxurl, true);
					request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
					request.onload = function () {
						if (request.status >= 200 && request.status < 400) {
							var response = JSON.parse(request.response);
							if(response.success == true){
								recapsave.innerHTML = 'Saved';
								location.reload();
							}
						}
					};
					request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&recapData=' + JSON.stringify(recapData) +'&extension_type=' + extension_type);
				}
			})
		}

	}
	
	function nxt_varify_key(){
		var nxttest = document.getElementById('nxt_verfiy_btn');
		if(nxttest){
			nxttest.addEventListener('click', e => {
				e.preventDefault();
				var recapWrap = document.querySelector('.nxt-recaptch-wrap'), 
				recasiteKey = recapWrap.querySelector('input[name=nexter_re_public_key]'),
				recasecKey = recapWrap.querySelector('input[name=nexter_re_private_key]'),
				nxtreDiv = document.getElementById('nxtcptch-test-block'),
				nxtvnonce = document.getElementsByName('nxt_verify_nonce'),
				recapveri = recapWrap.querySelector('input[name=recaptch_verify]'),
				nxtcheck = document.querySelectorAll('.nxt-verify-icon'),
				recpres = document.getElementById('g-recaptcha-response');
				
				if(recasiteKey && !recasiteKey.value){
					nxtreDiv.children[0].innerHTML = 'Site Key Is Empty'
				}else if(recasecKey && !recasecKey.value){
					nxtreDiv.children[0].innerHTML = 'Secret Key Is Empty'
				}

				if( recasiteKey.value && recasecKey.value ){ //&& recpres.value 
					nxttest.innerHTML = 'Verifying...'
					var request = new XMLHttpRequest();
					request.open('POST', nexter_admin_config.ajaxurl, true);
					request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
					request.onload = function () {
						if (request.status >= 200 && request.status < 400) {
							var response = JSON.parse(request.response);
							if(response.success == true && response.data.content ){
								recapveri.value = true
								nxtreDiv.innerHTML = response.data.content

								nxtcheck.forEach( el => {
									el.style.display = 'inline-block';
								})

							}
						}
					};
					request.send('action=nexter_verify_recptch_key&nexter_nonce=' + nxtvnonce[0].value +'&recasiteKey=' + recasiteKey.value + '&recasecKey=' + recasecKey.value + '&g-recaptcha-response='+recpres.value);
				}

			})
		}
	}
	/* Google Recaptcha */
	/* comment Form */
	function nxtComment(extension_type){
		var commentsele = document.querySelector('.nxt-disable-comment'),
			comsave = document.querySelector('.nxt-save-comment'),
			commdata = { disable_comments : '' };
		if(commentsele && commentsele !== null ){
			commentsele.addEventListener('change' , function(){
				var nextDiv = this.nextSibling;
				if( this.value && this.value == 'custom'){
					if(nextDiv && !nextDiv.classList.contains('nxt-slide-down')){
						nextDiv.classList.add('nxt-slide-down')
					}
				}else{
					if(nextDiv && nextDiv.classList.contains('nxt-slide-down')){
						setTimeout(function() {
							nextDiv.classList.remove('nxt-slide-down');
						}, 300)
					}
				}
			});
		}

		comsave.addEventListener('click', e => {
			e.preventDefault();

			if(commentsele){
				commdata.disable_comments = commentsele.value;
			}

			let dispost = [];
			let disable_option = document.getElementsByName('nxt-disable-comment[]');
			if(disable_option){
				for (var i=0, n=disable_option.length;i<n;i++) {
					if (disable_option[i].checked) {
						dispost.push(disable_option[i].value);
					}
				}
			}
			if(dispost.length > 0){
				commdata = Object.assign( {'disble_custom_post_comments' : dispost } ,commdata);
			}
			
			let commentData = JSON.stringify(commdata);
			comsave.innerHTML = 'Saving...';
			var request = new XMLHttpRequest();
			request.open('POST', nexter_admin_config.ajaxurl, true);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
			request.onload = function () {
				if (request.status >= 200 && request.status < 400) {
					var response = JSON.parse(request.response);
					if(response.success == true){
						comsave.innerHTML = 'Saved';
						setTimeout(() => {
							comsave.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round" ><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>Save';
						}, 1500);
					}
				}
			};
			request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&discomment=' + commentData+'&extension_type=' + extension_type);
		})

	}
	/* comment Form */
	/* Advance security */
	function nxtadSecurity(extension_type){
		var advSec = document.querySelector('.nxt-save-advance-security');

		if(advSec && advSec != null){
			advSec.addEventListener( 'click' , e => {
				e.preventDefault();
				let secukey = {};
				let secOpt = document.getElementsByName('nxt-advance-security[]'),
					diapi = document.querySelector('.nxt-disable-api'),
					secdata = [];
				if(secOpt){
					for (var i=0, n=secOpt.length;i<n;i++) {
						if (secOpt[i].checked) {
							secdata.push(secOpt[i].value);
						}
					}
				}
				secukey = Object.assign({}, secdata);
				secukey = Object.assign( secukey ,secukey);
				if(diapi && diapi.value){
					secukey = Object.assign( {'disable_rest_api' : diapi.value } ,secukey);
				}

				let securData = JSON.stringify(secukey);
				advSec.innerHTML = 'Saving...';
				var request = new XMLHttpRequest();
				request.open('POST', nexter_admin_config.ajaxurl, true);
				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				request.onload = function () {
					if (request.status >= 200 && request.status < 400) {
						var response = JSON.parse(request.response);
						if(response.success == true){
							advSec.innerHTML = 'Saved';
							setTimeout(() => {
								advSec.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round"><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>Save';
							}, 1500);
						}
					}
				};
				
				request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&securData=' + securData+'&extension_type=' + extension_type);

			})
		}
	}
	/* Advance security */
	/* Custom Login */
	function nxt_ext_ctm_login(extension_type){
		var loginbah = document.querySelector('.nxt-login-select'),
			ctmlobtn = document.querySelector('.nxt-ctm-login');
		
		if(loginbah && loginbah !== null ){
			loginbah.addEventListener('change' , function(){
				var nextDiv = this.parentNode.nextSibling;
				if( this.value && this.value !== 'message'){
					if(nextDiv && !nextDiv.classList.contains('nxt-hide')){
						nextDiv.classList.add('nxt-hide')
					}
				}else{
					if(nextDiv && nextDiv.classList.contains('nxt-hide')){
						setTimeout(function() {
							nextDiv.classList.remove('nxt-hide');
						}, 300)
					}
				}
			});
		}

		if(ctmlobtn){
			ctmlobtn.addEventListener( 'click' , e => {
				e.preventDefault();
				var loginUrl = document.querySelector('input[name=nxt-redirect-url]'),
					ctmMsg =  document.querySelector('textarea[name=nxt-login-msg]'),
					ctmlogData = {},
					validate = true;

				ctmlogData = Object.assign( {'custom_login_url': ((loginUrl && loginUrl.value) ? loginUrl.value : '') } , {'disable_login_url_behavior': ((loginbah && loginbah.value) ? loginbah.value : '') }, {'login_page_message': ((ctmMsg && ctmMsg.value) ? ctmMsg.value : '') } );
				
				if(validate){
					let nxtctmLogin = JSON.stringify(ctmlogData);
					ctmlobtn.innerHTML = 'Saving...';

					var request = new XMLHttpRequest();
					request.open('POST', nexter_admin_config.ajaxurl, true);
					request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
					request.onload = function () {
						if (request.status >= 200 && request.status < 400) {
							var response = JSON.parse(request.response);
							if(response.success == true){
								ctmlobtn.innerHTML = 'Saved';
								setTimeout(() => {
									ctmlobtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round"><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>Save';
								}, 2000);
							}
						}
					};
					
					request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&nxtctmLogin=' + nxtctmLogin+'&extension_type=' + extension_type);
				}
			});
		}

	}
	/* Custom Login */
    /* Extra Option */
	/*Import Data*/
	var nxtPanelImportBtn = document.querySelector('.nxt-import-data-content .import-step-next');
	if( nxtPanelImportBtn ){
		nxtPanelImportBtn.addEventListener('click', event => {
			event.preventDefault();
			var builderSelect = document.querySelector('.nxt-select-builder input[name="nxt-select-build"]:checked');
			
			if(nxtPanelImportBtn.getAttribute("data-step")=='step-2'){
			
				if( builderSelect && builderSelect.value ){
				
					var buildStep = document.querySelector('.nxt-import-steps'),
						request = new XMLHttpRequest();

					request.open('POST', nexter_admin_config.ajaxurl, true);
					request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
					request.onload = function () {
						if (request.status >= 200 && request.status < 400) {
							var response = JSON.parse(request.response);
							if(response.success == true && response.content!=''){
								buildStep.remove();
								nxtPanelImportBtn.setAttribute('data-builder', builderSelect.value);
								var content = document.querySelector('.nxt-import-data-content');
								content.insertAdjacentHTML('afterbegin', response.content);
								if(response.build_status == 'Activated' && response.extension_status == 'Activated'){
									nxtPanelImportBtn.setAttribute('data-step', 'step-3');
								}else{
									nexterInstallBuilder();
								}
							}
						}
					};
					request.send('action=nexter_import_data_step&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&builder=' + builderSelect.value);
				}
				
			}else if(nxtPanelImportBtn.getAttribute("data-step")=='step-3'){
				var buildStep = document.querySelector('.nxt-import-steps'),
					request = new XMLHttpRequest();

				request.open('POST', nexter_admin_config.ajaxurl, true);
				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				request.onload = function () {
					if (request.status >= 200 && request.status < 400) {
						var response = JSON.parse(request.response);
						if(response.data.success == true && response.data.content!=''){
							buildStep.remove();
							var content = document.querySelector('.nxt-import-data-content');
							content.insertAdjacentHTML('afterbegin', response.data.content);
							nexterImportTemplate();
							if( nxtPanelImportBtn ){
								nxtPanelImportBtn.setAttribute('data-step', 'step-4');
							}
						}else if(response.data.success == false){
							alert('Please Install/Activate Required Plugins');
						}
					}
				};
				request.send('action=nexter_import_data_step_3&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&builder=' + nxtPanelImportBtn.dataset.builder);
			}else if(nxtPanelImportBtn.getAttribute("data-step")=='step-4'){
				var buildStep = document.querySelector('.nxt-import-steps'),
					request = new XMLHttpRequest();

				request.open('POST', nexter_admin_config.ajaxurl, true);
				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				request.onload = function () {
					if (request.status >= 200 && request.status < 400) {
						var response = JSON.parse(request.response);
						if(response.data.success == true && response.data.content!=''){
							buildStep.remove();
							nxtPanelImportBtn.remove();
							var content = document.querySelector('.nxt-import-data-content');
							content.insertAdjacentHTML('afterbegin', response.data.content);
						}
					}
				};
				request.send('action=nexter_import_data_step_4&nexter_nonce=' + nexter_admin_config.ajax_nonce);
			}
				
		});
	}
	
	var nexterImportTemplate = function(){
		var importTemplate = document.querySelectorAll('.nxt-import-template .nxt-template-import-btn');
		if(importTemplate){
			importTemplate.forEach( function(ele) {
				ele.addEventListener('click', event => {
					event.preventDefault();
					var builder = ele.dataset.builder,
						tag		= ele.dataset.tag,
						template= ele.dataset.template;
					
					if( builder != '' && template != '' ){
						var request = new XMLHttpRequest();

						request.open('POST', nexter_admin_config.ajaxurl, true);
						request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
						request.onload = function () {
							if (request.status >= 200 && request.status < 400) {
								var response = JSON.parse(request.response);
								ele.parentElement.classList.remove('import-processing');
								nxtPanelImportBtn.classList.remove('disable-btn');
								if(response.data.success == true && response.data.content!=''){
									ele.innerHTML = response.data.content;
								}else{
									ele.innerHTML = response.data.content;
								}
							}
						};
						ele.parentElement.classList.add('import-processing');
						ele.innerHTML = '<svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="sync-alt" class="fa-spinner" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M457.373 9.387l-50.095 50.102C365.411 27.211 312.953 8 256 8 123.228 8 14.824 112.338 8.31 243.493 7.971 250.311 13.475 256 20.301 256h10.015c6.352 0 11.647-4.949 11.977-11.293C48.159 131.913 141.389 42 256 42c47.554 0 91.487 15.512 127.02 41.75l-53.615 53.622c-20.1 20.1-5.855 54.628 22.627 54.628H480c17.673 0 32-14.327 32-32V32.015c0-28.475-34.564-42.691-54.627-22.628zM480 160H352L480 32v128zm11.699 96h-10.014c-6.353 0-11.647 4.949-11.977 11.293C463.84 380.203 370.504 470 256 470c-47.525 0-91.468-15.509-127.016-41.757l53.612-53.616c20.099-20.1 5.855-54.627-22.627-54.627H32c-17.673 0-32 14.327-32 32v127.978c0 28.614 34.615 42.641 54.627 22.627l50.092-50.096C146.587 484.788 199.046 504 256 504c132.773 0 241.176-104.338 247.69-235.493.339-6.818-5.165-12.507-11.991-12.507zM32 480V352h128L32 480z"></path></svg>';
						nxtPanelImportBtn.classList.add('disable-btn');
						request.send('action=nexter_import_data_template&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&builder=' + builder +'&tag=' + tag +'&template=' + template);
					}
				});
			});
		}
	}
	
	nexterInstallBuilder();

	function nexterInstallBuilder(){
		/*Install Plugin Builder Event*/
		var nxtPanelInstallBuilderBtn = document.querySelectorAll('.nxt-import-data-content .nxt-install-builder-plugin');
		if(nxtPanelInstallBuilderBtn){
			nxtPanelInstallBuilderBtn.forEach( function(ele) {
				ele.addEventListener('click', event => {
					event.preventDefault();
					var builderSlug = ele.dataset.slug;
					ele.innerHTML = ele.dataset.builderProcess;
					/*Wp Install Plugin Event*/
					wp.updates.installPlugin( {
						slug: builderSlug
					});
				});
			});
			
			/*Wp Install Success trigger Message*/
			jQuery( document ).on('wp-plugin-install-success', ( event, response ) => {
				if(response){
					var builderSlug = (response.slug) ? response.slug : '';
					var installedBuilder = document.querySelector('.nxt-import-data-content .nxt-install-builder-plugin[data-slug=' + builderSlug + ']');
					if(installedBuilder){
						var file = installedBuilder.dataset.file;
						setTimeout( function() {
							var request = new XMLHttpRequest();

							request.open('POST', nexter_admin_config.ajaxurl, true);
							request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
							request.onload = function () {
								if (request.status >= 200 && request.status < 400) {
									var response = JSON.parse(request.response);
									if(response.data.success == true && response.data.content!=''){
										installedBuilder.innerHTML = response.data.content;
										if( nxtPanelImportBtn ){
											nxtPanelImportBtn.setAttribute('data-step', 'step-3');
										}
									}else{
										installedBuilder.innerHTML = response.data.content;
									}
								}
							};
							installedBuilder.innerHTML = 'Activating..';
							request.send('action=nexter_import_activate_builder&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&file=' + file);
						}, 1200);
					}
				}
			});
			
			/*Wp Install Error trigger Message*/
			jQuery( document ).on('wp-plugin-install-error', ( event, response ) => {
				var installedBuilder = document.querySelector('.nxt-import-data-content .nxt-install-builder-plugin');
				if(installedBuilder){
					installedBuilder.innerHTML = wp.updates.l10n.installFailedShort;
				}
			});
		}
		
		/*Activate Plugin Builder Event*/
		var nxtActiveBuilderBtn = document.querySelectorAll('.nxt-import-data-content .nxt-active-builder-plugin');
		if( nxtActiveBuilderBtn ){
			nxtActiveBuilderBtn.forEach( function(ele) {
				ele.addEventListener('click', event => {
					event.preventDefault();
					
					var builder = ele.dataset.builder,
						processText = ele.dataset.builderProcess,
						file = ele.dataset.file;
						
					if(builder!='' && ele.innerHTML != "Activated"){
						var request = new XMLHttpRequest();

						request.open('POST', nexter_admin_config.ajaxurl, true);
						request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
						request.onload = function () {
							if (request.status >= 200 && request.status < 400) {
								var response = JSON.parse(request.response);
								if(response.data.success == true && response.data.content!=''){
									ele.innerHTML = response.data.content;
									ele.classList.remove('nxt-active-builder-plugin');
									ele.classList.add('nxt-activated-builder-plugin');
									if( nxtPanelImportBtn ){
										nxtPanelImportBtn.setAttribute('data-step', 'step-3');
									}
								}else{
									ele.innerHTML = response.data.content;
								}
							}
						};
						
						ele.innerHTML = processText;
						request.send('action=nexter_import_activate_builder&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&builder=' + builder+'&file=' + file);
					}
					
				});
			});
		}
	}
	/*Import Data*/
	/* White Label Start */
	let wlMain = document.querySelector('.nxt-white-label');
	
	if(wlMain){
		let saveFile = ['theme_screenshot','theme_logo'];
		saveFile.forEach( function(sf) {
			let mainF = wlMain.querySelector('.'+sf);
			let fileUp = mainF.querySelector('.nxt-wl-save-file');
			var sBtn = mainF.querySelector('.nxt-wl-save-file'),

			removeBtn = mainF.querySelector('.nxt-wl-remove-file'),
				fileN = mainF.querySelector('.nxt-wl-file-name');
				if(removeBtn){
					removeBtn.addEventListener("click", rem => {
						fileN.innerHTML = 'Drag & Drop your file here';
						sBtn.value = '';
						sBtn.innerHTML = 'Browse';
						sBtn.dataset.src = '';
						rem.currentTarget.classList.remove('active');
					});
				}

			fileUp.addEventListener("click", e => {
				var button = e.currentTarget,
					custom_uploader = wp.media({
					title: 'Insert image',
					library : {
						type : 'image'
					},
					multiple: false
				}).on('select', function() { 
					var attachment = custom_uploader.state().get('selection').first().toJSON();
					button.value = attachment.id;
					button.dataset.src = attachment.url;
					button.innerHTML = 'Change';
					if(fileN){
						fileN.innerHTML = attachment.filename;
					}
					removeBtn.classList.add('active');
				}).open();
			});
		});

		let saveBtn = wlMain.querySelector('.nxt-wl-save-btn');

		saveBtn.addEventListener("click", s=> {

			let wpWLSet = {};
			let allWlOp = ['brand_name','theme_name','theme_desc','author_name','author_uri','theme_screenshot','theme_logo','nxt_free_plugin_name','nxt_pro_plugin_name','nxt_free_plugin_desc','nxt_pro_plugin_desc'];
			var arrWlValue = [];
			var validation = true;
			allWlOp.forEach(function(all){
				let allInput = wlMain.querySelector('.'+all+' input'),
					allTextArea = wlMain.querySelector('.'+all+' textarea'),
					allLabel = wlMain.querySelector('.'+all+' label');

				if(allInput && allInput.value){
					arrWlValue[all] = allInput.value;
					var regexp =  /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
        			if (all=='author_uri' && !regexp.test(allInput.value)){
						validation = false;
						delete arrWlValue[all];
					}
				}
				if(allTextArea && allTextArea.value){
					arrWlValue[all] = allTextArea.value;
				}
				if(allLabel){
					let fileBtn = allLabel.querySelector('.nxt-wl-save-file'),
					file_id = all+"_id";
					if(fileBtn.value){
						arrWlValue[all] = fileBtn.getAttribute('data-src');
						arrWlValue[file_id] = fileBtn.value;
					}
				}
			});

			arrWlValue = Object.assign({}, arrWlValue);

			let twoForce = wlMain.querySelector('#nxt-wl-two-force');
			if(twoForce && twoForce.checked){
				arrWlValue = Object.assign({ 'nxt_hidden_label' : 'on'}, arrWlValue);
			}
			wpWLSet = Object.assign( arrWlValue ,wpWLSet);
			var wpWLSetN = JSON.stringify(wpWLSet);
			if(validation){
				var request = new XMLHttpRequest();
				request.open('POST', nexter_admin_config.ajaxurl, true);
				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				saveBtn.innerHTML = 'Saving...';
				request.onload = function () {
					if (request.status >= 200 && request.status < 400) {
						var response = JSON.parse(request.response);
						if(response.success == true){
							saveBtn.innerHTML = 'Saved';
							setTimeout(function(){
								saveBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#fff" stroke-width=".781" stroke-linejoin="round" xmlns:v="https://vecta.io/nano"><path d="M15.833 17.5H4.167c-.442 0-.866-.176-1.179-.488s-.488-.736-.488-1.179V4.167c0-.442.176-.866.488-1.179S3.725 2.5 4.167 2.5h9.167L17.5 6.667v9.167c0 .442-.176.866-.488 1.179s-.736.488-1.179.488z"/><path d="M14.167 17.5v-6.667H5.833V17.5m0-15v4.167H12.5" stroke-linecap="round"/></svg>Save';
							},2000);
						}
					}
				};
				request.send('action=nexter_ext_save_data&nexter_nonce=' + nexter_admin_config.ajax_nonce +'&wpWLSet=' + wpWLSetN+'&extension_type=white-label');
			}else{
                var wrong_ID_msg = '<div class="nxt-wrong-msg-notice"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="15.75" stroke="#FC4032" stroke-width="0.5"/><circle cx="16" cy="16" r="12" fill="#FC4032"/><rect x="15" y="9" width="2" height="10" rx="1" fill="white"/><rect x="15" y="20" width="2" height="2" rx="1" fill="white"/></svg> Website URL not a valid</div>';
                var WLSel = document.querySelector('.nxt-white-label');
                if(WLSel){
                    WLSel.insertAdjacentHTML('beforeend', wrong_ID_msg);
                    var notice_data = WLSel.querySelector('.nxt-wrong-msg-notice');
                    if(notice_data){
                        setTimeout(function(){
                            notice_data.classList.add('active-notice');
                        },50);
                        setTimeout(function(){
                            notice_data.remove();
                        },3000);
                    }
                }
			}
		})
	}
	/* White Label End */
});