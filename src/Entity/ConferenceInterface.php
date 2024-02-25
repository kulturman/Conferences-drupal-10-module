<?php

namespace Drupal\conferences\Entity;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

interface ConferenceInterface extends ContentEntityInterface, EntityChangedInterface {
  function getStartDate();
  function setStartDate($startDate);
  function getEndDate();
  function setEndDate($endDate);
  function getLocation();
  function setLocation($location);
}
