<?php
namespace Woo\Util;

class Uuid
{
    /**
     * Uuid
     * Random uuid version 4 kernel random uid
     *
     * @return void
     */
    static function Uuid(){
        // Linux only uuid(4) eefc7d80-810f-449f-9eb2-f8365d25939b
        $id = file_get_contents('/proc/sys/kernel/random/uuid');
        if(empty($id)){
            $id = self::Uuid4();
        }
        return $id;
    }

    /**
     * Guid
     * Creat uuid string version 4 rand bytes or openssl
     *
     * @return string
     */
    static function Uuid4($openssl = false)
    {
        $data = random_bytes(16);
        if($openssl == true){
            $data = openssl_random_pseudo_bytes(16);
        }
        assert(strlen($data) == 16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Uuid32
     * unique 32 characters string
     *
     * @return string
     */
    static function Uuid32(){
        return md5(microtime().uniqid().random_bytes(16).$_SERVER['REMOTE_ADDR']);
    }

    /**
     * Uuid125
     * unique 128 characters string
     *
     * @return string
     */
    static function Uuid128(){
        return hash('sha512', microtime().uniqid().random_bytes(16).$_SERVER['REMOTE_ADDR']);
    }
}
?>