<?php
include_once('Product.php');
include_once('User.php');

class Order {
	private $id;
	private $orderStatus;
	private $orderStatusDict;
	private $products;
	private $user;

	function __construct(User $user){
		$this->user = $user;
		$this->orderStatusDict = [
			0 => "niezłożone",
			1 => "złożone",
			2 => "opłacone",
			3 => "zrealizowane"
		];
	}

	public function getOrderStatus(){}
	public function setOrderStatus($status){}
	public function getProducts(){}
	public function addProduct(Product $product){}
	public function removeProduct(Product $product){}
	public function saveOrder(){}

	public static function getOrderList(User $user, $status){}
	public static function getOrder($id){}
}

?>