<?php

namespace MBtecZfSuperMessenger;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

/**
 * Class        Module
 * @package     MBtec\SuperMessenger
 * @author      Matthias Büsing <info@mb-tec.eu>
 * @copyright   2016 Matthias Büsing
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link        http://mb-tec.eu
 */
class Module implements AutoloaderProviderInterface
{
    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getViewHelperConfig()
    {
        return [
            'aliases' => [
                'supermessenger' => 'mbSuperMessenger',
                'flashmessenger' => 'mbSuperMessenger',
            ],
            'factories' => [
                'mbSuperMessenger' => 'MBtecZfSuperMessenger\View\Helper\Service\SuperMessengerFactory',
            ],
        ];
    }
}
