<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('D:/Program Files/wamp/www/HealthyOne/model/test.db');
      }
   }

?>