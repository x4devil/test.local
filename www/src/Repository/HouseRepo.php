<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class HouseRepo {
	protected $app;
	protected $conn;

	public function __construct($conn, $app) {
		$this->conn = $conn;
		$this->app = $app;
	}

	public function createObject($data) {
		$house = new Entity\House();
		$house->setId($data['id']);
		$house->setPrice($data['price']);
		$house->setPlace($data['place']);
		$house->setHomestead($data['id_homestead']);
		$house->setDescription($data['description']);
		$house->setName($data['name']);
		$house->setEmptyPlace($data['empty_place']);

		$liveType = $this->app['live_type_repo']->findById($data['id_live_type']);
		//$house->setLiveType($liveType);
		$photos = $this->app['photo_repo']->findByHouse($data['id']);
		$house->setPhotos($photos);
		return $house;
	}

	public function createArray($data) {
		//$house['id'] = $data['id'];
		$house['price'] = $data['price'];
		$house['place'] = $data['place'];
		$house['id_homestead'] = $data['id_homestead'];
		$house['description'] = $data['description'];
		$house['name'] = $data['name'];
		$house['empty_place'] = $data['empty_place'];
		$house['id_live_type'] = $data['id_live_type'];
		return $house;
	}

	public function insertHouse($data) {
		$this->conn->insert('house', $data);
	}

	public function findByHomestead($homestead) {
		$data = $this->conn->fetchAll('
			select h.* 
			from house h 
			where h.id_homestead = ?
			order by h.name',
			array($homestead));
		if (count($data) <= 0) {
			return NULL;
		}
		$houses = array();
		foreach ($data as $house) {
			$houses[] = $this->createObject($house);
		}
		return $houses;
	}
	
}