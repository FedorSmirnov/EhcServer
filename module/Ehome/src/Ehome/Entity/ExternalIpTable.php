<?php
namespace Ehome\Entity;
use Zend\Db\TableGateway\TableGateway;

class ExternalIpTable
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

    public function getIp ($id)
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

    public function saveIp (ExternalIp $ip)
    {
        $data = array(
                'extIp' => $ip->getExtIp()
        );
        $id = (int) $ip->getId();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getIp($id)) {
                $this->tableGateway->update($data, 
                        array(
                                'id' => $id
                        ));
            } else {
                throw new \Exception('Api id does not exist');
            }
        }
    }

    public function deleteIp ($id)
    {
        $this->tableGateway->delete(
                array(
                        'id' => (int) $id
                ));
    }
}

?>