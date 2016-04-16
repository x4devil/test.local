<?php

namespace Selotur\Entity;

class House {
	protected $id;
	protected $name;
	protected $description;
	protected $places;
	protected $homestead;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getPlaces() {
		return $this->places;
	}

	public function setPlaces($places) {
		$this->places = $places;
	}

	public function getHomestead() {
		return $this->homestead;
	}

	public function setHomestead(Selotur\Entity\Homestead $homestead) {
		$this->homestead = $homestead;
	}
}