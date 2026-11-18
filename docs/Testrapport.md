# Testrapport: Opdracht 3 - Wijzigen Leverancier

* **Naam:** KadhimH  
* **Klas:** IO-SD-2509AB  
* **Datum:** 18-11-2026  
* **Resultaat:** Alles werkt goed  

---

## 1. Wat heb ik getest?
Ik heb getest of het wijzigen van een leverancier goed werkt in de website. Ik heb de 2 scenario's getest, de knoppen, de paginanummers en de 2 unit tests.

---

## 2. Testresultaten

| Test | Wat heb ik gedaan? | Wat moest er gebeuren? | Wat gebeurde er? | Resultaat |
| :---: | :--- | :--- | :--- | :---: |
| **1** | **Astra Sweets wijzigen (Scenario 1)**<br>Ik heb het mobiele nummer veranderd naar `06-39398825` en de straat naar `Den Dolderlaan`. Daarna op Opslaan geklikt. | Er moet een groene melding komen: *"De wijzigingen zijn doorgevoerd"*. Na 3 seconden ga je terug naar het detailscherm met de nieuwe gegevens. | De groene balk kwam direct in beeld. Na 3 seconden ging hij vanzelf terug en stonden het nieuwe nummer en de straat er netjes in. | **Goed** |
| **2** | **De Bron wijzigen met dubbel nummer (Scenario 2)**<br>Ik heb bij De Bron hetzelfde mobiele nummer ingevuld als Astra Sweets (`06-39398825`) en op Opslaan geklikt. | Er moet een rode foutmelding komen dat er een storing is. Na 3 seconden ga je terug en zijn de gegevens niet veranderd. | De rode melding kwam in beeld. Na 3 seconden ging hij terug en waren de oude gegevens van De Bron nog hetzelfde. | **Goed** |
| **3** | **Paginering (maximaal 4 leveranciers)**<br>Ik heb gekeken naar de tabel met leveranciers. | Er mogen maximaal 4 leveranciers op 1 pagina staan. | Op pagina 1 staan 4 leveranciers. Op pagina 2 staan de andere 2. De knoppen `< 1 2 >` werken goed. | **Goed** |
| **4** | **Knoppen testen**<br>Ik heb op het potloodje ✏️, de terug-knop en de home-knop geklikt. | Het potloodje moet naar details gaan, terug moet teruggaan en home moet naar het dashboard gaan. | Alle knoppen werken goed en sturen je naar de juiste pagina. | **Goed** |
| **5** | **Unit tests**<br>Ik heb de 2 unit tests gedraaid in de terminal met pest/phpunit. | De 2 tests moeten slagen zonder fouten. | Beide tests geven groen en zijn geslaagd. | **Goed** |

---

## 3. Conclusie
Alles werkt zoals gevraagd in de opdracht:
* Scenario 1 en Scenario 2 werken zonder fouten.
* Na het opslaan wacht het scherm 3 seconden en stuurt je door.
* Er staan maximaal 4 leveranciers per pagina.
* De database en alle knoppen werken goed.
