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

})(jQuery);