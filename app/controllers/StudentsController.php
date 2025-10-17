<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
require_once __DIR__ . '/../helpers/auth_helper.php';

class StudentsController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->library('pagination');
        $this->call->library('session');
        $this->call->model('StudentsModel');
    }

    /* ============================================================
       🧑‍💼 ADMIN LOGIN
    ============================================================ */
    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if ($username === 'admin' && $password === 'admin123') {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['username'] = 'admin';
                redirect('get_all');
                return;
            }

            $this->call->view('login', ['admin_error' => '❌ Invalid admin username or password']);
            return;
        }

        $this->call->view('login');
    }

    /* ============================================================
       🎓 STUDENT LOGIN
    ============================================================ */
    public function user_login()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email']);
            $password = trim($_POST['password']);

            $sql  = "SELECT * FROM students WHERE emails = ? AND password = ?";
            $stmt = $this->StudentsModel->db->raw($sql, [$email, $password]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_id']        = $user['id'];
                $_SESSION['email']          = $user['emails'];
                redirect('user_panel');
                return;
            }

            $this->call->view('login', ['user_error' => '❌ Invalid email or password']);
            return;
        }

        $this->call->view('login');
    }

    /* ============================================================
       🚪 LOGOUT (works for both roles)
    ============================================================ */
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
        redirect('user_login');
    }

    /* ============================================================
       🧑‍💼 ADMIN AREA — CRUD
    ============================================================ */
    public function get_all($page = 1)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['admin_logged_in'])) {
            redirect('login');
            exit;
        }

        $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $allowed  = [10,25,50,100];
        if (!in_array($per_page, $allowed)) $per_page = 10;

        $keyword     = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $total_rows  = $this->StudentsModel->count_filtered_records($keyword);
        $offset      = ($page - 1) * $per_page;
        $limit_clause = "LIMIT {$offset}, {$per_page}";

        $pagination_data  = $this->pagination->initialize($total_rows, $per_page, $page, 'get_all', 5);

        $data['students'] = ($keyword !== '')
            ? $this->StudentsModel->searchStudents($keyword, $limit_clause)
            : $this->StudentsModel->get_records_with_pagination($limit_clause);

        $data['pagination_data']  = $pagination_data;
        $data['pagination_links'] = $this->pagination->paginate();
        $data['keyword']          = $keyword;

        $this->call->view('get_all', $data);
    }

    /* ============================================================
       🧩 CREATE STUDENT
    ============================================================ */
    public function create()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['admin_logged_in'])) {
            redirect('login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $first_name = trim($_POST['first_name']);
            $last_name  = trim($_POST['last_name']);
            $emails     = trim($_POST['emails']);

            if (!$first_name) $errors[] = "First name is required.";
            if (!$last_name)  $errors[] = "Last name is required.";
            if (!$emails || !filter_var($emails, FILTER_VALIDATE_EMAIL))
                $errors[] = "A valid email is required.";

            $profile_pic = null;

            if (!empty($_FILES['profile_pic']['name'])) {
                $upload_dir = __DIR__ . '/../../uploads/';
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

                $file_tmp  = $_FILES['profile_pic']['tmp_name'];
                $file_name = time() . "_" . basename($_FILES['profile_pic']['name']);
                $target    = $upload_dir . $file_name;
                $allowed   = ['image/jpeg','image/png','image/gif'];

                if (!in_array($_FILES['profile_pic']['type'], $allowed))
                    $errors[] = "Only JPG, PNG, GIF allowed.";
                elseif (!move_uploaded_file($file_tmp, $target))
                    $errors[] = "❌ File upload failed.";
                else
                    $profile_pic = $file_name;
            }

            if (!empty($errors)) {
                $this->call->view('create', ['errors' => $errors]);
                return;
            }

            $this->StudentsModel->insert([
                'first_name'  => $first_name,
                'last_name'   => $last_name,
                'emails'      => $emails,
                'profile_pic' => $profile_pic
            ]);

            redirect('get_all');
        }

        $this->call->view('create');
    }

    /* ============================================================
       ✏️ UPDATE STUDENT
    ============================================================ */
    public function update($id)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['admin_logged_in'])) {
            redirect('login');
            exit;
        }

        $student = $this->StudentsModel->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $first_name = trim($_POST['first_name']);
            $last_name  = trim($_POST['last_name']);
            $emails     = trim($_POST['emails']);

            if (!$first_name) $errors[] = "First name is required.";
            if (!$last_name)  $errors[] = "Last name is required.";
            if (!$emails || !filter_var($emails, FILTER_VALIDATE_EMAIL))
                $errors[] = "A valid email is required.";

            $data = [
                'first_name'  => $first_name,
                'last_name'   => $last_name,
                'emails'      => $emails,
                'profile_pic' => $student['profile_pic']
            ];

            if (!empty($_FILES['profile_pic']['name'])) {
                $upload_dir = __DIR__ . '/../../uploads/';
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

                $file_tmp  = $_FILES['profile_pic']['tmp_name'];
                $file_name = time() . "_" . basename($_FILES['profile_pic']['name']);
                $target    = $upload_dir . $file_name;
                $allowed   = ['image/jpeg','image/png','image/gif'];

                if (!in_array($_FILES['profile_pic']['type'], $allowed))
                    $errors[] = "Only JPG, PNG, GIF allowed.";
                elseif (!move_uploaded_file($file_tmp, $target))
                    $errors[] = "❌ File upload failed.";
                else {
                    if (!empty($student['profile_pic']) && file_exists($upload_dir . $student['profile_pic']))
                        unlink($upload_dir . $student['profile_pic']);
                    $data['profile_pic'] = $file_name;
                }
            }

            if (!empty($errors)) {
                $this->call->view('update', ['student' => $student, 'errors' => $errors]);
                return;
            }

            $this->StudentsModel->update($id, $data);
            redirect('get_all');
        }

        $this->call->view('update', ['student' => $student]);
    }

    /* ============================================================
       🗑 DELETE STUDENT
    ============================================================ */
    public function delete($id)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['admin_logged_in'])) {
            redirect('login');
            exit;
        }

        $this->StudentsModel->delete($id);
        redirect('get_all');
    }

    /* ============================================================
       🔍 FIXED SEARCH (WORKS IN ADMIN PANEL)
    ============================================================ */
    public function search()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['admin_logged_in'])) {
            redirect('login');
            exit;
        }

        $keyword = $_GET['keyword'] ?? '';
        $students = $this->StudentsModel->searchStudents($keyword);

        $this->call->view('get_all', [
            'students' => $students,
            'keyword' => $keyword,
            'pagination_links' => '', // no pagination for search
        ]);
    }

    /* ============================================================
       🎓 STUDENT FEATURES
    ============================================================ */
    public function register()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = $this->io->post('first_name');
            $last_name  = $this->io->post('last_name');
            $emails     = $this->io->post('emails');
            $password   = $this->io->post('password');
            $profile_pic = null;

            if (!empty($_FILES['profile_pic']['name'])) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
                $file_name  = time() . '_' . basename($_FILES["profile_pic"]["name"]);
                $target     = $target_dir . $file_name;

                if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target))
                    $profile_pic = $file_name;
                else
                    $errors[] = "File upload failed.";
            }

            if (!$first_name) $errors[] = "First name is required.";
            if (!$last_name)  $errors[] = "Last name is required.";
            if (!$emails)     $errors[] = "Email is required.";
            if (!$password)   $errors[] = "Password is required.";

            if (empty($errors)) {
                $this->StudentsModel->insert([
                    'first_name'  => $first_name,
                    'last_name'   => $last_name,
                    'emails'      => $emails,
                    'password'    => $password,
                    'profile_pic' => $profile_pic
                ]);
                redirect('user_login');
                return;
            }
        }

        $this->call->view('register', ['errors' => $errors]);
    }

    public function user_panel()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['user_logged_in'])) {
            redirect('user_login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $student = $this->StudentsModel->find($user_id);
        $this->call->view('user_panel', ['user' => $student]);
    }
}
