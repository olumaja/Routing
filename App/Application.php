<?php

    namespace App;

    class Application{

        public function __construct(){

            $this->loadConfig();
            $this->mount();
        }

        protected function mount(){
            $route = new Router();
            echo $route->executeUrl();
        }

        //load .env file
        public function loadConfig(){
            $this->checkConfig();
        }

        public function checkConfig(){
            if(!file_exists(DOT_ENV_FILE)){
                throw new \Exception('.env file missing, application cannot run');
            }

            $fileContent = fopen(DOT_ENV_FILE, "r");
            if(!$fileContent){
                throw new \Exception('Unable to load .env file');
            }
            $lines = [];
            while(!feof($fileContent)){
                $line = trim(fgets($fileContent));
                if($line){
                    $lines[] = $line;
                }
            }
            fclose($fileContent);
            $this->parseConfigLines($lines);
        }

        public function parseConfigLines(array $lines){
            foreach($lines as $item){
                $parts = explode('=', $item);
                if(count($parts === 2)){
                    $key = $parts[0];
                    $value = str_ireplace('"', '', $parts[1]);
                    $_ENV[$key] = $value;
                }
            }
        }

    }