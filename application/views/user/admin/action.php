<script type="text/javascript">
  $(document).ready(function(){
    edit(); 
    validasi();
    simpan();
    $('.hapus').click(function(){
      var url=$(this).attr('url');
      swal({
        title:'Perhatian',
        text:'Hapus Data',
        html:true,
        ConfirmButtonColor:'#d9534F',
        showCancelButton:true,
        type:'warning'
      },function(){
        window.location.href=url
      });
      return false
    })       
    $('#datatabel').DataTable();
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd-mm-yyyy",
        todayBtn: true,
    });
    $(".selectdata").select2();             
  })
  function add(){
    var url=$("#add").attr('url');   
    $("#view").load(url);      
  }
  function edit(){   
    $('.edit').click(function(){
      var url=$(this).attr('url');
      var id=$(this).attr('id');
      //alert(id);
      $.ajax({
        type:'POST',
        url:url,
        data:{id:id},
        success:function(data){
          $("#view").html(data);       
        }
      })
      return false;        
    })
  }
  function validasi(){
    $("form").validate({
    errorPlacement: function ( error, element ) {
      if ( element.prop( "type" ) === "checkbox" ) {
        error.insertAfter( element.parent( "radio" ) );
      } else {
        error.insertAfter( element );
      }
      // Add the `help-block` class to the error element
      error.addClass( "help-block" );
      $('.error').css('font-weight', 'normal');
    },    
    highlight: function ( element, errorClass, validClass ) {
      $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
    },
    unhighlight: function (element, errorClass, validClass) {
      $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
    },
    // submitHandler: function (form) {
    //   var data = $('form').serialize();
    //   url=$('[name=submit]').attr('url');
    //   $.ajax({
    //     type: 'POST',
    //     url: url,
    //     data: data,
    //     success: function() {
    //       // $('.tampildata').load("tampil.php");
    //       alert('simpan berhasil');
    //     }
    //   });
    //   //alert(url);
    // }   
    });    
  }  
  function simpan(){
    $(".simpans").click(function(e){
      e.preventDefault();
      var data = $('form').serialize();
      url=$(this).attr('url');
      // $.ajax({
      //   type: 'POST',
      //   url: "aksi.php",
      //   data: data,
      //   success: function() {
      //     $('.tampildata').load("tampil.php");
      //   }
      // });
      alert(data);
    });    
  }
</script>