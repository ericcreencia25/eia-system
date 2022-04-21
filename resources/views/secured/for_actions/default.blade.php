@if(session('data')['UserId'] == '')
 @include('secured.for_actions.first_time_login')  
@elseif(session('data')['UserRole'] == 'Applicant')
  @include('secured.for_actions.index') 
@else
  @include('secured.for_actions.case-handler') 

@endif