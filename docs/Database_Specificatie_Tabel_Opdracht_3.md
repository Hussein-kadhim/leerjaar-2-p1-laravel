# Database Specificatie Tabellen: BE-opdracht 03 - Jamin

**Database:** `Jamin`  
**Datum:** 05-11-2026  
**Auteur:** KadhimH  

---

### 1. Tabel: `Contact` (Stamtabel)
| Veldnaam | Datatype | Lengte | PK / FK | Nullable | Default | Toelichting |
| :--- | :--- | :--- | :---: | :---: | :--- | :--- |
| `Id` | INT UNSIGNED | - | PK | Nee | AUTO_INCREMENT | Unieke identificatie van het contact/adres |
| `Straat` | VARCHAR | 100 | - | Nee | - | Straatnaam van het adres |
| `Huisnummer` | VARCHAR | 20 | - | Nee | - | Huisnummer inclusief toevoeging |
| `Postcode` | VARCHAR | 10 | - | Nee | - | Postcode (bijv. 1045CB) |
| `Stad` | VARCHAR | 100 | - | Nee | - | Plaats / Stad |
| `IsActief` | BIT | 1 | - | Nee | 1 | Systeemveld actief status |
| `Opmerking` | VARCHAR | 250 | - | Ja | NULL | Systeemveld opmerking |
| `DatumAangemaakt` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld aanmaakdatum |
| `DatumGewijzigd` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld wijzigingsdatum |

---

### 2. Tabel: `Leverancier` (Stamtabel / Afhankelijk van Contact)
| Veldnaam | Datatype | Lengte | PK / FK | Nullable | Default | Toelichting |
| :--- | :--- | :--- | :---: | :---: | :--- | :--- |
| `Id` | INT UNSIGNED | - | PK | Nee | AUTO_INCREMENT | Unieke identificatie leverancier |
| `Naam` | VARCHAR | 100 | - | Nee | - | Bedrijfsnaam leverancier |
| `ContactPersoon` | VARCHAR | 100 | - | Nee | - | Contactpersoon binnen bedrijf |
| `LeverancierNummer` | VARCHAR | 20 | - | Nee | - | Leverancier code (bijv. L1029384719) |
| `Mobiel` | VARCHAR | 20 | UNIQUE | Nee | - | Mobiel telefoonnummer |
| `ContactId` | INT UNSIGNED | - | FK | Ja | NULL | Koppeling naar tabel `Contact` |
| `IsActief` | BIT | 1 | - | Nee | 1 | Systeemveld actief status |
| `Opmerking` | VARCHAR | 250 | - | Ja | NULL | Systeemveld opmerking |
| `DatumAangemaakt` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld aanmaakdatum |
| `DatumGewijzigd` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld wijzigingsdatum |

---

### 3. Tabel: `Product` (Stamtabel)
| Veldnaam | Datatype | Lengte | PK / FK | Nullable | Default | Toelichting |
| :--- | :--- | :--- | :---: | :---: | :--- | :--- |
| `Id` | INT UNSIGNED | - | PK | Nee | AUTO_INCREMENT | Unieke identificatie product |
| `Naam` | VARCHAR | 100 | - | Nee | - | Naam van het product |
| `Barcode` | VARCHAR | 20 | - | Nee | - | Unieke barcode |
| `IsActief` | BIT | 1 | - | Nee | 1 | Systeemveld actief status |
| `Opmerking` | VARCHAR | 250 | - | Ja | NULL | Systeemveld opmerking |
| `DatumAangemaakt` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld aanmaakdatum |
| `DatumGewijzigd` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld wijzigingsdatum |

---

