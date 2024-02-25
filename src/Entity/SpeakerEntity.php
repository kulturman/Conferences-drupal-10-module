<?php

namespace Drupal\conferences\Entity;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\ContentEntityBase;

/**
 * Defines the Speaker entity.
 *
 * @ingroup your_module
 *
 * @ContentEntityType(
 *   id = "speaker",
 *   label = @Translation("Speaker"),
 *   label_singular = @Translation("speaker"),
 *   label_plural = @Translation("speakers"),
 *   label_count = @PluralTranslation(
 *      singular = "@count speaker",
 *      plural = "@count speakers"
 *   ),
 *   base_table = "speaker",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *   },
 *   fieldable = TRUE,
 *   links = {
 *     "canonical" = "/speaker/{speaker}",
 *   },
 * )
 */
class SpeakerEntity extends ContentEntityBase implements SpeakerInterface {

  use EntityChangedTrait;

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // User reference field, assuming each speaker is linked to a Drupal user.
    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Drupal User'))
      ->setDescription(t('The user ID of the Drupal user.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setRequired(TRUE);

    // Fullname field.
    $fields['fullname'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Full name'))
      ->setDescription(t('The full name of the speaker.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setRequired(TRUE);

    // Skills field.
    $fields['skills'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Skills'))
      ->setDescription(t('The skills of the speaker, comma-separated.'))
      ->setSettings([
        'default_value' => '',
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'basic_string',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textarea',
        'weight' => -3,
      ]);

    // Photo field.
    $fields['photo'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Photo'))
      ->setDescription(t('The speaker\'s photo.'))
      ->setSettings([
        'file_directory' => 'speaker_photos',
        'alt_field_required' => FALSE,
        'file_extensions' => 'png jpg jpeg',
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'image',
        'weight' => -2,
      ])
      ->setDisplayOptions('form', [
        'type' => 'image_image',
        'weight' => -2,
      ]);

    return $fields;
  }
}
