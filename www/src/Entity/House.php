<?php

namespace Selotur\Entity;

class House {
	protected $id;
	protected $price; //Цена за место
	protected $place; //Количество мест
	protected $homestead; //ИД базы
	protected $description; //Описание
	protected $name; //Название
	protected $emptyPlace; //Количество пустых
	protected $liveType; //Тип проживания
	protected $photos; //Фотографии

	public function getId() {
		return (int)$this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

	public function getPlace() {
		return $this->place;
	}

	public function setPlace($place) {
		$this->place = $place;
	}

	public function getHomestead() {
		return $this->homestead;
	}

	public function setHomestead($homestead) {
		$this->homestead = $homestead;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getEmptyPlace() {
		return $this->emptyPlace;
	}

	public function setEmptyPlace($emptyPlace) {
		$this->emptyPlace = $emptyPlace;
	}

	public function getLiveType() {
		return $this->liveType;
	}

	public function setLiveType(LiveType $liveType) {
		$this->liveType = $liveType;
	}

	public function getPhotos() {
		return $this->photos;
	}

	public function setPhotos($photos) {
		$this->photos = $photos;
	}
}