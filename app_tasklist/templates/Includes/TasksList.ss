<% if $Tasks %>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Todo</th>
            <th>In Bearbeitung</th>
            <th> </th>
        </tr>
    </thead>
    <tbody class="ui-sortable main">
        <% loop $Tasks %>
        <tr id="$ID" class="ss-item">
            <td class="col-reorder"><span class="handle glyphicon glyphicon-move" aria-hidden="true"></span></td>
            <td>$Title</td>
            <td><% if $InDoing %><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><% end_if %></td>
            <td>
                <a href="tasklist/toggle/{$ID}" class="btn btn-primary<% if $InDoing %> active" title="In Bearbeitung"><span class="fa fa-toggle-on"></span><% else %>" title="Noch nicht in Bearbeitung"><span class="fa fa-toggle-off"></span><% end_if %></a>
                <a href="tasklist/delete/{$ID}?BackURL=$Up.URL" data-confirm="Todo wirklich löschen?" class="btn btn-danger" title="Todo löschen"><span class="glyphicon glyphicon-remove"></span></a>
            </td>
        </tr>
        <% end_loop %>
    </tbody>
</table>
<% if $Tasks.MoreThanOnePage %>
<div class="text-center">
    <ul class="pagination">
        <% if $Tasks.NotFirstPage %>
        <li><a class="prev ss-previouspage" href="$Tasks.PrevLink"><span class="glyphicon glyphicon-step-backward"></span></a></li>
        <% end_if %>
        <% loop $Tasks.PaginationSummary %>
        <% if $CurrentBool %>
        <li class="active "><a href="$Top.URL">$PageNum</a></li>
        <% else %>
        <% if $Link %>
        <li><a href="$Link">$PageNum</a></li>
        <% else %>
        <li><a href="#">...</a></li>
        <% end_if %>
        <% end_if %>
        <% end_loop %>
        <% if $Tasks.NotLastPage %>
        <li><a class="next ss-nextpage" href="$Tasks.NextLink"><span class="glyphicon glyphicon-step-forward"></span></a></li>
        <% end_if %>
    </ul>
</div>
<% end_if %>
<% else %>
<p>Du hast noch keine Todos angelegt.</p>
<% end_if %>
