## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

https://www.slideshare.net/masuda220/ss-139660520

- [Simple, fast routing engine](https://laravel.com/docs/routing).

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Tighten Co.](https://tighten.co)**
- [UserInsights](https://userinsights.com)

# UseCase
- 従業員の一覧表示
従業員番号、氏名、現在の時給、開始日
現在の時給：
本日 > 契約開始日 であれば空文字、契約開始日 < 本日 であれば直近で適用されている時給を表示。
（未来で適用予定をしている時給が登録されていても表示はされない）
開始日：契約の開始日を表示。

一覧表示ボタンクリック
EmployeesController：

$contractingEmployees = EmployeeQueryService.contractingEmployees()：
EmployeeRepositoryInterface.findUnderContracts()：
EmployeeRepository.findUnderContracts()：
    return new ContractingEmployees(sql)
sql：
従業員ID、名前、メールアドレス電話番号をselect

$contracts = ContractQueryService.findContracts($contractingEmployees);

- 従業員情報の新規登録(入力->確認->完了)
名前、メールアドレス、電話番号

・以下テーブルにデータを登録
employees
employee_name_histories, employee_names, 
employee_email_histories, employee_emails, 
employee_phone_histories, employee_phones,
under_contract 

- 従業員情報の詳細表示
従業員番号、名前、メールアドレス、電話番号

- 時給の登録(入力->確認->完了)
開始日、時給

- 時給の履歴
開始日付、時給

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
