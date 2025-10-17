<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| ROUTE DEFINITIONS
|--------------------------------------------------------------------------
| Clean separation of Admin and Student routes.
| Prevents conflicts, fixes "Page not found" on user update.
|--------------------------------------------------------------------------
*/

// ==============================
// 🌐 Default route (redirect to student login)
// ==============================
$router->get('/', 'StudentsController::user_login');


// ==============================
// 🧑‍💼 ADMIN ROUTES
// ==============================

// Admin login
$router->match('/login', 'StudentsController::login', ['GET', 'POST']);

// Admin logout
$router->get('/logout', 'StudentsController::logout');

// View all students (admin dashboard)
$router->match('/get_all', 'StudentsController::get_all', ['GET', 'POST']);
$router->match('/get_all/{page}', 'StudentsController::get_all', ['GET', 'POST']);

// Admin CRUD
$router->match('/create', 'StudentsController::create', ['GET', 'POST']);
$router->match('/update/{id}', 'StudentsController::update', ['GET', 'POST']);
$router->match('/delete/{id}', 'StudentsController::delete', ['GET', 'POST']);

// Search students (admin)
$router->match('/students/search', 'StudentsController::search', ['GET', 'POST']);


// ==============================
// 🎓 STUDENT ROUTES
// ==============================

// Student registration
$router->match('/register', 'StudentsController::register', ['GET', 'POST']);

// Student login
$router->match('/user_login', 'StudentsController::user_login', ['GET', 'POST']);

// Student dashboard/profile page
$router->get('/user_panel', 'StudentsController::user_panel');

// Student profile update (✅ Fixed path)
$router->match('/user_update/{id}', 'UserController::update', ['GET', 'POST']);


// ==============================
// 🏠 Optional Welcome Page
// ==============================
// $router->get('/welcome', 'Welcome::index');
