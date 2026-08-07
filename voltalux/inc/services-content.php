<?php
/**
 * Service-pillar content, keyed by page slug.
 *
 * One data set drives the reusable "dienst" page template
 * (page-templates/dienst.php). Copy is taken 1-on-1 from the client's live site
 * (voltalux.nl) so the pages keep the same wording — and therefore the same SEO
 * relevance — while being rebuilt in the Voltalux design system.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The shared six-step way of working (identical across services on the live site).
 *
 * @return array[] each: title, text
 */
function voltalux_proces_steps() {
	return array(
		array( 'title' => __( 'Kennismaking', 'voltalux' ), 'text' => __( 'We leren elkaar kennen en luisteren naar je behoeften, doelen en verwachtingen — telefonisch of in een persoonlijk gesprek op locatie.', 'voltalux' ) ),
		array( 'title' => __( 'Ontwerp en plan', 'voltalux' ), 'text' => __( 'Onze experts maken een op maat gemaakt ontwerp en plan, met de beste duurzame oplossing voor jouw specifieke situatie.', 'voltalux' ) ),
		array( 'title' => __( 'Voorbereiding', 'voltalux' ), 'text' => __( 'Na goedkeuring stellen we een gedetailleerd actieplan op, verzamelen we de materialen en plannen we de uitvoering in.', 'voltalux' ) ),
		array( 'title' => __( 'Uitvoering', 'voltalux' ), 'text' => __( 'Onze eigen erkende installateurs en monteurs verzorgen een professionele installatie volgens de hoogste standaarden.', 'voltalux' ) ),
		array( 'title' => __( 'Controle en oplevering', 'voltalux' ), 'text' => __( 'Kwaliteitscontroles en testen bevestigen dat alles correct werkt. Pas dan leveren we het project op.', 'voltalux' ) ),
		array( 'title' => __( 'Service en nazorg', 'voltalux' ), 'text' => __( 'Ook na oplevering staan we paraat. Ons gratis serviceteam helpt bij vragen, aanpassingen of storingen — op afstand en op locatie.', 'voltalux' ) ),
	);
}

/**
 * All service pillars, keyed by slug.
 *
 * @return array[]
 */
