@extends('layouts.app')

@section('title')

= ($group->id ? trans('layout.group_edit.page') . ' ' . $group->name : trans('layout.group_create.page'))

@stop

@section('content')

.container.text-center
  .row
    .col-md-8.col-md-offset-2
      .panel.panel-default
        .panel-heading
          = ($group->id ? trans('layout.group_edit.page') . ' ' . $group->name : trans('layout.group_create.page'))
        .panel-body
          %form.form-horizontal{role: "form", method: "POST", action: route('group.' . $action, $group)}
            - if ($group->id)
              {{ method_field('PUT') }}
            {{ csrf_field() }}
            .form-group{class: $errors->has('name') ? 'has-error' : ''}
              %label.col-md-4.control-label{for: "name"} #{ trans('layout.name') }
              .col-md-6
                %input#name.form-control{type: "name", name: "name", value: old('name', $group->name), required: "required", autofocus: "autofocus"}
                - if ($errors->has('name'))
                  %span.help-block
                    %strong {{ $errors->first('name') }}

            .form-group.text-left
              .col-md-6.col-md-offset-4
                %button.btn.btn-primary{type: "submit"}
                  = ($group->id ? trans('layout.edit') : trans('layout.create'))

@stop
