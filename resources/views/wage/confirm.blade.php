<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>時給の登録の確認</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>
    <div>時給の登録の確認</div>
    <br>
    <div>
        <form method="post" action="{{ route('wages-register#registerThenRedirect', ['employeeNumber' => $employee->employeeNumber()]) }}">
            @csrf
            <div>
                <label for="name">名前：{{ $employee->name() }}</label>
            </div>
            <div>
                <div for="hourly-wage">時給：{{ $hourlyWage->value() }}</div>
                <input type="hidden" id="hourly-wage" name="hourly_wage" value="{{ $hourlyWage->value() }}">
            </div>
            <div>
                <div for="start-date">開始日：{{ $startDate }}</div>
                <input type="hidden" id="start-date" name="start_date" value="{{ $startDate }}">
            </div>
            <br>
            <button type="submit">登録</button>
        </form>
    </div>
</div>
</body>
</html>
