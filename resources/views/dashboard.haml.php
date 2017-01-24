%html
  %head
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
        %p {{ $user->name }} {{ $user->email }}

        //TODO: Try to echo all members in $members via some kind of HAML loop