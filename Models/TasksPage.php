<?php

include_once ROOT.'/components/Db.php';

     class TasksPage {

         const TASKSONPAGE = 3;

        /* public static function getItemById ($id){

             $id = intval($id);

             if ($id) {

                 $db = Db::getConnection();

                 $result = $db->query('SELECT * from tasks WHERE id='. $id);

                 $result->setFetchMode (PDO::FETCH_ASSOC);

                 $taskItem = $result->fetch();
                 return $taskItem;
             }
         }*/

         public static function getTasksList ($order, $curlPage) {

             $db = Db::getConnection();

             $tasksList = array();

             if(!isset($_GET['order'])) {

                 $_GET['order'] = 'id';
             }

             $orderPrepare= array('id','name','email', 'img');
             $key= array_search($_GET['order'],$orderPrepare);
             $orders = $orderPrepare[$key];

             $page = 1;

                 if (isset($curlPage) && $curlPage > 0) {
                     $page = $curlPage;
                 }

                 $offset = ($page -1) * self::TASKSONPAGE;

             $result = $db->prepare("SELECT * FROM tasks ORDER BY ".$orders." ASC LIMIT :off," . self::TASKSONPAGE);
             $result->bindValue(':off', $offset, PDO::PARAM_INT);

             $result->execute();


            $i = 0;
             while($row = $result->fetch()) {

                 $tasksList[$i]['id'] = $row['id'];
                 $tasksList[$i]['name'] = $row['name'];
                 $tasksList[$i]['email'] = $row['email'];
                 $tasksList[$i]['task'] = $row['task'];
                 $tasksList[$i]['img'] = $row['img'];
                 $i++;
             }

             return $tasksList;

         }

         public static function getNumPages (){

             $db = Db::getConnection();

             $resultCount = $db->query('SELECT count(*) FROM tasks');
             $Count = $resultCount->fetch();

            $tasksCount = $Count['count(*)'];

             $numPages = ceil($tasksCount/self::TASKSONPAGE);

             return $numPages;

         }

         public static function addTask ($email, $name, $text, $img) {

             $db = Db::getConnection();

             $add = $db->prepare("INSERT INTO `tasks`(`name`, `email`, `task`, `img` ) VALUES (:name,:email, :text, :img)");

             $add->bindValue(':email', $email);
             $add->bindValue(':name', $name);
             $add->bindValue(':text', $text);
             $add->bindValue(':img', $img);

             $add->execute();

             $addText = true;

             return $addText;
         }

         public static function getItem ($id)
         {

             $db = Db::getConnection();

             $result = $db->prepare("SELECT * FROM tasks WHERE id=:id");

             $result->bindValue('id', $id);

             $result->execute();

             $i = 0;
             while($item = $result->fetch()) {

                 $getTask[$i]['id'] = $item['id'];
                 $getTask[$i]['name'] = $item['name'];
                 $getTask[$i]['email'] = $item['email'];
                 $getTask[$i]['task'] = $item['task'];
                 $i++;
             }

             return $getTask;

         }

         public static function edItem($id, $newTask)
         {

             $db = Db::getConnection();

             $result = $db->prepare("UPDATE tasks SET task =:newTask WHERE `tasks`.`id=:id");

             $result->bindValue('id', $id);
             $result->bindValue('newTask', $newTask);

             $result->execute();

             $successEdit = true;

             return $successEdit;

         }
     }