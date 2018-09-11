
<!DOCTYPE html>
<html>


<!-- Mirrored from dreamguys.co.in/preadmin/orange/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 10 Sep 2018 08:54:45 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="https://dreamguys.co.in/preadmin/orange/assets/img/favicon.png">
    <title>Preadmin - Bootstrap Admin Template</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://dreamguys.co.in/preadmin/orange/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://dreamguys.co.in/preadmin/orange/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://dreamguys.co.in/preadmin/orange/assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="https://dreamguys.co.in/preadmin/orange/assets/js/html5shiv.min.js"></script>
		<script src="https://dreamguys.co.in/preadmin/orange/assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="account-page">
            <div class="container">
                <h3 class="account-title">Login</h3>
                <div class="account-box">
                    <div class="account-wrapper">
                        <div class="account-logo">
                            <a href="index.html"><img src="https://dreamguys.co.in/preadmin/orange/assets/img/logo2.png" alt="Preadmin"></a>
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group form-focus">
                                <label class="focus-label">Username</label>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                <input class="form-control floating" name="username" type="text" required>
                            </div>
                            <div class="form-group form-focus">
                                <label class="focus-label">Password</label>
                                <input class="form-control floating" name="password" type="password">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary btn-block account-btn" type="submit">Login</button>
                            </div>
                            <div class="text-center">
                                <a href="forgot-password.html">Forgot your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://dreamguys.co.in/preadmin/orange/assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="https://dreamguys.co.in/preadmin/orange/assets/js/popper.min.js"></script>
    <script type="text/javascript" src="https://dreamguys.co.in/preadmin/orange/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://dreamguys.co.in/preadmin/orange/assets/js/app.js"></script>
</body>


<!-- Mirrored from dreamguys.co.in/preadmin/orange/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 10 Sep 2018 08:54:46 GMT -->
</html>