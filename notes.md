### Modelles, migrations, controllers

Pour permettre à l'utilisateur de poster des commentaires, on aura besoin d'un(e) :

>modèle : qui nous fournit un moyen simple d'interagir avec la BDD
>migration : qui nous permet de facilement créer et modifier les tabes de notre BDD
>controller : responsable de traiter les requêtes et de renvoyer les réponses


##  php artisan make:model Chirp -mcr
Le code ci-dessous permet de créer un model, une migration, un controller, et une ressource.

## php artisan route:list
Avoir la liste de toutes mes routes

## Route::resource("chirps", ChirpController::class);
Permet à laravel de nous créer nos routes, sans faire un require.

## Middleware
C'est une fonctionnalité permettant de filtrer les requêtes HTTP, effectuées dans l'application. 
Ce sont des couches intermédiaires qui peuvent être ajoutée au pipeline de traitement des requêtes 
http pour effectuer des tâches spécifiques avant que la requête n'atteignent la route appropriée
ou même après que la réponse ait été générée par le controller
C'est un programme qui se met au milieu entre la requête et la vue. 

## php artisan make:middleware echoMiddleware
Ce code permet de créer un middleware nommé echoMiddleware

## composer require laravel/breeze --dev
Insère dans le projet laravel la capacité d'installer breeze

## php artisan breeze:install
et on choisit 'blade'

## php artisan migrate
permet la création de la base de donnée

## php artisan make:component alert 
Permet de créer un composant sous forme de classe

## php artisan make:component alert --view
Permet de créer un component, mais cette fois-ci dans app\View\Components on a rien

## npm run dev
Pour gérer la partie front du projet

## php artisan lang:publish
Notifie à Laravel qu'on veut utiliser d'autres langues

## php artisan make:migration add_user_id_and_message_to_chirps
Exactement ce que tu dis la ligne, ajout les colonnes user_id et message à la table chirps

## php artisan migrate:rollback

## php artisan make:policy ChirpPolicy --model=Chirp

Permet de créer une Policie nommée ChirpPolicy en rapport  avec le model Chirp

## Il existe deux types de composants
Les composants sous forme de classe et ceux anonymes.
 # Les composants sous forme de classe 
 Sont les plus versatiles et robustes. Ils peuvent prendre des paramètres
 # Les composants anonymes 
 Sont les plus simples ne prenant aucun paramètre

 ## Route: fonction d'aide Laravel
 `route()` : fonction qui génère l'URL correspondant à une route nommée
 `__()` : fonction qui renvoie la traduction pour une chaîne de caractère donnée
 `action()`: fonction génère l'URL correspondant à l'action méthode d'un controlleur donné
 `url()` : fonction qui génère l'URL complet (http://.../url)

 `session()` : fonction qui récupère les données de session 
 `setLocale()` : fonction qui change la langue de l'application

 `auth()->user()`: permet de récupérer l'utilisateur connecté

 ## La Masse assignation
 La mass assignation est une technique qui permet de définir plusieurs attributs d'un media en une seule fois. 
 Par exemple, imaginez que vous avez un modèle  `Utlilsateur` avec des champs tels que `nom`, `email`, et `rôle` . 
 La mass assignation permet de définir tous ces champs en une fois, ce qui peut être très pratique et vous faire 
 gagner du temps.

 Cependant, si elle n'est pas gérée avec précaution, la mass assignationn peut entrainer  une vulnérabilité de 
 sécurité appelée "over-posting" ou "vulnérabilité de mass assignation".


## Les étapes de création d'une notification
1. créer une notification (sms, email, slack...)
2. créer un évènement
3. Dispatcher un évènement
4. Créer un Event listener
5. Lier l'Event Listener à l'évènement

## php artisan make:notification NewChirp 
Ce code permet de créer une notification

## php artisan make:event ChirpCreatedEvent
Permet de créer un évènement par rapport au notification

## php artisan make:listener SendChirpCreatedNotification --event=ChirpCreatedEvent
Permet de faire appel à l'écouteur, qui permet d'écouteur et d'envoyer la notification
Dans le code de création il faut notifier l'évènement que l'écouteur doit écouter