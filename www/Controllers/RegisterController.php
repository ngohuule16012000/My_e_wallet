<?php
    class RegisterController extends BaseController
    {
        private $error = '';
        private $username = '';
        private $password = '';
        private $success = '';
        
        public function __construct()
        {
            $this->loadModel('RegisterModel');
            $this->RegisterModel = new RegisterModel;
            $this->loadModel('LoginModel');
            $this->LoginModel = new LoginModel;
        }


        public function index()
        {
            if(isset($_SESSION['change']))
            {
                $this->view('frontend.head');
                $this->view('frontend.login.change',['error' => $this->error]);  
                $this->view('frontend.linkJS'); 
                return $this->changePass();
            }
            else
            {
                $this->view('frontend.head');
                //$this->view('frontend.message');
                $this->view('frontend.registers.index',[
                    'error'     => $this->error, 
                    'success'   => $this->success, 
                    // 'username'  => $this->username, 
                    // 'password'  => $this->password
                ]);
                $this->view('frontend.linkJS');
                //$this->check();
            }
            
        }

        public function check(){
            $error = '';
            $phone = '';
            $email = '';
            $fullname = '';
            $date = '';
            $address = '';
            $fontimage = '';
            $backimage = '';

            if (isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['fullname']) && isset($_POST['date']) && isset($_POST['address'])) 
            {

                if (isset($_FILES['fontimage']) && isset($_FILES['backimage'])) {
                    if ($_FILES['fontimage']['error'] > 0)
                    {
                        $this->error = 'Upload lỗi rồi!';
                        return $this->index();
                    }
                    else {
                        move_uploaded_file($_FILES['fontimage']['tmp_name'], root . '/public/upload/' . $_FILES['fontimage']['name']);
                    }
    
                    if ($_FILES['backimage']['error'] > 0)
                    {
                        $this->error = 'Upload lỗi rồi!';
                        return $this->index();
                    }
                    else {
                        move_uploaded_file($_FILES['backimage']['tmp_name'], root . '/public/upload/' . $_FILES['backimage']['name']);
                    }
                }
                else
                {
                    $this->error = 'Không có file upload.';
                    return $this->index();
                }

                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $fullname = $_POST['fullname'];
                $date = $_POST['date'];
                $address = $_POST['address'];
                $fontimage = $_FILES['fontimage']['name'];
                $backimage = $_FILES['backimage']['name'];

                $checkEmail = $this->RegisterModel->checkEmailPhone(['email' => $email]);
                $checkPhone = $this->RegisterModel->checkEmailPhone(['phone' => $phone]);
                
                if($checkEmail > 0 && $checkPhone > 0) // tồn tại phone hoặc email
                {
                    $this->error = 'Email và Phone đã tồn tại';
                    return $this->index();
                }
                else if($checkEmail > 0) // tồn tại email
                {
                    $this->error = 'Email đã tồn tại';
                    return $this->index();
                }
                else if($checkPhone > 0) // tồn tại phone
                {
                    $this->error = 'Phone đã tồn tại';
                    return $this->index();
                }
                else
                {
                    $this->create($phone, $email, $fullname, $date ,$address, $fontimage, $backimage);
            
                    $username = rand(1000000000,9999999999);
                    $password = $this->rand_string(6);
                    $check = false;
                    while($check)
                    {
                        // kiểm tra tồn tại username không
                        $checkusername = $this->LoginModel->checkUserPass(['username' => $username]);
                        if($checkusername > 0)
                        {
                            $check = false;
                        }
                        else
                        {
                            $check = true;
                        }
                    }
    
                    $selectColumns = [
                        'email' => $email,
                        'phone' => $phone,
                    ];
    
                    $register_id = $this->RegisterModel->getRegisterId([
                        'email' => $email,
                        'phone' => $phone
                    ]); // lấy id có email và phone

                    $this->createAccount($username, $password, $register_id);
                    
                    $this->error = '';
                    $this->success = 'Đăng ký thành công';
                    // $this->username = $username;
                    // $this->password = $password;

                    //gửi username và password đến email đăng ký
                    $subject = "Website ví điện tử chào mừng bạn";
                    $body = "Chúc mừng đã đăng ký thành công. Hãy đăng nhập website bằng:<br>".
                        "Username: <strong>" . $username . "</strong><br>" .
                        "Password: <strong>" . $password . "</strong>" .
                        "<br>Vui lòng đổi mật khẩu ngay sau khi đăng nhập thành công.";
                    $this->sendEmail($email, $subject, $body);

                    return $this->index();
                }
            }    
        }

        public function create($phone, $email, $fullname, $date ,$address, $fontimage, $backimage)
        {
            $data = [
                'phone'  => $phone,
                'email' => $email,
                'fullname'  => $fullname,
                'date' => $date,
                'address'  => $address,
                'fontimage' => $fontimage,
                'backimage' => $backimage,
            ];

            $this->RegisterModel->store($data);
        }

        public function createAccount($username, $password, $register_id)
        {
            $data = [
                'username'      => $username, 
                'password'      => $password,
                'register_id'   => $register_id,
            ];

            $this->LoginModel->store($data);
        }

        function rand_string( $length ) {

            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            
            $size = strlen( $chars );
            $str = "";
            
            for( $i = 0; $i < $length; $i++ ) {
            
                $str .= $chars[ rand( 0, $size - 1 ) ];
            
            }
            return $str;
        }
        
    }
?>