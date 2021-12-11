<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin|Home</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body style="background-color: #d7dadb">
    <div class="container">
        <h1>Admin Dashboard</h1>
        <hr>
        <table class="table table-striped table-inverse table-responsive">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>{{ Auth::guard('admin')->user()->name }}</td>
                <td>{{ Auth::guard('admin')->user()->email }}</td>
                <td>{{ Auth::guard('admin')->user()->phone }}</td>
                <td>
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a>
                        <form id="logout-form" action="{{route('admin.logout')}}" method="post" style="display: none">@csrf</form>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
