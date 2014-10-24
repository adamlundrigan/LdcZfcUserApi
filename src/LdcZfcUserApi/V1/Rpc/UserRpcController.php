<?php
namespace LdcZfcUserApi\V1\Rpc;

use Zend\Mvc\Controller\AbstractActionController;
use ZfcUser\Service\User as ZfcUserService;
use ZF\ApiProblem\ApiProblem;
use ZfcUser\Entity\UserInterface;

class UserRpcController extends AbstractActionController
{
    /**
     * @var ZfcUserService
     */
    protected $service;
    
    public function __construct(ZfcUserService $service)
    {
        $this->service = $service;
    }
    
    public function processRequest()
    {
        // User must be authenticated
        $apiUser = $this->service->getAuthService()->getIdentity();
        if ( ! $apiUser instanceof UserInterface ) {
            return new ApiProblem(403, null);
        }
        
        // User ID must be provided through the route (/user/:user_id/password)
        if ( empty($this->params()->fromRoute('user_id')) ) {
            return new ApiProblem(400, null);
        }        
        
        // User ID provided through route must be valid
        $reqUser = $this->service->getUserMapper()->findById($this->params()->fromRoute('user_id'));
        if ( ! $reqUser instanceof UserInterface ) {
            return new ApiProblem(404);
        }
        
        // User ID provided through route must be same as authenticated user
        // @TODO something something ACL || RBAC something
        if ( $reqUser->getId() != $apiUser->getId() ) {
            return new ApiProblem(403, null);
        }
        
        // Decode and validate the request body 
        $content = json_decode($this->getRequest()->getContent(), true);
        if ( ! is_array($content) ) {
            return new ApiProblem(400, null);
        }
        
        // Determine the user's identity and inject it into the request
        $authMethods = $this->service->getOptions()->getAuthIdentityFields();
        $content['identity'] = null;
        while ( empty($content['identity']) ) {
            $authMethod = array_shift($authMethods);
            if ( empty($authMethod) ) {
                break;
            }
            switch ($authMethod) {
                case 'email':
                    $content['identity'] = $apiUser->getEmail();
                    break;
                case 'email':
                    $content['identity'] = $apiUser->getEmail();
                    break;
            }
        }
        
        return compact('apiUser', 'reqUser', 'content');
    }
}