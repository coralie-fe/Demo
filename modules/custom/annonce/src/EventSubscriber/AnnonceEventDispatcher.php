<?php

namespace Drupal\annonce\EventSubscriber;

use Drupal\Core\Database\Connection;
use Drupal\Core\Routing\CurrentRouteMatch;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Session\AccountProxy;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class AnnonceEventDispatcher.
 *
 * @package Drupal\annonce
 */
class AnnonceEventDispatcher implements EventSubscriberInterface {

  /**
   * Drupal\Core\Session\AccountProxy definition.
   *
   * @var Drupal\Core\Session\AccountProxy
   */
    protected $current_user;
    protected $current_route_match;
    protected $database;

  /**
   * Constructor.
   */
  //service AccountProxy (pour le suser) et CurrentRouteMatch pour la current route
  public function __construct(AccountProxy $current_user, CurrentRouteMatch $current_route_match, Connection $database){
      $this->current_user= $current_user;
      $this->current_route_match= $current_route_match;
      $this->database = $database;
  }

  public function DisplayUserName(){

      $name = $this->current_user->getAccountName();

      if($this->current_route_match->getRouteName() == "entity.annonce.canonical"){
          drupal_set_message("Event for $name");
      }

      if($this->current_route_match->getRouteName() == "entity.annonce.canonical"){
          $this->database->insert("annonce_history")
              ->fields(
                  array(
                      'aid' => $this->current_route_match->getRawParameter("annonce"),
                      'uid' => $this->current_user->id(),
                      'update_time' => time(),
                  )
              )
            ->execute();

      }

  }
  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {

      // qd evenement REQUEST se produit alors la methode DisplayUserName est appelée
      $events[KernelEvents::REQUEST][] = array('DisplayUserName');
      return $events;


  }


}
