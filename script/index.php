<?php
/**
 * Created by PhpStorm.
 * User: OscarGarciaRuiz
 * Date: 24/05/15
 * Time: 22:44
 */
?>
<html>
<head>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
            xmlhttp.open('GET', 'insert.php?uname=' + uname + '&msg=' + msg, true);
            xmlhttp.send();


        }

        $(document).ready(function (e) {
            $.ajaxSetup({cache: false});
            setInterval(function () {
                $('#chatlogs').load('logs.php');
            }, 2000)
        });


    </script>

</head>
<body>

<form name="form1">
    <div id="chatlogs">
        Cargando conversacion espere porfavor....
    </div>
    <label for="name">Nick name</label>
    <input type="text" name="uname" id="name"><br>

    <label for="message"></label>
    <textarea id="message" name="msg"></textarea><br>

    <a href="#" onclick="submitChat()">Enviar</a>


</form>

</body>
</html>