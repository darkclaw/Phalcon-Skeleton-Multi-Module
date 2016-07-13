<?php

namespace Apps\Frontend\Controllers;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Phalcon PHP Framework');

    }

    public function indexAction()
    {
    }

}
