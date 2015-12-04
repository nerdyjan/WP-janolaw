=== Janolaw AGB Hosting ===
Tags: legal documents, shop, imprint, disclaimer, privacy
Requires at least: 3.0
Tested up to: 4.3
Stable tag: 3.1

This plugin get legal documents provided by janolaw AG (commercial service) like AGB, Imprint etc. for Webshops and Pages. (German Service only)

== Description ==

This plugin get legal documents provided by janolaw AG (commercial service) like terms of use, imprint etc. for webshops and pages.
For more Informations visit: http://www.janolaw.de/internetrecht/agb/agb-hosting-service/ and http://www.janolaw.de/agb-service/einbindung-wordpress.html#menu
The service provide german, english and french documents!

== Installation ==

1. Upload the folder `janolaw_agb` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enter your personal IDs provided by janolaw AG at `Settings -> janolaw AGB Service` (UserID / ShopID)
4. Enter a path writeable for the Webserver to cache documents (should be by default: /tmp on most linux/unix systems)
5. Use the following tags at the desired pages [janolaw_agb], [janolaw_impressum], [janolaw_widerrufsbelehrung], [janolaw_datenschutzerklaerung]
6. Done !

Opional: if you change the language of the documents, it may be necessary to rename the title tags of the desired pages.

== Frequently Asked Questions ==

= What if i have a question? =

Please contact janolaw for support at support@janolaw.de

= Howto style the documents?

Use this CSS !

	#janolaw-body ol li {
		list-style: upper-roman;
		margin-left: 40px;
	}
	#janolaw-paragraph {
		color: #555;
		font-size: 14px;
		font-weight: bold;
		margin: 10px 0 10px;
		padding: 0 0 5px;
	}
	#janolaw-absatz {

	}
	.janolaw-text {
		font-size: 12px;
		margin-left: 40px;
	}

== Screenshots ==

1. Janolaw Settings

== Changelog ==

= 3.1 =

* enhanced content creation, include your own content below page-tags ([janolaw_..])

= 3.0 =
* added support for Wordpress 4.3
* added widerrufsbelehrung Form
* added clear cache button
* added PDF download of documents if PDF provided by janolaw
* added service availability check
* added language selection for documents at backend
* added language selection by browser
* service update notification 
* fixed permalink generation
* enhanced plugin messages for info, notice and errors

= 2.2 =
* added multilanguage files for English + German

= 2.1 =
* fixed privacy page

= 2.0 =
* tmp folder predefined default
* checkboxes for automatic page creation to makes it even simpler for users to install

= 1.0 =
* Initial Version

