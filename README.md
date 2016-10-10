**VideoBundle**
-----------
Ce bundle est composé de plusieurs parties:

 - un dossier de commande pour l'ajout d'une video en BDD depuis la console.
 - un dossier de DataFixutres pour insérer des données prédéfinies en BDD.
 - une API pour la récupération des videos
 - un dossier de test

1 - Installation
----------------

1 .Mise en place

Pour faire fonctionner ce bundle, Il faut une base MySQL disponible.
Il faut ensuite récupérer les dépendances manquantes avec un composer update

2 .Création de la BDD

Ce bundle a besoin d'une BDD pour fonctionner, il faut penser à modifier les informations de connexion dans le fichier app/config/parameters.yml
Il faut ensuite créer la base: php bin/console doctrine:database:create, puis créer les tables: `php bin/console doctrine:schema:update`

3 .Utilisation

Le projet est prêt à être utilisé: `php bin/console server:start`


2 - Ligne de commande: Ajout d'une video en BDD
-----------------------------------------------

Une commande a été ajoutée à la liste des commandes disponible dans php bin/console.
Cette commande permet d'ajouter une vidéo en BDD.
exemple d'utilisation:  `video:create nomRealisateur titre 20170112`

3 - API: Récupération des vidéos
--------------------------------

Une API est disponible sur /api/video et /api/video/{id}
exemple d'appel sur /api/video:  
```
 curl -X GET -H "Accept:application/json" http://127.0.0.1:8000/api/videos
```

exemple de retour:

```
 {"videos":[{"id":1,"title":"Thewire","realisator":"DavidSimon","date":"2015-01-01T00:00:00+0100"}],"count":1}
```

4 - Tests
---------

Les tests unitaires supposent que la BDD utilise le jeu de données des fixtures.
Pour insérer les fixtures il faut jouer la commande suivante: `php bin/console doctrine:fixtures:load`

Ensuite pour jouer les tests il faut lancer `vendor/bin/phpunit` 
