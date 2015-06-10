<?php

namespace Imie;

use Controller\PersonneController;

class Router {

    public function dispatch() {
        $routed = false;

        if (isset($_GET['ctrl'], $_GET['act'])) {
            
            /*if ($_GET['ctrl'] === 'personne' && $_GET['act'] === 'delete' && isset($_GET['id'])){
                $ctrl = new PersonneController();
                $ctrl->delete($_GET['id']);
            }*/
            
            $ctrlName = _CTRLPATH_ . ucfirst(strtolower($_GET['ctrl'])) . "Controller";
            
            if (class_exists($ctrlName)){
                $ctrl = new $ctrlName;
           
                $actionName = strtolower($_GET['act']) . "Action";
                
                if (method_exists($ctrl, $actionName)){
                    $ctrl->$actionName();
                    $routed = TRUE;
                }
            }
        }

        if (!$routed) {
            $this->dispatchDefault();
        }
    }

    function dispatchDefault() {
        $ctrl = new PersonneController();
        $ctrl->indexAction();
    }

}
