
"use strict";

document.addEventListener('DOMContentLoaded', () => {
    var load = 0,
    loadtime = setInterval( function() {
        if ( typeof Recaptcha  != "undefined" || typeof grecaptcha != "undefined" ) {
            try {
                nxtrecptchprepare();
            } catch ( e ) {
                console.log( 'Unexpected error occurred: ', e );
            }
            clearInterval( loadtime );
        }
        load++;
        if ( load >= 10 ) {
            clearInterval( loadtime );
        }
    }, 1000 );
})

// Recaptch Prepare
var nxtrecptchprepare = function(){
    var elements = document.querySelectorAll('.nexter-recaptcha-v2,.nexter-recaptcha-invisible');

    if(elements.length != 0){
        elements.forEach( el => {
            var divid =  el.getAttribute('data-id'),
                recpdiv = el.querySelector('.nexter-recaptcha')
            
            if( recpdiv != null ){
                nxtrecptchDisplay(divid);
            }
        })
    }

    if ( 'v3' == nxtcptch.options.version ) {
        grecaptcha.ready( function() {
            grecaptcha.execute( nxtcptch.options.sitekey, { action: 'nxt_reCaptcha'}).then(function( token ) {
                document.querySelectorAll( "#g-recaptcha-response" ).forEach( function ( elem ) { elem.value = token } );
            });
        });
    }
}

var nxtrecptchDisplay = function(uid){

    function nxtstoreOnSubmit(form, nxtindex){
        if(form.querySelectorAll( '#wp-submit,#submit' ) != null ){
            form.querySelectorAll( '#wp-submit,#submit' ).forEach( obj => { 
                obj.addEventListener( 'click', function( e ) {
                    if ( '' == form.querySelector( '.g-recaptcha-response' ).value ) {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        nxtObject = jQuery( e.target || e.srcElement || e.nxtObject );
                        nxtEvent = e.type;
                        grecaptcha.execute( nxtindex );
                    }
                } );
            })
        }
    }

    var reversion = nxtcptch.options.version;
    if( reversion == 'v2' ){
        var reDiv = document.getElementById(uid),
            arg =  { 'sitekey' : nxtcptch.options.sitekey, 'theme' : nxtcptch.options.theme , 'size' : '' },
            size = '';

        if ( window.screen.width < 400 ) {  //reDiv.parentElement.offsetWidth <= 300 && reDiv.parentElement.offsetWidth != 0 ||
            arg.size = 'compact';
        } else {
            arg.size = 'normal';
        }
        var nextcptch_index = grecaptcha.render( reDiv, arg );
		reDiv.setAttribute( 'data-nxtcptch-index', nextcptch_index );
    }else if(reversion == 'invisible'){
        var invidiv = document.getElementById(uid),
        form = invidiv.parentElement.parentElement,
        nxtindex = null,
        inviarg =  { 'sitekey' : nxtcptch.options.sitekey, 'tabindex' : 9999 , 'size' : 'invisible' },
        nxtObject = false,
	    nxtEvent = false;

        
        if ( form != null ) {
            if ( ! document.getElementsByTagName( 'body' )[0].classList.contains( 'wp-admin' ) ) {
                inviarg['callback'] = function( token ) {
                    if ( nxtObject && nxtEvent ) {
                        nxtObject.trigger( nxtEvent );
                    }
                    
                    nxtstoreOnSubmit( form, nxtindex );
                    grecaptcha.reset( nxtindex );
                }
            }
            if(nxtindex == null){
                nxtindex = grecaptcha.render( invidiv, inviarg );
                invidiv.setAttribute( 'data-nxtcptch-index', nxtindex );
            }

            if ( !document.getElementsByTagName( 'body' )[0].classList.contains( 'wp-admin' ) ) {
                nxtstoreOnSubmit( form, nxtindex );
            }
        }
       
    }
}

var nxtrecptch_onload_callback = function(){
    nxtrecptchprepare();
}