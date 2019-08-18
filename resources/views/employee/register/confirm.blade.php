<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>従業員情報の登録の確認</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>
    <div>従業員情報の登録の確認</div>
    <div>従業員情報を登録します。 確認の上、登録するボタンを押してください。</div>
    <br>
    <div>
        <form method="post" action="{{ route('employees-register#registerThenRedirect') }}">
            @csrf
            <div>
                <div>名前：{{ $newEmployee->name() }}</div>
                <input type="hidden" value="{{ $newEmployee->name() }}" name="name">
            </div>
            <div>
                <div>メールアドレス：{{ $newEmployee->mailAddress() }}</div>
                <input type="hidden" value="{{ $newEmployee->mailAddress() }}" name="mail_address">
            </div>
            <div>
                <div>電話番号：{{ $newEmployee->phoneNumber() }}</div>
                <input type="hidden" value="{{ $newEmployee->phoneNumber() }}" name="phone_number">
            </div>
            <br>
            <div>
                <button type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
