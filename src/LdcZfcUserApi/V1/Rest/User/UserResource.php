<?php
namespace LdcZfcUserApi\V1\Rest\User;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use ZfcUser\Service\User as ZfcUserService;
use ZF\MvcAuth\Identity\GuestIdentity;
use ZfcUser\Entity\UserInterface;
use Zend\Form\FormInterface;

class UserResource extends AbstractResourceListener
{
    /**
     * @var ZfcUserService
     */
    protected $service;
    
    public function __construct(ZfcUserService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $result = $this->service->register((array)$data);
        
        if ( $result === false ) {
            return new ApiProblem(422, 'Validation failed', null, null, [
                'validation_messages' => $this->service->getRegisterForm()->getMessages()
            ]);
        }
        
        return $result;
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $reqUser = $this->service->getUserMapper()->findById($id);
        if ( ! $reqUser instanceof UserInterface ) {
            return new ApiProblem(404);
        }
        
        // User is only allowed to fetch their own profile
        // @TODO something something ACL || RBAC something
        $apiUserId = $this->getIdentity()->getAuthenticationIdentity()['user_id'];
        if ( $apiUserId != $reqUser->getId() ) {
            return new ApiProblem(403, 'Forbidden');
        }
        
        return $reqUser;
    }
}
