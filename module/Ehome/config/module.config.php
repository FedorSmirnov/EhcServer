<?php
namespace Ehome;
return array(
        'controllers' => array(
                'invokables' => array(
                        'Ehome\Controller\JobaUser' => 'Ehome\Controller\JobaUserController',
                        'Ehome\Controller\Index' => 'Ehome\Controller\IndexController',
                        'Ehome\Controller\Rasp' => 'Ehome\Controller\RaspController'
                )
        ),
        'view_manager' => array(
                'template_path_stack' => array(
                        'ehome' => __DIR__ . '/../view'
                )
        ),
        'router' => array(
                'routes' => array(
                        'rasp' => array(
                                
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                        
                                        'route' => '/rasp[/][:action][/:room][/:entry][/:state]',
                                        
                                        'defaults' => array(
                                                
                                                'controller' => 'Ehome\Controller\Rasp',
                                                'action' => 'index'
                                        )
                                )
                        ),
                        'home' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                        'route' => '/[:action][/:id]',
                                        'constraints' => array(
                                                'id' => '[0-9-_]*'
                                        ),
                                        'defaults' => array(
                                                'controller' => 'Ehome\Controller\Index',
                                                'action' => 'index'
                                        )
                                )
                        ),
                        'ehometest' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                        'route' => '/ehometest',
                                        'defaults' => array(
                                                'controller' => 'Ehome\Controller\Index',
                                                'action' => 'ehometest'
                                        )
                                )
                        ),
                        'zfcuser' => array(
                                'type' => 'literal',
                                'priority' => 1000,
                                'options' => array(
                                        'route' => '/user',
                                        'defaults' => array(
                                                'controller' => 'Ehome\Controller\Rasp',
                                                'action' => 'index'
                                        )
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                        'login' => array(
                                                'type' => 'Literal',
                                                'options' => array(
                                                        'route' => '/login',
                                                        'defaults' => array(
                                                                'controller' => 'Ehome\Controller\JobaUser',
                                                                'action' => 'login'
                                                        )
                                                )
                                        )
                                )
                        )
                )
        )
);

?>