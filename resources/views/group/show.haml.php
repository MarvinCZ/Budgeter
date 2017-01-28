@extends('layouts.app')

@section('title', 'Dashboard')

@section('navigation')
@parent
%li
  %a{href: route('members.create', $group)}
    Create member
@stop

@section('content')

%h2 Group balance
- foreach($group->members->chunk(6) as $chunk)
  .row.members
    - if ($chunk->count() != 6)
      %div{class: 'col-md-' . (6-$chunk->count())}
    - foreach($chunk as $member)
      .col-md-2
        %a{href: route('members.show', [$group, $member])}
          .member{class: $member->user_id == Auth::user()->id ? 'me' : ''}
            .picture
              %img.img-responsive{src: 'images/avatars/default-user.png'}
            .detail
              .name
                = $member->name
              .budget{class: $member->cachedBudget >= 0 ? 'possitive' : 'negative'}
                = $member->cachedBudget . ' CZK'

%h2 Create new transaction
.row
  .col-md-8.col-md-offset-2
    != Form::open(['route' => ['transaction.store', $group], 'class' => 'form-horizontal'])
    != Form::token()

    //Description
    .form-group{class: $errors->has('description') ? 'has-error' : ''}
      != Form::label('description', 'What did you pay for?', ['class' => 'col-sm-3 control-label'])
      .col-sm-9
        != Form::text('description', null, ['class' => 'form-control'])
        - if ($errors->has('description'))
          %span.help-block
            %strong #{$errors->first('description')}

    //Value
    .form-group{class: $errors->has('value') ? 'has-error' : ''}
      != Form::label('value', 'How much did you pay?', ['class' => 'col-sm-3 control-label'])
      .col-sm-9
        != Form::number('value', 100, ['class' => 'form-control'])
        - if ($errors->has('value'))
          %span.help-block
            %strong #{$errors->first('value')}

    //Select members
    .form-group{class: $errors->has('member_ids') ? 'has-error' : ''}
      != Form::label('member_ids[]', 'Who did you pay for?', ['class' => 'col-sm-3 control-label'])
      .col-sm-9
        .row.members
          - foreach($group->members as $member)
            .col-md-3
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
      != Form::label('payer_id', 'Who did pay?', ['class' => 'col-sm-3 control-label'])
      .col-sm-9
        .row.members
          - foreach($group->members as $member)
            .col-md-3
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
        != Form::submit('Create a transaction', ['class' => 'btn btn-block btn-primary'])

    != Form::close()

@stop
