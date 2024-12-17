# 🚀 Système d'Authentification Laravel Personnalisé avec deux utilisateur (user et admin)

Un système d'authentification construit sur Laravel, sans recourir aux packages d'authentification intégrés. Idéal pour un apprentissage approfondi ou pour des projets nécessitant des solutions personnalisées.

## 📖 Table des Matières

- [Fonctionnalités](#✨-fonctionnalités)
- [Prérequis](#🔧-prérequis)
- [Installation](#📥-installation)
- [Structure du Projet](#🏗-structure-du-projet)
- [Points Essentiels](#🎯-points-essentiels)
- [Guide d'Utilisation](#👨‍💻-guide-dutilisation)
- [Personnalisation du Style](#🎨-personnalisation-du-style)
- [Cycle de Session](#🔄-cycle-de-session)

---

## ✨ Fonctionnalités

- **Inscription et Connexion** : Gestion des utilisateurs avec un système sécurisé.
- **Sessions** : Connexion persistante avec gestion sécurisée des sessions.
- **Protection des Routes** : Middleware personnalisé pour protéger les ressources.
- **Validation Avancée** : Données utilisateur soigneusement validées.
- **Interface Utilisateur Moderne** : Design responsive, clair et intuitif.
- **Gestion des Erreurs** : Feedback utilisateur détaillé et adapté.
- **Déconnexion Sécurisée** : Terminer une session en toute sécurité.

---

## 🔧 Prérequis

- **PHP** : Version >= 8.0
- **Laravel** : Version >= 9.0
- **MySQL** : Version >= 5.7
- **Composer** : Pour la gestion des dépendances PHP

---

## 📥 Installation

1. **Cloner le projet** :
   ```bash
   git clone [url-du-projet]
   cd [nom-du-dossier]
   ```

2. **Installer les dépendances** :
   ```bash
   composer install
   ```

3. **Configurer l’environnement** :
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurer la base de données** dans le fichier `.env` :
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=custom_auth
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Configurer la base de données** (création d'un admin par defaut ) `AdminSeeder.php` :

```php
public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Évite les doublons si le seeder est exécuté plusieurs fois
            [
                'name' => 'Admin',
                'password' => Hash::make('admin'), // Utiliser un mot de passe sécurisé en production
                'role' => 'admin', // Rôle administrateur
            ]
        );
    }
```

6. **Activer l'AdminSeeder.php** dans le fichier  `DatabaseSeeder.php` :

```php
public function run()
    {
        $this->call(AdminSeeder::class);
    }
```

7. **Exécuter les migrations** :
   ```bash
   php artisan migrate
   ```

8. **Lancer le serveur local** :
   ```bash
   php artisan serve
   ```

---

## 🏗 Structure du Projet

### 📂 Models
- **`User.php`** : Modèle utilisateur avec gestion des attributs et relations nécessaires.

### 📂 Controllers
- **`AuthController.php`** :
  - Inscription
  - Connexion
  - Déconnexion

### 📂 Middleware
- **`AdminMiddleware.php`** : Vérifie les sessions actives pour protéger les routes administrateur.
- **`UserMiddleware.php`** : Vérifie les sessions actives pour protéger les routes Utilisateur.

### 📂 Migrations
- **`create_users_table.php`** :
  - `name`
  - `email` (unique)
  - `password`
  - `role`
  - `timestamps`

### 📂 Views
- **`auth/login.blade.php`** : Page de connexion.
- **`auth/register.blade.php`** : Page d’inscription.
- **`admin/dashboard.blade.php`** : Tableau de bord utilisateur admin.
- **`user/dashboard.blade.php`** : Tableau de bord utilisateur.

### 📂 Routes
```php
// Routes publiques
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Routes protégées

// Tableau de bord utilisateur
Route::middleware('user')->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

// Tableau de bord admin
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
```

---

## 🎯 Points Essentiels

### Sécurité
- Hashage des mots de passe avec **Bcrypt**.
- Protection CSRF sur tous les formulaires.
- Validation stricte des données utilisateur.
- Middleware pour garantir des sessions sécurisées.

### Interface Utilisateur
- Design responsive et moderne.
- Feedback utilisateur clair et interactif.
- Navigation intuitive avec animations fluides.

### Validation des Données
#### Exemple : Inscription
```php
'name' => 'required|string|max:255',
'email' => 'required|string|email|max:255|unique:users',
'password' => 'required|string|min:8|confirmed',
```
#### Exemple : Connexion
```php
'email' => 'required|string|email|max:255|unique:users'
'password' => 'required|string',
```

---

## 👨‍💻 Guide d’Utilisation

### Inscription
1. Accéder à `/register`.
2. Remplir le formulaire avec :
   - Nom d’utilisateur (unique)
   - Email
   - Mot de passe (et confirmation)
3. Soumettre le formulaire pour être redirigé vers le tableau de bord.

### Connexion
1. Accéder à `/login`.
2. Saisir l'**email** et le **mot de passe**.
3. Une fois connecté, accéder au tableau de bord.

### Déconnexion
1. Utiliser l'option "Déconnexion" pour terminer la session en toute sécurité.

---

## 🎨 Personnalisation du Style

Le projet utilise une approche design moderne avec :
- **Palette de couleurs** : cohérente et attrayante.
- **Typographie** : lisible et professionnelle.
- **Espacement** : harmonieux pour un affichage clair.
- **Feedback visuel** : transitions et animations subtiles.
- **Formulaires** : adaptatifs et responsifs.

---

## 🔄 Cycle de Session

1. **Création lors de la connexion/inscription** :
   ```php
   Session::put('user_id', $user->id);
   ```

2. **Vérification dans le middleware** :
   ```php
   if (!Session::has('user_id')) {
       return redirect('/login');
   }
   ```

3. **Suppression lors de la déconnexion** :
   ```php
   Session::forget('user_id');
   ```

