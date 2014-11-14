<div class="contacts-widget widget widget__footer">
	<div class="widget-content">
		<ul class="contacts-info-list">
      <?php if(theme_get_setting('address')): ?>
			<li>
				<i class="fa fa-map-marker"></i>
				<div class="info-item">
					<?php print nl2br(theme_get_setting('address')); ?>
				</div>
			</li>
      <?php endif?>
      <?php if(theme_get_setting('phones')): ?>
			<li>
				<i class="fa fa-phone"></i>
				<div class="info-item">
					<?php print nl2br(theme_get_setting('phones')); ?>
				</div>
			</li>
      <?php endif?>
      <?php if(theme_get_setting('email')): ?>
			<li>
				<i class="fa fa-envelope"></i>
				<span class="info-item">
					<a href="mailto:<?php print theme_get_setting('email'); ?>"><?php print theme_get_setting('email'); ?></a>
				</span>
			</li>
      <?php endif?>
			<?php if(!$short): ?>
        <?php if(theme_get_setting('skype')): ?>
  			<li>
  				<i class="fa fa-skype"></i>
  				<div class="info-item">
  					<?php foreach(explode("\n", theme_get_setting('skype')) as $skype): ?>
  						<a href="skype:<?php print $skype; ?>"><?php print $skype; ?></a><br>
  					<?php endforeach; ?>
  				</div>
  			</li>
        <?php endif?>
        <?php if(theme_get_setting('working_time')): ?>
  			<li>
  				<i class="fa fa-clock-o"></i>
  				<div class="info-item">
  					<?php print nl2br(theme_get_setting('working_time')); ?>
  				</div>
  			</li>
        <?php endif?>
			<?php endif;?>
		</ul>
	</div>
</div>