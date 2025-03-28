# Application de Gestion d'Événements et de Réservations

## Objectif du Projet

Créer une application web complète permettant aux utilisateurs de consulter, réserver, modifier et annuler leur participation à différents événements. L'application inclura un système d'authentification, une gestion des profils utilisateurs et une interface responsive adaptée aux appareils mobiles.

## Structure de la Base de Données "EVENEMENTS"

### Tables Principales :
- **UTILISATEUR** (Id_Utilisateur, Email, Mot_de_passe, Nom, Prénom, Photo_profil, Date_inscription, Role)
- 
- **EVENEMENT** (Id_Evenement, Nom, Description, Date, Heure, Lieu, Capacité_Max, Image, Catégorie, Créé_par)
- 
- **RESERVATION** (Id_Reservation, Id_Evenement#, Id_Utilisateur#, Nombre_Personnes, Date_Reservation, Statut)
- 
- **CATEGORIE** (Id_Catégorie, Nom, Description)

> Les clefs étrangères sont indiquées par un astérisque (#).

## Partie 1 : Configuration et Mise en Place

### 1.1 Import de la Base de Données

Importez le fichier SQL nommé **"evenements.sql"** dans votre base de données locale. Ce fichier contient :
- La structure des tables mentionnées ci-dessus
- Des données de test pour commencer à travailler
- Des utilisateurs prédéfinis avec différents rôles

**Consignes techniques :**
- Utilisez phpMyAdmin via MAMP pour l'importation
- Vérifiez que toutes les contraintes d'intégrité référentielle sont correctement créées

### 1.2 Structure des Fichiers

Créez une architecture MVC simplifiée avec la structure suivante :

```
/config
  - database.php (connexion à la base de données)
  - config.php (variables globales)
/assets
  - css/ (vos fichiers CSS)
  - js/ (vos fichiers JavaScript)
  - img/ (images du site)
  - uploads/ (images téléversées par les utilisateurs)
/includes
  - header.php
  - footer.php
  - functions.php (fonctions réutilisables)
  - auth.php (fonctions d'authentification)
/pages
  - index.php (page d'accueil)
  - login.php
  - register.php
  - profile.php
  - events.php (liste des événements)
  - event-details.php (détails d'un événement)
  - reservation.php
  - my-reservations.php
  - admin/ (section administration)
```

## Partie 2 : Authentification et Gestion des Utilisateurs

### 2.1 Inscription (register.php)

Créez un formulaire d'inscription contenant :
- Email (unique dans la base de données)
- Mot de passe (avec confirmation)
- Nom
- Prénom
- Photo de profil (optionnelle)

**Consignes techniques :**
- Validez tous les champs côté client (JavaScript) ET côté serveur (PHP)
- Affichez les messages d'erreur sous chaque champ concerné
- Hashez les mots de passe avec `password_hash()`
- Gérez le téléversement de la photo de profil avec vérification du type et de la taille
- Créez une image de profil par défaut pour les utilisateurs sans photo

### 2.2 Connexion (login.php)

Créez un formulaire de connexion avec :
- Email
- Mot de passe
- Option "Se souvenir de moi"

**Consignes techniques :**
- Vérifiez les identifiants avec `password_verify()`
- Utilisez les sessions PHP pour maintenir l'authentification
- Implémentez la fonctionnalité "Se souvenir de moi" avec des cookies sécurisés
- Redirigez vers la page précédente après connexion

### 2.3 Profil Utilisateur (profile.php)

Créez une page de profil permettant à l'utilisateur de :
- Voir et modifier ses informations personnelles
- Changer sa photo de profil
- Modifier son mot de passe
- Voir l'historique de ses réservations

**Consignes techniques :**
- Séparez les différents formulaires (informations, mot de passe, photo)
- Validez l'ancien mot de passe avant d'autoriser un changement
- Implémentez un système de recadrage d'image simple pour la photo de profil

## Partie 3 : Gestion des Événements

### 3.1 Liste des Événements (events.php)

Créez une page affichant tous les événements disponibles avec :
- Image de l'événement
- Nom
- Date et heure
- Lieu
- Capacité maximale
- Nombre de places restantes
- Catégorie

**Consignes techniques :**
- Affichez les événements sous forme de cartes (cards) avec un design moderne
- Implémentez une pagination (10 événements par page)
- Ajoutez un indicateur visuel pour les événements presque complets (moins de 20% de places)
- Utilisez des requêtes préparées pour toutes les interactions avec la base de données

### 3.2 Filtrage et Recherche

Ajoutez des options de filtrage et de recherche :
- Barre de recherche par nom d'événement
- Filtrage par catégorie
- Filtrage par date (aujourd'hui, cette semaine, ce mois)
- Tri par date, popularité ou places disponibles

**Consignes techniques :**
- Implémentez la recherche en AJAX pour une expérience utilisateur fluide
- Conservez les paramètres de filtrage dans l'URL pour permettre le partage
- Optimisez les requêtes SQL pour de bonnes performances

### 3.3 Détails de l'Événement (event-details.php)

Créez une page détaillée pour chaque événement avec :
- Toutes les informations de l'événement
- Une grande image
- Description complète
- Indicateur de places disponibles
- Bouton de réservation

**Consignes techniques :**
- Utilisez des paramètres GET sécurisés pour identifier l'événement
- Prévenez les injections SQL avec des requêtes préparées
- Implémentez un design responsive adapté aux mobiles

## Partie 4 : Système de Réservation

### 4.1 Création de Réservation (reservation.php)

Créez un formulaire de réservation permettant à l'utilisateur de :
- Sélectionner le nombre de personnes (dans la limite des places disponibles)
- Voir le récapitulatif avant confirmation

**Consignes techniques :**
- Vérifiez en temps réel la disponibilité des places
- Affichez les erreurs sous les champs concernés
- Empêchez la soumission multiple du formulaire
- Conservez les valeurs en cas d'erreur
- Redirigez vers la page de confirmation après succès

### 4.2 Gestion des Réservations (my-reservations.php)

Créez une page permettant à l'utilisateur de :
- Voir toutes ses réservations (actuelles et passées)
- Modifier le nombre de personnes d'une réservation existante
- Annuler une réservation

**Consignes techniques :**
- Affichez les réservations dans un tableau avec tri par date
- Implémentez des confirmations avant suppression
- Vérifiez les autorisations (un utilisateur ne peut modifier que ses propres réservations)
- Ajoutez des indicateurs visuels pour les réservations passées/futures

### 4.3 Modification de Réservation

Pour la modification d'une réservation :
- Affichez un formulaire pré-rempli avec les informations actuelles
- Permettez de modifier uniquement le nombre de personnes
- Vérifiez la disponibilité des places

**Consignes techniques :**
- Validez que le nouveau nombre de personnes est valide
- Affichez les erreurs sous le champ concerné
- Conservez les valeurs en cas d'erreur
- Utilisez AJAX pour vérifier la disponibilité en temps réel

## Partie 5 : Administration

### 5.1 Tableau de Bord Admin (admin/index.php)

Créez un tableau de bord administrateur avec :
- Résumé des statistiques (nombre d'utilisateurs, événements, réservations)
- Graphiques de fréquentation
- Liste des derniers utilisateurs inscrits
- Liste des événements à venir

**Consignes techniques :**
- Restreignez l'accès aux utilisateurs avec le rôle "admin"
- Utilisez des requêtes SQL optimisées pour les statistiques
- Implémentez des graphiques simples avec Chart.js

### 5.2 Gestion des Événements (admin/events.php)

Créez une interface permettant aux administrateurs de :
- Voir tous les événements
- Ajouter un nouvel événement
- Modifier un événement existant
- Supprimer un événement

**Consignes techniques :**
- Implémentez un formulaire complet pour la création/modification
- Gérez le téléversement d'images
- Validez tous les champs
- Affichez les erreurs sous les champs concernés

### 5.3 Gestion des Utilisateurs (admin/users.php)

Créez une interface permettant aux administrateurs de :
- Voir tous les utilisateurs
- Modifier les informations d'un utilisateur
- Changer le rôle d'un utilisateur
- Désactiver/réactiver un compte

**Consignes techniques :**
- Implémentez une recherche d'utilisateurs
- Sécurisez les opérations sensibles
- Empêchez la suppression du compte super-admin

## Partie 6 : Sécurité et Optimisation

### 6.1 Sécurité

Assurez-vous d'implémenter les mesures de sécurité suivantes :
- Protection contre les injections SQL (requêtes préparées)
- Protection contre les attaques XSS (filtrage des entrées/sorties)
- Protection contre les attaques CSRF (jetons)
- Validation des données côté client et serveur
- Hashage sécurisé des mots de passe
- Gestion sécurisée des sessions

### 6.2 Responsive Design

Assurez-vous que l'application est utilisable sur tous les appareils :
- Design adapté aux mobiles, tablettes et ordinateurs
- Navigation simplifiée sur mobile
- Images optimisées pour différentes tailles d'écran

### 6.3 Performances

Optimisez les performances de l'application :
- Minimisez le nombre de requêtes SQL
- Utilisez des index sur les colonnes fréquemment recherchées
- Mettez en cache les données lorsque c'est possible
- Optimisez les images et ressources

## Rendu Final

Votre application doit être :
- Fonctionnelle et sans bugs majeurs
- Sécurisée contre les attaques courantes
- Responsive et esthétique
- Bien commentée et structurée
- Accompagnée d'une documentation d'installation

## Barème d'Évaluation

- **Structure et organisation du code (20%)** :séparation des responsabilités
- **Fonctionnalités (40%)** : Implémentation complète des fonctionnalités demandées
- **Sécurité (15%)** : Protection contre les attaques courantes
- **Interface utilisateur (15%)** : Design, ergonomie, responsive
- **Optimisation et performances (10%)** : Temps de chargement, optimisation des requêtes

## Conseils pour Réussir

- Commencez par mettre en place la structure de base et l'authentification
- Implémentez les fonctionnalités une par une en testant régulièrement
- Utilisez Git pour versionner votre code
- Testez votre application sur différents appareils
- Documentez votre code au fur et à mesure
