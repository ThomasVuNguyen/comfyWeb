$(document).ready(function() {
    $(".footer").load
    ("footer.html");
    $(".navbar").load
    ("navdoc.html");

      $('#PageSelect').change(function(){
        // Get the selected option's value
        var selectedValue = $(this).val();
    
        switch(selectedValue.toString()){
          case "GetStarted":
            window.location.href = "/doc/#Getstarted"
              break;
              case "WhatsASpace":
                window.location.href = "/doc/#Space"
                break;
                case "AddAButton":
                    window.location.href = "/doc/#Button"
        }
      });

      $(function() {
        console.log('false');
        $( "#dialog" ).dialog({
            autoOpen: false,
            title: 'Test'
        });
      });
    
      $(".DownloadNotAvailable-ios").click(function(){
        $( "#waitlist-ios" ).attr(
          "open", true
        )
        });

        $(".DownloadNotAvailable-linux").click(function(){
          $( "#waitlist-linux" ).attr(
            "open", true
          )
          });

})

