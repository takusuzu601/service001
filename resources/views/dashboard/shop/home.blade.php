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
        <h1>Shop Dashboard</h1>
        <hr>
        <table>
         
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>PhoneName</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>{{ Auth::guard('shop')->user()->name }}</td>
                <td>{{ Auth::guard('shop')->user()->email }}</td>
                <td>{{ Auth::guard('shop')->user()->phone_name }}</td>
                <td>
                    <a href="{{ route('shop.logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a>
                        <form id="logout-form" action="{{route('shop.logout')}}" method="post" style="display: none">@csrf</form>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
