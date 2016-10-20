<?php

namespace Drupal\annonce\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the Annonce entity type.
 */
class AnnonceViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();
    $data['annonce_history']['table']['group']= t('annonce history');

    $data['annonce_history']['table']['base'] = array(
      'field' => 'hid',
      'title' => t('Annonce history'),
      'help' => t('The annonce entity ID.'),
    );

      $data['annonce_history']['aid'] = array(
          'title' =>t('ID Annonce'),
          'help' => t('the id of annonce'),
          'field' => array(
              'id'=>'numeric'
          ),
          'filter' => array(
              'id'=>'string'
          ),
          'sort' => array(
              'id'=>'standard'
          ),
      );
      $data['annonce_history']['uid'] = array(
          'title' =>t('UID User'),
          'help' => t('the uid of user'),
          'field' => array(
              'id'=>'numeric'
          ),
          'relationship' => array(
              // Views name of the table to join to for the relationship.
              'base' => 'users_field_data',
              // Database field name in the other table to join on.
              'base field' => 'uid',
              // ID of relationship handler plugin to use.
              'id' => 'standard',
              // Default label for relationship in the UI.
              'label' => t('user relation'),
          ),
      );
      $data['annonce_history']['update_time'] = array(
          'title' =>t('Upadte time'),
          'help' => t('the update_time'),
          'field' => array(
              'id'=>'date'
          ),

      );


      $data['annonce_history']['table']['join'] = array(
          'users_field_data' => array(
              // Primary key field in node_field_data to use in the join.
              'left_field' => 'uid',
              // Foreign key field in example_table to use in the join.
              'field' => 'uid',
              // 'extra' is an array of additional conditions on the join.

          ),
      );

    return $data;
  }

}
