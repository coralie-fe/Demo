<?php

namespace Drupal\hello\Access;

use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;


class HelloAccessCheck implements AccessCheckInterface {

    // implements signifie qu'il faut utiliser certaines function obligatoire
    // commme la function applies
    public function applies(Route $route)
    {
        // TODO: Implement applies() method.
        return NULL;
    }

    public function access(Route  $route, Request $request = NULL, AccountInterface $account){

        //kint($account);

        $param = $route->getRequirement('_access_hello');

        //transform en seconde
        $param = $param * 3600;
        //kint($param);
        $date_now = time();

        // c deja en secondes
        $account_creation= $account->getAccount()->created;

        if (! \Drupal::currentUser()->isAnonymous()) {
            if($account_creation < $date_now - $param){
                return AccessResult::allowed();
            }
        }



        return AccessResult::forbidden();

    }
}