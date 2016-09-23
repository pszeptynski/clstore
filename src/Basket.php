<?php
include_once('Product.php');
include_once('User.php');

class Basket {
	private $id;
	private $products;
	private $user;

	function __construct(User $user){
		$this->user = $user;
	}

	public function getProducts(){}
	public function addProduct(Product $product){}
	public function removeProduct(Product $product){}
	public function orderBasket(){}
	public function clearBasket(){}
}
?>