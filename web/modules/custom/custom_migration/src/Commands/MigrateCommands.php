<?php

namespace Drupal\custom_migration\Commands;

use Drush\Commands\DrushCommands;
use Drupal\migrate\MigrateExecutable;
use Drupal\migrate\MigrateMessage;
use Drupal\migrate\Plugin\MigrationPluginManager;

/**
 * Class to run the custom Drush Commands.
 */
class MigrateCommands extends DrushCommands {

  /**
   * The Migration Plugin Manager.
   *
   * @var \Drupal\migrate\Plugin\MigrationPluginManager
   */
  protected $migrationManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(MigrationPluginManager $migrationManager) {
    $this->migrationManager = $migrationManager;
  }

  /**
   * Runs custom migrations.
   *
   * @command custom-migration:run
   * @aliases cmr
   * @option migrations Comma-separated list of migrations to run.
   * @usage custom-migration:run
   *   Runs the default custom migrations.
   * @usage custom-migration:run --migrations=custom_migrate_company,custom_migrate_users
   *   Runs the specified migrations.
   */
  public function runMigrations($options = ['migrations' => NULL]) {
    $migration_ids = $options['migrations'] ? explode(',', $options['migrations']) : [
      'custom_migrate_company',
      'custom_migrate_users',
    ];

    $migrations = $this->migrationManager->createInstances($migration_ids);

    foreach ($migrations as $migration) {
      $executable = new MigrateExecutable($migration, new MigrateMessage());
      $status = $executable->import();
      $this->logger()->success(dt('Migration @id completed with status: @status', [
        '@id' => $migration->id(),
        '@status' => $status,
      ]));
    }

    $this->logger()->success(dt('All migrations have been executed.'));
  }

  /**
   * Rolls back custom migrations.
   *
   * @command custom-migration:rollback
   * @aliases cmrb
   * @option migrations Comma-separated list of migrations to rollback.
   * @usage custom-migration:rollback
   *   Rolls back the default custom migrations.
   * @usage custom-migration:rollback --migrations=custom_migrate_company,custom_migrate_users
   *   Rolls back the specified migrations.
   */
  public function rollbackMigrations($options = ['migrations' => NULL]) {
    $migration_ids = $options['migrations'] ? explode(',', $options['migrations']) : [
      'custom_migrate_users',
      'custom_migrate_company',
    ];

    $migrations = $this->migrationManager->createInstances($migration_ids);

    foreach ($migrations as $migration) {
      $executable = new MigrateExecutable($migration, new MigrateMessage());
      $status = $executable->rollback();
      $this->logger()->success(dt('Rollback for migration @id completed with status: @status', [
        '@id' => $migration->id(),
        '@status' => $status,
      ]));
    }

    $this->logger()->success(dt('All rollbacks have been executed.'));
  }

}
