<?php

namespace Drupal\subscription\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a product entity type.
 */
interface ProductInterface extends ContentEntityInterface, EntityChangedInterface {

  /**
   * Gets the product id.
   *
   * @return string
   *   id of the product.
   */
  public function getProductId();

  /**
   * Sets the product id.
   *
   * @param string $id
   *   The product id.
   *
   * @return \Drupal\subscription\Entity\ProductInterface
   *   The called product entity.
   */
  public function setProductId($id);

  /**
   * Gets the product name.
   *
   * @return string
   *   name of the product.
   */
  public function getName();

  /**
   * Sets the product name.
   *
   * @param string $name
   *   The product name.
   *
   * @return \Drupal\subscription\Entity\ProductInterface
   *   The called product entity.
   */
  public function setName($name);

  /**
   * Gets the product creation timestamp.
   *
   * @return int
   *   Creation timestamp of the product.
   */
  public function getCreatedTime();

  /**
   * Sets the product creation timestamp.
   *
   * @param int $timestamp
   *   The product creation timestamp.
   *
   * @return \Drupal\subscription\Entity\ProductInterface
   *   The called product entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the product status.
   *
   * @return bool
   *   TRUE if the product is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the product status.
   *
   * @param bool $status
   *   TRUE to enable this product, FALSE to disable.
   *
   * @return \Drupal\subscription\Entity\ProductInterface
   *   The called product entity.
   */
  public function setStatus($status);

}
