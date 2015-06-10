<?php

namespace Controller;

class Controller {
    
    public function render($name, $params = []) {
        $viewPath = _VIEWPATH_ . $name . '.php';
        
        if (file_exists($viewPath)){
            foreach ($params as $key => $value) {
                $$key = $value;
            }
            include $viewPath;
        }
        else {
            echo 'La vue n\'existe pas.';
        }
    }
}
