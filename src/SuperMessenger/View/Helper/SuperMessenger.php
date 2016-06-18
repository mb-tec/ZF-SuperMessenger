<?php

namespace Mbtec\SuperMessenger\View\Helper;

use SuperMessenger\View\Helper\SuperMessenger as BlanchonVincentSuperMessenger;

/**
 * Class        SuperMessenger
 * @package     Mbtec\SuperMessenger\View\Helper
 * @author      Matthias Büsing <info@mb-tec.eu>
 * @copyright   2016 Matthias Büsing
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link        http://mb-tec.eu
 */
class SuperMessenger extends BlanchonVincentSuperMessenger
{
    /**
     * @param null $namespace
     * @return $this|array|BlanchonVincentSuperMessenger|BlanchonVincentSuperMessenger\Controller\Plugin\SuperMessenger
     */
    public function __invoke($namespace = null)
    {
        if (null === $namespace) {
            return $this;
        }
        $flashMessenger = $this->getPluginFlashMessenger();
        $messages = array_merge(
            $flashMessenger->getMessagesFromNamespace($namespace),
            $flashMessenger->getCurrentMessagesFromNamespace($namespace)
        );

        return $messages;
    }

    /**
     * @param null $namespace
     * @param array $classes
     * @return string
     */
    public function render($namespace = null, array $classes = array())
    {
        $flashMessenger = $this->getPluginFlashMessenger();
        $messages = array_merge(
            $flashMessenger->getMessagesFromNamespace($namespace),
            $flashMessenger->getCurrentMessagesFromNamespace($namespace)
        );

        $flashMessenger->clearCurrentMessagesFromNamespace($namespace);

        // Prepare classes for opening tag
        if (empty($classes)) {
            $classes = isset($this->classMessages[$namespace]) ?
                $this->classMessages[$namespace] : $this->classMessages[PluginFlashMessenger::DEFAULT_MESSAGE];
            $classes = array($classes);
        }

        // Flatten message array
        $escapeHtml = $this->getEscapeHtmlHelper();
        $messagesToPrint = array();
        array_walk_recursive($messages, function ($item) use (&$messagesToPrint, $escapeHtml) {
            $messagesToPrint[] = $escapeHtml($item);
        });

        if (empty($messagesToPrint)) {
            return '';
        }

        // Generate markup
        $markup = sprintf($this->getMessageOpenFormat(), ' class="' . implode(' ', $classes) . '"');
        $markup .= implode($this->getMessageSeparatorString(), $messagesToPrint);
        $markup .= $this->getMessageCloseString();

        return $markup;
    }
}
