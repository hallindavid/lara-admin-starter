<?php
    return [
        'permissions'=>[
            ['id'=>1000, 'slug'=>'org-admin', 'name'=>'Manage Organization','description'=>'Able to manage all the organizations resources'],
            ['id'=>1010, 'slug'=>'manage-users', 'name'=>'Manage users','description'=>'Able to add/remove/edit users']
        ],
    ];


    //When defining new permissions here - it would be good to go to the AuthServiceProvider and register them as gates as well
?>