<?php

namespace Drupal\subscription\Entity;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a company entity type.
 */
interface CompanyInterface extends ContentEntityInterface {

  /**
   * Gets the account id.
   *
   * @return string
   *   account id of the product.
   */
  public function getAccountId();

  /**
   * Sets the account id.
   *
   * @param string $id
   *   The account id.
   *
   * @return \Drupal\subscription\Entity\CompanyInterface
   *   The called company entity.
   */
  public function setAccountId($id);

  /**
   * Gets the company name.
   *
   * @return string
   *   Name of the company.
   */
  public function getName();

  /**
   * Sets the company name.
   *
   * @param string $name
   *   The company name.
   *
   * @return \Drupal\subscription\Entity\CompanyInterface
   *   The called company entity.
   */
  public function setName($name);

  /**
   * Gets the company creation timestamp.
   *
   * @return int
   *   Creation timestamp of the company.
   */
  public function getCreatedTime();

  /**
   * Sets the company creation timestamp.
   *
   * @param int $timestamp
   *   The company creation timestamp.
   *
   * @return \Drupal\subscription\Entity\CompanyInterface
   *   The called company entity.
   */
  public function setCreatedTime($timestamp);

}
