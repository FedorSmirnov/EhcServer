<?php 

namespace Ehome\Form;

use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class RoomForm extends Form {

	public function __construct(){
		parent::__construct('roomForm');
		//$this->setAttribute('action', 'editroom');
		$this->setAttribute('method', 'post');
		//$this->setInputFilter(new \Ehome\Filter\RoomFilter());
		$this->add(array( // TODO hidden field mit id
				'name' => 'name',
				'attributes' => array(
						'type' => 'text',
						'id' => 'name'),
				'options' => array('label' => 'Name des Raumes')
		));
		$this->add(array(
				'name' => 'humidity',
				'attributes' => array(
						'type' => 'text',
						'id' => 'humidity'),
				'options' => array('label' => 'Luftfeuchtigkeit')
		));
		$this->add(array( // submit;
				'name' => 'submit',
				'attributes' => array(
						'type' => 'submit',
						'value' => 'Speichern' ),
		));
	}
}
