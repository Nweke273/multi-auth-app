<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Register</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4" style="margin-top: 45px;">
                <h4 style="background-color: rgb(255, 153, 0); text-align:center; padding:10px; font-family: Poppins,sans-serif;
                  font-size: .8125rem;
                  font-weight: 800; border-radius:4px">Admin Register</h4>
                <hr>
                <form autocomplete="off">
                    @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif

                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter full name"
                            value="{{ old('name') }}">
                        <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email"
                            placeholder="Enter email address" value="{{ old('email') }}">
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Enter password" value="{{ old('password') }}">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" id="cpassword"
                            placeholder="Enter password" value="{{ old('password') }}">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">

                        <button type="button" class="btn btn-primary" onclick="register()">Sign In</button>
                    </div>
                    <br>
                    <a href="{{ route('user.login') }}">I already have an account</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script>
    function register() {
        if ($('#name').val() == "") {
            $('#name').parent('td').addClass('has-error');
            console.log("Empty field not allowed")
            return false;
        } else if ($('#email').val() == "") {
            console.log("Empty field not allowed")
            $('#email').parent('td').addClass('has-error');
            return false;
        } else if ($('#password').val() == "") {
            console.log("Empty field not allowed")
            $('#password').parent('td').addClass('has-error');
            return false;
        } else if ($('#cpassword').val() == "") {
            console.log("Empty field not allowed")
            $('#cpassword').parent('td').addClass('has-error');
            return false;
        } else if ($('#utype').val() == "") {
            $('#utype').parent('td').addClass('has-error');
            return false;
        }

        $name = $('#name').val()
        $email = $('#email').val()
        $pass = $('#password').val();
        $cpassword = $('#cpassword').val();




        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '{{ route('
            admin.create ') }}',
            data: {
                name: $name,
                email: $email,
                password: $pass,
                cpassword: $cpassword

            },
            success: function(response) {
                console.log(response);
                if (response == 1) {
                    window.location.replace('{{route('
                        admin.home ')}}');
                } else if (response == 3) {
                    $("#err").hide().html("Username or Password  Incorrect. Please Check").fadeIn('slow');
                }
            }
        });
    }
    </script>
    </script>
</body>

</html>