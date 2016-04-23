<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class RequestRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$request = new Entity\Request();
		$request->setId($data['id']);
		$request->setHouse($data['house_name']);
		$request->setFio($data['fio']);
		$request->setPhone($data['phone']);
		$request->setEmail($data['email']);
		$request->setDate($data['date']);
		$request->setPrice($data['price']);
		$request->setDesc($data['desc']);
		$request->setServices($data['services']);
		$request->setState($data['state']);

		return $request;
	}

	public function findByHomestead($homestead) {
		$data = $this->conn->fetchAll(
			'select r.*, h.name as house_name
			from request r 
			join house h on (h.id = r.id_house)
			where h.id_homestead = ?
			', array($homestead));

		$requests = array();
		foreach ($data as $request) {
			$requests[] = $this->createObject($request);
		}

		return $requests;
	}

	public function updateRequest($id, $data) {
		$this->conn->update('request', $data, $id);
	}
}