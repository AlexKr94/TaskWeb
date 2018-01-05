<?php

include_once ROOT.'/components/Db.php';

     class MainPage {

         public static function getItemById ($id){

             $id = intval($id);

             if ($id) {

                 $db = Db::getConnection();

                 $result = $db->query('SELECT * from tabl1 WHERE id='. $id);
                 $result->setFetchMode (PDO::FETCH_ASSOC);

                 $idItem = $result->fetch();
                 return $idItem;
             }
         }

         public static function getItemList () {

             $db = Db::getConnection();

                 $itemList = array();

                 $result = $db->query('SELECT id, text', 'FROM tabl1');

                 $i = 0;

                 while($row = $result->fetch()) {

                     $itemList[$i]['id'] = $row['id'];
                     $itemList[$i]['text'] = $row['text'];
                     $i++;
                 }

                 return $itemList;
             }
     }