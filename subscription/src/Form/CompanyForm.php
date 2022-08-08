<?php

namespace Drupal\subscription\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the company entity edit forms.
 */
class CompanyForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    if (($this->getEntity()->isNew())) {
      // Check if account_id already exists.
      $company = $this->entityTypeManager->getStorage('company')->loadByProperties([
        'account_id' => $form_state->getValue('account_id')[0],
      ]);
      if (!empty($company)) {
        $company = reset($company);
        $form_state->setErrorByName('account_id', $this->t('Company exist with id @id.', [
          '@id' => $company->getAccountId(),
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

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New company %label has been created.', $message_arguments));
      $this->logger('subscription')->notice('Created new company %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The company %label has been updated.', $message_arguments));
      $this->logger('subscription')->notice('Updated new company %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.company.canonical', ['company' => $entity->id()]);
  }

}
