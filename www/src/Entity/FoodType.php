<?php
namespace Selotur\Entity;

class FoodType {
	protected $id;
	protected $homestead;
	protected $idFoodType;
	protected $foodTypeName;
	protected $price;
	protected $active;

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

	public function getIdFoodType() {
		return $this->idFoodType();
	}

	public function setIdFoodType($idFoodType) {
		$this->idFoodType = $idFoodType;
	}

	public function getFoodTypeName() {
		return $this->foodTypeName;
	}

	public function setFoodTypeName($foodTypeName) {
		$this->foodTypeName = $foodTypeName;
	}

	public function getActive() {
		return $this->active;
	}

	public function setActive($active) {
		return $this->active = $active;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($price) {
		$this->price = $price;
	}
}