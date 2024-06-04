# Custom Migration
This module used for migrating contents from JSON API endpoint to Drupal.
URL: https://jsonplaceholder.typicode.com/users

## Table of Contents
- Requirements
- Installation
- Configuration
- Maintainers

## Requirements
- This module requires Migrate, Migrate Plus, Drush, Geo Field Field Group.

## Installation
- Install as you would normally install a contributed Drupal module. For further
  information, see [Installing Drupal Modules](https://www.drupal.org/docs/extending-drupal/installing-drupal-modules).

## Configuration
-  This module will import the migration configs for migrating company
  and users.

## Drush Commands
-  This module has the following commands for importing and rolling back the
  migrations provided if not will import company and user.
  1. drush custom-migration:run --migration=.. aliased as drush cmr
  2. custom-migration:rollback --migration=.. aliased as drush cmrb

## Routes
-  This module provides route "/custom-migration/users" to display users with
  associated company with some little stylings.

## Maintainers
-  Sakthi Shanmuga Sundaram (sakthi_dev)
