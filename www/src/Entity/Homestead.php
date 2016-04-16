<?php

namespace Selotur\Entity;

class TypeOfTour {
	protected $id;
	protected $region;
	protected $address;

	protected $suplier;
	protected $place;
	protected $type;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getRegion() {
		return $this->region;
	}

	public function setRegion($region) {
		$this->region = $region;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress($address) {
		$this->address = $address;
	}

	public function getSuplier() {
		return $this->suplier;
	}

	public function setSuplier(Selotur\Entity\Suplier $suplier) {
		$this->suplier = $suplier;
	}

	public function getPlace() {
		return $this->place;
	}

	public function setPlace(Selotur\Entity\PlaceOfRest $place) {
		$this->place = $place;
	}

	public function getType() {
		return $this->type;
	}

	public function setType(Selotur\Entity\TypeOfTour $type) {
		$this->type = $type;
	}
}