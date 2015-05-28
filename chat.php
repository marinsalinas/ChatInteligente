<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Chat Inteligente</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Custom styles for this template -->
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
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
                }
            };

            form1.msg.value = '';
            xmlhttp.open('GET', 'insert.php?uname=' + uname + '&msg=' + msg, true);
            xmlhttp.send();


        }

        $(document).ready(function (e) {
            $.ajaxSetup({cache: false});
            setInterval(function () {
                $('.chatlogs').load('logs.php');
            }, 2000)
        });


    </script>

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                </div>
                <form name="form1">

                    <div class="panel-body" style="overflow-y: scroll;">
                        <div class="chatlogs" style="list-style-type: none;">
                            Cargando conversacion espere porfavor....
                        </div>

                    </div>
                    <div class="panel-footer">
                        <div>
                            <input type="text" name="uname" id="name" class="form-control input-sm"
                                   placeholder="Nickname"/>
                            <input type="text" id="message" name="msg" class="form-control input-sm"
                                   placeholder="Type your message here..."/>
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


<script src="js/bootstrap.min.js"></script>
</body>

</html>
