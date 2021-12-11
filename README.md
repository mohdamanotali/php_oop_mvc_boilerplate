# PHP OOP MVC Boilerplate

it is a simple boilerplate for oop php which follows mvc pattern.
\
*a demo crud for 'highest paid athletes ranking' is done using this boilerplate*
\
\
**File/Folder Structure**

```html
1 - config
1.1 - dotenv.php
1.2 - router.php

2 - core
2.1 - controllers
2.2 - models
2.2.1 - Database.php
2.3 - traits
2.3.1 - CommonTrait.php

3 - public
3.1 - assets
3.1.1 - css
3.1.2 - js
3.1.3 - img
3.2 - logs
3.3 - resources
3.4 - app.php

4 - templates
4.1 - partials
4.2 - views

5 - .htaccess
```

See [`structure.txt`](https://github.com/mohdamanotali/php_oop_mvc_boilerplate/blob/main/structure.txt) file.
\
\
**Running demo crud**

Open [`config/dotenv.php`](https://github.com/mohdamanotali/php_oop_mvc_boilerplate/blob/master/config/dotenv.php) file and change the following accordingly.

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pomb_db');
```

Import [`pomb_db.sql`](https://github.com/mohdamanotali/php_oop_mvc_boilerplate/blob/main/pomb_db.sql) to your database and simply run the project from the browser.
