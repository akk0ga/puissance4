$( ":checkbox" )
  .change(function() {
    var $input = "disabled";
    $(":checkbox").not(this).attr("disabled");
  })
