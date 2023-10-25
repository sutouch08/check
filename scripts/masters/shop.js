function addNew(){
  window.location.href = HOME + 'add_new';
}



function goBack(){
  window.location.href = HOME;
}


function getEdit(id){
  window.location.href = HOME + 'edit/'+id;
}


function add() {
  let code = $('#code').val().trim();
  let name = $('#name').val().trim();
  let warehouse_code = $('#warehouse_code').val().trim();
  let warehouse_name = $('#warehouse_name').val().trim();
  let allow_input_qty = $('#allow_input_qty').is(':checked') ? 1 : 0;
  let active = $('#active').is(':checked') ? 1 : 0;

  if(code.length == 0) {
    $('#code').addClass('has-error');
    return false;
  }
  else {
    $('#code').removeClass('has-error');
  }

  if(name.length == 0) {
    $('#name').addClass('has-error');
    return false;
  }
  else {
    $('#name').removeClass('has-error');
  }

  load_in();

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'code' : code,
      'name' : name,
      'warehouse_code' : warehouse_code,
      'warehouse_name' : warehouse_name,
      'allow_input_qty' : allow_input_qty,
      'active' : active
    },
    success:function(rs) {
      load_out();
      if(rs == 'success') {
        swal({
          title:'Success',
          type:'success',
          timer:1000
        });

        setTimeout(() => {
          addNew();
        }, 1200);
      }
      else {
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        });
      }
    }
  });
}



function update() {
  let id = $('#shop_id').val();
  let code = $('#code').val().trim();
  let name = $('#name').val().trim();
  let warehouse_code = $('#warehouse_code').val().trim();
  let warehouse_name = $('#warehouse_name').val().trim();
  let allow_input_qty = $('#allow_input_qty').is(':checked') ? 1 : 0;
  let active = $('#active').is(':checked') ? 1 : 0;

  if(code.length == 0) {
    $('#code').addClass('has-error');
    return false;
  }
  else {
    $('#code').removeClass('has-error');
  }

  if(name.length == 0) {
    $('#name').addClass('has-error');
    return false;
  }
  else {
    $('#name').removeClass('has-error');
  }

  load_in();

  $.ajax({
    url:HOME + 'update',
    type:'POST',
    cache:false,
    data:{
      'id' : id,
      'code' : code,
      'name' : name,
      'warehouse_code' : warehouse_code,
      'warehouse_name' : warehouse_name,
      'allow_input_qty' : allow_input_qty,
      'active' : active
    },
    success:function(rs) {
      load_out();
      if(rs == 'success') {
        swal({
          title:'Success',
          type:'success',
          timer:1000
        });
      }
      else {
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        });
      }
    }
  });
}



function clearFilter(){
  var url = HOME + 'clear_filter';
  var page = BASE_URL + 'masters/shop';
  $.get(url, function(){
    goBack();
  });
}


function getDelete(id, code, no){
  swal({
    title:'Are sure ?',
    text:'ต้องการลบ ' + code + ' หรือไม่ ?',
    type:'warning',
    showCancelButton: true,
		confirmButtonColor: '#FA5858',
		confirmButtonText: 'ใช่, ฉันต้องการลบ',
		cancelButtonText: 'ยกเลิก',
		closeOnConfirm: false
  },function(){
    $.ajax({
      url: HOME + 'delete',
      type:'POST',
      cache:false,
      data:{
        'id' : id
      },
      success:function(rs) {
        if(rs === 'success') {
          swal({
            title:'Deleted',
            type:'success',
            timer:1000
          });

          $('#row-'+no).remove();
        }
        else {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          });
        }
      }
    })
  })
}
