<?php

namespace MBtecZfSuperMessenger\View\Helper\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use MBtecZfSuperMessenger\View\Helper\SuperMessenger;
use SuperMessenger\View\Helper\Service as SmService;

/**
 * Class        SuperMessengerFactory
 * @package     MBtec\SuperMessenger\View\Helper\Service
 * @author      Matthias Büsing <info@mb-tec.eu>
 * @copyright   2016 Matthias Büsing
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link        http://mb-tec.eu
 */
class SuperMessengerFactory extends SmService\SuperMessengerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed|SuperMessenger
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $helper = new SuperMessenger();
        $controllerPluginManager = $serviceLocator->get('ControllerPluginManager');
        $flashMessenger = $controllerPluginManager->get('supermessenger');
        $helper->setPluginFlashMessenger($flashMessenger);
        $config = $serviceLocator->get('Config');
        if (isset($config['view_helper']['supermessenger'])) {
            $configHelper = $config['view_helper']['supermessenger'];
            if (isset($configHelper['message_open_format'])) {
                $helper->setMessageOpenFormat($configHelper['message_open_format']);
            }
            if (isset($configHelper['message_separator_string'])) {
                $helper->setMessageSeparatorString($configHelper['message_separator_string']);
            }
            if (isset($configHelper['message_close_string'])) {
                $helper->setMessageCloseString($configHelper['message_close_string']);
            }
        }

        return $helper;
    }
}
