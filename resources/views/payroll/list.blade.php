<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>給与の一覧</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>
    <span>前の月</span>　<span>10月</span>　<span>次の月</span>
</div>
<div>
    <table>
        <thead>
        <tr>
            <th>従業員番号</th>
            <th>氏名</th>
            <th>支払額</th>
            <th>備考</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees->list() as $employee)
        <tr>
            <td>{{ $employee->employeeNumber() }}</td>
            <td>{{ $employee->name() }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
