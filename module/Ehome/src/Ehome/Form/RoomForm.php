<?php
/**
 * ZF2 Buch Kapitel 13
*
* Das Buch "Zend Framework 2 - Von den Grundlagen bis zur fertigen Anwendung"
* von Ralf Eggert ist im Addison-Wesley Verlag erschienen.
* ISBN 978-3-8273-2994-3
*
* @package    Pizza
* @author     Ralf Eggert <r.eggert@travello.de>
* @copyright  Alle Listings sind urheberrechtlich geschützt!
* @link       http://www.zendframeworkbuch.de/ und http://www.awl.de/2994
*/

/**
 * namespace definition and usage
*/
namespace Ehome\Form;

use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class RoomForm extends Form {

	public function __construct(){
		parent::__construct('roomForm');
		$this->setAttribute('action', 'edit');
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
