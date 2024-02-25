<?php
namespace Drupal\conferences\Controller;

class ConferenceController {
  public function index() {
    return [
      '#markup' => '<p>We will display list of conferences here</p>'
    ];
  }
}
