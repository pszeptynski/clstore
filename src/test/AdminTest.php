<?php
include_once(__DIR__ . '/../Admin.php');

class testAdmin extends PHPUnit_Framework_TestCase {

	public function testTworzenieObiektuAdmin() {
		$u = new Admin();
		$this->assertNotNull($u, "Nie można stworzyć obiektu Admin");
	}
}
?>