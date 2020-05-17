<?php
namespace Woo\App\User;

use Woo\App\Mysql\Db;

class User
{
    static function IsLogged()
    {
        if($_SESSION['user']['id'] <= 0)
        {
            header('Location: /login');
            exit;
        }
    }

    static function IsRole($role = 'admin')
    {
        if($_SESSION['user']['role'] != $role)
        {
            header('Location: /login');
            exit;
        }
    }

    static function Get()
    {
        $db = Db::GetInstance();
        $r = $db->Pdo->prepare("SELECT * FROM user WHERE id = :id");
        $r->execute([':id' => (int) $_SESSION['user']['id']]);
        $rows = $r->fetchAll();
        return reset($rows);
    }

    static function UpdateMobile()
    {
        if(!empty($_POST['mobile']))
        {
            $db = Db::GetInstance();
            $r = $db->Pdo->prepare("UPDATE user SET mobile = :m WHERE id = :id");
            $r->execute([':id' => (int) $_SESSION['user']['id'], ':m' => strip_tags($_POST['mobile'])]);
            return $r->rowCount();
        }
    }

    static function UpdateUsername()
    {
        if(!empty($_POST['username']))
        {
            $name = preg_replace('/[^a-z0-9_\.]/','', strtolower($_POST['username']));
            if(!empty($name))
            {
                $db = Db::GetInstance();
                $r = $db->Pdo->prepare("UPDATE user SET username = :n WHERE id = :id");
                $r->execute([':id' => (int) $_SESSION['user']['id'], ':n' => $name]);
                return $r->rowCount();
            }
        }
        return 0;
    }

    static function UpdatePass()
    {
        if(!empty($_POST['pass1']))
        {
            if($_POST['pass1'] == $_POST['pass2'])
            {
                $db = Db::GetInstance();
                $r = $db->Pdo->prepare("UPDATE user SET pass = :p WHERE id = :id");
                $r->execute([':id' => (int) $_SESSION['user']['id'], ':p' => md5($_POST['pass1'])]);
                return $r->rowCount();
            }
        }
        return 0;
    }
}
