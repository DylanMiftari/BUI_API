# BUI API

Projet de l'API pour le jeu BUI. 
Les règles du jeu sont explquées [ici](https://docs.google.com/document/d/1nl1KZPCFFpGdEwYrgEcouZAcP8OMyjygHfcXTnvW_3M/edit?tab=t.0).

Ce projet est fait avec le frameword [Laravel 12](https://laravel.com/)

Si vous utilisez l'API pour faire une application, prenez bien en compte qu'elle utilise la timezone UTC pour les dates et heures.

---

## ⚙️ Installation

```bash
# 1. Cloner le projet
git clone https://github.com/DylanMiftari/BUI_API.git
cd BUI_API

# 2. Installer les dépendances
composer install

# 3. Copier le fichier d'environnement
cp .env.example .env

# 4. Générer la clé de l'application
php artisan key:generate

# 5. Configurer .env (base de données, etc.)

# 6. Lancer les migrations
php artisan migrate

# 7. Lancer les seeders
php php artisan db:seed --class=[className]
# remplacer [className] par chaque fichier de dossier database/seeders, (il faudra exéctuer la commande pour chaque fichier)

# 8. (Optionnel) Installer Laravel Sanctum
php artisan vendor:publish --tag=sanctum-config

# 9. Lancer le serveur
php artisan serve
```

## 📁 Structure principale  
```
app/  
  ├── Exceptions/      → Exceptions personnalisées
  ├── Http/
  │   ├── Actions/     → Classes Actions
  │   ├── Controllers/ → Contrôleurs API
  │   ├── Resources/   → Ressources de l'API
  │   ├── Requests/    → Validations des requêtes
  │   └── Middleware/  → Middleware personnalisés
  ├── Models/          → Modèles Eloquent
  ├── Policies/        → Gestion des permissions
  ├── Services/        → Classe de Services
  ├── Helpers/         → Helpers personnalisés
routes/
  ├── api.php          → Routes générique de l'API
  └── ...              → Autres routes séparées dans d'autres fichiers
documentation/
   ├── ficher markdown comprenant la documentation de chaque route. Les routes sont réparties en plusieurs fichiers.
```
Chaque dossier de l'architecture doivent eux-mêmes être séparés en différents sous-dossiers pour mieux s'y retrouver. Exemple : Actions/Users, Requests/Users, Controllers/Company.

## 🧠 Explication des éléments de l'architecture

- __Exceptions__ : Contient les excéptions personnalisées, qu'il est possible de lancer.
- __Actions__ : Chaque fichier contient une classe métier réalisant une action spécifique (exemple : Créer une entreprise, Faire une demande prêt à la banque...). Chaque classe action contient une seule méthode nommée `handle`, ces classes peuvent être injectée dans les méthodes des controllers.
- __Controllers__ : Reçoivent les requêtes HTTP, vérifient les données, apellent les services et actions adaptés et renvoie une réponse. Ils ne doivent contenir aucune logique métier.
- __Resources__ : Elles transformes et formatent proprement les modèles retourner par l'API (exemple : cacher des champs sensibles).
- __Requests__ : Contient uniquement la validation des données.
- __Middleware__ : Filtres exectués avant le traitement d'une requête permettant de vérifier certaines choses comme l'authentification de l'utilisateur.
- __Models__ : Contient les modèles liés à la base de données. Ces classes font également office de Repository.
- __Policies__ : Permet de définir les permissions. Définit si un utilisateur à le droit d'effectuer une action.
- __Services__ : Classe contenant de la logique métier complexe
- __Helpers__ : Contient des classes contenant uniquement des méthodes static. Ces classes apportent des petits utilitaires génériques.


## 👥 Participer
Pour participer il faut suivre les règles suivantes :

1. __Créer une nouvelle branche__ pour chaque fonctionnalité ou correctif
2. __Développer__ la fonctionnalité ou le correctif.
3. __Créer une pull request__ en expliquant ce qui a été fait
4. __Attendre__ les retours et la validations

Il faut utiliser les règles [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) dans ces messages de commits. En résumé les messages de commits doivent avoir cette forme : 
```
<type>(optional scope): <description>
```
