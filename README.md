REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------
~~~
composer install
~~~

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

### Migration
~~~
php yii migrate
~~~

### Seeder
~~~
php yii seed
~~~

RUN APPLICATION
---------------
~~~
php yii serve / php yii serve --port 8080
~~~


Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/ or http://localhost:8080/
~~~


INSTRUCTIONS
------------
1. Register as user
2. To see activation email / forgot password / confirmation message goto Yii Profiler in right bottom corner > click 'Mail' tab
3. Login as the registered user
4. Goto the 'Places' link in nav bar
5. You can see place and country. Sort / search each of them and the list will be ordered by country name
6. Can perform create / update / delete actions for Tour / Place / Country

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
