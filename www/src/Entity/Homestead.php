<?php

namespace Selotur\Entity;

class Homestead {
	protected $id;
	protected $suplier;
	protected $region;
	protected $address;
	protected $area;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getSupplier() {
		return $this->suplier;
	}

	public function setSupplier($suplier) {
		$this->suplier = $suplier;
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

	public function getArea() {
		return $this->area;
	}

	public function setArea($area) {
		return $this->area = $area;
	}
}