<?php
return array(
    'router' => array(
        'routes' => array(
            'ldc-zfc-user-api.rest.user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user[/:user_id]',
                    'defaults' => array(
                        'controller' => 'LdcZfcUserApi\\V1\\Rest\\User\\Controller',
                    ),
                ),
            ),
            'ldc-zfc-user-api.rpc.user-email' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user[/:user_id]/email',
                    'defaults' => array(
                        'controller' => 'LdcZfcUserApi\\V1\\Rpc\\UserEmail\\Controller',
                        'action' => 'process',
                    ),
                ),
            ),
            'ldc-zfc-user-api.rpc.user-password' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user[/:user_id]/password',
                    'defaults' => array(
                        'controller' => 'LdcZfcUserApi\\V1\\Rpc\\UserPassword\\Controller',
                        'action' => 'process',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'ldc-zfc-user-api.rest.user',
            1 => 'ldc-zfc-user-api.rpc.user-email',
            2 => 'ldc-zfc-user-api.rpc.user-password',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'LdcZfcUserApi\\V1\\Rest\\User\\UserResource' => 'LdcZfcUserApi\\V1\\Rest\\User\\UserResourceFactory',
        ),
    ),
    'hydrators' => array(
        'factories' => array(
            'LdcZfcUserApi\\V1\\Rest\\User\\UserHydrator' => 'LdcZfcUserApi\\V1\\Rest\\User\\UserHydratorFactory',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'LdcZfcUserApi\\V1\\Rpc\\UserEmail\\Controller' => 'LdcZfcUserApi\\V1\\Rpc\\UserEmail\\UserEmailControllerFactory',
            'LdcZfcUserApi\\V1\\Rpc\\UserPassword\\Controller' => 'LdcZfcUserApi\\V1\\Rpc\\UserPassword\\UserPasswordControllerFactory',
        ),
    ),
    'zf-rest' => array(
        'LdcZfcUserApi\\V1\\Rest\\User\\Controller' => array(
            'listener' => 'LdcZfcUserApi\\V1\\Rest\\User\\UserResource',
            'route_name' => 'ldc-zfc-user-api.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'user',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'ZfcUser\\Entity\\User',
            'collection_class' => 'LdcZfcUserApi\\V1\\Rest\\User\\UserCollection',
            'service_name' => 'User',
        ),
    ),
    'zf-rpc' => array(
        'LdcZfcUserApi\\V1\\Rpc\\UserEmail\\Controller' => array(
            'http_methods' => array('PUT'),
            'route_name'   => 'ldc-zfc-user-api.rpc.user-email',
        ),
        'LdcZfcUserApi\\V1\\Rpc\\UserPassword\\Controller' => array(
            'http_methods' => array('PUT'),
            'route_name'   => 'ldc-zfc-user-api.rpc.user-password',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'LdcZfcUserApi\\V1\\Rest\\User\\Controller' => 'HalJson',
            'LdcZfcUserApi\\V1\\Rpc\\UserEmail\\Controller' => 'HalJson',
            'LdcZfcUserApi\\V1\\Rpc\\UserPassword\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'LdcZfcUserApi\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.ldc-zfc-user-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'LdcZfcUserApi\\V1\\Rpc\\UserEmail\\Controller' => array(
                0 => 'application/vnd.ldc-zfc-user-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'LdcZfcUserApi\\V1\\Rpc\\UserPassword\\Controller' => array(
                0 => 'application/vnd.ldc-zfc-user-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'LdcZfcUserApi\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.ldc-zfc-user-api.v1+json',
                1 => 'application/json',
            ),
            'LdcZfcUserApi\\V1\\Rpc\\UserEmail\\Controller' => array(
                0 => 'application/vnd.ldc-zfc-user-api.v1+json',
                1 => 'application/json',
            ),
            'LdcZfcUserApi\\V1\\Rpc\\UserPassword\\Controller' => array(
                0 => 'application/vnd.ldc-zfc-user-api.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'renderer' => array(
            'hydrators' => array(
                'ZfcUser\\Entity\\User' => 'LdcZfcUserApi\\V1\\Rest\\User\\UserHydrator',
            ),
        ),
        'metadata_map' => array(
            'ZfcUser\\Entity\\User' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'ldc-zfc-user-api.rest.user',
                'route_identifier_name' => 'user_id',
            ),
            'LdcZfcUserApi\\V1\\Rest\\User\\UserCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'ldc-zfc-user-api.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'LdcZfcUserApi\\V1\\Rest\\User\\Controller' => array(
                'entity' => array(
                    'GET' => true,
                    'POST' => true,
                    'PATCH' => true,
                    'PUT' => true,
                    'DELETE' => true,
                ),
                'collection' => array(
                    'GET' => true,
                    'POST' => false,
                    'PATCH' => true,
                    'PUT' => true,
                    'DELETE' => true,
                ),
            ),
            'LdcZfcUserApi\\V1\\Rpc\\UserEmail\\Controller' => array(
                'actions' => array(
                    'process' => array(
                        'default' => true,
                    ),
                ),
            ),
            'LdcZfcUserApi\\V1\\Rpc\\UserPassword\\Controller' => array(
                'actions' => array(
                    'process' => array(
                        'default' => true,
                    ),
                ),
            ),
        ),
    ),
);
