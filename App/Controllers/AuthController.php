<?php

    namespace App\Controllers;

    class AuthController extends BaseController{

        public function login(){
            $this->loadView('login', ['title' => 'Login']);
        }

        public function processLogin() {

            $email = $this->request->param('email');
            $password = $this->request->param('password');
    
            $user = User::findByEmail($email);
            if(!$user)  {
                return $this->redirect('/auth/login?msg=unable to login');
            }
    
            if(!password_verify($password, $user->password)) {
                $this->redirect('/auth/login?msg=unable to login');
            }
    
            // set session
            User::updateLastLogin($user->id);
            $this->redirect('/');
        }

        public function register(){
            $this->loadView('register', ['title' => 'Sign Up']);
        }

        public function processReg()
    {
        $email = $this->request->param('email');
        $password = $this->request->param('password');
        $name = $this->request->param('name');

        //More validation to be done here
        if($email == "" || $name == "" || $password == ""){
            throw new Exception("Invalid creditials");
        }

        $result = User::create([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'name' => $name
        ]);


        if(!$result) {
            
            $this->redirect('/auth/login?msg=error');
            return;
        }

        $this->redirect('/auth/login?msg=success');

    }

        public function param($key){
            return isset($_GET[$key]) ? $_GET[$key] : "";
        }

        // public function store(){
        //     $email = $this->request->param('email');
        //     $password = $this->request->param('password');
        //     $this->redirect('/');
        // }

    }