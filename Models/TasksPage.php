<?php

include_once ROOT.'/components/Db.php';

     class TasksPage {

         const TASKSONPAGE = 3;

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

         public static function getTasksList ($curlpage, $order = 'id') {

             $db = Db::getConnection();

             $tasksList = array();

             $page = 1;
                 if (isset($curlpage) && $curlpage > 0) {
                     $page = $curlpage;
                 }

                 $offset = ($page -1) * self::TASKSONPAGE;

                 $result = $db->prepare("SELECT * FROM tasks ORDER BY id ASC LIMIT :off," . self::TASKSONPAGE);
                 $result->bindValue(':off', $offset, PDO::PARAM_INT);

                 $result->execute();


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

         public static function getNumPages (){

             $db = Db::getConnection();

             $resultcount = $db->query('SELECT count(*) FROM tasks');

             $Count = $resultcount->fetch();

            $tasksCount = $Count['count(*)'];

             $numPages = ceil($tasksCount/self::TASKSONPAGE);

             return $numPages;

         }
     }