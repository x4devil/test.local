<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class RegionRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$place = new Entity\Place();
		$place->setId($data['id']);
		$place->setName($data['name']);
		$place->setDescription($data['description']);

		return $place;
	}

	public function findByName($name) {
		$data = $this->conn->fetchAll('
			select r.* 
			from region r
			where r.name like \'%?%\'
			order by r.name',
			array($name));

		$places = array();
		foreach ($data as $place) {
			$places[$place['id']] = $this->createObject($place);
		}
		return $places;
	}

	public function findAll() {
		$data = $this->conn->fetchAll('
			select r.* 
			from region r
			order by r.name');
		$places = array();
		foreach ($data as $place) {
			$places[$place['id']] = $this->createObject($place);
		}
		return $places;
	}
}