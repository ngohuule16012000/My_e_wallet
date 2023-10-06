<?php
    class AdminModel extends BaseModel
    {
        const TABLE1 = 'account';
        const TABLE2 = 'registers';

        protected $connect;

        public function getAllInconfirmStatus()
        {
            $accountTable = self::TABLE1;
            $registersTable = self::TABLE2;

            $sql = "select * from $registersTable, $accountTable where (status = 'chờ xác minh' or status = 'chờ cập nhật') and $registersTable.id = $accountTable.register_id  order by $accountTable.date_create desc";

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

        public function getAllLockedAccount()
        {
            $accountTable = self::TABLE1;
            $registersTable = self::TABLE2;

            $sql = "select * from $registersTable, $accountTable  where lockaccount = '1' and $registersTable.id = $accountTable.register_id  order by lockedtime desc";

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

        public function getAllDisableAccount()
        {
            $accountTable = self::TABLE1;
            $registersTable = self::TABLE2;

            $sql = "select * from $registersTable, $accountTable where status = 'đã vô hiệu hóa' and $registersTable.id = $accountTable.register_id  order by $accountTable.date_create desc";

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


        public function getAllConfirmedAccount()
        {
            $accountTable = self::TABLE1;
            $registersTable = self::TABLE2;

            $sql = "select * from $registersTable, $accountTable where status = 'đã xác minh' and $registersTable.id = $accountTable.register_id  order by $accountTable.date_create desc";

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
            $accountTable = self::TABLE1;
            $registersTable = self::TABLE2;

            $sql = "select * from $registersTable, $accountTable where $registersTable.id = $accountTable.register_id and $accountTable.id = $id";

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

        public function setStatus($id, $status)
        {
            $this->setStatusAccount(self::TABLE1, $status, $id);
        }

        public function setStatusByUsername($username, $status)
        {
            $table = self::TABLE1;

            $dataSets = [];
            foreach($username as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' ', $dataSets);

            $sql = "update $table set status = '$status', date_create = CURRENT_TIMESTAMP where $dataSetString";
            
            $this->_query($sql);
        }

        public function setOpenLock($id)
        {
            $account = self::TABLE1;

            $sql = "update $account set wrongpass = '0', abnormal_login = '0', lockaccount = '0', lockedtime = null, status = 'chờ xác minh' where id = $id";

            $this->_query($sql);
        }

        public function setImageByUsername($username, $data)
        {
            $registerTable = self::TABLE2;

            $dataSets1 = [];
            foreach($username as $key => $value)
            {
                array_push($dataSets1, "$key = '" . $value . "'");
            }
            $dataSetString1 = implode(' ', $dataSets1);

            $dataSets2 = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets2, "$key = '" . $value . "'");
            }
            $dataSetString2 = implode(' ', $dataSets2);

            $sql = "update $registerTable set $dataSetString2 where $dataSetString1";
            $this->_query($sql);
        }


        private function _query($sql)
        {
            return mysqli_query($this->connect, $sql);
        }


        
    }
?>