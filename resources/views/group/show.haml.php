@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

.title Dashboard
%p Logged as: {{ $user->name }}

%h2 Group balance
%p You: {{ $group->members[0]->cachedBudget }} Kč
- foreach($group->members as $member)
  %p {{ $member->name }}: {{ $member->cachedBudget }} Kč

%h2 Create new transaction
.errors
  - foreach ($errors->all() as $error)
    .error
      = $error

!= Form::open(['route' => ['transaction.store', $group]])

//Description
!= Form::label('description', 'What did you pay for?')
!= Form::text('description')

//Value
!= Form::label('value', 'How much did you pay?')
!= Form::number('value', 100)

//Select members
!= Form::label('member_ids[]', 'Who did you pay for?')
!= Form::select('member_ids[]', ['1' => 'Member 1','2' => 'Member 2','3' => 'Member 3'], null, ['multiple' => true])

!= Form::submit('Create a transaction')

!= Form::close()

@stop
