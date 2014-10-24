<?php
namespace LdcZfcUserApi\V1\Rpc\UserPassword;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserPasswordControllerFactory implements FactoryInterface
{    
    public function createService(ServiceLocatorInterface $pluginHelper)
    {
        $serviceLocator = $pluginHelper->getServiceLocator();
        
        return new UserPasswordController(
            $serviceLocator->get('zfcuser_user_service')
        );
    }
}
