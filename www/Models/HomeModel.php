<?php
    class HomeModel extends BaseModel
    {
        const TABLE1 = 'account';
        const TABLE2 = 'registers';

        protected $connect;

        public function GetInfoByUsername($data)
        {
            $accountTable = self::TABLE1;
            $registersTable = self::TABLE2;

            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' and ', $dataSets);

            $sql = "select * from $registersTable, $accountTable where $dataSetString and $registersTable.id = $accountTable.register_id  limit 1";
            
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

        private function _query($sql)
        {
            return mysqli_query($this->connect, $sql);
        }

    }
?>