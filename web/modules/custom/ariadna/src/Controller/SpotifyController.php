<?php

namespace Drupal\ariadna\Controller;
require_once(__DIR__ . '../../../../../../../vendor/autoload.php');

class SpotifyController {
  public function spotify() {
    return [
      '#theme' => 'ariadna',
    ];
  }
}
