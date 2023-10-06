<?php
    class HomeController extends BaseController
    {
        public $errorupload = '';
        private $error = '';
        private $result = '';
        private $success = '';
        public function __construct()
        {
            $this->loadModel('HomeModel');
            $this->HomeModel = new HomeModel;
            $this->loadModel('LoginModel');
            $this->LoginModel = new LoginModel;
            $this->loadModel('RegisterModel');
            $this->RegisterModel = new RegisterModel;
            $this->loadModel('AdminModel');
            $this->AdminModel = new AdminModel;
            $this->loadModel('CreditModel');
            $this->CreditModel = new CreditModel;
            $this->loadModel('PhonecardModel');
            $this->PhonecardModel = new PhonecardModel;
        }


        public function index()
        {
            if(isset($_SESSION['user']) && $_SESSION['user'] !== 'admin')
            {
                // lấy status bằng username
                $status = $this->LoginModel->getStatusByUsername(['username' => $_SESSION['user']], 'status');
                $require = '';

                if($status === 'chờ cập nhật')
                {
                    $require = "Yêu cầu upload lại ảnh hai mặt của CMND để được xác minh tài khoản";
                }
                //get infomation person
                $result = $this->HomeModel->GetInfoByUsername([
                    'username' => $_SESSION['user']
                ]);

                $this->view('frontend.head');
                //$this->view('frontend.home.head');
                $this->view('frontend.home.navbar',[
                    'detail'    => 'detail',
                    'deposit'   => '',
                    'draw'      => '',
                    'transfer'  => '',
                    'phonecard' => '',
                    'transhis'  => ''
                ]);
                $this->view('frontend.home.index',[
                    'error'     => $require,
                    'result'    => $result,
                    'errorupload'=> $this->errorupload
                ]);
                $this->view('frontend.home.upload_modal',[
                    'result' => $result
                ]);
                $this->view('frontend.home.footer');
                $this->view('frontend.linkJS');
            }
            else if(isset($_SESSION['change']))
            {
                $this->changePass();
            }
            else
            {
                $this->view('frontend.head');
                $this->view('frontend.login.index',[
                    'error' => $this->error,
                    'success' => $this->success
                ]);  
                $this->view('frontend.linkJS'); 
                // $this->view('frontend.registers.index',[
                //     'error'     => '', 
                //     'success'   => '', 
                //     'username'  => '', 
                //     'password'  => ''
                // ]);
            }
        }

        public function upload()
        {
            if (isset($_POST['submit']) && isset($_FILES['fontimage']) && isset($_FILES['backimage'])) {
                $flag = 0;
                if ($_FILES['fontimage']['error'] > 0)
                    $this->errorupload = "Upload lỗi rồi!";
                else {
                    move_uploaded_file($_FILES['fontimage']['tmp_name'], root . '/public/upload/' . $_FILES['fontimage']['name']);
                    $flag += 1;
                }

                if ($_FILES['backimage']['error'] > 0)
                    $this->errorupload = "Upload lỗi rồi!";
                else {
                    move_uploaded_file($_FILES['backimage']['tmp_name'], root . '/public/upload/' . $_FILES['backimage']['name']);
                    $flag += 1;
                }

                if($flag == 2)
                {
                    // đã upload cmnd theo yêu cầu
                    // set status
                    $this->AdminModel->setStatusByUsername(['username' => $_SESSION['user']], 'chờ xác minh');

                    // get id register
                    $id = $this->LoginModel->getRegisterIDByUsername(['username' => $_SESSION['user']]);

                    // set fontimage
                    $this->AdminModel->setImageByUsername(['id' => $id], ['fontimage' => $_FILES['fontimage']['name']]);
                    // set backimage
                    $this->AdminModel->setImageByUsername(['id' => $id], ['backimage' => $_FILES['backimage']['name']]);
                    
                    return $this->index();
                }
            }
        }

        public function deposit()
        {
            $this->view('frontend.head');
            //$this->view('frontend.home.head');
            $this->view('frontend.home.navbar',[
                'detail'    => '',
                'deposit'   => 'deposit',
                'draw'      => '',
                'transfer'  => '',
                'phonecard' => '',
                'transhis'  => ''
            ]);
            $this->view('frontend.home.deposit',[
                'error'     => $this->error,
                'success'    => $this->success
            ]);
            $this->view('frontend.home.footer');
            $this->view('frontend.linkJS');
        }

        public function depositcheck()
        {
            if(isset($_POST['money']) && isset($_POST['card']) && isset($_POST['exdate']) && isset($_POST['cvv']))
            {
                $money  = $_POST['money'];
                $card   = $_POST['card'];
                $exdate = $_POST['exdate'];
                $cvv    = $_POST['cvv'];

                $cardResult = $this->CreditModel->checkCard(['card' => $card]);
                $exdateResult = $this->CreditModel->checkExdate(['exdate' => $exdate, 'card' => $card]);
                $cvvResult = $this->CreditModel->checkCvv(['cvv' => $cvv, 'card' => $card]);

                if (strlen($card) !== 6) 
                {
                    $this->error = "Số thẻ phải đúng 6 chữ số";
                    return $this->deposit();
                }
                else if($cardResult == 0)
                {
                    $this->error = "Thẻ này không được hỗ trợ";
                    return $this->deposit();
                }
                else if($card == '222222' && ((int) $money) > 1000000)
                {
                    $this->error = "Chỉ được nạp tối đa 1 triệu/lần";
                    return $this->deposit();
                }
                else if($card == '333333')
                {
                    $this->error = "Thẻ hết tiền";
                    return $this->deposit();
                }
                else if($exdateResult == 0)
                {
                    $this->error = "Ngày hết hạn không hợp lệ";
                    return $this->deposit();
                }
                else if (strlen($cvv) !== 3) 
                {
                    $this->error = "Số cvv phải đúng 3 chữ số";
                    return $this->deposit();
                }
                else if($cvvResult == 0)
                {
                    $this->error = "Mã CVV không hợp lệ";
                    return $this->deposit();
                }
                else
                {
                    $username = $_SESSION['user'];
                    $id = $this->LoginModel->getID(['username' => $username]);
                    $credit_id =  $this->CreditModel->getCreditID(['card' => $card]);
                    // ghi lại lịch sử giao dịch
                    $this->CreditModel->store([
                        'account_id'  => $id,
                        'credit_id' => $credit_id,
                        'money'     => $money
                    ]);

                    $account_balance = $this->LoginModel->getAccountBalance(['username' => $username]);

                    $account_balance = (int) $account_balance + (int) $money;

                    //update account_balance
                    $this->LoginModel->updateMoney(['username' => $username], ['account_balance' => $account_balance]);

                    $this->success = "Nạp thành công $money.\n";
                    return $this->deposit();
                }
            }
        }

        public function draw()
        {
            $this->view('frontend.head');
            //$this->view('frontend.home.head');
            $this->view('frontend.home.navbar',[
                'detail'    => '',
                'deposit'   => '',
                'draw'      => 'draw',
                'transfer'  => '',
                'phonecard' => '',
                'transhis'  => ''
            ]);
            $this->view('frontend.home.draw',[
                'error'     => $this->error,
                'success'    => $this->success
            ]);
            $this->view('frontend.home.footer');
            $this->view('frontend.linkJS');
        }

        public function drawcheck()
        {
            if(isset($_POST['money']) && isset($_POST['card']) && isset($_POST['exdate']) && isset($_POST['cvv']) && isset($_POST['note']))
            {
                $money  = $_POST['money'];
                $card   = $_POST['card'];
                $exdate = $_POST['exdate'];
                $cvv    = $_POST['cvv'];
                $note   = $_POST['note'];

                $exdateResult = $this->CreditModel->checkExdate(['exdate' => $exdate, 'card' => $card]);
                $cvvResult = $this->CreditModel->checkCvv(['cvv' => $cvv, 'card' => $card]);

                if( (int)$money % 50000 != 0)
                {
                    $this->error = "Số tiền rút mỗi lần phải là bội số của 50,000 đồng";
                    return $this->draw();
                }
                if(strlen($card) != 6)
                {
                    $this->error = "Số thẻ phải đúng 6 chữ số";
                    return $this->draw();
                }
                else if($card != '111111')
                {
                    $this->error = "Thẻ này không được hỗ trợ để rút tiền";
                    return $this->draw();
                }
                else if($exdateResult == 0)
                {
                    $this->error = "Ngày hết hạn không hợp lệ";
                    return $this->draw();
                }
                else if($cvvResult == 0)
                {
                    $this->error = "Mã CVV không hợp lệ";
                    return $this->draw();
                }
                else
                {
                    // lấy account_id và credit_id
                    $username = $_SESSION['user'];
                    $id = $this->LoginModel->getID(['username' => $username]);
                    $credit_id =  $this->CreditModel->getCreditID(['card' => $card]);
    
                    // kiểm tra số lần giao dịch
                    $transnumber = $this->CreditModel->transNumber(['account_id' => $id]);

                    if($transnumber > 2)
                    {
                        $this->error = "Mỗi ngày chỉ được tạo tối đa 2 giao dịch rút tiền.";
                        return $this->draw();
                    }

                    // Phí rút tiền
                    $fee = (int)($money * 0.05);

                    // Số tiền còn lại trong ví
                    $account_balance = $this->LoginModel->getAccountBalance(['username' => $username]);
                    $moneytotal = (int) $account_balance - ((int) $money + $fee);

                    if($moneytotal < 0)
                    {
                        $this->error = "Bạn không thể rút số tiền lớn hơn $account_balance.";
                        return $this->draw();
                    }

                    // Trạng thái giao dịch
                    if($money > 5000000)
                    {
                        $status = "đang chờ";
                        // ghi vào lịch sử giao dịch rút tiền
                        // type: 
                        // 0: nạp tiền (default)
                        // 1: rút tiền
                        // 2: chuyển tiền
                        // 3: nhận tiền
                        // 4: phonecard
                        $this->CreditModel->store([
                            'account_id'=> $id,
                            'credit_id' => $credit_id,
                            'money'     => $money,
                            'type'      => 1,
                            'note'      => $note,
                            'status'    => $status,
                            'fee'       => $fee
                        ]);

                        $this->success = "Bạn đang rút $money.\n Đang chờ duyệt.";
                        return $this->draw();

                    }

                    $this->CreditModel->store([
                        'account_id'=> $id,
                        'credit_id' => $credit_id,
                        'money'     => $money,
                        'type'      => 1,
                        'note'      => $note,
                        'fee'       => $fee
                    ]);

                    
                    //update account_balance
                    $this->LoginModel->updateMoney(['username' => $username], ['account_balance' => $moneytotal]);

                    $this->success = "Rút thành công $money.\n";
                    return $this->draw();
                    
                }
            }
        }

        public function transferinfo()
        {
            $this->view('frontend.head');
            //$this->view('frontend.home.head');
            $this->view('frontend.home.navbar',[
                'detail'    => '',
                'deposit'   => '',
                'draw'      => '',
                'transfer'  => 'transfer',
                'phonecard' => '',
                'transhis'  => ''
            ]);
            $this->view('frontend.home.transferinfo',[
                'error'     => $this->error,
                'success'    => $this->success
            ]);
            $this->view('frontend.home.footer');
            $this->view('frontend.linkJS');
        }

        public function transferinfocheck()
        {
            if(isset($_POST['phone']) && isset($_POST['money']) && isset($_POST['note']))
            {   
                $phone = $_POST['phone'];
                $phonechk = $this->RegisterModel->checkEmailPhone(['phone' => $phone]);
                $username = $this->RegisterModel->getUsernameByPhone([
                    'phone' => $phone,
                    ],
                    'username'
                );

                $money = $_POST['money'];
                $note = $_POST['note'];

                if($phonechk == 0)
                {
                    $this->error = 'Số điện thoại này không được hỗ trợ.';
                    return $this->transferinfo();
                }
                else if( (int)$money % 50000 != 0)
                {
                    $this->error = "Số tiền rút mỗi lần phải là bội số của 50,000 đồng";
                    return $this->transferinfo();
                }
                else if($username == $_SESSION['user'])
                {
                    $this->error = 'Số điện thoại không khả dụng';
                    return $this->transferinfo();
                }
                else
                {   
                    // set session
                    $_SESSION['phone_transfer'] = $phone;
                    $_SESSION['money_transfer'] = $money;
                    $_SESSION['name_transfer'] = $this->RegisterModel->getNameByPhone([
                        'phone' => $phone,
                        ],
                        'fullname'
                    );
                    $_SESSION['fee_transfer'] = (int) ((int) $money * 0.05);
                    $_SESSION['note_transfer'] = $note;
                    
                    $this->view('frontend.head');
                    //$this->view('frontend.home.head');
                    $this->view('frontend.home.navbar',[
                        'detail'    => '',
                        'deposit'   => '',
                        'draw'      => '',
                        'transfer'  => 'transfer',
                        'phonecard' => '',
                        'transhis'  => ''
                    ]);
                    $this->view('frontend.home.transfer',[
                        'error'     => $this->error,
                        'success'    => $this->success
                    ]);
                    $this->view('frontend.home.footer');
                    $this->view('frontend.linkJS');
                    return;
                }
            }
        }

        public function setOtp()
        {
            // set opt code
            $opt = rand(100000, 999999);
            $_SESSION["otp"] = $opt;
            //$result = $this->sendOTPCodeEmail($email);
            $_SESSION['current_date'] = $this->LoginModel->getCurrentDate();
            $_SESSION['current_time'] = $this->LoginModel->getCurrentTime();

            //gửi otp code đến email
            $subject = "Mã OTP dịch vụ chuyển tiền";
            $body = "Mã OTP xác nhận chuyển tiền là <h2>" . $_SESSION["otp"] . "</h2>.<br>Mã có hiệu lực trong 1 phút.";
            $this->sendEmail($_SESSION['email'], $subject, $body);

            //$this->error = "Mã OTP: " . $_SESSION['otp'] . "\n Mã có hiệu lực trong 1 phút.";
        }

        public function otpcode()
        {
            if(isset($_POST['party']))
            {
                $party = $_POST['party'];
                $_SESSION['party_transfer'] = $party;
            }
            
            $this->setOtp();

            $this->view('frontend.head');
            //$this->view('frontend.home.head');
            $this->view('frontend.home.navbar',[
                'detail'    => '',
                'deposit'   => '',
                'draw'      => '',
                'transfer'  => 'transfer',
                'phonecard' => '',
                'transhis'  => ''
            ]);
            $this->view('frontend.home.otpcode',[
                'error'     => $this->error
            ]);
            $this->view('frontend.home.footer');
            $this->view('frontend.linkJS');
        }

        public function backotpcode()
        {
            $this->view('frontend.head');
            //$this->view('frontend.home.head');
            $this->view('frontend.home.navbar',[
                'detail'    => '',
                'deposit'   => '',
                'draw'      => '',
                'transfer'  => 'transfer',
                'phonecard' => '',
                'transhis'  => ''
            ]);
            $this->view('frontend.home.otpcode',[
                'error'     => $this->error
            ]);
            $this->view('frontend.home.footer');
            $this->view('frontend.linkJS');
        }

        public function otpcheck()
        {
            if(isset($_POST["otp"]))
            {
               
                if(isset($_SESSION['current_date']) && $_SESSION['current_date'] != '')
                {
                    $countdown = $this->LoginModel->countdown($_SESSION['current_date'], $_SESSION['current_time']);

                    if($countdown <= 60 && $countdown > 0)
                    {
                        $otp = $_POST["otp"];
                        if($otp == $_SESSION["otp"])
                        {
                            return $this->setTransfer();
                        }
                        else
                        {
                            $this->error = "Sai mã otp. <br>Vui lòng nhập lại";
                            return $this->backotpcode();
                        }
                    }
                    else
                    {                        
                        $this->error = "Mã OTP đã hết hiệu lực.";
                        return $this->backotpcode();
                    }
                }
            }
        }

        public function setTransfer()
        {
            // set history transfer
            $phone = $_SESSION['phone_transfer'];
            $money = $_SESSION['money_transfer'];
            $name = $_SESSION['name_transfer'];
            $fee = $_SESSION['fee_transfer'];
            $note = $_SESSION['note_transfer'];
            $party = $_SESSION['party_transfer'];

            $id = $this->LoginModel->getID(['username' => $_SESSION['user']]);
            $username_sender = $_SESSION['user'];
            $id_receiver = $this->LoginModel->getIDByPhone(['phone' => $phone]);

            $account_balance_sender = $this->LoginModel->getAccountBalance(['username' => $username_sender]);

            if($party == 'sender')
            {
                $moneytotal = (int) $account_balance_sender - ((int) $money + (int) $fee);
            }
            else
            {
                $moneytotal = (int) $account_balance_sender - (int) $money;
            }
            
            if($moneytotal < 0)
            {
                $this->error = "Bạn không thể chuyển số tiền lớn hơn $account_balance_sender.";
                return $this->transferinfo();
            }

            // Trạng thái giao dịch
            if((int) $money > 5000000)
            {
                $status = "đang chờ";
                // ghi vào lịch sử giao dịch rút tiền
                // type: 
                // 0: nạp tiền (default)
                // 1: rút tiền
                // 2: chuyển tiền
                // 3: nhận tiền
                // 4: phonecard

                if($party == 'sender')
                {
                    $this->CreditModel->store([
                        'account_id'    => $id,
                        'money'         => $money,
                        'type'          => 2,
                        'note'          => $note,
                        'status'        => $status,
                        'fee'           => $fee,
                        'receiver_id'   => $id_receiver
                    ]);
               
                    // $this->CreditModel->store([
                    //     'account_id'=> $id_receiver,
                    //     'money'     => $money,
                    //     'type'      => 3,
                    //     'note'      => $note,
                    //     'status'    => $status,
                    //     'sender_id' => $id
                    // ]);
                }
                else
                {
                    $this->CreditModel->store([
                        'account_id'    => $id,
                        'money'         => $money,
                        'type'          => 2,
                        'note'          => $note,
                        'status'        => $status,
                        'receiver_id'   => $id_receiver
                    ]);

                    // $this->CreditModel->store([
                    //     'account_id'=> $id_receiver,
                    //     'money'     => $money,
                    //     'type'      => 3,
                    //     'note'      => $note,
                    //     'fee'       => $fee,
                    //     'sender_id' => $id
                    // ]);
                }

                $this->success = "Bạn đang chuyển $money cho $name.\n Đang chờ duyệt.";
                return $this->transferinfo();
            }


            $username_receiver = $this->RegisterModel->getUsernameByPhone(['phone' => $phone], 'username');
            $account_balance_receiver = $this->LoginModel->getAccountBalance(['username' => $username_receiver]);

            // store nhận
            if($party == 'sender')
            {
                $account_balance_sender = $account_balance_sender - ((int) $money + (int) $fee);
                $account_balance_receiver = $account_balance_receiver + (int) $money;
                
                $this->CreditModel->store([
                    'account_id'=> $id_receiver,
                    'money'     => $money,
                    'type'      => 3,
                    'note'      => $note,
                    'sender_id' => $id
                ]);

                $this->CreditModel->store([
                    'account_id'    => $id,
                    'money'         => $money,
                    'type'          => 2,
                    'note'          => $note,
                    'fee'           => $fee,
                    'receiver_id'   => $id_receiver
                ]);
            }
            else
            {
                $account_balance_sender = $account_balance_sender - (int) $money;
                $account_balance_receiver = $account_balance_receiver + (int) $money - (int) $fee;
                 
                $this->CreditModel->store([
                    'account_id'=> $id_receiver,
                    'money'     => $money,
                    'type'      => 3,
                    'note'      => $note,
                    'fee'       => $fee,
                    'sender_id' => $id
                ]);
                
                $this->CreditModel->store([
                    'account_id'    => $id,
                    'money'         => $money,
                    'type'          => 2,
                    'note'          => $note,
                    'receiver_id'   => $id_receiver
                ]);
            }

            //gửi thông báo nhận tiền do người khác chuyển đến email
            $email = $this->LoginModel->getEmail(['username' => $username_receiver], 'email');
            $subject = "Thông báo nhận tiền trên website ví điện tử";
            $body = "Bạn đã nhận thành công số tiền " . $money . " được chuyển bởi tài khoản " . $username_sender .
                "<br>Bạn có thể xem chi tiết trong lịch sử giao dịch.";
            
            $this->sendEmail($email, $subject, $body);

            //update account_balance receiver
            $this->LoginModel->updateMoney(['username' => $username_receiver], ['account_balance' => $account_balance_receiver]);
            //update account_balance sender
            $this->LoginModel->updateMoney(['username' => $username_sender], ['account_balance' => $account_balance_sender]);
               
            $this->success = "Chuyển thành công $money.\n";
            return $this->transferinfo();
        }

        public function phonecard()
        {
            $_SESSION['cardcode'] = '';
            $this->view('frontend.head');
            //$this->view('frontend.home.head');
            $this->view('frontend.home.navbar',[
                'detail'    => '',
                'deposit'   => '',
                'draw'      => '',
                'transfer'  => '',
                'phonecard' => 'phonecard',
                'transhis'  => ''
            ]);
            $this->view('frontend.home.phonecard',[
                'error'     => $this->error,
                'success'   => $this->success
            ]);
            $this->view('frontend.home.footer');
            $this->view('frontend.linkJS');
        }

        // var for phonecardcheck

        public function phonecardcheck()
        {
            if (isset($_SESSION['cardcode']) && $_SESSION['cardcode'] != '')
            {
                $this->view('frontend.head');
                //$this->view('frontend.home.head');
                $this->view('frontend.home.navbar',[
                    'detail'    => '',
                    'deposit'   => '',
                    'draw'      => '',
                    'transfer'  => '',
                    'phonecard' => 'phonecard',
                    'transhis'  => ''
                ]);
                $this->view('frontend.home.phonecardresult', [
                    'home'      => $_SESSION['home_card'],
                    'fee'       => $_SESSION['fee_card'],
                    'money'     => $_SESSION['money_card'],
                    'quantity'  => $_SESSION['quantity_card'],
                    'cardcode'  => $_SESSION['cardcode_card']
                ]);
                $this->view('frontend.home.footer');
                $this->view('frontend.linkJS');
                return;
            }
            else if(isset($_POST['home']) && isset($_POST['money']) && isset($_POST['quantity']))
            {
                $home = $_POST['home'];
                $money = $_POST['money'];
                $quantity = $_POST['quantity'];

                $fee = $this->PhonecardModel->getCode(['home' => $home], 'fee') * (int) $quantity;
                if($fee == ''){
                    $fee = 0;
                }
                $moneytotal = (int) $money * (int) $quantity + (int) $fee;

                // lấy account_id
                $username = $_SESSION['user'];
                $id = $this->LoginModel->getID(['username' => $username]);
                $account_balance = $this->LoginModel->getAccountBalance(['username' => $username]);
                $account_balance = $account_balance - $moneytotal;

                if($account_balance < 0)
                {
                    $this->error = "Bạn không đủ tiền trong ví.";
                    return $this->phonecard();
                }

                $homecode = $this->PhonecardModel->getCode(['home' => $home], 'code');
                $cardcode = [];
                $codes = "";
                for($i = 0; $i < $quantity; $i++)
                {
                    $code = $homecode . (string)rand(10000, 99999);
                    array_push($cardcode, $code);
                    $codes .= $code . ' '; 
                }
                
                //set transaction history
                if($fee > 0)
                {
                    $this->CreditModel->store([
                        'account_id'=> $id,
                        'money'     => $moneytotal,
                        'type'      => 4,
                        'fee'       => $fee,
                        'home'      => $home,
                        'quantity'  => $quantity,
                        'cardcode'  => $codes, 
                        'valuecard' => $money
                    ]);
                }
                else
                {
                    $this->CreditModel->store([
                        'account_id'=> $id,
                        'money'     => $moneytotal,
                        'type'      => 4,
                        'home'      => $home,
                        'quantity'  => $quantity,
                        'cardcode'  => $codes, 
                        'valuecard' => $money
                    ]);
                }

                //update account_balance
                $this->LoginModel->updateMoney(['username' => $username], ['account_balance' => $account_balance]);
                   

                $_SESSION['cardcode'] = 'yes';
                $_SESSION['home_card'] = $home;
                $_SESSION['fee_card'] = $fee;
                $_SESSION['money_card'] = $money;
                $_SESSION['quantity_card'] = $quantity;
                $_SESSION['cardcode_card'] = $cardcode;


                $this->view('frontend.head');
                //$this->view('frontend.home.head');
                $this->view('frontend.home.navbar',[
                    'detail'    => '',
                    'deposit'   => '',
                    'draw'      => '',
                    'transfer'  => '',
                    'phonecard' => 'phonecard',
                    'transhis'  => ''
                ]);
                $this->view('frontend.home.phonecardresult', [
                    'home'      => $_SESSION['home_card'],
                    'fee'       => $_SESSION['fee_card'],
                    'money'     => $_SESSION['money_card'],
                    'quantity'  => $_SESSION['quantity_card'],
                    'cardcode'  => $_SESSION['cardcode_card']
                ]);
                $this->view('frontend.home.footer');
                $this->view('frontend.linkJS');
                return;
            }
        }

        public function transhis()
        {
            //get infomation person
            $result = $this->HomeModel->GetInfoByUsername([
                'username' => $_SESSION['user']
            ]);

            //get lịch sử giao dịch
            $transhis = $this->CreditModel->getAll($result[0]['id']);

            $this->view('frontend.head');
            //$this->view('frontend.home.head');
            $this->view('frontend.home.navbar',[
                'detail'    => '',
                'deposit'   => '',
                'draw'      => '',
                'transfer'  => '',
                'phonecard' => '',
                'transhis'  => 'transhis'
            ]);
            $this->view('frontend.home.transactionhistory',[
                'result'    => $result,
                'transhis'  => $transhis
            ]);
            $this->view('frontend.home.footer');
            $this->view('frontend.linkJS');

        }

        public function detail()
        {
            if(isset($_POST['id']))
            {
                $id = $_POST['id'];
                $result = $this->CreditModel->getAllByID($id);
                $type = $result['type'];

                $this->view('frontend.head');
                //$this->view('frontend.home.head');
                $this->view('frontend.home.navbar',[
                    'detail'    => '',
                    'deposit'   => '',
                    'draw'      => '',
                    'transfer'  => '',
                    'phonecard' => '',
                    'transhis'  => 'transhis'
                ]);

                // type: 
                // 0: nạp tiền (default)
                // 1: rút tiền
                // 2: chuyển tiền
                // 3: nhận tiền
                // 4: phonecard

                if($type == 0)
                {                                        
                    $this->view('frontend.home.detaildeposit', [
                        'result' => $result
                    ]);
                }
                else if($type == 1)
                {                  
                    $_SESSION['credit_card'] = $this->CreditModel->getCard($result['credit_id']);
                    $this->view('frontend.home.detaildraw', [
                        'result' => $result
                    ]);
                }
                else if($type == 2)
                {   
                    $_SESSION['receiver_id'] = $this->LoginModel->getUsername([ 'id' => $result['receiver_id']]);    
                    $_SESSION['receiver_name'] = $this->LoginModel->getFullname([ 'username' => $_SESSION['receiver_id']]);                               
                    $this->view('frontend.home.detailtransfer', [
                        'result' => $result
                    ]);
                }
                else if($type == 3)
                {
                    $_SESSION['sender_id'] = $this->LoginModel->getUsername([ 'id' => $result['sender_id']]);
                    $_SESSION['sender_name'] = $this->LoginModel->getFullname([ 'username' => $_SESSION['sender_id']]);                                            
                    $this->view('frontend.home.detailreceive', [
                        'result' => $result
                    ]);
                }
                else if($type == 4)
                {                                        
                    $this->view('frontend.home.detailphonecard', [
                        'result' => $result
                    ]);
                }

                $this->view('frontend.home.footer');
                $this->view('frontend.linkJS');
                return;
            }
        }
        
    }
?>