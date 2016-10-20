<?php

/**
 * @file
 * Contains \Drupal\hello\Plugin\Block\sessionBlock.
 */

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a session block.
 *
 * @Block(
 *   id = "session_block",
 *   admin_label = @Translation("Sessions actives !"),
 * )
 */
class sessionBlock extends BlockBase {
    /**
     * Implements Drupal\Core\Block\BlockBase:build().
     * création bloc qui va chercher les sessions actives
     */
    public function build() {

        $database= \Drupal::database();
        $session_num =$database->select('sessions','w')
                        ->fields('w',array('sid'))
                        ->countQuery()
                        ->execute()
                        ->fetchField();

        return array(
            '#type' => 'markup',
            '#markup' => $this->t('Il y a actuellement'. $session_num.' sessions(s) active(s)'),

        );
    }

    // si l'autocompletion ne fonctionne pas avec $account
    // c'est qu'il ne connait pas la class AccountInterface
    // réécrire la fin de AccountInterface pour implémenter le use Drupal\Core\Session\AccountInterface;
    protected function blockAccess(AccountInterface $account)
    {
        if($account->hasPermission('permission session block')){
            return AccessResult::allowed();
        }
        // la fonction doit return qlques chose
        return AccessResult::forbidden();

    }
}

