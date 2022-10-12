<?php 
session_start();
error_reporting();
ini_set('display_errors', 1);
$path = "/var/www/webroot/blockchainsys/";
require_once ($path.'config/phpmailer/SMTP.php');
require_once ($path.'config/phpmailer/PHPMailer.php');
require_once ($path.'config/phpmailer/Exception.php');

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;
require $path."/config/db_config.php";
$email = "";
$name = "";
$errors = array();
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// $_SESSION['email'] = $email;


    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = '$otp_code'";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE users SET code = '$code', status = '$status' WHERE code = '$fetch_code'";
            $update_res = mysqli_query($conn, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $run_sql = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(99999,11111);
            $insert_code = "UPDATE users SET code = '$code' WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
            if($run_query){
                //windows mailer
                /*$subject = "Password Reset Code";
                $message = "Your password reset code is '$code'";
                $sender = "From: llllanto@usep.edu.ph";
                if(mail($email, $subject, $message, $sender)){*/
                    $info = "We've sent a password reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    //header('location: reset-code.php');
                    //exit();
                /*}else{
                    $errors['otp-error'] = "Failed while sending code!";
                }*/
                //MACOS Mailer
                $mail=new PHPMailer(true);


        try {
            //settings
            $mail->SMTPDebug=2;
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true; 
            $mail->Username='llllanto@usep.edu.ph'; 
            $mail->Password='lilmix<3'; 
            $mail->SMTPSecure='ssl';
            $mail->Port=465;

            $mail->setFrom('llllanto@usep.edu.ph', 'Forgot Password');

            //recipient
            $mail->addAddress($email);


            //content
            $getCode = '$code';
            $mail->isHTML(true);
            $_SESSION['email'] = $email;
            $mail->Subject='Password Reset Code [AUTO-GENERATED. DO NOT REPLY]';
            $mail->Body='Good Day</strong>!<br><br>We have received a request to reset your password and your reset code is: <strong>'.$code.'</strong>. If this is not you, please disregard this message and try running a privacy check for your account.';
            $mail->AltBody='Good Day</strong>!<br><br>We have received a request to reset your password and your reset code is: <strong>'.$code.'</strong>. If this is not you, please disregard this message and try running a privacy check for your account.';

            $mail->send();

            echo '
                <script>
                    window.location.href = "reset-code.php";
                </script>';
        }
        catch(Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: '.$mail->ErrorInfo;
        }
                //END MACOS MAILER
            }else{
                $errors['db-error'] = "Something went wrong!!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = '$otp_code'";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: ../php/new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = sha1($password);
          	//blockchain changing pass
          	$path = $_SERVER['DOCUMENT_ROOT'];
        	$path .= "/blockchainsys/config/";
        	require_once("/var/www/webroot/blockchainsys/config/vendor/autoload.php");
          	$client = new MongoDB\Client('mongodb+srv://blockchain:yKzl2VnIEOmtAwlD@clustertest.mxj6b.mongodb.net/?retryWrites=true&w=majority&tls=true');
          
      		$usersCollection = $client->adminDB->userCredentials;
          	$updateResult = $usersCollection->updateOne(
                [ 'user_email' => $email ],
                    [ '$set' => 
                        [
                            'user_password' => $encpass,
                            'function' => 'APPEND',
                            'lastActionDone' => 'UPDATE PASSWORD INFORMATION'
                        ],
                    ]
            );
            //$update_pass = "UPDATE users SET code = '$code', upassword = '$encpass' WHERE email = '$email'";
            //$run_query = mysqli_query($conn, $update_pass);
            if($updateResult == TRUE){
                $info = "Your password has been changed. You can now login with your new password.";
                $_SESSION['info'] = $info;
              	//sending confirmation that password was changed
              	$mail=new PHPMailer(true);


        try {
            //settings
            $mail->SMTPDebug=2;
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true; 
            $mail->Username='llllanto@usep.edu.ph'; 
            $mail->Password='lilmix<3'; 
            $mail->SMTPSecure='ssl';
            $mail->Port=465;

            $mail->setFrom('llllanto@usep.edu.ph', 'Password Changed');

            //recipient
            $mail->addAddress($email);


            //content
            $getCode = '$code';
            $mail->isHTML(true);
            $_SESSION['email'] = $email;
            $mail->Subject='Password Reset [AUTO-GENERATED. DO NOT REPLY]';
            $mail->Body='Good Day</strong>!<br><br>You\'re receiving this message because you changed your password. Login now to enjoy our services [https://node103020-eblockchainsys.w1-us.cloudjiffy.net/blockchainsys/]. If this wasn\'t you, please have your account checked immediately.';
            $mail->AltBody='Good Day</strong>!<br><br>You\'re receiving this message because you changed your password. Login now to enjoy our services [https://node103020-eblockchainsys.w1-us.cloudjiffy.net/blockchainsys/]. If this wasn\'t you, please have your account checked immediately.';

            $mail->send();

            echo '
                <script>
                    window.location.href = "password-changed.php";
                </script>';
        }
        catch(Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: '.$mail->ErrorInfo;
        }
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login.php');
    }
?>


