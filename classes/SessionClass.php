<?php
	//session_start();
	class SessionClass
	{
		//Fields
		private $emailadres;
		private $rol;
		
		//Properties
		public function getRol() { return $this->rol; }
	
		//Constructor
		public function ___construct() {}
	
		public function login($loginObject)
		{
			$this->emailadres = $_SESSION['emailadres'] = $loginObject->getEmailadres();
			$this->rol = $_SESSION['rol'] = $loginObject->getRol();
			
			// $usersObject = UsersClass::find_info_by_id($_SESSION['idKlant']);
			// $_SESSION['naam'] = $usersObject->getNaam();
		}
		public function logout()
		{
			session_unset('emailadres');
			session_unset('rol');		
			session_destroy();
			unset($this->emailadres);
			unset($this->rol);
		}
	}
	
	$session = new SessionClass();
?>