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
### Changer le mail => /api/users/{id}/mail
        Dans headers, set "Content-Type" en application/json
        dans body : {"mail": "lucas.reynaud@epsi.fr"}
 
### Supprimer utilisateur: /api/users/delete/{id}

### récupérer mail: /api/users/{id}/mail

### récupérer parking likés d'un utilisateur: /api/users/{id}/parking

### récupérer id à partir d'un token => /api/users/gettoken
        Dans headers mettre le type api_key: key:"authorization"  value:{token}

### Créer un compte: /api/register
        Dans headers, key "Content-Type" en application/json
        dans body : {"email": "test@test.fr","password": "test"}
        
### SetParkingLike: /api/setparklike/{id}
        Dans headers, set "Content-Type" en application/json
        dans body : {"parking_like": "45"}

### setToken: /api/setToken/{id}
        Dans headers, set "Content-Type" en application/json
