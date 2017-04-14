<h3>Task for Umbrella </h3>
<div>
    <h4>Information</h4>
    <p>
	This application developed with Laravel 5.4 framework on the server side and with Backbone,Jquery frameforks on the client side. Used MySQL database. Functions realised:
	<ul>
	    <li>Form with field where user can put valid url and field for put a short url.</li>
	    <li>Generating a short url.</li>
	    <li>Checking on unique the short url.</li>
	    <li>Saving the url pair in DB and redirecting on the short url to the original url.</li>
	    <li>Removing the url pair from DB on the 15th day after its creation.</li>
	    <li>API for short url creations</li>
	</ul>
    </p>
</div>
<div>
    <h4>Installation of this application</h4>
    <p>
	This is not difficult. It is several console commands. In the first you need clone this repository.Go to the directory with app and installed requiries. Rename (or copy) .env.example on .env. This file сontains application setting and minimum that you need to filled it is database settings.

	<ol>
	    <li><code>git clone https://github.com/serg777sp/task-from-umbrella.git</code></li>
	    <li><code>cd task-from-umbrella && composer install</code></li>
	    <li><code>cp .env.example .env && nano .env</code></li>
	</ol>

	After, you need create database tables and generate the app key. For it use to the console laravel interface - artisan.
	<ol>
	    <li><code>php artisan migrate</code></li>
	    <li><code>php artisan key:generate</code></li>
	</ol>
	All ready! Now you need configure your server (apache or nginx). The start point of app in the public directory(public/index.php).<br>
	P.S. It may also be necessary to set rights on the storage directory.
	<code>
	    sudo chmod 777 storage/ -R
	</code>
    </p>
</div>
