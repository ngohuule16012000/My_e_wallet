<?php
    class LoginController extends BaseController
    {
        public $LoginModel;
        private $error = "";
        private $success = "";
        public function __construct()
        {
            $this->loadModel('LoginModel');
            $this->LoginModel = new LoginModel;
            $this->loadModel('RegisterModel');
            $this->RegisterModel = new RegisterModel;
            $this->loadModel('AdminModel');
            $this->AdminModel = new AdminModel;
            $this->loadModel('HomeModel');
            $this->HomeModel = new HomeModel;
        }


        public function index()
        {
            if(isset($_SESSION['change']))
            {
                $this->changePass();
            }
            else if (isset($_SESSION['user'])) 
            {
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
                    'error'     => $this->error,
                    'result'    => $result,
                    'errorupload'=> ''
                ]);
                $this->view('frontend.home.upload_modal',[
                    'result' => $result
                ]);
                $this->view('frontend.home.footer');
                $this->view('frontend.linkJS');
                return;
            }
            else if(isset($_SESSION['admin']))
            {
                // get fullname, username, status với status không là active
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

        public function check(){

            if(isset($_SESSION['current_date']) && $_SESSION['current_date'] !== '')
            {
                $countdown = $this->LoginModel->countdown($_SESSION['current_date'], $_SESSION['current_time']);

                if($countdown <= 60 && $countdown > 0)
                {
                    $this->error = 'Tài khoản hiện đang bị tạm khóa, vui lòng thử lại sau 1 phút';
                    return $this->toLoginPage();
                }
                else
                {
                    $_SESSION['current_date'] = '';
                    $_SESSION['current_time'] = '';
                }
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                
                if (strlen($password) !== 6) {
                    $this->error = 'Password must have 6 characters';
                    return $this->toLoginPage();
                }
                else {
                    
                    $resultUserPass = $this->LoginModel->checkUserPass(['username' => $username, 'password' => $password]);

                    $resultPass = $this->LoginModel->checkPassByUser(['username' => $username], ['password' => $password]);

                    //get abnormal_login
                    $abnormallogin = $this->LoginModel->getAbnormalLogin(['username' => $username], 'abnormal_login');
                    //get lockaccount
                    $lockaccount = $this->LoginModel->getLockAccount(['username' => $username], 'lockaccount');
                    
                    if($resultPass > 0) // đúng user sai pass
                    {
                        // admin k tính số lần sai
                        if ($username === 'admin')
                        {
                            $this->error = 'Sai password';
                            return $this->toLoginPage();
                        }

                        if($lockaccount > 0)
                        {
                            $this->error = 'Tài khoản đã bị khóa do nhập sai 
                                mật khẩu nhiều lần, vui lòng liên hệ quản trị viên để được hỗ trợ';
                            return $this->toLoginPage();
                        }
                        else
                        {
                            // cộng 1 vào wrongpass khi sai password
                            $this->LoginModel->setWrongPass(['username' => $username], 'wrongpass');
                        }

                        // get wrongpass
                        $wrongpass = $this->LoginModel->getWrongPass(['username' => $username], 'wrongpass');

                        if($wrongpass == 3)
                        {   
                            $_SESSION['current_date'] = $this->LoginModel->getCurrentDate();
                            $_SESSION['current_time'] = $this->LoginModel->getCurrentTime();
                            // set account 1 lần đăng nhập bất thường
                            $this->LoginModel->setAbnormalLogin(['username' => $username], 'abnormal_login');
                            $this->error = 'Sai password';
                            return $this->toLoginPage();
                        }
                        else if ($wrongpass == 6 && $abnormallogin == 1)
                        {
                            // set lockaccount là 0 + 1 khi sai hơn 6 lần và đăng nhập bất thường 1 lần
                            $this->LoginModel->setLockAccount(['username' => $username], 'lockaccount');
                            $this->error = 'Tài khoản đã bị khóa do nhập sai 
                                mật khẩu nhiều lần, vui lòng liên hệ quản trị viên để được hỗ trợ';
                            return $this->toLoginPage();
                        }
                        else
                        {
                            $this->error = 'Sai password';
                            return $this->toLoginPage();
                        }
                        
                    }
                    else if($resultUserPass > 0)
                    {

                        //redirect admin page
                        if ($username === 'admin')
                        {
                            $_SESSION['admin'] = $username;
                            
                            $_SESSION['name'] = 'Admin';
                            
                            // get fullname, username, status với status không là active
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
                            return;
                        }

                        // lấy fullname bằng username và register_id
                        $name = $this->LoginModel->getNameByRegisterID(['username' => $username], 'fullname');
                        
                        $_SESSION['user'] = $username;
                        
                        $_SESSION['name'] = $name;

                        $_SESSION['email'] = $this->LoginModel->getEmail(['username' => $username], 'email');

                        // get wrongpass
                        $wrongpass = $this->LoginModel->getWrongPass(['username' => $username], 'wrongpass');

                        if($lockaccount > 0)
                        {
                            $this->error = 'Tài khoản đã bị khóa do nhập sai 
                                mật khẩu nhiều lần, vui lòng liên hệ quản trị viên để được hỗ trợ';
                            return $this->toLoginPage();
                        }

                        // check wrongpass liên tiếp
                        if ($wrongpass > 0 && $wrongpass < 3)
                        {
                            // nhập đúng pass reset wrongpass = 0
                            $this->LoginModel->resetWrongPass(['username' => $username], 'wrongpass');
                        }
                        else if ($wrongpass >= 3 && $wrongpass < 6)
                        {
                            // nhập đúng pass reset wrongpass = 0 và đăng nhập bất thường = 0
                            $this->LoginModel->resetWrongPass(['username' => $username], 'wrongpass');
                            $this->LoginModel->resetAbnormalLogin(['username' => $username], 'abnormal_login');
                        }

                        // lấy giá trị change mật khẩu đã thay đổi hay chưa
                        $change = $this->LoginModel->getChangeByUsername(['username' => $username], 'changepass');

                        // lấy status bằng username
                        $status = $this->LoginModel->getStatusByUsername(['username' => $username], 'status');

                        if($change == 0)
                        {
                            $_SESSION['change'] = 0;

                            $this->view('frontend.head');
                            $this->view('frontend.login.change',['error' => '']);  
                            $this->view('frontend.linkJS'); 
                            return $this->change();
                        }
                        else if($status == 'đã vô hiệu hóa')
                        {
                            $this->error = 'Tài khoản này đã bị vô hiệu hóa, vui lòng liên hệ tổng đài 18001008';
                            return $this->toLoginPage();
                        }
                        else if($status === 'chờ cập nhật')
                        {
                            //get infomation person
                            $result = $this->HomeModel->GetInfoByUsername([
                                'username' => $_SESSION['user']
                            ]);

                            $require = "Yêu cầu upload lại ảnh hai mặt của CMND để được xác minh tài khoản";
                            
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
                                'errorupload'=> ''
                            ]);
                            $this->view('frontend.home.upload_modal',[
                                'result' => $result
                            ]);
                            $this->view('frontend.home.footer');
                            $this->view('frontend.linkJS');
                            return;
                        }
                        else
                        {
                            return $this->index();
                        }
                        
                    }
                    else
                    {
                        $this->error = 'Sai username hoặc password';
                        return $this->toLoginPage();
                    }
                  
                }
            }
        }

        public function change()
        {
            $this->changePass();
        }

        public function logout()
        {
            session_destroy();
            $this->error = '';
            return $this->toLoginPage();
        }

        public function changepassword()
        {
            // redirect to change password page
            $this->view('frontend.head');
            $this->view('frontend.home.navbar',[
                'detail'    => '',
                'deposit'   => '',
                'draw'      => '',
                'transfer'  => '',
                'phonecard' => '',
                'transhis'  => ''
            ]);
            $this->view('frontend.login.changepassword',[
                'error'     => $this->error,
                'success'   => $this->success
            ]);  
            $this->view('frontend.home.footer');
            $this->view('frontend.linkJS'); 
        }

        public function checkchange()
        {
            // xử lý change password form
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password']) && isset($_POST['newpassword1']) && isset($_POST['newpassword2'])) {
                $username       = $_SESSION['user'];
                $password       = $_POST['password'];
                $newpassword1   = $_POST['newpassword1'];
                $newpassword2   = $_POST['newpassword2'];

                if (strlen($password) !== 6 || strlen($newpassword1) !== 6 || strlen($newpassword2) !== 6) 
                {
                    $this->error = 'Password must have 6 characters';
                    return $this->changepassword();
                }
                else
                {
                    $resultUserPass = $this->LoginModel->checkUserPass(['username' => $username, 'password' => $password]);

                    if($resultUserPass > 0)
                    {
                        if($newpassword1 === $newpassword2)
                        {
                            //change pass
                            $username = [
                                'username' => $_SESSION['user']
                            ];

                            $newpass = [
                                'password' => $newpassword1
                            ];

                            $this->LoginModel->changePasswordbyUsername($username, $newpass);
                            $this->success = 'Change password complete.';
                            return $this->changepassword();
                        }
                        else
                        {
                            $this->error = 'Passwords do not match';
                            return $this->changepassword();
                        }
                    }
                    else
                    {
                        $this->error = 'Wrong Password';
                        return $this->changepassword();
                       
                    }
                }
                
            }
        }

        public function recovery()
        {
            $this->view('frontend.head');
            $this->view('frontend.login.recovery',['error' => $this->error]);  
            $this->view('frontend.linkJS'); 
        }

        public function optcode()
        {
            if(isset($_SESSION['otp']))
            {
                $this->view('frontend.head');
                $this->view('frontend.login.otpcode',['error' => $this->error]);  
                $this->view('frontend.linkJS'); 
            }
        }

        public function recoverycheck()
        {
            if(isset($_POST['phone']) && isset($_POST['email']))
            {
                $phone = $this->RegisterModel->checkEmailPhone(['phone' => $_POST['phone']]);
                $email = $this->RegisterModel->checkEmailPhone(['email' => $_POST['email']]);

                $_SESSION['email_recovery'] = $_POST['email'];
                $_SESSION['phone_check'] = $phone;
                $_SESSION['email_check'] = $email;

                if($phone == 0)
                {
                    $this->error = 'Sai số điện thoại';
                    return $this->recovery();
                }
                else if($email == 0)
                {
                    $this->error = 'Sai email';
                    return $this->recovery();
                }
                else if($phone == 0 && $email == 0)
                {
                    $this->error = 'Sai số điện thoại và email';
                    return $this->recovery();
                }
                else
                {   
                    $_SESSION['email'] = $_POST['email'];
                    
                    $this->getOtp();
                }
            }
        }

        public function getOtp()
        {
            // set opt code
            $opt = rand(100000, 999999);
            $_SESSION["otp"] = $opt;
            //$result = $this->sendOTPCodeEmail($email);
            $_SESSION['current_date'] = $this->LoginModel->getCurrentDate();
            $_SESSION['current_time'] = $this->LoginModel->getCurrentTime();

            //gửi otp code đến email
            $subject = "Mã OTP khôi phục mật khẩu";
            $body = "Mã OTP xác nhận khôi phục mật khẩu là <h2>" . $opt . "</h2>.<br>Mã có hiệu lực trong 1 phút.";
            $this->sendEmail($_SESSION['email'], $subject, $body);

            //$this->error = "Mã OTP: " . $_SESSION['otp'] . "\n Mã có hiệu lực trong 1 phút.";
            $this->error = "";
            return $this->optcode();
        }

        public function otpcheck()
        {
            if(isset($_POST['otp']))
            {
                if(isset($_SESSION['current_date']) && $_SESSION['current_date'] != '')
                {
                    $countdown = $this->LoginModel->countdown($_SESSION['current_date'], $_SESSION['current_time']);

                    if($countdown <= 60 && $countdown > 0)
                    {
                        $otp = $_POST['otp'];
                        if($otp == $_SESSION["otp"])
                        {
                            $_SESSION['current_date'] = '';
                            $_SESSION['current_time'] = '';
                            // set user cho session khi đổi password
                            $_SESSION['user'] = $this->LoginModel->getUsernameByPhoneAndEmail([
                                'phone' => $_SESSION['phone_check'], 
                                'email' => $_SESSION['email_check']
                                ],
                                'username'
                            );
                            $_SESSION['covery'] = 'covery';

                            $this->view('frontend.head');
                            $this->view('frontend.login.change',['error' => '']);  
                            $this->view('frontend.linkJS'); 
                            $this->changePass();
                        }
                        else
                        {
                            $this->error = "Sai mã otp. \nVui lòng nhập lại";
                            return $this->optcode();
                        }
                    }
                    else
                    {
                        $this->error = "Mã OTP đã hết hiệu lực.";
                        return $this->optcode();
                    }
                }
            }
            
        }

    }
?>