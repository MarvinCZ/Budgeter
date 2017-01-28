<!DOCTYPE html>
%html{lang: "en"}
  %head
    %base{href: URL::asset('/')}
    %meta{charset: "utf-8"}
    %meta{content: "width=device-width, initial-scale=1", name: "viewport"}
    %meta{content: "{{ csrf_token() }}", name: "csrf-token"}
    %title @yield('title', 'Budgeter')
    %link{rel: "stylesheet", type: "text/css", href: "https://fonts.googleapis.com/css?family=Lato:100"}
    %link{rel: "stylesheet", type: "text/css", href: "bundles/bundle.css"}
    %link{rel: "stylesheet", type: "text/css", href: "css/app.css"}
    %script{type: "text/javascript", src: "bundles/bundle.js"}
    %script{type: "text/javascript", src: "js/app.js"}
  %body
    %nav.navbar.navbar-default.navbar-fixed-top
      .container
        .navbar-header
          %button.navbar-toggle.collapsed{"aria-controls" => "navbar", "aria-expanded" => "false", "data-target" => "#navbar", "data-toggle" => "collapse", :type => "button"}
            %span.sr-only Toggle navigation
            %span.icon-bar
            %span.icon-bar
            %span.icon-bar
          %a.navbar-brand{:href => "/"} Budgeter
        #navbar.navbar-collapse.collapse
          %ul.nav.navbar-nav
            - if(Auth::user())
              %li
                %a{href: route('home')} Home

          %ul.nav.navbar-nav.navbar-right
            - if(Auth::user())
              %li
                %a{href: '#'}
                  = Auth::user()->name
              %li
                %a{href: route('logout.post'), onclick: "event.preventDefault(); document.getElementById('logout-form').submit();"} Logout
                %form#logout-form{action: route("logout.post"), method: "POST", style: "display: none;"}
                  != csrf_field()
            - else
              %li
                %a{href: route("login.get")} Login
              %li
                %a{href: route("register.get")} Register

    .container.text-center
      .content
        @yield('content')
