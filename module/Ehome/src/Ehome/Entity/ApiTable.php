<?php
namespace Ehome\Entity;
use Zend\Db\TableGateway\TableGateway;
use Ehome\Entity\Api;

class ApiTable
{

    protected $tableGateway;

    public function __construct (TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll ()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getApi ($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(
                array(
                        'id' => $id
                ));
        $row = $rowset->current();
        if (! $row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveApi (Api $api)
    {
        $data = array(
                'pw' => $api->getPw()
        );
        $id = (int) $api->getId();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getApi($id)) {
                $this->tableGateway->update($data, 
                        array(
                                'id' => $id
                        ));
            } else {
                throw new \Exception('Api id does not exist');
            }
        }
    }

    public function deleteApi ($id)
    {
        $this->tableGateway->delete(
                array(
                        'id' => (int) $id
                ));
    }
}

?>