<?php
include_once(__DIR__ . '/../Order.php');
include_once(__DIR__ . '/../User.php');

class testOrder extends PHPUnit_Framework_TestCase {

	public function testTworzenieObiektuOrder() {
		$u = new User();
		$o = new Order($u);
		$this->assertNotNull($o, "Nie można stworzyć obiektu Order");
	}
}
?>