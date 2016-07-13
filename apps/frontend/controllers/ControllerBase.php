<?php

namespace Apps\Frontend\Controllers;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    /**
     * @return mixed
     */
    public function onConstruct()
    {
    }

    /**
     *
     */
    protected function initialize()
    {
        $this->tag->prependTitle('Welcome |');

        $resources = $this->loadActionResources();

        foreach ($resources["jsResources"] as $jsResource) {
            if (!empty($jsResource)) {
                $this->assets->collection("jsFooter")
                    ->addJs($jsResource);
            }
        }

        foreach ($resources["cssResources"] as $cssResource) {
            if (!empty($cssResource)) {
                $this->assets->collection("cssHeader")
                    ->addCss($cssResource);
            }
        }

        $this->view->setVars(
            array(
                'controllerName' => $this->dispatcher->getControllerName(),
                'actionName' => $this->dispatcher->getActionName(),
            )
        );
    }

    /**
     * @param $uri
     *
     * @return mixed
     */
    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);

        return $this->dispatcher->forward(
            array(
                'controller' => $uriParts[0],
                'action' => $uriParts[1],
                'params' => $params,
            )
        );
    }

    /**
     * @param mixed $eventParams
     *
     * @return mixed
     */
    private function loadActionResources()
    {
        $browserInfo = get_browser();

        $browser = strtolower(str_replace(' ', '_', $browserInfo->browser));
        $browserVersion = $browserInfo->version;

        $resources = new \Library\Resources();

        $action = $this->dispatcher->getActionName();
        $module = $this->dispatcher->getModuleName();
        $controller = $this->dispatcher->getControllerName();

        $jsResources = $resources->getResources('js', '/public/resources/js/', '/resources/js/', $module, $controller, $action, $browser, $browserVersion);
        $cssResources = $resources->getResources('css', '/public/resources/css/', '/resources/css/', $module, $controller, $action, $browser, $browserVersion);

        $assets = array('jsResources' => $jsResources, 'cssResources' => $cssResources);

        return $assets;
    }

}
