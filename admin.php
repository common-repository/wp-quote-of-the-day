<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="fb-root"></div>

<script>(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.9";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<div class="wrap">
	<div class="quote_options">
		<h2>WP Quote Of The Day settings</h2>
		<div class="tab">
			<button data-tabname="design" id="tab_design" class="tablinks  active">
				<span class="dashicons  dashicons-format-quote"></span>&nbsp Quotes Settings
			</button>
			<button data-tabname="template" id="tab_template" class="tablinks">
				<span class="dashicons dashicons-welcome-view-site"></span>&nbsp Interstitial Layout Settings
			</button>
			<button data-tabname="ads" id="tab_ads" class="tablinks">
				<span class="dashicons dashicons-palmtree"></span>&nbsp Banner Settings
			</button>
			<button data-tabname="redirect" id="tab_redirect" class="tablinks">
				<span class="dashicons dashicons-external"></span>&nbsp Interstitial Behavior Setting
			</button>
			<button data-tabname="api" id="tab_api" class="tablinks">
				<span class="dashicons dashicons-cloud"></span>&nbsp Activate
			</button>
		</div>
		<form about="" method="post">
			<input type="hidden" name="banner_is_iframe" value="0">
			<?php echo ( WpQuoteOfTheDay::is_premium() ) ? '<input type="hidden" name="circle_enable" value="0">' : ''; ?>
			<input type="hidden" name="font_bold" value="0">
			<input type="hidden" name="font_italic" value="0">
			<input type="hidden" name="author_font_bold" value="0">
			<input type="hidden" name="author_font_italic" value="0">

			<div id="template" class="tabcontent">
				<table class="form-table">
					<tbody>

					<tr>
						<th class="row">Skip button text</th>
						<td><input value="<?php echo get_option( 'quote_skip_text', 'Continue to website' ) ?>"
						           type="text"
								<?php echo ( ! WpQuoteOfTheDay::is_premium() ) ? 'disabled="disabled"' : ''; ?>
								   name="skip_text"></td>
					</tr>
					<tr>
						<th class="row">Skip button font size</th>
						<td><input value="<?php echo get_option( 'quote_skip_font_size', '14' ) ?>"
						           type="number"
								<?php echo ( ! WpQuoteOfTheDay::is_premium() ) ? 'disabled="disabled"' : ''; ?>
								   name="skip_font_size"></td>
					</tr>
					<tr>
						<th class="row">
							Skip button color
						</th>
						<td>
							<input value="<?php echo get_option( 'quote_skip_background_color', '#222' ) ?>"
							       type="color"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
							       name="skip_background_color">
							&nbsp <b>Hover:</b> &nbsp
							<input value="<?php echo get_option( 'quote_skip_background_hover_color', '#767676' ) ?>"
							       type="color"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
							       name="skip_background_hover_color">
						</td>
					</tr>
					<tr>
						<th class="row">Background color</th>
						<td>
							<input value="<?php echo get_option( 'quote_background_color', '#000000' ) ?>"
							       type="color"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
							       name="background_color">
							&nbsp <b>Opacity:</b> &nbsp
							<input value="<?php echo get_option( 'quote_background_opacity', '90' ) ?>"
							       type="number"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
							       min="1" max="100"
							       name="background_opacity">&nbsp %
						</td>
					</tr>
					<tr>
						<th class="row">Enable circle</th>
						<td><input <?php echo get_option( 'quote_circle_enable', true ) ? 'checked="checked"' : '' ?>
								type="checkbox"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
								value="1"
								name="circle_enable"></td>
					</tr>
					<tr>
						<th class="row">Circle color</th>
						<td><input value="<?php echo get_option( 'quote_circle_color', '#ffffff' ) ?>"
						           type="color"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
						           name="circle_color"></td>
					</tr>
					</tbody>
				</table>
			</div>

			<div style="display: block"  id="design" class="tabcontent">
				<?php
				$font_array = [
					'ABeeZee',
					'Abel',
					'Abril Fatface',
					'Aclonica',
					'Acme',
					'Actor',
					'Adamina',
					'Advent Pro',
					'Aguafina Script',
					'Akronim',
					'Aladin',
					'Aldrich',
					'Alegreya',
					'Alegreya SC',
					'Alex Brush',
					'Alfa Slab One',
					'Alice',
					'Alike',
					'Alike Angular',
					'Allan',
					'Allerta',
					'Allerta Stencil',
					'Allura',
					'Almendra',
					'Almendra Display',
					'Almendra SC',
					'Amarante',
					'Amaranth',
					'Amatic SC',
					'Amethysta',
					'Anaheim',
					'Andada',
					'Andika',
					'Angkor',
					'Annie Use Your Telescope',
					'Anonymous Pro',
					'Antic',
					'Antic Didone',
					'Antic Slab',
					'Anton',
					'Arapey',
					'Arbutus',
					'Arbutus Slab',
					'Architects Daughter',
					'Archivo Black',
					'Archivo Narrow',
					'Arimo',
					'Arizonia',
					'Armata',
					'Artifika',
					'Arvo',
					'Asap',
					'Asset',
					'Astloch',
					'Asul',
					'Atomic Age',
					'Aubrey',
					'Audiowide',
					'Autour One',
					'Average',
					'Average Sans',
					'Averia Gruesa Libre',
					'Averia Libre',
					'Averia Sans Libre',
					'Averia Serif Libre',
					'Bad Script',
					'Balthazar',
					'Bangers',
					'Basic',
					'Battambang',
					'Baumans',
					'Bayon',
					'Belgrano',
					'Belleza',
					'BenchNine',
					'Bentham',
					'Berkshire Swash',
					'Bevan',
					'Bigelow Rules',
					'Bigshot One',
					'Bilbo',
					'Bilbo Swash Caps',
					'Bitter',
					'Black Ops One',
					'Bokor',
					'Bonbon',
					'Boogaloo',
					'Bowlby One',
					'Bowlby One SC',
					'Brawler',
					'Bree Serif',
					'Bubblegum Sans',
					'Bubbler One',
					'Buda',
					'Buenard',
					'Butcherman',
					'Butterfly Kids',
					'Cabin',
					'Cabin Condensed',
					'Cabin Sketch',
					'Caesar Dressing',
					'Cagliostro',
					'Calligraffitti',
					'Cambo',
					'Candal',
					'Cantarell',
					'Cantata One',
					'Cantora One',
					'Capriola',
					'Cardo',
					'Carme',
					'Carrois Gothic',
					'Carrois Gothic SC',
					'Carter One',
					'Caudex',
					'Cedarville Cursive',
					'Ceviche One',
					'Changa One',
					'Chango',
					'Chau Philomene One',
					'Chela One',
					'Chelsea Market',
					'Chenla',
					'Cherry Cream Soda',
					'Cherry Swash',
					'Chewy',
					'Chicle',
					'Chivo',
					'Cinzel',
					'Cinzel Decorative',
					'Clicker Script',
					'Coda',
					'Coda Caption',
					'Codystar',
					'Combo',
					'Comfortaa',
					'Coming Soon',
					'Concert One',
					'Condiment',
					'Content',
					'Contrail One',
					'Convergence',
					'Cookie',
					'Copse',
					'Corben',
					'Courgette',
					'Cousine',
					'Coustard',
					'Covered By Your Grace',
					'Crafty Girls',
					'Creepster',
					'Crete Round',
					'Crimson Text',
					'Croissant One',
					'Crushed',
					'Cuprum',
					'Cutive',
					'Cutive Mono',
					'Damion',
					'Dancing Script',
					'Dangrek',
					'Dawning of a New Day',
					'Days One',
					'Delius',
					'Delius Swash Caps',
					'Delius Unicase',
					'Della Respira',
					'Devonshire',
					'Didact Gothic',
					'Diplomata',
					'Diplomata SC',
					'Doppio One',
					'Dorsa',
					'Dosis',
					'Dr Sugiyama',
					'Droid Sans',
					'Droid Sans Mono',
					'Droid Serif',
					'Duru Sans',
					'Dynalight',
					'EB Garamond',
					'Eagle Lake',
					'Eater',
					'Economica',
					'Electrolize',
					'Emblema One',
					'Emilys Candy',
					'Engagement',
					'Englebert',
					'Enriqueta',
					'Erica One',
					'Esteban',
					'Euphoria Script',
					'Ewert',
					'Exo',
					'Expletus Sans',
					'Fanwood Text',
					'Fascinate',
					'Fascinate Inline',
					'Faster One',
					'Fasthand',
					'Federant',
					'Federo',
					'Felipa',
					'Fenix',
					'Finger Paint',
					'Fjord One',
					'Flamenco',
					'Flavors',
					'Fondamento',
					'Fontdiner Swanky',
					'Forum',
					'Francois One',
					'Freckle Face',
					'Fredericka the Great',
					'Fredoka One',
					'Freehand',
					'Fresca',
					'Frijole',
					'Fugaz One',
					'GFS Didot',
					'GFS Neohellenic',
					'Gafata',
					'Galdeano',
					'Galindo',
					'Gentium Basic',
					'Gentium Book Basic',
					'Geo',
					'Geostar',
					'Geostar Fill',
					'Germania One',
					'Gilda Display',
					'Give You Glory',
					'Glass Antiqua',
					'Glegoo',
					'Gloria Hallelujah',
					'Goblin One',
					'Gochi Hand',
					'Gorditas',
					'Goudy Bookletter 1911',
					'Graduate',
					'Gravitas One',
					'Great Vibes',
					'Griffy',
					'Gruppo',
					'Gudea',
					'Habibi',
					'Hammersmith One',
					'Hanalei',
					'Hanalei Fill',
					'Handlee',
					'Hanuman',
					'Happy Monkey',
					'Headland One',
					'Henny Penny',
					'Herr Von Muellerhoff',
					'Holtwood One SC',
					'Homemade Apple',
					'Homenaje',
					'IM Fell DW Pica',
					'IM Fell DW Pica SC',
					'IM Fell Double Pica',
					'IM Fell Double Pica SC',
					'IM Fell English',
					'IM Fell English SC',
					'IM Fell French Canon',
					'IM Fell French Canon SC',
					'IM Fell Great Primer',
					'IM Fell Great Primer SC',
					'Iceberg',
					'Iceland',
					'Imprima',
					'Inconsolata',
					'Inder',
					'Indie Flower',
					'Inika',
					'Irish Grover',
					'Istok Web',
					'Italiana',
					'Italianno',
					'Jacques Francois',
					'Jacques Francois Shadow',
					'Jim Nightshade',
					'Jockey One',
					'Jolly Lodger',
					'Josefin Sans',
					'Josefin Slab',
					'Joti One',
					'Judson',
					'Julee',
					'Julius Sans One',
					'Junge',
					'Jura',
					'Just Another Hand',
					'Just Me Again Down Here',
					'Kameron',
					'Karla',
					'Kaushan Script',
					'Keania One',
					'Kelly Slab',
					'Kenia',
					'Khmer',
					'Kite One',
					'Knewave',
					'Kotta One',
					'Koulen',
					'Kranky',
					'Kreon',
					'Kristi',
					'Krona One',
					'La Belle Aurore',
					'Lancelot',
					'Lato',
					'League Script',
					'Leckerli One',
					'Ledger',
					'Lekton',
					'Lemon',
					'Life Savers',
					'Lilita One',
					'Limelight',
					'Linden Hill',
					'Lobster',
					'Lobster Two',
					'Londrina Outline',
					'Londrina Shadow',
					'Londrina Sketch',
					'Londrina Solid',
					'Lora',
					'Love Ya Like A Sister',
					'Loved by the King',
					'Lovers Quarrel',
					'Luckiest Guy',
					'Lusitana',
					'Lustria',
					'Macondo',
					'Macondo Swash Caps',
					'Magra',
					'Maiden Orange',
					'Mako',
					'Marcellus',
					'Marcellus SC',
					'Marck Script',
					'Margarine',
					'Marko One',
					'Marmelad',
					'Marvel',
					'Mate',
					'Mate SC',
					'Maven Pro',
					'McLaren',
					'Meddon',
					'MedievalSharp',
					'Medula One',
					'Megrim',
					'Meie Script',
					'Merienda',
					'Merienda One',
					'Merriweather',
					'Metal',
					'Metal Mania',
					'Metamorphous',
					'Metrophobic',
					'Michroma',
					'Miltonian',
					'Miltonian Tattoo',
					'Miniver',
					'Miss Fajardose',
					'Modern Antiqua',
					'Molengo',
					'Molle',
					'Monofett',
					'Monoton',
					'Monsieur La Doulaise',
					'Montaga',
					'Montez',
					'Montserrat',
					'Montserrat Alternates',
					'Montserrat Subrayada',
					'Moul',
					'Moulpali',
					'Mountains of Christmas',
					'Mouse Memoirs',
					'Mr Bedfort',
					'Mr Dafoe',
					'Mr De Haviland',
					'Mrs Saint Delafield',
					'Mrs Sheppards',
					'Muli',
					'Mystery Quest',
					'Neucha',
					'Neuton',
					'News Cycle',
					'Niconne',
					'Nixie One',
					'Nobile',
					'Nokora',
					'Norican',
					'Nosifer',
					'Nothing You Could Do',
					'Noticia Text',
					'Nova Cut',
					'Nova Flat',
					'Nova Mono',
					'Nova Oval',
					'Nova Round',
					'Nova Script',
					'Nova Slim',
					'Nova Square',
					'Numans',
					'Nunito',
					'Odor Mean Chey',
					'Offside',
					'Old Standard TT',
					'Oldenburg',
					'Oleo Script',
					'Oleo Script Swash Caps',
					'Open Sans',
					'Open Sans Condensed',
					'Oranienbaum',
					'Orbitron',
					'Oregano',
					'Orienta',
					'Original Surfer',
					'Oswald',
					'Over the Rainbow',
					'Overlock',
					'Overlock SC',
					'Ovo',
					'Oxygen',
					'Oxygen Mono',
					'PT Mono',
					'PT Sans',
					'PT Sans Caption',
					'PT Sans Narrow',
					'PT Serif',
					'PT Serif Caption',
					'Pacifico',
					'Paprika',
					'Parisienne',
					'Passero One',
					'Passion One',
					'Patrick Hand',
					'Patua One',
					'Paytone One',
					'Peralta',
					'Permanent Marker',
					'Petit Formal Script',
					'Petrona',
					'Philosopher',
					'Piedra',
					'Pinyon Script',
					'Pirata One',
					'Plaster',
					'Play',
					'Playball',
					'Playfair Display',
					'Playfair Display SC',
					'Podkova',
					'Poiret One',
					'Poller One',
					'Poly',
					'Pompiere',
					'Pontano Sans',
					'Port Lligat Sans',
					'Port Lligat Slab',
					'Prata',
					'Preahvihear',
					'Press Start 2P',
					'Princess Sofia',
					'Prociono',
					'Prosto One',
					'Puritan',
					'Purple Purse',
					'Quando',
					'Quantico',
					'Quattrocento',
					'Quattrocento Sans',
					'Questrial',
					'Quicksand',
					'Quintessential',
					'Qwigley',
					'Racing Sans One',
					'Radley',
					'Raleway',
					'Raleway Dots',
					'Rambla',
					'Rammetto One',
					'Ranchers',
					'Rancho',
					'Rationale',
					'Redressed',
					'Reenie Beanie',
					'Revalia',
					'Ribeye',
					'Ribeye Marrow',
					'Righteous',
					'Risque',
					'Rochester',
					'Rock Salt',
					'Rokkitt',
					'Romanesco',
					'Ropa Sans',
					'Rosario',
					'Rosarivo',
					'Rouge Script',
					'Ruda',
					'Rufina',
					'Ruge Boogie',
					'Ruluko',
					'Rum Raisin',
					'Ruslan Display',
					'Russo One',
					'Ruthie',
					'Rye',
					'Sacramento',
					'Sail',
					'Salsa',
					'Sanchez',
					'Sancreek',
					'Sansita One',
					'Sarina',
					'Satisfy',
					'Scada',
					'Schoolbell',
					'Seaweed Script',
					'Sevillana',
					'Seymour One',
					'Shadows Into Light',
					'Shadows Into Light Two',
					'Shanti',
					'Share',
					'Share Tech',
					'Share Tech Mono',
					'Shojumaru',
					'Short Stack',
					'Siemreap',
					'Sigmar One',
					'Signika',
					'Signika Negative',
					'Simonetta',
					'Sirin Stencil',
					'Six Caps',
					'Skranji',
					'Slackey',
					'Smokum',
					'Smythe',
					'Sniglet',
					'Snippet',
					'Snowburst One',
					'Sofadi One',
					'Sofia',
					'Sonsie One',
					'Sorts Mill Goudy',
					'Source Code Pro',
					'Source Sans Pro',
					'Special Elite',
					'Spicy Rice',
					'Spinnaker',
					'Spirax',
					'Squada One',
					'Stalemate',
					'Stalinist One',
					'Stardos Stencil',
					'Stint Ultra Condensed',
					'Stint Ultra Expanded',
					'Stoke',
					'Strait',
					'Sue Ellen Francisco',
					'Sunshiney',
					'Supermercado One',
					'Suwannaphum',
					'Swanky and Moo Moo',
					'Syncopate',
					'Tangerine',
					'Taprom',
					'Telex',
					'Tenor Sans',
					'Text Me One',
					'The Girl Next Door',
					'Tienne',
					'Tinos',
					'Titan One',
					'Titillium Web',
					'Trade Winds',
					'Trocchi',
					'Trochut',
					'Trykker',
					'Tulpen One',
					'Ubuntu',
					'Ubuntu Condensed',
					'Ubuntu Mono',
					'Ultra',
					'Uncial Antiqua',
					'Underdog',
					'Unica One',
					'UnifrakturCook',
					'UnifrakturMaguntia',
					'Unkempt',
					'Unlock',
					'Unna',
					'VT323',
					'Vampiro One',
					'Varela',
					'Varela Round',
					'Vast Shadow',
					'Vibur',
					'Vidaloka',
					'Viga',
					'Voces',
					'Volkhov',
					'Vollkorn',
					'Voltaire',
					'Waiting for the Sunrise',
					'Wallpoet',
					'Walter Turncoat',
					'Warnes',
					'Wellfleet',
					'Wire One',
					'Yanone Kaffeesatz',
					'Yellowtail',
					'Yeseva One',
					'Yesteryear',
					'Zeyada'
				];
				?>
				<table class="form-table">
					<tbody>

					<tr>
						<th class="row">Quotes category</th>
						<td>
							<select
								name="category"
								id="quote_category">
								<option value="">Select Category</option>
								<?php
								foreach ( WpQuoteOfTheDay::get_categories() as $row ) {
									$selected = selected( get_option( 'quote_category' ), $row->id, false );
									echo "<option {$selected}  value='{$row->id}'>" . ucfirst( $row->topic ) . "</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th class="row">Quote text color</th>
						<td><input value="<?php echo get_option( 'quote_quote_color', '#ffffff' ) ?>"
						           type="color"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
						           name="quote_color"></td>
					</tr>
					<tr>
						<th class="row">Quote author color</th>
						<td><input value="<?php echo get_option( 'quote_author_color', '#ffffff' ) ?>"
						           type="color"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
						           name="author_color"></td>
					</tr>
					<tr>
						<th class="row">Quote Font</th>
						<td>
							<select
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
								id="font_selector"
								name="font">
								<option value="">Select Font</option>
								<?php
								foreach ( $font_array as $font ) {
									$selected = selected( get_option( 'quote_font' ), $font, false );
									echo "<option {$selected} value='{$font}'>{$font}</option>";
								}

								?>
							</select>&nbsp<label>Bold:
								<input <?php echo get_option( 'quote_font_bold', '0' ) ? 'checked' : '' ?>
									type="checkbox"
									<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
									id="font_bold"
									value="1"
									name="font_bold">
							</label><label>Italic:
								<input <?php echo get_option( 'quote_font_italic', '0' ) ? 'checked' : '' ?>
									type="checkbox"
									<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
									id="font_italic"
									value="1"
									name="font_italic">
							</label>
							<label>Size:</label>
							<input
								type="number"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
								name="font_size"
								placeholder="px"
								style="width:50px;"
								min="0"
								value="<?php echo get_option( 'quote_font_size', '18' ) ?>">

						</td>
					</tr>
					<tr>
						<th class="row">Quote font example</th>
						<td><abbr style="font-size: 16px;" class="font_example">Example Text</abbr></td>
					</tr>
					<tr>
						<th class="row">Author font</th>
						<td><select
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
								id="author_font_selector"
								name="author_font">
								<option value="">Select Font</option>
								<?php
								foreach ( $font_array as $font ) {
									$selected = selected( get_option( 'quote_author_font' ), $font, false );
									echo "<option {$selected} value='{$font}'>{$font}</option>";
								}
								?>
							</select>&nbsp<label>Bold:
								<input <?php echo get_option( 'quote_author_font_bold', '0' ) ? 'checked' : '' ?>
									type="checkbox"
									<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
									id="author_font_bold"
									value="1"
									name="author_font_bold">
							</label><label>Italic:
								<input <?php echo get_option( 'quote_author_font_italic', '0' ) ? 'checked' : '' ?>
									type="checkbox"
									<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
									id="author_font_italic"
									value="1"
									name="author_font_italic">
							</label>
							<label>Size:
								<input
									type="number"
									<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
									name="author_font_size"
									placeholder="px"
									style="width:50px;"
									min="0"
									value="<?php echo get_option( 'quote_author_font_size', '18' ) ?>"></label><br>
						</td>
					</tr>
					<tr>
						<th class="row">Author font example</th>
						<td><abbr style="font-size: 16px;" class="author_font_example">Example Text</abbr></td>
					</tr>
					<?php if(WpQuoteOfTheDay::is_premium()): ?>
					<tr>
						<th class="row">Get new quote</th>
						<td><a
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled" href="#"':'href="'.admin_url().' ?page=wp-quote-oftd&get_new_quote"';?>
								class="button">
								Get new quote</a>
							<p class="description">
								<b>Today's Quote:</b><br>
								<span>
									<?php echo json_decode( get_option( 'quote_today', [ 'quote' => '' ] ) )->quote ?>
								</span>
								<br>
								<span style="float:right;">
									-<?php echo json_decode( get_option( 'quote_today', [ 'author' => '' ] ) )->author ?>
								</span>
							</p>
						</td>
					</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>

			<div id="ads" class="tabcontent">
				<table class="form-table">
					<tbody>
					<tr>
						<th class="row">
							<label>Ad type</label>
						</th>
						<td>
							<select id="banner_is_iframe" name="banner_is_iframe">
								<option <?php selected( get_option( 'quote_banner_is_iframe' ), '' ); ?> value="">None
								</option>
								<option <?php selected( get_option( 'quote_banner_is_iframe' ), '1' ); ?> value="1">
									AdTag
								</option>
								<option <?php selected( get_option( 'quote_banner_is_iframe' ), '0' ); ?> value="0">
									Image
								</option>
							</select>
						</td>
					</tr>
					<tr class="image-row">
						<th class="row">
							<label>Banner image</label>
						</th>
						<td class="row">
							<input
								id="image-url"
								type="text"
								value="<?php echo get_option( 'quote_banner_img_url', '' ) ?>"
								name="banner_img_url"/>
							<input id="upload-button" type="button" class="button" value="Upload Image"/>
						</td>
					</tr>
					<tr class="image-row">
						<th class="row">Banner destination url</th>
						<td>
							<input value="<?php echo get_option( 'quote_banner_redirect_url', '' ) ?>"
							       type="url"
							       name="banner_redirect_url">
						</td>
					</tr>
					<tr class="iframe-row">
						<th class="row">Ad code</th>
						<td>
							<textarea
								name="iframe_url"><?php echo get_option( 'quote_iframe_url', '' ) ?></textarea>
						</td>
					</tr>

					</tbody>
				</table>
			</div>

			<div id="redirect" class="tabcontent">
				<table class="form-table">
					<tbody>
					<tr>
						<th class="row">Show quote on:</th>
						<td>
							<select
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
								multiple
								name="show_on[]"
								id="show_on">
								<?php
								$post_types = [
									'all'      => 'The Entire Site',
									'home'     => 'Home page',
									'page'     => 'Page',
									'post'     => 'Post',
									'category' => 'Category',
									'blog'     => 'Blog',
									'tag'      => 'Tag'
								];
								$show_on    = get_option( 'quote_show_on', [ ] );
								foreach ( $post_types as $i => $v ) {
									$selected = ( in_array( $i, $show_on ) ) ? 'selected' : '';
									echo "<option {$selected} value='{$i}'>{$v }</option>";
								}
								?>
							</select>
							<p class="description">Hold ctrl to select more than one page</p>
						</td>
					</tr>
					<tr>
						<th class="row">Skip Button Redirect</th>
						<td>
							<select
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
								name="redirect"
								id="quote_redirect">
								<option selected value="">Same Page</option>
								<?php
								foreach ( get_pages( [ 'post_type' => 'page' ] ) as $page ) {
									$selected = selected( get_option( 'quote_redirect' ), $page->guid, false );
									echo "<option {$selected} value='{$page->guid}'>{$page->post_title}</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th class="row">Countdown duration</th>
						<td><input value="<?php echo get_option( 'quote_redirect_delay', '5' ) ?>"
						           type="number"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
						           min="1"
						           name="redirect_delay">seconds
						</td>
					</tr>
					<tr>
						<th class="row">Force redirect duration</th>
						<td><input value="<?php echo get_option( 'quote_force_redirect_delay', '15' ) ?>"
						           type="number"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
						           min="1"
						           name="force_redirect_delay">seconds
						</td>
					</tr>
					<tr>
						<th class="row">Interstitial Frequency Capping</th>
						<td>
							<input value="<?php echo get_option( 'quote_period', '0' ) ?>"
							       type="number"
								<?php echo (!WpQuoteOfTheDay::is_premium())?'disabled="disabled"':'';?>
							       min="0"
							       name="period"> Days
							<p class="description">Keep 0 to show on every visit</p>
						</td>
					</tr>
					</tbody>
				</table>
			</div>

			<div id="api" class="tabcontent">
				<table class="form-table">
					<tbody>
					<?php if(WpQuoteOfTheDay::is_premium()): ?>
					<tr>
						<th class="row"></th>
						<td>
							<span>
							You have
								<b>
								<?php
								echo WpQuoteOfTheDay::$user_data->plan - WpQuoteOfTheDay::$user_data->calls;
								?>
								</b>
							 API credits left this month

							</span>
						</td>
					</tr>
					<?php endif; ?>
					<tr>
						<th class="row">API KEY (Token)</th>
						<td>
							<input type="text" value="<?php echo get_option( 'quote_token', '' ) ?>" name="token">

						</td>
					</tr>
					<tr>
						<th class="row">API EMAIL ID</th>
						<td>
							<input type="email" value="<?php echo get_option( 'quote_user_id', '' ) ?>" name="user_id">

						</td>
					</tr>


					</tbody>
				</table>
			</div>

			<table class="form-table">
				<tbody>
				<tr>
					<th><input class="button-primary action" type="submit" name="save_quote" value="Save"></th>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
	<div class="quote_description">
		<div class="quote--embeded-container">
			<iframe src="https://www.youtube.com/embed/LoQuAgOhUGI"
			        frameborder="0" allowfullscreen class="quote--embeded"></iframe>
		</div>
		
		<?php if(!WpQuoteOfTheDay::is_premium()): ?>
		<a target="_blank" href="http://wpquoteoftheday.com/shop/">
			<img style="margin:1% 0;" width="240" src="<?php echo plugin_dir_url( __FILE__ ).'img/banner.jpg';?>">
		</a>
		<?php endif; ?>
		<h3>Plugin Support</h3><br>
		<p>Plugin Support website: <a target="_blank" href="http://wpquoteoftheday.com">http://wpquoteoftheday.com/</a>
		</p>
		<p><b>Want to use this plugin on more than 1 website?</b></p>
		<p>Buy more quote tokens here: <a target="_blank"
		                                  href="http://clk.im/GetMoreQuotes">http://clk.im/GetMoreQuotes</a></p>
		<div class="fb-like" data-href="http://wpquoteoftheday.com" data-layout="standard" data-action="like"
		     data-size="small" data-show-faces="true" data-share="false"></div>

	</div>
</div>
