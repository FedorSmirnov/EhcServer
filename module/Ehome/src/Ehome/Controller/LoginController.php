<?php

namespace Ehome\Controller;

use ZfcUser\Controller\UserController;
use Zend\Session\Container;
use Zend\View\Helper\ViewModel;
use Zend\Debug\Debug;

class LoginController extends UserController { // from ZfcUser, extends AbstractActionController;
	
	const ROUTE_CHANGEPASSWD = 'zfcuser/changepassword'; // TODO should only be stored in ZfcUser UserController
    const ROUTE_LOGIN        = 'zfcuser/login';
    const ROUTE_REGISTER     = 'zfcuser/register';
    const ROUTE_CHANGEEMAIL  = 'zfcuser/changeemail';
    const CONTROLLER_NAME    = 'zfcuser';
	
	public function indexAction() {	
		if ($this->checkUserLogin()) {		
				$session = new Container ( 'session_data' );
				if ($session->type == 'functional') {	
					$this->redirect ()->toRoute ( 'enter', array (
							'id' => 28 
					) );
				} elseif ($session->type == 'room') {	
					$this->redirect ()->toRoute ( 'enter-loc', array (
							'id' => 28 
					) );
				}
			}
			return $this->redirect()->toRoute(self::ROUTE_LOGIN);
	}
	
	public function loginAction() {
	
		Debug::dump("0");
		
// 		if ($this->checkUserLogin()) { // TODO check session
// 			return $this->redirect ()->toRoute ( $this->getOptions ()->getLoginRedirectRoute() );
// 		}
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
		Debug::dump("0");
		$form->setData ( $request->getPost () );
	
		if (! $form->isValid ()) {
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
}


?>