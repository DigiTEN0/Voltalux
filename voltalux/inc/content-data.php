<?php
/**
 * Content data layer — all product, comparison, FAQ and business copy.
 *
 * Sourced from the client's briefing (Productinformatie + Advies over de
 * indeling, juli 2026). Every set is filterable, so the copy, prices and
 * specs can be changed WITHOUT touching templates — e.g.:
 *
 *     add_filter( 'voltalux_batteries', function ( $b ) {
 *         $b['fox-ess']['price_text'] = '…';
 *         return $b;
 *     } );
 *
 * Placeholders the client still supplies are written as [ ... ] on purpose.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The three (soon four) home-battery brands, keyed by page slug.
 *
 * @return array[]
 */
function voltalux_batteries() {
	return apply_filters(
		'voltalux_batteries',
		array(

			/* ---------------------------------------------------------- Fox ESS */
			'fox-ess' => array(
				'name'      => 'Fox ESS',
				'slug'      => 'fox-ess',
				'kind'      => 'batterij',
				'oneliner'  => __( 'Modulaire opslag met de beste prijs per kilowattuur.', 'voltalux' ),
				'badge'     => __( 'Beste prijs per kWh', 'voltalux' ),
				'intro'     => __( 'Fox ESS is een van de grootste fabrikanten van hybride omvormers en batterijopslag ter wereld en levert al jaren aan de Europese markt. Het is niet het meest spraakmakende merk — en dat is precies waarom we het aanbevelen. Je krijgt bewezen LiFePO4-techniek, een modulaire opbouw waarmee je klein kunt starten, en de scherpste prijs per bruikbare kilowattuur in ons assortiment. Voor het overgrote deel van de huishoudens is dit gewoon de verstandigste keuze.', 'voltalux' ),
				'for'       => array(
					__( 'Je hebt zonnepanelen en levert veel terug', 'voltalux' ),
					__( 'Je wilt een goede batterij zonder de meerprijs voor extra\'s die je niet gebruikt', 'voltalux' ),
					__( 'Je wilt later kunnen uitbreiden zonder alles te vervangen', 'voltalux' ),
					__( 'Eén- of driefasenaansluiting, beide geen probleem', 'voltalux' ),
				),
				'not_for'   => array(
					__( 'Je wilt je elektrische auto rechtstreeks vanuit de batterij DC-laden — dan is Sigenergy geschikter', 'voltalux' ),
					__( 'Je zoekt één merk-app voor alles — dan is AlphaESS of Sigenergy geschikter', 'voltalux' ),
				),
				'models'    => array(
					'cols' => array( __( 'Serie', 'voltalux' ), __( 'Module', 'voltalux' ), __( 'Uitbreidbaar tot', 'voltalux' ), __( 'Type', 'voltalux' ), __( 'Typisch voor', 'voltalux' ) ),
					'rows' => array(
						array( 'ECS-serie', __( 'ca. 4,3 kWh per module', 'voltalux' ), __( 'ca. 20 tot 30 kWh', 'voltalux' ), __( 'Hoogspanning, all-in-one met omvormer', 'voltalux' ), __( 'Gezin met gemiddeld verbruik', 'voltalux' ) ),
						array( 'EP / EQ-serie', __( 'ca. 5,1 kWh per module', 'voltalux' ), __( 'tot 40+ kWh', 'voltalux' ), __( 'Modulair stapelbaar', 'voltalux' ), __( 'Groter huishouden, warmtepomp of EV', 'voltalux' ) ),
						array( 'HV-serie', __( 'vanaf ca. 2,6 kWh', 'voltalux' ), __( 'modulair', 'voltalux' ), __( 'Hoogspanning', 'voltalux' ), __( 'Compacte start, later uitbreiden', 'voltalux' ) ),
						array( 'LV-serie', __( 'ca. 5,12 kWh per module', 'voltalux' ), __( 'tot ca. 35 kWh', 'voltalux' ), __( 'Laagspanning', 'voltalux' ), __( 'Specifieke retrofit-situaties', 'voltalux' ) ),
					),
					'note' => __( 'De exacte typecodes die wij voeren leveren wij nog aan, inclusief de bijbehorende omvormer.', 'voltalux' ),
				),
				'specs'     => array(
					array( __( 'Celtechnologie', 'voltalux' ), __( 'LiFePO4 (lithium-ijzerfosfaat)', 'voltalux' ) ),
					array( __( 'Ontladingsdiepte', 'voltalux' ), __( 'ca. 90 procent', 'voltalux' ) ),
					array( __( 'Rendement', 'voltalux' ), __( 'meer dan 95 procent', 'voltalux' ) ),
					array( __( 'Levensduur', 'voltalux' ), __( 'meer dan 6.000 cycli', 'voltalux' ) ),
					array( __( 'Garantie batterij', 'voltalux' ), __( '[10 jaar — te bevestigen]', 'voltalux' ) ),
					array( __( 'Garantie omvormer', 'voltalux' ), __( '[te bevestigen]', 'voltalux' ) ),
					array( __( 'Beschermingsklasse', 'voltalux' ), 'IP65' ),
					array( __( 'Certificering', 'voltalux' ), 'CE, EN/IEC 62619, IEC 61000' ),
					array( __( 'Monitoring', 'voltalux' ), __( 'Fox ESS Cloud-app en webportaal', 'voltalux' ) ),
					array( __( 'Netaansluiting', 'voltalux' ), __( '1-fase en 3-fase', 'voltalux' ) ),
				),
				'price'     => __( 'Een Fox ESS-systeem kost bij ons vanaf [€ …] inclusief installatie, keuring en inbedrijfstelling. Wat de prijs bepaalt: het aantal modules, of er een nieuwe hybride omvormer nodig is, de afstand tussen meterkast en opstelplek, en of er een aanpassing aan de groepenkast nodig is. We geven de prijs altijd all-in — geen nacalculatie.', 'voltalux' ),
				'blocks'    => array(),
				'faq'       => array(
					array( __( 'Kan ik Fox ESS combineren met mijn bestaande omvormer van een ander merk?', 'voltalux' ), __( 'Vaak wel — met een AC-gekoppelde opstelling sluit de batterij achter je bestaande zonnepanelen aan. Of dat in jouw situatie de beste keuze is, bekijken we in het adviesgesprek.', 'voltalux' ) ),
					array( __( 'Hoeveel kWh heb ik nodig?', 'voltalux' ), __( 'De meeste huishoudens komen uit tussen de 5 en 15 kWh. We rekenen het door op basis van je werkelijke jaarverbruik en teruglevering, want een batterij die je nooit volledig vult verdient zichzelf niet terug.', 'voltalux' ) ),
					array( __( 'Kan de batterij buiten hangen?', 'voltalux' ), __( 'Fox ESS heeft beschermingsklasse IP65, dus buiten plaatsen kan. We kijken bij de schouw naar een geschikte, tegen direct weer beschutte plek.', 'voltalux' ) ),
					array( __( 'Werkt de batterij bij stroomuitval?', 'voltalux' ), __( 'Dat is configuratie-afhankelijk en vraagt vaak extra hardware. Wil je noodstroom, bespreek dat vooraf — achteraf ombouwen is duurder.', 'voltalux' ) ),
					array( __( 'Kan ik later uitbreiden, en werkt een nieuwe module dan samen met de oude?', 'voltalux' ), __( 'Ja, Fox ESS is modulair opgebouwd. Bij uitbreiding stemmen we de nieuwe modules af op je bestaande systeem.', 'voltalux' ) ),
					array( __( 'Hoeveel ruimte heb ik nodig in de meterkast of garage?', 'voltalux' ), __( 'Dat hangt af van het aantal modules en de omvormer. Bij de technische schouw meten we de opstelplek exact op.', 'voltalux' ) ),
					array( __( 'Wat gebeurt er na tien jaar met de capaciteit?', 'voltalux' ), __( 'De batterij stopt niet, maar levert na verloop van tijd iets minder. Garanties worden meestal uitgedrukt als een resterende capaciteit na tien jaar.', 'voltalux' ) ),
					array( __( 'Werkt Fox ESS met dynamische energiecontracten?', 'voltalux' ), __( 'Ja, het systeem kan sturen op inkoop tijdens goedkope uren. We lichten de mogelijkheden toe in het adviesgesprek.', 'voltalux' ) ),
				),
			),

			/* -------------------------------------------------------- AlphaESS */
			'alphaess' => array(
				'name'      => 'AlphaESS',
				'slug'      => 'alphaess',
				'kind'      => 'batterij',
				'oneliner'  => __( 'Het systeem dat met je verbruik meegroeit, van 3,8 tot ruim 60 kWh.', 'voltalux' ),
				'badge'     => __( 'Breedste capaciteitsbereik', 'voltalux' ),
				'intro'     => __( 'AlphaESS heeft wereldwijd meer dan 200.000 systemen geïnstalleerd en levert met de SMILE-G3 een alles-in-één oplossing: batterij, hybride omvormer, energiebeheer en noodstroom in één systeem. De kracht zit in de fijne dimensionering. Waar veel merken je dwingen in vaste stappen van 5 of 10 kWh, bouw je hier op met modules van 3,8 kWh — tot een systeem dat ook een groot huishouden met warmtepomp én elektrische auto probleemloos aankan.', 'voltalux' ),
				'for'       => array(
					__( 'Je verbruik stijgt de komende jaren door een warmtepomp, elektrische auto of uitbouw', 'voltalux' ),
					__( 'Je wilt één systeem, één app en één aanspreekpunt', 'voltalux' ),
					__( 'Je wilt noodstroom bij uitval', 'voltalux' ),
					__( 'Je hebt geen hybride omvormer en wilt die niet los aanschaffen', 'voltalux' ),
				),
				'not_for'   => array(
					__( 'Je zoekt de allergoedkoopste instap — dan is Fox ESS geschikter', 'voltalux' ),
					__( 'Je wilt bidirectioneel laden van je auto — dan is Sigenergy geschikter', 'voltalux' ),
				),
				'models'    => array(
					'cols' => array( __( 'Model', 'voltalux' ), __( 'Type', 'voltalux' ), __( 'Capaciteit', 'voltalux' ), __( 'Fase', 'voltalux' ), __( 'Typisch voor', 'voltalux' ) ),
					'rows' => array(
						array( 'SMILE-G3-S3.6 / S5', __( 'Hybride, all-in-one', 'voltalux' ), __( 'vanaf 3,8 kWh, stapelbaar', 'voltalux' ), '1-fase', __( 'Rijtjeswoning, gemiddeld verbruik', 'voltalux' ) ),
						array( 'SMILE-G3-B5', __( 'AC-gekoppeld', 'voltalux' ), __( '3,8 tot 60+ kWh', 'voltalux' ), '1-fase', __( 'Bestaande PV-installatie, retrofit', 'voltalux' ) ),
						array( 'SMILE-G3-T4 / T6 / T8 / T10', __( 'Hybride, 3-fase', 'voltalux' ), __( 'tot ruim 60 kWh', 'voltalux' ), '3-fase', __( 'Grote woning, warmtepomp plus EV', 'voltalux' ) ),
					),
				),
				'specs'     => array(
					array( __( 'Celtechnologie', 'voltalux' ), 'LiFePO4' ),
					array( __( 'Modulegrootte', 'voltalux' ), '3,8 kWh' ),
					array( __( 'Systeemefficiëntie', 'voltalux' ), __( 'tot ca. 98 procent', 'voltalux' ) ),
					array( __( 'Omvormervermogen', 'voltalux' ), __( '3,6 tot 10 kW, modelafhankelijk', 'voltalux' ) ),
					array( 'MPPT-trackers', __( 'tot 3 bij de T-serie', 'voltalux' ) ),
					array( __( 'Noodstroom', 'voltalux' ), __( 'Ja, Smart Off-Grid, configuratie-afhankelijk', 'voltalux' ) ),
					array( __( 'Garantie batterij', 'voltalux' ), __( '10 jaar', 'voltalux' ) ),
					array( __( 'Garantie omvormer', 'voltalux' ), __( '5 jaar [uitbreiding mogelijk? te bevestigen]', 'voltalux' ) ),
					array( __( 'Monitoring', 'voltalux' ), __( 'AlphaCloud-app, realtime en op afstand', 'voltalux' ) ),
					array( __( 'Dynamische tarieven', 'voltalux' ), __( 'Ondersteund', 'voltalux' ) ),
				),
				'price'     => __( 'Een AlphaESS-systeem kost bij ons vanaf [€ …] inclusief installatie, keuring en inbedrijfstelling. De prijs hangt af van het aantal modules van 3,8 kWh, de gekozen serie (S, B of T) en de omvormer. We geven de prijs altijd all-in — geen nacalculatie.', 'voltalux' ),
				'blocks'    => array(
					array(
						'title' => __( 'Waar je op moet letten bij een AlphaESS-offerte', 'voltalux' ),
						'text'  => __( 'De modelnamen van AlphaESS zijn verwarrend. Staat er alleen "AlphaESS 10 kWh" op je offerte, dan weet je nog niet welke omvormer en welke modules je koopt. Vraag altijd om de volledige typecode én de bruikbare capaciteit per configuratie. Op onze offertes staat dat standaard.', 'voltalux' ),
					),
				),
				'faq'       => array(
					array( __( 'Wat is het verschil tussen de S-, B- en T-serie?', 'voltalux' ), __( 'De S-serie is de 1-fase hybride all-in-one, de B-serie is AC-gekoppeld voor retrofit op bestaande zonnepanelen, en de T-serie is de 3-fase variant voor grote woningen met warmtepomp en/of EV.', 'voltalux' ) ),
					array( __( 'Ik heb al zonnepanelen met een gewone omvormer — kan dat?', 'voltalux' ), __( 'Ja, daarvoor is de AC-gekoppelde B-serie bedoeld: die plaats je achter je bestaande installatie zonder je omvormer te vervangen.', 'voltalux' ) ),
					array( __( 'Hoeveel modules kan ik later nog bijplaatsen?', 'voltalux' ), __( 'Je bouwt op met modules van 3,8 kWh tot ruim 60 kWh. We stemmen een uitbreiding af op je bestaande systeem.', 'voltalux' ) ),
					array( __( 'Blijft mijn huis draaien bij stroomuitval, en welke groepen dan?', 'voltalux' ), __( 'AlphaESS ondersteunt Smart Off-Grid noodstroom. Welke groepen blijven draaien is configuratie-afhankelijk; dat bepalen we samen vooraf.', 'voltalux' ) ),
					array( __( 'Hoe lang is de garantie op de omvormer, en wat als die na vijf jaar stukgaat?', 'voltalux' ), __( 'De batterij heeft 10 jaar garantie, de omvormer standaard 5 jaar. Garantiezaken handelen wij zelf voor je af richting de fabrikant.', 'voltalux' ) ),
					array( __( 'Werkt AlphaESS met een dynamisch contract?', 'voltalux' ), __( 'Ja, dynamische tarieven worden ondersteund, zodat je kunt sturen op goedkope inkoopuren.', 'voltalux' ) ),
					array( __( 'Hoeveel geluid maakt het systeem?', 'voltalux' ), __( 'Een thuisbatterij maakt in normaal bedrijf weinig geluid. Bij de schouw kiezen we een plek waar eventuele ventilatie niet stoort.', 'voltalux' ) ),
					array( __( 'Wat is de bruikbare capaciteit ten opzichte van de nominale?', 'voltalux' ), __( 'Bij een ontladingsdiepte van circa 90 procent blijft van 10 kWh nominaal ongeveer 9 kWh bruikbaar over. Wij vermelden beide waarden op de offerte.', 'voltalux' ) ),
				),
			),

			/* -------------------------------------------------- Sigenergy */
			'sigenergy' => array(
				'name'      => 'Sigenergy SigenStor',
				'slug'      => 'sigenergy',
				'kind'      => 'batterij',
				'oneliner'  => __( 'Batterij, omvormer, EV-lader, energiebeheer en noodstroom in één toren.', 'voltalux' ),
				'badge'     => __( 'Slimste alles-in-één', 'voltalux' ),
				'intro'     => __( 'De SigenStor is de meest complete thuisbatterij die we leveren. Vijf functies zitten in één gestapelde unit: het batterijpakket, de PV-omvormer, de batterijomvormer, een AI-gestuurd energiebeheersysteem en — optioneel — een DC-snellader voor je elektrische auto. Sigenergy is in 2022 opgericht door een groep voormalige Huawei-ingenieurs en is sinds 2024 op de Nederlandse markt. Een jong merk dus, met techniek die duidelijk een generatie verder is dan de rest.', 'voltalux' ),
				'for'       => array(
					__( 'Je hebt of krijgt een elektrische auto en wilt slim laden', 'voltalux' ),
					__( 'Je hebt een warmtepomp en een fors verbruik', 'voltalux' ),
					__( 'Je wilt echte noodstroom, met een omschakeling die je niet merkt', 'voltalux' ),
					__( 'Je vindt uitstraling belangrijk, want het systeem staat vaak zichtbaar', 'voltalux' ),
					__( 'Je wilt één systeem dat de komende vijftien jaar meekan', 'voltalux' ),
				),
				'not_for'   => array(
					__( 'Je zoekt de laagste investering — dan is Fox ESS geschikter', 'voltalux' ),
					__( 'Je hebt een eenvoudige situatie zonder EV of warmtepomp: dan betaal je voor functies die je niet gebruikt', 'voltalux' ),
				),
				'models'    => array(
					'cols' => array( __( 'Onderdeel', 'voltalux' ), __( 'Opties', 'voltalux' ) ),
					'rows' => array(
						array( __( 'Batterijmodules', 'voltalux' ), __( 'ca. 5 / 8 / 9 / 10 kWh per module, stapelbaar', 'voltalux' ) ),
						array( __( 'Systeemcapaciteit', 'voltalux' ), __( 'ca. 5 tot 48 kWh, grotere configuraties in cascade mogelijk', 'voltalux' ) ),
						array( __( 'Omvormer (controller)', 'voltalux' ), __( '3 kW bij 1-fase tot 30 kW bij 3-fase', 'voltalux' ) ),
						array( 'EV-lader', __( 'Optioneel, DC tot ca. 25 kW, geïntegreerd in de stapel', 'voltalux' ) ),
						array( __( 'Noodstroom', 'voltalux' ), __( 'Optionele gateway, praktisch onderbrekingsvrije omschakeling', 'voltalux' ) ),
					),
				),
				'specs'     => array(
					array( __( 'Celtechnologie', 'voltalux' ), __( 'LiFePO4, CATL-cellen', 'voltalux' ) ),
					array( __( 'Rendement', 'voltalux' ), __( 'meer dan 97 procent', 'voltalux' ) ),
					array( __( 'Levensduur', 'voltalux' ), __( 'minimaal 6.000 cycli bij 90 procent ontladingsdiepte', 'voltalux' ) ),
					array( __( 'Garantie', 'voltalux' ), __( '10 jaar [batterij versus omvormer te bevestigen]', 'voltalux' ) ),
					array( __( 'Beschermingsklasse', 'voltalux' ), __( 'IP66, binnen en buiten', 'voltalux' ) ),
					array( __( 'Communicatie', 'voltalux' ), __( 'Ethernet, wifi, RS485, uitlezing slimme meter via P1', 'voltalux' ) ),
					array( 'App', __( 'mySigen, met AI-gestuurde optimalisatie', 'voltalux' ) ),
					array( __( 'Bidirectioneel laden', 'voltalux' ), __( 'Ondersteund, afhankelijk van auto en configuratie', 'voltalux' ) ),
					array( 'Retrofit', __( 'Ja, via AC-koppeling op bestaande zonnepanelen', 'voltalux' ) ),
				),
				'price'     => __( 'Een SigenStor-systeem kost bij ons vanaf [€ …] inclusief installatie, keuring en inbedrijfstelling. De prijs hangt af van de capaciteit, het gekozen controllervermogen en of je de optionele EV-lader en noodstroom-gateway meeneemt. We geven de prijs altijd all-in — geen nacalculatie.', 'voltalux' ),
				'blocks'    => array(
					array(
						'title' => __( 'Praktijkadvies uit onze eigen installaties', 'voltalux' ),
						'text'  => __( 'Op een standaard 3x25 A hoofdaansluiting is een controller van 15 kW in Nederland doorgaans het maximum dat je kunt toepassen. Groter kan technisch wel, maar dan moet je aansluiting mee. Wij rekenen dat vooraf voor je door.', 'voltalux' ),
					),
					array(
						'title' => __( 'Wat we er eerlijk bij zeggen', 'voltalux' ),
						'text'  => __( 'Sigenergy bestaat pas sinds 2022. De techniek is uitstekend en de garantievoorwaarden zijn marktconform, maar een merk met tien jaar service-historie in Nederland is het niet. Wij zijn [gecertificeerd installateur] en handelen garantie- en servicezaken zelf af, zodat jij niet afhankelijk bent van hoe snel een fabrikant in Nederland opschaalt.', 'voltalux' ),
					),
				),
				'faq'       => array(
					array( __( 'Wat betekent 5-in-1 precies?', 'voltalux' ), __( 'Batterijpakket, PV-omvormer, batterijomvormer, AI-energiebeheer en (optioneel) een DC-EV-lader zitten in één gestapelde toren, in plaats van als losse apparaten.', 'voltalux' ) ),
					array( __( 'Kan ik mijn bestaande zonnepanelen aansluiten?', 'voltalux' ), __( 'Ja, via AC-koppeling sluit de SigenStor aan op je bestaande zonnepanelen.', 'voltalux' ) ),
					array( __( 'Hoe werkt de geïntegreerde EV-lader, en welke auto\'s worden ondersteund?', 'voltalux' ), __( 'De optionele DC-lader tot ca. 25 kW zit in de stapel en kan bidirectioneel laden, afhankelijk van je auto en configuratie. We checken vooraf of jouw auto het ondersteunt.', 'voltalux' ) ),
					array( __( 'Hoe snel schakelt het systeem over bij stroomuitval?', 'voltalux' ), __( 'Met de optionele gateway is de omschakeling praktisch onderbrekingsvrij — in de praktijk merk je er niets van.', 'voltalux' ) ),
					array( __( 'Kan de SigenStor buiten staan?', 'voltalux' ), __( 'Ja, met beschermingsklasse IP66 is de unit geschikt voor binnen én buiten.', 'voltalux' ) ),
					array( __( 'Wat doet de AI in de app precies, en kan ik dat uitzetten?', 'voltalux' ), __( 'De mySigen-app optimaliseert automatisch laden en ontladen op basis van je verbruik en tarieven. Je houdt zelf de regie en kunt handmatig bijsturen.', 'voltalux' ) ),
					array( __( 'Hoe verhoudt de SigenStor zich tot een Fox ESS of AlphaESS?', 'voltalux' ), __( 'Fox ESS is de scherpste investering, AlphaESS groeit het fijnst mee, en de SigenStor is de meest complete alles-in-één met EV-laden en de snelste noodstroom.', 'voltalux' ) ),
					array( __( 'Wat kost het meer dan een standaard batterij, en verdien ik dat terug?', 'voltalux' ), __( 'Je betaalt voor extra functies zoals de EV-lader en het geavanceerde energiebeheer. Of dat rendeert hangt af van je verbruik; we rekenen het conservatief voor je door.', 'voltalux' ) ),
				),
			),
		)
	);
}