function voltalux_services_content() {
	return apply_filters(
		'voltalux_services_content',
		array(

			/* ------------------------------------------------------ Zonnepanelen */
			'zonnepanelen' => array(
				'kind'     => __( 'Zonnepanelen', 'voltalux' ),
				'icon'     => 'sun',
				'eyebrow'  => __( 'Zonnepanelen', 'voltalux' ),
				'h1'       => __( 'Zonnepanelen-specialist — wek je eigen [mark]stroom[/mark] op', 'voltalux' ),
				'lead'     => __( 'Op zoek naar een betrouwbare, ervaren partner voor jouw zonne-energieproject? Voltalux is gespecialiseerd in hoogwaardige zonne-energiesystemen — op maat, voor particulier én zakelijk. Je verlaagt je energiekosten, verhoogt je woningwaarde en je energielabel, en draagt bij aan een groenere toekomst.', 'voltalux' ),
				'usps'     => array(
					array( 'icon' => 'shield', 'title' => __( 'Eigen erkende installateurs', 'voltalux' ), 'text' => __( 'Gecertificeerde experts in eigen dienst — dat geeft betrouwbaarheid en één aanspreekpunt.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'Binnen 3 weken geplaatst', 'voltalux' ), 'text' => __( 'Een vlotte, strak geplande overstap naar duurzame energie.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'A-merken, scherpe tarieven', 'voltalux' ), 'text' => __( 'Alleen de beste merken zijn goed genoeg — kwaliteit gecombineerd met toegankelijkheid.', 'voltalux' ) ),
				),
				'how'      => array(
					'title' => __( 'Zo werken zonnepanelen', 'voltalux' ),
					'lead'  => __( 'De werking van zonnepanelen in vier eenvoudige stappen.', 'voltalux' ),
					'steps' => array(
						array( 'title' => __( 'Zonlicht valt op de panelen', 'voltalux' ), 'text' => __( 'De zonnecellen vangen daglicht op — ook op bewolkte dagen wek je stroom op.', 'voltalux' ) ),
						array( 'title' => __( 'De panelen wekken gelijkstroom op', 'voltalux' ), 'text' => __( 'Het opgevangen licht wordt in de cellen omgezet in gelijkstroom (DC).', 'voltalux' ) ),
						array( 'title' => __( 'De omvormer maakt er wisselstroom van', 'voltalux' ), 'text' => __( 'De omvormer zet gelijkstroom om naar 230V wisselstroom (AC) die je woning gebruikt.', 'voltalux' ) ),
						array( 'title' => __( 'Je verbruikt of levert terug', 'voltalux' ), 'text' => __( 'Wat je niet direct gebruikt, lever je terug aan het net — en dat verreken je via de salderingsregeling.', 'voltalux' ) ),
					),
				),
				'brands'   => array(
					'title' => __( 'Welke merken gebruiken wij?', 'voltalux' ),
					'lead'  => __( 'Elk project is uniek en elke dakconstructie vraagt om de juiste panelen. Daarom werken we met verschillende A-merken — elk met zijn eigen sterke punt.', 'voltalux' ),
					'items' => array(
						array( 'name' => 'Enphase', 'tag' => __( 'Micro-omvormers', 'voltalux' ), 'text' => __( 'Bekend om micro-omvormers, ideaal voor parallel geschakelde systemen en daken met schaduw.', 'voltalux' ) ),
						array( 'name' => 'Growatt', 'tag' => __( 'Omvormers', 'voltalux' ), 'text' => __( 'Sterk in omvormers, geschikt voor in serie geschakelde zonnepaneelsystemen.', 'voltalux' ) ),
						array( 'name' => 'Jinko', 'tag' => __( 'Glas-folie', 'voltalux' ), 'text' => __( 'Een van de beste leveranciers van glas-folie panelen: efficiënt én kosteneffectief.', 'voltalux' ) ),
						array( 'name' => 'JA Solar', 'tag' => __( 'Glas-op-glas', 'voltalux' ), 'text' => __( 'Glas-op-glas panelen met een hoge duurzaamheid en lange levensduur.', 'voltalux' ) ),
						array( 'name' => 'Blue Base', 'tag' => __( 'Platte daken', 'voltalux' ), 'text' => __( 'Gespecialiseerd in montageconstructies voor platte dakconstructies.', 'voltalux' ) ),
						array( 'name' => 'Esdec', 'tag' => __( 'Schuine daken', 'voltalux' ), 'text' => __( 'Bekend om robuuste montageconstructies voor schuine daken.', 'voltalux' ) ),
					),
				),
				'voordelen' => array(
					'title' => __( 'De drie voordelen van zonnepanelen', 'voltalux' ),
					'items' => array(
						array( 'title' => __( 'Duurzame energie die er steeds meer toe doet', 'voltalux' ), 'text' => __( 'De zon is een onuitputtelijke, milieuvriendelijke bron. Met zonnepanelen verminder je het gebruik van fossiele brandstoffen én de uitstoot van broeikasgassen.', 'voltalux' ) ),
						array( 'title' => __( 'Eerst een investering, dan een besparing', 'voltalux' ), 'text' => __( 'Zodra de panelen op je dak liggen, zie je het direct terug op je energierekening. Heb je een koophuis? Dan verhogen zonnepanelen ook de woningwaarde.', 'voltalux' ) ),
						array( 'title' => __( 'Onafhankelijk van energie-aanbieders', 'voltalux' ), 'text' => __( 'Met zonnepanelen neem je de regie over je eigen opgewekte stroom en zit je niet vast aan sterk fluctuerende energieprijzen.', 'voltalux' ) ),
					),
				),
				'saldering' => array(
					'title' => __( 'Wat betekent de salderingsregeling?', 'voltalux' ),
					'text'  => __( 'Goed nieuws voor huiseigenaren: de salderingsregeling blijft behouden. Het eerdere plan om de regeling vanaf 2025 af te bouwen is verworpen door de Eerste Kamer. De stroom die je opwekt maar niet direct gebruikt, lever je terug aan het net; die teruglevering wordt verrekend met de stroom die je afneemt als je panelen even niet genoeg produceren. Zo blijf je profiteren van blijvende besparing op je energierekening.', 'voltalux' ),
				),
				'faq'       => array(
					array( __( 'Wat is het verschil tussen glas-glas en glas-folie panelen?', 'voltalux' ), __( 'Bij zonnepanelen kies je grofweg tussen glas-glas en glas-folie. De keuze hangt af van je wensen en situatie: duurzaamheid, rendement en kosten spelen allemaal mee. Glas-glas panelen gaan doorgaans langer mee, glas-folie is vaak voordeliger. Onze specialisten leggen de verschillen graag uit en geven altijd vrijblijvend advies.', 'voltalux' ) ),
					array( __( 'Wat is het verschil tussen een string-omvormer en een micro-omvormer?', 'voltalux' ), __( 'Een string-omvormer verbindt meerdere panelen in serie; een micro-omvormer verbindt elk paneel apart. Micro-omvormers zijn daardoor beter bij schaduw of verschillende dakhellingen. Een string-omvormer kan efficiënter zijn bij grote installaties met gelijke omstandigheden. We adviseren wat bij jouw dak past.', 'voltalux' ) ),
					array( __( 'Blijft de salderingsregeling bestaan?', 'voltalux' ), __( 'Ja. Het plan om de salderingsregeling vanaf 2025 af te bouwen is verworpen door de Eerste Kamer, dus je blijft profiteren van saldering op je teruggeleverde stroom.', 'voltalux' ) ),
					array( __( 'Hoe snel kunnen de panelen geplaatst worden?', 'voltalux' ), __( 'In de meeste gevallen plaatsen we je installatie binnen drie weken. Bij het adviesgesprek plannen we een datum die jou uitkomt.', 'voltalux' ) ),
				),
				'cta'       => array(
					'title' => __( 'Mogelijkheden bespreken?', 'voltalux' ),
					'text'  => __( 'Vraag een offerte op maat aan — binnen 24 uur ontvang je een voorstel. Geen aanbetaling, altijd eerst een check op locatie.', 'voltalux' ),
				),
			),

		)
	);
}

/**
 * Fetch a single service pillar by slug.
 *
 * @param string $slug Page slug.
 * @return array|null
 */
function voltalux_service( $slug ) {
	$all = voltalux_services_content();
	return isset( $all[ $slug ] ) ? $all[ $slug ] : null;
}
