<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class FoodTypeRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$house = new Entity\FoodType();
		$house->setId($data['id']);
		$house->setName($data['name']);
		return $house;
	}

	public function findAll() {
		$data = $this->conn->fetchAll('
			select ft.* 
			from food_type ft 
			order by ft.name');
		return $this->createObject($data);
	}
}