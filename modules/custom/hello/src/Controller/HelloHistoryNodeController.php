<?php
/**
 * @
 */

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;

/*
 * aller chercher les données ds la table hello_node_history
 * et renvoyer un tableau
 */

class HelloHistoryNodeController extends ControllerBase {

    // node = objet de type node interface
    public function content(NodeInterface $node) {

        $montableau= array();
        $nodeid= $node->id();
        $query= \Drupal::database()->select('hello_node_history','h');
        $query->fields('h', ['uid', 'update_time']);
        $query->condition('h.nid', $nodeid);
        $resultats = $query->execute()->fetchAll();
        $count = count($resultats);

        //kint($resultats);
        $name = $node->getTitle();

        foreach($resultats as $resultat) {
            $storage = \Drupal::entityTypeManager()->getStorage('user');
            $auteur= $storage->load($resultat->uid);

            $montableau[]= array(
                '#auteur' => $auteur->getAccountName(),
                '#datetime' => $resultat->update_time,
            );
        }

        $tab=array(
            '#theme' => 'table',
            '#attributes' => array(
                'summary'=>'blabla tableau'),
            '#header' => array('Update author', 'Update time'),
            '#rows' => $montableau,
        );
        //return array($tab);
        // renvoyé vers le theme
        $output = array(
            '#theme' => 'theme_history',
            '#data' => $tab,
            '#name' => $name,
            '#count' => $count,
        );
        //kint($output);
        return array($output);
    }

}

/*
 * $entity_type = $entity->getEntityTypeId();
        if ($entity_type == 'node'){

        }
 */