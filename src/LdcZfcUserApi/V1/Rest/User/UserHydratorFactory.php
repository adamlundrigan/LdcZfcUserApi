<?php
namespace LdcZfcUserApi\V1\Rest\User;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcUser\Mapper\UserHydrator;
use Zend\Stdlib\Hydrator\Filter\MethodMatchFilter;
use Zend\Stdlib\Hydrator\Filter\FilterComposite;

/**
 * Hydrator which filters out the password field when exporting entity for HAL
 */
class UserHydratorFactory implements FactoryInterface
{    
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new UserHydrator();
        $hydrator->addFilter(
            'password', 
            new MethodMatchFilter('getPassword'), 
            FilterComposite::CONDITION_AND
        );        
        return $hydrator;
    }
}
