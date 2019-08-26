<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>従業員の一覧</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>
    <div>従業員の一覧</div>
    <br>
    <div>
        <a href="{{ route('employees-register#showForm') }}">従業員の新規登録</a>
    </div>
    <br>
    <br>
    <div>
        <table>
            <thead>
            <tr>
                <th>従業員番号</th>
                <th>氏名</th>
                <th>現在の時給</th>
                <th>開始日</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contracts->list() as $contract)
                <tr>
                    <td>{{ $contract->employeeNumber() }}</td>
                    <td>
                        <a href="{{ route('employees#detail', ['employeeNumber' => $contract->employeeNumber()]) }}">{{ $contract->employeeName() }}</a>
                    </td>
                    <td>{{ $contract->todayHourlyWage() }}</td>
                    <td>{{ $contract->contractStartingDate() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
