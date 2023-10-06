<?php
    class PhonecardModel extends BaseModel
    {
        const TABLE = 'phonecard';

        protected $connect;

        public function getCode($data, $column)
        {
            return $this->getData(self::TABLE, $data, $column);
        }

        private function _query($sql)
        {
            return mysqli_query($this->connect, $sql);
        }

    }
?>