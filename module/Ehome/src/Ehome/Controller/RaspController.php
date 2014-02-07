<?php
namespace Ehome\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

class RaspController extends AbstractActionController
{

    const ROUTE_LOGIN = 'zfcuser/login';

    protected $user = 'guest@jochen-bauer.net';

    protected $password = 'geheim';

    protected $extIpTable;

    public function indexAction ()
    {
        if (! $this->zfcUserAuthentication()->hasIdentity()) { // check for
                                                               // valid
                                                               // session
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }
        
        $userEmail = $this->zfcUserAuthentication()
            ->getIdentity()
            ->getEmail();
        
        $apartment = $this->getApartmentState(false);
        
        return new ViewModel(
                array(
                        'apartment' => $apartment,
                        'useremail' => $userEmail
                ));
    }

    public function updateIpAction ()
    {
        $new_ip = $_POST['ip'];
        
        $extIpTable = $this->getExtIpTable();
        
        $ip = $extIpTable->getIp(1);
        
        $ip->setExtIp($new_ip);
        
        $extIpTable->saveIp($ip);
        
        return new JsonModel(
                array(
                        'message' => 'ip_changed to ' . $new_ip
                ));
    }

    public function mobileInterfaceAction ()
    {
        if ($_POST['src'] != 'mobile') {
            throw new \Exception('Connection attempt from unknown source.');
        }
        
        $pw = $_POST['pw_user'];
        $u = $_POST['email'];
        
        if ($pw != $this->password or $u != $this->user) {
            throw new \Exception('Connection attempt from unknown source.');
        }
        
        $func = $_POST['func'];
        
        switch ($func) {
            
            case 'login':
                return new JsonModel(
                        
                        array(
                                'response' => 'success'
                        ));
            
            case 'getState':
                return $this->getApartmentState(true);
            
            default:
                throw new \Exception('Connection attempt from unknown source.');
        }
    }

    public function changeStateAction ()
    {
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $pw = $_POST['pw_user'];
            $u = $_POST['email'];
            
            if ($pw != $this->password or $u != $this->user) {
                throw new \Exception('Connection attempt from unknown source.');
            }
        } else {
            if (! $this->zfcUserAuthentication()->hasIdentity()) { // check for
                                                                   // valid
                                                                   // session
                return $this->redirect()->toRoute(static::ROUTE_LOGIN);
            }
        }
        
        $room = $this->params()->fromRoute('room', '');
        $dev_name = $this->params()->fromRoute('entry', '');
        $state = $this->params()->fromRoute('state', '');
        
        $apartment = $this->getApartmentState(false);
        
        foreach ($apartment['rooms'] as $key_room => $myRoom) {
            if ($myRoom['name'] == $room) {
                foreach ($myRoom['devices'] as $key_device => $device) {
                    if ($device['name'] == $dev_name) {
                        
                        $apartment['rooms'][$key_room]['devices'][$key_device]['state'] = $state;
                    }
                }
            }
        }
        
        if ($this->setApartmentState($apartment)) {
            
            if ($request->isPost()) {
                return new JsonModel($apartment);
            } else {
                
                return new JsonModel(
                        
                        array(
                                'response' => 'success'
                        ));
            }
        } else {
            return new JsonModel(
                    
                    array(
                            'response' => 'failure'
                    ));
        }
    }

    private function setApartmentState ($apartment)
    {
        $client = new Client();
        
        $request = new Request();
        $request->setUri("http://" . $this->getExtIp() . ':8080');
        $request->setMethod(Request::METHOD_POST);
        
        $apartment['Password'] = $this->password;
        $apartment['User'] = $this->user;
        
        $json = Json::encode($apartment);
        
        $request->setContent($json);
        
        $response = $client->dispatch($request);
        
        $json = $response->getBody();
        
        $resp = Json::decode($json, Json::TYPE_ARRAY);
        
        return $resp['response'] == 'success';
    }

    private function getApartmentState ($mobile)
    {
        $client = new Client();
        
        $request = new Request();
        $request->getQuery()->set('Password', $this->password);
        $request->getQuery()->set('User', $this->user);
        
        $request->setUri("http://" . $this->getExtIp() . ':8080');
        $request->setMethod(Request::METHOD_GET);
        $response = $client->dispatch($request);
        
        $json = $response->getBody();
        $apartment = Json::decode($json, Json::TYPE_ARRAY);
        if (! $mobile) {
            
            return $apartment;
        } else {
            return new JsonModel($apartment);
        }
    }

    public function getExtIp ()
    {
        $extIpTable = $this->getExtIpTable();
        
        return $extIpTable->getIp(1)->getExtIp();
    }

    public function getExtIpTable ()
    {
        if (! $this->extIpTable) {
            $sm = $this->getServiceLocator();
            $this->extIpTable = $sm->get('Ehome\Entity\ExternalIpTable');
        }
        
        return $this->extIpTable;
    }
}

?>