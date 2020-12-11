<?php

    namespace App\Http;
    use \Aura\Session\SessionFactory;

    class Session{

        protected $store = null;
        protected static $singleInstance = null;

        private function __construct(){
            $sessionFactory = new SessionFactory;
            $sess = $sessionFactory->newInstance($_COOKIE);
            $this->store = $sess->getSegment('App\WpAnalytics');
        }

        public static function getInstance()
        {
            if (self::$singleInstance == null)
            {
                //note static is same as calling Session class
                //That's same as- self::$singleInstance = new Session()
                self::$singleInstance = new static();
            }

            return self::$singleInstance;
        }

        public function set($key, $value) {
            $this->store->set($key, $value);
        }
    
        public function get($key) {
            return $this->store->get($key);
        }
    
        public function setFlash($key, $value) {
            $this->store->setFlash($key, $value);
        }
    
        public function getFlash($key) {
            return $this->store->getFlash($key);
        }
    
        public function delete() {
            $this->store->clear();
        }

    }