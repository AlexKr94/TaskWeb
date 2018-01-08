<?php

include_once ROOT . '/Models/TasksPage.php';

     class TasksController {

        public function actionIndex () {

            $curlpage = isset($_GET['page']) ? $_GET['page'] : 1;

            $order= isset($_GET['order']) ? $_GET['order'] : 'id';

            $tasksList = array();

            $tasksList = TasksPage::getTasksList($curlpage);
            $numPages = TasksPage::getNumPages();

                require_once (ROOT . '/Views/Index.php');

            exit;
         }

        public function actionCreate () {

             require_once (ROOT . '/Views/Create.php');

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
