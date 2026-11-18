# Testrapport: BE-opdracht 03 - Wijzigen Leverancier

**Project:** Jamin Voorraad- en Leveranciersbeheer  
**Klas:** IO-SD-2509AB  
**Tester / Auteur:** KadhimH  
**Datum:** 18-11-2026  
**Status:** Geslaagd (Voldoende)  

---

## 1. Inleiding
In dit testrapport zijn de resultaten vastgelegd van de tests die zijn uitgevoerd voor **BE-opdracht 03: Wijzigen Leverancier** (User Story 1, Scenario 01 en Scenario 02). De tests zijn uitgevoerd aan de hand van het opgestelde [Testplan](file:///c:/project-2025/leerjaar-2-p1-backend/leerjaar-2-p1-backend/docs/Testplan.md).

---

## 2. Testomgeving
* **Besturingssysteem:** Windows 10 / 11
* **Webserver / PHP:** PHP 8.4.21 / Laravel 11 MVC
* **Database:** MySQL met Stored Procedures (`spGetLeveranciersOverzichtPaginated`, `spGetLeverancierDetailsById`, `spWijzigLeverancier`) en PDO
* **Browser:** Google Chrome / Microsoft Edge
* **Test URL:** `http://127.0.0.1:8000`

---

## 3. Testresultaten per Testgeval

| Test ID | Testomschrijving | Verwacht Resultaat | Werkelijk Resultaat | Status |
| :---: | :--- | :--- | :--- | :---: |
| **TG-01** | **Scenario 01: Wijzigen Astra Sweets**<br>Mobiel wijzigen naar `06-39398825` en Straatnaam naar `Den Dolderlaan`. | Groene melding: *"De wijzigingen zijn doorgevoerd"*. Na 3 seconden automatische redirect naar Wireframe-03 met bijgewerkte gegevens. | Groene succesmelding verschijnt direct. Na 3 seconden doorgestuurd naar `details`. Nieuwe gegevens zijn zichtbaar. | **GESLAAGD** |
| **TG-02** | **Scenario 02: Duplicaat nummer bij De Bron**<br>Mobiel van De Bron wijzigen naar reeds bestaand nummer `06-39398825`. | Rode melding: *"Door een technische storing is het niet mogelijk de wijziging door te voeren. Probeer het op een later moment nog eens"*. Na 3 seconden redirect naar Wireframe-03 zonder wijzigingen. | Rode storingsmelding getoond. Na 3 seconden doorgestuurd naar `details`. Gegevens van De Bron zijn ongewijzigd gebleven. | **GESLAAGD** |
| **TG-03** | **Paginering Overzicht Leveranciers**<br>Controleren dat maximaal 4 records per pagina worden getoond (Wireframe-02). | Maximaal 4 leveranciers op pagina 1 (Venco, Astra Sweets, Haribo, Basset) en de overige 2 op pagina 2. | Server-side paginering toont netjes 4 rijen op pagina 1 en 2 rijen op pagina 2. | **GESLAAGD** |
| **TG-04** | **Navigatie en Wireframe-knoppen**<br>Testen van de knoppen `home`, `terug` en het pen-icoon ✏️. | Klik op pen opent Wireframe-03. `terug` gaat naar vorige scherm. `home` gaat direct naar het dashboard. | Alle knoppen werken soepel en leiden naar de juiste routes volgens de handgetekende wireframes. | **GESLAAGD** |
| **TG-05** | **Unit Tests**<br>Uitvoeren van de 2 unit tests voor de class methods/relaties in `tests/Unit/WijzigLeverancierTest.php`. | 2 tests slagen zonder fouten (`Leverancier::contact()` relatie en fillable attributen). | Beide tests slagen met 2 assertions (`OK (2 tests, 2 assertions)`). | **GESLAAGD** |

---

## 4. Conclusie
Alle testgevallen uit het testplan zijn succesvol doorlopen. De applicatie voldoet aan alle functionele en technische eisen van **BE-opdracht 03**:
1. Scenario 01 en Scenario 02 werken inclusief de 3-seconden automatische redirects en foutafhandeling.
2. De database stored procedures en tabellen (inclusief `Contact` en systeemvelden) functioneren correct via het MVC-patroon.
3. Server-side paginering werkt met maximaal 4 records per pagina.
4. Alle schermen sluiten visueel en functioneel aan op de wireframes.
