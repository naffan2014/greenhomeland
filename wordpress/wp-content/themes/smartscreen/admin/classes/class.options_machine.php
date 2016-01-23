<?php 
/**
 * HT Framework Options Machine Class
 * this class will generate html elements for admin options
 *
 */

class Options_Machine {

	/**
	 * PHP5 contructor
	 *
	 */
	


	function __construct($options) {
		
		$return = $this->optionsframework_machine($options);
		
		$this->Inputs = $return[0];
		$this->Menu = $return[1];
		$this->Defaults = $return[2];
		
	}


	
	/**
	 * Process options data and build option fields
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @return array
	 */
	public static function optionsframework_machine($options) {
	
	    $data = get_option(OPTIONS);
		
		$defaults = array();   
	    $counter = 0;
		$menu = '';
		$output = '';
	
$google_faces['ABeeZee'] = 'ABeeZee';
$google_faces['Abel'] = 'Abel';
$google_faces['Abril Fatface'] = 'Abril Fatface';
$google_faces['Aclonica'] = 'Aclonica';
$google_faces['Acme'] = 'Acme';
$google_faces['Actor'] = 'Actor';
$google_faces['Adamina'] = 'Adamina';
$google_faces['Advent Pro'] = 'Advent Pro';
$google_faces['Aguafina Script'] = 'Aguafina Script';
$google_faces['Akronim'] = 'Akronim';
$google_faces['Aladin'] = 'Aladin';
$google_faces['Aldrich'] = 'Aldrich';
$google_faces['Alegreya'] = 'Alegreya';
$google_faces['Alegreya SC'] = 'Alegreya SC';
$google_faces['Alex Brush'] = 'Alex Brush';
$google_faces['Alfa Slab One'] = 'Alfa Slab One';
$google_faces['Alice'] = 'Alice';
$google_faces['Alike'] = 'Alike';
$google_faces['Alike Angular'] = 'Alike Angular';
$google_faces['Allan'] = 'Allan';
$google_faces['Allerta'] = 'Allerta';
$google_faces['Allerta Stencil'] = 'Allerta Stencil';
$google_faces['Allura'] = 'Allura';
$google_faces['Almendra'] = 'Almendra';
$google_faces['Almendra Display'] = 'Almendra Display';
$google_faces['Almendra SC'] = 'Almendra SC';
$google_faces['Amarante'] = 'Amarante';
$google_faces['Amaranth'] = 'Amaranth';
$google_faces['Amatic SC'] = 'Amatic SC';
$google_faces['Amethysta'] = 'Amethysta';
$google_faces['Anaheim'] = 'Anaheim';
$google_faces['Andada'] = 'Andada';
$google_faces['Andika'] = 'Andika';
$google_faces['Angkor'] = 'Angkor';
$google_faces['Annie Use Your Telescope'] = 'Annie Use Your Telescope';
$google_faces['Anonymous Pro'] = 'Anonymous Pro';
$google_faces['Antic'] = 'Antic';
$google_faces['Antic Didone'] = 'Antic Didone';
$google_faces['Antic Slab'] = 'Antic Slab';
$google_faces['Anton'] = 'Anton';
$google_faces['Arapey'] = 'Arapey';
$google_faces['Arbutus'] = 'Arbutus';
$google_faces['Arbutus Slab'] = 'Arbutus Slab';
$google_faces['Architects Daughter'] = 'Architects Daughter';
$google_faces['Archivo Black'] = 'Archivo Black';
$google_faces['Archivo Narrow'] = 'Archivo Narrow';
$google_faces['Arimo'] = 'Arimo';
$google_faces['Arizonia'] = 'Arizonia';
$google_faces['Armata'] = 'Armata';
$google_faces['Artifika'] = 'Artifika';
$google_faces['Arvo'] = 'Arvo';
$google_faces['Asap'] = 'Asap';
$google_faces['Asset'] = 'Asset';
$google_faces['Astloch'] = 'Astloch';
$google_faces['Asul'] = 'Asul';
$google_faces['Atomic Age'] = 'Atomic Age';
$google_faces['Aubrey'] = 'Aubrey';
$google_faces['Audiowide'] = 'Audiowide';
$google_faces['Autour One'] = 'Autour One';
$google_faces['Average'] = 'Average';
$google_faces['Average Sans'] = 'Average Sans';
$google_faces['Averia Gruesa Libre'] = 'Averia Gruesa Libre';
$google_faces['Averia Libre'] = 'Averia Libre';
$google_faces['Averia Sans Libre'] = 'Averia Sans Libre';
$google_faces['Averia Serif Libre'] = 'Averia Serif Libre';
$google_faces['Bad Script'] = 'Bad Script';
$google_faces['Balthazar'] = 'Balthazar';
$google_faces['Bangers'] = 'Bangers';
$google_faces['Basic'] = 'Basic';
$google_faces['Battambang'] = 'Battambang';
$google_faces['Baumans'] = 'Baumans';
$google_faces['Bayon'] = 'Bayon';
$google_faces['Belgrano'] = 'Belgrano';
$google_faces['Belleza'] = 'Belleza';
$google_faces['BenchNine'] = 'BenchNine';
$google_faces['Bentham'] = 'Bentham';
$google_faces['Berkshire Swash'] = 'Berkshire Swash';
$google_faces['Bevan'] = 'Bevan';
$google_faces['Bigelow Rules'] = 'Bigelow Rules';
$google_faces['Bigshot One'] = 'Bigshot One';
$google_faces['Bilbo'] = 'Bilbo';
$google_faces['Bilbo Swash Caps'] = 'Bilbo Swash Caps';
$google_faces['Bitter'] = 'Bitter';
$google_faces['Black Ops One'] = 'Black Ops One';
$google_faces['Bokor'] = 'Bokor';
$google_faces['Bonbon'] = 'Bonbon';
$google_faces['Boogaloo'] = 'Boogaloo';
$google_faces['Bowlby One'] = 'Bowlby One';
$google_faces['Bowlby One SC'] = 'Bowlby One SC';
$google_faces['Brawler'] = 'Brawler';
$google_faces['Bree Serif'] = 'Bree Serif';
$google_faces['Bubblegum Sans'] = 'Bubblegum Sans';
$google_faces['Bubbler One'] = 'Bubbler One';
$google_faces['Buda'] = 'Buda';
$google_faces['Buenard'] = 'Buenard';
$google_faces['Butcherman'] = 'Butcherman';
$google_faces['Butterfly Kids'] = 'Butterfly Kids';
$google_faces['Cabin'] = 'Cabin';
$google_faces['Cabin Condensed'] = 'Cabin Condensed';
$google_faces['Cabin Sketch'] = 'Cabin Sketch';
$google_faces['Caesar Dressing'] = 'Caesar Dressing';
$google_faces['Cagliostro'] = 'Cagliostro';
$google_faces['Calligraffitti'] = 'Calligraffitti';
$google_faces['Cambo'] = 'Cambo';
$google_faces['Candal'] = 'Candal';
$google_faces['Cantarell'] = 'Cantarell';
$google_faces['Cantata One'] = 'Cantata One';
$google_faces['Cantora One'] = 'Cantora One';
$google_faces['Capriola'] = 'Capriola';
$google_faces['Cardo'] = 'Cardo';
$google_faces['Carme'] = 'Carme';
$google_faces['Carrois Gothic'] = 'Carrois Gothic';
$google_faces['Carrois Gothic SC'] = 'Carrois Gothic SC';
$google_faces['Carter One'] = 'Carter One';
$google_faces['Caudex'] = 'Caudex';
$google_faces['Cedarville Cursive'] = 'Cedarville Cursive';
$google_faces['Ceviche One'] = 'Ceviche One';
$google_faces['Changa One'] = 'Changa One';
$google_faces['Chango'] = 'Chango';
$google_faces['Chau Philomene One'] = 'Chau Philomene One';
$google_faces['Chela One'] = 'Chela One';
$google_faces['Chelsea Market'] = 'Chelsea Market';
$google_faces['Chenla'] = 'Chenla';
$google_faces['Cherry Cream Soda'] = 'Cherry Cream Soda';
$google_faces['Cherry Swash'] = 'Cherry Swash';
$google_faces['Chewy'] = 'Chewy';
$google_faces['Chicle'] = 'Chicle';
$google_faces['Chivo'] = 'Chivo';
$google_faces['Cinzel'] = 'Cinzel';
$google_faces['Cinzel Decorative'] = 'Cinzel Decorative';
$google_faces['Clicker Script'] = 'Clicker Script';
$google_faces['Coda'] = 'Coda';
$google_faces['Coda Caption'] = 'Coda Caption';
$google_faces['Codystar'] = 'Codystar';
$google_faces['Combo'] = 'Combo';
$google_faces['Comfortaa'] = 'Comfortaa';
$google_faces['Coming Soon'] = 'Coming Soon';
$google_faces['Concert One'] = 'Concert One';
$google_faces['Condiment'] = 'Condiment';
$google_faces['Content'] = 'Content';
$google_faces['Contrail One'] = 'Contrail One';
$google_faces['Convergence'] = 'Convergence';
$google_faces['Cookie'] = 'Cookie';
$google_faces['Copse'] = 'Copse';
$google_faces['Corben'] = 'Corben';
$google_faces['Courgette'] = 'Courgette';
$google_faces['Cousine'] = 'Cousine';
$google_faces['Coustard'] = 'Coustard';
$google_faces['Covered By Your Grace'] = 'Covered By Your Grace';
$google_faces['Crafty Girls'] = 'Crafty Girls';
$google_faces['Creepster'] = 'Creepster';
$google_faces['Crete Round'] = 'Crete Round';
$google_faces['Crimson Text'] = 'Crimson Text';
$google_faces['Croissant One'] = 'Croissant One';
$google_faces['Crushed'] = 'Crushed';
$google_faces['Cuprum'] = 'Cuprum';
$google_faces['Cutive'] = 'Cutive';
$google_faces['Cutive Mono'] = 'Cutive Mono';
$google_faces['Damion'] = 'Damion';
$google_faces['Dancing Script'] = 'Dancing Script';
$google_faces['Dangrek'] = 'Dangrek';
$google_faces['Dawning of a New Day'] = 'Dawning of a New Day';
$google_faces['Days One'] = 'Days One';
$google_faces['Delius'] = 'Delius';
$google_faces['Delius Swash Caps'] = 'Delius Swash Caps';
$google_faces['Delius Unicase'] = 'Delius Unicase';
$google_faces['Della Respira'] = 'Della Respira';
$google_faces['Denk One'] = 'Denk One';
$google_faces['Devonshire'] = 'Devonshire';
$google_faces['Didact Gothic'] = 'Didact Gothic';
$google_faces['Diplomata'] = 'Diplomata';
$google_faces['Diplomata SC'] = 'Diplomata SC';
$google_faces['Domine'] = 'Domine';
$google_faces['Donegal One'] = 'Donegal One';
$google_faces['Doppio One'] = 'Doppio One';
$google_faces['Dorsa'] = 'Dorsa';
$google_faces['Dosis'] = 'Dosis';
$google_faces['Dr Sugiyama'] = 'Dr Sugiyama';
$google_faces['Droid Sans'] = 'Droid Sans';
$google_faces['Droid Sans Mono'] = 'Droid Sans Mono';
$google_faces['Droid Serif'] = 'Droid Serif';
$google_faces['Duru Sans'] = 'Duru Sans';
$google_faces['Dynalight'] = 'Dynalight';
$google_faces['Eagle Lake'] = 'Eagle Lake';
$google_faces['Eater'] = 'Eater';
$google_faces['EB Garamond'] = 'EB Garamond';
$google_faces['Economica'] = 'Economica';
$google_faces['Electrolize'] = 'Electrolize';
$google_faces['Elsie'] = 'Elsie';
$google_faces['Elsie Swash Caps'] = 'Elsie Swash Caps';
$google_faces['Emblema One'] = 'Emblema One';
$google_faces['Emilys Candy'] = 'Emilys Candy';
$google_faces['Engagement'] = 'Engagement';
$google_faces['Englebert'] = 'Englebert';
$google_faces['Enriqueta'] = 'Enriqueta';
$google_faces['Erica One'] = 'Erica One';
$google_faces['Esteban'] = 'Esteban';
$google_faces['Euphoria Script'] = 'Euphoria Script';
$google_faces['Ewert'] = 'Ewert';
$google_faces['Exo'] = 'Exo';
$google_faces['Expletus Sans'] = 'Expletus Sans';
$google_faces['Fanwood Text'] = 'Fanwood Text';
$google_faces['Fascinate'] = 'Fascinate';
$google_faces['Fascinate Inline'] = 'Fascinate Inline';
$google_faces['Faster One'] = 'Faster One';
$google_faces['Fasthand'] = 'Fasthand';
$google_faces['Federant'] = 'Federant';
$google_faces['Federo'] = 'Federo';
$google_faces['Felipa'] = 'Felipa';
$google_faces['Fenix'] = 'Fenix';
$google_faces['Finger Paint'] = 'Finger Paint';
$google_faces['Fjalla One'] = 'Fjalla One';
$google_faces['Fjord One'] = 'Fjord One';
$google_faces['Flamenco'] = 'Flamenco';
$google_faces['Flavors'] = 'Flavors';
$google_faces['Fondamento'] = 'Fondamento';
$google_faces['Fontdiner Swanky'] = 'Fontdiner Swanky';
$google_faces['Forum'] = 'Forum';
$google_faces['Francois One'] = 'Francois One';
$google_faces['Freckle Face'] = 'Freckle Face';
$google_faces['Fredericka the Great'] = 'Fredericka the Great';
$google_faces['Fredoka One'] = 'Fredoka One';
$google_faces['Freehand'] = 'Freehand';
$google_faces['Fresca'] = 'Fresca';
$google_faces['Frijole'] = 'Frijole';
$google_faces['Fruktur'] = 'Fruktur';
$google_faces['Fugaz One'] = 'Fugaz One';
$google_faces['Gafata'] = 'Gafata';
$google_faces['Galdeano'] = 'Galdeano';
$google_faces['Galindo'] = 'Galindo';
$google_faces['Gentium Basic'] = 'Gentium Basic';
$google_faces['Gentium Book Basic'] = 'Gentium Book Basic';
$google_faces['Geo'] = 'Geo';
$google_faces['Geostar'] = 'Geostar';
$google_faces['Geostar Fill'] = 'Geostar Fill';
$google_faces['Germania One'] = 'Germania One';
$google_faces['GFS Didot'] = 'GFS Didot';
$google_faces['GFS Neohellenic'] = 'GFS Neohellenic';
$google_faces['Gilda Display'] = 'Gilda Display';
$google_faces['Give You Glory'] = 'Give You Glory';
$google_faces['Glass Antiqua'] = 'Glass Antiqua';
$google_faces['Glegoo'] = 'Glegoo';
$google_faces['Gloria Hallelujah'] = 'Gloria Hallelujah';
$google_faces['Goblin One'] = 'Goblin One';
$google_faces['Gochi Hand'] = 'Gochi Hand';
$google_faces['Gorditas'] = 'Gorditas';
$google_faces['Goudy Bookletter 1911'] = 'Goudy Bookletter 1911';
$google_faces['Graduate'] = 'Graduate';
$google_faces['Grand Hotel'] = 'Grand Hotel';
$google_faces['Gravitas One'] = 'Gravitas One';
$google_faces['Great Vibes'] = 'Great Vibes';
$google_faces['Griffy'] = 'Griffy';
$google_faces['Gruppo'] = 'Gruppo';
$google_faces['Gudea'] = 'Gudea';
$google_faces['Habibi'] = 'Habibi';
$google_faces['Hammersmith One'] = 'Hammersmith One';
$google_faces['Hanalei'] = 'Hanalei';
$google_faces['Hanalei Fill'] = 'Hanalei Fill';
$google_faces['Handlee'] = 'Handlee';
$google_faces['Hanuman'] = 'Hanuman';
$google_faces['Happy Monkey'] = 'Happy Monkey';
$google_faces['Headland One'] = 'Headland One';
$google_faces['Henny Penny'] = 'Henny Penny';
$google_faces['Herr Von Muellerhoff'] = 'Herr Von Muellerhoff';
$google_faces['Holtwood One SC'] = 'Holtwood One SC';
$google_faces['Homemade Apple'] = 'Homemade Apple';
$google_faces['Homenaje'] = 'Homenaje';
$google_faces['Iceberg'] = 'Iceberg';
$google_faces['Iceland'] = 'Iceland';
$google_faces['IM Fell Double Pica'] = 'IM Fell Double Pica';
$google_faces['IM Fell Double Pica SC'] = 'IM Fell Double Pica SC';
$google_faces['IM Fell DW Pica'] = 'IM Fell DW Pica';
$google_faces['IM Fell DW Pica SC'] = 'IM Fell DW Pica SC';
$google_faces['IM Fell English'] = 'IM Fell English';
$google_faces['IM Fell English SC'] = 'IM Fell English SC';
$google_faces['IM Fell French Canon'] = 'IM Fell French Canon';
$google_faces['IM Fell French Canon SC'] = 'IM Fell French Canon SC';
$google_faces['IM Fell Great Primer'] = 'IM Fell Great Primer';
$google_faces['IM Fell Great Primer SC'] = 'IM Fell Great Primer SC';
$google_faces['Imprima'] = 'Imprima';
$google_faces['Inconsolata'] = 'Inconsolata';
$google_faces['Inder'] = 'Inder';
$google_faces['Indie Flower'] = 'Indie Flower';
$google_faces['Inika'] = 'Inika';
$google_faces['Irish Grover'] = 'Irish Grover';
$google_faces['Istok Web'] = 'Istok Web';
$google_faces['Italiana'] = 'Italiana';
$google_faces['Italianno'] = 'Italianno';
$google_faces['Jacques Francois'] = 'Jacques Francois';
$google_faces['Jacques Francois Shadow'] = 'Jacques Francois Shadow';
$google_faces['Jim Nightshade'] = 'Jim Nightshade';
$google_faces['Jockey One'] = 'Jockey One';
$google_faces['Jolly Lodger'] = 'Jolly Lodger';
$google_faces['Josefin Sans'] = 'Josefin Sans';
$google_faces['Josefin Slab'] = 'Josefin Slab';
$google_faces['Joti One'] = 'Joti One';
$google_faces['Judson'] = 'Judson';
$google_faces['Julee'] = 'Julee';
$google_faces['Julius Sans One'] = 'Julius Sans One';
$google_faces['Junge'] = 'Junge';
$google_faces['Jura'] = 'Jura';
$google_faces['Just Another Hand'] = 'Just Another Hand';
$google_faces['Just Me Again Down Here'] = 'Just Me Again Down Here';
$google_faces['Kameron'] = 'Kameron';
$google_faces['Karla'] = 'Karla';
$google_faces['Kaushan Script'] = 'Kaushan Script';
$google_faces['Kavoon'] = 'Kavoon';
$google_faces['Keania One'] = 'Keania One';
$google_faces['Kelly Slab'] = 'Kelly Slab';
$google_faces['Kenia'] = 'Kenia';
$google_faces['Khmer'] = 'Khmer';
$google_faces['Kite One'] = 'Kite One';
$google_faces['Knewave'] = 'Knewave';
$google_faces['Kotta One'] = 'Kotta One';
$google_faces['Koulen'] = 'Koulen';
$google_faces['Kranky'] = 'Kranky';
$google_faces['Kreon'] = 'Kreon';
$google_faces['Kristi'] = 'Kristi';
$google_faces['Krona One'] = 'Krona One';
$google_faces['La Belle Aurore'] = 'La Belle Aurore';
$google_faces['Lancelot'] = 'Lancelot';
$google_faces['Lato'] = 'Lato';
$google_faces['League Script'] = 'League Script';
$google_faces['Leckerli One'] = 'Leckerli One';
$google_faces['Ledger'] = 'Ledger';
$google_faces['Lekton'] = 'Lekton';
$google_faces['Lemon'] = 'Lemon';
$google_faces['Libre Baskerville'] = 'Libre Baskerville';
$google_faces['Life Savers'] = 'Life Savers';
$google_faces['Lilita One'] = 'Lilita One';
$google_faces['Limelight'] = 'Limelight';
$google_faces['Linden Hill'] = 'Linden Hill';
$google_faces['Lobster'] = 'Lobster';
$google_faces['Lobster Two'] = 'Lobster Two';
$google_faces['Londrina Outline'] = 'Londrina Outline';
$google_faces['Londrina Shadow'] = 'Londrina Shadow';
$google_faces['Londrina Sketch'] = 'Londrina Sketch';
$google_faces['Londrina Solid'] = 'Londrina Solid';
$google_faces['Lora'] = 'Lora';
$google_faces['Love Ya Like A Sister'] = 'Love Ya Like A Sister';
$google_faces['Loved by the King'] = 'Loved by the King';
$google_faces['Lovers Quarrel'] = 'Lovers Quarrel';
$google_faces['Luckiest Guy'] = 'Luckiest Guy';
$google_faces['Lusitana'] = 'Lusitana';
$google_faces['Lustria'] = 'Lustria';
$google_faces['Macondo'] = 'Macondo';
$google_faces['Macondo Swash Caps'] = 'Macondo Swash Caps';
$google_faces['Magra'] = 'Magra';
$google_faces['Maiden Orange'] = 'Maiden Orange';
$google_faces['Mako'] = 'Mako';
$google_faces['Marcellus'] = 'Marcellus';
$google_faces['Marcellus SC'] = 'Marcellus SC';
$google_faces['Marck Script'] = 'Marck Script';
$google_faces['Margarine'] = 'Margarine';
$google_faces['Marko One'] = 'Marko One';
$google_faces['Marmelad'] = 'Marmelad';
$google_faces['Marvel'] = 'Marvel';
$google_faces['Mate'] = 'Mate';
$google_faces['Mate SC'] = 'Mate SC';
$google_faces['Maven Pro'] = 'Maven Pro';
$google_faces['McLaren'] = 'McLaren';
$google_faces['Meddon'] = 'Meddon';
$google_faces['MedievalSharp'] = 'MedievalSharp';
$google_faces['Medula One'] = 'Medula One';
$google_faces['Megrim'] = 'Megrim';
$google_faces['Meie Script'] = 'Meie Script';
$google_faces['Merienda'] = 'Merienda';
$google_faces['Merienda One'] = 'Merienda One';
$google_faces['Merriweather'] = 'Merriweather';
$google_faces['Metal'] = 'Metal';
$google_faces['Metal Mania'] = 'Metal Mania';
$google_faces['Metamorphous'] = 'Metamorphous';
$google_faces['Metrophobic'] = 'Metrophobic';
$google_faces['Michroma'] = 'Michroma';
$google_faces['Milonga'] = 'Milonga';
$google_faces['Miltonian'] = 'Miltonian';
$google_faces['Miltonian Tattoo'] = 'Miltonian Tattoo';
$google_faces['Miniver'] = 'Miniver';
$google_faces['Miss Fajardose'] = 'Miss Fajardose';
$google_faces['Modern Antiqua'] = 'Modern Antiqua';
$google_faces['Molengo'] = 'Molengo';
$google_faces['Molle'] = 'Molle';
$google_faces['Monda'] = 'Monda';
$google_faces['Monofett'] = 'Monofett';
$google_faces['Monoton'] = 'Monoton';
$google_faces['Monsieur La Doulaise'] = 'Monsieur La Doulaise';
$google_faces['Montaga'] = 'Montaga';
$google_faces['Montez'] = 'Montez';
$google_faces['Montserrat'] = 'Montserrat';
$google_faces['Montserrat Alternates'] = 'Montserrat Alternates';
$google_faces['Montserrat Subrayada'] = 'Montserrat Subrayada';
$google_faces['Moul'] = 'Moul';
$google_faces['Moulpali'] = 'Moulpali';
$google_faces['Mountains of Christmas'] = 'Mountains of Christmas';
$google_faces['Mouse Memoirs'] = 'Mouse Memoirs';
$google_faces['Mr Bedfort'] = 'Mr Bedfort';
$google_faces['Mr Dafoe'] = 'Mr Dafoe';
$google_faces['Mr De Haviland'] = 'Mr De Haviland';
$google_faces['Mrs Saint Delafield'] = 'Mrs Saint Delafield';
$google_faces['Mrs Sheppards'] = 'Mrs Sheppards';
$google_faces['Muli'] = 'Muli';
$google_faces['Mystery Quest'] = 'Mystery Quest';
$google_faces['Neucha'] = 'Neucha';
$google_faces['Neuton'] = 'Neuton';
$google_faces['New Rocker'] = 'New Rocker';
$google_faces['News Cycle'] = 'News Cycle';
$google_faces['Niconne'] = 'Niconne';
$google_faces['Nixie One'] = 'Nixie One';
$google_faces['Nobile'] = 'Nobile';
$google_faces['Nokora'] = 'Nokora';
$google_faces['Norican'] = 'Norican';
$google_faces['Nosifer'] = 'Nosifer';
$google_faces['Nothing You Could Do'] = 'Nothing You Could Do';
$google_faces['Noticia Text'] = 'Noticia Text';
$google_faces['Nova Cut'] = 'Nova Cut';
$google_faces['Nova Flat'] = 'Nova Flat';
$google_faces['Nova Mono'] = 'Nova Mono';
$google_faces['Nova Oval'] = 'Nova Oval';
$google_faces['Nova Round'] = 'Nova Round';
$google_faces['Nova Script'] = 'Nova Script';
$google_faces['Nova Slim'] = 'Nova Slim';
$google_faces['Nova Square'] = 'Nova Square';
$google_faces['Numans'] = 'Numans';
$google_faces['Nunito'] = 'Nunito';
$google_faces['Odor Mean Chey'] = 'Odor Mean Chey';
$google_faces['Offside'] = 'Offside';
$google_faces['Old Standard TT'] = 'Old Standard TT';
$google_faces['Oldenburg'] = 'Oldenburg';
$google_faces['Oleo Script'] = 'Oleo Script';
$google_faces['Oleo Script Swash Caps'] = 'Oleo Script Swash Caps';
$google_faces['Open Sans'] = 'Open Sans';
$google_faces['Open Sans Condensed'] = 'Open Sans Condensed';
$google_faces['Oranienbaum'] = 'Oranienbaum';
$google_faces['Orbitron'] = 'Orbitron';
$google_faces['Oregano'] = 'Oregano';
$google_faces['Orienta'] = 'Orienta';
$google_faces['Original Surfer'] = 'Original Surfer';
$google_faces['Oswald'] = 'Oswald';
$google_faces['Over the Rainbow'] = 'Over the Rainbow';
$google_faces['Overlock'] = 'Overlock';
$google_faces['Overlock SC'] = 'Overlock SC';
$google_faces['Ovo'] = 'Ovo';
$google_faces['Oxygen'] = 'Oxygen';
$google_faces['Oxygen Mono'] = 'Oxygen Mono';
$google_faces['Pacifico'] = 'Pacifico';
$google_faces['Paprika'] = 'Paprika';
$google_faces['Parisienne'] = 'Parisienne';
$google_faces['Passero One'] = 'Passero One';
$google_faces['Passion One'] = 'Passion One';
$google_faces['Patrick Hand'] = 'Patrick Hand';
$google_faces['Patua One'] = 'Patua One';
$google_faces['Paytone One'] = 'Paytone One';
$google_faces['Peralta'] = 'Peralta';
$google_faces['Permanent Marker'] = 'Permanent Marker';
$google_faces['Petit Formal Script'] = 'Petit Formal Script';
$google_faces['Petrona'] = 'Petrona';
$google_faces['Philosopher'] = 'Philosopher';
$google_faces['Piedra'] = 'Piedra';
$google_faces['Pinyon Script'] = 'Pinyon Script';
$google_faces['Pirata One'] = 'Pirata One';
$google_faces['Plaster'] = 'Plaster';
$google_faces['Play'] = 'Play';
$google_faces['Playball'] = 'Playball';
$google_faces['Playfair Display'] = 'Playfair Display';
$google_faces['Playfair Display SC'] = 'Playfair Display SC';
$google_faces['Podkova'] = 'Podkova';
$google_faces['Poiret One'] = 'Poiret One';
$google_faces['Poller One'] = 'Poller One';
$google_faces['Poly'] = 'Poly';
$google_faces['Pompiere'] = 'Pompiere';
$google_faces['Pontano Sans'] = 'Pontano Sans';
$google_faces['Port Lligat Sans'] = 'Port Lligat Sans';
$google_faces['Port Lligat Slab'] = 'Port Lligat Slab';
$google_faces['Prata'] = 'Prata';
$google_faces['Preahvihear'] = 'Preahvihear';
$google_faces['Press Start 2P'] = 'Press Start 2P';
$google_faces['Princess Sofia'] = 'Princess Sofia';
$google_faces['Prociono'] = 'Prociono';
$google_faces['Prosto One'] = 'Prosto One';
$google_faces['PT Mono'] = 'PT Mono';
$google_faces['PT Sans'] = 'PT Sans';
$google_faces['PT Sans Caption'] = 'PT Sans Caption';
$google_faces['PT Sans Narrow'] = 'PT Sans Narrow';
$google_faces['PT Serif'] = 'PT Serif';
$google_faces['PT Serif Caption'] = 'PT Serif Caption';
$google_faces['Puritan'] = 'Puritan';
$google_faces['Purple Purse'] = 'Purple Purse';
$google_faces['Quando'] = 'Quando';
$google_faces['Quantico'] = 'Quantico';
$google_faces['Quattrocento'] = 'Quattrocento';
$google_faces['Quattrocento Sans'] = 'Quattrocento Sans';
$google_faces['Questrial'] = 'Questrial';
$google_faces['Quicksand'] = 'Quicksand';
$google_faces['Quintessential'] = 'Quintessential';
$google_faces['Qwigley'] = 'Qwigley';
$google_faces['Racing Sans One'] = 'Racing Sans One';
$google_faces['Radley'] = 'Radley';
$google_faces['Raleway'] = 'Raleway';
$google_faces['Raleway Dots'] = 'Raleway Dots';
$google_faces['Rambla'] = 'Rambla';
$google_faces['Rammetto One'] = 'Rammetto One';
$google_faces['Ranchers'] = 'Ranchers';
$google_faces['Rancho'] = 'Rancho';
$google_faces['Rationale'] = 'Rationale';
$google_faces['Redressed'] = 'Redressed';
$google_faces['Reenie Beanie'] = 'Reenie Beanie';
$google_faces['Revalia'] = 'Revalia';
$google_faces['Ribeye'] = 'Ribeye';
$google_faces['Ribeye Marrow'] = 'Ribeye Marrow';
$google_faces['Righteous'] = 'Righteous';
$google_faces['Risque'] = 'Risque';
$google_faces['Roboto'] = 'Roboto';
$google_faces['Roboto Condensed'] = 'Roboto Condensed';
$google_faces['Rochester'] = 'Rochester';
$google_faces['Rock Salt'] = 'Rock Salt';
$google_faces['Rokkitt'] = 'Rokkitt';
$google_faces['Romanesco'] = 'Romanesco';
$google_faces['Ropa Sans'] = 'Ropa Sans';
$google_faces['Rosario'] = 'Rosario';
$google_faces['Rosarivo'] = 'Rosarivo';
$google_faces['Rouge Script'] = 'Rouge Script';
$google_faces['Ruda'] = 'Ruda';
$google_faces['Rufina'] = 'Rufina';
$google_faces['Ruge Boogie'] = 'Ruge Boogie';
$google_faces['Ruluko'] = 'Ruluko';
$google_faces['Rum Raisin'] = 'Rum Raisin';
$google_faces['Ruslan Display'] = 'Ruslan Display';
$google_faces['Russo One'] = 'Russo One';
$google_faces['Ruthie'] = 'Ruthie';
$google_faces['Rye'] = 'Rye';
$google_faces['Sacramento'] = 'Sacramento';
$google_faces['Sail'] = 'Sail';
$google_faces['Salsa'] = 'Salsa';
$google_faces['Sanchez'] = 'Sanchez';
$google_faces['Sancreek'] = 'Sancreek';
$google_faces['Sansita One'] = 'Sansita One';
$google_faces['Sarina'] = 'Sarina';
$google_faces['Satisfy'] = 'Satisfy';
$google_faces['Scada'] = 'Scada';
$google_faces['Schoolbell'] = 'Schoolbell';
$google_faces['Seaweed Script'] = 'Seaweed Script';
$google_faces['Sevillana'] = 'Sevillana';
$google_faces['Seymour One'] = 'Seymour One';
$google_faces['Shadows Into Light'] = 'Shadows Into Light';
$google_faces['Shadows Into Light Two'] = 'Shadows Into Light Two';
$google_faces['Shanti'] = 'Shanti';
$google_faces['Share'] = 'Share';
$google_faces['Share Tech'] = 'Share Tech';
$google_faces['Share Tech Mono'] = 'Share Tech Mono';
$google_faces['Shojumaru'] = 'Shojumaru';
$google_faces['Short Stack'] = 'Short Stack';
$google_faces['Siemreap'] = 'Siemreap';
$google_faces['Sigmar One'] = 'Sigmar One';
$google_faces['Signika'] = 'Signika';
$google_faces['Signika Negative'] = 'Signika Negative';
$google_faces['Simonetta'] = 'Simonetta';
$google_faces['Sirin Stencil'] = 'Sirin Stencil';
$google_faces['Six Caps'] = 'Six Caps';
$google_faces['Skranji'] = 'Skranji';
$google_faces['Slackey'] = 'Slackey';
$google_faces['Smokum'] = 'Smokum';
$google_faces['Smythe'] = 'Smythe';
$google_faces['Sniglet'] = 'Sniglet';
$google_faces['Snippet'] = 'Snippet';
$google_faces['Snowburst One'] = 'Snowburst One';
$google_faces['Sofadi One'] = 'Sofadi One';
$google_faces['Sofia'] = 'Sofia';
$google_faces['Sonsie One'] = 'Sonsie One';
$google_faces['Sorts Mill Goudy'] = 'Sorts Mill Goudy';
$google_faces['Source Code Pro'] = 'Source Code Pro';
$google_faces['Source Sans Pro'] = 'Source Sans Pro';
$google_faces['Special Elite'] = 'Special Elite';
$google_faces['Spicy Rice'] = 'Spicy Rice';
$google_faces['Spinnaker'] = 'Spinnaker';
$google_faces['Spirax'] = 'Spirax';
$google_faces['Squada One'] = 'Squada One';
$google_faces['Stalemate'] = 'Stalemate';
$google_faces['Stalinist One'] = 'Stalinist One';
$google_faces['Stardos Stencil'] = 'Stardos Stencil';
$google_faces['Stint Ultra Condensed'] = 'Stint Ultra Condensed';
$google_faces['Stint Ultra Expanded'] = 'Stint Ultra Expanded';
$google_faces['Stoke'] = 'Stoke';
$google_faces['Strait'] = 'Strait';
$google_faces['Sue Ellen Francisco'] = 'Sue Ellen Francisco';
$google_faces['Sunshiney'] = 'Sunshiney';
$google_faces['Supermercado One'] = 'Supermercado One';
$google_faces['Suwannaphum'] = 'Suwannaphum';
$google_faces['Swanky and Moo Moo'] = 'Swanky and Moo Moo';
$google_faces['Syncopate'] = 'Syncopate';
$google_faces['Tangerine'] = 'Tangerine';
$google_faces['Taprom'] = 'Taprom';
$google_faces['Telex'] = 'Telex';
$google_faces['Tenor Sans'] = 'Tenor Sans';
$google_faces['Text Me One'] = 'Text Me One';
$google_faces['The Girl Next Door'] = 'The Girl Next Door';
$google_faces['Tienne'] = 'Tienne';
$google_faces['Tinos'] = 'Tinos';
$google_faces['Titan One'] = 'Titan One';
$google_faces['Titillium Web'] = 'Titillium Web';
$google_faces['Trade Winds'] = 'Trade Winds';
$google_faces['Trocchi'] = 'Trocchi';
$google_faces['Trochut'] = 'Trochut';
$google_faces['Trykker'] = 'Trykker';
$google_faces['Tulpen One'] = 'Tulpen One';
$google_faces['Ubuntu'] = 'Ubuntu';
$google_faces['Ubuntu Condensed'] = 'Ubuntu Condensed';
$google_faces['Ubuntu Mono'] = 'Ubuntu Mono';
$google_faces['Ultra'] = 'Ultra';
$google_faces['Uncial Antiqua'] = 'Uncial Antiqua';
$google_faces['Underdog'] = 'Underdog';
$google_faces['Unica One'] = 'Unica One';
$google_faces['UnifrakturCook'] = 'UnifrakturCook';
$google_faces['UnifrakturMaguntia'] = 'UnifrakturMaguntia';
$google_faces['Unkempt'] = 'Unkempt';
$google_faces['Unlock'] = 'Unlock';
$google_faces['Unna'] = 'Unna';
$google_faces['Vampiro One'] = 'Vampiro One';
$google_faces['Varela'] = 'Varela';
$google_faces['Varela Round'] = 'Varela Round';
$google_faces['Vast Shadow'] = 'Vast Shadow';
$google_faces['Vibur'] = 'Vibur';
$google_faces['Vidaloka'] = 'Vidaloka';
$google_faces['Viga'] = 'Viga';
$google_faces['Voces'] = 'Voces';
$google_faces['Volkhov'] = 'Volkhov';
$google_faces['Vollkorn'] = 'Vollkorn';
$google_faces['Voltaire'] = 'Voltaire';
$google_faces['VT323'] = 'VT323';
$google_faces['Waiting for the Sunrise'] = 'Waiting for the Sunrise';
$google_faces['Wallpoet'] = 'Wallpoet';
$google_faces['Walter Turncoat'] = 'Walter Turncoat';
$google_faces['Warnes'] = 'Warnes';
$google_faces['Wellfleet'] = 'Wellfleet';
$google_faces['Wendy One'] = 'Wendy One';
$google_faces['Wire One'] = 'Wire One';
$google_faces['Yanone Kaffeesatz'] = 'Yanone Kaffeesatz';
$google_faces['Yellowtail'] = 'Yellowtail';
$google_faces['Yeseva One'] = 'Yeseva One';
$google_faces['Yesteryear'] = 'Yesteryear';
$google_faces['Zeyada'] = 'Zeyada';


		foreach ($options as $value) {
		
			$counter++;
			$val = '';
			
			//create array of defaults		
			if ($value['type'] == 'multicheck'){
				if (is_array($value['std'])){
					foreach($value['std'] as $i=>$key){
						$defaults[$value['id']][$key] = true;
					}
				} else {
						//$defaults[$value['id']][$value['std']] = true;
				}
			} else {
				if (isset($value['id'])) $defaults[$value['id']] = $value['std'];
			}
			
			//Start Heading
			 if ( $value['type'] != "heading" )
			 {
			 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
				
				//hide items in checkbox group
				$fold='';
				if (array_key_exists("fold",$value)) {
					if ($data[$value['fold']]) {
						$fold="f_".$value['fold']." ";
					} else {
						$fold="f_".$value['fold']." temphide ";
					}
				}
	
				$output .= '<div id="section-'.$value['id'].'" class="'.$fold.'section section-'.$value['type'].' '. $class .'">'."\n";
				
				//only show header if 'name' value exists
				if($value['name']) $output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
				
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";
	
			 }
			 //End Heading
			
			//switch statement to handle various options type                              
			switch ( $value['type'] ) {

				//text input
				case 'text':
					$t_value = '';
                    $t_value = isset($data[$value['id']]) && !empty($data[$value['id']]) ? stripslashes(htmlspecialchars($data[$value['id']])) : $value['std'];


                    $mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					
					$output .= '<input class="of-input '.$mini.'" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $t_value .'" />';
				break;
				
				//select option
				case 'select':
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					$output .= '<div class="select_wrapper ' . $mini . '">';
					$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';
					foreach ($value['options'] as $select_ID => $option) {			
						$output .= '<option id="' . $select_ID . '" value="'.$select_ID.'" ' . selected($data[$value['id']], $select_ID, false) . ' />'.$option.'</option>';
					 } 
					$output .= '</select></div>';
				break;
				
				//textarea option
				case 'textarea':	
					$cols = '8';
                    $rows = '8';
                    $ta_value = '';
                    if(isset($value['options'])){
							$ta_options = $value['options'];
							if(isset($ta_options['cols'])){
							$cols = $ta_options['cols'];
							}
                            if(isset($ta_options['rows'])){
                                $rows = $ta_options['rows'];
                            }
                    }

                   // $ta_value = stripslashes($data[$value['id']]);
                    $ta_value = isset($data[$value['id']]) && !empty($data[$value['id']]) ? stripslashes(htmlspecialchars($data[$value['id']])) : stripslashes(htmlspecialchars($value['std']));
                    $output .= '<textarea class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" cols="'. $cols .'" rows="'. $rows .'">'.$ta_value.'</textarea>';
				break;
				
				//radiobox option
				case "radio":
					
					 foreach($value['options'] as $option=>$name) {
						$output .= '<input class="of-input of-radio" name="'.$value['id'].'" type="radio" value="'.$option.'" ' . checked($data[$value['id']], $option, false) . ' /><label class="radio">'.$name.'</label><br/>';				
					}
				break;
				
				//checkbox option
				case 'checkbox':
					if (!isset($data[$value['id']])) {
						$data[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="fld ";
		
					$output .= '<input type="hidden" class="'.$fold.'checkbox aq-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
					$output .= '<input type="checkbox" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($data[$value['id']], 1, false) .' /><div class="clear"></div>';
				break;
				
				//multiple checkbox option
				case 'multicheck':
                    if(isset($data[$value['id']])){
                        $multi_stored = $data[$value['id']];

                    }else {
                        $multi_stored ='';
                    }

                    foreach ($value['options'] as $key => $option) {
                        if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
                        if(in_array($key, $multi_stored)){
                            $checked = 'checked="checked"';

                        }
                        $of_key_string = $value['id'] . '_' . $key;
                        $output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'[]'.'" id="'. $of_key_string .'" value="'.$key.'" '. $checked .' /><label class="multicheck" for="'. $of_key_string .'">'. $option .'</label><br />';
                        $checked = '';
                    }

				break;
				
				//ajax image upload option
				case 'upload':
					if(!isset($value['mod'])) $value['mod'] = '';
					$output .= Options_Machine::optionsframework_uploader_function($value['id'],$value['std'],$value['mod']);			
				break;
				
				// native media library uploader - @uses optionsframework_media_uploader_function()
				case 'media':
					$_id = strip_tags( strtolower($value['id']) );
					$int = '';
					$int = optionsframework_mlu_get_silentpost( $_id );
					if(!isset($value['mod'])) $value['mod'] = '';
					$output .= Options_Machine::optionsframework_media_uploader_function( $value['id'], $value['std'], $int, $value['mod'] ); // New AJAX Uploader using Media Library			
				break;
				
				//colorpicker option
				case 'color':		
					$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: '.$data[$value['id']].'"></div></div>';
					$output .= '<input class="of-color" name="'.$value['id'].'" id="'. $value['id'] .'" type="text" value="'. $data[$value['id']] .'" />';
				break;
				
				//typography option	
				case 'typography':
				
					$typography_stored = isset($data[$value['id']]) ? $data[$value['id']] : $value['std'];
					
					/* Font Size */
					
					if(isset($typography_stored['size'])) {
						$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
						$output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
							for ($i = 9; $i < 20; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
					
					/* Line Height */
					if(isset($typography_stored['height'])) {
					
						$output .= '<div class="select_wrapper typography-height" original-title="Line height">';
						$output .= '<select class="of-typography of-typography-height select" name="'.$value['id'].'[height]" id="'. $value['id'].'_height">';
							for ($i = 20; $i < 38; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['height'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					}
						
					/* Font Face */
					if(isset($typography_stored['face'])) {
					
						$output .= '<div class="select_wrapper typography-face" original-title="Font family">';
						$output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
						
						$faces = array('arial'=>'Arial',
										'verdana'=>'Verdana, Geneva',
										'trebuchet'=>'Trebuchet',
										'georgia' =>'Georgia',
										'times'=>'Times New Roman',
										'tahoma'=>'Tahoma, Geneva',
										'palatino'=>'Palatino',
										'helvetica'=>'Helvetica' );			
						foreach ($faces as $i=>$face) {
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
						}			
										
						$output .= '</select></div>';
					
					}
					
					/* Font Weight */
					if(isset($typography_stored['style'])) {
					
						$output .= '<div class="select_wrapper typography-style" original-title="Font style">';
						$output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
						$styles = array('normal'=>'Normal',
										'italic'=>'Italic',
										'bold'=>'Bold',
										'bold italic'=>'Bold Italic');
										
						foreach ($styles as $i=>$style){
						
							$output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';		
						}
						$output .= '</select></div>';
					
					}
					
					/* Font Color */
					if(isset($typography_stored['color'])) {
					
						$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
						$output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';
					
					}
					
				break;


                //typography option
                case 'typography2':

                    $typography_stored = isset($data[$value['id']]) ? $data[$value['id']] : $value['std'];

                    /* Font Size */

                    if(isset($typography_stored['size'])) {
                        $output .= '<div class="select_wrapper typography-size" original-title="Font size">';
                        $output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
                        for ($i = 9; $i < 20; $i++){
                            $test = $i.'px';
                            $output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>';
                        }

                        $output .= '</select></div>';

                    }

                    /* Line Height */
                    if(isset($typography_stored['height'])) {

                        $output .= '<div class="select_wrapper typography-height" original-title="Line height">';
                        $output .= '<select class="of-typography of-typography-height select" name="'.$value['id'].'[height]" id="'. $value['id'].'_height">';
                        for ($i = 20; $i < 38; $i++){
                            $test = $i.'px';
                            $output .= '<option value="'. $i .'px" ' . selected($typography_stored['height'], $test, false) . '>'. $i .'px</option>';
                        }

                        $output .= '</select></div>';

                    }

                    /* Font Face */
                    if(isset($typography_stored['face'])) {

                        $output .= '<div class="select_wrapper typography-face" original-title="Font family">';
                        $output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';

                        $faces = array('arial'=>'Arial',
                            'verdana'=>'Verdana, Geneva',
                            'trebuchet'=>'Trebuchet',
                            'georgia' =>'Georgia',
                            'times'=>'Times New Roman',
                            'tahoma'=>'Tahoma, Geneva',
                            'palatino'=>'Palatino',
                            'helvetica'=>'Helvetica',

							

                        );

                        foreach ($google_faces as $j=>$google_face) {
                            $faces["google_" . $j] = $google_face;
                        }                        

                        
                        foreach ($faces as $i=>$face) {
                            $output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
                        }


                        $output .= '</select></div>';

                    }



                    /* Font Color */
                    if(isset($typography_stored['color'])) {

                        $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
                        $output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';

                    }

                    break;

//typography option
                case 'typography3':

                    $typography_stored = isset($data[$value['id']]) ? $data[$value['id']] : $value['std'];

                    /* Font Size */

                    if(isset($typography_stored['size'])) {
                        $output .= '<div class="select_wrapper typography-size" original-title="Font size">';
                        $output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
                        for ($i = 9; $i < 20; $i++){
                            $test = $i.'px';
                            $output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>';
                        }

                        $output .= '</select></div>';

                    }
                    /* Font Face */
                    if(isset($typography_stored['face'])) {

                        $output .= '<div class="select_wrapper typography-face" original-title="Font family">';
                        $output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
                        $faces = array('arial'=>'Arial',
                            'verdana'=>'Verdana, Geneva',
                            'trebuchet'=>'Trebuchet',
                            'georgia' =>'Georgia',
                            'times'=>'Times New Roman',
                            'tahoma'=>'Tahoma, Geneva',
                            'palatino'=>'Palatino',
                            'helvetica'=>'Helvetica'
                        );
                        foreach ($google_faces as $j=>$google_face) {
                            $faces["google_" . $j] = $google_face;
                        }                        

                        
                        foreach ($faces as $i=>$face) {
                            $output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
                        }


                        $output .= '</select></div>';

                    }

                    /* Font Weight */
                    if(isset($typography_stored['style'])) {

                        $output .= '<div class="select_wrapper typography-style" original-title="Font style">';
                        $output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
                        $styles = array('normal'=>'Normal',
                            'italic'=>'Italic',
                            'bold'=>'Bold',
                            'bold italic'=>'Bold Italic',
                            '300' =>'300 Weight (e.g Oswald font)'
                        );

                        foreach ($styles as $i=>$style){

                            $output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';
                        }
                        $output .= '</select></div>';

                    }



                    break;




                //typography option
                case 'typography1':

                    $typography_stored = isset($data[$value['id']]) ? $data[$value['id']] : $value['std'];


                    /* Font Face */
                    if(isset($typography_stored['face'])) {

                        $output .= '<div class="select_wrapper typography-face" original-title="Font family">';
                        $output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
                        $faces = array('arial'=>'Arial',
                            'verdana'=>'Verdana, Geneva',
                            'trebuchet'=>'Trebuchet',
                            'georgia' =>'Georgia',
                            'times'=>'Times New Roman',
                            'tahoma'=>'Tahoma, Geneva',
                            'palatino'=>'Palatino',
                            'helvetica'=>'Helvetica'

                           
                        );
                        foreach ($google_faces as $j=>$google_face) {
                            $faces["google_" . $j] = $google_face;
                        }                        

                        
                        foreach ($faces as $i=>$face) {
                            $output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
                        }


                        $output .= '</select></div>';

                    }


                    /* Font Color */
                    if(isset($typography_stored['color'])) {

                        $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
                        $output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';

                    }

                    break;
				
				//border option
				case 'border':
						
					/* Border Width */
					$border_stored = $data[$value['id']];
					
					$output .= '<div class="select_wrapper border-width">';
					$output .= '<select class="of-border of-border-width select" name="'.$value['id'].'[width]" id="'. $value['id'].'_width">';
						for ($i = 0; $i < 21; $i++){ 
						$output .= '<option value="'. $i .'" ' . selected($border_stored['width'], $i, false) . '>'. $i .'</option>';				 }
					$output .= '</select></div>';
					
					/* Border Style */
					$output .= '<div class="select_wrapper border-style">';
					$output .= '<select class="of-border of-border-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
					
					$styles = array('none'=>'None',
									'solid'=>'Solid',
									'dashed'=>'Dashed',
									'dotted'=>'Dotted');
									
					foreach ($styles as $i=>$style){
						$output .= '<option value="'. $i .'" ' . selected($border_stored['style'], $i, false) . '>'. $style .'</option>';		
					}
					
					$output .= '</select></div>';
					
					/* Border Color */		
					$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$border_stored['color'].'"></div></div>';
					$output .= '<input class="of-color of-border of-border-color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $border_stored['color'] .'" />';
					
				break;
				
				//images checkbox - use image as checkboxes
				case 'images':
				
					$i = 0;
					
					$select_value = $data[$value['id']];
					
					foreach ($value['options'] as $key => $option) 
					{ 
					$i++;
			
						$checked = '';
						$selected = '';
						if(NULL!=checked($select_value, $key, false)) {
							$checked = checked($select_value, $key, false);
							$selected = 'of-radio-img-selected';  
						}
						$output .= '<span>';
						$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'.$value['id'].'" '.$checked.' />';
						$output .= '<div class="of-radio-img-label">'. $key .'</div>';
						$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
						$output .= '</span>';				
					}
					
				break;
				
				//info (for small intro box etc)
				case "info":
					$info_text = $value['std'];
					$output .= '<div class="of-info">'.$info_text.'</div>';
				break;
				
				//display a single image
				case "image":
					$src = $value['std'];
					$output .= '<img src="'.$src.'">';
				break;
				
				//tab heading
				case 'heading':
					if($counter >= 2){
					   $output .= '</div>'."\n";
					}
					$header_class = str_replace(' ','',strtolower($value['name']));
					$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
					$jquery_click_hook = "of-option-" . $jquery_click_hook;
					$menu .= '<li class="'. $header_class .'"><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
					$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
				break;
				
				//drag & drop slide manager
				case 'slider':
					$_id = strip_tags( strtolower($value['id']) );
					$int = '';
					$int = optionsframework_mlu_get_silentpost( $_id );
					$output .= '<div class="slider"><ul id="'.$value['id'].'" rel="'.$int.'">';
					$slides = $data[$value['id']];
					$count = count($slides);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order,$int);
					} else {
						$i = 0;
						foreach ($slides as $slide) {
							$oldorder = $slide['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order,$int);
						}
					}			
					$output .= '</ul>';
					$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';
					
				break;


				//drag & drop block manager
				case 'sorter':
				
					$sortlists = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : $value['std'];
					
					$output .= '<div id="'.$value['id'].'" class="sorter">';
					
					
					if ($sortlists) {
					
						foreach ($sortlists as $group=>$sortlist) {
						
							$output .= '<ul id="'.$value['id'].'_'.$group.'" class="sortlist_'.$value['id'].'">';
							$output .= '<h3>'.$group.'</h3>';
							
							foreach ($sortlist as $key => $list) {
							
								$output .= '<input class="sorter-placebo" type="hidden" name="'.$value['id'].'['.$group.'][placebo]" value="placebo">';
									
								if ($key != "placebo") {
								
									$output .= '<li id="'.$key.'" class="sortee">';
									$output .= '<input class="position" type="hidden" name="'.$value['id'].'['.$group.']['.$key.']" value="'.$list.'">';
									$output .= $list;
									$output .= '</li>';
									
								}
								
							}
							
							$output .= '</ul>';
						}
					}
					
					$output .= '</div>';
				break;
				
				//background images option
				case 'tiles':
					
					$i = 0;
					$select_value = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : '';
					
					foreach ($value['options'] as $key => $option) 
					{ 
					$i++;
			
						$checked = '';
						$selected = '';
						if(NULL!=checked($select_value, $option, false)) {
							$checked = checked($select_value, $option, false);
							$selected = 'of-radio-tile-selected';  
						}
						$output .= '<span>';
						$output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="'.$option.'" name="'.$value['id'].'" '.$checked.' />';
						$output .= '<div class="of-radio-tile-img '. $selected .'" style="background: url('.$option.')" onClick="document.getElementById(\'of-radio-tile-'. $value['id'] . $i.'\').checked = true;"></div>';
						$output .= '</span>';				
					}
					
				break;
				
				//backup and restore options data
				case 'backup':
				
					$instructions = $value['desc'];
					$backup = get_option(BACKUPS);
					
					if(!isset($backup['backup_log'])) {
						$log = 'No backups yet';
					} else {
						$log = $backup['backup_log'];
					}
					
					$output .= '<div class="backup-box">';
					$output .= '<div class="instructions">'.$instructions."\n";
					$output .= '<p><strong>'. __('Last Backup : ', 'highthemes').'<span class="backup-log">'.$log.'</span></strong></p></div>'."\n";
					$output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
					$output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
					$output .= '</div>';
				
				break;
				
				//export or import data between different installs
				case 'transfer':
				
					$instructions = $value['desc'];
					$output .= '<textarea id="export_data" rows="8">'.base64_encode(serialize($data)) /* 100% safe - ignore theme check nag */ .'</textarea>'."\n";
					$output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import Options</a>';
				
				break;
			
			}
			
			//description of each option
			if ( $value['type'] != 'heading' ) { 
				if(!isset($value['desc'])){ $explain_value = ''; } else{ 
					$explain_value = '<div class="explain">'. $value['desc'] .'</div>'."\n"; 
				} 
				$output .= '</div>'.$explain_value."\n";
				$output .= '<div class="clear"> </div></div></div>'."\n";
				}
		   
		}
		
	    $output .= '</div>';
	    
	    return array($output,$menu,$defaults);
	    
	}


	/**
	 * Ajax image uploader - supports various types of image types
	 *
	 * @uses get_option()
	 *
	 * @access public
	 *
	 * @return string
	 */
	public static function optionsframework_uploader_function($id,$std,$mod){
	
	    $data =get_option(OPTIONS);
		
		$uploader = '';
	    $upload = $data[$id];
		$hide = '';
		
		if ($mod == "min") {$hide ='hide';}
		
	    if ( $upload != "") { $val = $upload; } else {$val = $std;}
	    
		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';	
		
		$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">'._('Upload').'</span>';
		
		if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
		$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
	    $uploader .= '<div class="clear"></div>' . "\n";
		if(!empty($upload)){
			$uploader .= '<div class="screenshot">';
	    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
	    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
	    	$uploader .= '</a>';
			$uploader .= '</div>';
			}
		$uploader .= '<div class="clear"></div>' . "\n"; 
	
		return $uploader;
	
	}

	/**
	 * Native media library uploader
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @return string
	 */
	public static function optionsframework_media_uploader_function($id,$std,$int,$mod){
	
	    $data =get_option(OPTIONS);
		
		$uploader = '';
	    $upload = $data[$id];
		$hide = '';
		
		if ($mod == "min") {$hide ='hide';}
		
	    if ( $upload != "") { $val = $upload; } else {$val = $std;}
	    
		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';	
		
		$uploader .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'" rel="' . $int . '">Upload</span>';
		
		if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
		$uploader .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
		$uploader .= '<div class="screenshot">';
		if(!empty($upload)){	
	    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
	    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
	    	$uploader .= '</a>';			
			}
		$uploader .= '</div>';
		$uploader .= '<div class="clear"></div>' . "\n"; 
	
		return $uploader;
		
	}

	/**
	 * Drag and drop slides manager
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @return string
	 */
	public static function optionsframework_slider_function($id,$std,$oldorder,$order,$int){
	
	    $data = get_option(OPTIONS);
		
		$slider = '';
		$slide = array();
	    $slide = $data[$id];
		
	    if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}
		
		//initialize all vars
		$slidevars = array('title','url','link','description');
		
		foreach ($slidevars as $slidevar) {
			if (!isset($val[$slidevar])) {
				$val[$slidevar] = '';
			}
		}
		
		//begin slider interface	
		if (!empty($val['title'])) {
			$slider .= '<li><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$slider .= '<li><div class="slide_header"><strong>Slide '.$order.'</strong>';
		}
		
		$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
	
		$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';
		
		$slider .= '<div class="slide_body">';
		
		$slider .= '<label>Title</label>';
		$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';
		
		$slider .= '<label>Image URL</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';
		
		$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'" rel="' . $int . '">Upload</span>';
		
		if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
		$slider .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$slider .='</div>' . "\n";
		$slider .= '<div class="screenshot">';
		if(!empty($val['url'])){
			
	    	$slider .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
	    	$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
	    	$slider .= '</a>';
			
			}
		$slider .= '</div>';	
		$slider .= '<label>Link URL (optional)</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';
		
		$slider .= '<label>Description (optional)</label>';
		$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][description]" id="'. $id .'_'.$order .'_slide_description" cols="8" rows="8">'.stripslashes($val['description']).'</textarea>';
	
		$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
	    $slider .= '<div class="clear"></div>' . "\n";
	
		$slider .= '</div>';
		$slider .= '</li>';
	
		return $slider;
		
	}



	
}//end Options Machine class

?>