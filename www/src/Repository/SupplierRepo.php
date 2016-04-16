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
		$supplier->setId('id');
		$supplier->setFio('fio');
		$supplier->setPhone('phone');
		$supplier->setEmail('email');
		$supplier->setPassword('password');

		return $supplier;
	}

	public function findByEmailAndPasssword($email, $password) {
		$queryBuilder = $this->conn->createQueryBuilder();
		$data = $this->conn->fetchAssoc(
			'select s.* 
				from supplier s 
				where s.email like ?
					and s.password = ?', 
			array((string)$email, (string)$password));

		if ($data['id'] == NULL) {
			return NULL;
		}
		return $this->createObject($data);
	}
}