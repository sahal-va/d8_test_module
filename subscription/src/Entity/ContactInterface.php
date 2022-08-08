<?php

namespace Drupal\subscription\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\subscription\Entity\CompanyInterface;

/**
 * Provides an interface defining a contact entity type.
 */
interface ContactInterface extends ContentEntityInterface, EntityOwnerInterface {

  /**
   * Gets the contact creation timestamp.
   *
   * @return int
   *   Creation timestamp of the contact.
   */
  public function getCreatedTime();

  /**
   * Sets the contact creation timestamp.
   *
   * @param int $timestamp
   *   The contact creation timestamp.
   *
   * @return \Drupal\subscription\Entity\ContactInterface
   *   The called contact entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the fullname.
   *
   * @return string
   *   Full name of the contact.
   */
  public function getFullName();

  /**
   * Gets the email of the contact.
   *
   * @return string
   *   Email of the contact.
   */
  public function getEmail();

  /**
   * Gets the company entity associated with the contact.
   *
   * @return \Drupal\subscription\Entity\CompanyInterface
   *   Company associated with the contact.
   */
  public function getCompany();

  /**
   * Gets the company id.
   *
   * @return string
   *   id of the company.
   */
  public function getCompanyId();

  /**
   * Sets the company id.
   *
   * @param string $id
   *   The company id.
   *
   * @return \Drupal\subscription\Entity\ContactInterface
   *   The called contact entity.
   */
  public function setCompanyId($id);

  /**
   * Sets the company for the contact.
   *
   * @param \Drupal\subscription\Entity\CompanyInterface $company
   *   The company entity.
   *
   * @return \Drupal\subscription\Entity\ContactInterface
   *   The called contact entity.
   */
  public function setCompany(CompanyInterface $company);

}
