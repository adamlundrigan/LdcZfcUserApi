<?php
namespace LdcZfcUserApi\V1\Rest\User;

class UserResourceFactory
{
    public function __invoke($services)
    {
        return new UserResource(
            $services->get('zfcuser_user_service')
        );
    }
}
