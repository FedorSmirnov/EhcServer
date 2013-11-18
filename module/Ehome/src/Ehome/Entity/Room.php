<?php

namespace Ehome\Entity;

class Room {
	
	private $id;
	private $name;
	private $humidity;

	public function exchangeArray($data) {
		$this->id = (! empty ( $data ['id'] )) ? $data ['id'] : null;
		$this->name = (! empty ( $data ['name'] )) ? $data ['name'] : null;
		$this->humidity = (! empty ( $data ['humidity'] )) ? $data ['humidity'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getHumidity(){
		return $this->humidity;
	}
}
