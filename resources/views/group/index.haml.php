@extends('layouts.app')

@section('title', 'Group List')

@section('content')

.row
  %h2 List of groups
  .col-md-6
    %h3 Groups that you are in
    - if (count(Auth::user()->relatedGroups) > 0)
      - foreach (Auth::user()->relatedGroups as $group)
        .well
          %h3
            %a{href: route('group.show', $group->id)} #{ $group->name }
          %strong{class: $group->pivot->cached_budget >= 0 ? 'text-success' : 'text-danger'} #{ $group->pivot->cached_budget } Kč
    - else
      %p.text-center You are not in any groups
  .col-md-6
    %h3 Groups that you created
    - if (count(Auth::user()->groups) > 0)
      - foreach (Auth::user()->groups as $group)
        .well
          %h3
            %a{href: route('group.show', $group->id)} #{ $group->name }
          .row
            .col-xs-2.col-xs-offset-4
              %a{href: route('group.edit', $group->id)}
                %i.fa.fa-pencil Edit
            .col-xs-2
              %a{href: route('group.destroy', $group->id), 'data-method' => "DELETE", 'data-token' => csrf_token()}
                %i.fa.fa-remove Remove
    - else
      %p.text-center You did not create any groups

.row
  %a.btn.btn-default.btn-lg{href: route('group.create')} Create new group

@stop
