<?php

namespace Drupal\conferences\Controller;

use Drupal\conferences\Form\SpeakerForm;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

class SpeakerController extends ControllerBase {
  public function index() {

    $build = [
      'markup' => [
        '#markup' => $this->t('We will display speakers here'),
      ]
    ];

    if ($this->currentUser()->isAnonymous()) {
      $url = Url::fromRoute('user.login');
      $link = Link::fromTextAndUrl($this->t('Register or login to create a speaker profile')->render(), $url);

      $build['anonymous'] = [
        $link->toRenderable()
      ];
    }
    else {
      $build['form'] = $this->formBuilder()->getForm(SpeakerForm::class);
    }

    return $build;
  }
}
