<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class TourismTypeRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$service = new Entity\TourismType();
		$service->setId($data['id']);
		$service->setHomestead($data['id_homestead']);
		$service->setIdTourismType($data['id_tourism_type']);
		$service->setTourismTypeName($data['tourism_type_name']);
		$service->setActive($data['active']);
		$service->setPrice($data['price']);

		return $service;
	}

	public function findByHomestead($homestead) {
		$data = $this->conn->fetchAll(
			'select tt.* 
			from homestead_tourism_type tt
			where tt.id_homestead = ?',
			array($homestead);

		$types = array();
		foreach ($data as $type) {
			$types[] = $this->createObject($type);
		}
		return $types;
	}
}