<?php
class Register_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	 public function runRegister($data) 
	 {
	    $msgr = $this->check_empty($_POST, array('login'));
        if($msgr != null) 
		{
		Session::init();
		Session::set('errorregister', $msgr);
		header('location: ../register');
	    }
		else 
		{
			$sth = $this->db->prepare("SELECT * FROM users WHERE login = :login ");
			$sth->execute(array(
				 ':login' => $data['login']	
			));
			$data1 = $sth->fetch();
			$count = $sth->rowCount();
			
			if ($count > 0) 
			{	
				Session::init();
				Session::set('errorregister', 'Username already exists.');
				header('location: ../register');
			} 
			else 
			{
			 $this->db->insert('users', array(
				'wilaya' => $data['wilaya'],
				'structure' => $data['structure'],
				'login' => $data['login'],
				'password' => md5($data['password'])		
			));
			Session::init();
			Session::set('errorlogin', 'Username << '.$data['login'].' >> added successfully.');
			header('location: ' . URL . 'login');
			} 
		
		}

	     
    }	
}