/**
 * Airconditioning brands, keyed by page slug.
 *
 * @return array[]
 */
function voltalux_aircos() {
	return apply_filters(
		'voltalux_aircos',
		array(

			/* ------------------------------------------------------------ Daikin */
			'daikin' => array(
				'name'     => 'Daikin',
				'slug'     => 'daikin',
				'kind'     => 'airco',
				'oneliner' => __( 'Het hoogste rendement en de breedste modelkeuze.', 'voltalux' ),
				'badge'    => __( 'Hoogste rendement', 'voltalux' ),
				'intro'    => __( 'Daikin werd in 1924 opgericht in Japan en is de grootste fabrikant van klimaatsystemen ter wereld. Het Europese hoofdkantoor staat in Oostende en een aanzienlijk deel van de productie voor de Europese markt vindt in Europa plaats. In de praktijk merk je dat aan twee dingen: de onderdelenvoorziening is uitstekend en het assortiment is zo breed dat er voor vrijwel elke ruimte een passend model is.', 'voltalux' ),
				'for'      => array(),
				'not_for'  => array(),
				'models'   => array(
					'cols' => array( __( 'Model', 'voltalux' ), 'SCOP', __( 'Geluid vanaf', 'voltalux' ), __( 'Vermogensbereik', 'voltalux' ), __( 'Karakter', 'voltalux' ) ),
					'rows' => array(
						array( 'Perfera (FTXM-R)', __( 'tot ca. 5,1 à 5,2', 'voltalux' ), 'ca. 19 dB(A)', 'ca. 2,0 tot 7,1 kW', __( 'Rendementskampioen. Standaard wifi, Flash Streamer, tweezone-bewegingssensor', 'voltalux' ) ),
						array( 'Stylish (FTXA)', __( 'iets onder Perfera', 'voltalux' ), 'ca. 19 dB(A)', 'ca. 2,0 tot 5,0 kW', __( 'Slank en vlak, drie kleuren, Coanda-luchtstroom langs het plafond', 'voltalux' ) ),
						array( 'Emura (FTXJ-R)', __( 'vergelijkbaar met Perfera', 'voltalux' ), 'ca. 20 dB(A)', 'ca. 2,0 tot 5,0 kW', __( 'Aluminium front, blikvanger in de woonkamer', 'voltalux' ) ),
						array( 'Comfora (FTXP)', 'A++', __( '[in te vullen]', 'voltalux' ), 'ca. 2,0 tot 7,1 kW', __( 'Betaalbaar met serieuze specificaties, zonder Flash Streamer', 'voltalux' ) ),
						array( 'Sensira (FTXF)', 'A++', 'ca. 21 à 22 dB(A)', 'ca. 2,0 tot 5,0 kW', __( 'Instapmodel, doet gewoon wat het moet doen', 'voltalux' ) ),
					),
				),
				'tech'     => array(
					array( __( 'Koudemiddel R-32', 'voltalux' ), __( 'Lagere GWP dan de oudere koudemiddelen en een beter energetisch rendement.', 'voltalux' ) ),
					array( __( 'Flash Streamer', 'voltalux' ), __( 'Daikins eigen luchtreiniging, breekt allergenen, bacteriën en geuren af. Standaard op Perfera, Stylish en Emura.', 'voltalux' ) ),
					array( __( 'Onecta-app', 'voltalux' ), __( 'Bediening, planning en verbruiksinzicht via wifi.', 'voltalux' ) ),
					array( __( 'Tweezone-bewegingssensor', 'voltalux' ), __( 'Alleen op de Perfera. Stuurt de luchtstroom weg van personen.', 'voltalux' ) ),
				),
				'blocks'   => array(
					array(
						'title' => __( 'Wanneer is een duurder model de meerprijs niet waard?', 'voltalux' ),
						'text'  => __( 'Voor een slaapkamer die je \'s nachts op de stilste stand gebruikt, is het verschil tussen een Perfera en een Emura vooral esthetisch — de Perfera is stiller en goedkoper. Zit de unit in het zicht in je woonkamer, dan is de meerprijs voor de Emura of Stylish wél verdedigbaar. En heb je een vermogen van 7,1 kW nodig, dan is de Perfera in de praktijk je enige optie binnen deze reeks. Dat vertellen we liever vooraf.', 'voltalux' ),
					),
				),
				'faq'      => array(
					array( __( 'Wat is het verschil tussen Perfera, Stylish en Emura?', 'voltalux' ), __( 'De Perfera is de stilste en zuinigste met de meeste techniek, de Stylish is de slankste designunit, en de Emura is de blikvanger met aluminium front. Rendement is bij alle drie hoog.', 'voltalux' ) ),
					array( __( 'Kan een Daikin mijn cv-ketel vervangen?', 'voltalux' ), __( 'Als bijverwarming in het tussenseizoen is een split-airco zeer efficiënt. Je cv-ketel volledig vervangen doet hij niet: daarvoor moet de warmteafgifte over alle ruimtes verdeeld zijn.', 'voltalux' ) ),
					array( __( 'Wat verbruikt hij per uur?', 'voltalux' ), __( 'Dat hangt af van vermogen, instelling en isolatie. Dankzij een SCOP tot ca. 5,2 krijg je voor elke kilowattuur stroom meerdere kilowattuur warmte terug.', 'voltalux' ) ),
					array( __( 'Hoe vaak moet er onderhoud gepleegd worden?', 'voltalux' ), __( 'Jaarlijks: filters reinigen, koudemiddeldruk controleren en de buitenunit schoonmaken. Wij bieden hiervoor een onderhoudscontract.', 'voltalux' ) ),
					array( __( 'Hoeveel geluid maakt de buitenunit, en hoe zit het met de afstand tot de buren?', 'voltalux' ), __( 'Moderne units zijn stil, maar plaatsing telt. We houden bij de schouw rekening met de afstand tot de perceelsgrens en de buren.', 'voltalux' ) ),
					array( __( 'Multisplit of meerdere losse systemen?', 'voltalux' ), __( 'Beide kan. Bij meerdere ruimtes wegen we multisplit (één buitenunit) af tegen losse systemen op basis van je situatie.', 'voltalux' ) ),
					array( __( 'Wat houdt de F-gassenkeuring in?', 'voltalux' ), __( 'Werken aan koudemiddelsystemen mag alleen door F-gassen-gecertificeerde monteurs. Wij zijn dat, en leggen de installatie volgens de regels vast.', 'voltalux' ) ),
					array( __( 'Hoe lang gaat een airco mee?', 'voltalux' ), __( 'Met jaarlijks onderhoud gaat een kwaliteitsairco vele jaren mee. Onderhoud houdt het rendement op peil en is vaak een garantievoorwaarde.', 'voltalux' ) ),
				),
			),

			/* ---------------------------------------------------------------- LG */
			'lg' => array(
				'name'     => 'LG',
				'slug'     => 'lg',
				'kind'     => 'airco',
				'oneliner' => __( 'Dual Inverter-techniek, sterke luchtreiniging en een scherpe prijs-kwaliteitverhouding.', 'voltalux' ),
				'badge'    => __( 'Luchtreiniging & prijs-kwaliteit', 'voltalux' ),
				'intro'    => __( 'LG onderscheidt zich met twee dingen. Ten eerste de Dual Inverter Compressor: twee rotors in plaats van één, waardoor het toestel minder schommelt rond de ingestelde temperatuur, stiller draait en zuiniger is. Ten tweede de luchtbehandeling — de Plasmaster Ionizer+ neutraliseert pollen en allergenen, en het UVnano-filter behandelt het ventilatorsysteem met UV-licht. Voor huishoudens met allergie of astma is dat een concreet verschil, geen marketing.', 'voltalux' ),
				'for'      => array(),
				'not_for'  => array(),
				'models'   => array(
					'cols' => array( __( 'Model', 'voltalux' ), __( 'Rendement', 'voltalux' ), __( 'Geluid vanaf', 'voltalux' ), __( 'Karakter', 'voltalux' ) ),
					'rows' => array(
						array( __( 'Standard Plus (Dual Inverter)', 'voltalux' ), 'A++', 'ca. 21 dB(A)', __( 'Basismodel, maar zuinig en stil voor de prijs. Beschikbaar in 2,5 / 3,5 / 5,0 kW', 'voltalux' ) ),
						array( 'Deluxe', __( '[in te vullen]', 'voltalux' ), 'ca. 19 dB(A)', __( 'Middensegment, wifi standaard, meer comfortfuncties', 'voltalux' ) ),
						array( 'Artcool', __( '[in te vullen]', 'voltalux' ), 'ca. 19 dB(A)', __( 'Designlijn, vlakke behuizing, geschikt voor zichtlocaties en kantoor', 'voltalux' ) ),
						array( 'Prestige / Dualcool AI Air', __( 'SEER tot ca. 9,1 · SCOP tot ca. 5,2 · A+++', 'voltalux' ), 'ca. 19 dB(A)', __( 'Topmodel. Plasmaster Ionizer+, UVnano, AI-regeling die het aantal personen in de ruimte detecteert', 'voltalux' ) ),
					),
				),
				'tech'     => array(
					array( __( 'Verwarmen', 'voltalux' ), __( 'Elke LG split-airco werkt als lucht-luchtwarmtepomp en verwarmt tot buitentemperaturen rond min 10 graden efficiënt. In het Nederlandse en Belgische klimaat is een LG daarmee een volwaardige bijverwarming voor het tussenseizoen. Je cv-ketel volledig vervangen doet hij niet: daarvoor moet de warmteafgifte over alle ruimtes verdeeld zijn.', 'voltalux' ) ),
				),
				'blocks'   => array(
					array(
						'title' => __( 'Wanneer kies je Prestige boven Standard Plus?', 'voltalux' ),
						'text'  => __( 'Het prijsverschil is aanzienlijk. Je verdient dat vooral terug als je veel gebruikt en dus profiteert van het hogere rendement, of als je waarde hecht aan de luchtzuivering. Gebruik je de airco alleen tien warme dagen per jaar in de slaapkamer, dan is de Standard Plus de verstandige keuze.', 'voltalux' ),
					),
				),
				'faq'      => array(
					array( __( 'Wat is Dual Inverter en wat merk ik ervan?', 'voltalux' ), __( 'Twee rotors in plaats van één zorgen dat het toestel minder schommelt rond de ingestelde temperatuur: stiller, zuiniger en een constanter comfort.', 'voltalux' ) ),
					array( __( 'Wat doen UVnano en Plasmaster Ionizer+?', 'voltalux' ), __( 'De Plasmaster Ionizer+ neutraliseert pollen en allergenen; het UVnano-filter behandelt het ventilatorsysteem met UV-licht. Voor allergie of astma een concreet verschil.', 'voltalux' ) ),
					array( __( 'Wat verbruikt hij per uur?', 'voltalux' ), __( 'Dat hangt af van model, instelling en isolatie. De topmodellen halen een SEER tot ca. 9,1, wat het koelen zeer zuinig maakt.', 'voltalux' ) ),
					array( __( 'Hoe werkt de bediening via wifi en de ThinQ-app?', 'voltalux' ), __( 'Via de ThinQ-app bedien je de airco, stel je schema\'s in en zie je je verbruik — thuis en op afstand.', 'voltalux' ) ),
					array( __( 'Kan ik mijn oude airco laten vervangen door een LG?', 'voltalux' ), __( 'Ja. Bij de schouw beoordelen we of bestaand leidingwerk herbruikbaar is of dat vervanging verstandiger is.', 'voltalux' ) ),
					array( __( 'Welke multisplit-opties zijn er?', 'voltalux' ), __( 'LG biedt multisplit-systemen waarmee je meerdere binnenunits op één buitenunit aansluit. We bepalen de beste opzet op basis van je ruimtes.', 'voltalux' ) ),
					array( __( 'Hoe onderhoud ik de filters?', 'voltalux' ), __( 'De filters reinig je zelf periodiek; het jaarlijkse onderhoud (koudemiddel, buitenunit) doen wij.', 'voltalux' ) ),
					array( __( 'Wat is de garantietermijn?', 'voltalux' ), __( 'De garantie is modelafhankelijk [in te vullen]. Wij handelen garantiezaken zelf voor je af.', 'voltalux' ) ),
				),
			),
		)
	);
}

