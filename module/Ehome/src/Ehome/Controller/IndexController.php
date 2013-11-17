<?php

namespace Ehome\Controller;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Ehome\Form\RoomForm;

class IndexController extends AbstractActionController {
	
	protected $roomTable;
	const ROUTE_LOGIN = 'zfcuser/login';
	
	public function indexAction(){
		// check if logged in 
		if (!$this->zfcUserAuthentication()->hasIdentity()){ // check for valid session
			return $this->redirect ()->toRoute(static::ROUTE_LOGIN);
		}
		
		// user 
		$user = $this->zfcUserAuthentication()->getIdentity();
		$email = $user->getEmail();
		
		// CRUD rooms
		// get room entities
		$rooms = $this->getRoomTable()->fetchAll();
		$dbgrooms = $this->getRoomTable()->fetchAll();
		return new ViewModel(
				array(
						'rooms' => $rooms, 
						'dbgrooms' => $dbgrooms,
						'useremail' => $email
		));
	}
	
	public function editroomAction() {
		//Debug::dump("4");
		
		$roomForm = new RoomForm(); 
		$message = "";
		
		if ($this->getRequest()->isPost()){
			$roomForm->setData($this->getRequest()->getPost());
			if ($roomForm->isValid()){
				Debug::dump($roomForm->getData());
// 				$roomId = 2;
// 				$room = $this->getRoomTable()->getRoom($roomId);
// 				$room->setName();
// 				$room->setHumidity();
// 				$this->getRoomTable()->saveRoom($room);
				
			}
		}
		
		return new ViewModel(array(
			'form' => $roomForm,
		));
// 		$id = (int) $this->params ()->fromRoute('id', 0);
// 		if (!$id) {
// 			return $this->redirect ()->toRoute( 'home', array (
// 					'action' => 'add'
// 			));
// 		}
// 		try {
// 			$room = $this->getRoomTable()->getRoom($id);
// 		} catch ( \Exception $ex ) {
// 			return $this->redirect ()->toRoute('home', array (
// 					'action' => 'index'
// 			) );
// 		}
	
// 		$form = new RoomForm();
// 		// Bind: tut die Daten aus dem Modell in die Form und am Ende des Vorgangs wieder zurück
// 		$form->bind($room);
// 		$form->get('submit')->setAttribute('value', 'Edit');
// 		$request = $this->getRequest();
// 		if ($request->isPost()){ // form was submitted
// 			$form->setInputFilter($room->getInputfilter());
// 			$form->setData($request->getPost());
// 			if ($form->isValid()) { // save 
// 				$this->getRoomTable()->saveRoom($room);
// 				return $this->redirect()->toRoute('home');
// 			}
// 		}
// 		return array (
// 				'id' => $id,
// 				'form' => $form
// 		);
	}
	
	public function getRoomTable() {
		if (!$this->roomTable) {
			$sm = $this->getServiceLocator();
			$this->roomTable = $sm->get('Ehome\Entity\RoomTable');
		}
		return $this->roomTable;
	}
	
}


?>