# TESTPLAN: BE-opdracht 03 - Wijzigen Leverancier

* **Naam student:** KadhimH  
* **Klas:** IO-SD-2509AB  
* **Opdracht:** BE-opdracht 03  
* **Datum:** 19-11-2026  
* **Versie:** 1.0  

---

## 1. Wat is het doel van dit testplan?
Het doel van dit testplan is om van tevoren precies op te schrijven wat we gaan testen voor **Opdracht 3 (Wijzigen Leverancier)**. 
We willen zeker weten dat:
1. De schermen er precies zo uitzien als op de 4 tekeningen (wireframes).
2. Een leverancier succesvol gewijzigd kan worden (Scenario 1).
3. Het systeem een foutmelding geeft als een telefoonnummer al door een ander bedrijf wordt gebruikt (Scenario 2).
4. Het systeem 3 seconden wacht na het opslaan en dan vanzelf teruggaat naar de detailpagina.
5. De tabel netjes maximaal 4 leveranciers per pagina laat zien (paginering).
6. De 2 unit tests zonder fouten slagen.

---

## 2. Wat hebben we nodig om te testen? (Testomgeving)
* **Computer:** Windows laptop / computer
* **Programma's:** WampServer (met PHP 8.4 en MySQL database)
* **Framework:** Laravel 11 (MVC)
* **Browser:** Google Chrome of Microsoft Edge
* **Adres in browser:** `http://127.0.0.1:8000`
* **Inloggen als:** Manager

---

## 3. Wat gaan we wel en niet testen?
* **Wel testen:**
  * Het dashboard met de link naar Wijzigen Leveranciers (Wireframe-01).
  * Het overzicht met maximaal 4 rijen per pagina en het potloodje (Wireframe-02).
  * Het detailscherm met alle 8 gegevens (Wireframe-03).
  * Het wijzigingsformulier en de knop Sla Op (Wireframe-04).
  * Scenario 1: Astra Sweets wijzigen met succesmelding en 3 seconden wachten.
  * Scenario 2: De Bron wijzigen met een bezet nummer en de foutmelding.
  * De knoppen `terug` en `home`.
  * De 2 unit tests voor het model.
* **Niet testen:**
  * Andere rollen buiten de Manager.
  * Externe koppelingen.

---

## 4. De Testgevallen (Stap voor stap)

### Testgeval 1: Link op het dashboard (Wireframe-01)
* **Voorwaarde:** Je bent ingelogd als Manager op `http://127.0.0.1:8000/dashboard`.
* **Stappen:**
  1. Kijk naar het scherm van het dashboard.
  2. Zoek de link `Wijzigen Leveranciers`.
  3. Klik op de link.
* **Verwacht resultaat:**
  * De tekst `Wijzigen Leveranciers` is onderstreept te zien.
  * Als je erop klikt, opent het scherm `Overzicht Leveranciers`.

---

### Testgeval 2: Overzicht leveranciers en paginering (Wireframe-02)
* **Voorwaarde:** Je bent op de pagina `http://127.0.0.1:8000/leverancier/wijzigen`.
* **Stappen:**
  1. Tel hoeveel leveranciers er in de tabel staan.
  2. Kijk of er in de laatste kolom een potlood-icoon ✏️ staat.
  3. Klik onder de tabel op pagina `2`.
  4. Kijk of de knop `home` rechtsonder staat.
* **Verwacht resultaat:**
  * Op pagina 1 staan precies 4 leveranciers (Venco, Astra Sweets, Haribo, Basset).
  * Op pagina 2 staan de overige leveranciers (De Bron, Quality Street).
  * Bij elke leverancier staat een potloodje om de details te openen.
  * Rechtsonder staat een duidelijke knop `home`.

---

### Testgeval 3: Details bekijken (Wireframe-03)
* **Voorwaarde:** Je bent op het overzicht (pagina 1).
* **Stappen:**
  1. Klik op het potloodje ✏️ achter `Astra Sweets`.
  2. Bekijk de tabel met gegevens.
  3. Kijk naar de knoppen onder de tabel.
* **Verwacht resultaat:**
  * Er staat een tabel met 8 rijen:
    1. Naam: Astra Sweets
    2. Contactpersoon: Jasper del Monte
    3. Leveranciernummer: L1029284315
    4. Mobiel: 06-39398734
    5. Straatnaam: Willem de Zwijgerlaan
    6. Huisnummer: 32
    7. Postcode: 2582ES
    8. Stad: Den Haag
  * Linksonder staat de knop `Wijzig`.
  * Rechtsonder staan de knoppen `terug` en `home`.