/**
 * Battery comparison table (overview page). Verbatim from the briefing.
 *
 * @return array
 */
function voltalux_battery_comparison() {
	return apply_filters(
		'voltalux_battery_comparison',
		array(
			'brands' => array( 'Fox ESS', 'AlphaESS', 'Sigenergy' ),
			'rows'   => array(
				array( __( 'Kort gezegd', 'voltalux' ), __( 'Beste prijs per kWh', 'voltalux' ), __( 'Breedste capaciteitsbereik', 'voltalux' ), __( 'Slimste alles-in-één', 'voltalux' ) ),
				array( __( 'Capaciteit', 'voltalux' ), __( 'ca. 5 tot 40+ kWh, modulair', 'voltalux' ), __( '3,8 tot 60+ kWh, modulair', 'voltalux' ), __( 'ca. 5 tot 48 kWh, modulair', 'voltalux' ) ),
				array( __( 'Celtype', 'voltalux' ), 'LiFePO4', 'LiFePO4', 'LiFePO4' ),
				array( __( 'Omvormer', 'voltalux' ), __( 'Hybride, apart of geïntegreerd', 'voltalux' ), __( 'Geïntegreerd', 'voltalux' ), __( 'Geïntegreerd, 5-in-1', 'voltalux' ) ),
				array( __( '1- en 3-fase', 'voltalux' ), __( 'Beide', 'voltalux' ), __( 'Beide', 'voltalux' ), __( 'Beide, 3 tot 30 kW', 'voltalux' ) ),
				array( __( 'Noodstroom', 'voltalux' ), __( 'Configuratie-afhankelijk', 'voltalux' ), __( 'Ja, Smart Off-Grid', 'voltalux' ), __( 'Ja, zeer snelle omschakeling', 'voltalux' ) ),
				array( __( 'EV-lader geïntegreerd', 'voltalux' ), __( 'Nee', 'voltalux' ), __( 'Nee', 'voltalux' ), __( 'Ja, optioneel', 'voltalux' ) ),
				array( __( 'Buiten plaatsbaar', 'voltalux' ), __( 'Ja, IP65', 'voltalux' ), __( 'Modelafhankelijk', 'voltalux' ), __( 'Ja, IP66', 'voltalux' ) ),
				array( __( 'Garantie batterij', 'voltalux' ), __( '[10 jaar]', 'voltalux' ), __( '10 jaar', 'voltalux' ), __( '10 jaar', 'voltalux' ) ),
				array( __( 'Sterk bij', 'voltalux' ), __( 'Scherpe investering, eenvoud', 'voltalux' ), __( 'Meegroeien, groot huishouden', 'voltalux' ), __( 'Warmtepomp plus elektrische auto', 'voltalux' ) ),
				array( __( 'Minder geschikt bij', 'voltalux' ), __( 'Wens tot EV-integratie', 'voltalux' ), __( 'Klein budget, eenvoudige situatie', 'voltalux' ), __( 'Klein budget', 'voltalux' ) ),
				array( __( 'Prijs all-in vanaf', 'voltalux' ), '[€ …]', '[€ …]', '[€ …]' ),
			),
		)
	);
}

