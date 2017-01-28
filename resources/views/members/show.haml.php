@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

%h2
  Member

.row
  .col-md-2.member-menu
    .picture
      %img.img-responsive{src: 'images/avatars/default-user.png'}
    %ul
      %li.name
        %i.fa.fa-address-card
        = $member->name
      - if (Auth::user()->id == $group->user_id)
        %a{href: route('members.destroy', [$group, $member]), 'data-method' => "DELETE", 'data-token' => csrf_token()}
          %li.user
            %i.fa.fa-trash
            Smazat
        %a{href: route('members.edit', [$group, $member])}
          %li.user
            %i.fa.fa-pencil
            Edit
      %a{href: route('group.show', $group)}
        %li.group
          %i.fa.fa-users
          Skupina
      - if ($member->user)
        %a{href: '#'}
          %li.user
            %i.fa.fa-user
            Uzivatel
  .col-md-10
    %table.table.table-striped.transaction-table
      - foreach($member->memberTransactions as $transaction)
        %tr
          %td #{$transaction->description}
          %td{class: $transaction->value >= 0 ? 'positive' : 'negative'}
            = $transaction->value
          %td #{$transaction->createdAt->format('d. m. Y H:i')}
      %tr.sum-row
        %td SUM
        %td{class: $sum >= 0 ? 'positive' : 'negative'}
          = $sum
        %td

@stop
