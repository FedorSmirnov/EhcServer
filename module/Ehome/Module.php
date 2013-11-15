<?php

namespace Ehome;

use Ehome\Entity\Room;
use Ehome\Entity\RoomTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Debug\Debug;
use Zend\Db\Adapter\Adapter;

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
}

?>
