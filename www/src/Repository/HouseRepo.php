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
		$house->setLiveType($liveType);
		$photos = $this->app['photo_repo']->findByHouse($data['id']);
		$house->setPhotos($photos);
		$house->setSpring($data['spring']);
		$house->setSummer($data['summer']);
		$house->setAutumn($data['autumn']);
		$house->setWinter($data['winter']);
		return $house;
	}

	public function createArray($data) {
		$house['price'] = $data['price'];
		$house['place'] = $data['place'];
		$house['id_homestead'] = $data['id_homestead'];
		$house['description'] = $data['description'];
		$house['name'] = $data['name'];
		$house['empty_place'] = $data['empty_place'];
		$house['id_live_type'] = $data['id_live_type'];
		$house['spring'] = $data['spring'] != NULL ? 1 : 0;
		$house['summer'] = $data['summer'] != NULL ? 1 : 0;
		$house['autumn'] = $data['autumn'] != NULL ? 1 : 0;
		$house['winter'] = $data['winter'] != NULL ? 1 : 0;
		return $house;
	}

	public function insertHouse($data) {
		$this->conn->insert('house', $data);
	}

	public function updateHouse($data, $id) {
		$this->conn->update('house', $data, array('id'=>$id));
	}

	public function deleteHouse($id) {
		$this->conn->delete('house', array('id'=>$id));
	}

	public function changeEmptyPlace($id, $emptyPlace) {
		$this->conn->update('house', 
			array('empty_place' => $emptyPlace), 
			array('id' => $id));
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

	public function findById($id) {
		$data = $this->conn->fetchAssoc('
			select h.* 
			from house h 
			where h.id = ?',
			array($id));

		if ($data['id'] == NULL) {
			return NULL;
		}
		return $this->createObject($data);
	}

	public function findByParams($name, $email) {
		$data = $this->conn->fetchAll('
			select h.* 
			from house h 
			where h.name = ?',
			array($name, $email));

		$types = array();
		foreach ($data as $type) {
			$types[] = $this->createObject($type);
		}
		return $types;
	}
	
}