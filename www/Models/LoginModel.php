<?php
    class LoginModel extends BaseModel
    {
        const TABLE = 'account';
        protected $connect;

        public function __construct()
        {
            $this->connect = $this->connect();
        }

        public function store($data)
        {
            $this->create(self::TABLE, $data);
        }

        public function checkUserPass($data)
        {
            return $this->check(self::TABLE, $data);
        }

        public function checkPhoneEmail($data)
        {
            return $this->check(self::TABLE, $data);
        }

        public function checkPassByUser($username, $password)
        {
            $usernameSets = [];
            foreach($username as $key => $value)
            {
                array_push($usernameSets, "$key = '" . $value . "'");
            }
            $usernameSetString = implode(' ', $usernameSets);

            $passwordSets = [];
            foreach($password as $key => $value)
            {
                array_push($passwordSets, "$key != '" . $value . "'");
            }
            $passwordSetString = implode(' ', $passwordSets);

            $table = self::TABLE;

            $sql = "select * from $table where $usernameSetString and $passwordSetString";

            $result = $this->_query($sql);

            return $result->num_rows;
        }

        public function setWrongPass($data, $column)
        {
            $this->setData(self::TABLE, $data, $column);
        }

        public function setAbnormalLogin($data, $column)
        {
            $this->setData(self::TABLE, $data, $column);
        }

        public function getWrongPass($data, $column)
        {
            return $this->getData(self::TABLE, $data, $column);
        }

        public function getAbnormalLogin($data, $column)
        {
            return $this->getData(self::TABLE, $data, $column);
        }

        public function getNameByRegisterID($data, $column)
        {
            return $this->getDataTwoTable($data, $column);
        }

        public function getEmail($data, $column)
        {
            return $this->getDataTwoTable($data, $column);
        }

        public function getChangeByUsername($data, $column)
        {
            return $this->getData(self::TABLE, $data, $column);
        }

        public function getLockAccount($data, $column)
        {
            return $this->getData(self::TABLE, $data, $column);
        }

        public function getStatusByUsername($data, $column)
        {
            return $this->getData(self::TABLE, $data, $column);
        }

        public function getRequire($data, $column)
        {
            $this->getDataTwoTable($data, $column);
        }

        public function getPhone($data, $column)
        {
            $this->getDataTwoTable($data, $column);
        }

        public function changePasswordbyUsername($username, $newpass)
        {
            $this->changeData(self::TABLE, $username, $newpass);
        }

        public function setChangePasswordByUsername($username, $changepass)
        {
            $this->changeData(self::TABLE, $username, $changepass);
        }

        public function resetWrongPass($username, $wrongpass)
        {
            $this->resetData(self::TABLE, $username, $wrongpass);
        }

        public function resetAbnormalLogin($username, $abnormallogin)
        {
            $this->resetData(self::TABLE, $username, $abnormallogin);
        }

        public function setLockAccount($data, $column)
        {
            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' and ', $dataSets);

            $table = self::TABLE;

            $sql = "update $table set $column = $column + 1, lockedtime = CURRENT_TIME(), date_create = CURRENT_TIMESTAMP, status = 'đã khóa vô thời hạn' where $dataSetString";

            $this->_query($sql);
        }

        public function getCurrentDate()
        {
            $sql = "select CURRENT_DATE as date;";
            $result = $this->_query($sql);
            if($result->num_rows > 0){
                return mysqli_fetch_assoc($result)['date'];
            }
        }

        public function getCurrentTime()
        {
            $sql = "select CURRENT_TIME as time;";
            $result = $this->_query($sql);
            if($result->num_rows > 0){
                return mysqli_fetch_assoc($result)['time'];
            }
        }

        public function countdown($date, $time)
        {
            $sql = "Select TIME_TO_SEC(TIMEDIFF(CURRENT_TIME, '$time')) as time where '$date' = CURRENT_DATE;";
            $result = $this->_query($sql);
            if($result->num_rows > 0){
                return mysqli_fetch_assoc($result)['time'];
            }
        }

        public function getUsernameByPhoneAndEmail($data, $column)
        {
            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' and ', $dataSets);

            $sql = "select * from account, registers where $dataSetString and account.register_id = registers.id limit 1";
            
            $result = $this->_query($sql);

            if($result->num_rows > 0){
                return mysqli_fetch_assoc($result)[$column];
            }
        }

        public function getAccountBalance($data)
        {
            return $this->getData(self::TABLE, $data, 'account_balance');
        }

        public function updateMoney($condition, $data)
        {
            $this->update(self::TABLE, $condition, $data);
        }

        public function getID($data)
        {
            return $this->getData(self::TABLE, $data, 'id');
        }

        public function getUsername($data)
        {
            return $this->getData(self::TABLE, $data, 'username');
        }

        public function getFullname($data)
        {
            return $this->getDataTwoTable($data, 'fullname');
        }

        public function getIDByPhone($data)
        {
            $dataSets = [];
            foreach($data as $key => $value)
            {
                array_push($dataSets, "$key = '" . $value . "'");
            }
            $dataSetString = implode(' and ', $dataSets);

            $table1 = 'account';
            $table2 = 'registers';

            $sql = "select $table1.id from $table1, $table2 where $dataSetString and register_id = $table2.id";
            
            $result = $this->_query($sql);

            if($result->num_rows > 0){
                return mysqli_fetch_assoc($result)['id'];
            }
        }

        public function getRegisterIDByUsername($data)
        {
            return $this->getData(self::TABLE, $data, 'register_id');
        }


        private function _query($sql)
        {
            return mysqli_query($this->connect, $sql);
        }
    }
?>