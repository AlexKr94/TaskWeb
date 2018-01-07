<?php

include_once ROOT.'/components/Db.php';

     class TasksPage {

         public static function getItemById ($id){

             $id = intval($id);

             if ($id) {

                 $db = Db::getConnection();

                 $result = $db->query('SELECT * from tasks WHERE id='. $id);

                 $result->setFetchMode (PDO::FETCH_ASSOC);

                 $taskItem = $result->fetch();
                 return $taskItem;
             }
         }

         public static function getTasksList ($page, $order = 'id') {

             $db = Db::getConnection();

             $tasksList = array();

             $result = $db->query('SELECT count(*) FROM tasks');

             //$result = $db->query('SELECT * FROM tasks ORDER BY id ASC LIMIT 3');
             $pageCount = $result ->fetch();

             if (!$page) {

                 $start = ($page -1) * $pageCount;

                 $result = $db->query("SELECT * FROM tasks ORDER BY id ASC LIMIT $start $pageCount");
             }

            $i = 0;
             while($row = $result->fetch()) {

                 $tasksList[$i]['id'] = $row['id'];
                 $tasksList[$i]['name'] = $row['name'];
                 $tasksList[$i]['email'] = $row['email'];
                 $tasksList[$i]['task'] = $row['task'];
                 $i++;
             }

             return $tasksList;






         }
     }