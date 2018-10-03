
<ul class="nav navbar-nav navbar-right">
    <li class="<% if $URLTopic == tasklist %>active<% end_if %>"><a href="tasklist/index" title="Todo List"><span class="fa fa-clock-o" aria-hidden="true"></span></a></li>
    <li class="dropdown<% if $URLTopic == profile %> active<% end_if %>"><a href="#" title="Profil" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="<% if $URLSegment == passwordadmin %>active<% end_if %>"><a href="passwordadmin/index">Passwort ändern</a></li>
            <li class="<% if $URLSegment == emailadmin %>active<% end_if %>"><a href="emailadmin/index">Email ändern</a></li>
        </ul>
    </li>
</ul>
