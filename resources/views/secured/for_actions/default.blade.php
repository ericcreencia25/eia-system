@if(session('data')['UserRole'] == 'Applicant')
  @include('secured.for_actions.index')   
@else
  @include('secured.for_actions.case-handler') 
@endif