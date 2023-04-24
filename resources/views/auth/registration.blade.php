<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./style2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="login-page">
        
            <div class="form">
                <h4>Registration</h4>
                <form action="{{route('register-user')}}" method="POST">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="form-group">
                        
                        <input type="text" class="form-control" placeholder="Enter Full Name" name="name" value="{{old('name')}}">
                        <span class="text-danger">
                            @error('name') {{$message}} @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        
                        <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{old('email')}}">
                        <span class="text-danger">
                            @error('email') {{$message}} @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" value="{{old('password')}}">
                        <span class="text-danger">
                            @error('password') {{$message}} @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        
                        <input type="number" class="form-control" placeholder="Enter Phone Number" name="phone" value="{{old('phone')}}">
                        <span class="text-danger">
                            @error('phone') {{$message}} @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        
                        <input type="text" class="form-control" placeholder="Enter Address" name="address" value="{{old('address')}}">
                        <span class="text-danger">
                            @error('address') {{$message}} @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        
                        <input type="text" class="form-control" placeholder="Enter Gender" name="gender" value="{{old('gender')}}">
                        <span class="text-danger">
                            @error('gender') {{$message}} @enderror
                        </span>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-clock btn-primary" type="submit">SUBMIT</button>
                    </div>
                    <br>
                    <a href="adLogin">Already Registered !! Login Here</a>
                </form>
            </div>
    
    </div>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script2.js"></script>
</body>
</html>