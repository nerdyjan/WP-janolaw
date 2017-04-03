<?php
/*
Plugin Name: janolaw AGB Hosting
Plugin URI: http://www.janolaw.de/internetrecht/agb/agb-hosting-service/
Description: This Plugin get hosted legal documents provided by janolaw AG for Web-Shops and Pages.
Version: 3.6.2
Author: Jan Giebels
Text Domain: janolaw-agb-hosting
Domain Path: /languages
Author URI: https://www.conspir3d.com
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

load_plugin_textdomain('janolaw-agb-hosting', "/wp-content/plugins/janolaw-agb-hosting/lang/");
add_action('plugins_loaded', 'wan_load_textdomain');

function wan_load_textdomain() {
	load_plugin_textdomain( 'janolaw-agb-hosting', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

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
		wp_die( __('You do not have sufficient permissions to access this page.', 'janolaw-agb-hosting') );
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
			'post_title' => __('Allgemeine Gesch&auml;ftsbedingungen','janolaw-agb-hosting'),
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
				'post_title' => __('Impressum','janolaw-agb-hosting'),
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
				'post_title' => __('Widerrufsbelehrung','janolaw-agb-hosting'),
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
				'post_title' => __('Widerrufsformular','janolaw-agb-hosting'),
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
				'post_title' => __('Datenschutzerkl&auml;rung','janolaw-agb-hosting'),
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
		$message = "<div id='setting-error-settings_updated' class='error settings-error'>".__("janolaw server <u>not</u> avaiable","janolaw-agb-hosting")."</div>";
	} else {


		# check for version 1
		$headers = @get_headers($base_url.'/'.$user_id.'/'.$shop_id.'/legaldetails_include.html');
		if ($headers[0] != 'HTTP/1.1 404 Not Found') {
			update_option( "janolaw_version", 1 );
		}
		# check for version 2
		$headers = @get_headers($base_url.'/'.$user_id.'/'.$shop_id.'/de/legaldetails_include.html');
		if ($headers[0] != 'HTTP/1.1 404 Not Found') {
			update_option( "janolaw_version", 2 );
		}
		# check for version 3
		$headers = @get_headers($base_url.'/'.$user_id.'/'.$shop_id.'/de/legaldetails.pdf');
		if ($headers[0] != 'HTTP/1.1 404 Not Found') {
			update_option( "janolaw_version", 3 );
		}

		$message = "<div id='setting-error-settings_updated' class='updated settings-error'>".__("janolaw server avaiable running service version","janolaw-agb-hosting") . " ".get_option('janolaw_version') ." " . __("for you!","janolaw-agb-hosting")."</div>";
	}
	if (get_option('janolaw_version') <= 2) {
		$message .= "<div id='setting-error-settings_updated' class='updated settings-error'>".__("Upgrade to service version 3 to use the 'Widerrufsformular' or add it manually. Please contact <a href='https://www.janolaw.de/ueber_janolaw/kontakt.html' target='_blank'>janolaw</a>","janolaw-agb-hosting")."</div>";
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
					value="<?= get_option('janolaw_user_id'); ?>" /> <small><?= __('Your janolaw User ID is issued by janolaw AG by registering at', 'janolaw-agb-hosting'); ?>
					<a href="https://www.janolaw.de/myjanolaw/agb-service/" target="_blank"><?= __('Janolaw
						AGB Hosting Service', 'janolaw-agb-hosting'); ?></a></small></td>
			</tr>
			<tr valign="top">
				<th scope="row">Janolaw Shop ID</th>
				<td><input type="text" name="janolaw_shop_id"
					value="<?= get_option('janolaw_shop_id'); ?>" /> <small><?= __('Your janolaw Shop ID is issued by janolaw AG by registering at', 'janolaw-agb-hosting'); ?>
					<a href="https://www.janolaw.de/myjanolaw/agb-service/" target="_blank"><?= __('Janolaw
						AGB Hosting Service', 'janolaw-agb-hosting'); ?></a></small></td>
			</tr>
		</table>

		<br />
		<h3 class="title"><?= __('Settings', 'janolaw-agb-hosting'); ?></h3>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?= __('Cache Path', 'janolaw-agb-hosting'); ?></th>
				<td>
					<?php 
						if (is_writeable($cachepath)) {
							$cachepathcheck = "<img src='".site_url()."/wp-content/plugins/janolaw-agb-hosting/images/ok.png' />" . __('Path is writable', 'janolaw-agb-hosting');
						} elseif (is_writeable(get_home_path()."wp-content/plugins/janolaw-agb-hosting")) {
							$cachepathcheck = "<img src='".site_url()."/wp-content/plugins/janolaw-agb-hosting/images/ok.png' />" . __('Path is writable, but alternative path is used.', 'janolaw-agb-hosting');
							$cachepath = get_home_path()."wp-content/plugins/janolaw-agb-hosting";
						} else {
							$cachepathcheck = "<img src='".site_url()."/wp-content/plugins/janolaw-agb-hosting/images/error.png' />" . __('Path is NOT writable and no writable path could be detected. Please contact your system administrator.', 'janolaw-agb-hosting');
						}
					?>
					<input type="text" name="janolaw_cache_path" value="<?= $cachepath ?>" /> 
					<small><?= __('Path to store cached documents e.g. /tmp for Unix based systems like Linux', 'janolaw-agb-hosting'); ?></small><br />
					<small><?= $cachepathcheck ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?= __('Clear Cache', 'janolaw-agb-hosting'); ?></th>
				<td>
					<input type="checkbox" name="janolaw_cache_clear" value="1" <?= checked( 1, get_option('janolaw_cache_clear'), false ) ?> /> 
					<small><?= __('Check to clear cache & refresh from server by next pagecall', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>


			<?php if ($versionnumber == 3): ?>
			<tr valign="top">
				<th scope="row"><?= __('Language', 'janolaw-agb-hosting'); ?></th>
				<td>
					<select name="janolaw_language">
						<option value="auto" <?= selected( 'auto', get_option('janolaw_language'), false ) ?>><?= __('Automatic', 'janolaw-agb-hosting'); ?></option>
						<option value="de" <?= selected( 'de', get_option('janolaw_language'), false ) ?>><?= __('German', 'janolaw-agb-hosting'); ?></option>
						<option value="gb" <?= selected( 'gb', get_option('janolaw_language'), false ) ?>><?= __('English', 'janolaw-agb-hosting'); ?></option>
						<option value="fr" <?= selected( 'fr', get_option('janolaw_language'), false ) ?>><?= __('French', 'janolaw-agb-hosting'); ?></option>
					</select>
					<small><?= __('Select language for pages', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>
			<?php else: ?>
			<tr valign="top">
				<th scope="row"><?= __('Language', 'janolaw-agb-hosting'); ?></th>
				<td><small><?= __('Upgrade to version 3 to use other languages', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>
			<?php endif; ?>

			<?php if ($versionnumber == 3): ?>
			<tr valign="top">
				<th scope="row"><?= __('PDF top download', 'janolaw-agb-hosting'); ?></th>
				<td>
					<input type="checkbox" name="janolaw_pdf_top" value="1" <?= checked( 1, get_option('janolaw_pdf_top'), false ) ?> /> 
					<small><?= __('Include PDF download links on top of pages content', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?= __('PDF bottom download', 'janolaw-agb-hosting'); ?></th>
				<td>
					<input type="checkbox" name="janolaw_pdf_bottom" value="1" <?= checked( 1, get_option('janolaw_pdf_bottom'), false ) ?> /> 
					<small><?= __('Include PDF download links on bottom of pages content', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>
			<?php else: ?>
			<tr valign="top">
				<th scope="row"><?= __('PDF support', 'janolaw-agb-hosting'); ?></th>
				<td>
					<small><?= __('Include PDF download links on top/bottom of pages content for download. Upgrade to version 3 to use this!', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>
			<?php endif; ?>
		</table>

		<br />
		<h3 class="title"><?= __('Page creation', 'janolaw-agb-hosting'); ?></h3>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?= __('Create Page AGB', 'janolaw-agb-hosting'); ?></th>
				<td><input type="hidden" name="janolaw_agb_page_id" value ="<?= get_option('janolaw_agb_page_id'); ?>" />
				<input type="checkbox" name="janolaw_agb_page"
					value ="1" /> <small><?= __('Create a static page with pagetag included', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?= __('Create Page Imprint', 'janolaw-agb-hosting'); ?></th>
				<td><input type="hidden" name="janolaw_imprint_page_id" value ="<?= get_option('janolaw_imprint_page_id'); ?>" />
					<input type="checkbox" name="janolaw_imprint_page"
					value ="1" /> <small><?= __('Create a static page with pagetag included', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?= __('Create Page Widerruf', 'janolaw-agb-hosting'); ?></th>
				<td><input type="hidden" name="janolaw_widerruf_page_id" value ="<?= get_option('janolaw_widerruf_page_id'); ?>" />
				<input type="checkbox" name="janolaw_widerruf_page"
					value ="1" /> <small><?= __('Create a static page with pagetag included', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>


			<?php if ($versionnumber == 3): ?>
			<tr valign="top">
				<th scope="row"><?= __('Create Page Widerrufsformular', 'janolaw-agb-hosting'); ?></th>
				<td><input type="hidden" name="janolaw_widerrufform_page_id" value ="<?= get_option('janolaw_widerrufform_page_id'); ?>" />
				<input type="checkbox" name="janolaw_widerrufform_page"
					value ="1" /> <small><?= __('Create a static page with pagetag included', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>
			<?php else: ?>
			<tr valign="top">
				<th scope="row"><?= __('Create Page Widerrufsformular', 'janolaw-agb-hosting'); ?></th>
				<td><small><?= __('Upgrade to version 3 to use the Widerrufsformular or insert the document by copy & paste', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>
			<?php endif; ?>


			<tr valign="top">
				<th scope="row"><?= __('Create Page Privacy', 'janolaw-agb-hosting'); ?></th>
				<td><input type="hidden" name="janolaw_privacy_page_id" value ="<?= get_option('janolaw_privacy_page_id'); ?>" />
				<input type="checkbox" name="janolaw_privacy_page"
					value ="1" /> <small><?= __('Create a static page with pagetag included', 'janolaw-agb-hosting'); ?></small>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><h3><?= __('Howto', 'janolaw-agb-hosting'); ?></h3></th>
				<td><?= __('Check the Checkbox of the desired document to create the page automatically.', 'janolaw-agb-hosting'); ?>
				<br /><br />
					<i><?= __('Alternative:', 'janolaw_agb'); ?></i><br />
					<?= __('Insert one of the following Tags into any page to display the refering Janolaw document:', 'janolaw-agb-hosting'); ?>
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
				value="<?= __('Save Changes', 'janolaw-agb-hosting'); ?>" />
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
		$content =  preg_replace("/\[janolaw_(.*)\]/", _get_document($type[1]), $content);
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
		$cache_clear_msg = "<div style='border: border-left: #3ADF00 6px solid; padding-left: 10px;'>".__("Cleared cached documents!","janolaw-agb-hosting")."</div>";
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
		$file = url_get_contents($base_path.'_include.html');
		file_put_contents($cache_file, $file);
	}
	# PDF Links
	if (get_option('janolaw_pdf_top') == 1) {
		$pdftop = "<a class='janolaw-pdflink' href='".$base_path.".pdf' target='_blank'>".__("Download as PDF","janolaw-agb-hosting")."</a><br /><br />";
	}
	if (get_option('janolaw_pdf_bottom') == 1) {
		$pdfbottom = "<br /><br /><a class='janolaw-pdflink' href='".$base_path.".pdf' target='_blank'>".__("Download as PDF","janolaw-agb-hosting")."</a>";
	}
	# extract text
	if ($file = file_get_contents($cache_file)) {
		return $cache_clear_msg . $pdftop . $file . $pdfbottom;
	} else {
		return "<div style='border: #DF0101 1px solid; border-left: #DF0101 6px solid; padding-left: 10px; '>".__("Ein Fehler ist aufgetreten! Bitte &uuml;berpr&uuml;fen Sie ihre Janolaw UserID und ShopID in Ihrer Konfiguration und ob der Cache Pfad beschreibbar ist!","janolaw-agb-hosting")." # $language # $type # $base_path # $cache_file </div>";
	}
}

function url_get_contents ($Url) {
    if (!function_exists('curl_init')){ 
        $output = file_get_contents($Url);
        return $output;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

add_action('admin_menu', 'janolaw_agb_menu');
add_filter('the_content','janolaw_page');

?>