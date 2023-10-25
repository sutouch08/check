var percent = 0;
var count_items = 0;
var updated_items = 0;
var label = $('#txt-label');

var allow_sync = false;
var state;

function preSync() {

  load_in();

  $.ajax({
    url:HOME + 'get_items_last_sync',
    type:'GET',
    cache:false,
    success:function(rs) {
      load_out();

      if(isJson(rs)) {
        let ds = JSON.parse(rs);
        count_items = ds.count_items;

        if(count_items == 0) {
          label.text("ไม่พบรายการที่ต้อง sync");
          $('#btn-sync').addClass('hide');
        }
        else {
          label.text("พบ " + addCommas(count_items) + " รายการที่ต้อง sync");
          state = 'update_items';
        }

        $('#syncModal').modal('show');
      }
      else {
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        })
      }
    }
  });
}


function startSync() {
  $("#btn-sync").addClass('hide');
  $('#btn-stop').removeClass('hide');
  $('#progress').removeClass('hide');
  $('#txt-percent').removeClass('hide');
  $('#txt-percent').addClass('active');

  allow_sync = true;

  if(state === 'update_items') {
    get_update_items();
  }
  else {
    count_update_items();
  }
}


function stopSync() {
  allow_sync = false;
}

function finish_sync(end) {
  $('#btn-stop').addClass('hide');
  $("#btn-sync").removeClass('hide');
  $('#txt-percent').removeClass('active');

  if(end !== undefined) {
    finish_progress();

    $('#syncModal').modal('hide');

    setTimeout(() => {
      swal({
        title:'Sync Completed',
        text:'Items : '+ addCommas(updated_items),
        type:'success',
        html:true
      },
      function() {
        goBack();
      });
    }, 500);

    $.ajax({
      url:HOME + 'close_sync',
      type:'POST',
      cache:false
    });
  }
}


function count_update_items() {
  state = 'count_items';
  label.text('Collecting Items to update');
  if(allow_sync == false){
    finish_sync();
    return false;
  }

  $.ajax({
    url:HOME + 'count_update_items',
    type:'GET',
    cache:false,
    data:{
      'last_sync' : item_last_sync
    },
    success:function(rs) {
      if(rs == 0) {
        label.text('No Item to update');
        finish_sync();
      }
      else {
        count_items = rs;
        label.text(rs + ' items need to update');
        get_update_items();
      }
    }
  });
}


function get_update_items() {
  state = 'update_items';
  label.text('Items Updating '+ addCommas(updated_items) +' of '+ addCommas(count_items));

  if(allow_sync == false) {
    finish_sync();
    return false;
  }

  if(updated_items < count_items) {
    $.ajax({
      url:HOME + 'get_update_items/'+ updated_items,
      type:'GET',
      cache:false,      
      success:function(rs) {
        if(isJson(rs)) {
          let ds = JSON.parse(rs);

          if(ds.status == 'success') {
            let count = parseDefault(parseInt(ds.updateCount), 0);
            updated_items += count;

            update_progress('item');

            if((updated_items + 1) == count_items || count == 0) {
              finish_sync('end');
            }
            else {
              get_update_items();
            }
          }
          else {
            swal({
              title:'Error',
              text:'Something went wrong',
              type:'error'
            });

            finish_sync();
          }
        }
        else {
          swal({
            title:'Error',
            text:'Something went wrong',
            type:'error'
          });

          finish_sync('end');
        }
      }
    })
  }
  else {
    finish_sync('end');
  }
}


function update_progress(type) {
  percent = (updated_items/count_items) * 100;

  var percentage;
  if(percent > 100){
    percentage = 100;
  }else{
    percentage = parseInt(percent);
  }

  $('#txt-percent').attr("data-percent", percentage + "%");
  $('#progress-bar').css("width", percentage+"%");

}


function finish_progress(){
  percent = 100;
  $('#txt-percent').attr("data-percent", percent + "%");
  $('#progress-bar').css("width", percent+"%");
}
