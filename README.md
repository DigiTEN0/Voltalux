# Voltalux — WordPress thema (Elementor-compatibel)

Een custom, high-end WordPress-thema voor **Voltalux** — duurzame energie, thuisbatterijen en
zonnepanelen. Zwart/felgroen designsysteem, video-hero, ronde cards en pill-knoppen, geïnspireerd op
Domogo, Zonneplan en Saman Groep. Volledig te uploaden via **Weergave → Thema's → Nieuw toevoegen →
Thema uploaden** en bedoeld om samen met **Elementor** te gebruiken.

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

- **Kleuren:** zwart `#0B0C0E`, Voltalux-groen `#16E06A`, wolk-grijs `#F4F5F3` (CSS-variabelen; de
  groene accentkleur is met één klik te wijzigen in de Customizer).
- **Typografie:** **Sora** (koppen) + **Inter** (tekst) — **self-hosted** (GDPR/AVG-veilig, geen
  Google-CDN-verzoeken). Deze fonts worden ook in Elementor's font-kiezer en globale stijlen gezet.
- **Signatuur-elementen:** pill-knoppen met ↗-pijl, de groene *highlight-marker* op keywords
  (gebruik `[mark]woord[/mark]` in tekst), ronde cards, USP-rijen, video-hero, zwevende CTA-balk.
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
├─ template-parts/home/   (hero, statement, usps, products, feature, testimonial, articles, cta)
├─ inc/                   (customizer, elementor, template-tags, template-functions)
├─ assets/css/            (theme.css, editor.css)
├─ assets/js/             (theme.js, customize-preview.js)
├─ assets/fonts/          (self-hosted Sora + Inter, fonts.css)
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
GPL-2.0-or-later. Sora & Inter: SIL Open Font License 1.1.
