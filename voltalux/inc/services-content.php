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
				'kind'    => __( 'Zonnepanelen', 'voltalux' ),
				'icon'    => 'sun',
				'eyebrow' => __( 'Zonnepanelen', 'voltalux' ),
				'h1'      => __( 'Zonnepanelen-specialist — wek je eigen [mark]stroom[/mark] op', 'voltalux' ),
				'lead'    => __( 'Ben je op zoek naar een betrouwbare en ervaren partner voor jouw zonne-energieproject? Kies voor Voltalux. Wij zijn gespecialiseerd in hoogwaardige zonne-energiesystemen en bieden op maat gemaakte oplossingen voor zowel particuliere als zakelijke klanten. Met zonnepanelen verlaag je je energiekosten, verhoog je de waarde van je woning én je energielabel, en draag je bij aan een groenere toekomst. Een win-win voor iedereen.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Eigen erkende installateurs', 'voltalux' ), 'text' => __( 'Gecertificeerde experts in eigen dienst — dat zorgt voor betrouwbaarheid en één aanspreekpunt.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'Binnen 3 weken geplaatst', 'voltalux' ), 'text' => __( 'Een vlotte, strak geplande transitie naar duurzame energie.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'A-merken tegen scherpe tarieven', 'voltalux' ), 'text' => __( 'Alleen de beste merken zijn goed genoeg — kwaliteit gecombineerd met toegankelijkheid.', 'voltalux' ) ),
				),
				'how'     => array(
					'title' => __( 'In 4 stappen uitgelegd hoe zonnepanelen werken', 'voltalux' ),
					'lead'  => __( 'De werking van zonnepanelen in vier eenvoudige stappen.', 'voltalux' ),
					'steps' => array(
						array( 'title' => __( 'Zonlicht valt op de panelen', 'voltalux' ), 'text' => __( 'De zonnecellen vangen daglicht op — ook op bewolkte dagen wek je stroom op.', 'voltalux' ) ),
						array( 'title' => __( 'De panelen wekken gelijkstroom op', 'voltalux' ), 'text' => __( 'Het opgevangen licht wordt in de cellen omgezet in gelijkstroom (DC).', 'voltalux' ) ),
						array( 'title' => __( 'De omvormer maakt er wisselstroom van', 'voltalux' ), 'text' => __( 'De omvormer zet gelijkstroom om naar 230V wisselstroom (AC) die je woning gebruikt.', 'voltalux' ) ),
						array( 'title' => __( 'Je verbruikt of levert terug', 'voltalux' ), 'text' => __( 'Wat je niet direct gebruikt lever je terug aan het net — dat verreken je via de salderingsregeling.', 'voltalux' ) ),
					),
				),
				'sections' => array(
					array(
						'type'    => 'compare',
						'id'      => 'glas',
						'nav'     => __( 'Glas-glas of glas-folie', 'voltalux' ),
						'eyebrow' => __( 'Soorten panelen', 'voltalux' ),
						'title'   => __( 'Glas-glas of glas-folie panelen?', 'voltalux' ),
						'lead'    => __( 'Twee soorten, elk met eigen sterke punten. We zetten ze naast elkaar zodat je makkelijker kiest.', 'voltalux' ),
						'cols'    => array(
							array( 'h' => __( 'Glas-glas', 'voltalux' ), 'rows' => array(
								array( 'k' => __( 'Opbouw', 'voltalux' ), 'v' => __( 'Aan beide zijden glas — de zonnecellen zijn dubbel beschermd.', 'voltalux' ) ),
								array( 'k' => __( 'Duurzaamheid', 'voltalux' ), 'v' => __( 'Hoge duurzaamheid en een lange levensduur; het glas beschermt tegen weer en degradatie.', 'voltalux' ) ),
								array( 'k' => __( 'Efficiëntie', 'voltalux' ), 'v' => __( 'Vaak een hoger rendement en betere prestaties bij hoge temperaturen.', 'voltalux' ) ),
							) ),
							array( 'h' => __( 'Glas-folie', 'voltalux' ), 'rows' => array(
								array( 'k' => __( 'Opbouw', 'voltalux' ), 'v' => __( 'Glas aan één kant, een dunne kunststof folie aan de andere.', 'voltalux' ) ),
								array( 'k' => __( 'Duurzaamheid', 'voltalux' ), 'v' => __( 'Duurzaam, maar doorgaans een kortere levensduur — folie is gevoeliger voor UV en vocht.', 'voltalux' ) ),
								array( 'k' => __( 'Efficiëntie', 'voltalux' ), 'v' => __( 'Efficiënt en kosteneffectief, iets minder bestand tegen hoge temperaturen.', 'voltalux' ) ),
							) ),
						),
						'cta'     => true,
					),
					array(
						'type'  => 'text',
						'paras' => array(
							__( 'De keuze tussen glas-glas en glas-folie hangt af van jouw specifieke behoeften, wensen en de toepassing van het systeem. Beide soorten hebben hun eigen voordelen en overwegingen — denk aan duurzaamheid, efficiëntie en kosten. Onze zonnepaneel-specialisten vertellen je er graag meer over en geven altijd vrijblijvend advies.', 'voltalux' ),
						),
						'cta'   => true,
					),
					array(
						'type'    => 'text',
						'id'      => 'omvormer',
						'nav'     => __( 'String- of micro-omvormer', 'voltalux' ),
						'eyebrow' => __( 'Omvormers', 'voltalux' ),
						'title'   => __( 'String-omvormer of micro-omvormer?', 'voltalux' ),
						'paras'   => array(
							__( 'Het grootste verschil is dat een string-omvormer meerdere zonnepanelen in serie verbindt, terwijl een micro-omvormer elk paneel afzonderlijk verbindt. Daardoor is een micro-omvormer over het algemeen beter geschikt voor situaties met schaduw of met panelen op verschillende plekken en hellingen. Een string-omvormer kan efficiënter zijn bij grote installaties met dezelfde omstandigheden. Vraag onze specialisten gerust om advies.', 'voltalux' ),
						),
						'cta'     => true,
					),
				),
				'brands'  => array(
					'title' => __( 'Welke merken gebruiken wij?', 'voltalux' ),
					'lead'  => __( 'We vinden het belangrijk dat je kunt kiezen uit de beste merken. Elk project is uniek en elke dakconstructie vraagt om de juiste panelen — daarom werken we met verschillende A-merken, elk met zijn eigen sterke punt.', 'voltalux' ),
					'items' => array(
						array( 'name' => 'Enphase', 'tag' => __( 'Micro-omvormers', 'voltalux' ), 'text' => __( 'Bekend om micro-omvormers, ideaal voor parallel geschakelde systemen en daken met schaduw.', 'voltalux' ) ),
						array( 'name' => 'Growatt', 'tag' => __( 'Omvormers', 'voltalux' ), 'text' => __( 'Sterk in omvormers, geschikt voor in serie geschakelde zonnepaneelsystemen.', 'voltalux' ) ),
						array( 'name' => 'Jinko', 'tag' => __( 'Glas-folie', 'voltalux' ), 'text' => __( 'Een van de beste leveranciers van glas-folie panelen: efficiënt én kosteneffectief.', 'voltalux' ) ),
						array( 'name' => 'JA Solar', 'tag' => __( 'Glas-op-glas', 'voltalux' ), 'text' => __( 'Glas-op-glas panelen met een hoge duurzaamheid en lange levensduur.', 'voltalux' ) ),
						array( 'name' => 'Blue Base', 'tag' => __( 'Platte daken', 'voltalux' ), 'text' => __( 'Gespecialiseerd in montageconstructies voor platte daken.', 'voltalux' ) ),
						array( 'name' => 'Esdec', 'tag' => __( 'Schuine daken', 'voltalux' ), 'text' => __( 'Bekend om robuuste montageconstructies voor schuine daken.', 'voltalux' ) ),
					),
				),
				'voordelen' => array(
					'title' => __( 'De drie voordelen van zonnepanelen', 'voltalux' ),
					'items' => array(
						array( 'title' => __( 'Duurzame energie wordt steeds belangrijker', 'voltalux' ), 'text' => __( 'De zon is een onuitputtelijke, milieuvriendelijke bron. Met zonnepanelen verminder je het gebruik van fossiele brandstoffen én de uitstoot van schadelijke broeikasgassen.', 'voltalux' ) ),
						array( 'title' => __( 'Eerst een investering, dan een besparing', 'voltalux' ), 'text' => __( 'Zodra de panelen op je dak liggen, zie je het direct terug op je energierekening. Heb je een koophuis? Dan verhogen zonnepanelen ook de woningwaarde.', 'voltalux' ) ),
						array( 'title' => __( 'Onafhankelijk van energie-aanbieders', 'voltalux' ), 'text' => __( 'Met zonnepanelen neem je de regie over je eigen opgewekte stroom en zit je niet vast aan sterk fluctuerende energieprijzen.', 'voltalux' ) ),
					),
				),
				'saldering' => array(
					'title' => __( 'Wat betekent de salderingsregeling?', 'voltalux' ),
					'text'  => __( 'Goed nieuws voor huiseigenaren: de salderingsregeling blijft behouden. Het eerdere plan om de regeling vanaf 2025 af te bouwen is verworpen door de Eerste Kamer. De stroom die je opwekt maar niet direct gebruikt, lever je terug aan het net; die teruglevering wordt verrekend met de stroom die je afneemt wanneer je panelen even niet genoeg produceren. Zo blijf je profiteren van blijvende besparing op je energierekening.', 'voltalux' ),
				),
				'faq'     => array(
					array( __( 'Hoe zit het met onderhoud en levensduur van zonnepanelen?', 'voltalux' ), __( 'Zonnepanelen vereisen over het algemeen minimaal onderhoud, afgezien van regelmatige reiniging om vuil en stof te verwijderen. De levensduur varieert, maar panelen gaan meestal meer dan 25 jaar mee voordat de efficiëntie begint af te nemen.', 'voltalux' ) ),
					array( __( 'Hoe wordt de opgewekte energie opgeslagen?', 'voltalux' ), __( 'De panelen op je dak produceren duurzame elektriciteit, die via een omvormer naar je apparaten gaat. Overtollige stroom sla je op in een thuisaccu; zodra die vol is, lever je terug aan het net. Daarvoor krijg je via de salderingsregeling nog een vergoeding.', 'voltalux' ) ),
					array( __( 'Blijft de salderingsregeling bestaan?', 'voltalux' ), __( 'Ja. Het plan om de salderingsregeling vanaf 2025 af te bouwen is verworpen door de Eerste Kamer, dus je blijft profiteren van saldering op je teruggeleverde stroom.', 'voltalux' ) ),
					array( __( 'Hoe snel kunnen de panelen geplaatst worden?', 'voltalux' ), __( 'In de meeste gevallen plaatsen we je installatie binnen drie weken. Tijdens het adviesgesprek plannen we een datum die jou uitkomt.', 'voltalux' ) ),
				),
				'cta'     => array(
					'title' => __( 'Mogelijkheden bespreken?', 'voltalux' ),
					'text'  => __( 'Vraag een offerte op maat aan — binnen 24 uur ontvang je een voorstel. Geen aanbetaling, altijd eerst een check op locatie.', 'voltalux' ),
				),
			),

			/* ------------------------------------------------------ Warmtepompen */
			'warmtepompen' => array(
				'kind'    => __( 'Warmtepompen', 'voltalux' ),
				'icon'    => 'heat',
				'eyebrow' => __( 'Warmtepompen', 'voltalux' ),
				'h1'      => __( 'Warmtepomp-specialist — duurzaam [mark]verwarmen[/mark] en koelen', 'voltalux' ),
				'lead'    => __( 'Eerlijk, snel en transparant — dat is wat mensen zeggen als ze met Voltalux in zee gaan. Wil je binnen de kortste keren je nieuwe warmtepomp geïnstalleerd hebben en de eerste stap zetten naar een duurzamer huis? Vraag een offerte aan en binnen 24 uur nemen we contact met je op.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Eigen erkende installateurs', 'voltalux' ), 'text' => __( 'Gecertificeerde experts in eigen dienst — dat geeft betrouwbaarheid en één aanspreekpunt.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'Binnen 3 weken geplaatst', 'voltalux' ), 'text' => __( 'Een vlotte, strak geplande transitie naar duurzame energie.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'A-merken tegen scherpe tarieven', 'voltalux' ), 'text' => __( 'Alleen de beste merken zijn goed genoeg — kwaliteit gecombineerd met toegankelijkheid.', 'voltalux' ) ),
				),
				'how'     => array(
					'title' => __( 'Hoe werkt een warmtepomp?', 'voltalux' ),
					'lead'  => __( 'Een warmtepomp haalt gratis warmte uit de omgeving en maakt daar bruikbare warmte van — in vier stappen.', 'voltalux' ),
					'steps' => array(
						array( 'title' => __( 'Warmte opnemen', 'voltalux' ), 'text' => __( 'De buitenunit onttrekt warmte aan de buitenlucht — ook bij lage temperaturen.', 'voltalux' ) ),
						array( 'title' => __( 'Compressie', 'voltalux' ), 'text' => __( 'Met een kleine hoeveelheid stroom brengt de compressor die warmte naar een bruikbaar niveau.', 'voltalux' ) ),
						array( 'title' => __( 'Warmte afgeven', 'voltalux' ), 'text' => __( 'De warmte gaat naar je vloerverwarming of radiatoren en naar je warm tapwater.', 'voltalux' ) ),
						array( 'title' => __( 'Ontspanning', 'voltalux' ), 'text' => __( 'Het koudemiddel koelt af en de cyclus begint opnieuw — efficiënt en milieuvriendelijk.', 'voltalux' ) ),
					),
				),
				'sections' => array(
					array(
						'type'    => 'text',
						'id'      => 'merken',
						'nav'     => __( 'Merken', 'voltalux' ),
						'eyebrow' => __( 'Onze merken', 'voltalux' ),
						'title'   => __( 'Welke warmtepomp-merken biedt Voltalux aan?', 'voltalux' ),
						'paras'   => array(
							__( 'Wij werken met Panasonic en Samsung warmtepompen. Beide merken zijn vooruitstrevend en innovatief; kies je hiervoor, dan kies je voor betrouwbaarheid en energie-efficiëntie.', 'voltalux' ),
							__( 'We werken al jaren met deze merken en voorzagen ruim 380 woningen van een warmtepomp. Zo weten we zeker dat ze voldoen aan de hoogste eisen — en heb jij er jarenlang plezier van. Een warmtepomp sluit je bovendien eenvoudig aan op je zonnepanelen, zodat je hem draait op je eigen opgewekte stroom.', 'voltalux' ),
						),
						'cta'     => true,
					),
					array(
						'type'    => 'cards',
						'id'      => 'voordelen',
						'nav'     => __( 'Voordelen', 'voltalux' ),
						'eyebrow' => __( 'Voordelen', 'voltalux' ),
						'title'   => __( '6 voordelen van een warmtepomp', 'voltalux' ),
						'items'   => array(
							array( 'icon' => 'spark', 'title' => __( 'Energie-efficiënt', 'voltalux' ), 'text' => __( 'Een warmtepomp haalt warmte uit de omgeving en verwarmt je huis met minimale energie.', 'voltalux' ) ),
							array( 'icon' => 'leaf', 'title' => __( 'Milieuvriendelijk', 'voltalux' ), 'text' => __( 'Geen uitstoot van broeikasgas en een lagere CO₂-uitstoot — beter voor het klimaat.', 'voltalux' ) ),
							array( 'icon' => 'euro', 'title' => __( 'Bespaart op energiekosten', 'voltalux' ), 'text' => __( 'Eerst een investering, daarna een besparing. Op de lange termijn ben je goedkoper uit.', 'voltalux' ) ),
							array( 'icon' => 'heat', 'title' => __( 'Koelt én verwarmt', 'voltalux' ), 'text' => __( 'Veel warmtepompen kunnen ook koelen, zodat je het hele jaar comfortabel woont.', 'voltalux' ) ),
							array( 'icon' => 'clock', 'title' => __( 'Lange levensduur', 'voltalux' ), 'text' => __( 'Met regelmatig onderhoud gaat een warmtepomp vele jaren mee.', 'voltalux' ) ),
							array( 'icon' => 'shield', 'title' => __( 'Stil in gebruik', 'voltalux' ), 'text' => __( 'Moderne warmtepompen maken nauwelijks geluid — jij en je buren merken er niets van.', 'voltalux' ) ),
						),
					),
				),
				'faq'     => array(
					array( __( 'Hoe kan ik mijn huis voorbereiden op een warmtepomp?', 'voltalux' ), __( 'Goede isolatie is het belangrijkst om warmteverlies te minimaliseren. Verwarmingssystemen als vloerverwarming verhogen de efficiëntie. Denk ook na over je warm water (bijvoorbeeld met een warmtepompboiler) en zorg dat je elektrische groep voldoende capaciteit heeft. Onze adviseurs komen graag op locatie om je te helpen de juiste keuzes te maken.', 'voltalux' ) ),
					array( __( 'Zijn warmtepompen energiezuinig?', 'voltalux' ), __( 'Ja. Warmtepompen zijn energiezuinig omdat ze warmte uit de omgeving hergebruiken en veel minder elektriciteit verbruiken dan een standaard verwarmingssysteem.', 'voltalux' ) ),
					array( __( 'Kom ik in aanmerking voor ISDE-subsidie?', 'voltalux' ), __( 'Voor veel warmtepompen geldt de ISDE-subsidie. Het exacte bedrag hangt af van het type en vermogen. We rekenen de subsidie voor je uit en helpen bij de aanvraag.', 'voltalux' ) ),
				),
				'cta'     => array(
					'title' => __( 'Benieuwd wat een warmtepomp jou oplevert?', 'voltalux' ),
					'text'  => __( 'Vraag een vrijblijvend adviesgesprek aan — inclusief een berekening van je besparing en de mogelijke subsidie.', 'voltalux' ),
				),
			),

			/* ------------------------------------------------------ Dakrenovatie / dakdekker */
			'dakdekker' => array(
				'kind'    => __( 'Dakrenovatie', 'voltalux' ),
				'icon'    => 'roof',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Dakrenovatie door ervaren [mark]dakdekkers[/mark]', 'voltalux' ),
				'lead'    => __( 'Wil je zeker zijn van een dak dat bestand is tegen alle weersomstandigheden én tegelijkertijd je woning verduurzamen? Bij Voltalux combineren we dakrenovatie met slimme energiebesparende oplossingen. Onze ervaren dakdekkers leveren vakwerk met oog voor detail en duurzaamheid — en dat tegen een eerlijke prijs. Plan eenvoudig een gratis adviesgesprek in; we komen graag langs om de mogelijkheden te bespreken.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Eigen erkende installateurs', 'voltalux' ), 'text' => __( 'Betrouwbare eigen experts met de benodigde certificaten.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'Snel en nauwkeurig werk', 'voltalux' ), 'text' => __( 'Een vlotte overgang naar duurzame oplossingen, netjes uitgevoerd.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'A-merken tegen scherpe tarieven', 'voltalux' ), 'text' => __( 'We werken alleen met de beste merken en hanteren vriendelijke prijzen.', 'voltalux' ) ),
				),
				'links'   => array(
					'title' => __( 'Verschillende soorten dakrenovatie', 'voltalux' ),
					'lead'  => __( 'Elke dakrenovatie is uniek: de benodigde werkzaamheden hangen af van de staat van je dak en jouw wensen. Bekijk per specialisme wat we voor je kunnen betekenen.', 'voltalux' ),
					'items' => array(
						array( 'label' => __( 'Bitumen dak vervangen', 'voltalux' ), 'icon' => 'roof', 'slug' => 'dakdekker/bitumen-dak-vervangen', 'text' => __( 'Nieuwe, waterdichte dakbedekking voor platte daken.', 'voltalux' ) ),
						array( 'label' => __( 'Dakreparatie', 'voltalux' ), 'icon' => 'shield', 'slug' => 'dakdekker/dak-reparatie', 'text' => __( 'Snel en vakkundig lekkages en schade verhelpen.', 'voltalux' ) ),
						array( 'label' => __( 'Dakisolatie', 'voltalux' ), 'icon' => 'leaf', 'slug' => 'dakdekker/dakisolatie', 'text' => __( 'Lagere energiekosten en een comfortabeler huis.', 'voltalux' ) ),
						array( 'label' => __( 'Dakkapel plaatsen', 'voltalux' ), 'icon' => 'home', 'slug' => 'dakdekker/dakkapel-plaatsen', 'text' => __( 'Meer licht en ruimte op je zolder.', 'voltalux' ) ),
						array( 'label' => __( 'Dakpannen vervangen', 'voltalux' ), 'icon' => 'roof', 'slug' => 'dakdekker/dakpannen-vervangen', 'text' => __( 'Een pannendak vernieuwen of herstellen.', 'voltalux' ) ),
						array( 'label' => __( 'Kunststof kozijnen', 'voltalux' ), 'icon' => 'home', 'slug' => 'dakdekker/kunststof-kozijnen', 'text' => __( 'Uitstekende isolatie en een lange levensduur.', 'voltalux' ) ),
					),
				),
				'sections' => array(
					array(
						'type'    => 'text',
						'id'      => 'wanneer',
						'nav'     => __( 'Wanneer nodig?', 'voltalux' ),
						'eyebrow' => __( 'Advies', 'voltalux' ),
						'title'   => __( 'Wanneer is een dakrenovatie nodig?', 'voltalux' ),
						'paras'   => array(
							__( 'Bij kleine gebreken aan je dak, zoals verschoven dakpannen of scheurtjes in de dakbedekking, is het belangrijk om snel actie te ondernemen. Soms volstaat een eenvoudige dakreparatie of een grondige dakreiniging, maar als de dakbedekking op meerdere plekken versleten is, is een volledige renovatie vaak de beste oplossing. Om verdere schade te voorkomen, raden we je aan om zo snel mogelijk advies in te winnen bij een professioneel dakdekker zoals Voltalux.', 'voltalux' ),
						),
					),
					array(
						'type'  => 'text',
						'title' => __( 'Zelf uitvoeren of je dak laten renoveren?', 'voltalux' ),
						'paras' => array(
							__( 'Twijfel je tussen zelf een dakrenovatie uitvoeren of het overlaten aan een professional? Hoewel kleine reparaties soms zelf te doen zijn, brengt een dakrenovatie de nodige risico’s en complexiteit met zich mee. Dakwerk vraagt om ervaring, gespecialiseerde kennis en de juiste veiligheidsuitrusting. Werken op hoogte met zware materialen is niet zomaar iets — laat dit daarom over aan een expert.', 'voltalux' ),
							__( 'Een professionele dakdekker zorgt voor vakwerk, biedt garantie op de uitgevoerde renovatie en bespaart je veel tijd. Kies voor zekerheid en kwaliteit met Voltalux en laat je dak veilig en deskundig renoveren.', 'voltalux' ),
						),
						'cta'   => true,
					),
					array(
						'type'    => 'text',
						'id'      => 'kosten',
						'nav'     => __( 'Kosten', 'voltalux' ),
						'eyebrow' => __( 'Kosten', 'voltalux' ),
						'title'   => __( 'Wat kost een dakrenovatie?', 'voltalux' ),
						'paras'   => array(
							__( 'De kosten van een dakrenovatie hangen af van verschillende factoren, zoals het totale oppervlak, de materiaalkeuze en de bereikbaarheid van het dak. Voor het overlagen van een bitumen dak starten de prijzen vanaf € 40,- per m², terwijl het volledig vervangen van een bitumen dak begint vanaf € 55,- per m².', 'voltalux' ),
							__( 'Het inschakelen van erkende dakdekkers is een slimme investering: zij vervangen niet alleen de dakbedekking, maar controleren ook de dakstructuur voor extra duurzaamheid. Wil je een beter beeld van de kosten voor jouw dakrenovatie? Vraag vrijblijvend een offerte aan.', 'voltalux' ),
						),
						'list'    => array(
							__( 'Bitumen dak overlagen: vanaf € 40,- per m² (excl. btw).', 'voltalux' ),
							__( 'Bitumen dak volledig vervangen: vanaf € 55,- per m² (excl. btw).', 'voltalux' ),
							__( 'Schuine daken: doorgaans tussen € 60,- en € 130,- per m², afhankelijk van materiaal en staat van het dak.', 'voltalux' ),
						),
						'cta'     => true,
					),
					array(
						'type'  => 'text',
						'title' => __( 'Subsidie voor dakrenovatie', 'voltalux' ),
						'paras' => array(
							__( 'Er zijn momenteel geen landelijke subsidies voor dakrenovaties, maar er zijn soms wel mogelijkheden via je gemeente. Sommige gemeenten bieden subsidie voor het verduurzamen van je woning, waaronder dakisolatie. Controleer de website van jouw gemeente om te zien of je in aanmerking komt voor financiële ondersteuning.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'feature',
						'icon'    => 'leaf',
						'cta'     => true,
						'title' => __( 'Totaaloplossingen voor verduurzaming', 'voltalux' ),
						'paras' => array(
							__( 'Voltalux biedt niet alleen expertise in dakrenovaties, maar levert ook complete verduurzamingspakketten voor woningen: van zonnepanelen en een thuisbatterij tot warmtepompen en airco’s. Door onze geïntegreerde aanpak heb je één aanspreekpunt voor al je verduurzamingsbehoeften — dat zorgt voor gemak en een efficiënt proces.', 'voltalux' ),
						),
					),
					array(
						'type'  => 'text',
						'title' => __( 'Je dak laten vervangen door professionele dakdekkers', 'voltalux' ),
						'paras' => array(
							__( 'Laat je dak professioneel vervangen door Voltalux. Onze dakdekkers combineren jarenlange expertise met grondige kennis van verschillende daktypen en materialen. Kies bijvoorbeeld voor geheel nieuwe dakbedekking of laat ons je dak isoleren. Ontdek de mogelijkheden tijdens een vrijblijvend gesprek met een van onze adviseurs.', 'voltalux' ),
						),
						'cta'   => true,
					),
				),
				'faq'     => array(
					array( __( 'Wat kost een nieuw dak?', 'voltalux' ), __( 'De kosten van een nieuw dak variëren sterk, omdat elk dak uniek is. Het hangt af van factoren zoals het type dak, de gekozen materialen en de omvang van de renovatie. Na een gratis dakinspectie ontvang je een heldere offerte op maat.', 'voltalux' ) ),
					array( __( 'Wat kost een dakrenovatie per m²?', 'voltalux' ), __( 'De kosten per vierkante meter verschillen per type dak. Voor platte daken betaal je gemiddeld tussen de € 45 en € 55 per m². Bij schuine daken liggen de kosten hoger, meestal tussen de € 60 en € 130 per m². De uiteindelijke prijs hangt af van de materialen en de staat van het dak.', 'voltalux' ) ),
					array( __( 'Hoe helpt een dakrenovatie mijn woning te verduurzamen?', 'voltalux' ), __( 'Een dakrenovatie verbetert de energie-efficiëntie aanzienlijk. Door goede isolatie, betere luchtdichtheid en reflecterende dakbedekking wordt warmteverlies in de winter beperkt en blijft het in de zomer koeler. Combineer je dit met zonnepanelen, dan profiteer je direct van duurzame energieopwekking — een investering die je op termijn terugverdient via lagere energiekosten.', 'voltalux' ) ),
					array( __( 'Welke subsidies zijn er voor dakrenovatie?', 'voltalux' ), __( 'Er zijn op dit moment geen landelijke subsidies voor dakrenovaties. Sommige gemeenten bieden echter wel financiële ondersteuning, afhankelijk van je locatie en de aard van de renovatie. Bekijk de website van jouw gemeente voor de mogelijkheden.', 'voltalux' ) ),
				),
				'cta'     => array(
					'title' => __( 'Klaar voor een nieuw dak?', 'voltalux' ),
					'text'  => __( 'Plan een gratis adviesgesprek met onze dakdekkers — vrijblijvend en op locatie.', 'voltalux' ),
				),
			),

			/* ------------------------------------------------------ Dakdekker-subpagina's (leaf-slug) */
			'bitumen-dak-vervangen' => array(
				'kind'    => __( 'Bitumen dak vervangen', 'voltalux' ),
				'icon'    => 'roof',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Bitumen dak vervangen — [mark]professioneel[/mark] en waterdicht', 'voltalux' ),
				'lead'    => __( 'Een goed onderhouden bitumen dak beschermt je huis tegen weer en wind, maar na verloop van tijd is vervanging nodig. Bij Voltalux zorgen we voor een professionele vervanging van je bitumen dak, zodat je weer jarenlang verzekerd bent van een waterdicht en betrouwbaar dak. Onze ervaren dakdekkers werken snel, nauwkeurig en met hoogwaardige materialen.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Erkende en ervaren dakdekkers', 'voltalux' ), 'text' => __( 'We werken uitsluitend met gecertificeerde en ervaren dakdekkers.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'Professionele vervanging', 'voltalux' ), 'text' => __( 'We plannen de werkzaamheden zorgvuldig en zorgen voor een soepele uitvoering.', 'voltalux' ) ),
					array( 'icon' => 'check', 'title' => __( 'Bitumen van de hoogste kwaliteit', 'voltalux' ), 'text' => __( 'Kwaliteitsbitumen dat tegen een stootje kan en jarenlang meegaat.', 'voltalux' ) ),
				),
				'sections' => array(
					array(
						'type'  => 'text',
						'title' => __( 'Wat is een bitumen dak?', 'voltalux' ),
						'paras' => array(
							__( 'Bitumen is een populair materiaal voor dakbedekking dankzij de uitstekende waterdichtheid en duurzaamheid. Het materiaal, gemaakt van aardolieproducten, is flexibel en kan goed tegen extreme temperaturen — van hitte tot kou.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'feature',
						'icon'    => 'roof',
						'title' => __( 'Bitumen dakbedekking op een plat dak', 'voltalux' ),
						'paras' => array(
							__( 'Bitumen is dé oplossing voor platte daken. Het materiaal sluit perfect aan op het oppervlak, waardoor we lekkages voorkomen. Bij Voltalux brengen we bitumen dakbedekking nauwkeurig aan en zorgen we voor een strakke afwerking met daktrimmen en ontluchtingspijpen.', 'voltalux' ),
						),
						'cta'   => true,
					),
					array(
						'type'  => 'text',
						'title' => __( 'De voordelen van bitumen dakbedekking', 'voltalux' ),
						'list'  => array(
							__( 'Waterdicht: voorkomt lekkages en beschermt je huis tegen vocht.', 'voltalux' ),
							__( 'Lange levensduur: gaat gemiddeld 20 tot 30 jaar mee.', 'voltalux' ),
							__( 'Flexibel: bestand tegen temperatuurschommelingen.', 'voltalux' ),
							__( 'Onderhoudsvriendelijk: eenvoudig te repareren bij kleine beschadigingen.', 'voltalux' ),
							__( 'Betaalbaar: een voordelige optie voor platte daken.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'cards',
						'eyebrow' => __( 'Mogelijkheden', 'voltalux' ),
						'title'   => __( 'Verschillende mogelijkheden', 'voltalux' ),
						'items'   => array(
							array( 'icon' => 'roof', 'title' => __( 'Nieuwe bitumen over oude dakbedekking', 'voltalux' ), 'text' => __( 'Als de oude laag bitumen nog in goede staat is, brengen we een nieuwe laag over de bestaande aan.', 'voltalux' ) ),
							array( 'icon' => 'shield', 'title' => __( 'Verwijderen en volledig vervangen', 'voltalux' ), 'text' => __( 'Bij ernstige schade verwijderen we de oude laag volledig en brengen we een nieuwe onder- en toplaag aan voor maximale duurzaamheid.', 'voltalux' ) ),
							array( 'icon' => 'leaf', 'title' => __( 'Dakcoating', 'voltalux' ), 'text' => __( 'Voor extra bescherming brengen we een speciale dakcoating aan. Dit verlengt de levensduur en reflecteert zonlicht.', 'voltalux' ) ),
						),
					),
					array(
						'type'    => 'text',
						'id'      => 'kosten',
						'nav'     => __( 'Kosten', 'voltalux' ),
						'eyebrow' => __( 'Kosten', 'voltalux' ),
						'title'   => __( 'Kosten per m² bitumen dak vervangen', 'voltalux' ),
						'paras'   => array(
							__( 'De kosten hangen af van de gekozen methode en de staat van je dak. Gemiddeld gaan we uit van de volgende prijzen:', 'voltalux' ),
						),
						'list'    => array(
							__( 'Nieuwe dakbedekking over je oude bitumen dak: vanaf € 40,- per m² (excl. btw).', 'voltalux' ),
							__( 'Volledige vervanging van je bitumen dak: vanaf € 55,- per m² (excl. btw).', 'voltalux' ),
						),
						'cta'     => true,
					),
					array(
						'type'    => 'cards',
						'title'   => __( 'Dak nog niet toe aan vervangen? Onze andere mogelijkheden', 'voltalux' ),
						'items'   => array(
							array( 'icon' => 'shield', 'title' => __( 'Bitumen dak repareren', 'voltalux' ), 'text' => __( 'Kleine beschadigingen zoals scheuren of blazen repareren we snel en vakkundig, zodat je dak weer waterdicht is — zonder hoge kosten.', 'voltalux' ) ),
							array( 'icon' => 'roof', 'title' => __( 'Bitumen dak verwijderen', 'voltalux' ), 'text' => __( 'Bij ernstige schade of veroudering verwijderen we het oude bitumen veilig, inclusief afvoer, en brengen we een nieuwe dakbedekking aan.', 'voltalux' ) ),
						),
					),
				),
				'faq'     => array(
					array( __( 'Wat zijn bitumen?', 'voltalux' ), __( 'Bitumen is een waterdicht materiaal gemaakt van aardolieproducten. Het is flexibel, duurzaam en wordt veel gebruikt voor dakbedekking vanwege de uitstekende bescherming tegen vocht en temperatuurverschillen.', 'voltalux' ) ),
					array( __( 'Wat zijn de voordelen van dakcoating op een bitumen dak?', 'voltalux' ), __( 'Dakcoating beschermt het bitumen dak tegen UV-straling, verlengt de levensduur en verhoogt de waterdichtheid. Daarnaast reflecteert het zonlicht, wat helpt bij het verminderen van de binnentemperatuur.', 'voltalux' ) ),
					array( __( 'Wat kost het om een bitumen dak te vervangen?', 'voltalux' ), __( 'De kosten starten vanaf € 40 per m² voor een nieuwe laag over de bestaande dakbedekking. Bij volledige vervanging beginnen de kosten bij € 55 per m² (exclusief btw).', 'voltalux' ) ),
					array( __( 'Hoe vaak moet je een bitumen dak vervangen?', 'voltalux' ), __( 'Een bitumen dak moet meestal na 20 tot 30 jaar worden vervangen, afhankelijk van de kwaliteit van het materiaal en het onderhoud.', 'voltalux' ) ),
					array( __( 'Wat is de levensduur van een bitumen dak?', 'voltalux' ), __( 'De levensduur ligt gemiddeld tussen de 20 en 30 jaar, afhankelijk van het gebruik en de blootstelling aan weersomstandigheden.', 'voltalux' ) ),
					array( __( 'Wanneer moet een bitumen dakbedekking vervangen worden?', 'voltalux' ), __( 'Vervanging is nodig bij ernstige beschadigingen, blazen of scheuren, of wanneer het dak zijn levensduur heeft bereikt en niet meer goed waterdicht is.', 'voltalux' ) ),
					array( __( 'Kan er nieuwe bitumen over oude dakbedekking?', 'voltalux' ), __( 'Ja, als de oude dakbedekking in goede staat verkeert, kan er een nieuwe laag bitumen overheen worden aangebracht. Dit is een voordelige en efficiënte optie.', 'voltalux' ) ),
					array( __( 'Waar kan bitumen niet tegen?', 'voltalux' ), __( 'Bitumen kan niet goed tegen langdurige blootstelling aan UV-straling zonder extra bescherming, zoals een grindlaag of dakcoating. Ook stilstaand water kan na verloop van tijd de waterdichtheid aantasten. Regelmatig onderhoud voorkomt deze problemen.', 'voltalux' ) ),
				),
				'cta'     => array(
					'title' => __( 'Bitumen dak laten vervangen?', 'voltalux' ),
					'text'  => __( 'Vraag een gratis adviesgesprek aan — inclusief inspectie en offerte op maat.', 'voltalux' ),
				),
			),
			'dak-reparatie' => array(
				'kind'    => __( 'Dakreparatie', 'voltalux' ),
				'icon'    => 'shield',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Dakreparatie door gecertificeerde [mark]dakdekkers[/mark]', 'voltalux' ),
				'lead'    => __( 'Heeft je dak schade door breuk of lekkage? Wacht niet langer en schakel een expert in. Onze dakdekkers lossen het snel en vakkundig op, zodat we verdere schade voorkomen. We verhelpen lekkages, repareren kapotte dakpannen en herstellen scheuren in je dakkapel. Neem direct contact op voor een gratis adviesgesprek en een snelle reparatie.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Professionele reparatie van je dak', 'voltalux' ), 'text' => __( 'Onze dakdekkers hebben jarenlange ervaring met het herstellen van alle soorten daken.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'We werken nauwkeurig en snel', 'voltalux' ), 'text' => __( 'We reageren snel op je hulpvraag en zorgen voor een vakkundige reparatie.', 'voltalux' ) ),
					array( 'icon' => 'check', 'title' => __( 'Hoogwaardige materialen', 'voltalux' ), 'text' => __( 'Een duurzame reparatie begint bij de juiste materialen — we gebruiken alleen A-merken.', 'voltalux' ) ),
				),
				'sections' => array(
					array(
						'type'    => 'text',
						'id'      => 'wanneer',
						'nav'     => __( 'Wanneer nodig?', 'voltalux' ),
						'eyebrow' => __( 'Advies', 'voltalux' ),
						'title'   => __( 'Wanneer is een dakreparatie nodig?', 'voltalux' ),
						'paras'   => array(
							__( 'Een dakreparatie is nodig wanneer je dak schade heeft door weersinvloeden, ouderdom of slijtage. Een beschadigd dak leidt al snel tot lekkages, warmteverlies en andere problemen. Let op deze signalen:', 'voltalux' ),
						),
						'list'    => array(
							__( 'Lekkages: vochtplekken op plafonds of muren.', 'voltalux' ),
							__( 'Beschadigde dakbedekking: scheuren in bitumen, loszittende of missende dakpannen.', 'voltalux' ),
							__( 'Loslatend houtwerk of lood: houtrot of beschadigd lood rond schoorsteen of dakrand.', 'voltalux' ),
							__( 'Energieverlies: een hoger energieverbruik kan wijzen op schade of slechte isolatie.', 'voltalux' ),
							__( 'Veiligheidsrisico’s: losse dakpannen of scheve dakgoten.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'cards',
						'eyebrow' => __( 'Specialismen', 'voltalux' ),
						'title'   => __( 'Verschillende soorten dakreparatie', 'voltalux' ),
						'items'   => array(
							array( 'icon' => 'roof', 'title' => __( 'Plat dak repareren', 'voltalux' ), 'text' => __( 'Dakbedekking vervangen, isolatie verbeteren of de dakconstructie vernieuwen — we bespreken de beste optie.', 'voltalux' ) ),
							array( 'icon' => 'roof', 'title' => __( 'Schuin dak repareren', 'voltalux' ), 'text' => __( 'We herstellen kapotte dakpannen en de onderliggende constructie voor een stevig, waterdicht resultaat.', 'voltalux' ) ),
							array( 'icon' => 'roof', 'title' => __( 'Dakpannen repareren', 'voltalux' ), 'text' => __( 'Verschoven of gebroken dakpannen vervangen we vakkundig; we controleren direct op onderliggende schade.', 'voltalux' ) ),
							array( 'icon' => 'shield', 'title' => __( 'Bitumen dak repareren', 'voltalux' ), 'text' => __( 'Scheuren herstellen we of we brengen een nieuwe laag aan als de huidige te veel slijtage vertoont.', 'voltalux' ) ),
							array( 'icon' => 'home', 'title' => __( 'Dakkapel repareren', 'voltalux' ), 'text' => __( 'Rot hout, lekkende naden of beschadigde dakbedekking rond de dakkapel lossen we op.', 'voltalux' ) ),
							array( 'icon' => 'check', 'title' => __( 'Complete dakrenovatie', 'voltalux' ), 'text' => __( 'Bij structurele schade vervangen we de dakbedekking, vernieuwen we de constructie en isoleren we direct.', 'voltalux' ) ),
							array( 'icon' => 'shield', 'title' => __( 'Lekkage oplossen', 'voltalux' ), 'text' => __( 'We sporen het probleem op en maken je dak weer volledig waterdicht.', 'voltalux' ) ),
							array( 'icon' => 'clock', 'title' => __( 'Spoedreparatie', 'voltalux' ), 'text' => __( 'Bij stormschade of ernstige lekkages kun je rekenen op onze snelle service. Bel ons direct.', 'voltalux' ) ),
						),
					),
					array(
						'type'    => 'text',
						'id'      => 'kosten',
						'nav'     => __( 'Kosten', 'voltalux' ),
						'eyebrow' => __( 'Kosten', 'voltalux' ),
						'title'   => __( 'Wat kost een dakreparatie?', 'voltalux' ),
						'price'   => array( array( 'v' => '€ 40', 'u' => 'p/m²', 'l' => __( 'Vanaf, voor eenvoudige reparaties', 'voltalux' ) ) ),
						'paras'   => array(
							__( 'De kosten hangen af van het type dak, de schade en de benodigde materialen. Bij Voltalux starten eenvoudige reparaties, zoals het herstellen van een plat dak met bitumen, vanaf € 40,- per m². Voor grotere werkzaamheden maken we een transparante offerte op maat. Plan een gratis adviesgesprek en krijg direct duidelijkheid.', 'voltalux' ),
						),
						'cta'     => true,
					),
					array(
						'type'    => 'feature',
						'icon'    => 'shield',
						'cta'     => true,
						'title' => __( 'Zelf repareren of laten repareren?', 'voltalux' ),
						'paras' => array(
							__( 'Zelf aan de slag gaan lijkt een manier om kosten te besparen, maar het brengt risico’s met zich mee. Zonder de juiste kennis leiden kleine fouten al snel tot grotere schade, lekkages of gevaarlijke situaties. Bij Voltalux ben je verzekerd van vakmanschap en kwaliteit — laat het werk aan ons over en bespaar jezelf tijd, moeite en problemen.', 'voltalux' ),
						),
					),
					array(
						'type'  => 'text',
						'alt'   => true,
						'title' => __( 'Voorkom dat een dakreparatie nodig is', 'voltalux' ),
						'paras' => array(
							__( 'Een goed onderhouden dak gaat langer mee en voorkomt onverwachte reparaties. Met deze tips spoor je schade vroegtijdig op:', 'voltalux' ),
						),
						'list'  => array(
							__( 'Plan regelmatig onderhoud en een jaarlijkse dakinspectie.', 'voltalux' ),
							__( 'Houd de dakgoten schoon en trim overhangende takken.', 'voltalux' ),
							__( 'Zorg voor goede ventilatie en controleer de afdichtingen.', 'voltalux' ),
							__( 'Bescherm de dakbedekking tegen UV-straling.', 'voltalux' ),
						),
					),
				),
				'faq'     => array(
					array( __( 'Hoe ontstaat schade aan je dak?', 'voltalux' ), __( 'Schade ontstaat vaak door weersinvloeden zoals storm, regen, hagel en UV-straling. Andere oorzaken zijn slijtage door ouderdom, slecht onderhoud, overhangende takken en verstoppingen in de dakgoten. Ook slechte ventilatie en gebrekkige afdichtingen rond dakramen en schoorstenen veroorzaken problemen.', 'voltalux' ) ),
					array( __( 'Hoe repareer ik de dakbedekking van mijn dak?', 'voltalux' ), __( 'Begin met een grondige inspectie. Kleine beschadigingen los je op door te reinigen, scheuren te dichten met bitumenkit of reparatietape, losse dakpannen te vervangen en lekkages af te dichten met een reparatiestrook of nieuwe laag bitumen. Bij grotere schade of twijfel schakel je een professionele dakdekker in.', 'voltalux' ) ),
					array( __( 'Wat kost een dakreparatie?', 'voltalux' ), __( 'De kosten variëren met het type dak, de omvang van de schade en het materiaal. Onze prijzen voor eenvoudige reparaties beginnen vanaf € 40,- per m². Voor een nauwkeurige indicatie maken we een vrijblijvende offerte.', 'voltalux' ) ),
					array( __( 'Hoe is de prijs van een dakreparatie opgebouwd?', 'voltalux' ), __( 'De prijs hangt af van het type dak (plat is vaak goedkoper dan schuin), de omvang van de schade, de gebruikte materialen, de arbeidskosten en eventuele extra’s zoals voorrijkosten of spoedtoeslagen. Je ontvangt een transparante offerte waarin alle factoren zijn opgenomen.', 'voltalux' ) ),
				),
				'cta'     => array( 'title' => __( 'Dak laten repareren?', 'voltalux' ), 'text' => __( 'Vraag een gratis adviesgesprek aan — we inspecteren en herstellen vakkundig.', 'voltalux' ) ),
			),

			'dakisolatie' => array(
				'kind'    => __( 'Dakisolatie', 'voltalux' ),
				'icon'    => 'leaf',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Dakisolatie door erkende [mark]installateurs[/mark]', 'voltalux' ),
				'lead'    => __( 'Bij een slecht geïsoleerd dak ontsnapt al gauw 30% van de warmte uit je woning — dat zorgt voor hogere energiekosten en minder wooncomfort. Kies daarom voor dakisolatie van Voltalux. Onze erkende installateurs werken met de beste materialen en zorgen voor een nauwkeurige afwerking, zodat je snel geniet van een warm huis in de winter, een koele woning in de zomer en een lagere energierekening.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Dakisolatie door erkende installateurs', 'voltalux' ), 'text' => __( 'We werken alleen met onze eigen, gecertificeerde mensen.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'Nauwkeurige isolatie van je dak', 'voltalux' ), 'text' => __( 'We gaan snel te werk, zodat je snel profiteert van een beter geïsoleerd dak.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'Kwaliteit voor een voordelige prijs', 'voltalux' ), 'text' => __( 'Dakisolatie met materiaal van A-merken voor de hoogste kwaliteit.', 'voltalux' ) ),
				),
				'sections' => array(
					array(
						'type'  => 'text',
						'title' => __( 'De voordelen van dakisolatie', 'voltalux' ),
						'list'  => array(
							__( 'Lagere energiekosten: je bespaart direct, zowel in de winter als in de zomer.', 'voltalux' ),
							__( 'Aangenaam binnenklimaat: warmte blijft binnen in de winter en buiten in de zomer.', 'voltalux' ),
							__( 'Hogere woningwaarde: een goed geïsoleerd dak maakt je huis aantrekkelijker.', 'voltalux' ),
							__( 'Minder geluidsoverlast dankzij de verbeterde isolatie.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'cards',
						'eyebrow' => __( 'Soorten daken', 'voltalux' ),
						'title'   => __( 'Verschillende soorten daken isoleren', 'voltalux' ),
						'lead'    => __( 'Of je nu een plat of schuin dak hebt — we checken eerst de staat van je dak en geven eerlijk advies over de slimste aanpak.', 'voltalux' ),
						'items'   => array(
							array( 'icon' => 'roof', 'title' => __( 'Plat dak isoleren', 'voltalux' ), 'text' => __( 'We isoleren aan de buitenkant of brengen een extra bitumenlaag aan, met hoogwaardige PIR-isolatie. Vanaf € 60,- per m² (excl. btw).', 'voltalux' ) ),
							array( 'icon' => 'roof', 'title' => __( 'Schuin dak isoleren', 'voltalux' ), 'text' => __( 'Isolatie aan de binnenzijde (tussen de dakspanten) of buitenzijde (op de dakconstructie) voor betere luchtdichtheid en minder warmteverlies.', 'voltalux' ) ),
						),
					),
					array(
						'type'    => 'cards',
						'title'   => __( 'Binnen- of buitenkant dak isoleren?', 'voltalux' ),
						'lead'    => __( 'Welke optie het beste is, hangt af van de staat van je dak en je wensen voor comfort en energiebesparing.', 'voltalux' ),
						'items'   => array(
							array( 'icon' => 'home', 'title' => __( 'Dakisolatie binnenzijde', 'voltalux' ), 'text' => __( 'We plaatsen isolatiemateriaal tussen de dakspanten, zonder de bestaande dakbedekking te verwijderen — snel en effectief.', 'voltalux' ) ),
							array( 'icon' => 'shield', 'title' => __( 'Dakisolatie buitenzijde', 'voltalux' ), 'text' => __( 'De beste prestaties: we verwijderen de dakbedekking, plaatsen PIR-isolatie en werken af met nieuwe dakbedekking. Ideaal bij dakrenovatie.', 'voltalux' ) ),
						),
					),
					array(
						'type'    => 'text',
						'id'      => 'kosten',
						'nav'     => __( 'Kosten', 'voltalux' ),
						'eyebrow' => __( 'Kosten', 'voltalux' ),
						'title'   => __( 'Kosten dakisolatie', 'voltalux' ),
						'price'   => array( array( 'v' => '€ 60', 'u' => 'p/m²', 'l' => __( 'Plat dak met PIR-isolatie', 'voltalux' ) ), array( 'v' => '€ 15', 'u' => 'p/m²', 'l' => __( 'ISDE-subsidie retour', 'voltalux' ) ) ),
						'paras'   => array(
							__( 'De kosten hangen af van het type dak en de gekozen materialen. Voor een plat dak starten de prijzen vanaf € 60,- per m² (excl. btw) met hoogwaardige PIR-isolatie. Dankzij de overheidssubsidie van € 15,- per m² bespaar je direct op de investering.', 'voltalux' ),
						),
						'cta'     => true,
					),
					array(
						'type'    => 'feature',
						'icon'    => 'euro',
						'cta'     => true,
						'title' => __( 'Subsidies en leningen', 'voltalux' ),
						'paras' => array(
							__( 'Profiteer van de ISDE-subsidie van € 15,- per m² voor het isoleren van je dak. Voer je binnen 24 maanden een tweede maatregel uit, dan stijgt dit naar € 30,- per m². Voltalux helpt je stap voor stap bij de aanvraag. Daarnaast kun je via het Nationaal Warmtefonds een lening met 0% rente afsluiten als je inkomen onder de € 60.000,- ligt.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'cards',
						'title'   => __( 'Zelf isoleren of een dakdekker inschakelen?', 'voltalux' ),
						'items'   => array(
							array( 'icon' => 'home', 'title' => __( 'Zelf dakisolatie aanbrengen', 'voltalux' ), 'text' => __( 'Zelf isoleren leidt vaak tot warmtelekken, vochtproblemen of schimmel. Bovendien heb je geen recht op subsidie: die geldt alleen als een erkend bedrijf de werkzaamheden uitvoert.', 'voltalux' ) ),
							array( 'icon' => 'shield', 'title' => __( 'Professionele dakisolatie', 'voltalux' ), 'text' => __( 'Onze specialisten isoleren je dak nauwkeurig en volledig luchtdicht, met garantie op de afwerking. Zo voorkom je fouten en bespaar je jaar na jaar.', 'voltalux' ) ),
						),
					),
					array(
						'type'  => 'text',
						'alt'   => true,
						'title' => __( 'Combineer dakisolatie met andere maatregelen', 'voltalux' ),
						'paras' => array(
							__( 'Bij Voltalux combineer je dakisolatie eenvoudig met andere energiebesparende oplossingen, zoals zonnepanelen of een warmtepomp. Zo profiteer je van:', 'voltalux' ),
						),
						'list'  => array(
							__( 'Een beter energielabel — voordelig voor je energiekosten én de verkoopwaarde.', 'voltalux' ),
							__( 'Energieneutraal wonen en minder afhankelijkheid van fossiele brandstoffen.', 'voltalux' ),
							__( 'Een lager gasverbruik en dus een lagere energierekening.', 'voltalux' ),
						),
					),
				),
				'faq'     => array(
					array( __( 'Wat is dakisolatie?', 'voltalux' ), __( 'Dakisolatie is het aanbrengen van isolatiemateriaal op of onder het dak om warmteverlies te voorkomen. Dit houdt je huis in de winter warmer en in de zomer koeler, waardoor je minder energie verbruikt.', 'voltalux' ) ),
					array( __( 'Waarom is dakisolatie belangrijk?', 'voltalux' ), __( 'Dakisolatie voorkomt warmteverlies en maakt je woning energiezuiniger. Zo verlaag je de energiekosten en verbeter je het comfort in huis, zowel in de winter als in de zomer.', 'voltalux' ) ),
					array( __( 'Kan ik subsidie krijgen voor dakisolatie?', 'voltalux' ), __( 'Je kunt gebruikmaken van de ISDE-subsidie: € 15,- per m² voor één maatregel, of € 30,- per m² als je binnen 24 maanden een tweede maatregel uitvoert. Daarnaast biedt het Nationaal Warmtefonds een lening met 0% rente als je inkomen onder de € 60.000,- ligt.', 'voltalux' ) ),
					array( __( 'Wat kost dakisolatie per m²?', 'voltalux' ), __( 'Voor een schuin dak betaal je gemiddeld € 20 tot € 50 per m² (binnenkant) en € 40 tot € 60 per m² (buitenkant). Bij een plat dak liggen de kosten voor binnenisolatie tussen € 25 en € 40 per m² en voor buitenisolatie tussen € 45 en € 100 per m².', 'voltalux' ) ),
				),
				'cta'     => array( 'title' => __( 'Je dak laten isoleren?', 'voltalux' ), 'text' => __( 'Vraag een gratis adviesgesprek aan met onze erkende installateurs.', 'voltalux' ) ),
			),

			'dakkapel-plaatsen' => array(
				'kind'    => __( 'Dakkapel plaatsen', 'voltalux' ),
				'icon'    => 'home',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Dakkapel plaatsen door ervaren [mark]dakdekkers[/mark]', 'voltalux' ),
				'lead'    => __( 'Een dakkapel zorgt voor extra licht, meer ruimte én een hogere woningwaarde. De dakdekkers van Voltalux plaatsen een stijlvolle, duurzame dakkapel die precies past bij je woning. Onze specialisten werken snel en nauwkeurig, zodat jij binnen de kortste keren geniet van je nieuwe leefruimte.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Professionele plaatsing', 'voltalux' ), 'text' => __( 'We werken met onze eigen, ervaren dakdekkers.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'Nauwkeurig geplaatst', 'voltalux' ), 'text' => __( 'Snel en efficiënt, zodat je vlot plezier hebt van je nieuwe dakkapel.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'Kwaliteit voor een scherpe prijs', 'voltalux' ), 'text' => __( 'We plaatsen dakkapellen van materiaal van de hoogste kwaliteit.', 'voltalux' ) ),
				),
				'sections' => array(
					array(
						'type'  => 'text',
						'title' => __( 'Wat is een dakkapel?', 'voltalux' ),
						'paras' => array(
							__( 'Een dakkapel is dé oplossing om je zolder om te toveren tot een lichte, functionele ruimte — denk aan een extra slaapkamer of een handige thuiswerkplek. Het voegt comfort en gebruiksgemak toe en maakt de uitstraling van je huis mooier.', 'voltalux' ),
						),
					),
					array(
						'type'  => 'text',
						'title' => __( 'De voordelen van een dakkapel', 'voltalux' ),
						'list'  => array(
							__( 'Meer natuurlijk licht in huis.', 'voltalux' ),
							__( 'Extra ruimte en wooncomfort.', 'voltalux' ),
							__( 'Een hogere woningwaarde.', 'voltalux' ),
							__( 'Energiezuinig dankzij isolerende materialen.', 'voltalux' ),
							__( 'Diverse stijlen en afwerkingen mogelijk.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'cards',
						'eyebrow' => __( 'Soorten', 'voltalux' ),
						'title'   => __( 'We plaatsen verschillende soorten dakkapellen', 'voltalux' ),
						'items'   => array(
							array( 'icon' => 'home', 'title' => __( 'Kunststof dakkapel', 'voltalux' ), 'text' => __( 'Onderhoudsarm, duurzaam en in verschillende kleuren. Bestand tegen alle weer en met uitstekende isolatie.', 'voltalux' ) ),
							array( 'icon' => 'home', 'title' => __( 'Houten dakkapel', 'voltalux' ), 'text' => __( 'Een warme, authentieke uitstraling — ideaal voor klassieke woningen en veel maatwerk mogelijk.', 'voltalux' ) ),
							array( 'icon' => 'home', 'title' => __( 'Polyester dakkapel', 'voltalux' ), 'text' => __( 'Licht van gewicht en in één stuk gemaakt: snelle plaatsing en minimale kans op lekkages.', 'voltalux' ) ),
							array( 'icon' => 'clock', 'title' => __( 'Prefab dakkapel', 'voltalux' ), 'text' => __( 'Volledig in de fabriek geproduceerd voor constante kwaliteit — en in slechts één dag geplaatst.', 'voltalux' ) ),
							array( 'icon' => 'shield', 'title' => __( 'Traditionele dakkapel', 'voltalux' ), 'text' => __( 'Op maat gemaakt en ter plekke opgebouwd, met eindeloze mogelijkheden in materiaal, stijl en afwerking.', 'voltalux' ) ),
						),
					),
					array(
						'type'  => 'text',
						'title' => __( 'Afmetingen dakkapel', 'voltalux' ),
						'paras' => array(
							__( 'De afmetingen bepalen de uitstraling én het gebruiksgemak. Je kunt kiezen uit prefab varianten of volledig op maat. Enkele veelvoorkomende breedtes:', 'voltalux' ),
						),
						'list'  => array(
							__( '1,5 meter — ideaal voor kleine ruimtes of zolderkamers.', 'voltalux' ),
							__( '2,5 meter — geschikt voor extra licht en een ruimtelijk effect.', 'voltalux' ),
							__( '4 meter — perfect voor grotere slaapkamers of werkruimtes.', 'voltalux' ),
							__( '6 meter — voor maximale ruimte over de volledige daklengte.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'text',
						'id'      => 'kosten',
						'nav'     => __( 'Kosten', 'voltalux' ),
						'eyebrow' => __( 'Kosten', 'voltalux' ),
						'title'   => __( 'Wat kost een dakkapel?', 'voltalux' ),
						'paras'   => array(
							__( 'De kosten hangen af van de afmetingen, het materiaal en de gewenste afwerking. Bij Voltalux starten de prijzen vanaf € 1.500,- voor een dakkapel van een meter breed. In sommige gemeenten zijn subsidies beschikbaar om je huis te verduurzamen — informeer naar de mogelijkheden of vraag ons om advies.', 'voltalux' ),
						),
						'cta'     => true,
					),
					array(
						'type'  => 'text',
						'title' => __( 'Heb ik een vergunning nodig?', 'voltalux' ),
						'paras' => array(
							__( 'Vaak kun je vergunningsvrij bouwen, mits je aan specifieke regels voldoet. De voorwaarden voor vergunningsvrij bouwen zijn onder andere:', 'voltalux' ),
						),
						'list'  => array(
							__( 'De dakkapel wordt geplaatst aan de achter- of zijkant van het huis.', 'voltalux' ),
							__( 'De breedte is maximaal 5 meter.', 'voltalux' ),
							__( 'De dakkapel blijft minimaal 0,5 meter van de dakrand.', 'voltalux' ),
							__( 'De totale hoogte is niet meer dan 1,75 meter.', 'voltalux' ),
							__( 'Het dak heeft een minimale helling van 30 graden.', 'voltalux' ),
						),
					),
				),
				'faq'     => array(
					array( __( 'Is het laten plaatsen van een dakkapel duur?', 'voltalux' ), __( 'De kosten hangen af van de grootte, het materiaal en de afwerking. Er zijn opties voor verschillende budgetten, van eenvoudig tot luxueus.', 'voltalux' ) ),
					array( __( 'Is een dakkapel prijsvast?', 'voltalux' ), __( 'De prijs staat vast zodra je een offerte hebt geaccepteerd. Extra kosten ontstaan alleen bij wijzigingen in het ontwerp of onverwachte complicaties.', 'voltalux' ) ),
					array( __( 'Hoelang duurt het plaatsen van een dakkapel?', 'voltalux' ), __( 'Een prefab dakkapel plaatsen we meestal in één dag. Traditionele dakkapellen kunnen enkele dagen duren, afhankelijk van de complexiteit.', 'voltalux' ) ),
					array( __( 'Wanneer kies je voor een prefab dakkapel?', 'voltalux' ), __( 'Een prefab dakkapel is ideaal als je snel resultaat wilt zonder in te leveren op kwaliteit — een voordelige en efficiënte oplossing.', 'voltalux' ) ),
					array( __( 'Is een prefab dakkapel geschikt voor mijn woning?', 'voltalux' ), __( 'Een prefab dakkapel is geschikt voor de meeste woningen met een hellend dak en een goede keuze als je een snelle, betaalbare oplossing zoekt.', 'voltalux' ) ),
					array( __( 'Waar moet ik rekening mee houden op de dag van plaatsing?', 'voltalux' ), __( 'Zorg dat de ruimte rond je huis vrij is van obstakels, zodat we de dakkapel makkelijk kunnen plaatsen. Houd ook rekening met geluid en eventuele toegang voor een hijskraan.', 'voltalux' ) ),
				),
				'cta'     => array( 'title' => __( 'Dakkapel laten plaatsen?', 'voltalux' ), 'text' => __( 'Plan een gratis adviesgesprek — we bespreken afmetingen, uitvoering en prijs.', 'voltalux' ) ),
			),

			'dakpannen-vervangen' => array(
				'kind'    => __( 'Dakpannen vervangen', 'voltalux' ),
				'icon'    => 'roof',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Dakpannen vervangen door [mark]dakdekkersbedrijf[/mark] Voltalux', 'voltalux' ),
				'lead'    => __( 'Zijn je dakpannen beschadigd, versleten of verschoven? Wacht niet te lang en voorkom grotere problemen. Onze ervaren dakdekkers vervangen je dakpannen snel en vakkundig, zodat je dak weer volledig beschermd is tegen weer en wind. We adviseren je over de beste opties en zorgen voor een duurzaam, strak resultaat.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Professioneel pannendak vervangen', 'voltalux' ), 'text' => __( 'Bij Voltalux vervangen we je pannendak vakkundig en snel.', 'voltalux' ) ),
					array( 'icon' => 'check', 'title' => __( 'Nauwkeurig dakpannen leggen', 'voltalux' ), 'text' => __( 'We leggen je dakpannen zorgvuldig en waterdicht, voor jarenlange bescherming.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'Dakpannen van hoge kwaliteit', 'voltalux' ), 'text' => __( 'We werken uitsluitend met dakpannen van de hoogste kwaliteit.', 'voltalux' ) ),
				),
				'sections' => array(
					array(
						'type'  => 'text',
						'title' => __( 'Waarom je pannendak vervangen?', 'voltalux' ),
						'paras' => array(
							__( 'Een pannendak vervangen is meer dan schade herstellen; het is een investering in de toekomst van je woning. Nieuwe dakpannen verbeteren de isolatie — dat zorgt voor een lagere energierekening en meer comfort — en verhogen de waarde van je huis. Bovendien maak je je woning weer weerbestendig en klaar voor de toekomst.', 'voltalux' ),
							__( 'Vervangen is nodig wanneer de dakpannen hun beschermende functie verliezen. Let op deze signalen:', 'voltalux' ),
						),
						'list'  => array(
							__( 'Scheuren of breuken: beschadigde dakpannen laten vocht door.', 'voltalux' ),
							__( 'Verschoven of missende dakpannen: je dak wordt kwetsbaar bij wind en regen.', 'voltalux' ),
							__( 'Mos- en algengroei: dit tast de dakpannen aan en veroorzaakt waterophoping.', 'voltalux' ),
							__( 'Leeftijd: zijn de dakpannen ouder dan 30 jaar, dan is vervanging vaak nodig.', 'voltalux' ),
							__( 'Slechte isolatie: oude dakpannen veroorzaken warmteverlies en hogere energiekosten.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'cards',
						'eyebrow' => __( 'Materialen', 'voltalux' ),
						'title'   => __( 'Verschillende soorten dakpannen', 'voltalux' ),
						'items'   => array(
							array( 'icon' => 'roof', 'title' => __( 'Keramische dakpannen', 'voltalux' ), 'text' => __( 'Traditioneel, authentiek, duurzaam en kleurvast — perfect voor klassieke woningen.', 'voltalux' ) ),
							array( 'icon' => 'roof', 'title' => __( 'Betonnen dakpannen', 'voltalux' ), 'text' => __( 'Een lange levensduur en voordelig; vooral te zien op modernere woningen.', 'voltalux' ) ),
							array( 'icon' => 'roof', 'title' => __( 'Kunststof dakpannen', 'voltalux' ), 'text' => __( 'Lichtgewicht en onderhoudsarm, ideaal voor minder draagkrachtige daken.', 'voltalux' ) ),
							array( 'icon' => 'roof', 'title' => __( 'Dakpanplaten', 'voltalux' ), 'text' => __( 'Een snelle en betaalbare optie die we vooral bij dakrenovaties gebruiken.', 'voltalux' ) ),
							array( 'icon' => 'roof', 'title' => __( 'Geglazuurde dakpannen', 'voltalux' ), 'text' => __( 'Een luxe uitstraling met extra bescherming tegen vuil en mos.', 'voltalux' ) ),
							array( 'icon' => 'roof', 'title' => __( 'Oud-Hollandse dakpannen', 'voltalux' ), 'text' => __( 'De typische, golvende dakpannen: tijdloos en ideaal voor historische panden.', 'voltalux' ) ),
						),
					),
					array(
						'type'  => 'text',
						'title' => __( 'Zelf een dakpan vervangen of laten vervangen?', 'voltalux' ),
						'paras' => array(
							__( 'Een enkele dakpan zelf vervangen kan, maar zonder ervaring loop je risico op meer schade of gevaarlijke situaties op hoogte. Gaat het om een compleet pannendak? Laat het werk dan altijd uitvoeren door een dakdekkersbedrijf zoals Voltalux. We zorgen voor veilige, vakkundige plaatsing en controleren de dakconstructie direct op verborgen gebreken.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'text',
						'id'      => 'kosten',
						'nav'     => __( 'Kosten', 'voltalux' ),
						'eyebrow' => __( 'Kosten', 'voltalux' ),
						'title'   => __( 'Kosten dakpannen vervangen', 'voltalux' ),
						'paras'   => array(
							__( 'De kosten zijn afhankelijk van je situatie. Je ontvangt altijd een transparante offerte op maat. De prijs wordt onder andere bepaald door:', 'voltalux' ),
						),
						'list'    => array(
							__( 'Het type dakpannen.', 'voltalux' ),
							__( 'De omvang van het dak.', 'voltalux' ),
							__( 'De staat van de dakconstructie.', 'voltalux' ),
							__( 'De bereikbaarheid van het dak.', 'voltalux' ),
							__( 'Eventuele extra’s, zoals het aanbrengen van dakisolatie.', 'voltalux' ),
						),
						'cta'     => true,
					),
					array(
						'type'  => 'text',
						'alt'   => true,
						'title' => __( 'Combineer met dakisolatie', 'voltalux' ),
						'paras' => array(
							__( 'Bij het vervangen van je pannendak is dit hét moment om direct te investeren in dakisolatie. Een goed geïsoleerd dak voorkomt warmteverlies in de winter, houdt je woning koel in de zomer en verlaagt je energiekosten aanzienlijk. Zo profiteer je van een duurzame oplossing die je wooncomfort verhoogt en de levensduur van je dak verlengt.', 'voltalux' ),
						),
					),
				),
				'faq'     => array(
					array( __( 'Wat kost het vervangen van een pannendak?', 'voltalux' ), __( 'De kosten zijn afhankelijk van het type dakpan, de omvang van het dak en de staat van de dakconstructie. Extra werkzaamheden, zoals isolatie of versteviging, kunnen de prijs verhogen.', 'voltalux' ) ),
					array( __( 'Hoe oud mogen dakpannen zijn?', 'voltalux' ), __( 'Dakpannen gaan gemiddeld 30 tot 50 jaar mee, afhankelijk van het materiaal en onderhoud. Keramische dakpannen gaan langer mee dan betonnen. Bij zichtbare slijtage of scheuren is vervanging nodig, ook binnen die periode.', 'voltalux' ) ),
					array( __( 'Kun je zelf dakpannen vervangen?', 'voltalux' ), __( 'Een enkele dakpan vervangen kan zelf, maar vereist voorzichtigheid en de juiste techniek. Voor grotere projecten of volledige vervangingen schakel je beter een professional in om schade en onveilige situaties te voorkomen.', 'voltalux' ) ),
					array( __( 'Hoe vervang ik een kapotte dakpan?', 'voltalux' ), __( 'Schuif de beschadigde dakpan voorzichtig omhoog en verwijder deze. Plaats de nieuwe dakpan op dezelfde plek op de panlatten, zodat deze goed aansluit. Let op dat je de dakconstructie of andere dakpannen niet beschadigt.', 'voltalux' ) ),
					array( __( 'Hoe weet ik welke dakpannen ik heb?', 'voltalux' ), __( 'Kijk naar de vorm, het materiaal en eventuele merktekens aan de onderzijde. Veelvoorkomende soorten zijn keramische, betonnen en geglazuurde dakpannen. Bij twijfel bepaalt een dakdekker het type voor je.', 'voltalux' ) ),
					array( __( 'Hoe vaak moeten dakpannen vervangen worden?', 'voltalux' ), __( 'Doorgaans na 30 tot 50 jaar, afhankelijk van slijtage, weersinvloeden en onderhoud.', 'voltalux' ) ),
					array( __( 'Waarom geen zonnepanelen op oude dakpannen?', 'voltalux' ), __( 'Bij het plaatsen van zonnepanelen moeten de dakconstructie en dakpannen in goede staat zijn om de extra belasting veilig te dragen. Oude dakpannen hebben vaak onvoldoende draagkracht, wat het risico op lekkages of verzakking vergroot.', 'voltalux' ) ),
				),
				'cta'     => array( 'title' => __( 'Dakpannen laten vervangen?', 'voltalux' ), 'text' => __( 'Vraag een gratis adviesgesprek aan met onze dakdekkers.', 'voltalux' ) ),
			),

			'kunststof-kozijnen' => array(
				'kind'    => __( 'Kunststof kozijnen', 'voltalux' ),
				'icon'    => 'home',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Kunststof kozijnen laten plaatsen — [mark]isolatie[/mark] en stijl', 'voltalux' ),
				'lead'    => __( 'Kunststof kozijnen zijn de perfecte combinatie van duurzaamheid, stijl en onderhoudsgemak. Ze passen bij elke woning en dragen bij aan een betere isolatie en lagere energiekosten. Kies voor kunststof kozijnen van Voltalux en profiteer van hoogwaardige kozijnen met een professionele plaatsing.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Professionele plaatsing', 'voltalux' ), 'text' => __( 'Bij Voltalux combineren we vakmanschap met precisie.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'Nauwkeurige werkwijze', 'voltalux' ), 'text' => __( 'Van de eerste meting tot de plaatsing werken we netjes en efficiënt.', 'voltalux' ) ),
					array( 'icon' => 'check', 'title' => __( 'Hoge kwaliteit', 'voltalux' ), 'text' => __( 'Kies voor kwaliteit en geniet jarenlang van een perfect resultaat.', 'voltalux' ) ),
				),
				'sections' => array(
					array(
						'type'  => 'text',
						'title' => __( 'Voordelen van kunststof kozijnen', 'voltalux' ),
						'list'  => array(
							__( 'Energiezuinig: verlaag je energierekening dankzij verbeterde isolatie.', 'voltalux' ),
							__( 'Onderhoudsarm: nooit meer schilderen of schuren — een doekje volstaat.', 'voltalux' ),
							__( 'Duurzaam: bestand tegen alle weersinvloeden en slijtage.', 'voltalux' ),
							__( 'Stijlvol: keuze uit talloze kleuren en afwerkingen.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'cards',
						'eyebrow' => __( 'Toepassingen', 'voltalux' ),
						'title'   => __( 'Kunststof kozijnen voor ramen en deuren', 'voltalux' ),
						'items'   => array(
							array( 'icon' => 'home', 'title' => __( 'Kozijnen voor ramen', 'voltalux' ), 'text' => __( 'Voor licht, isolatie en comfort — vaste ramen, draai-kiepramen of schuiframen, altijd netjes afgewerkt.', 'voltalux' ) ),
							array( 'icon' => 'shield', 'title' => __( 'Kozijnen voor deuren', 'voltalux' ), 'text' => __( 'Stevigheid met een mooi uiterlijk, geschikt voor voordeuren, achterdeuren en zelfs schuifpuien.', 'voltalux' ) ),
						),
					),
					array(
						'type'  => 'text',
						'title' => __( 'Details en levensduur', 'voltalux' ),
						'paras' => array(
							__( 'We maken onze kunststof kozijnen volledig op maat. Enkele kenmerken waarmee ze zich onderscheiden:', 'voltalux' ),
						),
						'list'  => array(
							__( 'Isolerend HR++ of triple glas: standaard, voor een energiezuinige woning.', 'voltalux' ),
							__( 'Talloze kleuren en houtnerfstructuren om je kozijnen te personaliseren.', 'voltalux' ),
							__( 'Onderhoudsvrije, UV-bestendige afwerking die jarenlang kleur en glans behoudt.', 'voltalux' ),
							__( 'Ventilatiemogelijkheden zonder afbreuk te doen aan de isolatiewaarde.', 'voltalux' ),
							__( 'Lange levensduur: kunststof kozijnen gaan gemiddeld 50 jaar of langer mee.', 'voltalux' ),
						),
					),
					array(
						'type'    => 'text',
						'id'      => 'kosten',
						'nav'     => __( 'Kosten', 'voltalux' ),
						'eyebrow' => __( 'Kosten', 'voltalux' ),
						'title'   => __( 'Kosten kunststof kozijnen', 'voltalux' ),
						'paras'   => array(
							__( 'De kosten verschillen per project en hangen af van het type kozijn (draai-kiepraam, schuifpui of vast kozijn), de glaskeuze (HR++ of triple glas) en de afmetingen. Omdat elk project uniek is, werken we met offertes op maat, zodat je een helder overzicht van de kosten krijgt.', 'voltalux' ),
						),
						'cta'     => true,
					),
					array(
						'type'  => 'text',
						'alt'   => true,
						'title' => __( 'Subsidie voor kunststof kozijnen', 'voltalux' ),
						'paras' => array(
							__( 'Bij het vervangen van kozijnen is subsidie mogelijk, vooral wanneer je kiest voor isolerend HR++ of triple glas. Om in aanmerking te komen dien je de aanvraag binnen 24 maanden na plaatsing in. Na de installatie ontvang je een volledig opleverdocument met alle benodigde informatie, zodat de subsidieaanvraag eenvoudig verloopt — en waar nodig helpen wij je daarbij.', 'voltalux' ),
						),
					),
				),
				'faq'     => array(
					array( __( 'Wat kost een kunststof kozijn inclusief montage?', 'voltalux' ), __( 'De exacte kosten hangen af van de afmetingen, glaskeuze en afwerking. Je ontvangt van ons een offerte op maat.', 'voltalux' ) ),
					array( __( 'Is een huis meer waard met kunststof kozijnen?', 'voltalux' ), __( 'Ja. Kunststof kozijnen verhogen de waarde van je woning door betere isolatie, lagere energiekosten en een moderne uitstraling. Kopers waarderen de duurzaamheid en het onderhoudsgemak.', 'voltalux' ) ),
					array( __( 'Kan ik subsidie krijgen voor kunststof kozijnen?', 'voltalux' ), __( 'In sommige gevallen is subsidie mogelijk, bijvoorbeeld bij HR++ of triple glas. Onze experts helpen je graag bij het aanvragen van de beschikbare subsidies.', 'voltalux' ) ),
				),
				'cta'     => array( 'title' => __( 'Kunststof kozijnen laten plaatsen?', 'voltalux' ), 'text' => __( 'Vraag vrijblijvend een offerte aan en ontdek de mogelijkheden.', 'voltalux' ) ),
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
