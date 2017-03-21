NATIONAL WATER SUPPLY AND SANITATION COUNCIL
============================================

Technology Stack
----------------
- CodeIgniter 3.0.6 (PHP >=5.5.36)
- MySQL

Installation
------------
- Clone the NWASCO project from git by running the command below in your terminal. You should have git installed on your
  environment.
  
  ```
  git clone https://github.com/SProjects/v2-nwasco
  cd v2-nwasco
  ```
- Create the a database with your favorite MySQL tool i.e. PhpMyAdmin, Sequal PRO
- Using the *.sql file found at the root of the project folder called; `database_schema_mysql.sql`, populate the database
  with a schema.
- Create config.php and database.php from the template file provided in the application/config/development folder.
- Edit the following item in config.php with the base url of your project based on the local environment.

  ``` php
  $config['base_url'] = '[INSERT ROOT URL HERE]';
  ```
- Edit the following items in database.php with the correct database connection credentials.

  ``` php
  'hostname' => '[DATABASE ROOT URL]',
  'username' => '[DATABASE USERNAME]',
  'password' => '[DATABASE PASSWORD]',
  'database' => '[DATABASE NAME]',
  ```
- And that is it. You can now go to your browser and load the base url.

Log-in and Use
--------------
Use the following login credentials;
```
Username: admin@admin.com
Password: password
```

Generating Dashboard Data
-------------------------
- Ensure that you have `curl` installed on your computer and is accessible in your terminal.
- Start the PHP server.
- Run this command in your terminal: `curl http://[BASE_URL]/data/generateSummaryData/`
- Run the command every time you add new data to the system and need the statistics to be reflected on the dashboard OR
- better still, turn this command into a cronjob on UNIX-based systems or a scheduled task on Windows systems.