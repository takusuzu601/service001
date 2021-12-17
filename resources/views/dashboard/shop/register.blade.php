<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop Document</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4" style="margin-top: 45px">
                <h4>Shop Register</h4>
                {{-- autocomplete="off" フォームの自動補完の無効化 --}}
                <form action="{{ route('shop.create') }}" method="post" autocomplete="off">
                    @if (Session::get('success'))
                        <div style="color:white;background-color: red;">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::get('fail'))
                        <div style="color:white;background-color: red;">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter full name"
                            value="{{ old('name') }}">
                        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter email address"
                                value="{{ old('email') }}">
                            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="shop_phone">Shop_phone</label>
                                <input type="text" class="form-control" name="shop_phone" placeholder="Enter shop_phone"
                                    value="{{ old('shop_phone') }}">
                                <span class="text-danger">@error('shop_phone'){{ $message }}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter password"
                                        value="{{ old('password') }}">
                                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password</label>
                                        <input type="password" class="form-control" name="cpassword"
                                            placeholder="Enter Confirmpassword" value="{{ old('cpassword') }}">
                                        <span class="text-danger">@error('cpassword'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Register
                                            </button>
                                        </div>
                                        <br>
                                        <a href="{{ route('shop.login') }}">I rlready an account</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </body>

                    </html>
