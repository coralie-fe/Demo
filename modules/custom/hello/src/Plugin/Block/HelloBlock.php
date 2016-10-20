<?php

/**
 * @file
 * Contains \Drupal\hello\Plugin\Block\HelloBlock.
 */

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a hello block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello!"),
 * )
 */
class HelloBlock extends BlockBase {
    /**
     * Implements Drupal\Core\Block\BlockBase:build().
     * bloc affiche un message de bienvenue et la date
     */
    public function build() {
        $datenow= date('D M j G:i:s T Y');

        return array(
            '#type' => 'markup',
            '#markup' => $this->t('Bienvenue sur notre site, il est'. $datenow),
            '#cache' => array(
                '#keys' => ['hello_1'],
                '#max-age' => '10',
            ),
        );
    }
}

