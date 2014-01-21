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

    protected $rasp_external_ip = '92.74.104.154';

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
        
        $apartment = $this->getApartmentState();
        
        return new ViewModel(
                array(
                        'apartment' => $apartment,
                        'useremail' => $userEmail
                ));
    }
    
    
    public function changeStateAction(){
        $room = $this->params()->fromRoute('room', '');
        $entry = $this->params()->fromRoute('entry', '');
        $state = $this->params()->fromRoute('state','');
        
        $apartment = $this->getApartmentState();
        $apartment[$room][$entry] = $state;
        
        $this->setApartmentState($apartment);
        
        $this->redirect()->toRoute('rasp');
        
        
    }
    
    private function setApartmentState($apartment){
        $client = new Client();
        
        $request = new Request();
        $request->setUri("http://" . $this->rasp_external_ip . ':8080');
        $request->setMethod(Request::METHOD_POST);
        
        $json = Json::encode($apartment);
        
        $request->setContent($json);
        
        $client->dispatch($request);
        
        
    }

    private function getApartmentState ()
    {
        $client = new Client();
        
        $request = new Request();
        $request->setUri("http://" . $this->rasp_external_ip . ':8080');
        $response = $client->dispatch($request);
        
        $json = $response->getBody();
        
        $apartment = Json::decode($json, Json::TYPE_ARRAY);
        return $apartment;
    }
}

?>