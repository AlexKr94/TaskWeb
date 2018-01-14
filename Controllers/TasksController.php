<?php
include_once ROOT . '/Models/TasksPage.php';
class TasksController
{

    public function actionIndex()
    {
        if(!isset($_GET['order'])) {

            $_GET['order'] = 'id';
        }

        if(!isset($_GET['page'])) {

            $_GET['page'] = 1;
        }

        $curlPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id';
        $tasksList = array();

        $tasksList = TasksPage::getTasksList($order, $curlPage);
        $numPages = TasksPage::getNumPages();

        require_once(ROOT . '/Views/Index.php');

        exit;
    }

    public function actionCreate()
    {

        $tmpPath = 'tmp/';
        $pathFile = 'upload/';
        $types = array('image/gif', 'image/png', 'image/jpeg');
        $size = 1024000;

        $_SESSION['email'] = '';
        $_SESSION['name'] = '';
        $_SESSION['text'] = '';

       // if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['send'])) {

                $email = htmlspecialchars($_POST['email']);
                $name = htmlspecialchars($_POST['name']);
                $text = htmlspecialchars($_POST['text']);
                $img = htmlspecialchars($_FILES['pic']['name']);
                var_dump($_POST['name']);

                $_SESSION['email'] = htmlspecialchars($_POST['email']);
                $_SESSION['name'] = htmlspecialchars($_POST['name']);
                $_SESSION['text'] = htmlspecialchars($_POST['text']);

                $errorEmail = "";
                $errorName = "";
                $errorText = "";
                $errorFile = "";
                $error = false;
                $addText = false;

                if (!in_array($_FILES['pic']['type'], $types))
                {

                    $errorFile = "You can upload only .jpeg .gif .png";
                    $error = true;

                }

                if (!isset($_FILES['pic']['name']))
                {

                    $errorFile = "Choose image";
                    $error = true;

                }

                if ($_FILES['pic']['size'] > $size)
                {

                    $errorFile = "Too big image";
                    $error = true;

                }

                if (strlen($_FILES['pic']['name']) != 0)
                {

                    $uploadFile = $pathFile . basename($_FILES['pic']['name']);

                    if (!(move_uploaded_file($_FILES['pic']['tmp_name'], $uploadFile)))

                    {

                        $errorFile = 'Uploading error';
                        $error = true;

                    }

                    list($width, $height) = getimagesize($uploadFile);

                    if ($width > 320 || $height > 240 ){

                        $koe=$width/320;
                        $newHeight = ceil($height/$koe);

                        $thumb = imagecreatetruecolor(320, $newHeight);

                        if($_FILES['pic']['type'] == 'image/jpeg')
                        {

                            $source = imagecreatefromjpeg($uploadFile);

                        }

                        if($_FILES['pic']['type'] == 'image/png')
                        {

                            $source = imagecreatefrompng($uploadFile);

                        }

                        if($_FILES['pic']['type'] == 'image/gif')
                        {

                            $source = imagecreatefromgif($uploadFile);

                        }

                        imagecopyresized($thumb, $source, 0, 0, 0, 0, 320, $newHeight, $width, $height);

                        imagejpeg($thumb, $uploadFile);

                    }

                }

                if ($email == "" || !preg_match("/@/", $email))
                {

                    $errorEmail = "Enter your Email";
                    $error = true;

                }

                if (strlen($name) == 0)
                {

                    $errorName = "Enter your name";
                    $error = true;

                }

                if (strlen($text) == 0)
                {

                    $errorText = "Enter your task";
                    $error = true;

                }

                if ($error == false)
                {

                    $addText = TasksPage::addTask($email, $name, $text, $img);

                }

            }
            else{
                $errorEmail = "";
                $errorName = "";
                $errorText = "";
                $errorFile = "";
                $error = false;

                $addText = false;
            }

        //}






        require_once(ROOT . '/Views/Create.php');
        exit;
    }

    public function actionEdit ($id)
    {
        if(!$_SESSION['admin']) {
            header("Location: /users/login");
            exit;
        }

        else
        {

            $errorTask = '';
            $error = false;
            $getTask = array();
            $successEdit = false;


            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if (isset($_POST['edit']) && isset($_POST['tasks']) && strlen($_POST['tasks'])) {

                    $updTask = TasksPage::edItem($id, $_POST['tasks']);
                    $successEdit = true;

                } else {

                    $errorTask = 'Empty text field';
                    $error = true;

                }

            }
            else {
                $getTask = TasksPage::getItem($id);

                foreach ($getTask as $show):

                    $showid = $show['id'];
                    $showName = $show['name'];
                    $showEmail = $show['email'];
                    $showTask = $show['task'];

                endforeach;
            }


            require_once(ROOT . '/Views/Editing.php');
            exit;
        }
    }

    public function actionPre ()
    {
        require_once(ROOT.'/Views/Pre.php');
        exit;

    }

};
