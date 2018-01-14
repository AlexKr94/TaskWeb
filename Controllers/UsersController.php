<?php


include_once ROOT . '/Models/UsersModel.php';

class UsersController
{

    public function actionLogin()
    {
        $error_login = '';
        $error_pass = '';
        $error = false;
        $log = false;

        $admin= array();

            if(isset($_POST['logbut']) && $_POST['login'] != '' && $_POST['pass'] != '')
            {

                $admin= UsersModel::login();

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

    public function actionEdit ($id)
    {

        $errorTask = '';
        $error = false;
        $getTask = array();

        $getTask = UsersModel::getItem($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['edit']) && isset($_POST['EdTask']) && strlen($_POST['EdTask']) != 0){

                $Edtask =htmlspecialchars($_POST['EdTask']);

            }
            else{

                $errorTask = 'Empty text field';
                $error = true;

            }



        }

        require_once (ROOT.'/Views/Editing.php');

    }

    public function actionLogout ()
    {

        unset ($_SESSION['admin']);
        header('Location: login');

    }
}