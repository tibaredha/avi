<?php

class Session
{
	const dateexpiration ='2019-01-01'; 
	const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;
	private $sessionState = self::SESSION_NOT_STARTED;// The state of the session
	private static $instance;// THE only instance of the class
	private function __construct() {}
	
    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self;
        }
        
        self::$instance->startSession();
        
        return self::$instance;
    } 
      public function startSession()
    {
        if ( $this->sessionState == self::SESSION_NOT_STARTED )
        {
            $this->sessionState = session_start();
        }
        
        return $this->sessionState;
    } 
	 public function __set( $name , $value )
    {
        $_SESSION[$name] = $value;
    }
	 public function __get( $name )
    {
        if ( isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }
	 public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }
    
    
    public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }
	
	 public function destroyy()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );
            
            return !$this->sessionState;
        }
        
        return FALSE;
    }
	
	//**********************************************************************************************************//
	public static function init()
	{
	
		// Lieu de la création de la session 
		// session_save_path('C:\tiba');
		// Nom de la session 
		// session_name('SessionPHP');
		// Création de la session 
	
	    $date=date('Y-m-d');
		if ($date <= self::dateexpiration )
		{
		session_set_cookie_params(0);// kill session when browser closed
		@session_start();
		}
		// @session_start();
	}
	
	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	
	public static function get($key)
	{
		if (isset($_SESSION[$key]))
		return $_SESSION[$key];
	}
	
	public static function destroy()
	{
		//unset($_SESSION);
		session_destroy();
		session_set_cookie_params(0);// kill session when browser closed
	}
	
}


// $data = Session::getInstance();
// $data->nickname = 'Someone';
// $data->age = 18;
// printf( '<p>My name is %s and I\'m %d years old.</p>' , $data->nickname , $data->age );
// printf( '<pre>%s</pre>' , print_r( $_SESSION , TRUE ));
// var_dump( isset( $data->nickname ));
// $data->destroy();
// var_dump( isset( $data->nickname ));















