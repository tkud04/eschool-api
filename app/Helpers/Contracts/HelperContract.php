<?php
namespace App\Helpers\Contracts;

Interface HelperContract
{
        public function createToken($data);
        public function getToken($student);
        public function deleteToken($tk);
        public function getTokens($type);
        public function tokenExists($dt);
		
}
 ?>