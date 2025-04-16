# Source Code for [Laravel 11 Crash Course](https://youtu.be/eUNWzJUvkCA) original /V1

A simple personal notes manager application, inside which can register, login and create personal notes.

A user can make notes, edit their own Notes, delete their own Notes, and view only their own Notes


## Features (v2)

- 👤 Users can:
  - Create, edit, delete their own notes
  - View only their own notes

- 👑 Admins can:
  - View, edit, delete **all notes**
  - Manage users (future-ready)

## Role-Based Access

Authorization is handled via Laravel Policies:
- `NotePolicy@view` returns:
  ```php
  return $user->role === 'admin' || $note->user_id === $user->id;


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
