<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pet Forum</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('frontend/css/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('frontend/css/ionicons.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('frontend/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('frontend/css/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{asset('frontend/fonts/font.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('backend/js/jquery-validation-1.19.2/demo/css/screen.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/stylesheet.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="{{asset('frontend/css/homestyle.css')}}"> -->
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{asset('frontend/css/plugin/bootstrap/css/bootstrap.min.css')}}">
</head>
<body class="hold-transition login-page" style = "background: #FFF6EA;">

<section class="header" id="header">
    {{--    Menu--}}
        <div class = "logo-field">
			<a href="{{url('home')}}">
                <div>
                    <img class="logo" src="{{asset('frontend/images/Logo.png')}}" alt="logo">
                    <img src="{{asset('frontend/images/PETforum.svg')}}" alt="logo">
                </div>
			</a>
		</div>
        <nav class = "nav-bar">
        <li class="menu dropdown">
            <div class = "dropdown-img">
                <a href="{{url('#')}}">
                    <img class = "catego" src="{{asset('frontend/images/dog.png')}}" alt="Dog">
                </a>
            </div>
            <div class="dropdown-content">
                <a href="{{url('/pets-category/dog/show-off')}}">Show off</a>
                <a href="{{url('/pets-category/dog/experience')}}">Experience</a>
                <a href="{{url('/pets-category/dog/give')}}">Give</a>
                <a href="{{url('/pets-category/dog/relief')}}">Relief</a>
                <a href="{{url('/pets-category/dog/meme')}}">meme</a>
            </div>
        </li>
        <li class="menu dropdown">
            <div class = "dropdown-img">
                <a href="{{url('#')}}">
                    <img class = "catego" src="{{asset('frontend/images/cat.png')}}" alt="Cat">
                </a>
            </div>
            <div class="dropdown-content">
                <a href="{{url('/pets-category/cat/show-off')}}">Show off</a>
                <a href="{{url('/pets-category/cat/experience')}}">Experience</a>
                <a href="{{url('/pets-category/cat/give')}}">Give</a>
                <a href="{{url('/pets-category/cat/relief')}}">Relief</a>
                <a href="{{url('/pets-category/cat/meme')}}">Meme</a>
            </div>
        </li>
        <li class="menu dropdown">
            <div class = "dropdown-img">
                <a href="{{url('#')}}">
                    <img class = "catego" src="{{asset('frontend/images/others.png')}}" alt="Others">
                </a>
            </div>
            <div class="dropdown-content">
                <a href="{{url('/pets-category/others/show-off')}}">Show off</a>
                <a href="{{url('/pets-category/others/experience')}}">Experience</a>
                <a href="{{url('/pets-category/others/give')}}">Give</a>
                <a href="{{url('/pets-category/others/relief')}}">Relief</a>
                <a href="{{url('/pets-category/others/meme')}}">Meme</a>
            </div>
        </li>
        </nav>
        <div class = "account">
            <div class="social">
				<a href="#"><img src="{{asset('frontend/images/Facebook.svg')}}" alt="facebook"></a>
				<a href="#"><img src="{{asset('frontend/images/Twitter.svg')}}" alt="twitter"></a>
				<a href="#"><img src="{{asset('frontend/images/Instagram.svg')}}" alt="instagram"></a>
			</div>
            <div class="acc">
                <?php
                use Illuminate\Support\Facades\Session;
                $user = Session::get('sUser');
                    if(isset($user)) {
                ?>
                    <li class="menu avatar"><img src="{{url('frontend/images/avatars/' . $user->avatar)}}" alt="avatar" id="avatar"></li>
                    <li class="menu dropdown name">
                        <a href="{{url('user/' . $user->id . '/info')}}">
                            <h1> {{$user->name}} </h1>
                        </a>
                        <div class="dropdown-content">

                            <a href="{{url('/post/create')}}">New post</a>
                            <a href="{{url('/me')}}">Your information</a>
                            <a href="{{url('/me/password')}}">Change password</a>
                            <a href="{{url('/logout')}}">Log out</a>
                        </div>
                    </li>
                <?php
                    } else {
                ?>
                    <a class="login-acc" href="{{url('login')}}">SIGN IN</a>
					<a class="signup-acc" href="{{url('signup')}}">SIGN UP?</a>
                <?php
                    }
                ?>
            </div>
        </div>
</section>

{{--Content--}}
@yield('content')

<!-- jQuery -->
<script src="{{asset('frontend/css/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('frontend/css/dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('frontend/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('backend/js/jquery-validation-1.19.2/lib/jquery.mockjax-2.2.1.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.js')}}"></script>

<script>
    $('.carousel').carousel();
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#searchInput').on('keyup',function() {
            let query = $(this).val();
            $.ajax({
                url: 'search',
                type: 'get',
                data: {'title': query},
                success:function (data) {
                    $('#searchedPosts').html(data);
                }
            })
            // end of ajax call
        });
        $('#searchButton').click(function (){
            let query = $("#searchInput").val();
            $.ajax({
                url: 'search',
                type: 'get',
                data: {'title': query},
                success:function (data) {
                    $('#searchedPosts').html(data);
                }
            })
            // end of ajax call
        });
    });
