//add parts to collection
$(document).ready(function (){
  $('.add-coll-part-form').on('submit', function(e) {
    e.preventDefault();
    let form = $(this);
    let formData = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'collhandler.php',
      data: formData,
      success: function(response) {
        try {
          if (response.success) {
            let x = "#coll-part-total" + response.corow;
            $(x).text(response.total);
            form.trigger('reset');
          }
        }
        catch (error) {
          console.error('response error: ', error);
        }
      },
      error: function(error) {
        console.error('ajax error: ', error);
      }
    });
  });
});