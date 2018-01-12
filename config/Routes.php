<?php




     return array (

         'users/([a-z]+)' => 'users/$1',

         'tasks/([a-z]+)/([0-9]+)' => 'tasks/$1/$2',

         '/([a-z]+)/([0-9]+)' => 'tasks/$1/$2',

         'tasks/([a-z])' => 'tasks/$1',

         '/tasks' => 'tasks.web/tasks/Index/?page=1&order=id',

         '' => 'tasks/Index/?page=1&order=id',


     );
