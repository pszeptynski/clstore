<?php
include_once('config.inc.php');

class User {
	private $id;
	private $email;
	private $password;
	private $firstName;
	private $lastName;
	private $db;

	function __construct() {
		$this->db = new PDO(DB_DSN, DB_USER, DB_PASSWD);
	}

	public function login($email, $password) {
		if ($email==$this->email && $password==$this->password) {
			return true;
		} else {
			return false;
		}
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getFirstName() {
		return $this->firstName;
	}

	public function setFirstName($firstname) {
		$this->firstName = $firstname;
	}

	public function getLastName() {
		return $this->lastName;
	}

	public function setLastName($lastname) {
		$this->lastName = $lastname;
	}

	public function save() {
		if ( $this->checkEmail() && $this->checkIfEmailAlreadyExists($this->email) ) { // sprawdzamy poprawnosc adresu email
			if ( $this->checkPassword() ) { // sprawdzamy poprawnosc hasla
				if ( $this->checkFirstLastName() ) { // spradzamy imie i nazwisko
					if ( !isset($this->id) ) { // użytkownik zapisywany po raz pierwszy
						// zapytanie SQL
						$sql = "INSERT INTO Users 
									(email, password, firstname, lastname)
								VALUES
									(:email, :password, :firstname, :lastname)";
						// przygotowujemy zapytanie dodania użytkownika do tablicy Users
						$stmt = $this->db->prepare($sql);

						// próbujemy je wykonać
						try {
							// podstawiamy faktyczne wartości pod placeholdery
							$stmt->execute(
								array(
									':email' 		=> $this->email,
									':password'		=> $this->password,
									':firstname'	=> $this->firstName,
									':lastname'		=> $this->lastName
									)
								);
							// po wykonaniu zapytania składujemy id użytkownika w obiekcie
							$this->id = $this->db->lastInsertId();
						} catch (PDOException $pe) {
							throw new Exception("Błąd podczas dodawania rekordu użytkownika [".$pe->getMessage()."]");
						}
					} else { // użytkownik już posiada wpis w tablicy SQL
						// zapytanie SQL
						$sql = "UPDATE Users SET
									email=:email,
									password=:password,
									firstname=:firstname,
									lastname=:lastname
								WHERE id=:id";
						// przygotowujemy zapytanie dodania użytkownika do tablicy Users
						$stmt = $this->db->prepare($sql);

						// próbujemy je wykonać
						try {
							// podstawiamy faktyczne wartości pod placeholdery
							$stmt->execute(
								array(
									':email' 		=> $this->email,
									':password'		=> $this->password,
									':firstname'	=> $this->firstName,
									':lastname'		=> $this->lastName,
									':id'			=> $this->id
									)
								);
						} catch (PDOException $pe) {
							throw new Exception("Błąd podczas uaktualniania rekordu użytkownika [".$pe->getMessage()."]");
						}
					}
				} else {
					throw new Exception("Imię i nazwisko nie mogą być puste");
				}
			} else {
				throw new Exception("Niepoprawne hasło - musi mieć min. 6 znaków");
			}
		} else { // niepoprawny adres email
			throw new Exception("Niepoprawny adres email lub został już dodany wcześniej");
		}
	}

	private function checkEmail() {
		return filter_var($this->email, FILTER_VALIDATE_EMAIL);
	}

	private function checkIfEmailAlreadyExists($email) {
		$stmt = $this->db->prepare("SELECT 1 FROM Users WHERE email=:email");
		try {
			$stmt->execute( array(':email'	=> $email) );
			if ( $stmt->rowCount() > 0 ) {
				return false;
			} else {
				return true;
			}
		} catch (PDOException $pe) {
			throw new Exception("Błąd zapytania sprawdzającego czy podany email jest już w tablicy Users");
		}
	}

	private function checkPassword() {
		// minimum 6 znakow
		if ( strlen(trim($this->password))>5 ) {
			return true;
		} else {
			return false;
		}
	}

	private function checkFirstLastName() {
		// sprawdzamy czy imie i nazwisko nie są puste
		if ( strlen(trim($this->firstName))>0 && strlen(trim($this->lastName))>0 ) {
			return true;
		} else {
			return false;
		}
	}

	public static function getUsersList() {
		$sql = "SELECT id, email, password, firstname, lastname FROM Users WHERE is_admin=0";
		$db = new PDO(DB_DSN, DB_USER, DB_PASSWD);
		try {
			$stmt = $db->query($sql);
 			return $stmt->fetchAll(PDO::FETCH_ASSOC); // do zmiany na listę obiektów
		} catch(PDOException $ex) {
			// do obsłużenia
		}
	}

	public static function loadUser($id) {
		$sql = "SELECT email, password, firstname, lastname FROM Users WHERE is_admin=0 AND id=:id";
		$db = new PDO(DB_DSN, DB_USER, DB_PASSWD);
		$stmt = $db->prepare($sql);
		try {
			$stmt->execute( array(':id' => $id));
			if ( $stmt->rowCount() > 0 ) { // uzytkownik istnieje
	 			$results = $stmt->fetchAll(PDO::FETCH_ASSOC); // do zmiany na listę obiektów
	 			$email = $results[0]['email'];
	 			$password = $results[0]['password'];
	 			$firstname = $results[0]['firstname'];
	 			$lastname = $results[0]['lastname'];

	 			$u = new User();
	 			$u->setId($id);
	 			$u->setEmail($email);
	 			$u->setPassword($password);
	 			$u->setFirstName($firstname);
	 			$u->setLastName($lastname);

	 			return $u;
	 		} else {
	 			throw new Exception("Użytkownik o podanym id nie istnieje");
	 		}
		} catch(PDOException $ex) {
			// do obsłużenia
		}
	}

	public static function deleteUser($id){}
}
?>