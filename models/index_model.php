<?php
/**
 * @author Seungchul
 * @date   July 5, 2014
 */

class Index_Model extends Model {

    function __construct() 
    {
        parent::__construct();
    }
    
    public function login()
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if (empty($username) && empty($password))
        {
            return FALSE;
        }
        else
        {
            
            $statement = $this->db->prepare("
                SELECT *
                FROM (
                    SELECT email, password FROM Student
                    UNION all
                    SELECT email, password FROM Recruiter
                ) table1
                WHERE email = '$username' AND password = '$password'
            ");

            $success = $statement->execute();

            if ($success && !empty($statement->fetchAll())) 
            {
                Session::set('loggedIn', true);
                Session::set('username', $username);
                
                return TRUE;
            } 
            else 
            {
                return FALSE;
            }
        }
    }

    public function signup(){
        $email = $_POST['username'];
        $password = md5($_POST['password']);
        $position = $_POST['position'];

        $query = "INSERT INTO $position (email, password) VALUES('$email', '$password')";
        $statement = $this->db->prepare($query);
        $success = $statement->execute();

        if($success){
            $result = array('username' => $_POST['email'], 'password' => $_POST['password']);
            return $result;
        }
        else 
            return NULL;
    }
}