<?php
namespace LdcZfcUserApi\V1\Rpc\UserEmail;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserEmailControllerFactory implements FactoryInterface
{    
    public function createService(ServiceLocatorInterface $pluginHelper)
    {
        $serviceLocator = $pluginHelper->getServiceLocator();
        
        return new UserEmailController(
            $serviceLocator->get('zfcuser_user_service')
        );
    }
}
