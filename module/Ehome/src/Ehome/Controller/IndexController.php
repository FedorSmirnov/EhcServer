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
		if (! $this->zfcUserAuthentication ()->hasIdentity ()) { // check for valid session
			return $this->redirect ()->toRoute ( static::ROUTE_LOGIN );
		}
		// pick corresponding view 
		$session = new Container("session");
		$viewType = $session->viewType;
		if ($viewType == "functional"){
			return $this->redirect()->toRoute('home', array(
				'action' => 'indexfunctional' 
			));
		} else if ($viewType == "room"){
			return $this->redirect ()->toRoute('home', array(
				'action' => 'indexroom'
			));
		} else {
			throw new \Exception("Problem with the session settings.");
		}
		
		// scenario: submit button
// 		$user = $this->zfcUserAuthentication()->getIdentity();
// 		$email = $user->getEmail();
// 		$rooms = $this->getRoomTable()->fetchAll();
// 		$lightoneBath = false;
// 		$lighttwoBath = false;
// 		$lightoneKitchen = false;
// 		$lighttwoKitchen = false;
// 		$lightoneLivingRoom = false;
// 		$lighttwoLivingRoom = false;
// 		$rooms->buffer();
// 		foreach($rooms as $room){
// 			$id = $room->getId();
// 			if ($id == 3){
// 				$lightoneBathValue = $room->getLightone();
// 				$lighttwoBathValue = $room->getLighttwo();
// 				if ($lightoneBathValue == 100){
// 					$lightoneBath = true;
// 				}
// 				if ($lighttwoBathValue == 100){
// 					$lighttwoBath = true;
// 				}
// 			} else if ($id == 1){ // kitchen
// 				//Debug::dump($room);
// 				$lightoneKitchenValue = $room->getLightone();
// 				$lighttwoKitchenValue = $room->getLighttwo();
// 				if ($lightoneKitchenValue == 100){
// 					$lightoneKitchen = true;
// 				}
// 				if ($lighttwoKitchenValue == 100){
// 					$lighttwoKitchen = true;
// 				}
// 			} else if ($id == 2){
// 				$lightoneLivingRoomValue = $room->getLightone();
// 				$lighttwoLivingRoomValue = $room->getLighttwo();
// 				if ($lightoneLivingRoomValue == 100){
// 					$lightoneLivingRoom = true;
// 				}
// 				if ($lighttwoLivingRoomValue == 100){
// 					$lighttwoLivingRoom = true;
// 				}
// 			} else {}
// 		}
// 		return new ViewModel(
// 				array(
// 						'rooms' => $rooms,
// 						'useremail' => $email,
// 						'lightoneBath' => $lightoneBath,
// 						'lighttwoBath' => $lighttwoBath,
// 						'lightoneKitchen' => $lightoneKitchen,
// 						'lighttwoKitchen' => $lighttwoKitchen,
// 						'lightoneLivingRoom' => $lightoneLivingRoom,
// 						'lighttwoLivingRoom' => $lighttwoLivingRoom
// 				));
	}
	
	public function indexroomAction(){
		if (! $this->zfcUserAuthentication ()->hasIdentity ()) { // check for valid session
			return $this->redirect ()->toRoute ( static::ROUTE_LOGIN );
		}
		$user = $this->zfcUserAuthentication ()->getIdentity ();
		$email = $user->getEmail ();
		$rooms = $this->getRoomTable ()->fetchAll ();
		$lightoneBath = false;
		$lighttwoBath = false;
		$lightoneKitchen = false;
		$lighttwoKitchen = false;
		$lightoneLivingRoom = false;
		$lighttwoLivingRoom = false;
		$rooms->buffer();
		foreach ($rooms as $room){
			$id = $room->getId ();
			if ($id == 3){
				$lightoneBathValue = $room->getLightone ();
				$lighttwoBathValue = $room->getLighttwo ();
				if ($lightoneBathValue == 100) {
					$lightoneBath = true;
				}
				if ($lighttwoBathValue == 100) {
					$lighttwoBath = true;
				}
			} else if ($id == 1) { // kitchen
				$lightoneKitchenValue = $room->getLightone ();
				$lighttwoKitchenValue = $room->getLighttwo ();
				if ($lightoneKitchenValue == 100) {
					$lightoneKitchen = true;
				}
				if ($lighttwoKitchenValue == 100) {
					$lighttwoKitchen = true;
				}
			} else if ($id == 2) {
				$lightoneLivingRoomValue = $room->getLightone ();
				$lighttwoLivingRoomValue = $room->getLighttwo ();
				if ($lightoneLivingRoomValue == 100) {
					$lightoneLivingRoom = true;
				}
				if ($lighttwoLivingRoomValue == 100) {
					$lighttwoLivingRoom = true;
				}
			} else {
			}
		}
		return new ViewModel ( array (
				'rooms' => $rooms,
				'useremail' => $email,
				'lightoneBath' => $lightoneBath,
				'lighttwoBath' => $lighttwoBath,
				'lightoneKitchen' => $lightoneKitchen,
				'lighttwoKitchen' => $lighttwoKitchen,
				'lightoneLivingRoom' => $lightoneLivingRoom,
				'lighttwoLivingRoom' => $lighttwoLivingRoom
		) );
	}
	public function indexfunctionalAction(){
				if (! $this->zfcUserAuthentication ()->hasIdentity ()) { // check for valid session
			return $this->redirect ()->toRoute ( static::ROUTE_LOGIN );
		}
		$user = $this->zfcUserAuthentication ()->getIdentity ();
		$email = $user->getEmail ();
		$rooms = $this->getRoomTable ()->fetchAll ();
		$lightoneBath = false;
		$lighttwoBath = false;
		$lightoneKitchen = false;
		$lighttwoKitchen = false;
		$lightoneLivingRoom = false;
		$lighttwoLivingRoom = false;
		$rooms->buffer();
		foreach ($rooms as $room){
			$id = $room->getId ();
			if ($id == 3){
				$lightoneBathValue = $room->getLightone ();
				$lighttwoBathValue = $room->getLighttwo ();
				if ($lightoneBathValue == 100) {
					$lightoneBath = true;
				}
				if ($lighttwoBathValue == 100) {
					$lighttwoBath = true;
				}
			} else if ($id == 1) { // kitchen
				$lightoneKitchenValue = $room->getLightone ();
				$lighttwoKitchenValue = $room->getLighttwo ();
				if ($lightoneKitchenValue == 100) {
					$lightoneKitchen = true;
				}
				if ($lighttwoKitchenValue == 100) {
					$lighttwoKitchen = true;
				}
			} else if ($id == 2) {
				$lightoneLivingRoomValue = $room->getLightone ();
				$lighttwoLivingRoomValue = $room->getLighttwo ();
				if ($lightoneLivingRoomValue == 100) {
					$lightoneLivingRoom = true;
				}
				if ($lighttwoLivingRoomValue == 100) {
					$lighttwoLivingRoom = true;
				}
			} else {
			}
		}
		return new ViewModel ( array (
				'rooms' => $rooms,
				'useremail' => $email,
				'lightoneBath' => $lightoneBath,
				'lighttwoBath' => $lighttwoBath,
				'lightoneKitchen' => $lightoneKitchen,
				'lighttwoKitchen' => $lighttwoKitchen,
				'lightoneLivingRoom' => $lightoneLivingRoom,
				'lighttwoLivingRoom' => $lighttwoLivingRoom
		) );
	}
	
	public function editroomAction() {
		$roomForm = new RoomForm(); 
		$roomId = (int) $this->params()->fromRoute('id', 0);
		$message = "";
		if ($this->getRequest()->isPost()){ // form was submitted
			$roomForm->setData($this->getRequest()->getPost());
			// Problem with checkboxes
			//$data = $roomForm->setAttribute($key, $value);
// 			$valueLightOne = $roomForm->get('lightone');
// 			$valueLightTwo = $roomForm->get('lighttwo');
// 			if ($valueLightOne != null){
// 				Debug::dump("BP11");
// 				$roomForm->get('lightone')->setValue("100");
// 			} else {
// 				Debug::dump("BP10");
// 				$roomForm->get('lightone')->setValue("0");
// 			}
// 			if ($valueLightTwo != null){
// 				Debug::dump("BP21");
// 				$roomForm->get('lighttwo')->setValue("100");
// 			} else {
// 				Debug::dump("BP20");
// 				$roomForm->get('lighttwo')->setValue("0");
// 			}
// 			Debug::dump($roomForm->isValid());
			if ($roomForm->isValid()){
				$formData = $roomForm->getData();
				$room = $this->getRoomTable()->getRoom($roomId);
				$room->setName($formData['name']);
				$room->setHumidity($formData['humidity']);
				$room->setLightone($formData['lightone']);
				$room->setLighttwo($formData['lighttwo']);
				$this->getRoomTable()->saveRoom($room);
				return $this->redirect()->toRoute('home');
			}
		} else { // show form
			$room = $this->getRoomTable()->getRoom($roomId);
			$roomForm->bind($room);
			// checkbox-problems
// 			$lightOneValue = $room->getLightone();
// 			if ($lightOneValue == "100"){
// 				Debug::dump('11');
// 				$roomForm->get('lightone')->setChecked(true);
// 			} else {
// 				Debug::dump('10');
// 				$roomForm->get('lightone')->setChecked(false);
// 			}
// 			$lightTwoValue = $room->getLighttwo();
// 			if ($lightTwoValue == "100"){
// 				Debug::dump('21');
// 				$roomForm->get('lighttwo')->setChecked(true);
// 			} else {
// 				Debug::dump('20');
// 				$roomForm->get('lighttwo')->setChecked(false);
// 			}
			//Debug::dump($room);
			//Debug::dump($roomForm);
		}
		return new ViewModel(array(
			'form' => $roomForm,
		));
	}
	public function logoutAction() {
		$session = new Container ( 'session' );
		$session->getManager ()->getStorage ()->clear ( 'session' );
		return $this->redirect ()->toRoute ( 'zfcuser/logout' );
	}
	
	public function getRoomTable() {
		if (!$this->roomTable) {
			$sm = $this->getServiceLocator();
			$this->roomTable = $sm->get('Ehome\Entity\RoomTable');
		}
		return $this->roomTable;
	}
	
	// DEVELOPMENT AREA
	public function tempAction(){
		// clear session and log out
		//$session = new Container('session');
		//$viewType = $session->viewType;
		//Debug::dump(($session->viewType == 'functional'));
		// 		if ($session->viewType == 'functional'){ // TODO create const
		// 			//Debug::dump("BP");
		// 			$this->redirect()->toRoute('home', array('action' => 'functional'));
		// 		} else if ($session->viewType == 'room'){ // room
		// 			$this->redirect()->toRoute('home', array('action' => 'room'));
		// 		} else {
		// 			throw new \Exception("No corresponding index view!");
		// 		}
	
		//Debug::dump($roomForm->getData());
		//throw new \Exception("BP");
	
		// return $this->redirect()->toRoute('home');
	
		// logout and clear session
		$session = new Container('session');
		$session->getManager()->getStorage()->clear('session');
		$this->redirect()->toRoute('zfcuser/logout');
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
		// 		// Bind: tut die Daten aus dem Modell in die Form und am Ende des Vorgangs wieder zur�ck
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
}
?>