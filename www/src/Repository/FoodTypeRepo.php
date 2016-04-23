<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class FoodTypeRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$service = new Entity\FoodType();
		$service->setId($data['id']);
		$service->setHomestead($data['id_homestead']);
		$service->setIdFoodType($data['id_food_type']);
		$service->setFoodTypeName($data['food_type_name']);
		$service->setActive($data['active']);
		$service->setPrice($data['price']);

		return $service;
	}

	public function findByHomestead($homestead) {
		$data = $this->conn->fetchAll(
			'select ft.* 
			from homestead_food_type ft
			where ft.id_homestead = ?',
			array($homestead));

		$types = array();
		foreach ($data as $type) {
			$types[] = $this->createObject($type);
		}
		return $types;
	}

	public function updateFoodType($id, $data) {
		$this->conn->update('homestead_food_type', $data, $id);
	}
}