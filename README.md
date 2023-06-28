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
### Changer le mail => /api/changemail/{id}
        Dans headers, set "Content-Type" en application/json
        dans body : {"mail": "example@example.fr"}
 
### Supprimer utilisateur: /api/delete/{id}

### récupérer mail: /api/{id}/mail

### récupérer parking likés d'un utilisateur: /api/parking/{id}

### récupérer id à partir d'un token => /api/getIdToken
        Dans headers mettre le type api_key: key:"authorization"  value:{token}

### récupérer id à partir d'un mail => /api/getIdMail
        Dans headers, set "Content-Type" en application/json
        dans body : {"mail": "example@example.fr"}

### Créer un compte: /api/register
        Dans headers, key "Content-Type" en application/json
        dans body : {"email": "example@example.fr","password": "test"}
        
### SetParkingLike: /api/setparklike/{id}
        Dans headers, set "Content-Type" en application/json
        dans body : {"parking_like": "45"}

### setToken: /api/setToken/{id}
        Dans headers, set "Content-Type" en application/json

### connexion (controle si le mdp est le bon et retourne true ou false) /api/connect
        Dans headers, set "Content-Type" en application/json et set Password en mot de passe 
        dans body : {"email": "example@example.fr"}