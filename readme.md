# Documenter

Documenter is a web app designed to handle documents, keep them secure, and make sure they are shared to the right people.

Created as a requirement for Software Engineering

## Requirements

* PHP >= 5.5.9
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* Composer
* MySQL Server
* Text editor

[See Laravel Documentation on Installation](https://laravel.com/docs/5.1#installation)


## Installation Instructions

1. 	In a terminal, go to the root directory of they application and run the following command.

	```
	composer install
	```

	This installs all of Laravel's dependencies and is required to have anything run.


2. 	Duplicate .env.example to .env. This could be done by using the terminal command

	```
	cp .env.example .env
	```

3. 	Generate the application key using the following command.

	```
	php artisan key:generate
	```

	This is an important step. If not done, your user sessions and other encrypted data will not be secure.
	[See Laravel Documentation on Basic Configuration](https://laravel.com/docs/5.1#basic-configuration)


4. 	Configure desired database in your .env file or add custom settings. By default, the system is configured for MySQL with the following settings:

	```
	DB_HOST=localhost:3306
	DB_DATABASE=documenter
	DB_USERNAME=root
	DB_PASSWORD=
	```

	If anything is different in your setup, please replace the value in your .env file. Otherwise, delete the properties that already match.

5. 	Once the database is configured, run the migration and database seeder with the following command:

	```
	php artisan migrate --seed
	```

	This will generate the tables needed and create an admin user with the username and password of admin.

6.	Start up the server. This could be done in one of two ways. For a local server, simply run the command:

	```
	php artisan serve
	```

	If you want to make the application available to a network, run the following command instead:

	```
	php -S <computer_ip>:<port_number> -t public
	```

	Be sure that your .env file is setup correcty and you should be good to go!

7. 	(Optional) If you want to use the email feature, configure the email settings in your .env file and run the following command along with the server:

	```
	php artisan queue:listen
	```

## Some Facts
* Laravel Version: 5.1
* A few kinks here and there but very usable (Please report bugs! Thanks!)
* Credentials feature planned to be removed