/**
 * Airco comparison table (overview page). Verbatim from the briefing.
 *
 * @return array
 */
function voltalux_airco_comparison() {
	return apply_filters(
		'voltalux_airco_comparison',
		array(
			'brands' => array( 'Daikin', 'LG' ),
			'rows'   => array(
				array( __( 'Sterkste punt', 'voltalux' ), __( 'Hoogste rendement, breedste modelreeks', 'voltalux' ), __( 'Luchtreiniging, prijs-kwaliteit, AI-regeling', 'voltalux' ) ),
				array( __( 'Rendement (SCOP)', 'voltalux' ), __( 'tot ca. 5,1 à 5,2 bij de Perfera', 'voltalux' ), __( 'tot ca. 5,2 bij Prestige en Dualcool AI', 'voltalux' ) ),
				array( __( 'Stilste stand', 'voltalux' ), 'vanaf ca. 19 dB(A)', 'vanaf ca. 19 dB(A)' ),
				array( __( 'Designmodel', 'voltalux' ), 'Emura, Stylish', 'Artcool' ),
				array( __( 'Instapmodel', 'voltalux' ), 'Sensira, Comfora', 'Standard Plus' ),
				array( __( 'Luchtbehandeling', 'voltalux' ), __( 'Flash Streamer, bewegingssensor', 'voltalux' ), 'Plasmaster Ionizer+, UVnano' ),
				array( __( 'Vermogens', 'voltalux' ), '2,0 tot 7,1 kW', '2,5 tot 5,0+ kW' ),
				array( __( 'Kies dit als', 'voltalux' ), __( 'rendement en modelkeuze doorslaggevend zijn', 'voltalux' ), __( 'luchtkwaliteit of prijs-kwaliteit doorslaggevend is', 'voltalux' ) ),
			),
		)
	);
}

