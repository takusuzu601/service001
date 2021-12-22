<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
</head>
<body>

<h1 class="font-bold">WebService TopPage
</h1>
<form action="{{route('site_search')}}" method="get">
    @csrf
    {{$prefs}}
<div class="form-group">
    <select name="pref" id="">
        <option value="">地域を選択</option>
        @foreach ($prefs as $pref)
            <option value="{{$pref->name}}">{{$pref->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <select name="" id="">
        <option value="">ジャンルを選択</option>
    </select>
</div>
<button type="submit"
class="bg-red-500 hover:bg-gredient-light text-white font-bold py-2 px-10 rounded">検索</button>
</form>


<livewire:top-page>
    @livewireScripts
</body>
</html>