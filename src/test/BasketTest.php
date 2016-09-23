<?php
include_once(__DIR__ . '/../Basket.php');
include_once(__DIR__ . '/../User.php');

class testBasket extends PHPUnit_Framework_TestCase {

	public function testTworzenieObiektuBasket() {
		$u = new User();
		$b = new Basket($u);
		$this->assertNotNull($b, "Nie można stworzyć obiektu Basket");
	}
}
?>