<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>従業員情報の新規登録</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>
    <div>従業員情報の新規登録</div>
    <br>
    <div>
        <form method="post" action="{{ route('employees-register#confirm') }}">
            @csrf
            <div>
                <label for="name">名前</label>
                <input type="text" id="name" name="name">
            </div>
            <div>
                <label for="mail_address">メールアドレス</label>
                <input type="text" id="mail_address" name="mail_address">
            </div>
            <div>
                <label for="phone_number">電話番号</label>
                <input type="text" id="phone_number" name="phone_number">
            </div>
            <br>
            <div>
                <button type="submit">確認</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
