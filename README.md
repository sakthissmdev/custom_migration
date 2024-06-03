# Back end Drupal Coding Test

For this assessment we’ll be importing data from JSON into a few related entities, using the sample data here: https://jsonplaceholder.typicode.com/users.

To set up the project please fork this GitHub repository to your personal account.  

We use Docker Desktop and DDEV for Drupal our local development. If you prefer a different local development enviroment, please use what you are comfortable with or already have set up.

To install Docker and DDEV please follow their instructions here: 
* [Docker](https://ddev.readthedocs.io/en/latest/users/install/docker-installation/)
* [DDEV](https://ddev.readthedocs.io/en/latest/users/install/ddev-installation/)

Once DDEV and Docker are set up you can start the project by running the following commands:

```
cd back-end
ddev start
ddev composer install
ddev drush site:install --account-name=admin --account-pass=admin -y
ddev drush pm:enable migrate migrate_plus
ddev launch
```

To stop DDEV run:
```
ddev poweroff
```

Your first task is to set up two content types in Drupal 10, one for “User” and one for “Company”, each with the relevant fields from the data at the sample API link above.

Next, write a migration module that imports from the JSON endpoint into Drupal as nodes of each content type.  Please use Drupal’s migrate API to import the content.  Drupal helper modules dependencies are fine to use as long as their installation is noted in the module’s README file. We have included `migrate_plus` in the project if you would like to use it.

Finally, write a custom route that displays the users and their companies on a page (it doesn’t have to be pretty, this is a backend test, after all but if you have any frontend skills this is a great place to show them off). 

Bonus points: create a Drush script to run the migrations.

Once you’re done, double and triple check your code, including code style to make sure it is up to Drupal standards. Add notes to the module's README.md with a high level overview on your approach and any commands that need to be run for the migration.

Email a link back to your repository for us to review. We should be able to clone it locally, run the ddev commands above plus any commands in the module's README.md file to see your work.

You have 48 hours from now to return this exercise back to us. Good luck, and feel free to reach out with any questions!