<?php

namespace Ehome\Entity;

class Room {
	
	private $id;
	private $name;
	private $lightone; // value from 0 to 100 percent
	private $lighttwo;
	private $humidity;

	public function exchangeArray($data) {
		$this->id = (! empty ( $data ['id'] )) ? $data ['id'] : null;
		$this->name = (! empty ( $data ['name'] )) ? $data ['name'] : null;
		$this->humidity = (! empty ( $data ['humidity'] )) ? $data ['humidity'] : null;
		$this->lightone = (! empty ( $data ['lightone'] )) ? $data ['lightone'] : null;
		$this->lighttwo = (! empty ( $data ['lighttwo'] )) ? $data ['lighttwo'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function getHumidity(){
		return $this->humidity;
	}
	
	public function setHumidity($humidity){
		$this->humidity = $humidity;
	}
	
	public function getLightone(){
		return $this->lightone;
	}
	
	public function setLightone($value){
		$this->lightone = $value;
	}
	
	public function getLighttwo(){
		return $this->lighttwo;
	}
	
	public function setLighttwo($value){
		$this->lighttwo = $value;
	}
}
