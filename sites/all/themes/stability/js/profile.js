jQuery(function($){
  $(document).ready(function() {
    $('.bbp-user-navigation li a').click(function() {
      $('.bbp-user-navigation li.current').removeClass('current');
      $(this).parent().addClass('current');
      $this = $(this);
      $('.tab.active').hide(300, function() {
        $(this).removeClass('active');
        $($this.attr('href')).show(300).addClass('active');
      });
      return false;
    });
  });
});