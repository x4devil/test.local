<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class SupplierServiceRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$service = new Entity\SupplierService();
		$service->setId($data['id']);
		$service->setHomestead($data['id_homestead']);
		$service->setName($data['name']);
		$service->setPrice($data['price']);

		return $service;
	}

	public function findByHomestead($homestead) {
		$data = $this->conn->fetchAll(
			'select s.* 
			from supplier_service s
			where s.id_homestead = ?',
			array($homestead));

		$services = array();
		foreach ($data as $service) {
			$services[] = $this->createObject($service);
		}
		return $services;
	}

	public function findById($id) {
		$data = $this->conn->fetchAssoc(
			'select s.* 
			from supplier_service s
			where s.id = ?',
			array($id));
		if ($data['id'] == NULL) {
			return NULL;
		}
		return $this->createObject($data);
	}

	public function updateService($id, $data) {
		$this->conn->update('supplier_service', $data, $id);
	}

	public function insertService($data) {
		$this->conn->insert('supplier_service', $data);
	}

	public function deleteService($id) {
		$this->conn->delete('supplier_service', array('id'=>$id));
	}
}