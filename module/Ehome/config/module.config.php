<?php

namespace Ehome;

return array (
		'controllers' => array (
				'invokables' => array (
						'Ehome\Controller\EhomeUser' => 'Ehome\Controller\EhomeUserController',
						'Ehome\Controller\Index' => 'Ehome\Controller\IndexController' 
				)
				 
		)
		,
		'view_manager' => array (
				'template_path_stack' => array (	
						'ehome' => __DIR__ . '/../view' 
				) 
		),
		'router' => array (
				'routes' => array (	
						'login' => array (		
								'type' => 'segment',
								'options' => array (		
										'route' => '/login[/:action]',
										'constraints' => array (			
												'action' => '[a-zA-Z][a-zA-Z0-9-_]*' 
										)
										,
										'defaults' => array (		
												'controller' => 'Ehome\Controller\EhomeUser',
												'action' => 'index' 
										) 
								) 
						),
						'home' => array(
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array(
										'route'    => '/',
										'defaults' => array(
												'controller' => 'Ehome\Controller\Index',
												'action'     => 'index',
										),
								),
						),
						'user' => array(
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array(
										'route'    => '/user',
										'defaults' => array(
												'controller' => 'Ehome\Controller\EhomeUser',
												'action'     => 'index',
										),
								),
						),
				) 
		),
);

?>