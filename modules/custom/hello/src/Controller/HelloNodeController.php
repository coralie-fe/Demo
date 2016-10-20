<?php
/**
 * @
 */

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloNodeController extends ControllerBase {

    // aller chercher et renvoyer un type d'objet
    // en liste
    public function content($listenode) {
        // type manager, storage, multiple, entity interface
        // getstorage = c pour un type d'entitée
        // parametre $listenode, exemple = article
        // entityTypeManager = utilisé pour
        // les entité : tout ce qui possede un id unique : node user taxonomy comment files views roles style d'image

        $montableau=array();
        $storage = \Drupal::entityTypeManager()->getStorage('node'); //1. chargé le systeme de stockage (l'objet qui permet de gerer le stockage de l'netité concernée: ajout suppression chargement create delete save load)
        $query= \Drupal::entityQuery('node');

            if($listenode != ''){
                $query->condition('type', $listenode, '=');
            }
        //$ids= $query->execute(); //2. recuperer les ids des type d'entité
        $ids= $query->pager('15')->execute(); //2. recuperer les ids des type d'entité

        $entities= $storage->loadMultiple($ids); //3. charger les objets qui correspondent à ces objets

        foreach($entities as $entitie) {
            //kint($entitie);
            //break;
            //return array('#markup' => $entitie->getTitle());
            $montableau[]= $entitie->toLink();
        }

        $list=array(
            '#theme' => 'item_list',
            '#items' => $montableau,
            // '#list_type' => 'ul',
        );
        $pager=array(
            '#type' => 'pager',
        );

        return array($list,$pager);
    }

}
