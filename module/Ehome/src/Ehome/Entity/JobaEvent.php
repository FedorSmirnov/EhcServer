<?php

namespace Ehome\Entity;

class JobaEvent {
	private $id;
	private $name; // infotext
	private $type; // vital, message
	private $start; // start time timestamp
	private $end;  // targeted time timestamp 
	private $done; // bool

	public function exchangeArray($data) {
		$this->id = (! empty ( $data ['id'] )) ? $data ['id'] : null;
		$this->name = (! empty ( $data ['name'] )) ? $data ['name'] : null;
		$this->type = (! empty ( $data ['type'] )) ? $data ['type'] : null;
		$this->start= (! empty ( $data ['start'] )) ? $data ['start'] : null;
		$this->end = (! empty ( $data ['end'] )) ? $data ['end'] : null;
		$this->done = (! empty ( $data ['done'] )) ? $data ['done'] : null;
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

	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function getStart(){
		return $this->start;
	}

	public function setStart($start){
		$this->start = $start;
	}

	public function getEnd(){
		return $this->end;
	}

	public function setEnd($end){
		$this->end = $end;
	}

	public function getDone(){
		return $this->done;
	}

	public function setDone($done){
		$this->done = $done;
	}
}
