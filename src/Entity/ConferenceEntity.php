<?php

namespace Drupal\conferences\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Conference entity.
 *
 * @ContentEntityType(
 *   id = "conference",
 *   label = @Translation("Conference"),
 *   label_singular = @Translation("conference"),
 *   label_plural = @Translation("conferences"),
 *   label_count = @PluralTranslation(
 *      singular = "@count conference",
 *      plural = "@count conferences",
 *   ),
 *   base_table = "conferences",
 *   admin_permission="administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *   },
 *   fieldable = TRUE,
 *   links = {
 *      "canonical" = "/admin/structure/conference/{conference}",
 *      "add-form" = "/admin/structure/conference/add",
 *      "edit-form" = "/admin/structure/conference/{conference}/edit",
 *      "delete-form" = "/admin/structure/conference/{conference}/delete",
 *      "collection" = "/admin/structure/conference",
 *   },
 *   handlers={
 *      "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *      "list_builder" = "Drupal\conferences\Builder\ConferenceListBuilder",
 *      "form" = {
 *        "default" = "Drupal\conferences\Form\ConferenceForm",
 *        "add" = "Drupal\conferences\Form\ConferenceForm",
 *        "edit" = "Drupal\conferences\Form\ConferenceForm",
 *        "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *        "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *  }
 * )
 */
class ConferenceEntity extends ContentEntityBase  implements ConferenceInterface {
  use EntityChangedTrait;

  public static function baseFieldDefinitions(EntityTypeInterface $entityType) {
    $fields = parent::baseFieldDefinitions($entityType);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the conference.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ]);

    $fields['start_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Start Date'))
      ->setDescription(t('The start date of the conference.'))
      ->setSetting('datetime_type', 'date')
      ->setSetting('datetime_format', 'Y-m-d')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'datetime_default',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => 0,
      ]);

    $fields['end_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('End Date'))
      ->setDescription(t('The end date of the conference.'))
      ->setSetting('datetime_type', 'date')
      ->setSetting('datetime_format', 'Y-m-d')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'datetime_default',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => 0,
      ]);

    $fields['location'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Location'))
      ->setDescription(t('The location of the conference.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ]);
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the conference was created.'))
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'timestamp',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 0,
      ]);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the conference was last updated.'))
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'timestamp',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 0,
      ]);
    return $fields;
  }

  function getStartDate() {
    return $this->get('start_date')->value;
  }

  function setStartDate($startDate) {
    $this->set('start_date', $startDate);
    return $this;
  }

  function getEndDate() {
    return $this->get('end_date')->value;
  }

  function setEndDate($endDate) {
    $this->set('end_date', $endDate);
    return $this;
  }

  function getLocation() {
    return $this->get('location')->value;
  }

  function setLocation($location) {
    $this->set('location', $location);
    return $this;
  }

}