</script>

<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: "0d",
            changeYear: true,
            changeMonth: true,
            yearRange: "1980:2020"
        });
    });
</script>

<script src="{{asset('backend/js/jquery-validation-1.19.2/dist/jquery.validate.js')}}"></script>
<script>
    $("#editProfileForm").validate();
    $().ready(function () {
        $("#createPostSubmitButton").click(function (){
            $("#postContent").val($("#sampleEditor").html());
        });

        $(".editor-button").click(function (){
            if($(this).attr('id') === 'subScript' || $(this).attr('id') === 'superScript') {
                if($(this).attr('class') === "editor-button") {
                    $(this).attr('class', 'editor-button clicked');
                }
            } else if ($(this).attr('id') === 'insertOrderedlist' || $(this).attr('id') === 'insertUnorderedlist') {
                if($(this).attr('id') === 'insertOrderedlist') {
                    if($(this).attr('class') === 'editor-button') {
                        $(this).attr('class', 'editor-button clicked');
                        $("#insertUnorderedlist").attr('class', 'editor-button');
                    } else {
                        $(this).attr('class', 'editor-button');
                    }
                } else {
                    if($(this).attr('class') === 'editor-button') {
                        $(this).attr('class', 'editor-button clicked');
                        $("#insertOrderedlist").attr('class', 'editor-button');
                    } else {
                        $(this).attr('class', 'editor-button');
                    }
                }
            } else if($(this).attr('id') === 'undo') {
                // Do nothing
            } else if($(this).attr('id') === 'justifyLeft') {
                if($(this).attr('class') === 'editor-button') {
                    $("#justifyLeft").attr('class', 'editor-button clicked');
                    $("#justifyCenter").attr('class', 'editor-button')
                    $("#justifyRight").attr('class', 'editor-button')
                    $("#justifyFull").attr('class', 'editor-button')
                }
            } else if($(this).attr('id') === 'justifyRight') {
                if($(this).attr('class') === 'editor-button') {
                    $("#justifyRight").attr('class', 'editor-button clicked');
                    $("#justifyCenter").attr('class', 'editor-button')
                    $("#justifyLeft").attr('class', 'editor-button')
                    $("#justifyFull").attr('class', 'editor-button')
                }
            } else if($(this).attr('id') === 'justifyCenter') {
                if($(this).attr('class') === 'editor-button') {
                    $("#justifyCenter").attr('class', 'editor-button clicked');
                    $("#justifyLeft").attr('class', 'editor-button')
                    $("#justifyRight").attr('class', 'editor-button')
                    $("#justifyFull").attr('class', 'editor-button')
                }
            } else if($(this).attr('id') === 'justifyFull') {
                if($(this).attr('class') === 'editor-button') {
                    $("#justifyFull").attr('class', 'editor-button clicked');
                    $("#justifyCenter").attr('class', 'editor-button')
                    $("#justifyRight").attr('class', 'editor-button')
                    $("#justifyLeft").attr('class', 'editor-button')
                }
            } else {
                if($(this).attr('class') === "editor-button") {
                    $(this).attr('class', 'editor-button clicked');
                } else if ($(this).attr('class') === "editor-button clicked") {
                    $(this).attr('class', 'editor-button');
                }
            }
        });

        $("#subScript").dblclick(function (){
            $(this).attr('class', 'editor-button');
        });

        $("#superScript").dblclick(function (){
            $(this).attr('class', 'editor-button');
        });

        if(instanceOfKeyboardEvent.ctrlKey) {
            if($().key === 'b') {
                $("#bold").click();
            }
        };

        $("#changePasswordForm").validate({
            rules: {
                password: "required",
                new_password: {
                    required: true
                    // strongPassword: true
                },
                confirm_new_password: {
                    required: true,
                    // strongPassword: true
                    equalTo: "#new_password"
                }
            }
        })

        $("#editDeviceForm").validate({
            rules: {
                devicePrice: {
                    required: true,
                    number: true
                }
            }
        })

        $("#AddEditRequestForm").validate({
            rules: {
                reasonOfRequest: {
                    required: true,
                    minlength: 8
                }
            }
        })
    })
</script>
@if(isset($message))
    <script>alert({{$message}})</script>
@endif
</body>
<footer>
</footer>
</html>
