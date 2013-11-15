<?php

namespace Ehome\Controller;

use ZfcUser\Controller\UserController;
use Zend\Session\Container;
use Zend\View\Helper\ViewModel;
use Zend\Debug\Debug;

class EhomeUserController extends UserController { // from ZfcUser, extends AbstractActionController;
	
	protected $roomTable;
	
	const ROUTE_CHANGEPASSWD = 'zfcuser/changepassword'; // TODO should only be stored in ZfcUser UserController
    const ROUTE_LOGIN        = 'zfcuser/login';
    const ROUTE_REGISTER     = 'zfcuser/register';
    const ROUTE_CHANGEEMAIL  = 'zfcuser/changeemail';
    const CONTROLLER_NAME    = 'zfcuser';
	
	public function indexAction() {	
		Debug::dump("0");
		if (!$this->zfcUserAuthentication()->hasIdentity()){ // check for valid session
			return $this->redirect()->toRoute(static::ROUTE_LOGIN);
		}
		
		// get room entities
		$rooms = $this->getRoomTable()->fetchAll();
		return new ViewModel(
				array('rooms' => $rooms)
		);
		
		// get lines of log file
// 		$utilitiesController = new UtilitiesController();
// 		$path = APP_ROOT . '/data/logs/application.log';
// 		$numberOfLinesToRead = 10;
// 		$logMessages = $utilitiesController->readLastLinesOfFile($path, $numberOfLinesToRead);
		
		// functional or room based profile view
// 		$viewTypeContainer = new Container('viewType');
// 		$viewType = $viewTypeContainer->viewType;
// 		if ($viewType == 1){
// 			// TODO Funktions-Sicht aufbauen
// 			return new ViewModel(array(
// 					'logMessages' 		=> $logMessages,
// 			));
// 		}
		// get room entities
		
// 		$adapter = $this->getServiceLocator()->get('db');
// 		$table = "room";
// 		$roomTable = new TableGateway($table, $adapter);
// 		$roomService = new RoomService(); // TODO via module.config oder Module.php via DI anliefern
// 		$roomService->setTable($roomTable);
// 		$roomsPaginator = $roomService->fetchList();
// 		return new ViewModel(array(
// 				'logMessages' 		=> $logMessages,
// 				'roomsPaginator'	=> $roomsPaginator,
// 		));
		
// 		if ($this->checkUserLogin()) {		
// 				$session = new Container ( 'session_data' );
// 				if ($session->type == 'functional') {	
// 					$this->redirect ()->toRoute ( 'enter', array (
// 							'id' => 28 
// 					) );
// 				} elseif ($session->type == 'room') {	
// 					$this->redirect ()->toRoute ( 'enter-loc', array (
// 							'id' => 28 
// 					) );
// 				}
// 			}
// 			return $this->redirect()->toRoute(self::ROUTE_LOGIN);
	}
	
	public function loginAction() {
	
		Debug::dump("0");
		if ($this->checkUserLogin()) {
			Debug::dump("1");
			return $this->redirect()->toRoute( $this->getOptions()->getLoginRedirectRoute());
		}
		$request = $this->getRequest ();
		$form = $this->getLoginForm ();
		if ($this->getOptions ()->getUseRedirectParameterIfPresent () && $request->getQuery ()->get('redirect')) {
			$redirect = $request->getQuery ()->get('redirect');
		} else {
			$redirect = false;
		}
		if (! $request->isPost ()) {
			return array (
					'loginForm' => $form,
					'redirect' => $redirect,
					'enableRegistration' => $this->getOptions ()->getEnableRegistration ()
			);
		}
		$form->setData ( $request->getPost () );
	
		if (!$form->isValid ()) {
			$this->flashMessenger ()->setNamespace ( 'zfcuser-login-form' )->addMessage ( $this->failedLoginMessage );
			return $this->redirect ()->toUrl ( $this->url ()->fromRoute ( static::ROUTE_LOGIN ) . ($redirect ? '?redirect=' . $redirect : '') );
		}
	
		// clear adapters
		$this->zfcUserAuthentication ()->getAuthAdapter ()->resetAdapters ();
		$this->zfcUserAuthentication ()->getAuthService ()->clearIdentity ();
	
		// set the view type in session
		$subname1 = $request->getPost ( 'functional' );
		$subname2 = $request->getPost ( 'room' );
	
		if ($subname1 == 'functional') {
			// function based view
	
			$session = new Container ( 'session_data' );
			$session->type = 'functional';
		} elseif ($subname2 == 'room') {
	
			// room based view
			$session = new Container ( 'session_data' );
			$session->type = 'room';
		}
	
		return $this->forward ()->dispatch ( static::CONTROLLER_NAME, array (
				'action' => 'authenticate'
		) );
	}
	
	// aus FS SharedFunctions.php
	public function checkUserLogin() {
		return $this->zfcUserAuthentication ()->hasIdentity ();
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