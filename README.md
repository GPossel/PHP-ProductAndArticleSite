# myfirstsite-php

Hi! This project contains the backed PHP project. 
It uses MySQL, composer and JWTs.

This project belongs with the Front-end project on:
https://github.com/GPossel/myfirstsite

This project can be run with the following command:
#### php -S localhost:8081

Following endpoint: 

Contacts
  - / GET http://localhost:8081/src/repository/contacts.php
      - returns all contacts
  - / GET http://localhost:8081/src/repository/contacts.php uri ?id=1
      - returns contact on id
  - / POST http://localhost:8081/src/repository/contacts.php 

                                                                      formData:          
                                                                                name:John
                                                                                email:john@hotmail.com
                                                                                country:The Netherlands
                                                                                city:Amsterdam
                                                                                job:Software Engineer
     - returns 


Login
  - / POST http://localhost:8081/src/repository/login.php
                                                          formData:
  
      - returns JWT in header
 
Articles
  - / GET http://localhost:8081/src/repository/articles.php
    - returns all articles on page
  - / POST [AUTHORIZED] http://localhost:8081/src/repository/articles.php


                                                                      formData:
                                                                                title:A new Article
                                                                                writer:G. Possel
                                                                                innerText:A new Article about fun facts.
                                                                                fullText:This article contains a lot of funny facts about PHP.
                                                                                

This project was made by Gentle (639567) and is only for educational purposes. 2022
