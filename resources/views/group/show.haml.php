@extends('layouts.app')

@section('title', trans('layout.dashboard'))

@section('navigation')
@parent
%li
  %a{href: route('members.create', $group)}
    #{ trans('layout.member_create.action') }
@stop

@section('content')

%h2 #{ trans('layout.group_balance') }
- foreach($group->members->chunk(6) as $chunk)
  .row.members
    - if ($chunk->count() != 6)
      %div{class: 'col-md-' . (6-$chunk->count())}
    - foreach($chunk as $member)
      .col-md-2.col-xs-6
        %a{href: route('members.show', [$group, $member])}
          .member{class: $member->user_id == Auth::user()->id ? 'me' : ''}
            .picture
              %img.img-responsive{src: 'images/avatars/default-user.png'}
            .detail
              .name
                = $member->name
              .budget{class: $member->cachedBudget >= 0 ? 'positive' : 'negative'}
                = $member->cachedBudget . ' CZK'

.row
  .col-md-8.col-md-offset-2
    .panel.panel-default
      .panel-heading
        #{ trans('layout.transaction_create.page') }
      .panel-body
        != Form::open(['route' => ['transaction.store', $group], 'class' => 'form-horizontal'])
        != Form::token()

        //Description
        .form-group{class: $errors->has('description') ? 'has-error' : ''}
          != Form::label('description', trans('layout.transaction_create.description'), ['class' => 'col-sm-3 control-label'])
          .col-sm-9
            != Form::text('description', null, ['class' => 'form-control'])
            - if ($errors->has('description'))
              %span.help-block
                %strong #{$errors->first('description')}

        //Value
        .form-group{class: $errors->has('value') ? 'has-error' : ''}
          != Form::label('value', trans('layout.transaction_create.value'), ['class' => 'col-sm-3 control-label'])
          .col-sm-9
            != Form::number('value', 100, ['class' => 'form-control'])
            - if ($errors->has('value'))
              %span.help-block
                %strong #{$errors->first('value')}

        //Select members
        .form-group{class: $errors->has('member_ids') ? 'has-error' : ''}
          != Form::label('member_ids[]', trans('layout.transaction_create.pay_for'), ['class' => 'col-sm-3 control-label'])
          .col-sm-9
            .row.members
              - foreach($group->members as $member)
                .col-md-3.col-xs-4
                  .member.selectable.selectable-many
                    != Form::checkbox('member_ids[]', $member->id, null, ['class' => 'hidden'])
                    .picture
                      %img.img-responsive{src: 'images/avatars/default-user.png'}
                    .detail
                      .name
                        = $member->name
            - if ($errors->has('member_ids'))
              %span.help-block
                %strong #{$errors->first('member_ids')}
        //Select payer
        .form-group{class: $errors->has('payer_id') ? 'has-error' : ''}
          != Form::label('payer_id', trans('layout.transaction_create.pay_who'), ['class' => 'col-sm-3 control-label'])
          .col-sm-9
            .row.members
              - foreach($group->members as $member)
                .col-md-3.col-xs-4
                  .member.selectable.selectable-one
                    != Form::radio('payer_id', $member->id, null, ['class' => 'hidden'])
                    .picture
                      %img.img-responsive{src: 'images/avatars/default-user.png'}
                    .detail
                      .name
                        = $member->name
            - if ($errors->has('payer_id'))
              %span.help-block
                %strong #{$errors->first('payer_id')}

        .form-group
          .col-sm-offset-3.col-sm-9
            != Form::submit(trans('layout.transaction_create.action'), ['class' => 'btn btn-block btn-primary'])

        != Form::close()

@stop
