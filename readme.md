## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Tighten Co.](https://tighten.co)**
- [UserInsights](https://userinsights.com)

# UseCase
- 従業員の一覧表示
従業員番号、氏名、現在の時給、開始日

一覧表示ボタンクリック
EmployeesController：
EmployeeQueryService.contractingEmployees()：
EmployeeRepositoryInterface.findUnderContracts()：
EmployeeRepository.findUnderContracts()：
    return new ContractingEmployees(sql)
sql：
従業員ID、名前、メールアドレス電話番号をselect

- 従業員情報の新規登録(入力->確認->完了)
名前、メールアドレス、電話番号

- 従業員情報の詳細表示
従業員番号、名前、メールアドレス、電話番号

- 時給の履歴

- 時給の登録(入力->確認->完了)
開始日、時給

- 給与の一覧表示
月、従業員番号、氏名、支払額、備考

- 選択月の勤務時間の一覧
日付、開始時刻、終了時刻、休憩時間、勤務時間

- 勤務時間の編集
名前、勤務日、開始時刻、終了時刻、休憩時間、休憩時間（深夜）

- 勤務時間の入力
名前、勤務日、開始時刻、終了時刻、休憩時間、休憩時間（深夜）

- 従業員の一覧表示
従業員番号、氏名、現在の時給、開始日

- 従業員情報の新規登録(入力->確認->完了)
名前、メールアドレス、電話番号

- 従業員情報の詳細表示
従業員番号、名前、メールアドレス、電話番号

- 時給の履歴

- 時給の登録(入力->確認->完了)
開始日、時給

- 給与の一覧表示
月、従業員番号、氏名、支払額、備考

- 選択月の勤務時間の一覧
日付、開始時刻、終了時刻、休憩時間、勤務時間

- 勤務時間の編集
名前、勤務日、開始時刻、終了時刻、休憩時間、休憩時間（深夜）

- 勤務時間の入力
名前、勤務日、開始時刻、終了時刻、休憩時間、休憩時間（深夜）
