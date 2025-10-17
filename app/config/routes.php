<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| ROUTE DEFINITIONS
|--------------------------------------------------------------------------
| Fixed version: properly separates admin and student routes
| so logins and redirects no longer conflict.
|--------------------------------------------------------------------------
*/

// ==============================
// 🌐 Default route
// ==============================
$router->get('/', 'StudentsController::user_login');


// ==============================
// 🧑‍💼 ADMIN ROUTES
// ==============================

// Admin login (use /login)
$router->match('/login', 'StudentsController::login', ['GET', 'POST']);

// Admin logout
$router->get('/logout', 'StudentsController::logout');

// Admin view all students
$router->get('/get_all', 'StudentsController::get_all');
$router->match('/get_all/{page}', 'StudentsController::get_all', ['GET', 'POST']);

// Admin CRUD routes
$router->match('/create', 'StudentsController::create', ['GET', 'POST']);
$router->match('/update/{id}', 'StudentsController::update', ['GET', 'POST']);
$router->match('/delete/{id}', 'StudentsController::delete', ['GET', 'POST']);

// Search students (admin)
$router->match('/students/search', 'StudentsController::search', ['GET', 'POST']);


// ==============================
// 🎓 STUDENT ROUTES
// ==============================

// Student register
$router->match('/register', 'StudentsController::register', ['GET', 'POST']);

// Student login
$router->match('/user_login', 'StudentsController::user_login', ['GET','POST']);

// Student panel (profile/dashboard)
$router->get('/user_panel', 'StudentsController::user_panel');

// Student profile update
$router->match('/user_update/{id}', 'UserController::update', ['GET','POST']);


// ==============================
// 🏠 Optional Welcome Page
// ==============================
// Example: $router->get('/welcome', 'Welcome::index');

