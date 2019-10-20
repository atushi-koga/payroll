<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ダッシュボード</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>ダッシュボード</div><br>
<div>
    <div><a href="{{ route('time-record-register#showForm') }}">勤務時間の入力</a></div>
    <div><a href="{{ route('payroll#list') }}">給与の一覧</a></div>
    <div><a href="{{ route('employees#list') }}">従業員の一覧</a></div>
</div>
</body>
</html>
