# Testrapport: BE-opdracht 03 - Wijzigen Leverancier

**Project:** Jamin Voorraad- en Leveranciersbeheer  
**Klas:** IO-SD-2509AB  
**Datum:** 05-11-2026  
**Tester:** KadhimH  
**Status:** Alle tests zijn SUCCESVOL (Passed)  

---

## 1. Uitgevoerde Tests en Resultaten

| Testgeval | Omschrijving | Verwacht Resultaat | Daadwerkelijk Resultaat | Status |
| :--- | :--- | :--- | :--- | :---: |
| **TG-01** | Scenario 01: Wijzigen Astra Sweets (Mobiel naar 06-39398825, Straat naar Den Dolderlaan) | Melding: "De wijzigingen zijn doorgevoerd" + redirect na 3 sec naar details Astra Sweets met nieuwe data. | Melding verschijnt exact zoals gevraagd, na 3 sec redirect naar details met bijgewerkte gegevens. | **PASS** |
| **TG-02** | Scenario 02: Wijzigen De Bron met bezet mobielnummer 06-39398825 | Melding: "Door een technische storing is het niet mogelijk de wijziging door te voeren. Probeer het op een later moment nog eens" + redirect na 3 sec naar details De Bron. | Exception opgevangen, melding verschijnt exact, na 3 seconden redirect naar details De Bron zonder dat data is overschreven. | **PASS** |
| **TG-03** | Server-side Pagination | Maximaal 4 records per pagina op Wireframe-02. Pagina 1 toont records 1 t/m 4, pagina 2 toont records 5 en 6. | Server-side paginatie werkt correct via `$leveranciers->links()` met max 4 records per pagina. | **PASS** |
| **TG-04** | Unit Test 1: Relatie Leverancier -> Contact | BelongsTo instantie wordt geretourneerd. | Succesvol geslaagd in Unit test framework. | **PASS** |
| **TG-05** | Unit Test 2: Fillable eigenschappen | Bevat alle velden voor leverancier & contact id. | Succesvol geslaagd in Unit test framework. | **PASS** |

---

## 2. Conclusie
Alle vereiste functionaliteiten, wireframes, scenario's en unit tests functioneren volledig naar behoren volgens de specificaties van BE-opdracht 03.
