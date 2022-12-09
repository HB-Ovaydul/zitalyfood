(function($){

    // $(document).ready( function () {
    //     $('#data-table').DataTable();
    // } );

    $('.confirm-delete').click(function(){
        let conf = confirm('Are You Sure!');
        if(conf){
            return true;
        }else{
           return false;
        }
    });

// Show Pssword
$('#show_pass').change(function(){
   let pass = $('#old_pass').attr('type');
    if(pass == 'password'){
        $('#old_pass').attr('type', 'text');
    }else{
        $('#old_pass').attr('type', 'password');
    }
});

$('#s_pass').change(function(){
   let pass = $('#new_pass').attr('type');
    if(pass == 'password'){
        $('#new_pass').attr('type', 'text');
    }else{
        $('#new_pass').attr('type', 'password');
    }
});
$('#l_pass').change(function(){
   let pass = $('#c_pass').attr('type');
    if(pass == 'password'){
        $('#c_pass').attr('type', 'text');
    }else{
        $('#c_pass').attr('type', 'password');
    }
});

$('#photos').change(function(e){
    let url = URL.createObjectURL(e.target.files[0]);
    $('#preview').attr('src', url);
});

// slider img preview

$('#photo_id').change(function(e){
    let url = URL.createObjectURL(e.target.files[0]);
    $('#previews').attr('src', url);
});


//Gallery 

$('#gall_id').change(function(e){
    const file = e.target.files;
    gall_file = '';
    for (let i = 0; i < file.length; i++) {
        const object_file = URL.createObjectURL(e.target.files[i]);
        gall_file += `<img src="${object_file}">`; 
    }

      let gal =  $('.gallery').html(gall_file);
      console.log(gal);

});


// Ckeditor 5
ClassicEditor
.create( document.querySelector( '#editor' ) )
.catch( error => {
    console.error( error );
} );

// Select 2
    $('.ztfood').select2();
})(jQuery);