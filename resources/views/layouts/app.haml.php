<!DOCTYPE html>
%html
  %head
    %title Budgeter @yield('title')
    %link{:rel => "stylesheet", :type => "text/css", :href => "https://fonts.googleapis.com/css?family=Lato:100"}
    %link{:rel => "stylesheet", :type => "text/css", :href => "bundles/bundle.css"}
    %link{:rel => "stylesheet", :type => "text/css", :href => "css/app.css"}
    %script{:type => "text/javascript", :src => "bundles/bundle.js"}
    %script{:type => "text/javascript", :src => "js/app.js"}
  %body
    .center-container
      .content
        @yield('content')
