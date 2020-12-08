<?php

    namespace App\Controllers;

    class AuthController extends BaseController{

        public function login(){
            $this->loadView('login', ['title' => 'Login']);
        }

        public function param($key){
            return isset($_GET[$key]) ? $_GET[$key] : "";
        }

        public function store(){
            $email = $this->request->param('email');
            $password = $this->request->param('password');
            $this->redirect('/');
        }

    }