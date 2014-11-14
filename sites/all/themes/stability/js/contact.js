jQuery(function($){
  $('#map_canvas').gmap3({
    marker:{
      address: Drupal.settings.enjoyit_flat_theme.gmap_lat + ',' + Drupal.settings.enjoyit_flat_theme.gmap_lng
    },
      map:{
        options:{
          zoom: parseInt(Drupal.settings.enjoyit_flat_theme.gmap_zoom),
          scrollwheel: false,
          streetViewControl : true
        }
      }
    });
});