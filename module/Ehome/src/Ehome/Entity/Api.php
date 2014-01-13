<?php
namespace Ehome\Entity;

class Api
{

    private $id;

    private $pw;
    private $pw_user;
    private $email;

    public function exchangeArray ($data)
    {
        $this->id = (! empty($data['id'])) ? $data['id'] : null;
        $this->pw = (! empty($data['pw'])) ? $data['pw'] : null;
        $this->pw_user = (! empty($data['pw_user'])) ? $data['pw_user'] : null;
        $this->email = (! empty($data['email'])) ? $data['email'] : null;
    }

    public function getArrayCopy ()
    {
        return get_object_vars($this);
    }

    public function getId ()
    {
        return $this->id;
    }

    public function getPw ()
    {
        return $this->pw;
    }
    
    public function getPw_user(){
        return $this->pw_user;
    }
    
    public function getEmail(){
        return $this->email;
    }
}

?>