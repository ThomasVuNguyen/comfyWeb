<?php
/*-------------------------------------------------------------*/
/* COMPACT-TEMPLATE
/*
/* SINCE 	4.0.0
/* CHANGED	n/a
/*
/* YOU COULD COPY THIS TEMPLATE IN YOUR THEME-FOLDER AND
/* EDIT THIS TEMPLATE.
/*
/* ACCEPTED CUSTOM TEMPLATE-FILES:
/* - YOUR-THEME/wpappbox-compact.php
/* - YOUR THEME/wpappbox/compact.php
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

<div class="{WPAPPBOXCSSCLASSES} compact">
	<div class="appicon">
		<a href="{APPLINK}"><img src="{ICON}" alt="{TITLE_ATTR}" /></a>
	</div>
	<a class="applinks" href="{APPLINK}"></a>
	<div class="appdetails">
		<div class="apptitle">{RELOADLINK}<a href="{APPLINK}" class="apptitle">{TITLE}</a></div>
		<div class="price">
			<span class="label"><?php _e('Price', 'wp-appbox'); ?>: </span>
			<span class="value">{PRICE}</span> 
			<span class="rating">{RATING}</span>
		</div>
	</div>
</div>