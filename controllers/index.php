<?php
/**
 * @author  Seungchul Lee
 * @date    July 5, 2014
 */

class Index extends Controller {

    function __construct() 
    {
        parent::__construct();
    }

    // public methods
    
    public function index() 
    {   
        if (Session::get('loggedIn'))
        {
            $this->redirecttoJobBoard();
        }
        
        $this->view->render('index/index');
    }
    
    public function login() {
        $result = $this->model->login();
        
        if ($result == TRUE)
        {
            $this->redirecttoJobBoard();
        }
        else
        {
            header('Location: ' .URL.'error/login');
            exit;
        }
    }
    
    public function logout() {
        Session::destroy();
        
        header('Location: ' .URL);
        exit;
    }
    
    // private methods
    
    private function redirecttoJobBoard()
    {
        header('Location: ' .URL.'jobboard/');
        exit;
    }
}