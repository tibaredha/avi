<?php

class Login_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function run()
	{
	
		$sth = $this->db->prepare("SELECT * FROM users WHERE login = :login AND password = :password");		
		$sth->execute(array(
			':login' => $_POST['login'],
			':password' => md5($_POST['password'])
		));
		Session::init();
		Session::set('demgraphie',$_POST['demgraphie']);
		$data = $sth->fetch();
		$count =  $sth->rowCount();
		if ($count > 0) {
			Session::init();
			Session::set('wilaya',$data['wilaya']);
			Session::set('structure',$data['structure']);
			Session::set('login',$data['login']);
			Session::set('role', $data['role']);
			Session::set('id', $data['id']);
			Session::set('loggedIn', true);
			if($_POST['demgraphie']== 1) 
			{
			header('location: ../dashboard');
			} 
			else 
			{
			header('location: ../naissance');
			}
		} else {
			Session::init();
		    Session::set('errorlogin', 'Bad username or password supplied.');
			header('location: ../login');
		}
		
	}
	
}