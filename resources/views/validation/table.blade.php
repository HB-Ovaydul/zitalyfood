
@if(Session::has('success-table'))
   <p class="alert alert-success">{{ Session::get('success-table') }}<button class="close" data-dismiss="alert">&times;</button></p>
@endif
@if(Session::has('warning-table'))
   <p class="alert alert-warning">{{ Session::get('warning-table') }}<button class="close" data-dismiss="alert">&times;</button></p>
@endif
@if(Session::has('danger-table'))
   <p class="alert alert-danger">{{ Session::get('danger-table') }}<button class="close" data-dismiss="alert">&times;</button></p>
@endif
@if(Session::has('info-table'))
   <p class="alert alert-info">{{ Session::get('info-table') }}<button class="close" data-dismiss="alert">&times;</button></p>
@endif