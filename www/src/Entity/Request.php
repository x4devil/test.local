<?php
namespace Selotur\Entity;

class Request {
	protected $id;
	protected $fio;
	protected $phone;
	protected $email;
	protected $date;
	protected $price;
	protected $desc;
	protected $services;
	protected $state;
	protected $house;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	} 

	public function getFio() {
		return $this->fio;
	}

	public function setFio($fio) {
		$this->fio = $fio;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

	public function getDesc() {
		return $this->desc;
	}

	public function setDesc($desc) {
		$this->desc = $desc;
	}

	public function getServices() {
		return $this->services;
	}

	public function setServices($services) {
		$this->services = $services;
	}

	public function getState() {
		return $this->state;
	}

	public function setState($state) {
		$this->state = $state;
	}

	public function getHouse() {
		return $this->house;
	}

	public function setHouse($house) {
		$this->house = $house;
	}
}