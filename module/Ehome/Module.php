<?php

namespace Ehome;

use Ehome\Entity\JobaEvent;
use Ehome\Entity\JobaEventTable;
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
						'Ehome\Entity\JobaEventTable' => function ($sm) {
							$tableGateway = $sm->get('JobaEventTableGateway');
							$table = new JobaEventTable($tableGateway);
							return $table;
						},
						'JobaEventTableGateway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new JobaEvent());
							return new TableGateway('jobaevent', $dbAdapter, null, $resultSetPrototype);
						},
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
		$events->attach ('ZfcUser\Form\Login', 'init', function ($e) {
			$form = $e->getTarget ();
			$pwelement = $form->get ('credential');
			$pwelement->setLabel ('Passwort');
			$form->remove ('submit');
			$submitElementRoom = new Element\Button ( 'room' );
			$submitElementFunc = new Element\Button ( 'functional' );
			$submitElementRoom->setLabel('Raumbasierte Sicht');
			$submitElementRoom->setAttribute ( 'type', 'submit' );
			$submitElementRoom->setAttribute ( 'value', 'room');
			$submitElementFunc->setLabel( 'Funktionale Sicht' );
			$submitElementFunc->setAttribute ( 'type', 'submit' );
			$submitElementFunc->setAttribute ( 'value', 'functional' );
			$form->add( $submitElementRoom );
			$form->add( $submitElementFunc );
		} );
		// Adjust the changeEmail form
		$events->attach ( 'ZfcUser\Form\ChangeEmail', 'init', function ($e) {
			$form = $e->getTarget ();
			$nEmailElement = $form->get ( 'newIdentity' );
			$nEmailElement->setLabel ( 'Neue Email:' );
			$verify = $form->get ( 'newIdentityVerify' );
			$verify->setLabel ( 'Neue Email bestaetigen:' );
			$pwElement = $form->get ( 'credential' );
			$pwElement->setLabel ( 'Passwort' );
		} );
		// Adjust the changePassword form
		$events->attach ( 'ZfcUser\Form\ChangePassword', 'init', function ($e) {
			$form = $e->getTarget ();
			$cpElement = $form->get ( 'credential' );
			$cpElement->setLabel ( 'Aktuelles Passwort:' );
			$npElement = $form->get ( 'newCredential' );
			$npElement->setLabel ( 'Neues Passwort:' );
			$vnpElement = $form->get ( 'newCredentialVerify' );
			$vnpElement->setLabel ( 'Neues Passwort bestaetigen:' );
			$sbElement = $form->get ( 'submit' );
			$sbElement->setValue ( 'Passwort aendern' );
		});
	}
}
?>
