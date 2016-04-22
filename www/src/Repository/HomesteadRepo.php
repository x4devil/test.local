<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class HomesteadRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$homestead = new Entity\Homestead();
		$homestead->setId($data['id']);
		$homestead->setSupplier($data['id_supplier']);
		$homestead->setRegion($data['id_region']);
		$homestead->setAddress($data['address']);
		$homestead->setArea($data['area']);

		return $homestead;
	}

	public function updateHomestead($data, $id) {
		$this->conn->update('homestead', $data, array('id'=>$id));
	}


	public function findBySupplier($supplier) {
		$data = $this->conn->fetchAssoc('
			select h.*
			from homestead h
			where h.id_supplier = ?',
			array($supplier));
		if ($data['id'] == NULL) {
			return NULL;
		}
		return $this->createObject($data);
	}
}