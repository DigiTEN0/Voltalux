# Voltalux — WordPress thema (Elementor-compatibel)

Een custom, high-end WordPress-thema voor **Voltalux** — duurzame energie, thuisbatterijen en
zonnepanelen. Een **eigen "precision energy"-designtaal** (niet gekopieerd van bestaande sites):
verfijnde typografie met Space Grotesk + Space Mono, video-hero met spec-balk, een **mega-menu met
productvoorbeelden**, een **full-screen mobiel menu** waarin je de producten ziet, genummerde
werkwijze-stappen, een live-energie dashboardmock en een stats-balk. Volledig te uploaden via
**Weergave → Thema's → Nieuw toevoegen → Thema uploaden** en gebouwd om met **Elementor** te werken.

> Alle teksten, afbeeldingen en het logo voeg je zelf toe via de WordPress media-uploader en Elementor.
> Het thema levert de complete look-and-feel, de header/footer, een kant-en-klare homepage én een
> importeerbaar Elementor-template.

---

## 1. Snelstart (5 minuten)

1. **Thema uploaden**
   Download `voltalux.zip` (zie [§ De ZIP bouwen](#de-zip-bouwen) of gebruik de meegeleverde zip).
   Ga in WordPress naar **Weergave → Thema's → Nieuw toevoegen → Thema uploaden**, kies `voltalux.zip`,
   klik **Nu installeren** en daarna **Activeren**.

2. **Elementor installeren**
   Ga naar **Plugins → Nieuwe plugin → zoek "Elementor"** → installeer & activeer.
   De gratis versie is voldoende. (Elementor **Pro** is optioneel — dan kun je ook de header/footer
   met de Theme Builder overnemen.)

3. **Klaar.** De homepage ziet er direct top-notch uit met de video-hero en de "Onze batterijen"-sectie.
   Het Voltalux-logo en de bannervideo staan al ingesteld (zie hieronder hoe je ze wijzigt).

---

## 2. Het logo & de bannervideo wijzigen

Beide staan **hardcoded als standaard** ingesteld, maar zijn zonder code te wijzigen:

| Onderdeel | Waar aanpassen |
|-----------|----------------|
| **Logo** | **Weergave → Aanpassen → Site-identiteit → Logo** (of **Voltalux thema → Merk & kleuren → Logo-URL**) |
| **Hero-video** | **Weergave → Aanpassen → Voltalux thema → Homepage hero → Achtergrond-video (MP4 URL)** |
| **Hero-titel/tekst/knoppen** | **Weergave → Aanpassen → Voltalux thema → Homepage hero** |
| **Accentkleur (groen)** | **Weergave → Aanpassen → Voltalux thema → Merk & kleuren** |
| **Telefoon, footer, socials** | **Weergave → Aanpassen → Voltalux thema → Header/Footer** |

De standaardwaarden (het huidige Voltalux-logo en de bannervideo) staan in
`voltalux/functions.php` als de constanten `VOLTALUX_DEFAULT_LOGO` en `VOLTALUX_DEFAULT_HERO_VIDEO`.

---

## 3. De homepage in Elementor bewerken

Er zijn twee manieren om de homepage te beheren — kies er één:

### A) Gecodeerde homepage (standaard, aanbevolen om snel live te gaan)
Werkt direct, wordt gevoed door de Customizer (§2). Niets te doen.

### B) Homepage volledig in Elementor bewerken (jouw wens: hero-video/logo via "Edit with Elementor")
1. Ga naar **Elementor → Templates → Geïmporteerde templates → Template importeren**
   (of **Sjablonen → Importeren**).
2. Kies het bestand **`voltalux/elementor/voltalux-homepage-template.json`**.
3. Maak een nieuwe **Pagina** (bijv. "Home"), open **Bewerken met Elementor**, klik op het
   map-icoon (**Templates toevoegen**) → tab **Mijn templates** → **Voltalux — Homepage** → **Insert**.
4. Ga naar **Instellingen → Lezen → Homepagina toont → een statische pagina → "Home"**.
5. Nu bewerk je álles — inclusief de **hero-video** (klik de hero-sectie → tabblad *Stijl* →
   *Achtergrond → Video*) en losse teksten — direct in Elementor.

> Zodra de homepage een Elementor-pagina is, stapt de gecodeerde homepage automatisch opzij.
> De header (met logo) en footer blijven door het thema geleverd en on-brand.

### Landingspagina's bouwen
Maak een pagina aan en kies bij **Pagina-attributen → Template → "Volledige breedte (Elementor)"**
voor een edge-to-edge canvas met de thema-header en -footer.

---

## 4. Menu's instellen

**Weergave → Menu's** → maak een menu en wijs een locatie toe:

- **Hoofdmenu** — de bovenbalk (met dropdowns tot 2 niveaus)
- **Footermenu** — kolom in de footer
- **Juridisch** — kleine links onderin de footer (privacy, voorwaarden, cookies)

De footer heeft daarnaast 4 **widget-kolommen** via **Weergave → Widgets** (Footer kolom 1–4).

---

## 5. Wat zit erin — merk & techniek

- **Kleuren:** zwart `#0A0B0D`, Voltalux-groen `#15DD6E`, warm papier `#F5F5F1` (CSS-variabelen; de
  groene accentkleur is met één klik te wijzigen in de Customizer).
- **Typografie:** **Space Grotesk** (koppen) + **Inter** (tekst) + **Space Mono** (technische labels)
  — allemaal **self-hosted** (GDPR/AVG-veilig, geen Google-CDN). Ook gezet in Elementor's font-kiezer
  en globale stijlen.
- **Signatuur-elementen:** mono-eyebrows met hairline, pill-knoppen met ↗-pijl, groene keyword-accenten
  (gebruik `[mark]woord[/mark]`), mega-menu met diensten, full-screen mobiel menu, genummerde werkwijze,
  professionele SVG-iconen en -sterren. Alle CSS-klassen zijn `vlx-`-geprefixt om botsingen te voorkomen.
- **Conversie:** een **slide-in offerteformulier** dat opent vanuit elke "Offerte aanvragen"-knop, een
  **belknop** die automatisch belt, en een zwevende bel + CTA-balk. Het formulier (velden: naam, e-mail,
  telefoon, dienst, postcode, huisnummer, omschrijving) is te vervangen door een Contact Form 7- /
  Elementor- / WPForms-shortcode via **Aanpassen → Voltalux thema → Offerteformulier**.
- **Echte content:** de vier diensten (Zonnepanelen · Thuisbatterij · Airco's · Dakrenovaties), telefoon
  085-0600106, adres in Waalwijk, KvK, reviews, projecten en socials staan al ingevuld — allemaal
  aanpasbaar via de Customizer of de `voltalux_*`-filters.
- **Elementor-integratie:** globale kleuren & fonts worden geseed, full-width/canvas werkt,
  header/footer-locaties zijn geregistreerd voor Elementor Pro.
- **Compleet & valide:** header, footer, homepage, pagina, blog, archief, zoekresultaten, 404,
  reacties, zijbalk, full-width template, vertaalklaar (text-domain `voltalux`).
- **Toegankelijk & snel:** skip-link, toetsenbordnavigatie, `prefers-reduced-motion`, lazy-loading,
  video pauzeert buiten beeld.

### Mapstructuur
```
voltalux/
├─ style.css              (thema-header + design tokens + basis)
├─ functions.php          (setup, enqueues, hardcoded defaults, Elementor-support)
├─ header.php / footer.php
├─ front-page.php         (gecodeerde homepage met Elementor-uitwijk)
├─ page.php single.php archive.php search.php 404.php index.php
├─ comments.php searchform.php sidebar.php
├─ page-templates/full-width.php
├─ template-parts/home/   (hero, services, waarom, welkom, steps, reviews, projecten, offerte)
├─ inc/                   (customizer, elementor, template-tags, template-functions)
├─ assets/css/            (theme.css, editor.css)
├─ assets/js/             (theme.js, customize-preview.js)
├─ assets/fonts/          (self-hosted Space Grotesk + Inter + Space Mono, fonts.css)
├─ assets/images/         (placeholder-illustraties)
├─ elementor/voltalux-homepage-template.json   (importeerbaar)
└─ screenshot.png
```

---

## De ZIP bouwen

De ZIP die je in WordPress uploadt, moet de map `voltalux/` als bovenste niveau bevatten:

```bash
./build.sh          # maakt dist/voltalux.zip
```

Of handmatig:
```bash
zip -r voltalux.zip voltalux -x '*.DS_Store'
```

---

## Licentie
GPL-2.0-or-later. Space Grotesk, Inter & Space Mono: SIL Open Font License 1.1.
