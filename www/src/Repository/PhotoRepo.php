<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class PhotoRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$house = new Entity\Photo();
		$house->setId($data['id']);
		$house->setPath($data['path']);
		$house->setHouse($data['id_house']);
		return $house;
	}

	public function findByHouse($house) {
		$data = $this->conn->fetchAll('
			select p.*
			from photo p
			where p.id_house = ?
			limit 4',
			array($house));
		if (count($data) <= 0) {
			return NULL;
		}
		$photos = array();
		foreach ($data as $photo) {
			$photos[] = $this->createObject($photo);
		}
		return $photos;
	}

	public function insertPhoto($data) {
		$this->conn->insert('photo', $data);
	}

	public function deletePhoto($id) {
		$this->conn->delete('photo', $id);
	}
}