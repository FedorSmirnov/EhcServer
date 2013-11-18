<?php

namespace Ehome;

// use Apartment\Entity\Apartment;
// use Apartment\Service\ApartmentTable;
// use Zend\Db\ResultSet\ResultSet;
// use Zend\Db\TableGateway\TableGateway;
// use Apartment\Service\UserTable;
// use Apartment\Entity\User;



use Ehome\Entity\Room;
use Ehome\Entity\RoomTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Debug\Debug;
use Zend\Db\Adapter\Adapter;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\EventManager\Event;

class Module {
	public function getAutoloaderConfig() {
		return array (
				'Zend\Loader\ClassMapAutoloader' => array (	
						__DIR__ . '/autoload_classmap.php' 
				),
				'Zend\Loader\StandardAutoloader' => array (	
						'namespaces' => array (			
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__ 
						) 
				) 
		);
	}
	
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	
	public function getServiceConfig() {
		return array (
				'factories' => array (
						'Ehome\Entity\RoomTable' => function ($sm) {
							$tableGateway = $sm->get('RoomTableGateway');
							$table = new RoomTable( $tableGateway );
							return $table;
						},
						'RoomTableGateway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype(new Room());
							return new TableGateway('room', $dbAdapter, null, $resultSetPrototype);
						} 
				) 
		);
	}
	
	// trick to overwrite login form zfcuser
	public function onBootstrap($e) {
                $events = $e->getApplication ()->getEventManager ()->getSharedManager ();
                $events->attach ( 'ZfcUser\Form\Login', 'init', function ($e) {
                        $form = $e->getTarget ();
                        
                        // Adjust the label of the pw field
                        $pwelement = $form->get ( 'credential' );
                        $pwelement->setLabel ( 'Passwort' );
                        
                        // Remove the sign in button
                        $form->remove ( 'submit' );
                        
                        // Add the buttons for the room- and function-based views
                        $submitElementFunc = new Element\Button ( 'functional' );
                        $submitElementRoom = new Element\Button ( 'room' );
                        
                        $submitElementFunc->setLabel ( 'Funktionale Sicht' );
                        $submitElementFunc->setAttribute ( 'type', 'submit' );
                        $submitElementFunc->setAttribute ( 'value', 'functional' );
                        
                        $submitElementRoom->setLabel ( 'Raumbasierte Sicht' );
                        $submitElementRoom->setAttribute ( 'type', 'submit' );
                        $submitElementRoom->setAttribute ( 'value', 'room' );
                        
                        $form->add ( $submitElementFunc );
                        $form->add ( $submitElementRoom );
                } );
                
                // Adjust the changeEmail form
                
                $events->attach ( 'ZfcUser\Form\ChangeEmail', 'init', function ($e) {
                        
                        $form = $e->getTarget ();
                        
                        // Adjust the label for 'new email'
                        $nEmailElement = $form->get ( 'newIdentity' );
                        $nEmailElement->setLabel ( 'Neue Email:' );
                        
                        // Adjust the label for 'verify new email'
                        $verify = $form->get ( 'newIdentityVerify' );
                        $verify->setLabel ( 'Neue Email bestaetigen:' );
                        
                        // Adjust the label for 'password'
                        $pwElement = $form->get ( 'credential' );
                        $pwElement->setLabel ( 'Passwort' );
                } );
                
                // Adjust the changePassword form
                $events->attach ( 'ZfcUser\Form\ChangePassword', 'init', function ($e) {
                        
                        $form = $e->getTarget ();
                        
                        // Adjust the label for 'current password'
                        $cpElement = $form->get ( 'credential' );
                        $cpElement->setLabel ( 'Aktuelles Passwort:' );
                        
                        // Adjust the label for 'new password'
                        $npElement = $form->get ( 'newCredential' );
                        $npElement->setLabel ( 'Neues Passwort:' );
                        
                        // Adjust the label for 'verify new password'
                        $vnpElement = $form->get ( 'newCredentialVerify' );
                        $vnpElement->setLabel ( 'Neues Passwort bestaetigen:' );
                        
                        // Adjust the label for the submit button
                        $sbElement = $form->get ( 'submit' );
                        $sbElement->setValue ( 'Passwort aendern' );
                } );
        }
}

?>
