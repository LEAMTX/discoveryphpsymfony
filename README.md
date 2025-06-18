## 🌐Découverte Symfony

Ce dépôt contient un projet Symfony utilisé pour expérimenter et comprendre les bases du framework PHP Symfony.

---

## 🌐Installation

Assurez-vous d'avoir PHP 8.2, Composer et Symfony CLI installés.

Installez les dépendances avec :

```bash
composer install
```

---

## 🌐Base de données

Créez la base de données et appliquez les migrations générées avec Doctrine :

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

---

## 🌐Lancement du serveur de développement

Utilisez le serveur local de Symfony :

```bash
symfony server:start
```
---

## 📌 Symfony CLI vs `php bin/console`

Symfony propose deux façons d’utiliser des commandes dans un projet :

### 📌 `symfony` (outil global)

C’est un programme que tu installes sur ton ordinateur une fois pour toutes. Il sert à :

- Démarrer un serveur local pour tester ton site (`symfony serve`)
- Vérifier si ton projet est bien configuré
- Lancer Composer avec les bonnes options Symfony

💡 On utilise `symfony` pour **travailler autour du projet**.

### 📌️ `php bin/console` (outil interne au projet)

C’est un fichier fourni dans **ton projet Symfony**, que tu utilises pour :

- Générer du code (entités, formulaires, contrôleurs…)
- Mettre à jour la base de données
- Nettoyer le cache
- Lancer des commandes Symfony personnalisées

💡 On utilise `php bin/console` pour **agir sur le cœur du projet**.

Voir toutes les commandes disponibles :

```bash
php bin/console list
```

---

## 🌐Workflow de développement typique

Pour ajouter de nouvelles fonctionnalités, les commandes `make:` suivantes sont très utiles :

```bash
php bin/console make:entity
php bin/console make:form
php bin/console make:crud
php bin/console make:migration
```

Ces commandes permettent de créer rapidement des entités, des formulaires, des contrôleurs CRUD, et des fichiers de migration pour la base de données.

---

## 💡 Ce que j'ai expérimenté

- Génération d'un CRUD complet avec `make:crud` pour l'entité `Product`.
- Définition des routes avec les **attributs PHP 8** dans `ProductController`.
- Création d'une entité Doctrine très simple contenant un champ `title`.
- Utilisation des **formulaires Symfony** et de l'**injection de dépendances**.
- Intégration de **Twig** pour l'affichage des vues.
- Création et exécution d'une **migration Doctrine** avec PostgreSQL.

---

##🌐Sécurité `.env`

Les fichiers `.env`, `.env.dev`, `.env.test` ont été supprimés du suivi Git pour protéger les données sensibles.

Ils sont désormais ignorés grâce au fichier `.gitignore`.

Créez votre fichier local de configuration à partir du modèle :

```bash
cp .env.example .env
```

---

## 🌐Exemple de fichier `.env.example`

```dotenv
APP_ENV=dev
APP_SECRET=your_app_secret
DATABASE_URL="postgresql://user:password@localhost:5432/your_db"
MAILER_DSN=null://null
```

---

## 🌐Liens utiles

- [Documentation officielle Symfony (FR)](https://symfony.com/doc/current/index.html)
- [Symfony CLI](https://symfony.com/download)
- [Doctrine ORM](https://www.doctrine-project.org/)
- [Twig](https://twig.symfony.com/)
- [Symfony MakerBundle](https://symfony.com/bundles/SymfonyMakerBundle/current/index.html)

---

## Licence

Projet personnel à but pédagogique.  
