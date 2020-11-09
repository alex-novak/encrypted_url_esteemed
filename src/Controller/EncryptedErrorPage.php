<?php

namespace Drupal\encrypted_url\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Controller for default HTTP 404 responses.
 */
class EncryptedErrorPage extends ControllerBase {

  /**
   * The default 404 content.
   *
   * @return mixed
   *   A render array containing the message to display for 404 pages.
   */
  public function on404() {
    if (!empty($_GET['encrypted_node'])) {
      $url = Url::fromRoute('entity.node.canonical', ['node' => base64_decode($_GET['encrypted_node'])]);
      return new RedirectResponse($url->toString());
    }
    else {
      return [
        '#markup' => $this->t('The requested page could not be found.'),
      ];
    }
  }

}
