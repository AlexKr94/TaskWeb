<?php


include_once ROOT.'/components/Db.php';

    class UsersModel {

        public static function login ()
        {

            $db = Db::getConnection();

            $result = $db->prepare("SELECT * FROM users");

            $result->execute();


            $i = 0;
            while($dat = $result->fetch()) {

                $admin[$i]['id'] = $dat['id'];
                $admin[$i]['login'] = $dat['login'];
                $admin[$i]['password'] = $dat['password'];
                $i++;
            }

            return $admin;

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

    }