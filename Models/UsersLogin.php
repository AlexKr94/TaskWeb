<?php


include_once ROOT.'/components/Db.php';

    class UsersLogin {

        public static function Login () {

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

    }