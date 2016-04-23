<?php

namespace Selotur\Entity;

class TourismType {
	protected $id;
	protected $homestead;
	protected $idTourismType;
	protected $tourismTypeName;
	protected $active;
	protected $price;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getHomestead() {
		return $this->homestead;
	}

	public function setHomestead($homestead){
		$this->homestead = $homestead;
	}

	public function getIdTourismType() {
		return $this->idTourismType();
	}

	public function setIdTourismType($idTourismType) {
		$this->idTourismType = $idTourismType;
	}

	public function getTourismTypeName() {
		return $this->tourismTypeName;
	}

	public function setTourismTypeName($tourismTypeName) {
		$this->tourismTypeName = $tourismTypeName;
	}

	public function getActive() {
		return $this->active;
	}

	public function setActive($active) {
		return $this->active = $active;
	}

	public function getPrice() {
		$this->price = $price;
	}

	public function setPrice($price) {
		$this->price = $price;
	}
}