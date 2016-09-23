<?php
include_once(__DIR__ . '/../Product.php');

class testProduct extends PHPUnit_Framework_TestCase {

	public function testTworzenieObiektuProduct() {
		$p = new Product();
		$this->assertNotNull($p, "Nie można stworzyć obiektu Product");
	}
}
?>