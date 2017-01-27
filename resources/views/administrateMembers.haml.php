@extends('layouts.app')

@section('title')

Members

@stop

@section('content')

.title Administrate Members

%h2 Remove members
%form{:action => route('removeMembers', $group->id), :method => "post"}
  %input{:type => "checkbox", :name => "member_ids[]", :value => $members[0]->id} {{$members[0]->name}}
  %input{:type => "checkbox", :name => "member_ids[]", :value => $members[1]->id} {{$members[1]->name}}
  %input{:type => "checkbox", :name => "member_ids[]", :value => $members[2]->id} {{$members[2]->name}}
  %input{:type => "checkbox", :name => "member_ids[]", :value => $members[3]->id} {{$members[3]->name}}
  %input{:type => "checkbox", :name => "member_ids[]", :value => $members[4]->id} {{$members[4]->name}}
  %input(type="submit")
  {{ csrf_field() }}

  //TODO: form for adding new members

@stop