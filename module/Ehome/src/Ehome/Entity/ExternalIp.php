<?php
namespace Ehome\Entity;

class ExternalIp
{

    private $id;

    private $extIp;

    public function exchangeArray ($data)
    {
        $this->id = (! empty($data['id'])) ? $data['id'] : null;
        $this->extIp = (! empty($data['extIp'])) ? $data['extIp'] : null;
    }

    public function getArrayCopy ()
    {
        return get_object_vars($this);
    }

    public function getId ()
    {
        return $this->id;
    }

    public function getExtIp ()
    {
        return $this->extIp;
    }

    public function setExtIp ($extIp)
    {
        $this->extIp = $extIp;
    }
}

?>