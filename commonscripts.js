  //open openable
  $(document).ready(function () {
    $('.open-btn').on('click', function(e) {
      toOpen = $(this).attr('toggle');
      document.getElementById(toOpen).classList.remove('openable');
    });
  });

  //close openable
  $(document).ready(function () {
    $('.close-btn').on('click', function(e) {
      toClose = $(this).attr('toggle');
      document.getElementById(toClose).classList.add('openable');
    });
  });