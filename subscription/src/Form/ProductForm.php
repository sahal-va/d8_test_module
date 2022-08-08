<?php

namespace Drupal\subscription\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the product entity edit forms.
 */
class ProductForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    if (($this->getEntity()->isNew())) {
      // Check if product_id already exists.
      $product = $this->entityTypeManager->getStorage('product')->loadByProperties([
        'product_id' => $form_state->getValue('product_id')[0],
      ]);
      if (!empty($product)) {
        $product = reset($product);
        $form_state->setErrorByName('product_id', $this->t('Product exist with id @id.', [
          '@id' => $product->getProductId(),
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
      $this->messenger()->addStatus($this->t('New product %label has been created.', $message_arguments));
      $this->logger('subscription')->notice('Created new product %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The product %label has been updated.', $message_arguments));
      $this->logger('subscription')->notice('Updated new product %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.product.canonical', ['product' => $entity->id()]);
  }

}
