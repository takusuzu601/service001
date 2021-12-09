<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body>
    <div class="container">
        <h1>user Dashboard</h1>
        <hr>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>{{ Auth::guard('web')->user()->name }}</td>
                <td>{{ Auth::guard('web')->user()->email }}</td>
                <td>
                    <a href="{{ route('user.logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a>
                        <form id="logout-form" action="{{route('user.logout')}}" method="post" style="display: none">@csrf</form>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
