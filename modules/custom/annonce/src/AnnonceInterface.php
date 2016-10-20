<?php

namespace Drupal\annonce;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a Annonce entity.
 *
 * @ingroup annonce
 */
// declaration de l'interface
interface AnnonceInterface extends ContentEntityInterface, EntityOwnerInterface {
}
