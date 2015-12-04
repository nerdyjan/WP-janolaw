<?php
/*
Plugin Name: Janolaw AGB Hosting
Plugin URI: http://www.janolaw.de/internetrecht/agb/agb-hosting-service/
Description: This Plugin get hosted legal documents provided by Janolaw AG for Web-Shops and Pages.
Version: 3.1
Author: Jan Giebels
Author URI: http://code-worx.de
License: GPL2
*/
?>
<?php
/*  Copyright 2012  Code-WorX, Jan Giebels  (email : wordpress@code-worx.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php

load_plugin_textdomain('janolaw_agb', "/wp-content/plugins/janolaw_agb/languages/");

function janolaw_agb_menu() {
	add_options_page('Janolaw AGB Hosting', 'Janolaw AGB Hosting', 9, basename(__FILE__), 'janolaw_plugin_options');
	add_action( 'admin_init', 'register_janolaw_settings' );
}

function register_janolaw_settings() {
	//register our settings
	register_setting( 'janolaw-settings-group', 'janolaw_user_id' );
	register_setting( 'janolaw-settings-group', 'janolaw_shop_id' );
	register_setting( 'janolaw-settings-group', 'janolaw_cache_path' );
	register_setting( 'janolaw-settings-group', 'janolaw_cache_clear' );
	register_setting( 'janolaw-settings-group', 'janolaw_language' );
	register_setting( 'janolaw-settings-group', 'janolaw_agb_page' );
	register_setting( 'janolaw-settings-group', 'janolaw_imprint_page' );
	register_setting( 'janolaw-settings-group', 'janolaw_widerruf_page' );
	register_setting( 'janolaw-settings-group', 'janolaw_widerrufform_page' );
	register_setting( 'janolaw-settings-group', 'janolaw_privacy_page' );
	register_setting( 'janolaw-settings-group', 'janolaw_agb_page_id' );
	register_setting( 'janolaw-settings-group', 'janolaw_imprint_page_id' );
	register_setting( 'janolaw-settings-group', 'janolaw_widerruf_page_id' );
	register_setting( 'janolaw-settings-group', 'janolaw_widerrufform_page_id' );
	register_setting( 'janolaw-settings-group', 'janolaw_privacy_page_id' );
	register_setting( 'janolaw-settings-group', 'janolaw_version' );
	register_setting( 'janolaw-settings-group', 'janolaw_pdf_top' );
	register_setting( 'janolaw-settings-group', 'janolaw_pdf_bottom' );
}

function janolaw_plugin_options() {
	# check permission
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	# predefine cache path if not entered yet
	$cachepath = get_option('janolaw_cache_path');
	if (!$cachepath) {
		$cachepath = "/tmp";
	}

	# predefine language if not entered yet
	$language = get_option('janolaw_language');
	if (!$language) {
		$language = "de";
	}

	
	# create pages if not exist and checked to create
	
	if (get_option('janolaw_agb_page')) {
		$post = array(
			'ID' => get_option('janolaw_agb_page_id'),
			'comment_status' => 'closed',
			'post_content' => '[janolaw_agb]',
			'post_name' => 'agb',
			'post_status' => 'publish',
			'post_title' => 'Allgemeine Gesch&auml;ftsbedingungen',
			'post_type' => 'page'
		);
		$id = wp_insert_post( $post );
		update_option( "janolaw_agb_page_id", $id );
	}
	if (get_option('janolaw_imprint_page')) {
		$post = array(
				'ID' => get_option('janolaw_imprint_page_id'),
				'comment_status' => 'closed',
				'post_content' => '[janolaw_impressum]',
				'post_name' => 'imprint',
				'post_status' => 'publish',
				'post_title' => 'Impressum',
				'post_type' => 'page'
		);
		$id = wp_insert_post( $post );
		update_option( "janolaw_imprint_page_id", $id );
	}
	if (get_option('janolaw_widerruf_page')) {
		$post = array(
				'ID' => get_option('janolaw_widerruf_page_id'),
				'comment_status' => 'closed',
				'post_content' => '[janolaw_widerrufsbelehrung]',
				'post_name' => 'widerrufsbelehrung',
				'post_status' => 'publish',
				'post_title' => 'Widerrufsbelehrung',
				'post_type' => 'page'
		);
		$id = wp_insert_post( $post );
		update_option( "janolaw_widerruf_page_id", $id );
	}
	if (get_option('janolaw_widerrufform_page')) {
		$post = array(
				'ID' => get_option('janolaw_widerrufform_page_id'),
				'comment_status' => 'closed',
				'post_content' => '[janolaw_widerrufsformular]',
				'post_name' => 'widerrufsformular',
				'post_status' => 'publish',
				'post_title' => 'Widerrufsformular',
				'post_type' => 'page'
		);
		$id = wp_insert_post( $post );
		update_option( "janolaw_widerrufform_page_id", $id );
	}
	if (get_option('janolaw_privacy_page')) {
		$post = array(
				'ID' => get_option('janolaw_privacy_page_id'),
				'comment_status' => 'closed',
				'post_content' => '[janolaw_datenschutzerklaerung]',
				'post_name' => 'privacy',
				'post_status' => 'publish',
				'post_title' => 'Datenschutzerkl&auml;rung',
				'post_type' => 'page'
		);
		$id = wp_insert_post( $post );
		update_option( "janolaw_privacy_page_id", $id );
	}


function janolaw_server_check() {
	$base_url = 'http://www.janolaw.de/agb-service/shops/';
	$user_id = get_option('janolaw_user_id');
	$shop_id = get_option('janolaw_shop_id');

	$headers = @get_headers($base_url.'/'.$user_id.'/'.$shop_id.'/');

	if ($headers[0] == 'HTTP/1.1 404 Not Found') {
		$message = "<div id='setting-error-settings_updated' class='error settings-error'>janolaw server <u>not</u> avaiable</div>";
	} else {


		# check for version 1
		$headers = @get_headers($base_url.'/'.$user_id.'/'.$shop_id.'/agb_include.html');
		if ($headers[0] != 'HTTP/1.1 404 Not Found') {
			update_option( "janolaw_version", 1 );
		}
		# check for version 2
		$headers = @get_headers($base_url.'/'.$user_id.'/'.$shop_id.'/de/terms_include.html');
		if ($headers[0] != 'HTTP/1.1 404 Not Found') {
			update_option( "janolaw_version", 2 );
		}
		# check for version 3
		$headers = @get_headers($base_url.'/'.$user_id.'/'.$shop_id.'/gb/terms_include.html');
		if ($headers[0] != 'HTTP/1.1 404 Not Found') {
			update_option( "janolaw_version", 3 );
		}

		$message = "<div id='setting-error-settings_updated' class='updated settings-error'>janolaw server avaiable running service version ".get_option('janolaw_version')." for you!</div>";
	}
	if (get_option('janolaw_version') <= 2) {
		$message .= "<div id='setting-error-settings_updated' class='updated settings-error'>Upgrade to service version 3 to use the 'Widerrufsformular' or add it manually. Please contact <a href='https://www.janolaw.de/ueber_janolaw/kontakt.html' target='_blank'>janolaw</a></div>";
	}
 	return $message;
}


?>

<div class="wrap">
	<h2>Janolaw AGB Hosting</h2>
		<?php
			echo janolaw_server_check();
			$versionnumber = get_option('janolaw_version');
		?>

	<form method="post" action="options.php">
		<?php settings_fields( 'janolaw-settings-group' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Janolaw User ID</th>
				<td><input type="text" name="janolaw_user_id"
					value="<?= get_option('janolaw_user_id'); ?>" /> <small><?php _e('Your janolaw User ID is issued by janolaw AG by registering at', 'janolaw_agb'); ?>
					<a href="https://www.janolaw.de/myjanolaw/agb-service/" target="_blank">Janolaw
						AGB Hosting Service</a></small></td>
			</tr>
			<tr valign="top">
				<th scope="row">Janolaw Shop ID</th>
				<td><input type="text" name="janolaw_shop_id"
					value="<?= get_option('janolaw_shop_id'); ?>" /> <small><?php _e('Your janolaw Shop ID is issued by janolaw AG by registering at', 'janolaw_agb'); ?>
					<a href="https://www.janolaw.de/myjanolaw/agb-service/" target="_blank">Janolaw
						AGB Hosting Service</a></small></td>
			</tr>
		</table>

		<br />
		<h3 class="title"><?php _e('Settings', 'janolaw_agb'); ?></h3>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('Cache Path', 'janolaw_agb'); ?></th>
				<td><input type="text" name="janolaw_cache_path"
					value="<?= $cachepath ?>" /> <small><?php _e('Path to store cached documents e.g. /tmp for Unix based systems like Linux', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Clear Cache', 'janolaw_agb'); ?></th>
				<td>
					<input type="checkbox" name="janolaw_cache_clear" value="1" <?= checked( 1, get_option('janolaw_cache_clear'), false ) ?> /> 
					<small><?php _e('Check to clear cache & refresh from server by next pagecall', 'janolaw_agb'); ?></small>
				</td>
			</tr>


			<?php if ($versionnumber == 3): ?>
			<tr valign="top">
				<th scope="row"><?php _e('Language', 'janolaw_agb'); ?></th>
				<td>
					<select name="janolaw_language">
						<option value="auto" <?= selected( 'auto', get_option('janolaw_language'), false ) ?>><?php _e('Automatic', 'janolaw_agb'); ?></option>
						<option value="de" <?= selected( 'de', get_option('janolaw_language'), false ) ?>><?php _e('German', 'janolaw_agb'); ?></option>
						<option value="gb" <?= selected( 'gb', get_option('janolaw_language'), false ) ?>><?php _e('English', 'janolaw_agb'); ?></option>
						<option value="fr" <?= selected( 'fr', get_option('janolaw_language'), false ) ?>><?php _e('French', 'janolaw_agb'); ?></option>
					</select>
					<small><?php _e('Select language for pages', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<?php else: ?>
			<tr valign="top">
				<th scope="row"><?php _e('Language', 'janolaw_agb'); ?></th>
				<td><small><?php _e('Upgrade to version 3 to use other languages', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<?php endif; ?>

			<?php if ($versionnumber == 3): ?>
			<tr valign="top">
				<th scope="row"><?php _e('PDF top download', 'janolaw_agb'); ?></th>
				<td>
					<input type="checkbox" name="janolaw_pdf_top" value="1" <?= checked( 1, get_option('janolaw_pdf_top'), false ) ?> /> 
					<small><?php _e('Include PDF download links on top of pages content', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('PDF bottom download', 'janolaw_agb'); ?></th>
				<td>
					<input type="checkbox" name="janolaw_pdf_bottom" value="1" <?= checked( 1, get_option('janolaw_pdf_bottom'), false ) ?> /> 
					<small><?php _e('Include PDF download links on bottom of pages content', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<?php else: ?>
			<tr valign="top">
				<th scope="row"><?php _e('PDF support', 'janolaw_agb'); ?></th>
				<td>
					<small><?php _e('Include PDF download links on top/bottom of pages content for download. Upgrade to version 3 to use this!', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<?php endif; ?>
		</table>

		<br />
		<h3 class="title"><?php _e('Page creation', 'janolaw_agb'); ?></h3>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('Create Page AGB', 'janolaw_agb'); ?></th>
				<td><input type="hidden" name="janolaw_agb_page_id" value ="<?= get_option('janolaw_agb_page_id'); ?>" />
				<input type="checkbox" name="janolaw_agb_page"
					value ="1" /> <small><?php _e('Create a static page with pagetag included', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Create Page Imprint', 'janolaw_agb'); ?></th>
				<td><input type="hidden" name="janolaw_imprint_page_id" value ="<?= get_option('janolaw_imprint_page_id'); ?>" />
					<input type="checkbox" name="janolaw_imprint_page"
					value ="1" /> <small><?php _e('Create a static page with pagetag included', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e('Create Page Widerruf', 'janolaw_agb'); ?></th>
				<td><input type="hidden" name="janolaw_widerruf_page_id" value ="<?= get_option('janolaw_widerruf_page_id'); ?>" />
				<input type="checkbox" name="janolaw_widerruf_page"
					value ="1" /> <small><?php _e('Create a static page with pagetag included', 'janolaw_agb'); ?></small>
				</td>
			</tr>


			<?php if ($versionnumber == 3): ?>
			<tr valign="top">
				<th scope="row"><?php _e('Create Page Widerrufsformular', 'janolaw_agb'); ?></th>
				<td><input type="hidden" name="janolaw_widerrufform_page_id" value ="<?= get_option('janolaw_widerrufform_page_id'); ?>" />
				<input type="checkbox" name="janolaw_widerrufform_page"
					value ="1" /> <small><?php _e('Create a static page with pagetag included', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<?php else: ?>
			<tr valign="top">
				<th scope="row"><?php _e('Create Page Widerrufsformular', 'janolaw_agb'); ?></th>
				<td><small><?php _e('Upgrade to version 3 to use the Widerrufsformular or insert the document by copy & paste', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<?php endif; ?>


			<tr valign="top">
				<th scope="row"><?php _e('Create Page Privacy', 'janolaw_agb'); ?></th>
				<td><input type="hidden" name="janolaw_privacy_page_id" value ="<?= get_option('janolaw_privacy_page_id'); ?>" />
				<input type="checkbox" name="janolaw_privacy_page"
					value ="1" /> <small><?php _e('Create a static page with pagetag included', 'janolaw_agb'); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><h3><?php _e('Howto', 'janolaw_agb'); ?></h3></th>
				<td><?php _e('Check the Checkbox of the desired document to create the page automatically.', 'janolaw_agb'); ?>
				<br /><br />
					<i><?php _e('Alternative:', 'janolaw_agb'); ?></i><br />
					<?php _e('Insert one of the following Tags into any page to display the refering Janolaw document:', 'janolaw_agb'); ?>
						<blockquote>
						[janolaw_agb]<br />
						[janolaw_impressum]<br />
						[janolaw_widerrufsbelehrung]<br />
						<?php if ($versionnumber == 3): ?>
						[janolaw_widerrufsformular]<br />
						<?php endif; ?>
						[janolaw_datenschutzerklaerung]
						</blockquote></td>
			</tr>
		</table>

		<p class="submit">
			<input type="submit" class="button-primary"
				value="<?php _e('Save Changes', 'janolaw_agb'); ?>" />
		</p>
	</form>
</div>

<?php

/*
<?= checked( 1, get_option('janolaw_agb_page'), false ) ?> 
<?= checked( 1, get_option('janolaw_imprint_page'), false ) ?> 
<?= checked( 1, get_option('janolaw_widerruf_page'), false ) ?> 
<?= checked( 1, get_option('janolaw_widerrufform_page'), false ) ?>
<?= checked( 1, get_option('janolaw_privacy_page'), false ) ?>
*/

}

