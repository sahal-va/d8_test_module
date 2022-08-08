<?php

namespace Drupal\subscription\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Cache\Cache;

/**
 * Returns responses for Subscription routes.
 */
class SubscriptionController extends ControllerBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The controller constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
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
   * Builds the response.
   */
  public function listUsers() {

    $data = [];
    $cache_tags = [];
    $contacts = $this->entityTypeManager->getStorage('contact')->loadMultiple();
    foreach ($contacts as $contact) {
      $data[] = [
        'contact_id' => $contact->label(),
        'full_name' => $contact->getFullName(),
        'email' => $contact->getEmail(),
        'company' => $contact->getCompany()->label(),
      ];
      $cache_tags = Cache::mergeTags($cache_tags, $contact->getCacheTags());
    }

    $build['content'] = [
      '#theme' => 'list_subscription_users',
      '#data' => $data,
      '#cache' => [
        'tags' => $cache_tags,
      ],
    ];

    return $build;
  }

}
