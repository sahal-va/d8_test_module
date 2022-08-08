<?php

namespace Drupal\subscription\Entity;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a subscription entity type.
 */
interface SubscriptionInterface extends ContentEntityInterface {

  /**
   * Gets the subscription title.
   *
   * @return string
   *   Title of the subscription.
   */
  public function getTitle();

  /**
   * Sets the subscription title.
   *
   * @param string $title
   *   The subscription title.
   *
   * @return \Drupal\subscription\Entity\SubscriptionInterface
   *   The called subscription entity.
   */
  public function setTitle($title);

  /**
   * Gets the subscription creation timestamp.
   *
   * @return int
   *   Creation timestamp of the subscription.
   */
  public function getCreatedTime();

  /**
   * Sets the subscription creation timestamp.
   *
   * @param int $timestamp
   *   The subscription creation timestamp.
   *
   * @return \Drupal\subscription\Entity\SubscriptionInterface
   *   The called subscription entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the subscription status.
   *
   * @return bool
   *   TRUE if the subscription is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the subscription status.
   *
   * @param bool $status
   *   TRUE to enable this subscription, FALSE to disable.
   *
   * @return \Drupal\subscription\Entity\SubscriptionInterface
   *   The called subscription entity.
   */
  public function setStatus($status);

}
