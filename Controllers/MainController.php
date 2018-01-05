<?php

include_once ROOT.'/Models/MainPage.php';

     class MainController {

         public function actionIndex () {

             require_once (ROOT.'/Views/Index.php');




         }
         public function actionView ($id) {

             if ($id) {
                 $oneItem = MainPage::getItemById($id);
             }
             require_once (ROOT.'/Views/view.php');



         }
     };