/**
 * General home-battery FAQ (overview page). Verbatim answers from the briefing.
 *
 * @return array[]
 */
function voltalux_general_battery_faq() {
	return apply_filters(
		'voltalux_general_battery_faq',
		array(
			array( __( 'Hoeveel kWh heb ik nodig?', 'voltalux' ), __( 'Kijk op je jaarafrekening hoeveel stroom je per jaar teruglevert. Deel dat door 365 en je hebt een ruwe indicatie van wat je per dag zou kunnen opslaan. In de praktijk komen de meeste huishoudens uit tussen de 5 en 15 kWh. Groter is niet altijd beter: een batterij die je nooit volledig vult, verdient zichzelf niet terug. Wij rekenen het door op basis van je werkelijke verbruiksprofiel.', 'voltalux' ) ),
			array( __( 'Is een thuisbatterij brandveilig?', 'voltalux' ), __( 'Alle batterijen die wij leveren gebruiken LiFePO4-cellen. Die chemie is thermisch stabiel, kobaltvrij en veel minder gevoelig voor oververhitting dan de lithiumtypes uit bijvoorbeeld telefoons. De systemen zijn CE-gecertificeerd en voldoen aan EN/IEC 62619. Meld de installatie wel bij je woonverzekeraar.', 'voltalux' ) ),
			array( __( 'Gaat de batterij lang genoeg mee?', 'voltalux' ), __( 'De genoemde levensduur van 6.000 cycli komt neer op ruwweg zestien jaar bij één volledige cyclus per dag. Garanties worden meestal uitgedrukt als een resterende capaciteit na tien jaar, bijvoorbeeld 70 procent. De batterij stopt dus niet, maar levert na verloop van tijd minder.', 'voltalux' ) ),
			array( __( 'Wat gebeurt er bij stroomuitval?', 'voltalux' ), __( 'Dat verschilt per systeem en per configuratie. Sommige systemen houden alleen een aparte noodstroomgroep in de lucht, andere de hele woning. Daar is vaak extra hardware voor nodig. Bespreek dit vooraf, want achteraf ombouwen is duurder.', 'voltalux' ) ),
			array( __( 'Moet ik de batterij aanmelden?', 'voltalux' ), __( 'Ja, een thuisbatterij wordt geregistreerd via Energieleveren.nl. Wij regelen dat bij oplevering.', 'voltalux' ) ),
			array( __( 'Telt een thuisbatterij mee voor het energielabel?', 'voltalux' ), __( 'Sinds 29 mei 2026 telt een thuisbatterij mee voor het energielabel van een woning, mits het systeem minimaal 5 kWh is en vast is aangesloten.', 'voltalux' ) ),
		)
	);
}

