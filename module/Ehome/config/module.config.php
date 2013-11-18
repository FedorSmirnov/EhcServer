<?php

namespace Ehome;

return array (
		'controllers' => array (
				'invokables' => array (
						'Ehome\Controller\Backend' => 'Ehome\Controller\BackendController',
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
												'controller' => 'Ehome\Controller\Backend',
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
						'editroom' => array(
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array(
										'route'    => '/editroom',
										'defaults' => array(
												'controller' => 'Ehome\Controller\Index',
												'action'     => 'editroom',
										),
								),
						),
						'zfcuser' => array (
								'type' => 'literal',
								'priority' => 1000,
								'options' => array (
										'route' => '/user',
										'defaults' => array (
												'controller' => 'Ehome\Controller\Index',
												'action' => 'index' 
										) 
								),
//								'may_terminate' => true,
//								'child_routes' => array (
// 										'login' => array (
// 												'type' => 'Literal',
// 												'options' => array (
// 														'route' => '/login',
// 														'defaults' => array (
// 																'controller' => 'Ehome\Controller\Backend',
// 																'action' => 'login' 
// 														) 
// 												) 
// 										) 
//								) 
						) 
				) 
		) 
);

?>