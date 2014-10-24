<?php
namespace LdcZfcUserApi;

use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;

class Module 
{
    public function init(ModuleManager $moduleManager)
    {
        $events = $moduleManager->getEventManager();
        $events->attach(ModuleEvent::EVENT_MERGE_CONFIG, array($this, 'nukeZfcUserRoutesFromConfig'));
    }
        
    public function nukeZfcUserRoutesFromConfig(ModuleEvent $e)
    {
        $configListener = $e->getConfigListener();
        $config         = $configListener->getMergedConfig(false);
        if ( $config['ldc-zfc-user-api']['nuke_zfcuser_routes'] !== true ) {
            return;
        }
        if ( ! isset($config['router']['routes']['zfcuser']) ) {
            return;
        }
        unset($config['router']['routes']['zfcuser']);
        $configListener->setMergedConfig($config);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                ),
            ),
        );
    }
}
