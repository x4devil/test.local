<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class HomesteadRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createSupplier($email, $phone, $fio, $password) {
		$data['email'] = $email;
		$data['phone'] = $phone;
		$data['fio'] = $fio;
		$data['password'] = $password;
		$this->conn->insert('supplier', $data);

		$idSupplier = $this->conn->fetchColumn(
			'select max(s.id) from supplier s');

		$data = array();
		$data['id_supplier'] = $idSupplier;
		$this->conn->insert('homestead', $data);

		$idHomestead = $this->conn->fetchColumn(
			'select max(h.id) from homestead h');

		$tourismTypes = $this->conn->fetchAll(
			'select tt.id, tt.name from tourism_type tt');

		foreach ($tourismTypes as $idTourismType) {
			$this->conn->insert('homestead_tourism_type', 
				array(
					'id_homestead' => $idHomestead,
					'id_tourism_type' => $idTourismType['id'],
					'tourism_type_name' => $idTourismType['name'],
					'active' => false,
					'price' => 0
					));
		}

		$services = $this->conn->fetchAll(
			'select s.id, s.name from service s');

		foreach ($services as $idService) {
			$this->conn->insert('homestead_service', 
				array(
					'id_homestead' => $idHomestead,
					'id_service' => $idService['id'],
					'service_name' => $idService['name'],
					'active' => false,
					'price' => 0
					));
		}

		$foodTypes = $this->conn->fetchAll(
			'select ft.id, ft.name from food_type ft');
		foreach ($foodTypes as $foodType) {
			$this->conn->insert('homestead_food_type',
				array(
					'id_homestead' => $idHomestead,
					'id_food_type' => $foodType['id'],
					'food_type_name' => $foodType['name'],
					'active' => false,
					'price' => 0
					));
		}

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