/**
 * What is / isn't in the all-in airco price (overview page). Verbatim.
 *
 * @return array
 */
function voltalux_airco_allin() {
	return apply_filters(
		'voltalux_airco_allin',
		array(
			'in'  => array(
				__( 'Binnenunit en buitenunit', 'voltalux' ),
				__( 'Leidingwerk tot [X] meter', 'voltalux' ),
				__( 'Condensafvoer', 'voltalux' ),
				__( 'Montage, vacuümtrekken en inbedrijfstelling', 'voltalux' ),
				__( 'Afvoer van het verpakkingsmateriaal', 'voltalux' ),
			),
			'out' => array(
				__( 'Kernboringen door dikke of bijzondere muren', 'voltalux' ),
				__( 'Leidinglengte boven [X] meter', 'voltalux' ),
				__( 'Aanpassingen aan de elektra of een extra groep', 'voltalux' ),
				__( 'Bijzondere montageconstructies, bijvoorbeeld een dakframe', 'voltalux' ),
			),
		)
	);
}

/**
 * The "Zo werken wij" six-step process (Werkwijze page). Verbatim.
 *
 * @return array[]
 */
function voltalux_werkwijze_steps() {
	return apply_filters(
		'voltalux_werkwijze_steps',
		array(
			array( 'title' => __( 'Vrijblijvend adviesgesprek, telefonisch, 20 tot 30 minuten', 'voltalux' ), 'text' => __( 'We nemen samen je situatie door: je verbruik, je opwek, je aansluiting en je plannen voor de komende jaren. Aan het eind van dit gesprek weet je welke capaciteit bij je past en in welke prijsklasse dat valt. Geen offerte in je mailbox waar je zelf uit moet zien te komen — we lopen hem samen door.', 'voltalux' ) ),
			array( 'title' => __( 'Advies op maat en een heldere offerte', 'voltalux' ), 'text' => __( 'Je krijgt een offerte met de volledige typecodes, de bruikbare capaciteit en een all-in prijs. Wat erin zit staat erin, wat er niet in zit ook. Wij doen niet aan nacalculatie.', 'voltalux' ) ),
			array( 'title' => __( 'Terugbelmoment op een afgesproken dag en tijd', 'voltalux' ), 'text' => __( 'Tussen het eerste en het tweede gesprek zit ruimte om erover na te denken en te overleggen met je partner. Bij het tweede gesprek beantwoorden we de vragen die zijn opgekomen en beslis je. Ja, nee of nog niet — alle drie zijn prima antwoorden.', 'voltalux' ) ),
			array( 'title' => __( 'Technische schouw', 'voltalux' ), 'text' => __( 'Voor de installatie komen we langs om de opstelplek, de meterkast en het leidingtracé te bekijken. Zo weten we zeker dat wat op papier staat ook echt zo geïnstalleerd kan worden.', 'voltalux' ) ),
			array( 'title' => __( 'Installatie door onze eigen monteurs', 'voltalux' ), 'text' => __( '[X] dag(en) werk, uitgevoerd door onze eigen gecertificeerde monteurs. Geen onderaannemers. We melden het systeem aan bij je netbeheerder, koppelen de app en lopen alles met je door voordat we vertrekken.', 'voltalux' ) ),
			array( 'title' => __( 'Nazorg en monitoring', 'voltalux' ), 'text' => __( 'We kijken de eerste [periode] mee in de monitoring om te controleren of het systeem doet wat we beloofd hebben. Daarna ben je nooit afhankelijk van een callcenter: je hebt een vaste contactpersoon en garantiezaken handelen wij zelf af richting de fabrikant.', 'voltalux' ) ),
		)
	);
}

