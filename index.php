<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Google+ JavaScript Quickstart</title>
    <script src="https://apis.google.com/js/client:platform.js?onload=startApp" async defer></script>
    <!-- JavaScript specific to this application that is not related to API
       calls -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <meta name="google-signin-client_id"
          content="656002546542-qrmp1gj3s68s3tqoji0stlj2uf35d5n2.apps.googleusercontent.com"></meta>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="style.css" rel="stylesheet">
    <script>

        function submitChat() {

            if (form1.uname.value == '' || form1.msg.value == '') {

                alert('Todas los campos estan vacios');
                return;
            }

            form1.uname.readOnly = true;
            form1.uname.style.border = 'none';


            var uname = form1.uname.value;
            var msg = form1.msg.value;
            var image = form1.image.value;
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
                }
            };

            form1.msg.value = '';
            xmlhttp.open('GET', 'insert.php?uname=' + uname + '&msg=' + msg + '&image=' + image, true);
            xmlhttp.send();


        }
        $(document).ready(function (e) {
            $.ajaxSetup({cache: false});
            setInterval(function () {
                $('.chatlogs').load('logs.php');
                $('div.panel-body')[0].scrollTop = $('div.panel-body')[0].scrollHeight
            }, 2000)

            /*$(document).keypress(function(e) {
                if(e.which == 13) {
                    submitChat();
                }
            });*/

        });

        function runScript(e) {
            if (e.keyCode == 13) {
                submitChat();
                return false;
            }
        }

    </script>

</head>
<body>
<div id="gConnect">
    <div id="signin-button"></div>
</div>
<div id="authOps" style="display:none">

    <h2>Chat inteligente</h2>


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-comment"></span> Chat
                        <div class="btn-group pull-right">
                            <button class="alert-success" id="signOut" onclick="auth2.signOut()">Sign Out</button>

                            <button class="alert-success" id="disconnect">Desvincular tu cuenta de google+</button>

                        </div>
                    </div>
                    <form name="form1">

                        <div class="panel-body" style="overflow-y: scroll;">
                            <div class="chatlogs" style="list-style-type: none;">
                                Cargando conversacion espere porfavor....
                            </div>

                        </div>
                        <div class="panel-footer">
                            <div>
                                <input type="text" name="uname" id="uname" class="form-control input-sm"
                                       readonly/>
                                <input type="text" id="message" name="msg" class="form-control input-sm"
                                       placeholder="Type your message here..." onkeypress="runScript(event)"/>
                                <input type="text" name="image" id="image" hidden>
                        <span class="input-group-btn">
                            <a class="btn btn-warning btn-sm" id="btn-chat" href="#" onclick="submitChat()">
                                Enviar
                            </a>
                        </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<div id="loaderror">
    This section will be hidden by JQuery. If you can see this message, you
    may be viewing the file rather than running a web server.<br/>
    The sample must be run from http or https. See instructions at
    <a href="https://developers.google.com/+/quickstart/javascript">
        https://developers.google.com/+/quickstart/javascript</a>.
</div>
<script type="text/javascript">
    var auth2 = {};
    var helper = (function () {
        return {


            onSignInCallback: function (authResult) {
                $('#authResult').html('Auth Result:<br/>');
                for (var field in authResult) {
                    $('#authResult').append(' ' + field + ': ' +
                    authResult[field] + '<br/>');
                }
                if (authResult.isSignedIn.get()) {
                    $('#authOps').show('slow');
                    $('#gConnect').hide();
                    helper.profile();
                    helper.people();
                } else if (authResult['error'] ||
                    authResult.currentUser.get().getAuthResponse() == null) {
                    // There was an error, which means the user is not signed in.
                    // As an example, you can handle by writing to the console:
                    console.log('There was an error: ' + authResult['error']);
                    $('#authResult').append('Logged out');
                    $('#authOps').hide('slow');
                    $('#gConnect').show();
                }

                console.log('authResult', authResult);
            },

            /**
             * Calls the OAuth2 endpoint to disconnect the app for the user.
             */
            disconnect: function () {
                // Revoke the access token.
                auth2.disconnect();
            },

            /**
             * Gets and renders the currently signed in user's profile data.
             */
            profile: function () {
                gapi.client.plus.people.get({
                    'userId': 'me'
                }).then(function (res) {
                    var profile = res.result;
                    console.log(profile);
                    $('#profile').empty();
                    $('#profile').append(
                        $('<p><img src=\"' + profile.image.url + '\"></p>'));


                    var name = profile.displayName;
                    var image = profile.image.url;


                    $('#uname').val(name);
                    $('#image').val(image);

                    if (profile.emails) {
                        $('#profile').append('<br/>Emails: ');
                        for (var i = 0; i < profile.emails.length; i++) {
                            $('#profile').append(profile.emails[i].value).append(' ');
                        }
                        $('#profile').append('<br/>');
                    }
                    if (profile.cover && profile.coverPhoto) {
                        $('#profile').append(
                            $('<p><img src=\"' + profile.cover.coverPhoto.url + '\"></p>'));
                    }
                }, function (err) {
                    var error = err.result;
                    $('#profile').empty();
                    $('#profile').append(error.message);
                });
            }
        };
    })();

    /**
     * jQuery initialization
     */
    $(document).ready(function () {
        $('#disconnect').click(helper.disconnect);
        $('#loaderror').hide();
    });


    var updateSignIn = function () {
        console.log('update sign in state');
        if (auth2.isSignedIn.get()) {
            console.log('signed in');
            helper.onSignInCallback(gapi.auth2.getAuthInstance());
        } else {
            console.log('signed out');
            helper.onSignInCallback(gapi.auth2.getAuthInstance());
            location.reload();
        }
    }

    /**
     * This method sets up the sign-in listener after the client library loads.
     */
    function startApp() {
        gapi.load('auth2', function () {
            gapi.client.load('plus', 'v1').then(function () {
                gapi.signin2.render('signin-button', {
                    scope: 'https://www.googleapis.com/auth/plus.login',
                    fetch_basic_profile: false
                });
                gapi.auth2.init({
                    fetch_basic_profile: false,
                    scope: 'https://www.googleapis.com/auth/plus.login'
                }).then(
                    function () {
                        console.log('init');
                        auth2 = gapi.auth2.getAuthInstance();
                        auth2.isSignedIn.listen(updateSignIn);
                        auth2.then(updateSignIn());
                    });
            });
        });
    }
</script>

</body>
</html>
