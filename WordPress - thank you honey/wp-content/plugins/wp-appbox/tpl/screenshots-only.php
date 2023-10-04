<?php
/*-------------------------------------------------------------*/
/* SCREENSHOTS-ONLY-TEMPLATE
/*
/* SINCE 	4.0.0
/* CHANGED	n/a
/*
/* YOU COULD COPY THIS TEMPLATE IN YOUR THEME-FOLDER AND
/* EDIT THIS TEMPLATE.
/*
/* ACCEPTED CUSTOM TEMPLATE-FILES:
/* - YOUR-THEME/wpappbox-screenshots-only.php
/* - YOUR THEME/wpappbox/screenshots-only.php
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

<div class="{WPAPPBOXCSSCLASSES} screenshots screenshots-only" onClick="location.href='{APPLINK}';return false;">
	<div class="screenshots">
		<div class="slider">
			<ul>{SCREENSHOTS}</ul>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>