/**
 * The four promises ("Wat je van ons mag verwachten"). Verbatim.
 *
 * @return string[]
 */
function voltalux_promises() {
	return apply_filters(
		'voltalux_promises',
		array(
			__( 'Wij adviseren ook tegen een aankoop als die niet uitkomt', 'voltalux' ),
			__( 'Eén all-in prijs, geen nacalculatie', 'voltalux' ),
			__( 'Eigen monteurs, geen onderaannemers', 'voltalux' ),
			__( 'Eén vaste contactpersoon, ook na oplevering', 'voltalux' ),
		)
	);
}

/**
 * The four product-page key points (kernpunten-balk). Verbatim from PDF 2.
 *
 * @return array[]
 */
function voltalux_product_keypoints() {
	return apply_filters(
		'voltalux_product_keypoints',
		array(
			array( 'icon' => 'headset', 'label' => __( 'Eigen monteurs', 'voltalux' ) ),
			array( 'icon' => 'shield',  'label' => __( 'Fabrieksgarantie', 'voltalux' ) ),
			array( 'icon' => 'user',    'label' => __( 'Vaste adviseur', 'voltalux' ) ),
			array( 'icon' => 'euro',    'label' => __( 'All-in prijs', 'voltalux' ) ),
		)
	);
}

/**
 * Certifications shown in the footer. Placeholders for the client to confirm.
 *
 * @return string[]
 */
function voltalux_certifications() {
	return apply_filters(
		'voltalux_certifications',
		array( 'F-gassen', 'KIWA', 'InstallQ', 'Zonnekeur', 'Gold Installer' )
	);
}

/**
 * Business / container-battery page content. Sourced from PDF 2.
 *
 * @return array
 */
function voltalux_business_data() {
	return apply_filters(
		'voltalux_business_data',
		array(
			'intro'   => __( 'Kun je niet uitbreiden omdat de netbeheerder geen zwaardere aansluiting afgeeft? Betaal je elke maand voor een kwartierpiek die maar twintig minuten duurt? Dan is een batterij vaak niet de duurzame optie maar de enige werkbare optie. Wij ontwerpen, leveren en installeren batterijsystemen van [30] kWh tot […] kWh — van een kast in de technische ruimte tot een volledige container op eigen terrein.', 'voltalux' ),
			'reasons' => array(
				array( 'icon' => 'layers', 'title' => __( 'Netcongestie', 'voltalux' ), 'text' => __( 'In grote delen van Nederland geeft de netbeheerder geen zwaardere aansluiting meer af, en netverzwaring duurt jaren. Sinds 1 juli 2026 geldt bovendien een landelijke wachtlijst-prioriteringsregeling. Een batterij van 50 tot 200 kWh overbrugt die periode: je gaat door met groeien terwijl je aansluiting hetzelfde blijft.', 'voltalux' ) ),
				array( 'icon' => 'spark',  'title' => __( 'Piekvermogen (peak shaving)', 'voltalux' ), 'text' => __( 'Bij een grootverbruikaansluiting reken je af op je hoogste kwartierpiek. Eén opstartende compressor of één laadsessie kan je maandtarief bepalen. Een batterij vangt die piek op, waardoor je onder je contractwaarde blijft. Voor mkb-grootverbruikers kan het piekvermogen tot ongeveer 30 procent van de energierekening uitmaken.', 'voltalux' ) ),
				array( 'icon' => 'sun',    'title' => __( 'Zelfverbruik van zonnestroom', 'voltalux' ), 'text' => __( 'Heb je een groot dak vol panelen en lever je overdag terug tegen een lage of zelfs negatieve prijs? Dan is opslaan en \'s avonds gebruiken direct rendement.', 'voltalux' ) ),
				array( 'icon' => 'euro',   'title' => __( 'Handel en flexibiliteit', 'voltalux' ), 'text' => __( 'Met een energiemanagementsysteem kun je inkopen op goedkope uren en handelen op onbalans en dynamische tarieven. Wij zijn hier eerlijk over: dit is de opbrengstpost met de grootste bandbreedte. We rekenen hem in de businesscase apart door, zodat je ziet hoe je project eruitziet met én zonder.', 'voltalux' ) ),
			),
			'cabinet' => array(
				'cols' => array( '', __( 'Binnenkast / modulair', 'voltalux' ), __( 'Buitencontainer', 'voltalux' ) ),
				'rows' => array(
					array( __( 'Capaciteit', 'voltalux' ), __( 'ca. 30 tot 250 kWh', 'voltalux' ), __( 'ca. 250 kWh tot meerdere MWh', 'voltalux' ) ),
					array( __( 'Plaatsing', 'voltalux' ), __( 'Technische ruimte, magazijn', 'voltalux' ), __( 'Eigen terrein, op fundering', 'voltalux' ) ),
					array( __( 'Vergunning', 'voltalux' ), __( 'Meestal niet nodig', 'voltalux' ), __( 'Vaak omgevingsvergunning en brandveiligheidstoets', 'voltalux' ) ),
					array( __( 'Brandveiligheid', 'voltalux' ), __( 'Compartimentering en detectie in de ruimte', 'voltalux' ), __( 'Geïntegreerde blus- en detectiesystemen, PGS-eisen', 'voltalux' ) ),
					array( __( 'Doorlooptijd', 'voltalux' ), __( '[…] weken', 'voltalux' ), __( '[…] weken', 'voltalux' ) ),
					array( __( 'Typisch voor', 'voltalux' ), __( 'Mkb, werkplaats, agrarisch, kantoor', 'voltalux' ), __( 'Logistiek, industrie, laadpleinen, zonneparken', 'voltalux' ) ),
				),
			),
			'sectors' => array(
				__( 'Logistiek en transport — laadinfrastructuur voor elektrische vrachtwagens en bestelbussen zonder netverzwaring.', 'voltalux' ),
				__( 'Agrarisch — groot dak vol panelen, hoge afname bij melken en koelen, vaak in congestiegebied.', 'voltalux' ),
				__( 'Metaal en productie — korte, forse startpieken. Hoog vermogen, beperkte energie-inhoud.', 'voltalux' ),
				__( 'Retail en horeca — koeling, klimaat en laadpalen op één beperkte aansluiting.', 'voltalux' ),
				__( 'Laadpleinen — batterij als buffer, zodat snelladers werken op een lichte aansluiting.', 'voltalux' ),
				__( 'Kantoren en zorginstellingen — piekafvlakking plus noodstroom voor kritische systemen.', 'voltalux' ),
			),
			'cta'     => __( 'Gratis quickscan businesscase. Stuur ons je netbeheerderfactuur en je kwartierdata van de afgelopen twaalf maanden. Binnen vijf werkdagen krijg je een onderbouwde eerste doorrekening: benodigd vermogen, benodigde capaciteit, indicatieve investering en terugverdientijd. Geen verplichtingen, en je mag de analyse houden.', 'voltalux' ),
		)
	);
}

