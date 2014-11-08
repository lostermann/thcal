thcal
=====

A little calendar tool custom-designed for the technical crew of Treibhaus, a club in Innsbruck, Austria (UI is German only).

What it does
------------
This tool based upon [Bootstrap](http://getbootstrap.com) 3.1 and [Fat Free Framework](http://fatfreeframework.com/home) 3.3 is a calendar specifically developed for the technical crew of Treibhaus, Innsbruck. They use it to coordinate shows and keep track of who is working when.

How to set it up
-----------------
1. Run EXECUTE_ME.sql on your SQL server to set up the table and populate it with some example data.
2. Look at /data/users and set the user credentials (Login, Password) and do not forget to give each user a unique random token, which is used to recreate the user's session with a cookie.
3. Open config.ini and put in your SQL login. The app assumes that your SQL server is "localhost".
4. Obviously, rename "_htaccess" and "data/_htaccess" to ".htaccess".
5. Enjoy.

Questions and comments can be directed to github@ostyonline.com.