@if(session('data')['UserRole'] == 'Evaluator')
  @include('secured.ecc_applications.case-handler')  
@else
  @include('secured.ecc_applications.index')  
@endif