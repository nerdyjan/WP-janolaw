# Einbindungsanleitung WordPress / WooCommerce

## WordPress Version
Ab WordPress Version 3 wird die automatisierte Aktualisierung der deutschen Rechtstexte und der übersetzten Rechtstexte in englischer und französischer Sprache unterstützt.

## janolaw Versionshinweis
Bitte prüfen Sie ob Ihnen die Rechtstexte in der janolaw Version 3 zur Verfügung stehen. Dies ist der Fall, wenn die Texte im Jahr 2016 erstellt worden sind. Sollten Sie Zweifel haben, dann prüfen Sie nach dem Login in Ihrem persönlichen Bereich [My janolaw](https://www.janolaw.de/login.html) in der Übersicht das Datum der letzten Erstellung bzw. ob Sie den Menüpunkt [Stammdaten ändern](https://www.janolaw.de/myjanolaw/agb-service/#menu) haben. Mit einer einmaligen Neubeantwortung des gesamten Fragenkatalogs erhalten Sie automatisch die aktuellste Version.

## !!Wichtig!!
Bitte achten Sie auch darauf, welchen Service Sie erworben haben, ob es sich hierbei um die deutsche bzw. mehrsprachige Version handelt und ob darin nur das Impressum und die Datenschutzerklärung [Webseite](http://www.janolaw.de/internetrecht/firmen-webseiten/datenschutzerklaerung_impressum.html) enthalten sind bzw. auch die AGB, Widerrufsbelehrung und das Muster-Widerrufsformular für das Shopsystem WooCommerce [Internetshop](http://www.janolaw.de/internetrecht/internetshop/abmahnschutz-internetshop.html).

## Installation

1. Laden Sie den Ordner janolaw_agb in das Verzeichnis /wp-content/plugins/ oder benutzen Sie die Plugininstallation in ihrem Wordpres-Adminbereich

2. Rufen Sie nach der Installation das janolaw Plugin über **_Einstellungen_** auf.
Für die Einstellung und Aktivierung der Schnittstelle halten Sie bitte die von janolaw zur Verfügung gestellte User-ID / Kundennummer und die SHOP-ID / Rechtstexte-ID bereit. Ergänzen Sie diese bitte in den jeweiligen Textfeldern.
[My janolaw](https://www.janolaw.de/login.html)

![alt text](plugin_usersetting.png "janolaw AGB-Service Benutzerdaten")

3. Tragen Sie unter dem Menüpunkt Settings einen beschreibbaren Pfad ein damit die Dokumente dort gespeichert werden können. Bei Unix und Linux Systemen ist dies in der Regel `/tmp`. Sie haben die Möglichkeit die Rechtstexte als PDF Download im Header bzw. Footer auf den Webseiten anzeigen zu lassen. Setzen Sie dazu falls erwünscht einen Haken in der Auswahl „PDF top download“ bzw. „PDF bottom download“

![alt text](plugin_pluginsetting.png "janolaw AGB-Service Plugineinstellungen")

Bestätigen Sie die Eingabe durch den Button **_Save Changes_**. Es wird dann eine Überprüfung der Kennung und der verwendeten Version des Service angestoßen. Sie erhalten im Anschluss einen Hinweis über die verwendete janolaw Version. 

4. Über den Punkt **_Page creation_** können Sie die Seiten für die juristischen Dokumente vom System anlegen lassen.

**!!Wichtig!!**
Bei Verwendung einer alten janolaw Version legen Sie bitte für das Muster-Widerrufsformular eine neue Seite im Content Bereich an und kopieren den Inhalt des Muster-Widerrufsformulars per Hand herein. Wir empfehlen Ihnen aber die Dokumente in diesem Fall einmal über Ihren persönlichen Bereich [My janolaw](https://www.janolaw.de/login.html) neu zu erstellen.

![alt text](plugin_pagecreation.png "janolaw AGB-Service Seitenerstellung")

Alternativ stehen Ihnen aber auch Tags für die Einbindung auf den gewünschten Seiten zur Verfügung.


Seite | Tag
----- | ---
Impressum | [janolaw_impressum]
Datenschutzerklärung | [janolaw_datenschutzerklaerung]
AGB | [janolaw_agb]
Widerrufsbelehrung | [janolaw_widerrufsbelehrung]
Muster-Widerrufsformular | [janolaw_widerrufsformular] -> **_Nur für Version 3 verfügbar!!!_**

Bitte achten Sie bei der Nutzung der Tags auch darauf, welchen Service Sie erworben haben, ob darin nur das Impressum und die Datenschutzerklärung [Webseite](http://www.janolaw.de/internetrecht/firmen-webseiten/datenschutzerklaerung_impressum.html) enthalten sind bzw. auch die AGB, Widerrufsbelehrung und das Muster-Widerrufsformular [Internetshop](http://www.janolaw.de/internetrecht/internetshop/abmahnschutz-internetshop.html).

**_!!Wichtig!!_**

Bitte nehmen Sie eventuelle Änderungen an den janolaw Dokumenten ausschließlich auf www.janolaw.de vor. Dazu müssen Sie sich in den Bereich [My janolaw](https://www.janolaw.de/login.html) einloggen und dort die Dokumente ggf. neu erstellen.

### Allgemeine Problembehebung / Troubleshooting
Bitte prüfen Sie, ob Sie folgende Fehlerquellen ausschließen können:

- Bitte achten Sie darauf, welchen Service Sie erworben haben, ob darin nur das Impressum und die Datenschutzerklärung [Webseite](http://www.janolaw.de/internetrecht/firmen-webseiten/datenschutzerklaerung_impressum.html) enthalten sind bzw. alle Dokumente d.h. auch AGB, Widerrufsbelehrung und Muster-Widerrufsformular [Internetshop](http://www.janolaw.de/internetrecht/internetshop/abmahnschutz-internetshop.html).
- Wenn Sie ein PageContent Plugin / Widget / Theme bei Ihrer WordPress Installation verwenden, dann achten Sie bitte darauf, dass die Page-Tags ( [janolaw_...] ) für die Einbindung der Rechtstexte (vgl. Schritt 4) im Hauptbereich der Webseite verbleiben. Nur dann ist es möglich, dass die rechtlichen Dokumente in die Seiten eingespielt werden. Im Hauptbereich der entsprechenden Seite ist es aber zusätzlich möglich, eigene Inhalte VOR als auch NACH dem Page-Tag zu verwenden.
In zukünftigen Versionen werden wir dazu eine Prüfung einbauen, die Sie als Anwender darauf hinweisen wird.
- User-ID / Kundennummer bzw. SHOP-ID / Rechtstexte-ID korrekt eingetragen (ohne Leerzeichen) und nicht vertauscht?
- Wurde der janolaw Cachepath richtig eingetragen und ist dieser auch beschreibbar?
- PHP muss Zugriff auf andere URLs nehmen können, um dort Dateien runterladen zu können, in der php.ini des Servers muss allow_url_fopen aktiviert sein.


## E-Mail Templates
Die weiteren Punkte sind nur für Shopbetreiber relevant die z.B. WordPress in Kombination mit dem Shopsystem WooCommerce einsetzen.

Die Dokumente, AGB, Widerrufsbelehrung, Muster-Widerrufsformular und ab Mai 2018 die Datenschutzerklärung, müssen per E-Mail in der Auftragsbestätigung oder spätestens mit dem Warenversand dem Kunden zugeschickt werden.
Sie können die Dokumente als PDF umwandeln und als E-Mail Anhang der Auftragsbestätigung beifügen oder in die E-Mail selbst einfügen.

**_Wenn Sie Änderungen an den Dokumenten vornehmen, dann beachten Sie bitte, dass die Dokumente in der E-Mail nicht automatisch aktualisiert werden sondern Sie diese händisch austauschen müssen!_**

In einer zukünftigen Version wird auch dieses automatisiert vorgenommen werden.

### Shopsystem Problembehebung / Troubleshooting
Bitte prüfen Sie die Einbindung der Rechtstexte auf den Webseiten Ihres Online-Shops. Wenn die Einbindung korrekt erfolgt ist, werden die von Ihnen erstellten Dokumente über die Schnittstelle synchronisiert und automatisch in Ihrem Shop auf den jeweiligen Seiten aktualisiert.

#### Widerrufsrecht
Man muss beim Widerrufsrecht zwischen klassischer Versandware und Downloadprodukten unterscheiden. Daher bieten wir auch zwei unterschiedliche AGB Hosting-Services an.
Im Onlinehandel hat der Verbraucher ein Widerrufsrecht, über das ihn der Verkäufer belehren muss. Damit die Widerrufsfrist zu laufen beginnt, muss die vollständige Widerrufsbelehrung dem Kunden auch in Textform (statt bloß als HTML-Link) zugeschickt werden.

**_Bitte achten Sie darauf, Ihren Kunden spätestens mit der Warenlieferung auch Ihre AGB, Datenschutzerklärung und das Muster-Widerrufsformular (z.B. in Papierform) zuzusenden._**

#### Muster-Widerrufsformular
Das Muster-Widerrufsformular muss per E-Mail oder spätestens mit dem Warenversand zugeschickt werden. Zusätzlich muss das Widerrufsformular als weiterer Menüpunkt / Link in Ihren Internetshop neben den schon bestehenden Links für AGB, Impressum, Datenschutzerklärung, Widerrufsbelehrung und dem aktiven Link zur Online Streitbeilegungsplattform (OS-Plattform) angelegt werden.

#### Online Streitschlichtungsvorlage (OS-Plattform)
Nach der europäischen ODR-Verordnung (Verordnung über die außergerichtliche Online-Beilegung verbraucherrechtlicher Streitigkeiten) haben Unternehmer, die an Verbraucher verkaufen seit dem 9.Januar 2016 in ihren Webshops einen aktiven Link zur Online Streitbeilegungsplattform (OSPlattform) aufzunehmen.

**_Sie sollten den Link zur Plattform weder unter das Impressum noch in die AGB einfügen, da er dort als "versteckt" gelten könnte._**

**Hier unser Textvorschlag:**

`Die EU-Kommission stellt eine Plattform für außergerichtliche Streitschlichtung bereit. Verbrauchern gibt dies die Möglichkeit, Streitigkeiten im Zusammenhang mit ihrer Online-Bestellung zunächst außergerichtlich zu klären. Die Streitbeilegungs-Plattform finden Sie hier:`

`http://ec.europa.eu/consumers/odr/`

`Unsere E-Mail für Verbraucherbeschwerden lautet: ......@....`
