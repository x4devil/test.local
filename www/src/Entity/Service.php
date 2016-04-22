<?php

namespace Selotur\Entity;

class Service {
	protected $id;
	protected $homestead;
	protected $idService;
	protected $serviceName;
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

	public function getIdService() {
		return $this->idService();
	}

	public function setIdService($idService) {
		$this->idService = $idService;
	}

	public function getServiceName() {
		return $this->serviceName;
	}

	public function setServiceName($serviceName) {
		$this->serviceName = $serviceName;
	}

	public function getActiver() {
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