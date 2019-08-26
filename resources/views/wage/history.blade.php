<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>時給の履歴</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>
    <div>時給の履歴</div>
    <br><br>
    <div>
        <table>
            <tr>
                <th>従業員番号</th>
                <td>{{ $employee->employeeNumber() }}</td>
            </tr>
            <tr>
                <th>氏名</th>
                <td>{{ $employee->name() }}</td>
            </tr>
        </table>
    </div>
    <br>
    <div>時給の登録</div>
    <br>
    <div>
        <table>
            <thead>
            <tr>
                <th>開始日付</th>
                <th>時給</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contractWages->list() as $contractWage)
                <tr>
                    <td>{{ $contractWage->startDate() }}</td>
                    <td>{{ $contractWage->hourlyWage() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div>
        <a href="{{ route('employees#detail', ['employeeNumber' => $employee->employeeNumber()]) }}">詳細に戻る</a>
    </div>
</div>
</body>
</html>