function janolaw_page($content) {
	if (preg_match("/\[janolaw_(.*)\]/", $content, $type)) {
		$content = _get_document($type[1]);
	}
	return $content;
}

function _get_document($type) {
	$user_id = get_option('janolaw_user_id');
	$shop_id = get_option('janolaw_shop_id');
	$language = get_option('janolaw_language');
	$cache_path = get_option('janolaw_cache_path');
	$cache_clear = get_option('janolaw_cache_clear');
	$cache_time = 7200;
	$base_url = 'http://www.janolaw.de/agb-service/shops/';

	# clear cache and force refresh from server
	if ($cache_clear == 1) {
		foreach (glob($cache_path.'/'.$user_id.$shop_id.'*') as $filename) {
   			unlink($filename);
		}
		$cache_clear_msg = "<div style='border: border-left: #3ADF00 6px solid; padding-left: 10px;'>Cleared cached documents!</div>";
		update_option( "janolaw_cache_clear", 0 );
	}

	# language autodetect
	if ($language == 'auto') {
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		switch ($lang){
	    	case "fr":
	        	$language = 'fr';
	        	break;
		    case "en":
		        $language = 'gb';
		        break;        
		    default:
		        $language = 'de';
		        break;
		}
	}

	# document type translation from v1 to v2/3 of service
	$translation = array (
		'agb' => 'terms',
		'impressum' => 'legaldetails',
		'widerrufsbelehrung' => 'revocation',
		'datenschutzerklaerung' => 'datasecurity',
		'widerrufsformular' => 'model-withdrawal-form'
	);
	if (get_option('janolaw_version') == 3) {
		# translate type
		$type = $translation[$type];
		$base_path = $base_url.$user_id.'/'.$shop_id.'/'.$language.'/'.$type;
		$cache_file = $cache_path.'/'.$user_id.$shop_id.'janolaw_'.$language.'_'.$type.'.html';
	} else {
		$base_path = $base_url.$user_id.'/'.$shop_id.'/'.$type;
		$cache_file = $cache_path.'/'.$user_id.$shop_id.'janolaw_'.$type.'.html';
	}


	# check if file exists at cache path
	if (file_exists($cache_file)) {
		if (filectime($cache_file)+$cache_time<=time()) {
			#get fresh version from server 
			if ($file = file_get_contents($base_path.'_include.html')) {
				unlink ($cache_file);
				$fp = fopen($cache_file, 'w');
				fwrite($fp, $file);
				fclose($fp);
			}
		}
	} else {
		$file = file_get_contents($base_path.'_include.html');
		$fp = fopen($cache_file, 'w');
		fwrite($fp, $file);
		fclose($fp);
	}
	# PDF Links
	if (get_option('janolaw_pdf_top') == 1) {
		$pdftop = "<a class='janolaw-pdflink' href='".$base_path.".pdf' target='_blank'>Download as PDF</a><br /><br />";
	}
	if (get_option('janolaw_pdf_bottom') == 1) {
		$pdfbottom = "<br /><br /><a class='janolaw-pdflink' href='".$base_path.".pdf' target='_blank'>Download as PDF</a>";
	}
	# extract text
	if ($file = file_get_contents($cache_file)) {
		return $cache_clear_msg . $pdftop . $file . $pdfbottom;
	} else {
		return "<div style='border: #DF0101 1px solid; border-left: #DF0101 6px solid; padding-left: 10px; '>Ein Fehler ist aufgetreten! Bitte &uuml;berpr&uuml;fen Sie ihre Janolaw UserID und ShopID in Ihrer Konfiguration und ob der Cache Pfad beschreibbar ist! # $language # $type # $base_path # $cache_file </div>";
	}
}

add_action('admin_menu', 'janolaw_agb_menu');
add_filter('the_content','janolaw_page');

?>