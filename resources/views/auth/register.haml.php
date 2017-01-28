@extends('layouts.app')

@section('title')

Register

@stop

@section('content')

.container.text-center
  .row
    .col-md-8.col-md-offset-2
      .panel.panel-default
        .panel-heading
          Register
        .panel-body
          %form.form-horizontal{role: "form", method: "POST", action: route('register.post')}
            {{ csrf_field() }}
            .form-group{class: $errors->has('name') ? 'has-error' : ''}
              %label.col-md-4.control-label{for: "name"} Name
              .col-md-6
                %input#name.form-control{type: "name", name: "name", value: old('name'), required: "required", autofocus: "autofocus"}
                - if ($errors->has('name'))
                  %span.help-block
                    %strong {{ $errors->first('name') }}

            .form-group{class: $errors->has('email') ? 'has-error' : ''}
              %label.col-md-4.control-label{for: "email"} E-Mail Address
              .col-md-6
                %input#email.form-control{type: "email", name: "email", value: old('email'), required: "required", autofocus: "autofocus"}
                - if ($errors->has('email'))
                  %span.help-block
                    %strong {{ $errors->first('email') }}

            .form-group{class: $errors->has('password') ? 'has-error' : ''}
              %label.col-md-4.control-label{for: "password"} Password
              .col-md-6
                %input#password.form-control{type: "password", name: "password", required: "required"}
                - if ($errors->has('password'))
                  %span.help-block
                    %strong {{ $errors->first('password') }}

            .form-group{class: $errors->has('password_confirmation') ? 'has-error' : ''}
              %label.col-md-4.control-label{for: "password_confirmation"} Confirm Password
              .col-md-6
                %input#password_confirmation.form-control{type: "password", name: "password_confirmation", required: "required"}
                - if ($errors->has('password_confirmation'))
                  %span.help-block
                    %strong {{ $errors->first('password_confirmation') }}

            .form-group.text-left
              .col-md-6.col-md-offset-4
                %button.btn.btn-primary{type: "submit"} Register

@stop
