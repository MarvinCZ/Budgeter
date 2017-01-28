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
    %nav
      %a{href: "/"} Landing Page
      - if(Auth::user())
        Logged as {{ Auth::user()->name }}
        %a{href: route('home')} Home
        %a{href: route('logout.post'), onclick: "event.preventDefault(); document.getElementById('logout-form').submit();"} Logout
        %form#logout-form{action: route("logout.post"), method: "POST", style: "display: none;"}
          {{ csrf_field() }}
      - else
        %a{href: route("login.get")} Login
        %a{href: route("register.get")} Register
    .container.text-center
      .content
        @yield('content')
