@if(session('data')['UserRole'] == 'Evaluator')
  @include('secured.for_actions.case-handler')  
@else
  @include('secured.for_actions.index')  
@endif