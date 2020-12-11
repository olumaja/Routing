<?php

    namespace App\Http;

    class InputValidation{

        private function cleanInput(string $str) : string {
            return strip_tags(trim($str, " "));
        }

        public function isValidName(string $str) : bool {
            $str = $this->cleanInput($str);
            return $str < 2;
        }

        public function isValidEmail(string $email) : bool {
            $email = $this->cleanInput($email);
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        public function isValidPassword(string $pwd, string $confirmPwd) : bool {

            $pwd = $this->cleanInput($pwd);
            $confirmPwd = $this->cleanInput($confirmPwd);
            return $pwd === $confirmPwd;
        }

    }