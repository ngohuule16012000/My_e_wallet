<?php
    class AdminController extends BaseController
    {
        public function __construct()
        {
            $this->loadModel('AdminModel');
            $this->AdminModel = new AdminModel;
            $this->loadModel('CreditModel');
            $this->CreditModel = new CreditModel;
            $this->loadModel('LoginModel');
            $this->LoginModel = new LoginModel;
        }

        private $error = "";
        private $success = "";


        public function index()
        {

            if (isset($_SESSION['admin'])) 
            {
                // get fullname, username, status với status là 
                $result = $this->AdminModel->getAllInconfirmStatus();
                $this->view('frontend.head');
                $this->view('frontend.admin.navbar',[
                    'verify'    => 'verify',
                    'confirmed' => '',
                    'disable'   => '',
                    'locked'    => '',
                    'approve'   => ''
                ]);
                $this->view('frontend.admin.index',[
                    'result' => $result,
                    'error'  => ''
                ]);
                $this->view('frontend.admin.footer');
                $this->view('frontend.linkJS');
            }
            else
            {
                return $this->toLoginPage();
            }
        }

        public function toLoginPage()
        {
            $this->view('frontend.head');
            $this->view('frontend.login.index',[
                'error' => $this->error,
                'success' => $this->success
            ]);  
            $this->view('frontend.linkJS'); 
        }

        public function lockedaccount()
        {
            if (isset($_SESSION['admin'])) 
            {
                // get fullname, username, lockaccount, time với account bị khoá vô thời hạn 
                $result = $this->AdminModel->getAllLockedAccount();

                $this->view('frontend.head');
                $this->view('frontend.admin.navbar',[
                    'verify'    => '',
                    'confirmed' => '',
                    'disable'   => '',
                    'locked'    => 'locked',
                    'approve'   => ''
                ]);
                $this->view('frontend.admin.lockedaccount',[
                    'result' => $result,
                    'error'  => ''
                ]);
                $this->view('frontend.admin.footer');
                $this->view('frontend.linkJS');
            }
            else
            {
                return $this->toLoginPage();
            }
        }

        public function disableaccount()
        {
            if (isset($_SESSION['admin'])) 
            {
                // get fullname, username, lockaccount, time với account bị khoá vô thời hạn 
                $result = $this->AdminModel->getAllDisableAccount();

                $this->view('frontend.head');
                $this->view('frontend.admin.navbar',[
                    'verify'    => '',
                    'confirmed' => '',
                    'disable'   => 'disable',
                    'locked'    => '',
                    'approve'   => ''
                ]);
                $this->view('frontend.admin.disableaccount',[
                    'result' => $result,
                    'error'  => ''
                ]);
                $this->view('frontend.admin.footer');
                $this->view('frontend.linkJS');
            }
            else
            {
                return $this->toLoginPage();
            }
        }

        public function confirmedaccount()
        {
            if (isset($_SESSION['admin'])) 
            {
                // get fullname, username, lockaccount, time với account đã xác minh
                $result = $this->AdminModel->getAllConfirmedAccount();

                $this->view('frontend.head');
                $this->view('frontend.admin.navbar',[
                    'verify'    => '',
                    'confirmed' => 'confirmed',
                    'disable'   => '',
                    'locked'    => '',
                    'approve'   => ''
                ]);
                $this->view('frontend.admin.confirmedaccount',[
                    'result' => $result,
                    'error'  => ''
                ]);
                $this->view('frontend.admin.footer');
                $this->view('frontend.linkJS');
            }
            else
            {
                return $this->toLoginPage();
            }
        }

        public function detail()
        {
            if(isset($_POST['id']))
            {
                $id = $_POST['id'];

                $_SESSION['id'] = $id;
                // get detail
                $result = $this->AdminModel->getAllByID($id);

                //get lịch sử giao dịch trong tháng
                $transhis = $this->CreditModel->getAllInMonth($id);
                
                $this->view('frontend.head');
                $this->view('frontend.admin.navbar',[
                    'verify'    => '',
                    'confirmed' => '',
                    'disable'   => '',
                    'locked'    => '',
                    'approve'   => ''
                ]);
                $this->view('frontend.admin.detail',[
                    'result'    => $result,
                    'transhis'  => $transhis
                ]);
                $this->view('frontend.admin.modal',[
                    'result' => $result
                ]);
                $this->view('frontend.admin.footer');
                $this->view('frontend.linkJS'); 
            }
            
        }

        public function confirm()
        {
            if(isset($_SESSION['id']))
            {
                $id = $_SESSION['id'];

                // set  ‘chờ xác minh’ to 'đã xác minh'
                $this->AdminModel->setStatus($id, 'đã xác minh');

                return $this->index();
            }
        }

        public function disable()
        {
            if(isset($_SESSION['id']))
            {
                $id = $_SESSION['id'];

                // set ‘chờ xác minh’ to 'đã vô hiệu hóa'
                $this->AdminModel->setStatus($id, 'đã vô hiệu hóa');

                return $this->index();
            }
        }

        public function requireinfo()
        {
            if(isset($_SESSION['id']))
            {
                $id = $_SESSION['id'];

                // set ‘chờ xác minh’ to 'chờ cập nhật'
                $this->AdminModel->setStatus($id, 'chờ cập nhật');

                return $this->index();
            }
        }

        public function openlock()
        {
            if(isset($_SESSION['id']))
            {
                $id = $_SESSION['id'];

                // open lock cho account id
                $this->AdminModel->setOpenLock($id);

                return $this->lockedaccount();
            }
        }

        public function approve()
        {
            if (isset($_SESSION['admin'])) 
            {                
                //get lịch sử giao dịch chò duyệt rút/chuyển
                $transhis = $this->CreditModel->getTransHis(['status' => 'đang chờ']);

                $this->view('frontend.head');
                $this->view('frontend.admin.navbar',[
                    'verify'    => '',
                    'confirmed' => '',
                    'disable'   => '',
                    'locked'    => '',
                    'approve'   => 'approve'
                ]);
                $this->view('frontend.admin.approve',[
                    'transhis'  => $transhis
                ]);
                $this->view('frontend.admin.footer');
                $this->view('frontend.linkJS'); 
            }
            else
            {
                return $this->toLoginPage();
            }
        }

        public function transdetail()
        {
            if(isset($_POST['id']))
            {
                $id = $_POST['id'];

                $_SESSION['id'] = $id;

                // get detail
                $result = $this->AdminModel->getAllByID($id);

                //get lịch sử giao dịch
                $transhis = $this->CreditModel->getAllByID($id);
                
                $this->view('frontend.head');
                $this->view('frontend.admin.navbar',[
                    'verify'    => '',
                    'confirmed' => '',
                    'disable'   => '',
                    'locked'    => '',
                    'approve'   => ''
                ]);

                if($transhis['type'] == 1)
                {
                    $this->view('frontend.admin.detaildraw',[
                        'transhis'  => $transhis
                    ]);
                }
                else if($transhis['type'] == 2)
                {
                    $_SESSION['sender_id'] = $this->LoginModel->getUsername([ 'id' => $transhis['account_id']]);
                    $_SESSION['receiver_id'] = $this->LoginModel->getUsername([ 'id' => $transhis['receiver_id']]);    
                    $this->view('frontend.admin.detailtransfer',[
                        'transhis'  => $transhis
                    ]);
                }
                $this->view('frontend.admin.modal',[
                    'result' => $result
                ]);
                $this->view('frontend.admin.footer');
                $this->view('frontend.linkJS'); 
            }
        }

        public function transapprove()
        {
            if(isset($_SESSION['id']))
            {
                $id = $_SESSION['id'];

                //get lịch sử giao dịch
                $transhis = $this->CreditModel->getAllByID($id);

                $type = $transhis['type'];

                if($type == 1) // rút tiền
                {

                    $account_balance = $this->LoginModel->getAccountBalance(['id' => $transhis['account_id']]);
                    // kiểm tiền trong ví
                    $account_balance = $account_balance - ((int) $transhis['money'] + (int) $transhis['fee']);

                    if($account_balance < 0)
                    {
                        //tự động huỷ do không đủ tiền
                        $this->CreditModel->setStatus($id, 'bị huỷ');
                        //update thời gian giao dịch
                        $this->CreditModel->ResetTransDate($id);
                        return $this->approve();
                    }

                    // update account_balance
                    $this->LoginModel->updateMoney(['id' => $transhis['account_id']], ['account_balance' => $account_balance]);

                    //reset status bằng null
                    $this->CreditModel->resetStatus($id);

                    //update thời gian giao dịch
                    $this->CreditModel->ResetTransDate($id);

                }
                else if($type == 2) // chuyển tiền
                {
                    $account_balance_sender = $this->LoginModel->getAccountBalance(['id' => $transhis['account_id']]);
                    $account_balance_receiver = $this->LoginModel->getAccountBalance(['id' => $transhis['receiver_id']]);
                    $fee = $transhis['fee'];
                    $money = $transhis['money'];
                    // kiểm tiền trong ví
                    
                    if((int)$fee > 0) // người gửi trả
                    {
                        $account_balance_sender = $account_balance_sender - ((int) $money + (int) $fee);
                        $account_balance_receiver = $account_balance_receiver + (int) $money;
                    }
                    else // người nhận trả
                    {
                        $account_balance_sender = $account_balance_sender - (int) $money;
                        $account_balance_receiver = $account_balance_receiver + (int) $money - (int) $fee;
                    }

                    

                    if($account_balance_sender < 0)
                    {
                        //tự động huỷ do không đủ tiền
                        $this->CreditModel->setStatus($id, 'bị huỷ');
                        //update thời gian giao dịch
                        $this->CreditModel->ResetTransDate($id);
                        return $this->approve();
                    }

                    // update account_balance_sender
                    $this->LoginModel->updateMoney(['id' => $transhis['account_id']], ['account_balance' => $account_balance_sender]);
                    // update account_balance_receiver
                    $this->LoginModel->updateMoney(['id' => $transhis['receiver_id']], ['account_balance' => $account_balance_receiver]);
                    //update thời gian giao dịch
                    $this->CreditModel->ResetTransDate($id);
                    //reset status bằng null
                    $this->CreditModel->resetStatus($id);

                    //set transaction history người nhận
                    $id_receiver = $transhis['receiver_id'];
                    $sender_id =  $transhis['account_id'];
                    $note = $transhis['note'];

                    if((int)$fee > 0) // người gửi trả
                    {
                        $this->CreditModel->store([
                            'account_id'=> $id_receiver,
                            'money'     => $money,
                            'type'      => 3,
                            'note'      => $note,
                            'sender_id' => $sender_id
                        ]);
                    }
                    else // người nhận trả
                    {
                        $fee = (int) ((int) $money * 0.05);
                        $this->CreditModel->store([
                            'account_id'=> $id_receiver,
                            'money'     => $money,
                            'type'      => 3,
                            'note'      => $note,
                            'fee'       => $fee,
                            'sender_id' => $sender_id
                        ]);
                    }
                    $username = $this->LoginModel->getUsername(['id' => $id_receiver]);
                    $email = $this->LoginModel->getEmail(['username' => $username], 'email');
                    
                    $subject = "Thông báo nhận tiền trên website ví điện tử";
                    $body = "Bạn đã nhận thành công số tiền " . $money . " được chuyển bởi tài khoản " . $sender_id .
                        "<br>Bạn có thể xem chi tiết trong lịch sử giao dịch.";
                    
                    $this->sendEmail($email, $subject, $body);
                }

                return $this->approve();
            }
        }

        public function transinapprove()
        {
            if(isset($_SESSION['id']))
            {
                $id = $_SESSION['id'];

                $this->CreditModel->setStatus($id, 'bị huỷ');
                //update thời gian giao dịch
                $this->CreditModel->ResetTransDate($id);                

                return $this->approve();
            }
        }

    }
?>