<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class BaseController
    {
        const VIEW_FOLDER_NAME = "Views";
        const MODEL_FOLDER_NAME = "Models";

        
        /*
        * Description: 
            + path name: folderName.fileName
            + Lấy từ sau thư mục Views
        */

        private $error = "";
        private $success = "";

        public function __construct()
        {
            $this->loadModel('LoginModel');
            $this->LoginModel = new LoginModel;
        }

        protected function view($viewPath, array $data = [])
        {
            
            foreach($data as $key => $value)
            {
                $$key = $value;
            }

            require (self::VIEW_FOLDER_NAME .'/'. str_replace('.', '/', $viewPath) . '.php');
        }

        protected function loadModel($modelPath)
        {
            require (self::MODEL_FOLDER_NAME .'/'. $modelPath . '.php');
        }

        protected function changePass()
        {
            
            if (isset($_POST['newpassword1']) && isset($_POST['newpassword2'])) 
            {
                $newpassword1 = $_POST['newpassword1'];
                $newpassword2 = $_POST['newpassword2'];

                
                if (strlen($newpassword1) !== 6 || strlen($newpassword2) !== 6) 
                {                
                    return $this->view('frontend.login.change',[
                        'error' => 'Password must have 6 characters'
                    ]);
                }
                else if($newpassword1 !== $newpassword2)
                {
                    return $this->view('frontend.login.change',[
                        'error' => 'Passwords do not match'
                    ]);
                }
                else
                {
                    if(isset($_SESSION['covery']) && $_SESSION['covery'] != '')
                    {
                        $getusername = $this->LoginModel->getUsernameByPhoneAndEmail(["email" => $_SESSION['email_recovery']], 'username');

                        $username = [
                            'username' => $getusername
                        ];
    
                        $newpass = [
                            'password' => $newpassword1
                        ];
    
                        $this->LoginModel->changePasswordbyUsername($username, $newpass);

                        $_SESSION['covery'] = "";
                        $this->success = "Khôi phục mật khẩu thành công";
                        return $this->toLoginPage();
                    }

                    $username = [
                        'username' => $_SESSION['user'] 
                    ];

                    $newpass = [
                        'password' => $newpassword1
                    ];

                    $this->LoginModel->changePasswordbyUsername($username, $newpass);
                    

                    //set change password = 1
                    $this->LoginModel->setChangePasswordByUsername($username, ['changepass' => 1]);

                    // Removing session data
                    if(isset($_SESSION["change"])){
                        unset($_SESSION["change"]);
                    }

                    if(isset($_SESSION['upload']) && $_SESSION == 'upload')
                    {
                        // đã upload cmnd theo yêu cầu
                        // set status
                        $this->AdminModel->setStatusByUsername(['username' => $_SESSION['user']], 'chờ xác minh');
                        $_SESSION['upload'] = '';
                    }

                    // lấy status bằng username
                    $status = $this->LoginModel->getStatusByUsername(['username' => $_SESSION['user']], 'status');
                    
                    $require = '';

                    if($status === 'chờ cập nhật')
                    {
                        $require = "Yêu cầu upload lại ảnh hai mặt của CMND để được xác minh tài khoản";
                    }

                    // lấy fullname bằng username và register_id
                    $name = $this->LoginModel->getNameByRegisterID($username, 'fullname');
                  
                    $_SESSION['name'] = $name;
                    //get infomation person
                    $result = $this->HomeModel->GetInfoByUsername($username);

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
                        'error'     => '',
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

        public function sendEmail($email, $subject, $body)
        {
            $mail = new PHPMailer(true);

            try {

                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                       // Enable verbose debug output
                $mail->isSMTP();           
                $mail->CharSet = 'UTF-8';                                  // Send using SMTP
                $mail->Host       = gethostbyname('smtp.gmail.com');                    // Set the SMTP server to send through
                                                // Enable SMTP authentication
                $mail->Username   = 'ngohuule1601@gmail.com';                     // SMTP username
                $mail->Password   = '0965514285';                               // SMTP password
                $mail->SMTPAuth = true; //SMTP authentication
                //$mail->SMTPAutoTLS = false; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged 465
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                    );

                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     // Enable verbose debug output
                // $mail->isSMTP();           
                // $mail->CharSet = 'UTF-8';                                  // Send using SMTP
                // $mail->Host       = gethostbyname('mail.phongdaotao.com');                    // Set the SMTP server to send through
                //                                  // Enable SMTP authentication
                // $mail->Username   = 'sinhvien@phongdaotao.com';                     // SMTP username
                // $mail->Password   = 'svtdtu';                               // SMTP password
                // $mail->SMTPAuth = false; //SMTP authentication
                // $mail->SMTPAutoTLS = false; 
                // //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                // $mail->Port       = 25;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above


                //Recipients
                // $mail->setFrom('sinhvien@phongdaotao.com', 'Website ví điện tử');
                $mail->setFrom('ngohuule1601@gmail.com', 'Website ví điện tử');
                $mail->addAddress($email, 'Người nhận');     // Add a recipient

                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject; 
                $mail->Body = $body;
                
                if($mail->send()){
                    return true;
                }
                //echo 'Mailer Error: ' . $mail->ErrorInfo;
                
            } catch (Exception $e) {
                return false;
            }
        }

    }
?>