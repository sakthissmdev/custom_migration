<?php

namespace Drupal\custom_migration\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Link;

/**
 * Class RenderUsers.
 *
 * Controller to render users data.
 */
class RenderUsers extends ControllerBase {

  /**
   * The Entity Type Manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * Renders user data in a table.
   *
   * @return array
   *   A render array containing the user data.
   */
  public function renderUser() {
    $nodes = $this->entityTypeManager->getStorage('node');
    $query = $nodes->getQuery();
    $user_ids = $query
      ->condition('type', 'user')
      ->condition('status', 1)
      ->accessCheck(FALSE)
      ->execute();

    $users = $nodes->loadMultiple($user_ids);

    $header = ['User ID', 'User Name', 'Company Associated'];
    $rows = [];

    foreach ($users as $user) {
      $companyId = $user->field_company_associated->target_id;
      $companyName = $user->field_company_associated->entity->label();
      $company = Link::createFromRoute($companyName, 'entity.node.canonical', ['node' => $companyId]);
      $rows[] = [
        $user->field_id->value,
        $user->label(),
        $company,
      ];
    }

    return [
      '#theme' => 'render_user',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

}
