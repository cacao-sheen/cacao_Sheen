<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: StudentsController
 * 
 * Automatically generated via CLI.
 */
class StudentsController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->library('pagination');
        $this->call->library('session'); 

    }

    /*public function get_all(){
       
        $data['s'] = $this->StudentsModel->all();
        $this->call->view('get_all', $data);
    }*/

   public function create() {
       
        if($this->form_validation->submitted()){
             $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $email = $this->io->post('email');

            $this->StudentsModel->create($first_name, $last_name, $email);

        }
       
         $this->call->view('create');
    }
   function update($id) {
        $student = $this->StudentsModel->find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name'  => $_POST['last_name'],
                'email'      => $_POST['email']
            ];
            $this->StudentsModel->update($id, $data);
            redirect('get_all');
        }
        $this->call->view('/update', ['student' => $student]);

    }
    function delete($id) {
         $this->StudentsModel->delete($id);
         redirect('get_all');
    }

     public function get_all($page = 1)
{
    try {
        // Load query parameters
        $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $allowed_per_page = [10, 25, 50, 100];
        if (!in_array($per_page, $allowed_per_page)) $per_page = 10;

        // Total rows
        $total_rows = $this->StudentsModel->count_all_records();

        // Ensure page is valid
        $page = max(1, (int)$page);

        // Calculate offset
        $offset = ($page - 1) * $per_page;
        $limit_clause = "LIMIT {$offset}, {$per_page}";

        
        $pagination_data = $this->pagination->initialize(
            $total_rows,
            $per_page,
            $page,
            'get_all',
            5
        );

        $data['students'] = $this->StudentsModel->get_records_with_pagination($limit_clause);
        $data['total_records'] = $total_rows;
        $data['pagination_data'] = $pagination_data;
        $data['pagination_links'] = $this->pagination->paginate();

       
        $data['error'] = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

        
        $this->call->view('get_all', $data);

    } catch (Exception $e) {
       
        $error_msg = urlencode($e->getMessage());
        redirect('get_all/1?error=' . $error_msg);
    }
}
}
