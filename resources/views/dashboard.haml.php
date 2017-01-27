@extends('layouts.app')

@section('title')

Dashboard

@stop

@section('content')

.title Dashboard
%p Logged as: {{ $user->name }}
//TODO: Try to echo all members in $members via some kind of HAML loop

%h2 Group balance
%p You: {{ $group->members[0]->cachedBudget }} Kč
%p {{ $group->members[1]->name }}: {{ $group->members[1]->cachedBudget }} Kč
%p {{ $group->members[2]->name }}: {{ $group->members[2]->cachedBudget }} Kč
%p {{ $group->members[3]->name }}: {{ $group->members[3]->cachedBudget }} Kč
%p {{ $group->members[4]->name }}: {{ $group->members[4]->cachedBudget }} Kč

%h2 Create new transaction
%form{:method => "post", :action => route('createTransaction', $group->id)}
  %input{:type => "textarea", :name => "t_description"} Description
  %input{:type => "number", :name => "t_value", :min => 1} Value
  %input{:type => "checkbox", :name => "t_member_ids[]", :value => 2} {{ $group->members[1]->name }}
  %input{:type => "checkbox", :name => "t_member_ids[]", :value => 3} {{ $group->members[2]->name }}
  %input{:type => "checkbox", :name => "t_member_ids[]", :value => 4} {{ $group->members[3]->name }}
  %input{:type => "checkbox", :name => "t_member_ids[]", :value => 5} {{ $group->members[4]->name }}

  %input{:type => "hidden", :name => "t_payer", :value => "1"}
  {{ csrf_field() }}
  %input{:type => "submit", :value => "Create"}

@stop
