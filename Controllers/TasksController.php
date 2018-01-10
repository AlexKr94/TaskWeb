<?php

include_once ROOT . '/Models/TasksPage.php';

     class TasksController {

        public function actionIndex () {

                $curlPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $order = isset($_GET['order']) ? $_GET['order'] : 'id';

                $tasksList = array();

                $tasksList = TasksPage::getTasksList($order, $curlPage);
                $numPages = TasksPage::getNumPages();

            require_once(ROOT . '/Views/Index.php');

            exit;

         }

        public function actionCreate () {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if (isset($_POST['send'])) {

                    $email = htmlspecialchars($_POST['email']);
                    $name = htmlspecialchars($_POST['name']);
                    $text = htmlspecialchars($_POST['text']);

                    $_SESSION['email'] = htmlspecialchars($_POST['email']);
                    $_SESSION['name'] = htmlspecialchars($_POST['name']);
                    $_SESSION['text'] = htmlspecialchars($_POST['text']);

                    $error_email = "";
                    $error_name = "";
                    $error_text = "";
                    $error = false;
                    $addText= false;

                    if($email == "" || !preg_match("/@/", $email)) {

                        $error_email = "Enter your Email";
                        $error = true;
                    }
                    if(strlen($name) == 0) {

                        $error_name = "Enter your name";
                        $error = true;
                    }
                    if(strlen($text) == 0) {

                        $error_text = "Enter your task";
                        $error = true;
                    }
                    if($error == false){

                        $addText = TasksPage::addTask($email,$name,$text);
                    }
                }
            }

            else {

                $_SESSION['email'] = "";
                $_SESSION['name'] = "";
                $_SESSION['text'] = "";

                $error_email = "";
                $error_name = "";
                $error_text = "";
                $error = false;
                $addText= false;

            }

            require_once(ROOT . '/Views/Create.php');

            exit;
         }

        public function actionView ($id) {

             if ($id) {
                 $taskItem = TasksPage::getItemById($id);
             }

             require_once (ROOT.'/Views/view.php');

            exit;
         }
     };
