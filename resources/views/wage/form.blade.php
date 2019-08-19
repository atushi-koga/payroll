<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>時給の新規登録</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>
    <div>時給の新規登録</div>
    <br>
    <div>
        <form method="post" action="{{ route('wages-register#confirm', ['employeeNumber' => $employee->employeeNumber()]) }}">
            @csrf
            <div>
                <label for="name">名前：{{ $employee->name() }}</label>
            </div>
            <div>
                <label for="hourly-wage">時給</label>
                <input type="text" id="hourly-wage" name="hourly_wage" value="{{ $hourlyWage->value() }}">
            </div>
            <div>
                <label for="start-date">開始日</label>
                <input type="text" id="start-date" name="start_date" value="">
                <div>yyyy-mm-dd</div>
            </div>
            <br>
            <button type="submit">確認</button>
        </form>
    </div>
</div>
</body>
</html>
