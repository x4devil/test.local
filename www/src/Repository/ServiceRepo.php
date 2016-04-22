<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class HomesteadRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$service = new Entity\Service();
		$service->setId($data['id']);
		$service->setHomestead($data['id_homestead']);
		$service->setIdService($data['id_service']);
		$service->setServiceName($data['service_name']);
		$service->setActive($data['active']);
		$service->setPrice($data['price']);

		return $service;
	}

	public function findByHomestead($homestead) {
		$data = $this->conn->fetchAll(
			'select s.* 
			from homestead_service s
			where s.id_homestead = ?',
			array($homestead);

		$services = array();
		foreach ($data as $service) {
			$services[] = $this->createObject($service);
		}
		return $services;
	}
}