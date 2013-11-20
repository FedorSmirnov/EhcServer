<?php

namespace Ehome\Form;

use Zend\Form\Element\Password;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class JobaEventForm extends Form {

	public function __construct(){
		parent::__construct('eventForm');
		$this->setAttribute('method', 'post');
		//$this->setInputFilter(new \Ehome\Filter\EventFilter()); // TODO
		$this->add(array(
				'name' => 'name',
				'attributes' => array(
						'type' => 'text',
						'id' => 'name',
						'readonly' => 'true'
				),
				'options' => array('label' => 'Name des Events')
		));
		$this->add(array(
				'name' => 'value',
				'attributes' => array(
						'type' => 'text',
						'id' => 'value',
				),
				'options' => array('label' => 'Wert des Events')
		));
		$this->add(array(
				'name' => 'type',
				'attributes' => array(
						'type' => 'text',
						'id' => 'type'),
				'options' => array('label' => 'Typ des Events')
		));
		$this->add(array(
				'name' => 'start',
				'attributes' => array(
						'type' => 'text',
						'id' => 'temperature'),
				'options' => array('label' => 'Startzeitpunkt')
		));
		$this->add(array(
				'name' => 'end',
				'attributes' => array(
						'type' => 'text',
						'id' => 'end'),
				'options' => array('label' => 'Endzeitpunkt')
		));
		// radiobutton
		$this->add ( array (
				'type' => 'Zend\Form\Element\Radio',
				'name' => 'done',
				'options' => array (
						'label' => 'Erledigt',
						'value_options' => array (
								'0' => 'Nein',
								'1' => 'Ja'
						)
				)
		) );
		$this->add(array( // submit;
				'name' => 'submit',
				'attributes' => array(
						'type' => 'submit',
						'value' => 'Speichern und zum Cockpit!',
						'class' => 'btn btn-success' ),
		));
	}
}
