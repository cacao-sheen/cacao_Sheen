<?php
defined('PREVENT_DIRECT_ACCESS') OR exit ('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class StudentsModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($first_name, $last_name, $email) {
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email
        );
        return $this->db->table('students')->insert($data);
    }   

    public function get_one($id){
       return $this->db->table('students')->where('id', $id)->get();
    }

    

   public function delete($id) {
       return $this->db->table('students')->where('id', $id)->delete();
   }

    public function count_all_records()
    {
        $sql = "SELECT COUNT({$this->primary_key}) as total FROM {$this->table} WHERE 1=1";
        $result = $this->db->raw($sql);
        return $result ? $result->fetch(PDO::FETCH_ASSOC)['total'] : 0;
    }

    public function get_records_with_pagination($limit_clause)
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1 ORDER BY {$this->primary_key} DESC {$limit_clause}";
        $result = $this->db->raw($sql);
        return $result ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}