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

})(jQuery);