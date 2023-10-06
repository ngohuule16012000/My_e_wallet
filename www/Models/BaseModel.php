<?php
    class BaseModel extends database
    {
        protected $connect;
        
        public function __construct()
        {
            $this->connect = $this->connect();
        }

        public function all($table, $select = ['*'], $orderBy = [], $limit = 15)
        {
            $columns = implode(',', $select);
            $orderByString = implode(' ', $orderBy);

            if($orderByString)
            {
                $sql = "select $columns from $table order by $orderByString limit $limit";
            }
            else
            {
                $sql = "select $columns from $table limit $limit";
            }

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

        public function find($table, $id)
        {
            $sql = "select * from $table where id = $id limit 1";
            $query = $this->_query($sql);
            return mysqli_fetch_assoc($query);
        }

        public function create($table, $data = [])
        {
            $columns = implode(',', array_keys($data));
            
            $newValues = array_map(function($value){
                return "'" . $value . "'";
            }, array_values($data));

            $newValues = implode(',', $newValues);

            $sql = "insert into $table($columns) values($newValues)";

            $this->_query($sql);
        }

        public function update($table, $condition ,$data)
        {
            $dataSets1 = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets1, "$key = '" . $value . "'");
            }
            $dataSetString1 = implode(',', $dataSets1);

            $dataSets2 = [];
            foreach($condition as $key => $value)
            {
                array_push($dataSets2, "$key = '" . $value . "'");
            }
            $dataSetString2 = implode(' and ', $dataSets2);
            
            $sql = "update $table set $dataSetString1 where $dataSetString2";
            
            $this->_query($sql);
        }

        public function delete($table, $id)
        {
            $sql = "delete from $table where id = $id";
            $this->_query($sql);
        }

        public function check($table, $data)
        {
            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' and ', $dataSets);

            $sql = "select * from $table where $dataSetString";

            $result = $this->_query($sql);

            return $result->num_rows;
        }

        public function getData($table, $data, $column)
        {
            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' and ', $dataSets);

            $sql = "select * from $table where $dataSetString";
            
            $result = $this->_query($sql);

            if($result->num_rows > 0){
                return mysqli_fetch_assoc($result)[$column];
            }
        }

        public function getDataTwoTable($data, $column)
        {
            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' and ', $dataSets);

            $table1 = 'account';
            $table2 = 'registers';

            $sql = "select * from $table1, $table2 where $dataSetString and register_id = $table2.id";
            
            $result = $this->_query($sql);

            if($result->num_rows > 0){
                return mysqli_fetch_assoc($result)[$column];
            }
        }

        public function setData($table, $data, $column)
        {
            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' and ', $dataSets);

            $sql = "update $table set $column = $column + 1 where $dataSetString";

            $this->_query($sql);
        }

        public function resetData($table, $data, $column)
        {
            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' and ', $dataSets);

            $sql = "update $table set $column = 0 where $dataSetString";

            $this->_query($sql);
        }

        public function changeData($table, $conditiondata, $setdata)
        {
            $conditiondataSets = [];
            foreach($conditiondata as $key => $value)
            {
                array_push($conditiondataSets, "$key = '" . $value . "'");
            }
            $conditiondataSetString = implode(' and ', $conditiondataSets);

            $setdataSets = [];
            foreach($setdata as $key => $value)
            {
                array_push($setdataSets, "$key = '" . $value . "'");
            }
            $setdataSetString = implode(' and ', $setdataSets);

            $sql = "update $table set $setdataSetString where $conditiondataSetString";
            
            $this->_query($sql);
        }

        public function setStatusAccount($table, $status, $id)
        {
            $sql = "update $table set status = '$status', date_create = CURRENT_TIMESTAMP where id = $id";
            
            $this->_query($sql);

        }

        private function _query($sql)
        {
            return mysqli_query($this->connect, $sql);
        }

    }
?>