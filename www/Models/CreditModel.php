<?php
    class CreditModel extends BaseModel
    {
        const CREDIT = 'credit';
        const TRANSHIS = 'transhis';
        const ACCOUNT = 'account';

        protected $connect;

        public function checkCard($data)
        {
            return $this->check(self::CREDIT, $data);
        }

        public function checkExdate($data)
        {
            return $this->check(self::CREDIT, $data);
        }

        public function checkCvv($data)
        {
            return $this->check(self::CREDIT, $data);
        }

        public function getCreditID($data)
        {
            return $this->getData(self::CREDIT, $data, 'id');
        }

        public function store($data)
        {
            $table = self::TRANSHIS;
            $columns = implode(',', array_keys($data));
            
            $newValues = array_map(function($value){
                return "'" . $value . "'";
            }, array_values($data));

            $newValues = implode(',', $newValues);

            $sql = "insert into $table($columns, trans_date) values($newValues, CURRENT_TIMESTAMP)";

            $this->_query($sql);
        }

        public function getAll($id)
        {
            $transhis = self::TRANSHIS;

            $sql = "select * from $transhis where account_id = $id order by trans_date desc";

            $result = $this->_query($sql);
            $data = [];

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) 
                {
                    array_push($data, $row);
                }
            }
            return $data;
        }
        
        public function getAllInMonth($id)
        {
            $transhis = self::TRANSHIS;

            $sql = "select * from $transhis where account_id = $id and MONTH(trans_date) = MONTH(CURRENT_DATE) order by trans_date desc";

            $result = $this->_query($sql);
            $data = [];

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) 
                {
                    array_push($data, $row);
                }
            }
            return $data;
        }
        public function getAllByID($id)
        {
            $transhis = self::TRANSHIS;

            $sql = "select * from $transhis where id = $id";

            $result = $this->_query($sql);

            if($result->num_rows > 0){
                return mysqli_fetch_assoc($result);
            }
        }

        public function getCard($id)
        {
            $credit = self::CREDIT;

            $sql = "select * from $credit where id = $id";

            $result = $this->_query($sql);

            if($result->num_rows > 0){
                return mysqli_fetch_assoc($result)['card'];
            }
        }

        public function transNumber($data)
        {
            $table = self::TRANSHIS;

            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' ', $dataSets);

            $sql = "select * from $table where $dataSetString and DATE(trans_date) = CURRENT_DATE() and type = 1";

            $result = $this->_query($sql);

            return $result->num_rows;
        }

        public function getTransHis($data)
        {
            $table = self::TRANSHIS;

            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' ', $dataSets);

            $sql = "select * from $table where $dataSetString order by trans_date desc";

            $result = $this->_query($sql);

            $data = [];

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) 
                {
                    array_push($data, $row);
                }
            }
            return $data;
        }

        public function resetStatus($id)
        {
            $table = self::TRANSHIS;

            $sql = "update $table set status = null where id = $id";

            $this->_query($sql);
        }

        public function setStatus($id, $status)
        {
            $table = self::TRANSHIS;

            $sql = "update $table set status = '$status' where id = $id";

            $this->_query($sql);
        }

        public function ResetTransDate($id)
        {
            $table = self::TRANSHIS;

            $sql = "update $table set trans_date = CURRENT_TIMESTAMP where id = $id";

            $this->_query($sql);
        }

        private function _query($sql)
        {
            return mysqli_query($this->connect, $sql);
        }

        
        
    }
?>