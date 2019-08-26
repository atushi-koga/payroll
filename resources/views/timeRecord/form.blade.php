<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>勤務時間の入力</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<div>
    <div>勤務時間の入力</div>
    <br>
    <div>
        <form method="post" action="{{ route('time-record-register#registerThenRedirect') }}">
            @csrf
            <div>
                <label for="name">名前</label>
                <select id="name" name="employee_no">
                    <option value="">選択してください</option>
                    @foreach($employees->list() as $employee)
                        <option value="{{ $employee->employeeNumber() }}">{{ $employee->name() }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="work-day">勤務日</label>
                <input type="text" id="work-day" name="work_date">(yyyy-mm-dd)
            </div>
            <div>
                <div>開始時刻</div>
                <input type="text" id="start-hour" name="start_hour">時
                <input type="text" id="start-minute" name="start_minute">分
            </div>
            <div>
                <div>終了時刻</div>
                <input type="text" id="end-hour" name="end_hour">時
                <input type="text" id="end-minute" name="end_minute">分
            </div>
            <div>
                <label>休憩時間</label>
                <input type="text" id="daytime-break-time" name="daytime_break_time">分
            </div>
            <div>
                <label>休憩時間（深夜）</label>
                <input type="text" id="midnight-break-time" name="midnight_break_time">分
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
