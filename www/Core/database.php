<?php

    class database
    {
        const HOST      = 'mysql-server';
        const USERNAME  = 'root';
        const PASSWORD  = 'root';
        const DB_NAME   = 'product_management';

        private $connect;

        public function connect()
        {
            $connect = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME);
            $connect->set_charset("utf8");
            if ($connect->connect_error) {
                return false;
            }
            return $connect;
        }
    }
?>