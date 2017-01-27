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
%form{:method => "post", :action => route('transaction.store', $group->id)}
  %input{:type => "textarea", :name => "t_description"} Description
  %input{:type => "number", :name => "t_value", :min => 1} Value
  - foreach($group->members as $member)
    %input{type: "checkbox", name: "t_member_ids[]", value: 1} {{ $member->name }}

  %input{:type => "hidden", :name => "t_payer", :value => "1"}
  {{ csrf_field() }}
  %input{:type => "submit", :value => "Create"}

@stop
