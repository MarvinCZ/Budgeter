@extends('layouts.app')

@section('title', 'Group List')

@section('content')

%h2.text-center List of groups
.row.text-center
  .col-md-6
    %h3 Groups that you are in
    - if (count(Auth::user()->relatedGroups) > 0)
      - foreach (Auth::user()->relatedGroups as $group)
        .well.well-group
          .well-content
            %a{href: route('group.show', $group->id)}
              = $group->name
          .well-btns
            %a{href: route('group.edit', $group->id)}
              .well-btn.btn-warning
                %i.fa.fa-eye
                Show
            .well-btn
              %strong{class: $group->pivot->cached_budget >= 0 ? 'text-success' : 'text-danger'}
                = $group->pivot->cached_budget . ' Kč'
    - else
      %p You are not in any groups
  .col-md-6
    %h3 Groups that you created
    - if (count(Auth::user()->groups) > 0)
      - foreach (Auth::user()->groups as $group)
        .well.well-group
          .well-content
            %a{href: route('group.show', $group->id)}
              = $group->name
          .well-btns
            %a{href: route('group.edit', $group->id)}
              .well-btn.btn-success
                %i.fa.fa-pencil
                Edit
            %a{href: route('group.destroy', $group->id), 'data-method' => "DELETE", 'data-token' => csrf_token()}
              .well-btn.btn-danger
                %i.fa.fa-remove
                Remove
    - else
      %p You did not create any groups
    %a.btn.btn-primary.btn-lg.btn-block{href: route('group.create')} Create new group

@stop
