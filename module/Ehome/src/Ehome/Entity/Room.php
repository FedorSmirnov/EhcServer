<?php

namespace Ehome\Entity;

class Room {
	
	public $id;
	public $name;
	public $humidity;
	
	public function exchangeArray($data) {
		$this->id = (! empty ( $data ['id'] )) ? $data ['id'] : null;
		$this->name = (! empty ( $data ['name'] )) ? $data ['name'] : null;
		$this->humidity = (! empty ( $data ['humidity'] )) ? $data ['humidity'] : null;
	}
	
	// TODO write accessor methods
}
