@extends('layouts.app')

@section('title', 'Group List')

@section('content')

.row
  %h2 List of groups
  .col-md-6
    %h3 Groups that you are in
    - if (count(Auth::user()->relatedGroups) > 0)
      - foreach (Auth::user()->relatedGroups as $group)
        .group
          %a{href: route('group.show', $group->id)} #{ $group->name }
          %span #{ $group->pivot->cached_budget } Kč
    - else
      %p.text-center You are not in any groups
  .col-md-6
    %h3 Groups that you created
    - if (count(Auth::user()->groups) > 0)
      - foreach (Auth::user()->groups as $group)
        .group
          %a{href: route('group.show', $group->id)} #{ $group->name }
          %a{href: route('group.edit', $group->id)} Edit
          %a{href: route('group.destroy', $group->id)} Delete
          //TODO: Musi byt csrf token a metoda DELETE
    - else
      %p.text-center You did not create any groups

.row
  %a.btn.btn-default{href: route('group.create')} Create new group

@stop
