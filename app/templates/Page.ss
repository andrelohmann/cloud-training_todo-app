<!DOCTYPE html>
<html>
    <head>
        <% base_tag %>
        <title>Todo App</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="description" content="cloud-training - Todo Application" />
        $MetaTags(false)

    </head>
    <body id="page-top">
        <nav id="top-nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="top-navigation">
                    $BootstrapNavbarModalLoginForm
                    <% if $CurrentMember %>
                      <% include MemberNavbar %>
                    <% else %>
                      <% include SignupNavbar %>
                    <% end_if %>
                </div><!--/.navbar-collapse -->
            </div>
        </nav>
        $BootstrapNavbarModalLoginForm.Modal

        <% include BootstrapFlashMessage %>

        $Layout

        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bottom-navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <p class="navbar-text navbar-left">&copy; 2018</p>
                </div>

                <div class="collapse navbar-collapse" id="bottom-navigation">
                    <ul class="nav navbar-nav navbar-right">
                        <li><p class="navbar-text">Version $Release</p></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Latest compiled and minified JavaScript -->

        <!-- Javascript Required Layer -->
        <div id="js-required" style="position:fixed;top:0px;right:0px;bottom:0px;left:0px;background:rgba(0,0,0,0.5);z-index:10000;">
            <img src="/app/images/spiffygif_32x32.gif" style="position:absolute;top:50%;left:50%;margin-left:-16px;margin-top:-16px;" />
        </div>
        <!-- Latest compiled and minified JavaScript -->
    </body>
</html>
