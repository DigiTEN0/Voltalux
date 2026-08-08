<?php
/**
 * Content for the standalone info pages (Over ons, Contact, FAQ, Privacy).
 * Copy taken 1-on-1 from voltalux.nl so the SEO relevance is preserved.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * General FAQ (the /veelgestelde-vragen/ page). Feeds the FAQPage schema too.
 *
 * @return array[] each: array( question, answer )
 */
function voltalux_general_faq() {
	return apply_filters(
		'voltalux_general_faq',
		array(
			array( __( 'Is het nog wel nuttig om zonnepanelen te plaatsen?', 'voltalux' ), __( 'Ja. Milieu Centraal adviseert dat investeren in zonnepanelen een verstandige keuze blijft, zelfs nu de salderingsregeling wordt afgebouwd. Houd er rekening mee dat de terugverdientijd wel iets kan oplopen; die ligt momenteel gemiddeld rond de 7 jaar.', 'voltalux' ) ),
			array( __( 'Hebben zonnepanelen onderhoud nodig?', 'voltalux' ), __( 'Weinig. Eén tot twee keer per jaar schoonmaken volstaat. Omdat er bij het reinigen risico is op beschadiging, laat je dit het beste over aan specialisten, zodat je optimaal van je groene stroom blijft profiteren.', 'voltalux' ) ),
			array( __( 'Moet ik een omvormer gebruiken?', 'voltalux' ), __( 'Altijd. Zonder omvormer kun je de opgewekte gelijkstroom niet gebruiken in huis. De omvormer zet die om naar bruikbare wisselstroom — onmisbaar bij elke installatie.', 'voltalux' ) ),
			array( __( 'Hoelang gaan zonnepanelen mee?', 'voltalux' ), __( 'Gemiddeld zo\'n 25 jaar, en vaak nog langer. Het is dus een duurzame investering waarmee je jarenlang bespaart op je energierekening.', 'voltalux' ) ),
			array( __( 'Hebben zonnepanelen nut in de winter?', 'voltalux' ), __( 'Zeker. Panelen werken op daglicht, niet op warmte. In de winter is de opbrengst wel lager doordat de dagen korter zijn en de zon lager staat, maar ze blijven energie opwekken.', 'voltalux' ) ),
			array( __( 'Wat als de zon niet schijnt?', 'voltalux' ), __( 'Ook bij bewolking of regen leveren zonnepanelen stroom. Ze hebben daglicht nodig om te werken; bij fel licht is de opbrengst simpelweg hoger.', 'voltalux' ) ),
			array( __( 'Wat als het regent?', 'voltalux' ), __( 'Regen is juist goed: het spoelt vuil van de panelen, wat de opbrengst ten goede komt. Daarom monteren we panelen altijd onder een hoek, zodat water en vuil weglopen.', 'voltalux' ) ),
			array( __( 'Wat als ik meer opwek dan ik verbruik?', 'voltalux' ), __( 'Het overschot lever je terug aan het net; dat heet salderen. De salderingsregeling wordt vanaf 2025 geleidelijk afgebouwd, dus het is slim om je verbruik zoveel mogelijk af te stemmen op je productie (bijvoorbeeld met een thuisbatterij).', 'voltalux' ) ),
			array( __( 'Hoelang is salderen nog mogelijk?', 'voltalux' ), __( 'Vanaf 2025 neemt het salderingspercentage jaarlijks af, tot salderen in 2031 niet meer mogelijk is. Een thuisbatterij helpt je om ook daarna je eigen stroom optimaal te benutten.', 'voltalux' ) ),
			array( __( 'Kan ik achteraf zelf zonnepanelen bijplaatsen?', 'voltalux' ), __( 'Volgens de wet mag je zelf installeren, maar het vraagt veel voorbereiding en de juiste apparatuur. Veiligheid staat voorop — schakel bij twijfel altijd een professional in.', 'voltalux' ) ),
			array( __( 'Hoeveel panelen heb ik nodig?', 'voltalux' ), __( 'Voor een verbruik van circa 4.000 kWh per jaar heb je grofweg 12 panelen nodig. Het exacte aantal hangt af van je dak, de hellingshoek en schaduwwerking — we rekenen het tijdens het adviesgesprek voor je uit.', 'voltalux' ) ),
			array( __( 'Welke zonnepanelen installeert Voltalux?', 'voltalux' ), __( 'We installeren alle soorten panelen. Ons team van ervaren monteurs draait z\'n hand niet om voor welke klus dan ook.', 'voltalux' ) ),
			array( __( 'Hoe vraag ik een offerte aan?', 'voltalux' ), __( 'Eenvoudig, vrijblijvend en gratis: neem contact met ons op of vul het formulier in. Binnen 24 uur nemen we contact met je op.', 'voltalux' ) ),
		)
	);
}

/**
 * The privacy policy body (rendered by page-templates/inhoud.php when the page
 * has no own content). Structured HTML with headings — editable via the editor.
 *
 * @return string
 */
