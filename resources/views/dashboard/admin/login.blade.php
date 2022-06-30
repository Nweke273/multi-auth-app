<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <style type="text/css">
        body,
        td,
        th {
            color: #000000;
        }

        body {
            background-color: #F0F0F0;
        }

        .style1 {
            font-family: arial, helvetica, sans-serif;
            font-size: 14px;
            padding: 12px;
            line-height: 25px;
            border-radius: 4px;
            text-decoration: none;
        }

        .style2 {
            font-family: arial, helvetica, sans-serif;
            font-size: 17px;
            padding: 12px;
            line-height: 25px;
            border-radius: 4px;
            text-decoration: none;

        }
    </style>
</head>

<body>

    <div class="container">
        <table width="100%" height="100%" border="0" cellspacing="0" align="center">
            <tr>
                <td align="center" valign="middle">
                    <table class="table-bordered" width="350" border="0" cellpadding="3" cellspacing="3"
                        bgcolor="#FFFFFF">
                        <form name="frm_login" id="frm_login">
                            @csrf
                            <tr>
                                <td height="25" colspan="2" align="left" valign="middle" bgcolor="#FF9900"
                                    class="style2">
                                    <div align="center">
                                        <strong>Admin Login</strong>
                                    </div>

                                </td>
                            </tr>

                            <tr>

                                <div id="err" style="color: red">


                                </div>

                            </tr>


                            <tr>
                                <td width="118" align="left" valign="middle" class="style1">Username</td>
                                <td width="118" align="left" valign="middle" class="style1">
                                    <input type="text" class="form-control" size="10px" id="username"
                                        placeholder="Username" name="username">
                                </td>

                            </tr>

                            <tr>
                                <td width="118" align="left" valign="middle" class="style1">Password</td>
                                <td width="118" align="left" valign="middle" class="style1">
                                    <input type="password" class="form-control" size="10px" id="password"
                                        placeholder="password" name="password">
                                </td>

                            </tr>



                            <tr>
                                <td colspan="2" align="right" valign="middle" class="style1">

                                    <button type="button" class="btn btn-primary" onclick="login()">Sign In</button>

                                </td>


                            </tr>

                        </form>
                    </table>

                </td>


            </tr>


        </table>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script>
        function login()
    {
        if($('#username').val() == "")
        {
            $('#username').parent('td').addClass('has-error');
            return false;
        }
        else if($('#password').val() == "")
        {
            $('#password').parent('td').addClass('has-error');
            return false;
        }
        else if($('#utype').val() == "")
        {
            $('#utype').parent('td').addClass('has-error');
            return false;
        }

        $email = $('#username').val()
        $pass = $('#password').val();
     

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                type : 'POST',
                url: '{{route('admin.check')}}',
                data : {
                    email:$email,
                    password:$pass
                },
            success : function(response)
            {
                console.log(response);
                if(response == 1)
                {
                    window.location.replace('{{route('admin.home')}}');
                }
                else if(response == 3)
                {
                    alert("Enter your correct login details")
                }
            }
        });
    }

    </script>

</body>


</html>