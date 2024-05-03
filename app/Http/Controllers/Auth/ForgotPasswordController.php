<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Mail;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    //use SendsPasswordResetEmails;
    public function showLinkRequestForm()
    {
        $token = Str::random(64);
        //dd('test');
        return view('auth/passwords/email', compact('token'));
    }


    public function sendResetLinkEmail(Request $request)
    {
        //dump("kirim email");
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()

        ]);
        $sendmail = $this->sendMail($request->email, $token);
        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token)
    {
        $res_passwordreset = DB::select("select * from password_resets where token='" . $token . "'");
        if (count($res_passwordreset) > 0) {
            $mail = $res_passwordreset[0]->email;
        } else {
            $mail = 'unidentified email, please insert your email';
        }
        return view('auth.forgetPasswordLink', ['token' => $token, 'email' => $mail]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'

        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $user = User::where('email', $request->email)

            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email' => $request->email])->delete();
        return redirect('/login')->with('message', 'Your password has been changed!');
    }

    public function sendMail($email, $token)
    {
        $emaile = $email . "test ajah";
        // return $emaile;
        // dd("send mail");
        // $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail = new PHPMailer(true);
        $email = "suryoatm@gmail.com";
        $nama = "suryo";
        $namalengkap = "suryo atmojo";
        $nmrorder = 123456789;
        $kurir = 'test kurir';
        $alamat = 'test alamat';
        $kota = 'test kota';
        $kodepos = 'test kodepos';
        $negara = 'test negara';
        $phone = 'test phone';

        $bodyproduct = '';

        $dsctag = 'in itag';
        $sbtotal = 'ini sbtotal';
        //dd($cartItems);

        $subglobal = 'sub global';
        $adacoupon = 'test coupon';
        $shipglobal = 'test ship global';
        $adacoupon = 'test coupon';
        $gstglobal = 'test global';
        $ordertotalfix = 'test order';
        $yousavedisi = 'test yousave';
        $emal = 'emal';
        $msg = '';


        try {

            $mail->SMTPDebug = 0;
            //Server settings                   
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host     = 'mail.supresso.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ecommerce@supresso.com';
            $mail->Password = 's{Vi(jz?B#sZ';
            $mail->SMTPSecure = 'ssl';
            $mail->Port     = 465;
            $mail->CharSet = "UTF-8";

            //Recipients
            $mail->setFrom('ecommerce@supresso.com', 'Supresso');
            $mail->addAddress('indracodev@gmail.com');
            // $mail->addAddress('sigit.develop@gmail.com', 'ok');
            $mail->addCC('suryoatmojo@uwp.ac.id');
            //$mail->addBCC('sigit.develop@gmail.com');

            // Content

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'RESET PASSWORD SUPRESSO MEMBER';
            $mail->Body    = '<!DOCTYPE html>
            <html lang="en" style="padding: 0; margin: 0; background-color: #ffffff; width: 100%!important;">
            <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="x-apple-disable-message-reformatting">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <title>SUPRESSO &bull; Reset Password</title>
                    <link rel="icon" href="img/logo.ico">
                </head>
                <body style="padding: 0; margin: 0;">
            
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
                        <tbody>
            
                            <!-- bellow subject -->
                            <tr style="display: none; max-height: 0; overflow: hidden;">
                                <td>
                                    <module name="preheader" label="Preheader"></module>
                                    <editable name="preheader">RESET PASSWORD</editable>
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                    &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;
                                    &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj; &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                                </td>
                            </tr>
                            <!-- bellow subject -->
            
                            <tr>
                                <td>
                                    <table border="0" cellpadding="40" cellspacing="0" width="720" align="center">
                                        <tbody>
                                            <!-- ========================= header ========================= -->
                                            <tr>
                                                <td style="padding-bottom: 0;">
                                                    <img src="https://supresso.com/newsletterv2/assets/supresso/img/logo.png" width="72" height="72" style="vertical-align: sub;" alt="">
                                                </td>
                                            </tr>
                                            <!-- ========================= edn of header ========================= -->
            
                                            <!-- ========================= body ========================= -->
                                            <tr>
                                                <td style="padding-bottom: 0;">
                                                    <h1 style="font-family: sans-serif; font-size: 1.75em; color: #323232; margin-top: 0;">
                                                        <strong>Reset Password!</strong>
                                                    </h1>
                                                    <p style="font-family: sans-serif; font-size: 1em; color: #323232; margin-top: 0;">
                                                        Hi
                                                        <strong>guys</strong>,
                                                    </p>
                                                    <p style="font-family: sans-serif; font-size: 1em; color: #323232; margin: 0;">
                                                         A password reset for your account was requested.
            
            Please click the button below to change your password.
            
            Note that this link is valid for 24 hours. After the time limit has expired, you will have to resubmit the request for a password reset. 
                                                    </p>
                                                </td>
                                            </tr>
            
                                            <tr>
                                                <td style="padding-bottom: 0;">
                                                    
                                                </td>
                                            </tr>
            
                                            <!-- tabel -->
                                            
                                            
                                            
                                            <!-- end of tabel -->
            
                                            <tr>
                                                <td>
                                                <a href="http://127.0.0.1:8000/reset-password/' . $token . '" target="_blank"
                                                      style="text-decoration: none; background-color: #fd4f00; color: white; display: block; text-align: center; font-size: .75em; font-family: HelveticaNeue, Helvetica, Arial, sans-serif; padding: .5em .75em; line-height: 1.5; border-radius: .25rem;">
                                                      RESET PASSWORD
                                                   </a>
                                                </td>
                                            </tr>
                                            <!-- ========================= end of body ========================= -->
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
            
                            <!-- ========================= footer ========================= -->
                            <tr>
                                <td bgcolor="#fafafa">
                                    <table border="0" cellpadding="40" cellspacing="0" width="720" align="center">
                                        <tbody>
                                            <tr>
                                                <td style="padding-top: 0; padding-bottom: 0;">
                                                    <img src="https://supresso.com/newsletterv2/assets/supresso/img/signature-light.gif" width="100%" height="auto" style="vertical-align: sub;" alt="">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table border="0" cellpadding="40" cellspacing="0" width="720" align="center">
                                        <tbody>
                                            <tr>
                                                <td style="padding-top: 30px; padding-bottom: 30px;">
                                                    <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding-right: 20px; border-right: solid 1px #878787;">
                                                                    <table border="0" cellpadding="5" cellspacing="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="26">
                                                                                    <a href="#" target="_blank" style="text-decoration: none;">
                                                                                        <img src="https://supresso.com/newsletterv2/assets/supresso/img/ikon_fb_dark.png" width="26" height="26" style="vertical-align: sub;" alt="">
                                                                                    </a>
                                                                                </td>
                                                                                <td width="26">
                                                                                    <a href="#" target="_blank" style="text-decoration: none;">
                                                                                        <img src="https://supresso.com/newsletterv2/assets/supresso/img/ikon_ig_dark.png" width="26" height="26" style="vertical-align: sub;" alt="">
                                                                                    </a>
                                                                                </td>
                                                                                <td width="26">
                                                                                    <a href="#" target="_blank" style="text-decoration: none;">
                                                                                        <img src="https://supresso.com/newsletterv2/assets/supresso/img/ikon_phone_dark.png" width="26" height="26" style="vertical-align: sub;" alt="">
                                                                                    </a>
                                                                                </td>
                                                                                <td width="26" style="padding-right: 0;">
                                                                                    <a href="#" target="_blank" style="text-decoration: none;">
                                                                                        <img src="https://supresso.com/newsletterv2/assets/supresso/img/ikon_map_dark.png" width="26" height="26" style="vertical-align: sub;" alt="">
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td style="padding-left: 20px;">
                                                                    <p style="font-family: sans-serif; font-size: .6em; color: #323232; margin-top: 0; margin-bottom: .5em;">
                                                                        <a href="#" target="_blank" style="text-decoration: none; color: #323232;">
                                                                            View Web Version
                                                                        </a>
                                                                        <span style="padding-left: 5px; padding-right: 5px;">|</span>
                                                                        <a href="#" target="_blank" style="text-decoration: none; color: #323232;">
                                                                            Privacy Policy
                                                                        </a>
                                                                        <span style="padding-left: 5px; padding-right: 5px;">|</span>
                                                                        <a href="#" target="_blank" style="text-decoration: none; color: #323232;">
                                                                            Unsubscribe
                                                                        </a>
                                                                    </p>
                                                                    <p style="font-family: sans-serif; font-size: .6em; color: #323232; margin: 0;">
                                                                        333A Orchard Road #03-11 Mandarin Gallery Singapore 238897
                                                                        <br>Copyright &copy; 2022 Indraco. All Rights Reserved.
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top: solid 1px #878787;">
                                    <table border="0" cellpadding="40" cellspacing="0" width="720" align="center">
                                        <tbody>
                                            <tr>
                                                <td style="padding-top: 20px; padding-bottom: 20px;">
                                                    <p style="font-family: sans-serif; font-size: .6em; color: #bcbec0; margin: 0; text-align: justify;">
                                                        <span style="color: #fd4f00;">Important warning and disclaimer :</span>
                                                        <br><br>
                                                        This message and any attachments are intended for the named and correctly identified addressee only. This message may contain confidential, proprietary, legally privileged or commercially sensitive information. No waiver of confidentiality or
                                                        privilege is intended or authorized by this transmission. If you are not the intended recipient of this message you must not directly or indirectly use, reproduce, distribute, disclose, print, reply on, disseminate, or copy any part of the message or
                                                        its attachments and if you have received this message in error, please notify the sender immediately by return e-mail and delete it from your system. The accuracy of the information in this e-mail is not guaranteed. Any opinions contained in this
                                                        message are those of the author and are not given or endorsed unless otherwise clearly indicated in this message, and the authority of the author to act for and on behalf of Indraco Pte. Ltd. and its Subsidiaries is duly verified.
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- ========================= end of footer ========================= -->
            
                        </tbody>
                    </table>
            
                    <script type="text/javascript">
                        // [].forEach.call(document.querySelectorAll("*"), function (a) { a.style.outline = "1px solid green" });
                    </script>
            
                </body>
            
            </html>
	';

            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



            $mail->send();

            $msg = "success send link";
        } catch (Exception $e) {
            $msg .= " Mail could not be sent. Mailer Error: {$mail->ErrorInfo}";
            //return back()->with('error','Message could not be sent.');
        }

        return $msg;
        //return $charge;
    }
}