---

### Testgeval 4: Scenario 1 - Succesvol wijzigen Astra Sweets (Wireframe-04)
* **Voorwaarde:** Je bent op het detailscherm van Astra Sweets.
* **Stappen:**
  1. Klik op de knop `Wijzig`.
  2. Verander het veld `Mobiel` naar: `06-39398825`.
  3. Verander het veld `Straatnaam` naar: `Den Dolderlaan`.
  4. Klik op de knop `Sla Op`.
* **Verwacht resultaat:**
  * Er verschijnt direct een groene melding: *"De wijzigingen zijn doorgevoerd"*.
  * Het systeem wacht 3 seconden.
  * Na 3 seconden word je vanzelf teruggestuurd naar het detailscherm (Wireframe-03).
  * Op het detailscherm staat nu het nieuwe nummer (`06-39398825`) en de nieuwe straat (`Den Dolderlaan`).

---

### Testgeval 5: Scenario 2 - Foutmelding bij dubbel nummer (Wireframe-04)
* **Voorwaarde:** Testgeval 4 is al uitgevoerd (Astra Sweets heeft nu nummer `06-39398825`).
* **Stappen:**
  1. Ga via het overzicht naar pagina 2.
  2. Klik op het potloodje ✏️ bij leverancier `De Bron`.
  3. Klik op de knop `Wijzig`.
  4. Verander het mobiele nummer naar: `06-39398825` (hetzelfde nummer als Astra Sweets).
  5. Klik op de knop `Sla Op`.
* **Verwacht resultaat:**
  * Er verschijnt direct een rode foutmelding: *"Door een technische storing is het niet mogelijk de wijziging door te voeren. Probeer het op een later moment nog eens"*.
  * Het systeem wacht 3 seconden.
  * Na 3 seconden word je automatisch teruggestuurd naar het detailscherm van De Bron.
  * De gegevens van De Bron zijn NIET gewijzigd (het oude nummer staat er nog).

---

### Testgeval 6: Navigatieknoppen testen (terug en home)
* **Voorwaarde:** Je opent verschillende schermen van de applicatie.
* **Stappen:**
  1. Klik op een willekeurige pagina op de knop `terug`.
  2. Klik op een willekeurige pagina op de knop `home`.
* **Verwacht resultaat:**
  * De knop `terug` brengt je altijd netjes 1 stap terug naar de vorige pagina.
  * De knop `home` brengt je altijd meteen terug naar het dashboard.

---

### Testgeval 7: Unit tests controleren
* **Voorwaarde:** Terminal / PowerShell geopend in de projectmap.
* **Stappen:**
  1. Voer de unit tests uit met het commando voor PHPUnit / Pest.
* **Verwacht resultaat:**
  * Test 1 (controleert of het model Leverancier gekoppeld is aan Contact) slaagt.
  * Test 2 (controleert of de velden van Leverancier ingevuld mogen worden) slaagt.
  * Beide tests geven een groene melding zonder fouten.

---

## 5. Overzichtstabel van het Testplan

| Test Nr. | Wat wordt er getest? | Welke data voeren we in? | Wat verwachten we? |
| :---: | :--- | :--- | :--- |
| **1** | Dashboard link (Wireframe-01) | Klik op `Wijzigen Leveranciers` | Opent het overzicht van leveranciers |
| **2** | Maximaal 4 records (Wireframe-02) | Bladeren tussen pagina 1 en 2 | Pagina 1 heeft 4 rijen, pagina 2 heeft 2 rijen |
| **3** | Detailscherm (Wireframe-03) | Klik op potloodje van Astra Sweets | Toont alle 8 gegevens met Wijzig-knop |
| **4** | Scenario 1: Wijzigen Astra Sweets | Mobiel: `06-39398825`<br>Straat: `Den Dolderlaan` | Groene melding, 3 sec wachten, gegevens opgeslagen |
| **5** | Scenario 2: Dubbel nummer De Bron | Mobiel: `06-39398825` (al bezet) | Rode foutmelding, 3 sec wachten, niets veranderd |
| **6** | Navigatieknoppen | Klikken op `terug` en `home` | Brengt je naar vorig scherm of naar het dashboard |
| **7** | 2 Unit tests | Starten van de tests in terminal | 2 tests slagen met 2 assertions (groen) |
