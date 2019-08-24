<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>従業員情報の詳細</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>
    <div>従業員情報の詳細</div>
    <br>
    <div>
        <a>時給の履歴</a>
    </div>
    <div>
        <div>
            <div>名前：{{ $employee->employeeNumber() }}</div>
        </div>
        <div>
            <div>名前：{{ $employee->name() }}</div>
        </div>
        <div>
            <div>メールアドレス：{{ $employee->mailAddress() }}</div>
        </div>
        <div>
            <div>電話番号：{{ $employee->phoneNumber() }}</div>
        </div>
    </div>
</div>
</body>
</html>
