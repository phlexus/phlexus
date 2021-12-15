# Phlexus CMS

# Database

## Create Tables

./vendor/robmorgan/phinx/bin/phinx migrate

## Import Data

 ./vendor/robmorgan/phinx/bin/phinx seed:run

### Note

There is a known bug with the seeding, since phinx is not prepared to respect dependecies on import.
That's why for now it's require to disabled mysql foreign keys check by using:

```SET FOREIGN_KEY_CHECKS=0;```

Don't forget to get that enabled again with:

```SET FOREIGN_KEY_CHECKS=1```

This will be fixed in the future to use phalcon migrations.

# Theme

## Add Default Theme

php ./install.php

## Remove Default Theme

php ./uninstall.php