<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/18/2017
 * Time: 4:12 AM
 */

namespace Controllers\Admin;


use App\Request;
use App\Settings;
use App\View;
use Golonka\BBCode\BBCodeParser;
use PHPMailer;

class Contact extends ControllerAdmin
{

    protected function viewAdmin(Request $request)
    {
        if (!$request->hasPost(['message', 'subject']))
            return new View("admin.contact");

        if ($request->hasPost(['message', 'subject'])) {

            $request->set('message', $request->post('message', ''));
            $request->set('subject', $request->post('subject', ''));

            if ((!$request->post('message') || !$request->post('subject'))) {
                $request->set('error', true);
                return new View("admin.contact");
            }
        }


        ob_start();
        $mailView = new Partial('mail');
        $mailView->run($request);
        $mailText = ob_get_clean();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = Settings::get('mail_server');
        $mail->SMTPAuth = true;
        $mail->Username = Settings::get('mail_username');
        $mail->Password = Settings::get('mail_password');
        $mail->SMTPSecure = Settings::get('mail_security');
        $mail->Port = intval(Settings::get('mail_port'));

        $mail->setFrom('no-reply@bibl.io', 'No Reply');
        $mail->addAddress('neagu1000@gmail.com', 'Administrator');
        $mail->addReplyTo($request->session('user')->email, $request->session('user')->name);

        $mail->isHTML(true);

        $mail->Subject = 'New bibl.io mail - ' . htmlentities($request->viewbag('subject', ''));
        $mail->Body = $mailText;
        $mail->AltBody = (new BBCodeParser())->parse(htmlentities($request->viewbag('message', '')));

        if (!$mail->send()) {
            $request->set('error', $mail->ErrorInfo);
        } else {
            $request->set('success', true);
        }
        return new View("admin.contact");
    }
}