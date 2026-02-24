# Phlexus CMS

# Setup Project

## Rename .env_example to .env

Rename root .env_example to .env and change value according to your configs

## Rename config/config_example.php to config/config.php

Rename config/config_example.php to config/config.php and change value according to your configs

# Database

## Basic Setup

Create user and schema database accordingly to your .env file

## Create Tables and import data

./vendor/bin/phalcon-migrations run --config=config.php

# Theme

## Add Default Theme

php ./install.php

## Remove Default Theme

php ./uninstall.php

# Access Dashboard

Access dashboard at domain.local/user

## Admin login

Email: admin@phlexus.io

Password: password

### Note

For security purposes install.php and uninstall.php should be removed if not needed anymore.

Make sure that the correct config (nginx or apache) point just to the public folder