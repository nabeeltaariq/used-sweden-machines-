<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>USM-Login</title>

    <script

  src="https://code.jquery.com/jquery-3.4.1.min.js"

  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="

  crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js?render=6LeZq9gUAAAAAEG6mWFXj3o_k0h35O8otcNK7ftL"></script>
</head>

<body>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->



<div class="simple-login-container">

    <h2>Used Sweden Machines</h2>

    <br/><br/>

    <h6>Please Log In...</h6>

    <form method="post" action="">

        <div class="row">

            <div class="col-md-12 form-group">

                <input type="text" class="form-control" name="username" placeholder="Username">

            </div>

        </div>

        <div class="row">

            <div class="col-md-12 form-group">

                <input type="password" placeholder="Password" name="password" class="form-control">

            </div>

        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="token" id="token">
        </div>

        <div class="row">

            <div class="col-md-12 form-group">

                <input type="submit" class="btn btn-block btn-login" value="Log In">

            </div>

        </div>

    </form>

    <div class="row">

        <div class="col-md-12">

            <p align="center">

                Powered By Trepak International &copy; {{date("Y")}}

            </p>

            @if(isset($error))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <strong>Sorry!</strong> It looks like you have wrongly entered either username or password

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

              @endif

              @if(Request::session()->has("error"))



              <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <strong>Error!</strong> {{Request::session()->get("error")}}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>



              @endif



        </div>



    </div>

</div>

<script>

    $(".alert").alert('close')

</script>

<style>

    body{

    background-color:#034375;

    font-size:14px;

    color:#fff;

}

.simple-login-container{

    width:300px;

    max-width:100%;

    margin:50px auto;

}

.simple-login-container h2{

    text-align:center;

    font-size:20px;

}



.simple-login-container .btn-login{

    background-color:#FF5964;

    color:#fff;

}

a{

    color:#fff;

}

</style>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LeZq9gUAAAAAEG6mWFXj3o_k0h35O8otcNK7ftL', {action: 'homepage'}).then(function(token) {
          document.getElementById("token").value = token;
        });
    });
    </script>
</body>

</html>
