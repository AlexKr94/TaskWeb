<?php

include_once ROOT . '/Models/TasksPage.php';

     class TasksController {

        public function actionIndex () {

            $tasksList = array();
            $tasksList = TasksPage::getTasksList();

                require_once (ROOT . '/Views/Index.php');

            exit;
         }

        public function actionCreate () {

             require_once (ROOT . '/Views/Create.php');
         }

        public function actionView ($id) {

             if ($id) {
                 $taskItem = TasksPage::getItemById($id);
             }

             require_once (ROOT.'/Views/view.php');
         }
     };
