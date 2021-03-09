<?php

namespace Drupal\FullEntityData\EventSubscriber;

use Drupal\elasticsearch_connector\Event\PrepareMappingEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ElasticsearchFullEntityData.
 */
class ElasticsearchFullEntityData implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      PrepareMappingEvent::PREPARE_MAPPING => ['alterMappingConfig', 100]
    ];
  }
  
  /**
   * Altering mapping config of field by selected mapping type.
   *
   * @param \Drupal\elasticsearch_connector\Event\PrepareMappingEvent $event
   */
  public function alterMappingConfig(PrepareMappingEvent $event) {
    $type = $event->getMappingType();
    
    if ($type == 'full_entity_data') {
      $mappingConfig = [
        'type' => 'text',
      ];
      
      $event->setMappingConfig($mappingConfig);
    }
  }
  
}
