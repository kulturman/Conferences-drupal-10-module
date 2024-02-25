<?php
namespace Drupal\conferences\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ConferenceController extends ControllerBase {

  /**
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function index() {
    $query = $this->entityTypeManager()->getStorage('conference')->getQuery();
    $query->accessCheck()->pager(10);
    $ids = $query->execute();

    $conferences = $this->entityTypeManager()->getStorage('conference')->loadMultiple($ids);

    return [
      'conferences' => [
        '#theme' => 'conferences_conference_list',
        '#conferences' => $conferences,
      ],
      'pagination' => [
        '#type' => 'pager',
      ],
    ];
  }

}
