# kalitics

# Projet Pointage Symfony 4 

Ce projet est basé sur le framework Symfony 4 et contient les fonctionnalités suivantes :

- Créer une Base de donnée et les entités : Utilisateurs, Chantiers, Pointages
- Réaliser un CRUD pour les entités ainsi que les routes vers les pages
- Soumettre le formulaire Pointages avec des restrictions : La création de « pointages » sera soumise à une validation 
spécifique des données. Les validations de formulaire à mettre en place sont les suivantes :
  I. Un utilisateur ne peut pas être pointé deux fois le même jour sur le même chantier.
  II. La somme des durées des pointages d’un utilisateur pour une semaine ne pourra pas dépasser 35 heures.
  III. Les messages d’erreur du formulaire seront affichés sur ce même formulaire au fur et à mesure de la
  saisie des données, dès qu’une contrainte sera atteinte. ( utilisation de requête Ajax et d'action coté client JS)
- Utilisation du thème Darkly de bootswatch : https://bootswatch.com/darkly/
- Requête Ajax envoi de donné vers le controller et recuperation des "response".
## Configuration requise

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP 7.2 ou une version supérieure
- Composer
- MySQL ou un autre système de gestion de base de données

## Installation

Suivez les étapes ci-dessous pour installer et exécuter le projet Symfony 4 :

1. Clonez ce référentiel sur votre machine :

```
git clone https://github.com/ismail-bouasria/kalitics.git
```

2. Accédez au répertoire du projet :

```
cd demo
```

3. Installez les dépendances du projet à l'aide de Composer :

```
composer install
```

4. Configurer le fichier de configuration d'environnement `.env`pour votre configuration locale.

5. Créez la base de données :

```
php bin/console doctrine:database:create
```

6. Appliquez les migrations pour créer le schéma de la base de données :

```
php bin/console doctrine:migrations:migrate
```

7. Démarrez le serveur de développement :

```
php bin/console server:start
```

8. Accédez à l'application dans votre navigateur à l'adresse suivante :

```
http://localhost:8000
```

## Auteurs

- Bouasria Ismaïl
---

