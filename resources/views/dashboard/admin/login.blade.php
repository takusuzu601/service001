<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{asset('bootstrap.min.css')}}">
</head>
<body style="background-color: cornflowerblue">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4" style="margin-top: 45px">
                <h4>Admin Login</h4>
                <form action="{{route('admin.check')}}" method="post" autocomplete="off">
                    @if (Session::get('fail'))
                        <span>
                            {{Session::get('fail')}}
                        </span>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{old('email')}}">
                        <span style="color: white">
                            @error('email')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{old('password')}}">
                        <span style="color: white">
                            @error('password')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>
                    <br>
                    <a href="{{ route('user.register') }}">Create new Account</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>