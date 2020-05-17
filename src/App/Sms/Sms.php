<?php
namespace Woo\App\Sms;

class Sms
{
    static function SendSMS($email = 'john.doe@example.com', $pass = 's3cr3tp4ssw0rd', $message = 'Test SMS Content', $numbers = ['500304204','500456789','500654321'])
    {
        $ch = curl_init('https://promosms.com/api/rest/v3_2/sms');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic '.base64_encode($email.':'.$pass),
            'Accept: text/json'
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            'text' => $message,
            'type' => 1,
            'recipients' => array ($numbers),
        )));
        return json_decode(curl_exec($ch));
    }

    static function Raport($email = 'john.doe@example.com', $pass = 's3cr3tp4ssw0rd', $from_time = 1433109600, $to_time = 1535701600)
    {
        $ch = curl_init('https://promosms.com/api/rest/v3_2/reports?' . http_build_query(array(
            'from-time' => $from_time,
            'to-time'   => $to_time,
        )));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic '.base64_encode($email.':'.$pass),
            'Accept: text/json'
        ));
        return json_decode(curl_exec($ch));
    }
}