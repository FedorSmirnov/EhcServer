<?php

namespace Ehome\Entity;

use Zend\Db\TableGateway\TableGateway;

class JobaEventTable {

	protected $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll(){
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getEvent($id){
		$id = (int) $id;
		$rowset = $this->tableGateway->select( array(
				'id' => $id
		));
		$row = $rowset->current();
		if (! $row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}

	public function saveEvent(JobaEvent $event){
		$data = array (
				'name' => $event->getName(),
				'value' => $event->getValue(),
				'type' => $event->getType(),
				'start' => $event->getStart(),
				'end' => $event->getEnd(),
				'done' => $event->getDone()
		);
		$id = (int) $event->getId();
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getEvent($id)){
				$this->tableGateway->update($data, array (
						'id' => $id
				) );
			} else {
				throw new \Exception('Room id does not exist');
			}
		}
	}
	
	public function deleteEvent($id){
		$this->tableGateway->delete(array(
				'id' => (int) $id
		) );
	}
}