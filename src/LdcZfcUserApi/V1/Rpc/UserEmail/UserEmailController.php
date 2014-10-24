<?php
namespace LdcZfcUserApi\V1\Rpc\UserEmail;

use LdcZfcUserApi\V1\Rpc\UserRpcController;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;

class UserEmailController extends UserRpcController
{  
    public function processAction()
    {
        $result = $this->processRequest();
        if ( $result instanceof ApiProblem ) {
            return new ApiProblemResponse($result);
        }
        extract($result);
        
        // ick
        $form = $this->service->getServiceManager()->get('zfcuser_change_email_form');
        
        // Validate the request body
        $form->setData($content);
        if ( ! $form->isValid() ) {
            return new ApiProblemResponse(
                new ApiProblem(422, 'Validation failed', null, null, [
                    'validation_messages' => $form->getMessages()
                ])
            );
        }

        if ( ! $this->service->changeEmail($form->getData()) ) {
            return new ApiProblemResponse(
                new ApiProblem(422, 'Validation failed', null, null, [
                    'validation_messages' => [
                        'credential' => [
                            'You must provide your password'
                        ]
                    ]
                ])
            );
        }
        
        return $this->getResponse();
    }
}