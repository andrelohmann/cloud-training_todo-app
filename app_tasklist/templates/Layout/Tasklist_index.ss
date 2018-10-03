<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1>$Title</h1>
            $Content
            $Form
            <% if $CurrentMember.Tasks %>
            <ul>
            <% loop $CurrentMember.Tasks %>
            <li>$Title</li>
            <% end_loop %>
            </ul>
            <% end_if %>
        </div>
    </div>
</div>
