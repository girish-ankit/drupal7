<div id = "nd_layout_builder">

  <div class = "row">
    <div class="col-md-12 layouts-list">
      <span class = "layouts-links">
      <?php foreach($layouts as $layout_id => $layout): ?>
        <a href = "#<?php print $layout_id;?>" class = "btn btn-sm btn-default <?php print $layout_id == 'layout-default' ? ' active' : ''; ?>"><?php print $layout['name'];?></a>
      <?php endforeach; ?>
      </span>
      <a href="#" id = "nd_layout" class = "btn btn-primary btn-xs" ><?php print t('Clone layout'); ?></a>
      <i class = "fa fa-cog fa-2x" id = "layout-settings"></i>
    </div>
  </div>

  <div class = "layouts">
  <?php foreach($layouts as $layout_id => $layout): ?>
    <div id = "<?php print $layout_id;?>" class = "layout<?php print $layout_id == 'layout-default' ? ' active' : ''; ?>">
    
    <?php foreach($layout['rows'] as $row): $row['attributes']['class'][] = 'sortable';?>
      <div <?php print drupal_attributes($row['attributes']); ?>>
        <h2 title = "<?php print $row['name']?>"><i class="fa fa-arrows"></i><span><?php print $row['name']?></span><i class = "fa fa-cog settings-row"></i></h2>

        <?php foreach($layout['regions'] as $region_key => $region): if($row['attributes']['id'] == $region['row_id']):  $region['attributes']['class'][] = 'col';?>
            <div <?php print drupal_attributes($region['attributes']); ?>>
              <h3><i class="fa fa-arrows"></i><span><?php print $region['name']; ?></span><i class = "fa fa-cog settings-col"></i></h3>
            </div>
        <?php endif; endforeach; ?>
        
      </div>
    <?php endforeach; ?>

    </div>
  <?php endforeach; ?>
  </div>

</div>

<div id = "nd_layout_bottom">
  <button id = "nd_row" class = "btn btn-primary add-element-action">Add Row</button>
  <button id = "add-block" class = "btn btn-primary add-element-action">Add Block</button>
</div>

