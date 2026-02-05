# Budget Buddy 💰

**Budget Buddy** is een gebruiksvriendelijke webapplicatie die jongeren helpt om hun financiën beter te beheren. De applicatie maakt het mogelijk om inkomsten en uitgaven te registreren, te categoriseren en te analyseren, zodat gebruikers inzicht krijgen in hun financiële situatie en beter geïnformeerde beslissingen kunnen nemen.

## 📌 Projectbeschrijving

Veel jongeren vinden het lastig om overzicht te houden over hun geld. Budget Buddy biedt hiervoor een oplossing door een centraal platform aan te bieden waar financiële gegevens eenvoudig kunnen worden bijgehouden. Op basis van deze gegevens kan de applicatie rapportages genereren en advies geven over het uitgavenpatroon.

Het doel van de applicatie is om financiële bewustwording te vergroten en gebruikers te helpen schulden te voorkomen.

## 🚀 Belangrijkste Functionaliteiten

* Gebruikers kunnen hun persoonlijke gegevens invoeren en beheren
* Inkomsten en uitgaven registreren
* Transacties indelen in aanpasbare categorieën
* Budgetten koppelen aan transacties
* Overzichtelijke rapporten bekijken van inkomsten en uitgaven
* Grafieken en diagrammen voor financiële inzichten
* Gegevens filteren en sorteren
* CRUD-functionaliteit voor gebruikers, categorieën, budgetten en transacties

## 🧱 Technische Implementatie

De applicatie is ontwikkeld met een gestructureerde backend en maakt gebruik van moderne developmenttechnieken.

**Belangrijke technologieën:**

* PHP met het **Symfony framework**
* Doctrine ORM voor databasebeheer
* Twig voor het renderen van views
* Chart.js voor datavisualisatie
* MySQL / relationele database
* HTML, CSS en JavaScript

## 🗄️ Datamodel

De kern van de applicatie bestaat uit meerdere entiteiten met onderlinge relaties:

* **User** – beheert gebruikersinformatie
* **Transaction** – slaat inkomsten en uitgaven op
* **Category** – groepeert transacties (bijv. huur, salaris, abonnementen)
* **Budget** – helpt bij het bewaken van financiële limieten
* **Contact** – verwerkt contactaanvragen

Door middel van *Many-to-One* relaties kan één gebruiker meerdere transacties hebben en worden transacties gekoppeld aan zowel een categorie als een budget.

## ⚙️ Werkwijze

Tijdens de ontwikkeling is gewerkt volgens de **Scrum-methodiek**. Het project werd opgedeeld in sprints waarbij taken werden gepland, uitgevoerd en geëvalueerd. Dit zorgde voor een iteratief ontwikkelproces met continue verbeteringen.

## 🎯 Doel van het Project

Budget Buddy is ontworpen om:

* financiële inzichten te verbeteren
* verantwoord geldbeheer te stimuleren
* gebruikers te ondersteunen bij het plannen van hun uitgaven
* een duidelijke en intuïtieve gebruikerservaring te bieden

## 📊 Toekomstige Verbeteringen

Mogelijke uitbreidingen van de applicatie zijn:

* Registratie- en inlogsysteem
* Downloadbare financiële overzichten
* Geavanceerde filters en zoekfunctionaliteit
* Administrator dashboard
* Automatische detectie van risicovol uitgavenpatroon

---

✨ **Budget Buddy helpt gebruikers controle te krijgen over hun geld — want goed financieel inzicht begint met overzicht.**
