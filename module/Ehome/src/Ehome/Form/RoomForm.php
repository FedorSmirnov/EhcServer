<?php 

namespace Ehome\Form;

use Zend\Form\Element\Password;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class RoomForm extends Form {

	public function __construct(){
		parent::__construct('roomForm');
		$this->setAttribute('method', 'post');
		//$this->setInputFilter(new \Ehome\Filter\RoomFilter()); // TODO
		$this->add(array(
				'name' => 'name',
				'attributes' => array(
						'type' => 'text',
						'id' => 'name',
						'readonly' => 'true'
				),
				'options' => array('label' => 'Name des Raumes')
		));
		$this->add(array(
				'name' => 'humidity',
				'attributes' => array(
						'type' => 'text',
						'id' => 'humidity'),
				'options' => array('label' => 'Luftfeuchtigkeit')
		));
		$this->add(array(
		'name' => 'lightone',
		'attributes' => array(
		'type' => 'text',
		'id' => 'lightone'),
		'options' => array('label' => 'Lampe Eins')
		));
		$this->add(array(
		'name' => 'lighttwo',
		'attributes' => array(
		'type' => 'text',
		'id' => 'lighttwo'),
		'options' => array('label' => 'Lampe Zwei')
		));
// 		$this->add(array(
// 				'name' => 'lightone',
// 				'type' => 'Zend\Form\Element\Radio',
// 				'attributes' => array (
// 						'id' => 'lightone',
// 						'value' => '2' 
// 				),
// 				'options' => array (
// 						'label' => 'Lampe Eins',
// 						'value_options' => array(
// 								'1' => 'AN',
// 								'2' => 'AUS'			
// 				)) 
// 		));
// 		$this->add(array(
// 				'name' => 'lighttwo',
// 				'type' => 'Zend\Form\Element\Radio',
// 				'attributes' => array (
// 						'id' => 'lighttwo',
// 						'value' => '2'
// 				),
// 				'options' => array(
// 						'label' => 'Lampe Zwei',
// 						'value_options' => array(
// 								'1' => 'AN',
// 								'2' => 'AUS'			
// 				))
// 		));
		$this->add(array( // submit;
				'name' => 'submit',
				'attributes' => array(
						'type' => 'submit',
						'value' => 'Speichern und zum Cockpit!',
						'class' => 'btn btn-success' ),
		));
	}
}
