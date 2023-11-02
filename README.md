<h1>A5tratto-Theme</h1>
<h1>BETA</h1>
<h2>V.8.0.0.8</h2>
<h3>m</h3>

<p>Numero Versione</p>
<p>Tipologia ( origin 0, master 1)</p>
<p>git@github.com:a5tratto/a5tratto-theme.git</p>
<p>serie</p>
<p>numero</p>
<h2>Variabili</h2>
----
<code>{{v-dominio}}</code>
<p>dominio.com</p>
<br>
<code>{{v-dominio-old}}</code>  
<p>dominio-old.com</p>
<h2>Tematiche</h2>
----
<ul>
		<li id="01" class="cat-macro-mamp">MAMP / XAMPP
			<ul>
				<li id="02" target="1" >Impostazione Virtual Host
					<a href="https://www.venetoformazione.it/blog/come-creare-un-host-virtuale-su-mamp/">link</a>
					<p>Per impostare un virtual host bisogno andare su is eguenti file</p>
					<p>Aprire e Modificare da Termiale Bash</p>
					<ul>
						<li>httpd.conf
							<code>sudo nano /Applications/Mamp/conf/apache/httpd.conf</code>
							<p>Abilitare</p>
							<code>
								# Virtual hosts
								Include /Applications/MAMP/conf/apache/extra/httpd-vhosts.conf
							</code>	
						</li>
						<li>httpd-vhosts.conf
							<code>sudo nano /Applications/Mamp/conf/apache/extra/httpd-vhosts.conf</code>
							<p>Abilitare</p>
							<code>
								NameVirtualHost *:80
							</code>	
							<p>Aggiungere</p>
							<code>
								<VirtualHost *:80>
									DocumentRoot "/Users/giorgiorizza/SitiWeb/{{v-dominio}}/public_html"
									ServerName {{v-dominio}}
									ServerAlias http://www.{{v-dominio}}
								</VirtualHost>
							</code>	
							<p>Aleternativa</p>
							<code>
								<VirtualHost *:80>
								        ServerName giorgior5.sg-host.com
								        DocumentRoot /Users/giorgiorizza/SitiWeb/giorgior5.sg-host.com/public_html
								        <Directory>  /Users/giorgiorizza/SitiWeb/giorgior5.sg-host.com/public_html>
								                DirectoryIndex index.php
								                AllowOverride All
								                Order allow,deny
								                Allow from all
								        </Directory>
								</VirtualHost>
							</code>
						</li>
					</ul>	
				</li>
				<li id="03" target="1" >Impostaztioni Hosts
					<p>Modificare</p>
					<code>sudo nano /private/etc/hosts</code>
					<p>Aggiungere</p>
					<code>
						##
						# Host Database
						#
						# localhost is used to configure the loopback interface
						# when the system is booting.  Do not change this entry.
						##
						127.0.0.1	localhost
						255.255.255.255	broadcasthost
						::1             localhost
						127.0.0.1	{{v-dominio}}
					</code>
				</li>
				<li id="04">Cambio Porte</li>
				<li id="05" target="1">Import DB da terminale
					<p>Per importare un db di grandi dimensioni in MAMP utilizzare il seguente script</p>
					<p>Accedere</p>
					<code>/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot</code>
					<p>Selezioniamo DB </p>
					<code>use nome_db;</code>
					<p>Importa il DB direttamente dal desktop</p>
					<code>SET autocommit=0 ; source /Users/giorgiorizza/Desktop/nome_db.sql; COMMIT ;</code>
					<code>SET autocommit=0 ; source /Users/giorgiorizza/Downloads/dbxrgwjmsg4eeq-migrate-20210115115336.sql; COMMIT;</code>
					<a href="https://www.webnots.com/how-to-import-large-mysql-database-in-mamp-using-terminal/">link</a>
				</li>
			</ul>
		</li>
		<li id="5" class="cat-macro-siteground">SiteGorund
			<ul>
				<li id="06" target="1">Creazione sito temporaneo
					<p>
						<a href="https://my.siteground.com/websites/list">Accedi -> Web List</a><br>
						<a href="https://my.siteground.com/services/hosting/TFFqeVpINEtMdz09">Seleziona -> Piano A5TRATTO</a><br>
						<a href="https://tools.siteground.com/?siteId=TFEzMVpYNEpKQT09">Accedi -> Site Tools</a><br>
						<a href="https://my.siteground.com/website-wizard/">Crea -> Crea Nuovo Sito</a><br>
					</p>
				</li>
				<li id="07">Intallazione WP
					<ul>
						<li id="08">File da eliminre prima dell'installazione</li>
						<li id="09">Impostazione intallazione guidata WP</li>
						<li id="10">Clone WP</li>
					</ul>
				</li>
				<li id="11">GIT
					<ul>
						<li id="12" target="1">Impostazione .gitignore 
							<p>Inserire in un file .gitignore le seguenti regole per evitare di versionare i sui seguenti file</p>
							<code>
								wp-content/upgrade/*
								wp-content/backup-db/*
								wp-content/cache/*
								wp-content/cache/supercache/*
								wp-content/w3tc-cache/*
								wp-config.php
							</code>
						</li>
						<li id="13" target="1">Eliminare cache da .gitignore <br>
							<p>Andare sulla cartella principale e inserire il prescorso del file che non sta considerando .gitignore </p>
							<code>git rm --cached wp-config.php</code>
						</li>
						<li id="14">Impostazione GIT</li>
					</ul>
				</li>
				<li id="15">Creazione Utente SSH
					<a href="https://it.siteground.com/tutorial/ssh/">link</a>
					<ul>
						<li id="16">Intallazione chiave ssh sul pc</li>
							<p>Per generare una nuova chiave rsa devi andare sul terminale posizionarti nella root principale accedere alla cartella .ssh ed eseguire il seguente codice</p>
							<code>ssh-keygen</code>
						<li id="17">Intallazione chiave pubblica ssh sul server
							<a href="https://it.siteground.com/tutorial/ssh/abilitare/">link</a>
						</li>
						<li id="17" target="1">Copiare chiave pubblica in ssh
							<code>cat ~/.ssh/id_rsa.pub | pbcopy</code>
							<p>In talternativa non hai pbcopy come comando puoi usare questa </p>
							<code>cat ~/.ssh/id_rsa.pub</code>
						</li>
					</ul>
				</li>
				<li id="18">My SQL
					<ul>
						<li id="19">Import Export DB</li>
						<li id="20">Abilitazione DB Remoto
							<a href="https://it.siteground.com/kb/come-creare-una-connessione-remota-al-mio-database/">link</a>
						</li>
						<li id="21">Replace WP SQL</li>
					</ul>
				</li>
				<li id="22">SSL
					<ul>
						<li id="23">Attivaiozne SSL</li>
					</ul>
				</li>
				<li id="24">Email
					<a href="https://it.siteground.com/tutorial/email/">link</a>
					<ul>
						<li id="25">Creazione Mail</li>
						<li id="26">Migrazioen Mail</li>
						<li id="27">Redirect Mail</li>
						<li id="28">Impostazioni Mail</li>
					</ul>
				</li>
				<li id="29">FTP
					<ul>
						<li id="30">Crezione Utente</li>
						<li id="31">Impostazioni Utente e Cartelle</li>
						<li id="32"></li>
					</ul>
				</li>Ottimizzazioni
				<ul>
					<li id="33">SG Cache</li>
					<li id="34">Cloud Flare</li>
				</ul>
			</li>
		</ul>
	</li>
	<li id="35" class="cat-macro-wp">WP
		<ul>
			<li id="36">Impostazioni WP
				<ul>
					<li id="37">Aspetto</li>
					<li id="38">Impostazioni</li>
				</ul>
			</li>
			<li id="39">Multisite
				<ul>
					<li id="40">Attivazione Multisite</li>
					<li id="41">Replace DB SQL</li>
					<li id="42">Struttura</li>
					<li id="43">Utenti</li>
				</ul>
			</li>
			<li id="44">Plugin
				<ul>
					<li id="45">ACF <br>
						<code></code>					</li>
					<li id="46">Post Type</li>
					<li id="47">All Import</li>
					<li id="48">Sucuri</li>
					<li id="49"></li>
					<li id="50"></li>
					<li id="51"></li>
					<li id="52"></li>
					<li id="53"></li>
					<li id="54"></li>
				</ul>
			</li>
			<li id="55">A5T Theme
				<ul>
					<li id="56">Installazione A5T Theme</li>
					<li id="57">Aggioranmento A5T Theme</li>
					<li id="58">Creazione Child A5T Theme
						<a href="https://kinsta.com/it/blog/child-theme-wordpress/">link</a>
					</li>
					<li id="59">Core A5T Theme
						<ul>
							<li id="60">Assets
								<ul>
									<li id="61">assets <br> 
										<p>In questa cartella sono presenti i principali file di stile e tutte le principali librerie css e js che sono necessari </p>
									</li>
									<li id="62">animate-css</li>
									<li id="63">bootstrap-4.6.2-dist</li>
									<li id="64">butter-js</li>
									<li id="65">cocoen</li>
									<li id="66">font</li>
									<li id="67">hover-css</li>
									<li id="68">jarallax-master</li>
									<li id="69">magic-mouse-js</li>
									<li id="70">nprogress</li>
									<li id="71">owl-carousel</li>
									<li id="72">popper</li>
									<li id="73">cookiechoices.js</li>
									<li id="74">credits.js</li>
									<li id="75">custom.css</li>
									<li id="76">custom.js
										<p>A_SETTINGS loader<br>
											Qui viene è possibile personalizzare la classe di attivazione del loader con aggiunta di una classe .loaded al body dopo 1,5 secondi dall'inizio del caricamento della pagina <br>
											Successivamente viene fatto un controllo sulla tipologia di link per disabilitare il timeout per permettere di abilitare nuovamente la classe loaded per ottenre un effetto di transiozione fluido fra le pagine <br>
											A_SETTINGS animate <br>
											Qui puoi trovare impostazioni di animate.css dove per ogni classe inn__animate aggiunge la classe hidden e al viewport aggiunge le classi di animate.css con un delay di 300 ms <br>
											A_SETTINGS sticky <br>
											Impostazioni per far comparire lo sticky menu dopo lo scroll a 500px solo allo scoll verso il basso <br>
											A_SETTINGS magicMouse <br>
											Controllo della presenza della calsse attivante .magicmouse_active e successivamente impostazioni di base della libreria MagicMouse con attivazione dell'hover solo sulle classi specidificate <br>
										</p>
									</li>
									<li id="77">wp-admin.css <br>
										<p>Foglio di sitle utile per la personalizzazione dello stile del backend</p>
									</li>
									<li id="78">wp-admin.js</li>
								</ul>
							</li>
							<li id="67">Core
								<ul>
									<li id="68">config.php</li>
									<li id="69">plugin.php</li>
									<li id="70">customizer.php</li>
									<li id="71">activation.php</li>
									<li id="72">int.php</li>
									<li id="73"></li>
									<li id="74"></li>
								</ul>
							</li>
							<li id="75">Lang</li>
							<li id="76">Twig</li>
							<li id="77">Vendor
								<ul>
									<li id="78">kint-php</li>
									<li id="79">composer</li>
									<li id="80">athari</li>
								</ul>
							</li>
							<li id="81">function.php</li>
							<li id="82">wp-cli
								<a href="https://it.siteground.com/tutorial/wordpress/wp-cli/">link</a>
							</li>
						</ul>
					</li>
					<li id="83">Template
						<p>per il template bisongo prima compredere la sua gerarchia
							<img src="https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png" alt="">
						Images: ![Images](https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png)</p>
						Images: ![Images](https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png)
						<ul>
							<li id="84">404.php</li>
							<li id="85">archive.php</li>
							<li id="86">author.php</li>
							<li id="87">category.php</li>
							<li id="88">base.php</li>
							<li id="89">index.php</li>
							<li id="90">search.php</li>
							<li id="91">searchform.php</li>
							<li id="92">single.php</li>
							<li id="93">tag.php</li>
							<li id="94">taxonomy.php</li>
							<li id="95">template-home.php</li>
							<li id="96">template-custom.php</li>
							<li id="97">footer.php</li>
							<li id="98">header.php</li>
							<li id="99">menu.php</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
	</li>
</ul>




Test Markdown document
======================

Text
----

Here is a paragraph with bold text. **This is some bold text.** Here is a paragraph with bold text. __This is also some
bold text.__

Here is another one with italic text. *This is some italic text.* Here is another one with italic text. _This is some
italic text._

Here is another one with struckout text. ~~This is some struckout text.~~


Links
-----

Autolink: <http://example.com>

Link: [Example](http://example.com)

Reference style [link][1].

[1]: http://example.com  "Example"


Images
------

Image: ![My image](https://www.jetbrains.com/phpstorm/img/screenshots/2020.1/phpstorm_debugging@2x.png)

Headers
-------

# First level title

## Second level title

### Third level title

#### Fourth level title

##### Fifth level title

###### Sixth level title

### Title with [link](http://localhost)

### Title with ![image](http://localhost)

Code
----

```
This
is
code
fence
```

Inline `code span in a` paragraph.

This is a code block:

/**

* Sorts the specified array into ascending numerical order.
*
* <p>Implementation note: The sorting algorithm is a Dual-Pivot Quicksort
  * by Vladimir Yaroslavskiy, Jon Bentley, and Joshua Bloch. This algorithm
  * offers O(n log(n)) performance on many data sets that cause other
  * quicksorts to degrade to quadratic performance, and is typically
  * faster than traditional (one-pivot) Quicksort implementations.
  *
  * @param a the array to be sorted
  */
  public static void sort(byte[] a) {
  DualPivotQuicksort.sort(a);

}

