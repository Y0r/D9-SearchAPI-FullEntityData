<?php

namespace Drupal\FullEntityDataType\Plugin\search_api\data_type;

use Drupal\node\NodeInterface;
use Drupal\search_api\DataType\DataTypePluginBase;

/**
 * Provides an integer data type.
 *
 * @SearchApiDataType(
 * id = "full_entity_data",
 * label = @Translation("Full Entity Data"),
 * description = @Translation("Contains all values from Node Entity."),
 * default = "false"
 * )
 */
class FullEntityDataType extends DataTypePluginBase {

  /**
   * {@inheritdoc}
   */
  public function getValue($value) {
    $data = '';
    
    $serializer = \Drupal::service('serializer');
    $entity_type_manager = \Drupal::entityTypeManager();
    
    /** @var NodeInterface $node */
    $node = $entity_type_manager
      ->getStorage('node')
      ->load($value);
    
    if (!empty($node) && $node instanceof NodeInterface) {
      $data = $serializer
        ->serialize($node, 'json', ['plugin_id' => 'entity']);
    }
    
    return (string) $data;
  }

}
