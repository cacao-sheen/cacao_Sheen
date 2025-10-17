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

        // Check if logged in
        if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
            redirect('user_login');
            exit;
        }

        // ✅ Handle update submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = trim($this->io->post('first_name'));
            $last_name  = trim($this->io->post('last_name'));
            $emails     = trim($this->io->post('emails'));
            $password   = trim($this->io->post('password'));
            $profile_pic = null;

            // ✅ Handle profile picture upload
            if (!empty($_FILES['profile_pic']['name'])) {
                $upload_dir = BASEPATH . '../uploads/';
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

                $file_tmp  = $_FILES['profile_pic']['tmp_name'];
                $file_name = time() . "_" . basename($_FILES['profile_pic']['name']);
                $target    = $upload_dir . $file_name;
                $allowed   = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

                if (in_array($_FILES['profile_pic']['type'], $allowed)) {
                    if (move_uploaded_file($file_tmp, $target)) {
                        $profile_pic = $file_name;
                    }
                }
            }

            // ✅ Build update array
            $data = [
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'emails'     => $emails,
            ];

            // Update password only if entered
            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // Add new image only if uploaded
            if ($profile_pic) {
                $data['profile_pic'] = $profile_pic;
            }

            // ✅ Update the record
            $this->StudentsModel->update($id, $data);

            $_SESSION['message'] = "✅ Profile updated successfully!";
            redirect('user_panel');
            exit;
        }

        // ✅ Auto-load existing data for form
        $user = $this->StudentsModel->find($id);

        if (!$user) {
            die("⚠️ No record found for student ID: " . htmlspecialchars($id));
        }

        // Pass the user data to the update view
        $this->call->view('update_user', ['user' => $user]);
    }

    // ✅ Optional — Student dashboard view
    public function user_panel()
    {
        redirect('user_panel');
    }
}
