<?php
class Admin {
	private $id;
	private $email;
	private $password;
	private $firstName;
	private $lastName;

	function __construct(){
            $this->db = new PDO(DB_DSN, DB_USER, DB_PASSWD);
        }
        
	public function login($email, $password){}
	public function getEmail(){}
	public function setEmail($email){}
	public function getFirstName(){}
	public function setFirstName($firstName){}
	public function getLastName(){}
	public function setLastName($lastName){}

	public static function getAdminsList(){}
	public static function loadAdmin($id){}
	public static function deleteAdmin($id){}
}
?>