/**
 * The twenty blog topics from PDF 2 (seeded as drafts by inc/setup.php).
 * 'p' marks the five priority articles (1, 6, 8, 12, 5).
 *
 * @return array[]
 */
function voltalux_blog_topics() {
	return apply_filters(
		'voltalux_blog_topics',
		array(
			array( 'n' => 1,  'p' => true,  'title' => __( 'Salderingsregeling stopt per 1 januari 2027: wat het écht kost per jaar', 'voltalux' ), 'kern' => __( 'Drie profielen doorrekenen (2.000, 3.500 en 5.000 kWh teruglevering). Noem de wettelijke minimumvergoeding van 50 procent tot 2030, en dat die daarna vrij is.', 'voltalux' ), 'words' => 1500 ),
			array( 'n' => 2,  'p' => false, 'title' => __( 'Terugleverkosten uitgelegd', 'voltalux' ), 'kern' => __( 'Verschil tussen terugleverkosten en terugleververgoeding, de rol van de ACM, en hoe het per leverancier is opgebouwd.', 'voltalux' ), 'words' => 1200 ),
			array( 'n' => 3,  'p' => false, 'title' => __( 'Is een thuisbatterij in 2026 nog op tijd?', 'voltalux' ), 'kern' => __( 'Eerlijk: het salderingsvoordeel loopt tot en met 31 december 2026, dus wie later installeert mist geen extra voordeel maar loopt wel tegen wachttijden aan.', 'voltalux' ), 'words' => 900 ),
			array( 'n' => 4,  'p' => false, 'title' => __( 'Zonnepanelen zonder salderen: heeft dat nog zin?', 'voltalux' ), 'kern' => __( 'Ja, maar het rendement verschuift van teruglevering naar zelfverbruik.', 'voltalux' ), 'words' => 1200 ),
			array( 'n' => 5,  'p' => true,  'title' => __( 'Zelfverbruik verhogen zonder batterij: negen dingen die vandaag al helpen', 'voltalux' ), 'kern' => __( 'Geeft gratis advies weg. Wint vertrouwen en levert in de praktijk juist leads op.', 'voltalux' ), 'words' => 1400 ),
			array( 'n' => 6,  'p' => true,  'title' => __( 'Hoeveel kWh thuisbatterij heb ik nodig?', 'voltalux' ), 'kern' => __( 'Stap voor stap rekenen met de eigen jaarafrekening. Meest gelezen artikeltype in deze categorie.', 'voltalux' ), 'words' => 1500 ),
			array( 'n' => 7,  'p' => false, 'title' => __( 'Nominale versus bruikbare capaciteit', 'voltalux' ), 'kern' => __( 'Waarom 10 kWh geen 10 kWh is. Ontladingsdiepte, rendementsverlies en degradatie.', 'voltalux' ), 'words' => 900 ),
			array( 'n' => 8,  'p' => true,  'title' => __( 'Terugverdientijd: een eerlijke rekensom met vier scenario\'s', 'voltalux' ), 'kern' => __( 'Inclusief het scenario waarin het niet uitkomt. Dat maakt de andere drie geloofwaardig.', 'voltalux' ), 'words' => 1800 ),
			array( 'n' => 9,  'p' => false, 'title' => __( 'Thuisbatterij vergelijken: Fox ESS, AlphaESS, Sigenergy en Huawei', 'voltalux' ), 'kern' => __( 'De overzichtspagina in artikelvorm, met meer diepgang per merk.', 'voltalux' ), 'words' => 2000 ),
			array( 'n' => 10, 'p' => false, 'title' => __( 'Eén fase of drie fasen: wat het betekent voor je batterijkeuze', 'voltalux' ), 'kern' => __( 'Technisch maar veelgezocht, met weinig goede concurrentie.', 'voltalux' ), 'words' => 1000 ),
			array( 'n' => 11, 'p' => false, 'title' => __( 'AC-gekoppeld of DC-gekoppeld', 'voltalux' ), 'kern' => __( 'Welke batterij past bij bestaande zonnepanelen. Komt in elk adviesgesprek terug.', 'voltalux' ), 'words' => 1100 ),
			array( 'n' => 12, 'p' => true,  'title' => __( 'Is een thuisbatterij brandveilig?', 'voltalux' ), 'kern' => __( 'LFP versus andere lithiumtypes, normen EN/IEC 62619, wat je verzekeraar wil weten.', 'voltalux' ), 'words' => 1300 ),
			array( 'n' => 13, 'p' => false, 'title' => __( 'Thuisbatterij en je woonverzekering', 'voltalux' ), 'kern' => __( 'Praktisch onderwerp met weinig aanbod online, wordt veel gedeeld.', 'voltalux' ), 'words' => 900 ),
			array( 'n' => 14, 'p' => false, 'title' => __( 'Waar plaats je een thuisbatterij?', 'voltalux' ), 'kern' => __( 'Binnen, buiten, garage of schuur. Temperatuurbereik, IP-klasse, ventilatie, geluid.', 'voltalux' ), 'words' => 1000 ),
			array( 'n' => 15, 'p' => false, 'title' => __( 'Noodstroom bij stroomuitval: wat kan een thuisbatterij wel en niet', 'voltalux' ), 'kern' => __( 'Verschil tussen één groep en de hele woning, omschakeltijd, kosten van een gateway.', 'voltalux' ), 'words' => 1200 ),
			array( 'n' => 16, 'p' => false, 'title' => __( 'Hoe lang gaat een thuisbatterij mee?', 'voltalux' ), 'kern' => __( 'Cycli, degradatie, en hoe je garantievoorwaarden leest.', 'voltalux' ), 'words' => 1100 ),
			array( 'n' => 17, 'p' => false, 'title' => __( 'Thuisbatterij en de netbeheerder', 'voltalux' ), 'kern' => __( 'Aanmelden via Energieleveren.nl, terugleverbegrenzing, netcongestie in de eigen regio.', 'voltalux' ), 'words' => 1000 ),
			array( 'n' => 18, 'p' => false, 'title' => __( 'Dynamisch energiecontract met thuisbatterij', 'voltalux' ), 'kern' => __( 'Realistische bandbreedte per jaar, inclusief het risico van tegenvallende prijsverschillen.', 'voltalux' ), 'words' => 1600 ),
			array( 'n' => 19, 'p' => false, 'title' => __( 'Thuisbatterij en warmtepomp', 'voltalux' ), 'kern' => __( 'Het winterprobleem eerlijk benoemen: als je hem het hardst nodig hebt, is er weinig zon.', 'voltalux' ), 'words' => 1300 ),
			array( 'n' => 20, 'p' => false, 'title' => __( 'Thuisbatterij, laadpaal en bidirectioneel laden', 'voltalux' ), 'kern' => __( 'Stand van zaken, welke auto\'s het kunnen, hoe Sigenergy hierop aansluit.', 'voltalux' ), 'words' => 1400 ),
		)
	);
}

/**
 * The blog category (theme) for a topic number, per the briefing's four themes:
 *  A (1-5) salderingsverhaal · B (6-11) kiezen en rekenen ·
 *  C (12-17) techniek, veiligheid en praktijk · D (18-20) combineren en verdienen.
 *
 * @param int $n Topic number.
 * @return string Category name.
 */
function voltalux_blog_theme( $n ) {
	$n = (int) $n;
	if ( $n <= 5 ) {
		return __( 'Saldering', 'voltalux' );
	}
	if ( $n <= 11 ) {
		return __( 'Kiezen & rekenen', 'voltalux' );
	}
	if ( $n <= 17 ) {
		return __( 'Techniek & veiligheid', 'voltalux' );
	}
	return __( 'Combineren & verdienen', 'voltalux' );
}
