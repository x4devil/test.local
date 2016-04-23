<?php

namespace Selotur\Entity;

class SupplierService {
	protected $id;
	protected $homestead;
	protected $name;
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

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($price) {
		$this->price = $price;
	}
}