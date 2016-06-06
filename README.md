Instalation
===========
Linux:
```
sudo curl -LsS http://symfony.com/installer -o /usr/local/bin/symfony
sudo chmod a+x /usr/local/bin/symfony
```

Windows
```
php -r "readfile('http://symfony.com/installer');" > symfony
```

composer install

Project creation
================
symfony new project_name

Command help
============
```
php bin/console list
```

First steps
===========
Change/Set timezone in php.ini
...
date.timezon = Europe/Madrid
...

Check that everything is fine
```
php artean-ng/app/check.php
```
update targets
==============
[http://symfony.com/doc/current/book/templating.html#including-stylesheets-and-javascripts-in-twig]
```
php bin/console assets:install web
```

artean-ng
=========

A Symfony project created on April 13, 2015, 12:31 pm.
php app/console generate:bundle

Adding bootstrap
================
```
bower install --save bootstrap
```

v3
in AppKernel.php
            new AppBundle\AppBundle(),
            new Cuatrovientos\ArteanBundle\CuatrovientosArteanBundle(),
            new Pello\SerONoSerBundle\PelloSerONoSerBundle(),
v2
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


run
====
 Configure your application in app/config/parameters.yml file.

    * Run your application:
        1. Execute the php bin/console server:run command.
        2. Browse to the http://localhost:8000 URL.


Production
===========

Instalation of composer [https://getcomposer.org/download/]
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '070854512ef404f16bac87071a6db9fd9721da1684cd4589b1196c3faf71b9a2682e2311b36a5079825e155ac7ce150d') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
Then move to bin:
```
mv composer.phar /usr/local/bin/composer
```
Finally run composer to download required libraries such as doctrine, assetic,...
```
composer install
```
And now, before moving to prod [http://symfony.com/doc/current/cookbook/deployment/tools.html]

```
php bin/console cache:clear --env=prod --no-debug
php bin/console assetic:dump --env=prod --no-debug
```

Now change in web/app.php change
```
$kernel = new AppKernel('prod', false);
``` 
To:
```
$kernel = new AppKernel('prod', true);
``` 
Another issue. Add this when uploading to prod in app/config/routing_dev.yml
```
_assetic:
    resource: .
    type:     assetic
```