function voltalux_privacy_html() {
	$h = array(
		array( __( 'Bij Voltalux staat de privacy van onze bezoekers voorop. Dit document beschrijft welke informatie we verzamelen en registreren, en hoe we die gebruiken. Heb je vragen of wil je meer weten, neem dan gerust contact met ons op.', 'voltalux' ) ),
		array( __( 'Dit privacybeleid geldt uitsluitend voor onze online activiteiten en voor bezoekers van onze website, met betrekking tot de informatie die zij delen of die wordt verzameld. Het is niet van toepassing op informatie die offline of via andere kanalen is verzameld.', 'voltalux' ) ),
	);
	$sections = array(
		array( __( 'Toestemming', 'voltalux' ), array( __( 'Door onze website te gebruiken, stem je in met dit privacybeleid en ga je akkoord met de voorwaarden ervan.', 'voltalux' ) ) ),
		array( __( 'Informatie die we verzamelen', 'voltalux' ), array(
			__( 'Op het moment dat we je om persoonlijke informatie vragen, maken we duidelijk welke informatie dat is en waarom we die nodig hebben.', 'voltalux' ),
			__( 'Neem je rechtstreeks contact met ons op, dan kunnen we aanvullende gegevens ontvangen, zoals je naam, e-mailadres, telefoonnummer en de inhoud van je bericht.', 'voltalux' ),
			__( 'Bij het aanvragen van een offerte of registratie kunnen we vragen om contactgegevens zoals naam, (bedrijfs)adres, e-mailadres en telefoonnummer.', 'voltalux' ),
		) ),
		array( __( 'Hoe we je informatie gebruiken', 'voltalux' ), array(
			'__list__',
			__( 'Onze website aanbieden, beheren en onderhouden.', 'voltalux' ),
			__( 'Onze website verbeteren, personaliseren en uitbreiden.', 'voltalux' ),
			__( 'Begrijpen en analyseren hoe je onze website gebruikt.', 'voltalux' ),
			__( 'Nieuwe diensten en functionaliteit ontwikkelen.', 'voltalux' ),
			__( 'Met je communiceren voor klantenservice, updates en (met toestemming) marketing.', 'voltalux' ),
			__( 'Fraude opsporen en voorkomen.', 'voltalux' ),
		) ),
		array( __( 'Logbestanden', 'voltalux' ), array( __( 'Zoals de meeste websites gebruiken we logbestanden. Deze registreren bezoeken en bevatten gegevens als IP-adres, browsertype, internetprovider, datum en tijd en verwijzende pagina\'s. Deze gegevens zijn niet gekoppeld aan persoonlijk identificeerbare informatie en dienen om trends te analyseren en de site te beheren.', 'voltalux' ) ) ),
		array( __( 'Cookies', 'voltalux' ), array( __( 'Voltalux gebruikt cookies om voorkeuren en bezochte pagina\'s te onthouden. Zo optimaliseren we de gebruikerservaring door de inhoud af te stemmen op je browser en gebruik. Je kunt cookies uitschakelen via de instellingen van je browser.', 'voltalux' ) ) ),
		array( __( 'Je AVG-rechten', 'voltalux' ), array(
			__( 'We zorgen dat je volledig op de hoogte bent van je rechten op het gebied van gegevensbescherming. Je hebt recht op:', 'voltalux' ),
			'__list__',
			__( 'Inzage in de persoonsgegevens die we van je hebben.', 'voltalux' ),
			__( 'Rectificatie van onjuiste of onvolledige gegevens.', 'voltalux' ),
			__( 'Verwijdering van je persoonsgegevens, onder bepaalde voorwaarden.', 'voltalux' ),
			__( 'Beperking van de verwerking, onder bepaalde voorwaarden.', 'voltalux' ),
			__( 'Bezwaar tegen de verwerking, onder bepaalde voorwaarden.', 'voltalux' ),
			__( 'Overdraagbaarheid van je gegevens.', 'voltalux' ),
			'__end__',
			__( 'Dien je een verzoek in, dan reageren we binnen een maand. Wil je een van deze rechten uitoefenen, neem dan contact met ons op.', 'voltalux' ),
		) ),
		array( __( 'Informatie over kinderen', 'voltalux' ), array( __( 'We hechten waarde aan de bescherming van kinderen online en verzamelen niet bewust gegevens van kinderen jonger dan 13 jaar. Denk je dat je kind ons dergelijke informatie heeft verstrekt, neem dan direct contact op, dan verwijderen we die zo snel mogelijk.', 'voltalux' ) ) ),
		array( __( 'Wijzigingen in dit privacybeleid', 'voltalux' ), array( __( 'We kunnen dit beleid van tijd tot tijd bijwerken. Bekijk deze pagina daarom regelmatig. Wijzigingen zijn direct van kracht zodra ze hier zijn geplaatst.', 'voltalux' ) ) ),
	);

	ob_start();
	foreach ( $h as $p ) {
		echo '<p>' . esc_html( $p[0] ) . '</p>';
	}
	foreach ( $sections as $s ) {
		echo '<h2>' . esc_html( $s[0] ) . '</h2>';
		$in_list = false;
		foreach ( $s[1] as $line ) {
			if ( '__list__' === $line ) { echo '<ul class="vlx-ticks">'; $in_list = true; continue; }
			if ( '__end__' === $line ) { echo '</ul>'; $in_list = false; continue; }
			if ( $in_list ) { echo '<li>' . esc_html( $line ) . '</li>'; } else { echo '<p>' . esc_html( $line ) . '</p>'; }
		}
		if ( $in_list ) { echo '</ul>'; }
	}
	return ob_get_clean();
}
