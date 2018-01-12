<?php


include_once ROOT . '/Models/UsersLogin.php';

class UsersController
{

    public function actionLogin()
    {
       /* $login = 'admin';
        $pass = '202cb962ac59075b964b07152d234b70';*/
        $error_login = '';
        $error_pass = '';
        $error = false;
        $log = false;

        $admin= array();

            if(isset($_POST['logbut']) && $_POST['login'] != '' && $_POST['pass'] != '')
            {

                $admin= UsersLogin::Login();

                foreach ($admin as $val) {

                    $val['login'];
                    $val['password'];

                }

                if($val['login'] == $_POST['login'] AND $val['password'] == md5($_POST['pass']))
                {
                    $_SESSION['admin'] = 'yes';
                    $log = true;

                }
                if ($val['login'] != $_POST['login'])
                {
                    $error_login = "Wrong login";
                    $error = true;

                }

                if ($val['password'] != $_POST['pass'])
                {
                    $error_pass = "Wrong password";
                    $error = true;

                }
            }


        require_once(ROOT . '/Views/Login.php');

        exit;
    }

    public function actionLogout ()
    {

        unset ($_SESSION['admin']);
        header('Location: login');

    }
}