<?php
/*-------------------------------------------------------------*/
/* SCREENSHOTS-TEMPLATE
/*
/* SINCE 	4.0.0
/* CHANGED	n/a
/*
/* YOU COULD COPY THIS TEMPLATE IN YOUR THEME-FOLDER AND
/* EDIT THIS TEMPLATE.
/*
/* ACCEPTED CUSTOM TEMPLATE-FILES:
/* - YOUR-THEME/wpappbox-screenshots.php
/* - YOUR THEME/wpappbox/screenshots.php
/*
/* AVAILABLE VARIABLES:
/* 
/* WPAPPBOXCSSCLASSES 	=> CSS classes (must have)
/* APPID				=> The id of an app
/* APPIDHASH			=> Unique hash of the app
/* ICON					=> URL of the app icon
/* RELOADLINK 			=> Button for manual refresh (forced)
/* TITLE				=> App title
/* TITLE_ATTR			=> Escaped app title
/* APPLINK				=> URL to the store
/* DEVELOPERLINK		=> Developer and URL (<a ...>DEVELOPER</a>)
/* APPLINK				=> URL to the store
/* PRICE				=> Price of the app
/* RATING				=> Rating stars for the app (<img ... />)
/* QRCODE				=> URL of the QR-Code (<img ... />)
/* DOWNLOADCAPTION		=> Caption for the download-/store-button
/* SCREENSHOTS 			=> List of the app screenshots (<li>...</li>)
/* 
/*-------------------------------------------------------------*/
?>

<div class="{WPAPPBOXCSSCLASSES} screenshots">
	<div class="qrcode"><img src="{QRCODE}" alt="{TITLE_ATTR}" /></div>
	<div class="appicon">
		<a href="{APPLINK}"><img src="{ICON}" alt="{TITLE_ATTR}" /></a>
	</div>
	<div class="applinks">
		<div class="appbuttons">
			<a href="{APPLINK}">{DOWNLOADCAPTION}</a>
			<span onMouseOver="jQuery('.wpappbox-{APPIDHASH} .qrcode').show();" onMouseOut="jQuery('.wpappbox-{APPIDHASH} .qrcode').hide();">QR-Code</span>
		</div>
	</div>
	<div class="appdetails">
		<div class="apptitle">{RELOADLINK}<a href="{APPLINK}" class="apptitle">{TITLE}</a></div>
		<div class="developer">
			<span class="label"><?php _e('Developer', 'wp-appbox'); ?>: </span>
			<span class="value">{DEVELOPERLINK}</span>
		</div>
		<div class="price">
			<span class="label"><?php _e('Price', 'wp-appbox'); ?>: </span>
			<span class="value">{PRICE}</span> 
			<span class="rating">{RATING}</span>
		</div>
	</div>
	<div class="screenshots">
		<div class="slider">
			<ul>{SCREENSHOTS}</ul>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>