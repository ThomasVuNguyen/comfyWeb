
//import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2';
// Create a single supabase client for interacting with your database
import { createClient } from 'https://esm.sh/@supabase/supabase-js@2'


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

        $("#ios-waitlist-submit").click(async function(){
          var ios_email = $("#ios-waitlist-email").val();
          await AddIOSWaitlist(ios_email);
        });



        $(".DownloadNotAvailable-linux").click(function(){
          $( "#waitlist-linux" ).attr(
            "open", true
          )
          });

          $("#linux-waitlist-submit").click(async function(){
            var linux_email = $("#linux-waitlist-email").val();
            await AddLinuxWaitlist(linux_email);
          });


})

async function AddIOSWaitlist(email){
  
  const supabase = createClient(
    'https://pquytpdhjxhdgtutqyar.supabase.co', 
    'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InBxdXl0cGRoanhoZGd0dXRxeWFyIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MDU1NTM1NzQsImV4cCI6MjAyMTEyOTU3NH0.TY_8c-4sYTLbobCt02IJdwBVa61hUcIgE4HsSl9vPKg'
    );
  const { error } = await supabase
  .from('Waitlist')
  .insert({Email: email.toString(), Platform: 'ios' });
}

async function AddLinuxWaitlist(email){
  
  const supabase = createClient(
    'https://pquytpdhjxhdgtutqyar.supabase.co', 
    'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InBxdXl0cGRoanhoZGd0dXRxeWFyIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MDU1NTM1NzQsImV4cCI6MjAyMTEyOTU3NH0.TY_8c-4sYTLbobCt02IJdwBVa61hUcIgE4HsSl9vPKg'
    );
  const { error } = await supabase
  .from('Waitlist')
  .insert({Email: email.toString(), Platform: 'linux' });
  alert(error);
  console.log(error);
}