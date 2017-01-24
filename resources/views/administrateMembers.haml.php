%html
  %head
    %base(href="/" target="_top")
    %title Budgeter
    %link{:rel => "stylesheet", :type => "text/css", :href => "https://fonts.googleapis.com/css?family=Lato:100"}
    %link{:rel => "stylesheet", :type => "text/css", :href => "bundles/bundle.css"}
    %link{:rel => "stylesheet", :type => "text/css", :href => "css/app.css"}
    %script{:type => "text/javascript", :src => "bundles/bundle.js"}
    %script{:type => "text/javascript", :src => "js/app.js"}
  %body
    .center-container
      .content
        .title Administrate Members
        %form(method="post" action="/group/#{$group->id}/remove-members")
          %input(type="checkbox" name="member" value="#{$members[0]->id}") {{$members[0]->name}}
          %br
          %input(type="checkbox" name="member" value="#{$members[1]->id}") {{$members[1]->name}}
          %br
          %input(type="checkbox" name="member" value="#{$members[2]->id}") {{$members[2]->name}}
          %br
          %input(type="submit")

        //TODO: form for adding new members