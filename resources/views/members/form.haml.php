@extends('layouts.app')

@section('title', 'Member')

@section('content')

.row
  .col-md-8.col-md-offset-2
    .panel.panel-default
      .panel-heading
        Member #{$member->id ? 'Edit' : 'Create'}
      .panel-body
        != Form::model($member, ['route' => $route, 'class' => 'form-horizontal', 'method' => 'POST'])
        != Form::token()
        != method_field($method)

        //Description
        .form-group{class: $errors->has('name') ? 'has-error' : ''}
          != Form::label('name', 'Name', ['class' => 'col-sm-4 control-label'])
          .col-sm-6
            != Form::text('name', null, ['class' => 'form-control'])
            - if ($errors->has('name'))
              %span.help-block
                %strong #{$errors->first('name')}

        .form-group
          .col-sm-offset-4.col-sm-6
            != Form::submit('Submit', ['class' => 'btn btn-block btn-primary'])

        != Form::close()

@stop
