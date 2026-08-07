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
						'type'    => 'accordion',
						'id'      => 'glas',
						'nav'     => __( 'Glas-glas of glas-folie', 'voltalux' ),
						'eyebrow' => __( 'Soorten panelen', 'voltalux' ),
						'title'   => __( 'Wat is het verschil tussen glas-glas en glas-folie panelen?', 'voltalux' ),
						'lead'    => __( 'Wanneer je kiest voor zonnepanelen, kun je kiezen uit twee soorten: glas-glas of glas-folie panelen. Om de keuze makkelijker te maken, hebben we ze naast elkaar gezet.', 'voltalux' ),
						'items'   => array(
							array( __( 'Verschil in opbouw', 'voltalux' ), __( 'Glas-glas panelen hebben zowel aan de boven- als onderkant glas, waardoor ze aan beide zijden beschermd zijn. Glas-folie panelen hebben aan één kant glas en aan de andere kant een dunne kunststof folie waarop de zonnecellen zijn aangebracht.', 'voltalux' ) ),
							array( __( 'Verschil in duurzaamheid en levensduur', 'voltalux' ), __( 'Glas-glas panelen staan bekend om hun hoge duurzaamheid en lange levensduur; het glas beschermt de cellen tegen weersomstandigheden en degradatie. Glas-folie panelen zijn ook duurzaam, maar hebben doorgaans een kortere levensduur doordat de folie gevoeliger is voor UV-straling en vocht.', 'voltalux' ) ),
							array( __( 'Verschil in efficiëntie', 'voltalux' ), __( 'Glas-glas panelen hebben vaak een hogere efficiëntie en presteren beter bij hoge temperaturen. Glas-folie panelen zijn efficiënt, maar iets minder bestand tegen hoge temperaturen.', 'voltalux' ) ),
						),
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
						'type'  => 'text',
						'alt'   => true,
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
						'type'  => 'text',
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