### 4. Tabel: `Allergeen` (Stamtabel)
| Veldnaam | Datatype | Lengte | PK / FK | Nullable | Default | Toelichting |
| :--- | :--- | :--- | :---: | :---: | :--- | :--- |
| `Id` | INT UNSIGNED | - | PK | Nee | AUTO_INCREMENT | Unieke identificatie allergeen |
| `Naam` | VARCHAR | 100 | - | Nee | - | Naam allergeen (bijv. Gluten) |
| `Omschrijving` | VARCHAR | 255 | - | Nee | - | Omschrijving allergeen effect |
| `IsActief` | BIT | 1 | - | Nee | 1 | Systeemveld actief status |
| `Opmerking` | VARCHAR | 250 | - | Ja | NULL | Systeemveld opmerking |
| `DatumAangemaakt` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld aanmaakdatum |
| `DatumGewijzigd` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld wijzigingsdatum |

---

### 5. Tabel: `Magazijn` (Afhankelijke tabel van Product)
| Veldnaam | Datatype | Lengte | PK / FK | Nullable | Default | Toelichting |
| :--- | :--- | :--- | :---: | :---: | :--- | :--- |
| `Id` | INT UNSIGNED | - | PK | Nee | AUTO_INCREMENT | Unieke identificatie voorraadrecord |
| `ProductId` | INT UNSIGNED | - | FK | Nee | - | Koppeling naar `Product.Id` |
| `VerpakkingsEenheid`| DECIMAL(4,1) | - | - | Nee | - | Verpakkingseenheid in kg (bijv. 2.5) |
| `AantalAanwezig` | INT | - | - | Ja | NULL | Huidige voorraad (kan NULL zijn) |
| `IsActief` | BIT | 1 | - | Nee | 1 | Systeemveld actief status |
| `Opmerking` | VARCHAR | 250 | - | Ja | NULL | Systeemveld opmerking |
| `DatumAangemaakt` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld aanmaakdatum |
| `DatumGewijzigd` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld wijzigingsdatum |

---

### 6. Tabel: `ProductPerAllergeen` (Koppeltabel)
| Veldnaam | Datatype | Lengte | PK / FK | Nullable | Default | Toelichting |
| :--- | :--- | :--- | :---: | :---: | :--- | :--- |
| `Id` | INT UNSIGNED | - | PK | Nee | AUTO_INCREMENT | Unieke identificatie koppeling |
| `ProductId` | INT UNSIGNED | - | FK | Nee | - | Koppeling naar `Product.Id` |
| `AllergeenId` | INT UNSIGNED | - | FK | Nee | - | Koppeling naar `Allergeen.Id` |
| `IsActief` | BIT | 1 | - | Nee | 1 | Systeemveld actief status |
| `Opmerking` | VARCHAR | 250 | - | Ja | NULL | Systeemveld opmerking |
| `DatumAangemaakt` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld aanmaakdatum |
| `DatumGewijzigd` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld wijzigingsdatum |

---

### 7. Tabel: `ProductPerLeverancier` (Koppeltabel / Levering)
| Veldnaam | Datatype | Lengte | PK / FK | Nullable | Default | Toelichting |
| :--- | :--- | :--- | :---: | :---: | :--- | :--- |
| `Id` | INT UNSIGNED | - | PK | Nee | AUTO_INCREMENT | Unieke identificatie levering |
| `LeverancierId` | INT UNSIGNED | - | FK | Nee | - | Koppeling naar `Leverancier.Id` |
| `ProductId` | INT UNSIGNED | - | FK | Nee | - | Koppeling naar `Product.Id` |
| `DatumLevering` | DATE | - | - | Nee | - | Datum van levering |
| `Aantal` | INT | - | - | Nee | - | Aantal geleverde stuks |
| `DatumEerstVolgendeLevering` | DATE | - | - | Ja | NULL | Verwachte volgende datum |
| `IsActief` | BIT | 1 | - | Nee | 1 | Systeemveld actief status |
| `Opmerking` | VARCHAR | 250 | - | Ja | NULL | Systeemveld opmerking |
| `DatumAangemaakt` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld aanmaakdatum |
| `DatumGewijzigd` | DATETIME(6) | - | - | Nee | CURRENT_TIMESTAMP(6) | Systeemveld wijzigingsdatum |