Quotes
------

> This is the first level of quoting.
>
> > This is nested blockquote.
>
> Back to the first level.


> A list within a blockquote:
>
> * asterisk 1
> * asterisk 2
> * asterisk 3


> Formatting within a blockquote:
>
> ### header
> Link: [Example](http://example.com)



Html
-------

This is inline <span>html</html>. And this is an html block.

	<table>
	<tr>
	<th>Column 1</th>
	<th>Column 2</th>
	</tr>
	<tr>
	<td>Row 1 Cell 1</td>
	<td>Row 1 Cell 2</td>
	</tr>
	<tr>
	<td>Row 2 Cell 1</td>
	<td>Row 2 Cell 2</td>
	</tr>
	</table>

	Horizontal rules
	----------------

	---

	___


	***


	Lists
	-----

	Unordered list:

	*	asterisk 1
	*	asterisk 2
	*	asterisk 3


	Ordered list:

	1.	First
	2.	Second
	3.	Third


	Mixed:

	1. First
	2. Second:
	* Fee
	* Fie
	* Foe
	3. Third


	Tables:

	| Header 1 | Header 2 |
	| -------- | -------- |
	| Data 1   | Data 2   |


# The Timber Starter Theme

The "_s" for Timber: a dead-simple theme that you can build from. The primary purpose of this theme is to provide a file structure rather than a framework for markup or styles. Configure your Sass, scripts, and task runners however you would like!

[![Build Status](https://travis-ci.com/timber/starter-theme.svg?branch=master)](https://travis-ci.come/github/timber/starter-theme)

## Installing the Theme

Install this theme as you would any other, and be sure the Timber plugin is activated. But hey, let's break it down into some bullets:

1. Make sure you have installed the plugin for the [Timber Library](https://wordpress.org/plugins/timber-library/) (and Advanced Custom Fields - they [play quite nicely](https://timber.github.io/docs/guides/acf-cookbook/#nav) together). 
2. Download the zip for this theme (or clone it) and move it to `wp-content/themes` in your WordPress installation. 
3. Rename the folder to something that makes sense for your website (generally no spaces and all lowercase). You could keep the name `timber-starter-theme` but the point of a starter theme is to make it your own!
4. Activate the theme in Appearance >  Themes.
5. Do your thing! And read [the docs](https://timber.github.io/docs/).

## What's here?

`static/` is where you can keep your static front-end scripts, styles, or images. In other words, your Sass files, JS files, fonts, and SVGs would live here.

`templates/` contains all of your Twig templates. These pretty much correspond 1 to 1 with the PHP files that respond to the WordPress template hierarchy. At the end of each PHP template, you'll notice a `Timber::render()` function whose first parameter is the Twig file where that data (or `$context`) will be used. Just an FYI.

`bin/` and `tests/` ... basically don't worry about (or remove) these unless you know what they are and want to.

## Other Resources

* [This branch](https://github.com/laras126/timber-starter-theme/tree/tackle-box) of the starter theme has some more example code with ACF and a slightly different set up.
* [Twig for Timber Cheatsheet](http://notlaura.com/the-twig-for-timber-cheatsheet/)
* [Timber and Twig Reignited My Love for WordPress](https://css-tricks.com/timber-and-twig-reignited-my-love-for-wordpress/) on CSS-Tricks
* [A real live Timber theme](https://github.com/laras126/yuling-theme).
* [Timber Video Tutorials](http://timber.github.io/timber/#video-tutorials) and [an incomplete set of screencasts](https://www.youtube.com/playlist?list=PLuIlodXmVQ6pkqWyR6mtQ5gQZ6BrnuFx-) for building a Timber theme from scratch.

