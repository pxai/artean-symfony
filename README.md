Instalation
===========
Linux:
sudo curl -LsS http://symfony.com/installer -o /usr/local/bin/symfony
sudo chmod a+x /usr/local/bin/symfony

Windows
php -r "readfile('http://symfony.com/installer');" > symfony

Project creation
================
symfony new project_name

First steps
===========
Change/Set timezone in php.ini
...
date.timezon = Europe/Madrid
...

Check that everything is fine
php artean-ng/app/check.php
artean-ng
=========

A Symfony project created on April 13, 2015, 12:31 pm.
php app/console generate:bundle

Adding bootstrap
================

edit app/config/config.yml
then go to assetic:
under assetic: go to bundles: []
and in bundles: [] //type your bundle name
for instance if your bundle is Acme\DemoBundle, then do the following

assetic:
   bundles: [ CuatrovientosArteanBundle ]

Steps for creating a CRUD
=========================

* Add routes in routing.yml
* Create a controller
* Create an Entity
* Create an EntityRepository
* Create the Form class
* Create validations
* Create translations
* Create views

Last step
=========
Keep on working
