<?php

namespace Selotur\Entity;

class Supplier {
	protected $id;
	protected $fio;
	protected $phone;
	protected $email;
	protected $password;

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

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}
}