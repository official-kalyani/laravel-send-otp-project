<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'otp', 'expire_at'];

    public static function sendSms($mobile,$msg){
        $sender_id = 'GRAPHM';
        $template_id = '1707168414494793391';
        $phone = $mobile;
        $msg = $msg;
        $username = 'digitalrath_admin';
        $apikey = 'DD9AE-0CF92';
        $uri = 'https://www.alots.in/sms-panel/api/http/index.php';
        $data = array(
        'username'=> $username,
        'apikey'=> $apikey,
        'apirequest'=>'Text',
        'sender'=> $sender_id,
        'route'=>'TRANS',
        'format'=>'JSON',
        'message'=> $msg,
        'mobile'=> $phone,
        'TemplateID' => $template_id,
        );

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        $resp = curl_exec($ch);
        $error = curl_error($ch);
        curl_close ($ch);
        echo json_encode(compact('resp', 'error'));

    }
}
