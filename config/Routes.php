<?php




     return array (

         'tasks/([a-z]+)/([0-9]+)' => 'tasks/$1/$2',

         'tasks/([a-z])' => 'tasks/$1',

         'tasks/?([a-z])' => 'tasks/$1',

         'tasks' => 'tasks/Index/?page=1&order=id',

         '' => 'tasks/Index/?page=1&order=id',

     );

