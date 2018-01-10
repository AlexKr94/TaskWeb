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

            $email = isset($_POST['exampleInputEmail1']);
            $userName = isset($_POST['nameInput']);
            $text = isset($_POST['textArea']);

            $addText = TasksPage::addTask($email,$userName,$text);


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
