<?php
/**
 * @
 */

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class HelloRssController extends ControllerBase {

    public function content() {

        $response = new Response();
        $response->setContent('<xml>exemple rss</xml>');

        return $response;
    }

}