<!-- Layout Add form -->
<div id = "layout-add" title = "Add new Layout">
  <div class="form-group">
    <input type="text" class="form-control name" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="layout_pages">Show on specific pages:</label>
    <textarea class="form-control layout-visible" name = "layout_pages" rows="5" placeholder = "Pages"></textarea>
    <div>Specify pages by using their paths. Enter one path per line. The '*' character is a wildcard. Example paths are blog for the blog page and blog/* for every personal blog. <front> is the front page.</div>
  </div>
</div>

<!-- Layout Edit form -->
<div id = "layout-settings-form" title = "Layout settings">
  <div class="form-group">
    <input type="text" class="form-control name" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="layout_pages">Show on specific pages:</label>
    <textarea class="form-control layout-visible" name = "layout_pages" rows="5" placeholder = "Pages"></textarea>
    <div>Specify pages by using their paths. Enter one path per line. The '*' character is a wildcard. Example paths are blog for the blog page and blog/* for every personal blog. <front> is the front page.</div>
  </div>
</div>

<!-- Row Add form -->
<div id = "row-add" title = "Add new Row">
<?php $row_form = '
  <input type="text" class="form-control name" placeholder="' . t('Name') . '">
  <div class = "row">
    <div class = "col-md-6 form-group">
      <label for="layout_pages">' . t('Extra Classes') . '</label>
      <input type = "text" class = "form-control input-setting" name = "class" placeholder = "Class">
    </div>
    <div class = "col-md-6">
      <label for="layout_pages">' . t('Tag Type') . '</label>
      <select class = "form-control input-setting" name = "tag">
        <option value="div">div</option>
        <option value="section">section</option>
        <option value="aside">aside</option>
        <option value="footer">footer</option>
        <option value="none">none</option>
      </select>
    </div>
  </div>
  <div class = "row">
    <div class = "col-md-6 form-group">
      <input type="checkbox" class =  "input-setting" name = "full_width"> <label for="full_width">'. t('Full Width') . '</label>
    </div>
    <div class = "col-md-6 form-group">
      <input type="checkbox" class =  "input-setting" name = "use_default"> <label for="use_default" title = "In Default Layout will be searched row with the same name and used instead of the current one.">'. t('Use row from <i>Default</i> Layout') . '</label>
    </div>
  </div>
  <div class="expandable">
    <h4 class="centered">Paddings</h4>
    <div class = "row paddings">
      <div class = "col-xs-3 form-group centered">
        <label for="padding_left">Left</label>
        <input type = "text" class = "form-control input-setting" size = 2 name = "padding_left">
      </div>
      <div class = "col-xs-3 form-group centered">
        <label for="padding_right">Right</label>
        <input type = "text" class = "form-control input-setting" size = 2 name = "padding_right">
      </div>
      <div class = "col-xs-3 form-group centered">
        <label for="padding_top">Top</label>
        <input type = "text" class = "form-control input-setting" size = 2 name = "padding_top">
      </div>
      <div class = "col-xs-3 form-group centered">
        <label for="padding_bottom">Bottom</label>
        <input type = "text" class = "form-control input-setting" size = 2 name = "padding_bottom">
      </div>
    </div>
  </div>';

  print $row_form; ?>
</div>

<!-- Row form -->
<div id = "row-settings" title = "Row Settings">
  <?php print $row_form; ?>
</div>

<!-- Row Add form -->
<div id = "add-block-form" title = "Add new Block">
  <select class = "form-control input-setting name" name = "block_id">
  <?php foreach($blocks as $block): ?>
    <option value="<?php print $block['module'] . '|' . $block['delta']; ?>" ><?php print $block['info']; ?></option>
  <?php endforeach; ?>
  </select>
</div>

<!-- Column Settings -->
<div id = "col-settings" title = "Region Settings">

  <div class="row col-settings">
    <div class="col-xs-3 centered">
      <label class="sr-only" for="col-xs"><i class = "fa fa-mobile fa-5x"></i></label>
    </div>

    <div class="col-xs-3 centered">
      <label class="sr-only" for="col-sm"><i class="fa fa-tablet fa-5x"></i></label>
    </div>

    <div class="col-xs-3 centered">
      <label class="sr-only" for="col-md"><i class = "fa fa-laptop fa-5x"></i></label>
    </div>

    <div class="col-xs-3 centered">
      <label class="sr-only" for="col-lg"><i class = "fa fa-desktop fa-5x"></i></label>
    </div>
  </div>

  <hr class = "spacer">

  <div class="">
    <h4 class="centered" title = "How many columns this region will use on different devices">Region size</h4>
    <div class="row col-settings">
      <div class="col-xs-3 centered">
        <select name = "col-xs" class = "form-control numeric-select">
        <?php $options = '
          <option value = "0">Auto</option>
          <option value = "1">1</option>
          <option value = "2">2</option>
          <option value = "3">3</option>
          <option value = "4">4</option>
          <option value = "5">5</option>
          <option value = "6">6</option>
          <option value = "7">7</option>
          <option value = "8">8</option>
          <option value = "9">9</option>
          <option value = "10">10</option>
          <option value = "11">11</option>
          <option value = "12">12</option>';
          print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-sm" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-md" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-lg" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>
    </div>
  </div>

  <hr class = "spacer">

  <div class="expandable">
    <h4 class="centered">Left Push</h4>
    <div class="row col-settings">
      <div class="col-xs-3 centered">
        <select name = "col-xs-push" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-sm-push" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-md-push" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-lg-push" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>
    </div>
  </div>

  <hr class = "spacer">

  <div class="expandable">
    <h4 class="centered">Right Pull</h4>
    <div class="row col-settings">
      <div class="col-xs-3 centered">
        <select name = "col-xs-pull" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-sm-pull" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-md-pull" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-lg-pull" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>
    </div>
  </div>
  
  <hr class = "spacer">

  <div class="expandable">
    <h4 class="centered">Left Offset</h4>
    <div class="row col-settings">
      <div class="col-xs-3 centered">
        <select name = "col-xs-offset" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-sm-offset" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-md-offset" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>

      <div class="col-xs-3 centered">
        <select name = "col-lg-offset" class = "form-control numeric-select">
          <?php print $options; ?>
        </select>
      </div>
    </div>
  </div>

  <hr class = "spacer">

  <div class="expandable">
    <h4 class="centered">Visibility options</h4>
    <div class="row vissible-settings">
      <div class = "eye-icons">
        <i class="fa fa-eye fa-lg"></i>
        <i class="fa fa-eye-slash text-danger fa-lg"></i>
      </div>

      <div class = "col-xs-3 centered form-group">
        <div class = "radio-custom">
          <input type="radio" name="showing-xs" value="visible-xs" class="form-radio">
        </div>
        <div class = "radio-custom">
          <input type="radio" name="showing-xs" value="hidden-xs" class="form-radio">
        </div>
      </div>

      <div class = "col-xs-3 centered form-group">
        <div class = "radio-custom">
          <input type="radio" name="showing-sm" value="visible-sm" class="form-radio">
        </div>
        <div class = "radio-custom">
          <input type="radio" name="showing-sm" value="hidden-sm" class="form-radio">
        </div>
      </div>

      <div class = "col-xs-3 centered form-group">
        <div class = "radio-custom">
          <input type="radio" name="showing-md" value="visible-md" class="form-radio">
        </div>
        <div class = "radio-custom">
          <input type="radio" name="showing-md" value="hidden-md" class="form-radio">
        </div>
      </div>

      <div class = "col-xs-3 centered form-group">
        <div class = "radio-custom">
          <input type="radio" name="showing-lg" value="visible-lg" class="form-radio">
        </div>
        <div class = "radio-custom">
          <input type="radio" name="showing-lg" value="hidden-lg" class="form-radio">
        </div>
      </div>
    </div>
  </div>

  <hr class = "spacer">

  <div class="expandable">
    <h4 class="centered">Paddings</h4>
    <div class = "row paddings">
      <div class = "col-xs-3 form-group centered">
        <label for="padding_left"><?php print t('Left') ?></label>
        <input type = "text" class = "form-control input-setting" size = 2 name = "padding_left">
      </div>
      <div class = "col-xs-3 form-group centered">
        <label for="padding_right"><?php print t('Right') ?></label>
        <input type = "text" class = "form-control input-setting" size = 2 name = "padding_right">
      </div>
      <div class = "col-xs-3 form-group centered">
        <label for="padding_top"><?php print t('Top') ?></label>
        <input type = "text" class = "form-control input-setting" size = 2 name = "padding_top">
      </div>
      <div class = "col-xs-3 form-group centered">
        <label for="padding_bottom"><?php print t('Bottom') ?></label>
        <input type = "text" class = "form-control input-setting" size = 2 name = "padding_bottom">
      </div>
    </div>
  </div>  

  <hr class = "spacer">

  <div class="expandable">
    <h4 class="centered">Tag options</h4>
    <div class = "row">
      <div class = "col-xs-6 form-group">
        <label for="layout_pages"><?php print t('Extra Classes') ?></label>
        <input type = "text" class = "form-control input-setting" name = "class" placeholder = "Class">
      </div>
      <div class = "col-xs-6">
        <label for="layout_pages"><?php print t('Tag Type'); ?></label>
        <select class = "form-control input-setting" name = "tag">
          <option value="div">div</option>
          <option value="section">section</option>
          <option value="aside">aside</option>
          <option value="footer">footer</option>
          <option value="none">none</option>
        </select>
      </div>
    </div>
  </div>

  <hr class = "spacer">

  <div class="expandable">
    <h4 class="centered">Animation</h4>
    <div class = "row">
      <div class = "col-xs-6 form-group">
        <label for="layout_pages"><?php print t('Animation'); ?></label>
        <select class="form-control input-setting" name = "animation">
          <option value="">None</option>
          <optgroup label="Attention Seekers">
            <option value="bounce">bounce</option>
            <option value="flash">flash</option>
            <option value="pulse">pulse</option>
            <option value="rubberBand">rubberBand</option>
            <option value="shake">shake</option>
            <option value="swing">swing</option>
            <option value="tada">tada</option>
            <option value="wobble">wobble</option>
          </optgroup>

          <optgroup label="Bouncing Entrances">
            <option value="bounceIn">bounceIn</option>
            <option value="bounceInDown">bounceInDown</option>
            <option value="bounceInLeft">bounceInLeft</option>
            <option value="bounceInRight">bounceInRight</option>
            <option value="bounceInUp">bounceInUp</option>
          </optgroup>

          <optgroup label="Bouncing Exits">
            <option value="bounceOut">bounceOut</option>
            <option value="bounceOutDown">bounceOutDown</option>
            <option value="bounceOutLeft">bounceOutLeft</option>
            <option value="bounceOutRight">bounceOutRight</option>
            <option value="bounceOutUp">bounceOutUp</option>
          </optgroup>

          <optgroup label="Fading Entrances">
            <option value="fadeIn">fadeIn</option>
            <option value="fadeInDown">fadeInDown</option>
            <option value="fadeInDownBig">fadeInDownBig</option>
            <option value="fadeInLeft">fadeInLeft</option>
            <option value="fadeInLeftBig">fadeInLeftBig</option>
            <option value="fadeInRight">fadeInRight</option>
            <option value="fadeInRightBig">fadeInRightBig</option>
            <option value="fadeInUp">fadeInUp</option>
            <option value="fadeInUpBig">fadeInUpBig</option>
          </optgroup>

          <optgroup label="Fading Exits">
            <option value="fadeOut">fadeOut</option>
            <option value="fadeOutDown">fadeOutDown</option>
            <option value="fadeOutDownBig">fadeOutDownBig</option>
            <option value="fadeOutLeft">fadeOutLeft</option>
            <option value="fadeOutLeftBig">fadeOutLeftBig</option>
            <option value="fadeOutRight">fadeOutRight</option>
            <option value="fadeOutRightBig">fadeOutRightBig</option>
            <option value="fadeOutUp">fadeOutUp</option>
            <option value="fadeOutUpBig">fadeOutUpBig</option>
          </optgroup>

          <optgroup label="Flippers">
            <option value="flip">flip</option>
            <option value="flipInX">flipInX</option>
            <option value="flipInY">flipInY</option>
            <option value="flipOutX">flipOutX</option>
            <option value="flipOutY">flipOutY</option>
          </optgroup>

          <optgroup label="Lightspeed">
            <option value="lightSpeedIn">lightSpeedIn</option>
            <option value="lightSpeedOut">lightSpeedOut</option>
          </optgroup>

          <optgroup label="Rotating Entrances">
            <option value="rotateIn">rotateIn</option>
            <option value="rotateInDownLeft">rotateInDownLeft</option>
            <option value="rotateInDownRight">rotateInDownRight</option>
            <option value="rotateInUpLeft">rotateInUpLeft</option>
            <option value="rotateInUpRight">rotateInUpRight</option>
          </optgroup>

          <optgroup label="Rotating Exits">
            <option value="rotateOut">rotateOut</option>
            <option value="rotateOutDownLeft">rotateOutDownLeft</option>
            <option value="rotateOutDownRight">rotateOutDownRight</option>
            <option value="rotateOutUpLeft">rotateOutUpLeft</option>
            <option value="rotateOutUpRight">rotateOutUpRight</option>
          </optgroup>

          <optgroup label="Sliders">
            <option value="slideInDown">slideInDown</option>
            <option value="slideInLeft">slideInLeft</option>
            <option value="slideInRight">slideInRight</option>
            <option value="slideOutLeft">slideOutLeft</option>
            <option value="slideOutRight">slideOutRight</option>
            <option value="slideOutUp">slideOutUp</option>
          </optgroup>

          <optgroup label="Specials">
            <option value="hinge">hinge</option>
            <option value="rollIn">rollIn</option>
            <option value="rollOut">rollOut</option>
          </optgroup>
        </select>
      </div>
      <div class = "col-xs-6">
        <label for="layout_pages">Animation Delay in ms</label>
        <input type = "text" class = "form-control input-setting" placeholder="Delay" name = "delay">
      </div>
    </div>
  </div>

  <hr class = "spacer">

  <div class="expandable">
    <h4 class="centered">Prefix &amp; Suffix</h4>
    <div class = "row prefix_suffix">
      <div class = "col-md-12 form-group">
        <label for="prefix"><?php print t('Prefix') ?></label>
        <textarea type = "text" class = "form-control input-setting" rows = "2" name = "prefix"></textarea>
      </div>
      <div class = "col-md-12 form-group">
        <label for="suffix"><?php print t('Suffix') ?></label>
        <textarea type = "text" class = "form-control input-setting" rows = "2" name = "suffix"></textarea>
      </div>
    </div>
  </div>

</div>