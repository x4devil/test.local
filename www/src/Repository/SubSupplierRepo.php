<?php

namespace Selotur\Repository;
use \Selotur\Entity as Entity;

class SubSupplierRepo {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function createObject($data) {
		$sub = new Entity\SubSupplier();
		$sub->setId($data['id']);
		$sub->setFio($data['fio']);
		$sub->setService($data['service']);
		$sub->setPrice($data['price']);
		$sub->setSupplier($data['id_supplier']);

		return $sub;
	}

	public function findBySupplier($supplier) {
		$data = $this->conn->fetchAll(
			'select s.*
			from sub_supplier s
			where s.id_supplier = ?',
			array($supplier));
		$subs = array();
		foreach ($data as $sub) {
			$subs[] = $this->createObject($sub);
		}
		return $subs;
	}

	public function findById($id) {
		$data = $this->conn->fetchAll(
			'select s.*
			from sub_supplier s
			where s.id = ?',
			array($id));
		return $this->createObject($data);
	}

	public function insertSub($data) {
		$this->conn->insert('sub_supplier', $data);
	}

	public function updateSub($id, $data) {
		$this->conn->update('sub_supplier', $data, $id);
	}

	public function deleteSub($id) {
		$this->conn->delete('sub_supplier', $id);
	} 
}