# Source Code for [Laravel 11 Crash Course](https://youtu.be/eUNWzJUvkCA) original /V1

A simple personal notes manager application, inside which can register, login and create personal notes.


## Features (v2)


- 👤 Users can:
  - Create, edit, delete their own notes
  - View only their own notes

- 👑 Admins can:
  - Create notes only seen by Admin
  - View, edit, delete **all notes**

### ⚙️ Developer Features 
  - Actions stored in `App\Actions`
```bash
php artisan make:action [ActionName]
```
  - Test for NotesController 
  ```bash
  php artisan test`
  ```
  
## Role-Based Access

Authorization is handled via Laravel Policies:
  `NotePolicy@view`,
  `NotePolicy@update`,
  `NotePolicy@delete` 
  returns:
```php
return $user->role === 'admin' || $note->user_id === $user->id;
```




## 🧱 Optional: Production Safety Config

- In AppServiceProvider.php, to enforce stricter development behavior:

```php
public function boot(): void
{
    Model::shouldBeStrict(!app()->isProduction());
    DB::prohibitDestructiveCommands(app()->isProduction());
    Model::preventAccessingMissingAttributes(!app()->isProduction());
}
```
## Installation
1. Clone the project
2. Navigate to the project's root directory using terminal
3. Create `.env` file - `cp .env.example .env`
4. Execute `composer install`
5. Execute `npm install`
6. Set application key - `php artisan key:generate --ansi`
7. Execute migrations and seed data - `php artisan migrate --seed`
8. Start vite server - `npm run dev`
9. Start Artisan server - `php artisan serve`
