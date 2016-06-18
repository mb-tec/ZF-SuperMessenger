<?php

namespace Mbtec\SuperMessenger;

use Zend\ModuleManager\Feature;

/**
 * Class        Module
 * @package     Mbtec\SuperMessenger
 * @author      Matthias Büsing <info@mb-tec.eu>
 * @copyright   2015 Matthias Büsing
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link        http://mb-tec.eu
 */
class Module implements Feature\AutoloaderProviderInterface
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
                'mbSuperMessenger' => 'Mbtec\SuperMessenger\View\Helper\Service\SuperMessengerFactory',
            ],
        ];
    }
}
