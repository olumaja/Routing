<?php

    namespace App\Controllers;
    use App\Model\User;

    class AuthController extends BaseController{

        public function login(){
            $this->loadView('login', ['title' => 'Login']);
        }

        public function processLogin() {

            $email = $this->request->param('email');
            $password = $this->request->param('password');
    
            try {
               
                $user = User::findByEmail($email);
    
                if(!$user)  {
                   throw new \Exception('Unable to login');
                }
    
                if(!password_verify($password, $user->password)) {
                   throw new \Exception('Unable to login');
                }
    
                // set session
                User::updateLastLogin($user->id);
                $this->session->set(USER_SESSION_KEY_NAME, $user->id);
                $this->session->setFlash('success', sprintf( 'Welcome %s!', $user->name));
                $this->redirect('/');
    
            } catch (\Exception $e) {
                $this->session->setFlash('error', $e->getMessage());
                $this->redirect('/auth/login');
            }
        }

        public function register(){
            $this->loadView('register', ['title' => 'Sign Up']);
        }

        public function processReg()
        {
            $email = $this->request->param('email');
            $password = $this->request->param('password');
            $confirmPwd = $this->request->param('confirmPwd');
            $name = $this->request->param('name');

            try{

                if(empty($name) || empty($email) || empty($password) || empty($confirmPwd)){
                    throw new \Exception('All fields are required');
                }

                if(!$this->validInput->isValidEmail($email)){
                    throw new \Exception('Enter valid email address');
                }

                if(!$this->validInput->isValidPassword($password, $confirmPwd)){
                    throw new \Exception("Those passwords didn't match");
                }

                if(!$this->validInput->isValidName($name)){
                    throw new \Exception('Name must have more than one letter');
                }

                $userExist = User::findByEmail($email);

                if($userExist) {
                    throw new \Exception('Email address already exist');
                }

                $result = User::create([
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'name' => $name
                ]);

                if(!$result) {
                    throw new \Exception('Unable to create user account');
                }

                $this->redirect('/auth/login?msg=success');
            }
            catch(\Exception $e){
                $this->session->setFlash('error', $e->getMessage());
                $this->redirect('/auth/register?msg=error');
            }

        }

        public function logout(){
            $this->session->delete();
            $this->redirect('/auth/login?msg=logged-out');
        }

        public function param($key){
            return isset($_GET[$key]) ? $_GET[$key] : "";
        }

    }