# Database Specificatie Tabellen: BE-opdracht 03 - Jamin

**Database:** `Jamin`  
**Datum:** 18-11-2026  
**Auteur:** KadhimH  

---

### 1. Tabel: `Contact` (Adres)
| Kolom naam | Datatype | Lengte | Nullable | Opmerking |
| :--- | :--- | :--- | :--- | :--- |
| Id | INT | | No | PK |
| Straatnaam | Varchar | 50 | No | |
| Huisnummer | INT | | No | |
| Postcode | Varchar | 10 | No | |
| Plaats | Varchar | 50 | No | (Stad) |
| IsActief | Bit | 1 | No | Systeemveld (Default 1) |
| Opmerking | Varchar | 250 | Yes | Systeemveld |
| DatumAangemaakt | DateTime | 6 | No | Systeemveld |
| DatumGewijzigd | DateTime | 6 | No | Systeemveld |

---

### 2. Tabel: `Leverancier`
| Kolom naam | Datatype | Lengte | Nullable | Opmerking |
| :--- | :--- | :--- | :--- | :--- |
| Id | INT | | No | PK |
| ContactId | INT | | Yes | FK(Contact) |
| Naam | Varchar | 50 | No | |
| ContactPersoon | Varchar | 50 | No | |
| LeverancierNummer | Varchar | 20 | No | |
| Mobiel | Varchar | 20 | No | UNIQUE |
| IsActief | Bit | 1 | No | Systeemveld (Default 1) |
| Opmerking | Varchar | 250 | Yes | Systeemveld |
| DatumAangemaakt | DateTime | 6 | No | Systeemveld |
| DatumGewijzigd | DateTime | 6 | No | Systeemveld |

---

### 3. Tabel: `Product`
| Kolom naam | Datatype | Lengte | Nullable | Opmerking |
| :--- | :--- | :--- | :--- | :--- |
| Id | INT | | No | PK |
| Naam | Varchar | 50 | No | |
| Barcode | Varchar | 20 | No | |
| IsActief | Bit | 1 | No | Systeemveld (Default 1) |
| Opmerking | Varchar | 250 | Yes | Systeemveld |
| DatumAangemaakt | DateTime | 6 | No | Systeemveld |
| DatumGewijzigd | DateTime | 6 | No | Systeemveld |

---

### 4. Tabel: `Allergeen`
| Kolom naam | Datatype | Lengte | Nullable | Opmerking |
| :--- | :--- | :--- | :--- | :--- |
| Id | INT | | No | PK |
| Naam | Varchar | 50 | No | |
| Omschrijving | Varchar | 255 | No | |
| IsActief | Bit | 1 | No | Systeemveld (Default 1) |
| Opmerking | Varchar | 250 | Yes | Systeemveld |
| DatumAangemaakt | DateTime | 6 | No | Systeemveld |
| DatumGewijzigd | DateTime | 6 | No | Systeemveld |

---

### 5. Tabel: `Magazijn`
| Kolom naam | Datatype | Lengte | Nullable | Opmerking |
| :--- | :--- | :--- | :--- | :--- |
| Id | INT | | No | PK |
| ProductId | INT | | No | FK(Product) |
| VerpakkingsEenheid | Decimal | 4,1 | No | Verpakkingseenheid in kg |
| AantalAanwezig | INT | | Yes | NULL als er geen voorraad is |
| IsActief | Bit | 1 | No | Systeemveld (Default 1) |
| Opmerking | Varchar | 250 | Yes | Systeemveld |
| DatumAangemaakt | DateTime | 6 | No | Systeemveld |
| DatumGewijzigd | DateTime | 6 | No | Systeemveld |

---

### 6. Tabel: `ProductPerAllergeen`
| Kolom naam | Datatype | Lengte | Nullable | Opmerking |
| :--- | :--- | :--- | :--- | :--- |
| Id | INT | | No | PK |
| ProductId | INT | | No | FK(Product) |
| AllergeenId | INT | | No | FK(Allergeen) |
| IsActief | Bit | 1 | No | Systeemveld (Default 1) |
| Opmerking | Varchar | 250 | Yes | Systeemveld |
| DatumAangemaakt | DateTime | 6 | No | Systeemveld |
| DatumGewijzigd | DateTime | 6 | No | Systeemveld |

---

### 7. Tabel: `ProductPerLeverancier`
| Kolom naam | Datatype | Lengte | Nullable | Opmerking |
| :--- | :--- | :--- | :--- | :--- |
| Id | INT | | No | PK |
| LeverancierId | INT | | No | FK(Leverancier) |
| ProductId | INT | | No | FK(Product) |
| DatumLevering | Date | | No | |
| Aantal | INT | | No | |
| DatumEerstVolgendeLevering | Date | | Yes | NULL als er geen datum bekend is |
| IsActief | Bit | 1 | No | Systeemveld (Default 1) |
| Opmerking | Varchar | 250 | Yes | Systeemveld |
| DatumAangemaakt | DateTime | 6 | No | Systeemveld |
| DatumGewijzigd | DateTime | 6 | No | Systeemveld |
