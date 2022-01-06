@if(session('data')['UserRole'] == 'Evaluator')
  @include('secured.for_actions.casehandler_project_app')  
@else
  @include('secured.for_actions.applicant_project_app')  
@endif