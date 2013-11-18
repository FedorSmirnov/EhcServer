<?php

namespace Ehome\Controller;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
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
		$session = new Container('session');
		$viewType = $session->viewType;
		//Debug::dump(($session->viewType == 'functional'));
// 		if ($session->viewType == 'functional'){ // TODO create const
// 			//Debug::dump("BP");
// 			$this->redirect()->toRoute('home', array('action' => 'functional'));
// 		} else if ($session->viewType == 'room'){ // room
// 			$this->redirect()->toRoute('home', array('action' => 'room'));
// 		} else {
// 			throw new \Exception("No corresponding index view!");
// 		}
		// user
		$user = $this->zfcUserAuthentication()->getIdentity();
		$email = $user->getEmail();
		// CRUD rooms
		// get room entities
		$rooms = $this->getRoomTable()->fetchAll();
		$dbgrooms = $this->getRoomTable()->fetchAll();
		
		// picture vars
		$light_bath = true;
		$light_kitchen = true;
		$light_living = false;
		
		return new ViewModel(
				array(
						'rooms' => $rooms,
						'dbgrooms' => $dbgrooms,
						'useremail' => $email,
						'light_bath' => $light_bath,
						'light_kitchen' => $light_kitchen,
						'light_living' => $light_living
				));
	}
	public function tempAction(){
		// clear session and log out
		$session = new Container('session');
		$session->getManager()->getStorage()->clear('session');
		$this->redirect()->toRoute('zfcuser/logout');
	}
	public function functionalAction(){
		throw new \Exception("No corresponding index view!");
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
	
	public function roomAction(){
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
		$roomForm = new RoomForm(); 
		//$roomId = ( int ) $this->params()->fromRoute('id', 0);
		$message = "";
		if ($this->getRequest()->isPost()){ // form was submitted
			$roomForm->setData($this->getRequest()->getPost());
			if ($roomForm->isValid()){
				//Debug::dump($roomForm->getData());
				//throw new \Exception("BP");
				$formData = $roomForm->getData();
				$roomId = ( int ) $this->params()->fromRoute('id', 0);
				$room = $this->getRoomTable()->getRoom($roomId);
				$room->name = $formData['name']; // TODO use accessor methods
				$room->humidity = $formData['humidity'];
				$this->getRoomTable()->saveRoom($room);
				// return $this->redirect()->toRoute('home');
			}
		} else { // show form
			//$roomId = (int) $this->params()->fromRoute('id', 0);
			$roomId = (int) $this->params()->fromRoute('id', 0);
			$room = $this->getRoomTable()->getRoom($roomId);
			//Debug::dump($room);
			$roomForm->bind($room);
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