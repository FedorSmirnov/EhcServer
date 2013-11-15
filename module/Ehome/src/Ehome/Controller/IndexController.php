<?php

namespace Ehome\Controller;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
	protected $roomTable;
	
	public function getRoomTable() {
		if (!$this->roomTable) {
             $sm = $this->getServiceLocator();
             $this->roomTable = $sm->get('Ehome\Entity\RoomTable');
         }
         return $this->roomTable;
     }
	
	public function indexAction(){
		$rooms = $this->getRoomTable()->fetchAll();
		return new ViewModel(
			array('rooms' => $rooms)
		);
	}
	
}


?>