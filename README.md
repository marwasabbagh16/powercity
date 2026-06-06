# PowerCity — Global Energy Store 🔌

Site web vitrine professionnel pour l'entreprise **PowerCity**, spécialisée dans la distribution de solutions électriques et industrielles au Maroc.

🌐 **Site déployé** : https://powercity-production.up.railway.app

---

## 📋 Présentation du projet

Ce projet a été réalisé dans le cadre d'un **Projet de Fin d'Études (PFE)** pour l'obtention de la Licence Sciences et Techniques en Systèmes d'Information et Transformation Digitale (LST/SITD) à la **Faculté des Sciences et Techniques de Settat — Université Hassan 1er**.

**Réalisé par** : Marwa Sabbagh  
**Encadrant académique** : Pr. El Mostafa MAKROUM  
**Année universitaire** : 2025–2026

---

## ⚙️ Stack technique

| Technologie | Version | Rôle |
|---|---|---|
| Laravel | 12 | Framework PHP (MVC) |
| PHP | 8.2 | Langage serveur |
| MySQL | 9.4 | Base de données |
| Tailwind CSS | 3 | Design responsive |
| Alpine.js | 3 | Interactivité frontend |
| Laravel Breeze | — | Authentification sécurisée |
| Railway | — | Déploiement en production |

---

## ✨ Fonctionnalités

### Partie publique (Visiteurs)
- 📦 Catalogue de produits organisé par catégories (UPS, PDU, ATS, Câbles, Disjoncteurs...)
- 🔍 Recherche avancée par nom de produit ou catégorie
- 📄 Fiche technique détaillée avec datasheet téléchargeable pour chaque produit
- 📝 Formulaire de demande de devis en ligne
- 📞 Page Contact avec coordonnées complètes
- ℹ️ Page À propos de l'entreprise

### Panneau d'administration (Admin)
- 📊 Tableau de bord avec statistiques générales
- ➕ Gestion complète des produits (CRUD)
- 🗂️ Gestion des catégories
- 📋 Traitement des demandes de devis (Pending / Approved / Rejected)
- 👥 Liste des clients

---

## 🚀 Installation locale

### Prérequis
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL (via XAMPP ou autre)

### Étapes

```bash
# 1. Cloner le dépôt
git clone https://github.com/marwasabbagh16/powercity.git
cd powercity

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JavaScript
npm install

# 4. Copier le fichier d'environnement
cp .env.example .env

# 5. Générer la clé d'application
php artisan key:generate

# 6. Configurer la base de données dans .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=powercity
DB_USERNAME=root
DB_PASSWORD=

# 7. Exécuter les migrations
php artisan migrate

# 8. Compiler les assets
npm run dev

# 9. Lancer le serveur
php artisan serve
```

Le site sera accessible sur : http://localhost:8000

---

## 🗂️ Structure du projet

powercity/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   ├── ProductController.php
│   │   ├── DevisController.php
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── ProductController.php
│   │       └── DevisController.php
│   └── Models/
│       ├── Product.php
│       ├── Category.php
│       ├── Devis.php
│       └── User.php
├── resources/views/
│   ├── layouts/
│   ├── produits/
│   ├── admin/
│   └── contact.blade.php
├── routes/
│   └── web.php
└── database/migrations/

---

## 🔐 Accès administration

L'accès au panneau d'administration se fait via l'URL **/login** avec les identifiants fournis par l'administrateur.

---

## 📸 Aperçu

![Page d'accueil PowerCity](https://powercity-production.up.railway.app)

---

## 📄 Licence

Projet académique — FST Settat, Université Hassan 1er — 2025/2026
