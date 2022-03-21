# myfirstsite-php

Hi! This project contains the backed PHP project. 
It uses MySQL, composer and JWTs. 

This project belongs with the Front-end project on:
https://github.com/GPossel/myfirstsite

This project can be run with the following command:
php -S localhost:8081

Following endpoint: 
  - / GET http://localhost:8081/src/repository/contacts.php
      - returns all contacts
  - / GET http://localhost:8081/src/repository/contacts.php uri ?id=1
      - returns contact on id
  - / POST http://localhost:8081/src/repository/login.php form-data { "username": "gen", "psw": "gen" }
      - returns JWT in header

This project was made by Gentle (639567) and is only for educational purposes. 2022
