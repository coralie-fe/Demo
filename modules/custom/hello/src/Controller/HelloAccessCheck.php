<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloAccessCheck extends ControllerBase {

    //creer le controlleur lié à la page hello-access
    public function content() {
        return array('#markup' => $this->t("Vous êtes sur la page Hello access check. "));
    }

}