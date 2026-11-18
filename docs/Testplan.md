# Testplan: BE-opdracht 03 - Wijzigen Leverancier

**Project:** Jamin Voorraad- en Leveranciersbeheer  
**Klas:** IO-SD-2509AB  
**Datum:** 05-11-2026  
**Auteur:** KadhimH  

---

## 1. Doel van het testen
Het doel van deze test is verifiëren dat User Story 1 (Wijzigen Leverancier) correct functioneert volgens de twee gespecificeerde scenario's en wireframes.

---

## 2. Testomgeving
- **Framework:** Laravel 11 / PHP 8.3
- **Database:** MySQL met Stored Procedures en PDO
- **Browser:** Google Chrome / Edge
- **URL:** `http://localhost:8000`

---

## 3. Testgevallen (Test Cases)

### Testgeval 01 (Scenario 01: Succesvol wijzigen leverancier Astra Sweets)
- **Preconditie:** Ingelogd als Manager, op homepage (`/dashboard`).
- **Stappen:**
  1. Klik op de link `Wijzigen Leveranciers` op de homepage.
  2. Controleer dat het overzicht getoond wordt (Wireframe-02) met maximaal 4 records per pagina (server-side pagination).
  3. Klik op het pen-icoon bij `Astra Sweets`.
  4. Controleer de gegevens op `Leverancier Details` (Wireframe-03).
  5. Klik op de knop `Wijzig`.
  6. Wijzig `Mobiel` naar `06-39398825`.
  7. Wijzig `Straatnaam` naar `Den Dolderlaan`.
  8. Klik op `Sla Op`.
- **Verwacht resultaat:**
  - Melding verschijnt: *“De wijzigingen zijn doorgevoerd”*.
  - Na 3 seconden wordt automatisch doorgestuurd naar `Leverancier Details` van Astra Sweets.
  - De gewijzigde gegevens (`06-39398825` en `Den Dolderlaan`) zijn zichtbaar.

---

### Testgeval 02 (Scenario 02: Onsuccesvol wijzigen wegens technische storing / duplicaat nummer bij De Bron)
- **Preconditie:** Testgeval 01 is uitgevoerd (nummer `06-39398825` is nu van Astra Sweets).
- **Stappen:**
  1. Ga naar `Wijzigen Leveranciers` op de homepage.
  2. Blader op het overzicht (pagina 2) en klik op het pen-icoon bij `De Bron`.
  3. Klik op de knop `Wijzig`.
  4. Wijzig `Mobiel` naar `06-39398825`.
  5. Klik op `Sla Op`.
- **Verwacht resultaat:**
  - Melding verschijnt: *“Door een technische storing is het niet mogelijk de wijziging door te voeren. Probeer het op een later moment nog eens”*.
  - Na 3 seconden wordt automatisch doorgestuurd naar `Leverancier Details` van De Bron.
  - De gegevens van De Bron zijn ongewijzigd gebleven.

---

### Testgeval 03 (Unit Tests)
- **Test 1:** Controleer dat `Leverancier::contact()` een `BelongsTo` relatie teruggeeft.
- **Test 2:** Controleer dat `Leverancier` de juiste `$fillable` attributen bevat (`Naam`, `ContactPersoon`, `LeverancierNummer`, `Mobiel`, `ContactId`).
