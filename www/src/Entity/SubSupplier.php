<?php
namespace Selotur\Entity;

class SubSupplier {
	protected $id;
	protected $fio;
	protected $service;
	protected $price;
	protected $supplier;
	

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getFio() {
		return $this->fio;
	}

	public function setFio($fio){
		$this->fio = $fio;
	}

	public function getService() {
		return $this->service;
	}

	public function setService($service) {
		$this->service = $service;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

	public function getSupplier() {
		return $supplier;
	}

	public function setSupplier($supplier) {
		$this->supplier = $supplier;
	}
}