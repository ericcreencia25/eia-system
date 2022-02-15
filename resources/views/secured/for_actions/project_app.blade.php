@if(session('data')['UserRole'] == 'Applicant')
  
  @include('secured.for_actions.applicant_project_app')  

@elseif(session('data')['UserRole'] == 'Approving')

  @include('secured.for_actions.approver_project_app')  

@else

  @include('secured.for_actions.casehandler_project_app')  
  
@endif