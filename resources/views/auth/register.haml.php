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
            //TODO: $errors->has('name') ? ' has-error' : '' Missing
            .form-group
              %label.col-md-4.control-label{for: "name"} Name
              .col-md-6
                %input#name.form-control{type: "name", name: "name", value: old('name'), required: "required", autofocus: "autofocus"}
                - if ($errors->has('name'))
                  %span.help-block
                    %strong {{ $errors->first('name') }}

            .form-group
              %label.col-md-4.control-label{for: "email"} E-Mail Address
              .col-md-6
                %input#email.form-control{type: "email", name: "email", value: old('email'), required: "required", autofocus: "autofocus"}
                - if ($errors->has('email'))
                  %span.help-block
                    %strong {{ $errors->first('email') }}

            .form-group
              %label.col-md-4.control-label{for: "password"} Password
              .col-md-6
                %input#password.form-control{type: "password", name: "password", required: "required"}
                - if ($errors->has('password'))
                  %span.help-block
                    %strong {{ $errors->first('password') }}

            .form-group
              %label.col-md-4.control-label{for: "password-confirmation"} Confirm Password
              .col-md-6
                //TODO: Can't register if validation rule 'confirmed' is set
                %input#password-confirmation.form-control{type: "password", name: "password-confirmation", required: "required"}
                - if ($errors->has('password-confirmation'))
                  %span.help-block
                    %strong {{ $errors->first('password-confirmation') }}

            .form-group.text-left
              .col-md-6.col-md-offset-4
                %button.btn.btn-primary{type: "submit"} Login

@stop
