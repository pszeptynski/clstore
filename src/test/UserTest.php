<?php
include_once(__DIR__ . '/../User.php');

class testUser extends PHPUnit_Framework_TestCase {
  //   public function getConnection() {
  //       $conn = new PDO(
  //           $GLOBALS['DB_DSN'],
  //           $GLOBALS['DB_USER'],
  //           $GLOBALS['DB_PASSWD']
  //       );
  //       $conn->query("SET FOREIGN_KEY_CHECKS=0");
  //       return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_DBNAME']);
  //   }

  //   public function getDataSet() {
  //       return $this->createMySQLXMLDataSet('/Users/lukaszf/public_html/Warsztaty/clstore/src/test/clstore.dump.xml');
  //   }

  //   public function testIloscProduktow()
  //   {
  //   	$this->getConnection()->query("SET FOREIGN_KEY_CHECKS=0");
  //       $this->assertEquals(3, $this->getConnection()->getRowCount('Products'), "Niepoprawna ilość produktów");
  //   }

  //   public function testIlosciUzytkownikow()
  //   {
  //   	$this->getConnection()->query("SET FOREIGN_KEY_CHECKS=0");
		// $queryTable = $this->getConnection()->createQueryTable(
  //   		'Users',
  //   		'SELECT id FROM Users where is_admin=0'
  //   	);
  //       $this->assertEquals(1, $queryTable->getRowCount('Users'), "Niepoprawna ilość użytkowników");
  //   }

  //   public function testIlosciAdminow()
  //   {
  //   	$this->getConnection()->query("SET FOREIGN_KEY_CHECKS=0");
		// $queryTable = $this->getConnection()->createQueryTable(
  //   		'Users',
  //   		'SELECT id FROM Users where is_admin=1'
  //   	);
  //       $this->assertEquals(1, $queryTable->getRowCount('Users'), "Niepoprawna ilość adminow");
  //   }

	public function testTworzenieObiektuUser() {
		$u = new User();
		$this->assertNotNull($u, "Nie można stworzyć obiektu User");
	}

	public function testPobranieListyUserow() {
		$user_list = User::getUsersList();
		$this->assertNotNull($user_list, "Nie można pobrać listy użytkowników");
	}

	public function testZapisanieNowegoUzytkownika() {
		$u = new User();
		$u->setEmail('test' . rand(1, 100) . '@test.pl');
		$u->setPassword('haslo123');
		$u->setFirstName('Imie');
		$u->setLastName('Nazwisko');
		$u->save();

		$this->assertGreaterThan(0, $u->getId(), "ID użytkownika nie zostało poprawnie ustawione");
	}

	public function testUtworzenieUzytkownikaDlaPodanegoId() {
		$user = User::loadUser(1);
		$this->assertTrue($user instanceof User, "Błąd ładowania użytkownika z bazy");
	}
}
?>