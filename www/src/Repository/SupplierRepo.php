<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class SupplierRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$supplier = new Entity\Supplier();
		$supplier->setId($data['id']);
		$supplier->setFio($data['fio']);
		$supplier->setPhone($data['phone']);
		$supplier->setEmail($data['email']);
		$supplier->setPassword($data['password']);

		return $supplier;
	}

	public function findByEmail($email) {
		$data = $this->conn->fetchAll(
			'select s.* 
			from supplier s 
			where s.email like ?',
			array($email));
		if (count($data) > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function findByEmailAndPasssword($email, $password) {
		$data = $this->conn->fetchAssoc(
			'select s.* 
				from supplier s 
				where s.email like ?
					and s.password like ?', 
			array((string)$email, (string)$password));
		if ($data['id'] == NULL) {
			return NULL;
		}
		return $this->createObject($data);
	}
	
	public function findById($id) {
		$data = $this->conn->fetchAssoc(
			'select s.* 
				from supplier s 
				where s.id = ?', 
			array($id));
		if ($data['id'] == NULL) {
			return NULL;
		}
		return $this->createObject($data);
	}
}