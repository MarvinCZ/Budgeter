@extends('layouts.app')

@section('title')

Form testing

@stop

@section('content')

.title Form
{!! Form::model($transaction, ['route' => ['transaction.store', $group]]) !!}

//Description
{{ Form::label('description', 'What did you pay for?') }}
{{ Form::text('description') }}

//Value
{{ Form::label('value', 'How much did you pay?') }}
{{ Form::number('value', 100) }}

//Select members
{{ Form::label('member_ids[]', 'Who did you pay for?') }}
{{ Form::select('member_ids[]', ['1' => 'Member 1','2' => 'Member 2','3' => 'Member 3'], null, ['multiple' => true]) }}

{{ Form::submit('Create a transaction') }}

{!! Form::close() !!}

@stop
