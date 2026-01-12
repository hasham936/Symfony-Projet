# Site de vente de maillots de football

Projet Symfony – Développement Web

## Description du projet

FootShop est un site e-commerce développé avec **Symfony**, dédié à la vente de maillots de football.
Le site intègre un système d'authentification complet, une gestion utilisateur, un CRUD, ainsi que plusieurs pages légales et informatives.

Ce projet a été réalisé dans le cadre d’un exercice visant à mettre en pratique les fonctionnalités essentielles d’un site web moderne utilisant Symfony.

---

## Fonctionnalités

### Authentification & gestion utilisateur

* Création de compte
* Connexion / Déconnexion
* Mot de passe oublié
* "Se souvenir de moi"
* Page de profil utilisateur

  * Affichage du profil
  * Modification des informations
  * Suppression du compte

---

### Pages principales

* Page d’accueil
* Menu de navigation
* Mentions légales
* CGU
* CGV (si nécessaire)
* Politique de confidentialité
* Page “Qui sommes-nous ?”
* Formulaire de contact

---

### E-commerce / CRUD

Un CRUD complet pour la gestion des **maillots de football** :

* Ajouter un maillot
* Modifier un maillot
* Supprimer un maillot
* Lister les maillots

Ce CRUD peut être accessible depuis un espace administrateur ou une route sécurisée.

---

## Technologies utilisées

* **Symfony**
* **Twig** pour les templates
* **Doctrine ORM** pour la gestion de la base de données
* **Symfony Security** pour l'authentification
* **Tailwind** pour le design
* **MySQL** pour la base de données

---

## 📂 Structure générale du projet

```
/src
/templates
/public
/config
/migrations
```

---
