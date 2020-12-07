<?php

    namespace App;

    class Application{

        public function mount(){
            $route = new Router();
            echo $route->executeUrl();
        }

    }