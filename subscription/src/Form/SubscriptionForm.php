<?php

namespace Drupal\subscription\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the subscription entity edit forms.
 */
class SubscriptionForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    // Manage user account on subscription Active/Termination.
    if ($entity->get('status')->value) {
      $user = $entity->contact->entity->getOwner();
      if (!$user->isActive()) {
        $user->activate();
        $user->save();
      }
    }
    else {
      // Check the user has any other active subscription.
      $user = $entity->contact->entity->getOwner();
      $active_subscriptions = $this->entityTypeManager->getStorage('subscription')->loadByProperties([
        'contact' => $entity->contact->target_id,
        'status' => TRUE,
      ]);
      if (empty($active_subscriptions)) {
        $user->block();
        $user->save();
      }
    }

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New subscription %label has been created.', $message_arguments));
      $this->logger('subscription')->notice('Created new subscription %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The subscription %label has been updated.', $message_arguments));
      $this->logger('subscription')->notice('Updated new subscription %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.subscription.canonical', ['subscription' => $entity->id()]);
  }

}
