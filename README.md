# Projet Jeux vidéos réalisé par :
Abdoulaye Traoe & Nour Hannafi


# SymfonyProject

*******************Ce projet fonctionne avec docker************************* 

Pour pouvoir faire tourner ce projet en local, vous devez donc avoir installer docker sous votre machine et avooir composer qui fonctionne bien.

Avoir installé Symfony n'est pas vraiment obligatoir, après avoir clone le projet, executez les commandes suivantes pour pouvoir tester l'application.

1 - docker-compose down (pour arreter tous les containers en cours d'execution, si vous travaillez déjà avec docker)

2 - docker-compose up --build (pour installer toutes les dépendances et avoir un environnement de travail propre)

3 - docker-compose exec web php bin/console doctrine:migration:migrate (pour créer toutes les tables qu'il faut dans la base de données, ou faire la mise à jour de base pour ceux qui travaillent déjà sur un tel projet)

4 - (optionnel) docker-compose exec web php bin/console doctrine:fixtures:load (pour générer des fake données afin de pouvoir tester l'application)

------->>>>>> L'application est lancé sur le port 8010 



*************IMPORTANT *****************

Pour les utilisateurs de Window : 

Si vous avez installé Symfony exe, Exécutez d'abord cette commande: server:start -d 

Le projet est lancé sur le port 8080 ou 8000



******************* F A Q *****************

Si vous rencontrez des problèmes pour installer ou lancer ce projet, veuillez me contacter. Merci

Cordialement, 


