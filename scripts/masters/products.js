function addNew(){
  window.location.href = HOME + 'add_new';
}



function goBack(){
  window.location.href = HOME;
}


function getEdit(id){
  window.location.href = HOME + 'edit/'+id;
}


function update() {
  let id = $('#product_id').val();
  let code = $('#code').val().trim();
  let name = $('#name').val().trim();
  let barcode = $('#barcode').val().trim();
  let style = $('#style').val().trim();
  let cost = $('#cost').val();
  let price = $('#price').val();
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

  if(barcode.length == 0) {
    $('#barcode').addClass('has-error');
    return false;
  }
  else {
    $('#barcode').removeClass('has-error');
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
      'style' : style,
      'barcode' : barcode,
      'cost' : cost,
      'price' : price,
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



function add() {
  let code = $('#code').val().trim();
  let name = $('#name').val().trim();
  let barcode = $('#barcode').val().trim();
  let style = $('#style').val().trim();
  let cost = $('#cost').val();
  let price = $('#price').val();
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

  if(barcode.length == 0) {
    $('#barcode').addClass('has-error');
    return false;
  }
  else {
    $('#barcode').removeClass('has-error');
  }

  load_in();

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'code' : code,
      'name' : name,
      'style' : style,
      'barcode' : barcode,
      'cost' : cost,
      'price' : price,
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



function clearFilter(){
  var url = HOME + 'clear_filter';
  var page = BASE_URL + 'masters/products';
  $.get(url, function(){
    goBack();
  });
}


function getDelete(code, id){
  let url = BASE_URL + 'masters/products/delete_item/';

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
      url: url,
      type:'POST',
      cache:false,
      data:{
        'id' : id
      },
      success:function(rs){
        if(rs === 'success'){
          swal({
            title:'Deleted',
            type:'success',
            timer:1000
          });

          $('#row-'+id).remove();

          reIndex();

        }else{
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

function getTemplate() {
  var token	= new Date().getTime();
	get_download(token);
	window.location.href = HOME + 'download_template/'+token;
}
