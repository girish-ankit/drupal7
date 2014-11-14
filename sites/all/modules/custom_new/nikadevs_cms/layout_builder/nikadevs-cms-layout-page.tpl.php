<?php foreach($layout['rows'] as $id => $row):
  $tag = isset($row['settings']['tag']) && $row['settings']['tag'] != 'none' ? $row['settings']['tag'] : ''; ?>
 
  <?php if($tag): ?>
    <<?php print $tag;?> <?php print drupal_attributes($row['wrap']['attributes']); ?>>
  <?php endif; ?>

    <?php if(!isset($row['settings']['full_width']) || !$row['settings']['full_width']): ?>
      <div class = "container">
    <?php endif; ?>

      <div <?php print drupal_attributes($row['attributes']); ?>>     
      
        <?php foreach($layout['regions'] as $region_key => $region):?>

          <?php print isset($region['settings']['prefix']) ? $region['settings']['prefix'] : ''; ?>

          <?php if(!isset($messages_printed) && (($id == $region['row_id'] && isset($vars['page'][$region_key]['system_main'])) || (stripos($row['name'], 'content') !== FALSE))): ?>
            <div class = "col-md-12">
              <?php print $vars['messages']; ?>
              <?php print render($vars['tabs']); $messages_printed = 1; ?>
            </div>
          <?php endif; ?>

          <?php if($id == $region['row_id'] && !empty($region['content'])):?>
            <?php if($region['settings']['tag']): ?>
              <<?php print $region['settings']['tag']; ?> <?php print drupal_attributes($region['attributes']); ?>>
            <?php endif; ?>
              <?php print $region['content']; ?>
            <?php if($region['settings']['tag']): ?>
              </<?php print $region['settings']['tag']; ?>>
            <?php endif; ?>
          <?php endif; ?>
          
          <?php print isset($region['settings']['suffix']) ? $region['settings']['suffix'] : ''; ?>
        
        <?php endforeach; ?>

      </div>

    <?php if(!isset($row['settings']['full_width']) || !$row['settings']['full_width']): ?>
      </div>
    <?php endif; ?>

  <?php if($tag): ?>
    </<?php print $tag;?>>
  <?php endif; ?>

<?php endforeach; ?>