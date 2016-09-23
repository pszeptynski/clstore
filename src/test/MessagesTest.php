<?php
include_once(__DIR__ . '/../Message.php');
include_once(__DIR__ . '/../User.php');
include_once(__DIR__ . '/../Admin.php');

class testMessage extends PHPUnit_Framework_TestCase {

	public function testTworzenieObiektuMessage() {
		$to = new User();
		$from = new Admin();
		$m = new Message($from, $to);
		$this->assertNotNull($m, "Nie można stworzyć obiektu Message");
	}
}
?>