<?php

namespace Drupal\conferences\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class ConferenceForm extends ContentEntityForm {
  public function save(array $form, FormStateInterface $formState) {
    $entity = $this->getEntity();
    $status = parent::save($form, $formState);

    if ($status == SAVED_NEW) {
      $this->messenger()
        ->addMessage($this->t('Created the %label Conference.', [
          '%label' => $entity->label(),
        ]));
    } else {
      $this->messenger()->addMessage($this->t('Saved the %label Conference.', [
        '%label' => $entity->label(),
      ]));
    }

    $formState->setRedirect('entity.conference.canonical', ['conference' => $entity->id()]);
  }

}
