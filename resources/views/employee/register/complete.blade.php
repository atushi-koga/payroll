<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>従業員情報の登録完了</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>
    <div>従業員情報の登録完了</div>
    <br>
    <div>
        <div>{{ $name }}</div>
        <div>{{ $employeeNumber }}</div>
    </div>
</div>
</body>
</html>
