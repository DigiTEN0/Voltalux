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

			/* ------------------------------------------------------ Warmtepompen */
			'warmtepompen' => array(
				'kind'    => __( 'Warmtepompen', 'voltalux' ),
				'icon'    => 'heat',
				'eyebrow' => __( 'Warmtepompen', 'voltalux' ),
				'h1'      => __( 'Warmtepomp laten installeren — [mark]lager[/mark] verbruik, meer comfort', 'voltalux' ),
				'lead'    => __( 'Van een hybride warmtepomp naast je cv-ketel tot een volledig all-electric systeem: Voltalux installeert de warmtepomp die bij jouw woning past. Lagere energiekosten, een comfortabel binnenklimaat het hele jaar door — en in veel gevallen kom je in aanmerking voor ISDE-subsidie.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Eigen erkende installateurs', 'voltalux' ), 'text' => __( 'Gecertificeerde monteurs in eigen dienst — één aanspreekpunt van advies tot nazorg.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'Vaak ISDE-subsidie', 'voltalux' ), 'text' => __( 'Op veel warmtepompen krijg je subsidie van de overheid. Wij rekenen het voor je uit.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'Snel en netjes geplaatst', 'voltalux' ), 'text' => __( 'Strak geplande installatie met minimale overlast in en om je woning.', 'voltalux' ) ),
				),
				'how'     => array(
					'title' => __( 'Zo werkt een warmtepomp', 'voltalux' ),
					'lead'  => __( 'Een warmtepomp haalt gratis warmte uit de buitenlucht en maakt daar bruikbare warmte van.', 'voltalux' ),
					'steps' => array(
						array( 'title' => __( 'Warmte uit de buitenlucht', 'voltalux' ), 'text' => __( 'De buitenunit onttrekt warmte aan de lucht — ook bij lage temperaturen.', 'voltalux' ) ),
						array( 'title' => __( 'De compressor verhoogt de temperatuur', 'voltalux' ), 'text' => __( 'Met een kleine hoeveelheid stroom brengt de warmtepomp de warmte naar bruikbaar niveau.', 'voltalux' ) ),
						array( 'title' => __( 'Warmte voor verwarming en warm water', 'voltalux' ), 'text' => __( 'De warmte gaat naar je radiatoren of vloerverwarming en (bij een combi) naar warm tapwater.', 'voltalux' ) ),
						array( 'title' => __( 'In de zomer koelen', 'voltalux' ), 'text' => __( 'Veel systemen kunnen ook koelen, zodat je het hele jaar comfortabel woont.', 'voltalux' ) ),
					),
				),
				'voordelen' => array(
					'title' => __( 'De voordelen van een warmtepomp', 'voltalux' ),
					'items' => array(
						array( 'title' => __( 'Fors lagere energiekosten', 'voltalux' ), 'text' => __( 'Een warmtepomp is vele malen efficiënter dan een cv-ketel en verlaagt je verbruik direct.', 'voltalux' ) ),
						array( 'title' => __( 'Comfort het hele jaar', 'voltalux' ), 'text' => __( 'Gelijkmatige warmte in de winter en de mogelijkheid om te koelen in de zomer.', 'voltalux' ) ),
						array( 'title' => __( 'Klaar voor de toekomst', 'voltalux' ), 'text' => __( 'Minder afhankelijk van gas en een hoger energielabel voor je woning.', 'voltalux' ) ),
					),
				),
				'faq'     => array(
					array( __( 'Hybride of volledige warmtepomp — wat past bij mij?', 'voltalux' ), __( 'Een hybride warmtepomp werkt samen met je bestaande cv-ketel en is een laagdrempelige eerste stap. Een volledige (all-electric) warmtepomp vervangt de ketel helemaal en is ideaal bij een goed geïsoleerde woning. Tijdens het gratis adviesgesprek bepalen we samen wat het beste past.', 'voltalux' ) ),
					array( __( 'Kom ik in aanmerking voor ISDE-subsidie?', 'voltalux' ), __( 'Voor veel warmtepompen geldt de ISDE-subsidie. Het exacte bedrag hangt af van het type en vermogen. Wij rekenen de subsidie voor je uit en helpen bij de aanvraag.', 'voltalux' ) ),
					array( __( 'Maakt een warmtepomp veel geluid?', 'voltalux' ), __( 'Moderne warmtepompen zijn stil. We plaatsen de buitenunit doordacht en houden rekening met de geluidsnormen, zodat jij en je buren er geen last van hebben.', 'voltalux' ) ),
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
				'h1'      => __( 'Dakrenovatie door een erkend [mark]dakdekkersbedrijf[/mark]', 'voltalux' ),
				'lead'    => __( 'Professionele dakrenovatie door ervaren en erkende dakdekkers, tegen scherpe tarieven. Van een compleet nieuw dak tot reparatie, isolatie en dakkapellen — bespreek de mogelijkheden tijdens een gratis adviesgesprek op locatie.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Erkende, ervaren dakdekkers', 'voltalux' ), 'text' => __( 'Vakmensen in eigen dienst — netjes werk en garantie op de uitvoering.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'Scherpe, eerlijke tarieven', 'voltalux' ), 'text' => __( 'Een heldere offerte zonder verrassingen achteraf.', 'voltalux' ) ),
					array( 'icon' => 'check', 'title' => __( 'Gratis dakinspectie', 'voltalux' ), 'text' => __( 'We beoordelen je dak op locatie en adviseren wat écht nodig is.', 'voltalux' ) ),
				),
				'how'     => array(
					'title' => __( 'Zo pakken wij jouw dak aan', 'voltalux' ),
					'lead'  => __( 'Van inspectie tot oplevering — helder en zonder gedoe.', 'voltalux' ),
					'steps' => array(
						array( 'title' => __( 'Gratis dakinspectie', 'voltalux' ), 'text' => __( 'We komen langs, beoordelen de staat van je dak en luisteren naar je wensen.', 'voltalux' ) ),
						array( 'title' => __( 'Advies en heldere offerte', 'voltalux' ), 'text' => __( 'Je ontvangt een concreet voorstel met materialen, planning en prijs.', 'voltalux' ) ),
						array( 'title' => __( 'Vakkundige uitvoering', 'voltalux' ), 'text' => __( 'Onze dakdekkers voeren het werk netjes en volgens planning uit.', 'voltalux' ) ),
						array( 'title' => __( 'Oplevering en garantie', 'voltalux' ), 'text' => __( 'We leveren het dak schoon op en geven garantie op materiaal en werk.', 'voltalux' ) ),
					),
				),
				'links'   => array(
					'title' => __( 'Onze dakwerkzaamheden', 'voltalux' ),
					'lead'  => __( 'Bekijk per specialisme wat we voor je kunnen betekenen.', 'voltalux' ),
					'items' => array(
						array( 'label' => __( 'Bitumen dak vervangen', 'voltalux' ), 'icon' => 'roof', 'slug' => 'dakdekker/bitumen-dak-vervangen', 'text' => __( 'Nieuwe, waterdichte dakbedekking voor platte daken.', 'voltalux' ) ),
						array( 'label' => __( 'Dakreparatie', 'voltalux' ), 'icon' => 'shield', 'slug' => 'dakdekker/dak-reparatie', 'text' => __( 'Snel en vakkundig lekkages en schade verhelpen.', 'voltalux' ) ),
						array( 'label' => __( 'Dakisolatie', 'voltalux' ), 'icon' => 'leaf', 'slug' => 'dakdekker/dakisolatie', 'text' => __( 'Lagere energiekosten en een comfortabeler huis.', 'voltalux' ) ),
						array( 'label' => __( 'Dakkapel plaatsen', 'voltalux' ), 'icon' => 'home', 'slug' => 'dakdekker/dakkapel-plaatsen', 'text' => __( 'Meer licht en ruimte op je zolder.', 'voltalux' ) ),
						array( 'label' => __( 'Dakpannen vervangen', 'voltalux' ), 'icon' => 'roof', 'slug' => 'dakdekker/dakpannen-vervangen', 'text' => __( 'Een pannendak vernieuwen of herstellen.', 'voltalux' ) ),
						array( 'label' => __( 'Kunststof kozijnen', 'voltalux' ), 'icon' => 'home', 'slug' => 'dakdekker/kunststof-kozijnen', 'text' => __( 'Uitstekende isolatie en een lange levensduur.', 'voltalux' ) ),
					),
				),
				'faq'     => array(
					array( __( 'Wat kost een dakrenovatie?', 'voltalux' ), __( 'De kosten hangen af van het type dak, het oppervlak en de gekozen materialen. Na een gratis dakinspectie ontvang je een heldere offerte op maat, zonder verrassingen achteraf.', 'voltalux' ) ),
					array( __( 'Geven jullie garantie op het werk?', 'voltalux' ), __( 'Ja. Je krijgt garantie op zowel de materialen als de uitvoering. De exacte garantietermijn staat in je offerte.', 'voltalux' ) ),
					array( __( 'Kan ik dakrenovatie combineren met zonnepanelen of isolatie?', 'voltalux' ), __( 'Zeker — dat is juist slim. We stemmen dakwerk, isolatie en zonnepanelen op elkaar af, zodat alles in één keer goed geregeld is.', 'voltalux' ) ),
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
				'lead'    => __( 'Laat je bitumen dak vervangen door Voltalux. Nieuwe, hoogwaardige dakbedekking die jarenlang waterdicht blijft, aangebracht door erkende dakdekkers. Vanaf een scherp tarief per m² — plan een gratis adviesgesprek.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Erkende dakdekkers', 'voltalux' ), 'text' => __( 'Vakkundig aangebracht, met garantie op materiaal en werk.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'Scherp tarief per m²', 'voltalux' ), 'text' => __( 'Een heldere prijs voor nieuwe dakbedekking of complete vervanging.', 'voltalux' ) ),
					array( 'icon' => 'check', 'title' => __( 'Waterdicht en duurzaam', 'voltalux' ), 'text' => __( 'Kwaliteitsbitumen dat bestand is tegen weer en wind.', 'voltalux' ) ),
				),
				'faq'     => array(
					array( __( 'Wat kost een bitumen dak vervangen?', 'voltalux' ), __( 'De prijs hangt af van het oppervlak en of het om nieuwe dakbedekking of een volledige vervanging gaat. Na een gratis inspectie ontvang je een offerte op maat.', 'voltalux' ) ),
					array( __( 'Hoe lang gaat een bitumen dak mee?', 'voltalux' ), __( 'Goed aangebracht bitumen gaat vele jaren mee. Wij gebruiken kwaliteitsmaterialen en geven garantie op de uitvoering.', 'voltalux' ) ),
				),
				'cta'     => array( 'title' => __( 'Bitumen dak laten vervangen?', 'voltalux' ), 'text' => __( 'Vraag een gratis adviesgesprek aan — inclusief inspectie en offerte op maat.', 'voltalux' ) ),
			),
			'dak-reparatie' => array(
				'kind'    => __( 'Dakreparatie', 'voltalux' ),
				'icon'    => 'roof',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Dakreparatie door betrouwbare [mark]dakdekkers[/mark]', 'voltalux' ),
				'lead'    => __( 'Lekkage of schade aan je dak? Laat het snel en vakkundig repareren door Voltalux. Van lekkages tot beschadigde daken en complete renovaties — vraag nu een gratis adviesgesprek aan.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'clock', 'title' => __( 'Snel ter plaatse', 'voltalux' ), 'text' => __( 'Bij lekkage handelen we snel om vervolgschade te voorkomen.', 'voltalux' ) ),
					array( 'icon' => 'shield', 'title' => __( 'Vakkundig hersteld', 'voltalux' ), 'text' => __( 'Erkende dakdekkers verhelpen de oorzaak, niet alleen het symptoom.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'Eerlijke prijs', 'voltalux' ), 'text' => __( 'Een heldere offerte, ook voor spoedreparaties.', 'voltalux' ) ),
				),
				'faq'     => array(
					array( __( 'Kunnen jullie een lekkage snel verhelpen?', 'voltalux' ), __( 'Ja. We komen zo snel mogelijk langs, sporen de oorzaak op en herstellen de lekkage vakkundig om verdere schade te voorkomen.', 'voltalux' ) ),
					array( __( 'Repareren of vervangen — wat is verstandiger?', 'voltalux' ), __( 'Dat beoordelen we tijdens de inspectie. Soms volstaat een reparatie, soms is (gedeeltelijke) vervanging voordeliger op de lange termijn. Je krijgt een eerlijk advies.', 'voltalux' ) ),
				),
				'cta'     => array( 'title' => __( 'Dak laten repareren?', 'voltalux' ), 'text' => __( 'Vraag een gratis adviesgesprek aan — we inspecteren en herstellen vakkundig.', 'voltalux' ) ),
			),
			'dakisolatie' => array(
				'kind'    => __( 'Dakisolatie', 'voltalux' ),
				'icon'    => 'roof',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Dakisolatie voor [mark]lagere energiekosten[/mark]', 'voltalux' ),
				'lead'    => __( 'Kies voor dakisolatie van Voltalux en geniet van lagere energiekosten en een comfortabeler huis. Erkende dakdekkers isoleren je dak vakkundig — plan een gratis adviesgesprek.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'euro', 'title' => __( 'Direct besparen', 'voltalux' ), 'text' => __( 'Minder warmteverlies betekent een lagere energierekening.', 'voltalux' ) ),
					array( 'icon' => 'home', 'title' => __( 'Comfortabeler wonen', 'voltalux' ), 'text' => __( 'Warm in de winter, koeler in de zomer.', 'voltalux' ) ),
					array( 'icon' => 'leaf', 'title' => __( 'Hoger energielabel', 'voltalux' ), 'text' => __( 'Goede isolatie verhoogt de waarde van je woning.', 'voltalux' ) ),
				),
				'faq'     => array(
					array( __( 'Levert dakisolatie echt besparing op?', 'voltalux' ), __( 'Ja. Een groot deel van het warmteverlies gaat via het dak. Goede dakisolatie verlaagt je stookkosten merkbaar en verdient zichzelf terug.', 'voltalux' ) ),
					array( __( 'Kan dakisolatie samen met een dakrenovatie?', 'voltalux' ), __( 'Absoluut. Isolatie combineren met dakwerk of zonnepanelen is efficiënt en kostenbesparend — we stemmen alles op elkaar af.', 'voltalux' ) ),
				),
				'cta'     => array( 'title' => __( 'Je dak laten isoleren?', 'voltalux' ), 'text' => __( 'Vraag een gratis adviesgesprek aan met onze erkende dakdekkers.', 'voltalux' ) ),
			),
			'dakkapel-plaatsen' => array(
				'kind'    => __( 'Dakkapel plaatsen', 'voltalux' ),
				'icon'    => 'roof',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Dakkapel plaatsen — meer [mark]licht en ruimte[/mark]', 'voltalux' ),
				'lead'    => __( 'Kies voor een duurzame dakkapel van Voltalux: meer licht en ruimte in huis, vakkundig geplaatst door ervaren dakdekkers. Plan een gratis adviesgesprek en ontdek de mogelijkheden en afmetingen.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'home', 'title' => __( 'Meer leefruimte', 'voltalux' ), 'text' => __( 'Maak optimaal gebruik van je zolder.', 'voltalux' ) ),
					array( 'icon' => 'shield', 'title' => __( 'Vakkundig geplaatst', 'voltalux' ), 'text' => __( 'Netjes en waterdicht afgewerkt door erkende dakdekkers.', 'voltalux' ) ),
					array( 'icon' => 'leaf', 'title' => __( 'Goed geïsoleerd', 'voltalux' ), 'text' => __( 'Een duurzame dakkapel houdt warmte binnen.', 'voltalux' ) ),
				),
				'faq'     => array(
					array( __( 'Heb ik een vergunning nodig voor een dakkapel?', 'voltalux' ), __( 'Vaak is een dakkapel aan de achterkant vergunningsvrij, maar dit verschilt per gemeente en situatie. We denken met je mee en adviseren over de mogelijkheden.', 'voltalux' ) ),
					array( __( 'Wat kost een dakkapel plaatsen?', 'voltalux' ), __( 'De prijs hangt af van de afmetingen en uitvoering. Na een adviesgesprek ontvang je een offerte op maat.', 'voltalux' ) ),
				),
				'cta'     => array( 'title' => __( 'Dakkapel laten plaatsen?', 'voltalux' ), 'text' => __( 'Plan een gratis adviesgesprek — we bespreken afmetingen, uitvoering en prijs.', 'voltalux' ) ),
			),
			'dakpannen-vervangen' => array(
				'kind'    => __( 'Dakpannen vervangen', 'voltalux' ),
				'icon'    => 'roof',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Dakpannen vervangen door [mark]dakdekkersbedrijf[/mark] Voltalux', 'voltalux' ),
				'lead'    => __( 'Dakpannen laten vervangen of een pannendak vernieuwen? Ontdek de kosten, levensduur en mogelijkheden bij Voltalux. Erkende dakdekkers zorgen voor een strak en waterdicht resultaat — vraag een gratis adviesgesprek aan.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'shield', 'title' => __( 'Strak en waterdicht', 'voltalux' ), 'text' => __( 'Nieuwe pannen vakkundig gelegd, jarenlang zorgeloos.', 'voltalux' ) ),
					array( 'icon' => 'euro', 'title' => __( 'Eerlijke offerte', 'voltalux' ), 'text' => __( 'Heldere prijs voor vervangen of vernieuwen van je pannendak.', 'voltalux' ) ),
					array( 'icon' => 'check', 'title' => __( 'Gratis inspectie', 'voltalux' ), 'text' => __( 'We beoordelen de staat van je pannen en het onderliggende dak.', 'voltalux' ) ),
				),
				'faq'     => array(
					array( __( 'Hoe lang gaan dakpannen mee?', 'voltalux' ), __( 'Kwaliteitspannen gaan tientallen jaren mee. Bij vervanging controleren we ook de panlatten en het onderdak, zodat het geheel weer als nieuw is.', 'voltalux' ) ),
					array( __( 'Alle pannen vervangen of alleen de kapotte?', 'voltalux' ), __( 'Dat hangt af van de staat van het dak. Soms volstaat gedeeltelijk herstel; bij een verouderd dak is volledig vervangen verstandiger. Je krijgt een eerlijk advies.', 'voltalux' ) ),
				),
				'cta'     => array( 'title' => __( 'Dakpannen laten vervangen?', 'voltalux' ), 'text' => __( 'Vraag een gratis adviesgesprek aan met onze dakdekkers.', 'voltalux' ) ),
			),
			'kunststof-kozijnen' => array(
				'kind'    => __( 'Kunststof kozijnen', 'voltalux' ),
				'icon'    => 'home',
				'eyebrow' => __( 'Dakrenovatie', 'voltalux' ),
				'h1'      => __( 'Kunststof kozijnen laten plaatsen — [mark]isolatie[/mark] en stijl', 'voltalux' ),
				'lead'    => __( 'Kunststof kozijnen aanschaffen? Geniet van uitstekende isolatie, een lange levensduur en een stijlvolle uitstraling. Vraag een offerte aan en ontdek de mogelijkheden bij Voltalux.', 'voltalux' ),
				'usps'    => array(
					array( 'icon' => 'leaf', 'title' => __( 'Uitstekende isolatie', 'voltalux' ), 'text' => __( 'Minder warmteverlies en lagere energiekosten.', 'voltalux' ) ),
					array( 'icon' => 'clock', 'title' => __( 'Lange levensduur', 'voltalux' ), 'text' => __( 'Onderhoudsarm en jarenlang mooi.', 'voltalux' ) ),
					array( 'icon' => 'home', 'title' => __( 'Stijlvolle uitstraling', 'voltalux' ), 'text' => __( 'Verkrijgbaar in diverse kleuren en stijlen.', 'voltalux' ) ),
				),
				'faq'     => array(
					array( __( 'Waarom kunststof kozijnen?', 'voltalux' ), __( 'Kunststof kozijnen isoleren uitstekend, zijn onderhoudsarm en gaan lang mee. Ze verlagen je energiekosten en geven je woning een frisse uitstraling.', 'voltalux' ) ),
					array( __( 'Kan ik kozijnen combineren met isolatie of dakwerk?', 'voltalux' ), __( 'Ja. We stemmen kozijnen, isolatie en dakwerk graag op elkaar af voor het beste resultaat en de meeste besparing.', 'voltalux' ) ),
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
