# Router application with PHP
Clone with git

### Composer autoload update
In root folder
```bash
# Update composer
composer update
composer dump-autoload -o

# Import db samples (optional)
mysql -u root -p < sql/app.sql
mysql -u root -p < sql/user.sql
```

### Router
router.php
```php
<?php
use Woo\Router\Router;

try
{
    $r = new Router();

    // Home page /index , default methods: GET, POST, PUT
    $r->Set("/index", "Woo/Page/Home/Homepage", "Index");

    // Only GET
    $r->Set('/route1', function($p) {
        echo "WORKS WITH GET " . $p[0] . ' ' .$_GET['id'];
    }, ['Param 1'], ['GET']);

    // Only POST, PUT
    $r->Set('/route2', function($p) {
        echo "WORKS WITH POST " . ' ' . implode(' ', $_POST);
    }, 'Func params here', ['POST', 'PUT']);

    // Api route
    $r->Set("/api/user/{id}", "Woo/Page/User/User", "GetId");

    // Add route: url, class path, class method
    $r->Set("/welcome/email/{id}", "Woo/Page/Sample/SampleClass", "Index");

    // Or load from controller route.php file
    $r->Include('Page/Sample/route');

    // Error Page
    $r->ErrorPage();
}
catch(Exception $e)
{
    echo json_encode(["errorMsg" => $e->getMessage(), "errorCode" => $e->getCode()]);
}
?>
```

### App settings
src/App/Settings/Config.php
```bash
<?php
namespace Woo\App\Settings;

class Config
{
	// Mysql db
	const MYSQL_HOST = 'localhost';
	const MYSQL_USER = 'root';
	const MYSQL_PASS = 'toor';
	const MYSQL_PORT = 3306;
	const MYSQL_DBNAME = 'app';

	// Smtp settings
	const SMTP_USER = '';
	const SMTP_PASS = '';
	const SMTP_HOST = '127.0.0.1';
	const SMTP_PORT = 25; // 25, 587, 465
	const SMTP_FROM_EMAIL = 'no-reply@local.host';
	const SMTP_FROM_USER = 'Newsletter';
	const SMTP_TLS = false;
	const SMTP_AUTH = false;
	const SMTP_DEBUG = 0;
}
?>
```

# Server settings

### Nginx redirect all to index.php
```php
server {
	...

	location / {
		# Get file or folder or redirect uri to url param in index.php
		try_files $uri $uri/ /index.php?url=$uri&$args;

		# Get file or folder or redirect uri to index.html
		# try_files $uri $uri/ /index.html;
		# Get file or folder or error
		# try_files $uri $uri/ =404;
	}

	location = /favicon.ico {
        rewrite . /favicon/favicon.ico;
	}

	location ~ \.php$ {
        # Php-fpm
        # include snippets/fastcgi-php.conf;
        # fastcgi_pass unix:/var/run/php/php7.3-fpm.sock;
    }
	...
}
```

### Apache2 Server .htaccess file
Create in new-app project directory
```sh
RewriteEngine on
RewriteBase /

# Display already existing files and folders
RewriteCond %{REQUEST_FILENAME} -d [OR]
RewriteCond %{REQUEST_FILENAME} -l [OR]
RewriteCond %{REQUEST_FILENAME} -f
RewriteRule (.*) $1 [NC,QSA,L]

# Rewrite all urls
RewriteRule ^(.*)/?$ index.php?url=$1 [NC,L,QSA]
```

### Apache2 htdocs permission
```sh
# apache2
chown -R www-data:username /path/to/new-app
chmod -R 775 /path/to/new-app
```

# Backup mysql
```bash
# Data and struct
mysqldump -u root -p"passwd" --add-drop-database --databases app  > app-backup.sql

# Struct only
mysqldump -u root -p"passwd" --no-data --add-drop-database --databases app  > app-backup-schema.sql
```

# Curl requests
```bash
# GET
curl http://phpapi.xx/route1?name=admin&shoesize=1

# POST
curl -d 'name=PhpApix&age=19' http://phpapi.xx/route2
```

# Backup bash script
nano db-backup.sh
```bash
#!/bin/bash

# Allow execute
# chmod +x db-backup.sh
# Run script
# ./db-backup.sh

# declare variable
MYSQL_USER="app"
MYSQL_PASS="toor"
STR_BACKUP="Bakap bazy danych"
DATE=$(date +"%d-%b-%Y")
DB_DIR="backups"

echo $STR_BACKUP

# Permissions
umask 177

# Create dir path
mkdir -p $DB_DIR

# Backup mysql db
mysqldump -u $MYSQL_USER -p$MYSQL_PASS --add-drop-database --databases app  > $DB_DIR/app-backup-$DATE.sql

# Backup all dbs
mysqldump -u $MYSQL_USER -p$MYSQL_PASS --add-drop-database --all-databases > $DB_DIR/all-backup-$DATE.sql

# Delete files older than 30 days
find $DB_DIR/* -mtime +30 -exec rm {} \;

echo "[DONE]";

# Change permissions for current folder
# chmod -R 775 .
```

# Logo
![Woo - router application PHP](https://raw.githubusercontent.com/moovspace/Woo/master/media/img/woo-banner.png)
