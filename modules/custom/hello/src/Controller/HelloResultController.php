<?php
/**
 * @file
 * Contains \Drupal\hello\Controller\HelloCalculatorController.
 */

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;


class HelloResultController extends ControllerBase{

    // traite la soumission du formulaire calculator
    public function content()
    {

            //           kint($data_operation);
            //           kint($_GET);

            switch ($_GET['operator']){
                case 0: $operator = '+';
                    break;
                case 1: $operator = '-';
                    break;
                case 2: $operator = '*';
                    break;
                case 3: $operator = '/';
                    break;
                default: $result = 'Error .... :\'( ';
            }

            $Render_result=array(
                '#theme' => 'table',
                '#class' => 'class_blabla',
                '#caption' => 'My operation :',
                '#header' => array('First value','Operator','Second value','Result'),
                '#rows' => array( array($_GET['first_value'],
                    $operator,
                    $_GET['second_value'],
                    $_GET['result']),
                ));



        return $Render_result;
    }
}