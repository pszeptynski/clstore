<?php
class Product {
	private $id;
	private $name;
	private $price;
	private $description;
	private $availability;
	private $group;

	function __construct(){}
	public function getName(){}
	public function setName($name){}
	public function getPrice(){}
	public function setPrice($price){}
	public function getDescription(){}
	public function setDescription($desc){}
	public function getAvailability(){}
	public function setAvailability($availability){}
	public function getGroup(){}
	public function setGroup($group){}
	public function addPhoto($path_to_image){}
	public function getPhotos(){}

	public static function getProductsList($group=null){}
	public static function loadProduct($id){}
	public static function deleteProduct($id){}
}
?>