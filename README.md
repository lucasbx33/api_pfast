# Commande pour la base de donnée:
(prérequis: connecter la db dans .env)

Composer install

## Commandes
1) make:migration
2) php bin/console make:migration
3) doctrine:migrations:migrate 
4) php bin/console doctrine:migrations:migrate

lancer le serveur: symfony serve

## routes
routes => api_apiplatform.yaml
Pour le moment j'ai fait les tests principalement sur postman

Routes api:
### Changer le mail => /api/changemail
        Dans headers, set "Content-Type" en application/json et "token" avec le token que vous souhaitez supprimer
        dans body : {"mail": "example@example.fr"}
 
### Supprimer utilisateur: /api/delete
        dans Headers: "token" avec le token que vous souhaitez supprimer

### récupérer parking likés d'un utilisateur: /api/parking
        dans Headers: "token" avec le token de l'utilisateur

### Créer un compte: /api/register
        Dans headers, key "Content-Type" en application/json
        dans body : {"email": "example@example.fr","password": "test"}
        
### SetParkingLike: /api/setparklike
        Dans headers, set "Content-Type" en application/json et set token avec le token
        dans body : {"parking_like": "45"}

### Delete token: /api/deleteToken
        Dans headers, set "Content-Type" en application/json et set token avec le token que vous souhaitez supprimer

### connexion (controle si le mdp est le bon et retourne true ou false) /api/connect
        Dans headers, set "Content-Type" en application/json et set Password en mot de passe 
        dans body : {"email": "example@example.fr"}

### check si un token existe ou non : /api/checkToken
        Dans headers: set token en token à controler