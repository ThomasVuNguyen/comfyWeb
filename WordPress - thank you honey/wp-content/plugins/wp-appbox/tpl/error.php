<?php
/*-------------------------------------------------------------*/
/* ERROR-TEMPLATE 
/*
/* SINCE 	v4.0.0
/* CHANGED	n/a
/*
/* YOU COULD COPY THIS TEMPLATE IN YOUR THEME-FOLDER AND
/* EDIT THIS TEMPLATE.
/*
/* ACCEPTED CUSTOM TEMPLATE-FILES:
/* - YOUR-THEME/wpappbox-error.php
/* - YOUR THEME/wpappbox/error.php
/*
/* AVAILABLE VARIABLES:
/* 
/* WPAPPBOXCSSCLASSES 	=> CSS classes (must have)
/* APPID				=> The id of an app
/* ICON					=> WP-Appbox-Logo
/* RELOADLINK 			=> Button for manual refresh (forced)
/* ERRORMSG				=> Error message
/* TITLE_ATTR			=> Escaped Error message
/* APPLINK				=> URL to the store
/* GOOGLESEARCH			=> URL to Google Websearch
/* 
/*-------------------------------------------------------------*/
?>

<div class="{WPAPPBOXCSSCLASSES} compact error">
	<div class="appicon">
		<img src="{ICON}" />
	</div>
	<a class="applinks" href="{APPLINK}"></a>
	<div class="appdetails">
		<div class="title">{RELOADLINK}{ERRORMSG} :-(</div>
		<div class="buttons">
			<a href="{APPLINK}"><?php _e( 'Go to store', 'wp-appbox' ); ?></a>
			<a href="{GOOGLESEARCH}"><?php _e( 'Google websearch', 'wp-appbox' ); ?></a>
		</div>
	</div>
</div>