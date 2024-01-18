$(document).ready(function() {
    $(".footer").load
    ("footer.html");
    $(".navbar").load
    ("navdoc.html");
    /*
    $('#PageSelect').change(function(){
        // Get the selected option's value
        var selectedValue = $(this).val();
    
        switch(selectedValue.toString()){
          case "GetStarted":
              $(".MarkdownPage").attr("src",ç);
              break;
              case "WhatsASpace":
                $(".MarkdownPage").attr("src","../pages/Create a space.md");
                break;
                case "AddAButton":
                    $(".MarkdownPage").attr("src","../pages/Add buttons.md");
        }
      });
      */
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

})

