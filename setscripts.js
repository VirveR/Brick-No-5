//add new set
$(document).ready(function () {
  $('#add-set-form').on('submit', function(e) {
    e.preventDefault();
    let addSetid = $('#add-set-id').val();
    let addSetYear = $('#add-set-year').val();
    let addSetName = $('#add-set-name').val();
    let addSetOwn = $('#add-set-own').val();
    $.ajax({
      type: 'POST',
      url: 'sethandler.php',
      data: {
        addSetid: addSetid,
        addSetYear: addSetYear,
        addSetName: addSetName,
        addSetOwn: addSetOwn
      },
      success: function(response) {
        try {
          if (response.success) {
            $('#sets-table tr:first').after(
              `<tr>
                <td>${addSetYear}</td>
                <td>${addSetid}</td>
                <td>${addSetName}</td>
                <td>${addSetOwn}</td>
                <td><img src="img/delete.png" alt="delete row" class="icon"></td>
              </tr>`
            );
            $('#add-set-id').val('');
            $('#add-set-year').val('');
            $('#add-set-name').val('');
            $('#add-set-own').val('');
          }
        }
        catch (error) {
          console.error('response error:', error);
        }
      },
      error: function(error) {
        console.error('ajax error: ', error);
      }
    });
  });
});

//edit set own
$(document).ready(function (){
  $('#edit-set-own-form').on('submit', function(e) {
    e.preventDefault();
    let editOwnSetid = $('#edit-sown-setid').val();
    let editSetOwn = $('.edit-set-own:checked').val();
    if ($('#edit-set-own-year').val()) {
      editSetOwn = $('#edit-set-own-year').val();
    }
    $.ajax({
      type: 'POST',
      url: 'sethandler.php',
      data: {
        editOwnSetid: editOwnSetid,
        editSetOwn: editSetOwn
      },
      success: function(response) {
        try {
          if (response.success) {
            $('#sown-stmt').html(response.sownstmt);
            $('#edit-box-set-own').addClass('openable');
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

//edit set built
$(document).ready(function () {
  $('#edit-set-built-form').on('submit', function(e) {
    e.preventDefault();
    let editSbuiltSetid = $('#edit-set-built-setid').val();
    let editSbuilt = ($('#edit-set-built')).val();
    $.ajax({
      type: 'POST',
      url: 'sethandler.php',
      data: {
        editSbuiltSetid: editSbuiltSetid,
        editSbuilt: editSbuilt
      },
      success: function(response) {
        try {
          $('#sbuilt-stmt').html(response.sbuiltstmt);
          $('#edit-box-set-built').addClass('openable');
        }
        catch (error) {
          console.log('response error: ', error);
        }
      },
      error: function(error) {
        console.error('ajax error: ', error);
      }
    });
  });
});

//edit set instructions
$(document).ready(function () {
  $('#edit-set-instr-form').on('submit', function(e) {
    e.preventDefault();
    let editSinstrSetid = $('#edit-set-instr-setid').val();
    let editSinstr = ($('#edit-set-instr')).val();
    $.ajax({
      type: 'POST',
      url: 'sethandler.php',
      data: {
        editSinstrSetid: editSinstrSetid,
        editSinstr: editSinstr
      },
      success: function(response) {
        try {
          $('#sinstr-stmt').html(response.sinstrstmt);
          $('#edit-box-set-instr').addClass('openable');
        }
        catch (error) {
          console.log('response error: ', error);
        }
      },
      error: function(error) {
        console.error('ajax error: ', error);
      }
    });
  });
});

//edit set Bricklink link
$(document).ready(function () {
  $('#edit-set-bl-form').on('submit', function(e) {
    e.preventDefault();
    let editSblSetid = $('#edit-set-bl-setid').val();
    let editSbl = ($('#edit-set-bl')).val();
    $.ajax({
      type: 'POST',
      url: 'sethandler.php',
      data: {
        editSblSetid: editSblSetid,
        editSbl: editSbl
      },
      success: function(response) {
        try {
          $('#sbl-stmt').html(response.sblstmt);
          $('#edit-box-set-bl').addClass('openable');
        }
        catch (error) {
          console.log('response error: ', error);
        }
      },
      error: function(error) {
        console.error('ajax error: ', error);
      }
    });
  });
});

//edit set ToysPeriod link
$(document).ready(function () {
  $('#edit-set-tp-form').on('submit', function(e) {
    e.preventDefault();
    let editStpSetid = $('#edit-set-tp-setid').val();
    let editStp = ($('#edit-set-tp')).val();
    $.ajax({
      type: 'POST',
      url: 'sethandler.php',
      data: {
        editStpSetid: editStpSetid,
        editStp: editStp
      },
      success: function(response) {
        try {
          $('#stp-stmt').html(response.stpstmt);
          $('#edit-box-set-tp').addClass('openable');
        }
        catch (error) {
          console.log('response error: ', error);
        }
      },
      error: function(error) {
        console.error('ajax error: ', error);
      }
    });
  });
});

//delete row
$(document).ready(function () {
  $('.delete-btn').on('click', function(e) {
    let delRowSetid = $(this).attr('row-setid');
    let delRowNumber = $(this).attr('row-number');
    $.ajax({
      type: 'POST',
      url: 'sethandler.php',
      data: {
        delRowSetid: delRowSetid,
        delRowNumber: delRowNumber
      },
      success: function(response) {
        try {
          if (response.success) {
            $('#content-table tr:last').prev().remove();
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

//add row
$(document).ready(function () {
  $('#add-row-form').on('submit', function(e) {
    e.preventDefault();
    let addRowSetid = $('#add-row-setid').val();
    let addRowPart = $('#add-row-part').val();
    let addRowColor = $('#add-row-color').val();
    let addRowNeeds = $('#add-row-needs').val();
    let addRowHas = $('#add-row-has').val();
    $.ajax({
      type: 'POST',
      url: 'sethandler.php',
      data: {
        addRowSetid: addRowSetid,
        addRowPart: addRowPart,
        addRowColor: addRowColor,
        addRowNeeds: addRowNeeds,
        addRowHas: addRowHas
      },
      success: function(response) {
        try {
          if (response.success) {
            $('#content-table tr:last').before(
              `<tr>
                <td>${response.rnumber}</td>
                <td>${addRowPart}</td>
                <td>${response.pdescr}</td>
                <td>${addRowColor}</td>
                <td>${addRowNeeds}</td>
                <td>${addRowHas}</td>
                <td><img src="img/delete.png" alt="delete row" class="delete-btn icon" row-setid="${addRowSetid}" row-number="${response.rnumber}"></td>
              </tr>`
            );
            $('#add-row-part').val('');
            $('#add-row-color').val('');
            $('#add-row-needs').val('');
            $('#add-row-has').val('');
          }
        }
        catch (error) {
          console.error('response error:', error);
        }
      },
      error: function(error) {
        console.error('ajax error: ', error);
      }
    });
  });
});