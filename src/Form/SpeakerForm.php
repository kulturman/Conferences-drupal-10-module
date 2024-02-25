<?php

namespace Drupal\conferences\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SpeakerForm extends FormBase {

  public function getFormId() {
    return 'conferences_speaker_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['fullname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full name'),
      '#required' => true,
    ];

    $form['skills'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Skills'),
      '#description' => $this->t('Comma separated list of skills'),
      '#required' => true,
    ];

    $form['photo'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Photo'),
      '#upload_location' => 'public://speaker_photos/',
      '#required' => false,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $formState) {
    if ($formState->getValue('fullname') == 'John Doe' ) {
      $formState->setErrorByName('fullname', $this->t('John Doe is not allowed to be a speaker'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $formState) {
    $this->messenger()->addStatus($this->t('Speaker added'));
  }

}
