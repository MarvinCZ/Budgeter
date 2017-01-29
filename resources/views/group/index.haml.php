@extends('layouts.app')

@section('title')

#{ trans('layout.group_list') }

@stop

@section('content')

%h2.text-center #{ trans('layout.group_list') }
.row.text-center
  .col-md-6
    %h3 #{ trans('layout.groups_member.heading') }
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
                #{ trans('layout.show') }
            .well-btn
              %strong{class: $group->pivot->cached_budget >= 0 ? 'text-success' : 'text-danger'}
                = $group->pivot->cached_budget . ' Kč'
    - else
      %p #{ trans('layout.groups_member.none') }
  .col-md-6
    %h3 #{ trans('layout.groups_owner.heading') }
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
                #{ trans('layout.edit') }
            %a{href: route('group.destroy', $group->id), 'data-method' => "DELETE", 'data-token' => csrf_token()}
              .well-btn.btn-danger
                %i.fa.fa-remove
                #{ trans('layout.delete') }
    - else
      %p #{ trans('layout.groups_owner.none') }
    %a.btn.btn-primary.btn-lg.btn-block{href: route('group.create')} #{ trans('layout.group_create.action') }

@stop
