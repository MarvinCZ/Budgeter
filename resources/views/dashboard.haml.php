%html
  %head
    %base{href: URL::asset('/')}
    %title Budgeter
    %link{:rel => "stylesheet", :type => "text/css", :href => "https://fonts.googleapis.com/css?family=Lato:100"}
    %link{:rel => "stylesheet", :type => "text/css", :href => "bundles/bundle.css"}
    %link{:rel => "stylesheet", :type => "text/css", :href => "css/app.css"}
    %script{:type => "text/javascript", :src => "bundles/bundle.js"}
    %script{:type => "text/javascript", :src => "js/app.js"}
  %body
    .center-container
      .content
        .title Dashboard
        %p Logged as: {{ $user->name }}
        //TODO: Try to echo all members in $members via some kind of HAML loop

        %h2 Group balance
        %p You: {{ $group->members[0]->cachedBudget }} Kč
        %p {{ $group->members[1]->name }}: {{ $group->members[1]->cachedBudget }} Kč
        %p {{ $group->members[2]->name }}: {{ $group->members[2]->cachedBudget }} Kč
        %p {{ $group->members[3]->name }}: {{ $group->members[3]->cachedBudget }} Kč
        %p {{ $group->members[4]->name }}: {{ $group->members[4]->cachedBudget }} Kč

        %h2 Create new transaction
        %form{:method => "post", :action => route('createTransaction', $group->id)}
          %input{:type => "textarea", :name => "t_description"} Description
          %input{:type => "number", :name => "t_value", :min => 1} Value
          %input{:type => "checkbox", :name => "t_member_ids[]", :value => 2} {{ $group->members[1]->name }}
          %input{:type => "checkbox", :name => "t_member_ids[]", :value => 3} {{ $group->members[2]->name }}
          %input{:type => "checkbox", :name => "t_member_ids[]", :value => 4} {{ $group->members[3]->name }}
          %input{:type => "checkbox", :name => "t_member_ids[]", :value => 5} {{ $group->members[4]->name }}

          %input{:type => "hidden", :name => "t_payer", :value => "1"}
          {{ csrf_field() }}
          %input{:type => "submit", :value => "Create"}