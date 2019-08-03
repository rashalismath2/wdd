<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['user']}}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    @php
        $email=null;
        $password=null
    @endphp
    @if (count($errors)>0)
         
        @foreach ($errors->all() as $error)
            @if (in_array('email',explode(' ',$error)))
                @php
                    $email=$error
                @endphp
            @else 
                @php
                    $password=$error
                @endphp
            @endif
        @endforeach       
    @endif

    <div id='v-login'>
        <nav class="navbar navbar-expand-lg text-white" id='login-nav'>
            <h2 ><a class="navbar-brand" href="{{route('login-navigate')}}"><b>BRMS</b></a></h2>
        </nav>

        <div id='login-form' class='d-flex align-items-center justify-content-center'>
            <div class="card">
                <div class="card-header d-flex">
                  <i class="fas fa-user-circle fa-2x mr-2"></i>
                  <span class="align-self-center"><strong>{{$data['user']}}</strong></span>
                </div>
                <div class="card-body justify-content-center align-content-between d-flex">
                    <div class="align-self-center mr-5">
                        <i class="fas fa-user-lock fa-5x"></i>
                    </div>
                    <div class="align-self-center">
                        <form action="{{route($data['route'])}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="my-input">Email</label>
                                <input v-bind:lazy='email' name='email' value="{{old('email')}}" id="my-input" placeholder='Email' class="form-control" type="text">
                                @if ($email)
                                    <p class="text-red">{{$email}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="my-input">Passwords</label>
                                <input v-bind:lazy='password' name='password'  id="my-input" placeholder='Password' class="form-control" type="text">
                                @if ($password)
                                    <p class="text-red">{{$password}}</p>
                                @endif
                            </div>
                            <div class="form-group d-flex justify-content-center align-content-center">
                                <input id='login-button' type="submit" value="Login" class="btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer id='footer' class="text-white">
            <p class="my-0 ">© British College of Applied Studies All Rights Reserved.</p>
        </footer>
    </div>
</body>
</html>