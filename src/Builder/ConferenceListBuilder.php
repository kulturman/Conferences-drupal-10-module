<?php

namespace Drupal\conferences\Builder;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class ConferenceListBuilder extends EntityListBuilder {
  public function buildHeader() {
    $header['id'] = $this->t('Conference ID');
    $header['name'] = $this->t('Name');
    $header['start_date'] = $this->t('Start Date');
    $header['end_date'] = $this->t('End Date');
    $header['location'] = $this->t('Location');

    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\conferences\Entity\ConferenceEntity $entity */
    $row['id'] = $entity->id();
    $row['name'] = $entity->label();
    $row['start_date'] = $entity->getStartDate();
    $row['end_date'] = $entity->getEndDate();
    $row['location'] = $entity->getLocation();

    return $row + parent::buildRow($entity);
  }
}
