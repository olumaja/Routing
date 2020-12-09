<?php

    namespace App\Controllers;

    class HomeController extends BaseController{

        public function index(){
            $dtest = env('DB_HOST');
            die($dtest);
            $this->loadView('dashboard', ['title' => 'Dashboard']);
        }
    }