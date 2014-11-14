(function($) {

    $(document).ready(function() {

        $('#custom-data-views-form select').change(function() {
            var termId = $(this).val();
            var targetLocation = ''
            targetLocation = "'" + window.location + "'";
            targetLocationArr = targetLocation.split("?");
            targetLocation = targetLocationArr[0].replace(/'/g, "");
                        
            if (termId && termId != "0") {
                targetLocation = targetLocation + '?cat_id=' + termId;
             //   console.log(targetLocation);
            } else
            {
                targetLocation = targetLocation;
              //  console.log('else ' + targetLocation);
            }
            //  alert(targetLocation);
             window.location.replace(targetLocation);
        });
    });

}(jQuery));