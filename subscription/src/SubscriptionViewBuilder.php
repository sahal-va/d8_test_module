<?php

namespace Drupal\subscription;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityViewBuilder;

/**
 * Provides a view controller for a subscription entity type.
 */
class SubscriptionViewBuilder extends EntityViewBuilder {

  /**
   * {@inheritdoc}
   */
  protected function getBuildDefaults(EntityInterface $entity, $view_mode) {
    $build = parent::getBuildDefaults($entity, $view_mode);
    // The subscription has no entity template itself.
    unset($build['#theme']);
    return $build;
  }

}
