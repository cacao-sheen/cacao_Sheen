<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->model('StudentsModel');
        $this->call->library('session');
    }

    // ✅ Student profile update page
    public function update($id)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
            redirect('user_login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect new profile data
            $first_name = trim($_POST['first_name']);
            $last_name  = trim($_POST['last_name']);
            $emails     = trim($_POST['emails']);
            $password   = trim($_POST['password']);
            $profile_pic = null;

            // Handle image upload
            if (!empty($_FILES['profile_pic']['name'])) {
                $upload_dir = __DIR__ . '/../../uploads/';
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

                $file_tmp  = $_FILES['profile_pic']['tmp_name'];
                $file_name = time() . "_" . basename($_FILES['profile_pic']['name']);
                $target    = $upload_dir . $file_name;
                $allowed   = ['image/jpeg', 'image/png', 'image/gif'];

                if (in_array($_FILES['profile_pic']['type'], $allowed) && move_uploaded_file($file_tmp, $target)) {
                    $profile_pic = $file_name;
                }
            }

            // Build data for update
            $data = [
                'first_name'  => $first_name,
                'last_name'   => $last_name,
                'emails'      => $emails,
                'password'    => $password,
            ];

            if ($profile_pic) {
                $data['profile_pic'] = $profile_pic;
            }

            // ✅ Update student info in the students table
            $this->StudentsModel->update($id, $data);

            $_SESSION['message'] = "✅ Profile updated successfully!";
            redirect('user_panel');
        } 
        else {
            // ✅ Fetch existing student record (FIXED)
            $student = $this->StudentsModel->find($id);

            if (!$student) {
                die("⚠️ No record found for student ID: " . htmlspecialchars($id));
            }

           $this->call->view('update_user', ['user' => $student]);


        }
    }

    // Optional — Student dashboard view (redirects to StudentsController)
    public function user_panel()
    {
        redirect('user_panel');
    }
}
