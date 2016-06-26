# TodoList-Symfony-GoogleTasks

TodoList with Symfony and GoogleTasks (connection with oAuth2)
Demo : https://blooming-lowlands-39021.herokuapp.com/ 

## Introduction

This application was created with my partner Myriam Khettab for a project during my professional degree. It allow to be connected with Google Tasks (via OAuth2).


## Installation

For install our application, just run :

> composer install

Or if you have composer.phar in your root:

> php composer.phar install

After that, you have to change (if you want) the configuration in app/config/config.yml

> happy_r_google_api:
  application_name: Your Application Name
  oauth2_client_id: Your client ID
  oauth2_client_secret: Your client secret
  oauth2_redirect_uri: http://www.yoursite.com/callback
  developer_key: Your developper key
  site_name: Your Application Name
  
## Functions

* Authentication via oAuth
* Logout

* Create Task List
* Read Task List
* Update Task List
* Delete Task List

* Create Task
* Read Task
* Update Task
* Delete Task
* Set Completd Task
* Set Uncompleted Task



