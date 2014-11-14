jQuery(function($){

  $(document).ready(function() {

    var active_layout = $('.layouts .active').attr('id');

    function update_layout(op) {
      // Going throught active layout to save all settings
      $this = $('.layout.active');
      var settings = Drupal.settings.nikadevs_cms.layouts[$this.attr('id')];
      var layout = {'name' : $('a[href="#' + $this.attr('id') + '"]').text(), 'pages' : settings['pages'], 'rows': {}, 'regions' : {}};

      // Save rows settings
      $this.find('.row').each(function() {
        var id = $(this).attr('id');
        layout['rows'][$(this).attr('id')] = {
          'name' : $(this).find('h2 span').text(),
          'attributes' : attributes($(this)),
          'settings': typeof(settings['rows'][id]['settings']) != 'undefined' ? settings['rows'][id]['settings'] : {}
        };
      });

      // Save regions settings
      $this.find('.col').each(function() {
        if($(this).parent('.row').attr('id') != 'id-0') {
          var id = $(this).attr('id');
          layout['regions'][id] = {
            'row_id' : $(this).parent('.row').attr('id'),
            'name' : $(this).find('h3').text(),
            'attributes' : attributes($(this)),
            'settings': typeof(settings['regions'][id]['settings']) != 'undefined' ? settings['regions'][id]['settings'] : {}
          };
        }
      });

      //console.log(layout);
      //return; 


      // Send settings to server for saving
      $('#layout-settings').addClass('fa-spin');
      $.post(Drupal.settings.basePath + 'nikadevs_cms/layout_builder/update', {'layout' : layout, 'id' : $this.attr('id'), 'op' : op}, function() {
        $('#layout-settings').removeClass('fa-spin').after('<span class = "saving-info btn btn-xs btn-success">Saved.</span>');
        setTimeout(function() {
          $('.saving-info').animate({opacity: 0}, 500, function() {
            $(this).remove();
          });
        }, 1000);
      });
    }

    function attributes($this) {
      // Collect all attributes and remove not required
      var attrs = {};
      $.each($this[0].attributes, function() {
        if(!this.specified || this.name == 'style') {
          return;
        }
        attr = this.value;
        if(this.name == 'class') {
          if($.trim(attr)) {
            classes = $.trim(attr).split(' ');
            add_class = {};
            for(i in classes) {
              if(classes[i] != 'col' && classes[i] != 'sortable' && classes[i] != 'ui-sortable' && classes[i] != 'settings-open') {
                add_class[i] = classes[i]
              }
            }
          }
          attrs[this.name] = add_class;
        }
        else {
          attrs[this.name] = $.trim(attr);
        }
      });
      return attrs;
    }

    function attach_handlers() {
      $('.layout').sortable({
        handle: 'h2',
        cursor: 'move',
        opacity: 0.4,
        stop: function (event, ui) {
          update_layout();
        }
      });

      $('.sortable').sortable({
        connectWith: '.row',
        items: ".col",
        cursor: 'move',
        opacity: 0.4,
        stop: function (event, ui) {
          update_layout();
        }
      });

      // Row settings form
      $('.settings-row').click(row_settings_form);

      // Switch between layouts
      $('.layouts-links a').click(layout_switch);

      // Col Settings Form
      $('.settings-col').click(col_settings_form);
    }

    function layout_switch() {
      $('.layouts-links a, .layout').removeClass('active');
      $(this).addClass('active');
      $($(this).attr('href')).addClass('active');
      // Update global active layout
      active_layout = $('.layouts .active').attr('id');
      return false;
    }

    $("#col-settings").dialog({
      autoOpen: false,
      width: 700,
      modal: true,
      buttons: {
        "Save": function() {
          col_settings_save();
          $('.col').removeClass('settings-open');
          update_layout();
          $(this).dialog( "close" );
        },
        Cancel: function() {
          $('.col').removeClass('settings-open');
          $(this).dialog( "close" );
        }
      },
    });

    function col_settings_form($col) {
      $col = $(this).parents('.col');
      // Set default option to AUTO
      $('.col-settings select').val(0);
      $('.vissible-settings input').attr('checked', false);
      var classes = $col.attr('class').split(' ');
      var col_class = '';
      var old_classes = {};
      // Setup form values and save current classes
      for(i in classes) {
        col_class = classes[i].split('-');
        if(col_class[0] == 'col' && typeof(col_class[3]) != 'undefined') {
          $('select[name="col-' + col_class[1] + '-' + col_class[2] + '"]').val(col_class[3]);
          old_classes[classes[i]] = classes[i];
        }
        else if(col_class[0] == 'col' && typeof(col_class[1]) != 'undefined') {
          $('select[name="col-' + col_class[1] + '"]').val(col_class[2]);
          old_classes[classes[i]] = classes[i];
        }
        if((col_class[0] == 'visible' || col_class[0] == 'hidden') && typeof(col_class[1]) != 'undefined') {
          $('input[name="showing-' + col_class[1] + '"]').filter('[value="' + classes[i] + '"]').attr('checked', true);
          old_classes[classes[i]] = classes[i];   
        }
      }

      // Load settings from stored arrays
      var id = $col.attr('id');
      $('#col-settings .input-setting').val('');
      for(setting in Drupal.settings.nikadevs_cms.layouts[active_layout]['regions'][id]['settings']) {
        // Exception for the checkboxes
        if($('#col-settings [name="' + setting + '"]').attr('type') == 'checkbox') {
          $('#col-settings [name="' + setting + '"]').attr('checked', parseInt(Drupal.settings.nikadevs_cms.layouts[active_layout]['regions'][id]['settings'][setting]));
        }
        else {
          $('#col-settings [name="' + setting + '"]').val(Drupal.settings.nikadevs_cms.layouts[active_layout]['regions'][id]['settings'][setting]);
        }
      }
      $('.col').removeClass('settings-open');
      $col.addClass('settings-open').data('old_classes', old_classes);
      // Open dialog form
      $("#col-settings").dialog( "open" );
    }

    function col_settings_save() {
      // Remove old classes
      var old_classes = $('.settings-open').data('old_classes');
      //console.log(old_classes);
      for(old_class in old_classes) {
        $('.settings-open').removeClass(old_class);
      }
      // Setting up new row classes
      $('.col-settings select').each(function() {
        if ($(this).val() > 0) {
          $('.settings-open').addClass($(this).attr('name') + '-' + $(this).val());
        }
        else {
          var prefix = $(this).attr('name');
          var classes =  $('.settings-open').attr("class").split(" ").filter(function(c) {
            return c.lastIndexOf(prefix, 0) !== 0;
          });
          $('.settings-open').attr("class", classes.join(" "));
        }
      });
      var id = $('.settings-open').attr('id');
      // Save settings from Form to variables
      if(typeof(Drupal.settings.nikadevs_cms.layouts[active_layout]['regions'][id]['settings']) != 'object') {
        Drupal.settings.nikadevs_cms.layouts[active_layout]['regions'][id]['settings'] = {};
      }
      $('#col-settings .input-setting').each(function() {
        var value = $(this).attr('type') == 'checkbox' ? ($(this).attr('checked') ? 1 : 0) : $(this).val();
        if(value) {
          Drupal.settings.nikadevs_cms.layouts[active_layout]['regions'][id]['settings'][$(this).attr('name')] = value;
        }
        else if(typeof(Drupal.settings.nikadevs_cms.layouts[active_layout]['regions'][id]['settings'][$(this).attr('name')]) != undefined) {
          delete Drupal.settings.nikadevs_cms.layouts[active_layout]['regions'][id]['settings'][$(this).attr('name')];
        }
      });
      
      // Setup new visibility classes
      $('.vissible-settings input:checked').each(function() {
        $('.settings-open').addClass($(this).val());
      });

    }

    function layout_settings() {
      // Load current layout settings
      $('#layout-settings-form .name').val($('.layouts-links a.active').text());
      var pages = Drupal.settings.nikadevs_cms.layouts[active_layout]['pages'];
      $('#layout-settings-form .layout-visible').val(pages);
      $("#layout-settings-form").dialog( "open" );
      return false;
    }

    attach_handlers();

    // Add new Layout
    $('#nd_layout').click(function() {
      $("#layout-add").dialog( "open" );
      return false;
    });

    $("#layout-add").dialog({
      autoOpen: false,
      width: 700,
      modal: true,
      buttons: {
        "Add": function() {
          if($('#layout-add .name').val() != '') {
            var prev_active = active_layout;
            active_layout = 'layout-' + $('#layout-add .name').val().replace(/[^\w\s]/gi, '').replace(' ', '-').toLowerCase();
            Drupal.settings.nikadevs_cms.layouts[active_layout] = jQuery.extend(true, {}, Drupal.settings.nikadevs_cms.layouts[prev_active]);
            Drupal.settings.nikadevs_cms.layouts[active_layout]['pages'] = $('#layout-add .layout-visible').val();
            $('.layouts-links a, .layout').removeClass('active');
            $('.layouts-links').append('<a href = "#' + active_layout + '" class = "btn btn-default btn-sm active">' + $('#layout-add .name').val() + '</a>');
            var clone_layout = '<div id = "' + active_layout + '" class = "layout active">' + $('#' + prev_active).html() + '</div>';
            $('#layout-default').removeClass('active');
            $('.layouts').append(clone_layout);
            attach_handlers();
            update_layout();
            $(this).dialog( "close" );
          }
        },
        Cancel: function() {
          $(this).dialog( "close" );
        }
      },
    });

    // Layout Settings
    $('#layout-settings').click(layout_settings);

    $("#layout-settings-form").dialog({
      autoOpen: false,
      width: 700,
      modal: true,
      buttons: {
        "Save": function() {
          if($('#layout-settings-form .name').val() != '') {
            $('.layouts-links a.active').text($('#layout-settings-form .name').val());
            Drupal.settings.nikadevs_cms.layouts[active_layout]['pages'] = $('#layout-settings-form .layout-visible').val();
            update_layout();
            $(this).dialog( "close" );
          }
        },
        "Delete": function() {
          if (active_layout != 'layout-default') {
            update_layout('delete');
            $('.layouts-links a.active, #' + active_layout).remove();
            $('.layouts-links a:last').click();
          }
          $(this).dialog( "close" );
        },
        Cancel: function() {
          $(this).dialog( "close" );
        }
      },
    });

    // Add new Row
    $('#nd_row').click(function() {
      $("#row-add .input-setting, #row-add input").val('').attr('checked', false);
      $("#row-add").dialog( "open" );
      return false;
    });

    $("#row-add").dialog({
      autoOpen: false,
      width: 700,
      modal: true,
      buttons: {
        "Add": function() {
          add_row($(this));
        },
        Cancel: function() {
          $(this).dialog( "close" );
        }
      },
    });

    function add_row($this) {
      var new_id = 0, id;
      $('.layout.active .row').each(function() {
        id = parseInt($(this).attr('id').replace('id-', ''));
        new_id = id > new_id ? id : new_id;
      });
      new_id = 'id-' + (parseInt(new_id) + 1);
      $('.layout.active').append('<div id = "' + new_id + '" class = "row sortable"><h2><i class="fa fa-arrows"></i><span>' + $this.find('.name').val() + '</span><i class="fa fa-cog settings-row"></i></h2></div>');
      Drupal.settings.nikadevs_cms.layouts[active_layout]['rows'][new_id] = {'settings': {}}
      // Save settings from Form to variables
      $('#row-add .input-setting').each(function() {
        Drupal.settings.nikadevs_cms.layouts[active_layout]['rows'][new_id]['settings'][$(this).attr('name')] = $(this).attr('type') == 'checkbox' ? ($(this).attr('checked') ? 1 : 0) : $(this).val();
      });
      attach_handlers();
      update_layout();
      $this.dialog( "close" );
    }

    // Add new Block
    $('#add-block').click(function() {
      $("#add-block-form .input-setting").val('').attr('checked', false);
      $("#add-block-form").dialog( "open" );
      return false;
    });

    $("#add-block-form").dialog({
      autoOpen: false,
      width: 700,
      modal: true,
      buttons: {
        "Add": function() {
          add_block($(this));
        },
        Cancel: function() {
          $(this).dialog( "close" );
        }
      },
    });


    function get_unique_id(id, context) {
      var i = 0;
      id = id.replace('|', '-');
      var saved_id = id;
      while($('#' + id, context).length > 0) {
        id = saved_id + '-' + (i++);
      }
      return id;
    }

    function add_block($this) {
      var id = get_unique_id($this.find('.name').val(), $('.layout.active'));
      $('.layout.active #id-0').append('<div class = "col col-md-12" id = "' + id + '"><h3><i class="fa fa-arrows"></i><span>' + $this.find('.name').find(':selected').text() + '</span><i class="fa fa-cog settings-col"></i></h3></div>');
      Drupal.settings.nikadevs_cms.layouts[active_layout]['regions'][id] = {'settings': {}}
      // Save settings from Form to variables
      $this.find('.input-setting').each(function() {
        Drupal.settings.nikadevs_cms.layouts[active_layout]['regions'][id]['settings'][$(this).attr('name')] = $(this).attr('type') == 'checkbox' ? ($(this).attr('checked') ? 1 : 0) : $(this).val();
      });
      attach_handlers();
      update_layout();
      $this.dialog( "close" );
    }

    function row_settings_form() {
      // Show which row is setting up now
      $(this).parents('.row').addClass('row-setting-open');
      // Clear form input
      $('#row-settings select, #row-settings input').val('').attr('checked', false);
      // Set row option on the form
      $('#row-settings .name').val($(this).parent().find('span').text());
      // Load settings to the Form
      var active_row = $(this).parents('.row').attr('id');
      for(setting in Drupal.settings.nikadevs_cms.layouts[active_layout]['rows'][active_row]['settings']) {
        // Exception for the checkboxes
        if($('#row-settings [name="' + setting + '"]').attr('type') == 'checkbox') {
          $('#row-settings [name="' + setting + '"]').attr('checked', parseInt(Drupal.settings.nikadevs_cms.layouts[active_layout]['rows'][active_row]['settings'][setting]));
        }
        else {
          $('#row-settings [name="' + setting + '"]').val(Drupal.settings.nikadevs_cms.layouts[active_layout]['rows'][active_row]['settings'][setting]);
        }
      }
      $("#row-settings").dialog( "open" );
      return false;
    }

    $("#row-settings").dialog({
      autoOpen: false,
      width: 700,
      modal: true,
      buttons: {
        "Save": function() {
          Drupal.settings.nikadevs_cms.layouts[active_layout]['rows'][$('.row-setting-open').attr('id')] = {'settings': {}}
          // Save settings from Form to variable
          $('#row-settings .input-setting').each(function() {
            var value = $(this).attr('type') == 'checkbox' ? ($(this).attr('checked') ? 1 : 0) : $(this).val();
            if(value) {
              Drupal.settings.nikadevs_cms.layouts[active_layout]['rows'][$('.row-setting-open').attr('id')]['settings'][$(this).attr('name')] = value;
            }
          });
          //console.log(Drupal.settings.nikadevs_cms.layouts[active_layout]['rows'][$('.row-setting-open').attr('id')]);
          $('.row-setting-open h2 span').text($('#row-settings .name').val());
          // Settings are done
          $('.row-setting-open').removeClass('row-setting-open');
          update_layout();
          $(this).dialog( "close" );
        },
        "Delete": function() {
          $('.row-setting-open h2').remove();
          var regions = $('#' + active_layout + ' .row-setting-open').html();
          $('#' + active_layout + ' #id-0').append(regions);
          $('.row-setting-open').remove();
          update_layout();
          attach_handlers();
          $(this).dialog( "close" );
        },
        Cancel: function() {
          $('.row-setting-open').removeClass('row-setting-open');
          $(this).dialog( "close" );
        }
      },
    });

    $('.expandable h4').click(function() {
      $(this).parent().toggleClass('expanded');
    });

  }); // end doc ready 

}); // end no conflict
