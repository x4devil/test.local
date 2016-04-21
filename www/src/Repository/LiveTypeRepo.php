<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class LiveTypeRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$house = new Entity\LiveType();
		$house->setId($data['id']);
		$house->setName($data['name']);
		return $house;
	}

	public function findAll() {
		$data = $this->conn->fetchAll('
			select lt.* 
			from live_type lt 
			order by ft.name');

		if (count($data) <= 0) {
			return NULL;
		}
		$liveTypes = array();
		foreach ($data as $type) {
			$liveTypes[] = $this->createObject($type);
		}
		return $liveTypes;
	}

	public function findById($id) {
		$data = $this->conn->fetchAssoc('
			select lt.* 
			from live_type lt
			where lt.id = ?',
			array($id));
		return $this->createObject($data);
	}

}