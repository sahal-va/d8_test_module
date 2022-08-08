<?php

namespace Drupal\subscription\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

/**
 * Form controller for the contact entity edit forms.
 */
class ContactForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    if (($this->getEntity()->isNew())) {
      // Check if contact_id already exists.
      $contact = $this->entityTypeManager->getStorage('contact')->loadByProperties([
        'contact_id' => $form_state->getValue('contact_id')[0],
      ]);
      if (!empty($contact)) {
        $contact = reset($contact);
        $form_state->setErrorByName('contact_id', $this->t('Contact exist with id @id.', [
          '@id' => $contact->get('contact_id')->value,
        ]));
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    // Create drupal account for contact user.
    $email = $entity->getEmail();
    $contact_user = $this->entityTypeManager->getStorage('user')->loadByProperties([
      'mail' => $email,
    ]);
    if (empty($contact_user)) {
      $email_parts = explode('@', $email);
      $contact_user = $this->entityTypeManager->getStorage('user')->loadByProperties([
        'name' => $email_parts[0],
      ]);
    }
    // If no user account exists, create new one.
    if (empty($contact_user)) {
      $name = $email_parts[0] ?? $email;
      $contact_user = User::create();
      $contact_user->setPassword($name);
      $contact_user->enforceIsNew();
      $contact_user->setEmail($email);
      $contact_user->setUsername($name);
      $res = $contact_user->save();
      if ($res == SAVED_NEW) {
        $entity->setOwner($contact_user);
        $entity->save();
        $this->messenger()->addStatus($this->t('New user %label has been created.', [
          '%label' => $name,
        ]));
      }
    }

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New contact %label has been created.', $message_arguments));
      $this->logger('subscription')->notice('Created new contact %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The contact %label has been updated.', $message_arguments));
      $this->logger('subscription')->notice('Updated new contact %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.contact.canonical', ['contact' => $entity->id()]);
  }

}
