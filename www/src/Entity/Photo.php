<?php
namespace Selotur\Entity;

class Photo {
	protected $id;
	protected $path;
	protected $house;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getPath()  {
		return $this->photo;
	}

	public function setPath($path) {
		$this->path = $path;
	}

	public function getHouse() {
		return $this->house;
	}

	public function setHouse($house) {
		$this->house = $house;
	}
}