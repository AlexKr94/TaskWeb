<?php
include_once ROOT . '/Models/TasksPage.php';
class TasksController
{

    public function actionIndex()
    {

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

        $tmp_path = 'tmp/';
        $pathFile = 'upload/';
        $types = array('image/gif', 'image/png', 'image/jpeg');
        $size = 1024000;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['send'])) {

                $email = htmlspecialchars($_POST['email']);
                $name = htmlspecialchars($_POST['name']);
                $text = htmlspecialchars($_POST['text']);
                $img = htmlspecialchars($_FILES['pic']['name']);

                $_SESSION['email'] = htmlspecialchars($_POST['email']);
                $_SESSION['name'] = htmlspecialchars($_POST['name']);
                $_SESSION['text'] = htmlspecialchars($_POST['text']);

                $error_email = "";
                $error_name = "";
                $error_text = "";
                $error_file = "";
                $error = false;
                $addText = false;

                if (!in_array($_FILES['pic']['type'], $types))
                {

                    $error_file = "You can upload only .jpeg .gif .png";
                    $error = true;

                }

                if ($_FILES['pic']['size'] > $size)
                {

                    $error_file = "Too big image";
                    $error = true;

                }

                if (strlen($_FILES['pic']['name']) != 0)
                {

                    $uploadfile = $pathFile . basename($_FILES['pic']['name']);

                    if (!(move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)))

                    {

                        $error_file = 'Uploading error';
                        $error = true;

                    }

                    list($width, $height) = getimagesize($uploadfile);
                    $koe=$width/320;
                    $newheight = ceil($height/$koe);

                    $thumb = imagecreatetruecolor(320, $newheight);

                    if($_FILES['pic']['type'] == 'image/jpeg')
                    {

                        $source = imagecreatefromjpeg($uploadfile);

                    }

                    if($_FILES['pic']['type'] == 'image/png')
                    {

                        $source = imagecreatefrompng($uploadfile);

                    }

                    if($_FILES['pic']['type'] == 'image/gif')
                    {

                        $source = imagecreatefromgif($uploadfile);

                    }

                    imagecopyresized($thumb, $source, 0, 0, 0, 0, 320, $newheight, $width, $height);

                    imagejpeg($thumb, $uploadfile);

                }

                if ($email == "" || !preg_match("/@/", $email))
                {

                    $error_email = "Enter your Email";
                    $error = true;

                }

                if (strlen($name) == 0)
                {

                    $error_name = "Enter your name";
                    $error = true;

                }

                if (strlen($text) == 0)
                {

                    $error_text = "Enter your task";
                    $error = true;

                }

                if ($error == false)
                {

                    $addText = TasksPage::addTask($email, $name, $text, $img);

                }

            }

        }

        else
        {

            $_SESSION['email'] = "";
            $_SESSION['name'] = "";
            $_SESSION['text'] = "";

            $error_email = "";
            $error_name = "";
            $error_text = "";
            $error_file = "";
            $error = false;

            $addText = false;

        }

        require_once(ROOT . '/Views/Create.php');
        exit;
    }

    public function actionView($id)
    {

        if ($id)
        {
            //$taskItem = TasksPage::getItemById($id);

            require_once(ROOT . '/Views/Pre.php');
            exit;
        }


    }

};
