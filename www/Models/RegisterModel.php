<?php
    class RegisterModel extends BaseModel
    {
        const TABLE =  'registers';
        protected $connect;
        
        public function __construct()
        {
            $this->connect = $this->connect();
        }

        public function store($data)
        {
            $this->create(self::TABLE, $data);
        }

        public function getAll($select = ['*'], $orderBy = [], $limit = 15)
        {
            $this->all(self::TABLE);
        }

        public function checkEmailPhone($data)
        {
            return $this->check(self::TABLE, $data);
        }

        public function getRegisterId($data)
        {
            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' and ', $dataSets);

            $table = self::TABLE;

            $sql = "select id from $table where $dataSetString limit 1";
            
            $result = $this->_query($sql);

            if($result->num_rows > 0){
                return mysqli_fetch_assoc($result)['id'];
            }
            else
            {
                return 0;
            }
        }

        public function getNameByPhone($data, $column)
        {
            return $this->getData(self::TABLE, $data, $column);
        }

        public function getUsernameByPhone($data, $column)
        {
            return $this->getDataTwoTable($data, $column);
        }

        private function _query($sql)
        {
            return mysqli_query($this->connect, $sql);
        }
    }
?>