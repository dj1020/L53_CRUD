# Laradiner 讀書會 - Laravel CRUD 手把手基礎教學 by 閃亮亮

* 有問題歡迎到 [Laravel.tw 台灣社群] 發問
* 我寫的超細，請耐心照步驟一步步做，寫這些遠比你實作起來更多更累啊…… 我真應該錄影片就好的
* 如果還是有看不懂的一定要問，碰到太多新手不敢問的，都新手了還不問只好永遠當新手

[Laravel.tw 台灣社群]: https://www.facebook.com/groups/laravel.tw/

## Step by Step 請開「終端機」或裝「iTerm2」來執行這些指令

#### Step 1. 下載 Laravel 專案，並用 artisan 啟動 web server 後打開首頁

* 有 `$` 開頭的表示要下的指令

1. 下載安裝 [Composer 按此](https://getcomposer.org/doc/00-intro.md)，如果你是 Mac/Linux 環境，就是下這些指令，一個 `$` 符號表示一行指令：
``` bash
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
$ php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"
```

2. 用 `$ php composer.phar -v` 或 `$ composer -v` 來確認你安裝成功了
3. 用 `$ php composer.phar` 裝成功的朋友，請自動將後續指令裡的 `composer` 置換成 `php composer.phar`
4. 建立 Laravel 專案 `$ composer create-project laravel/laravel L53_CRUD` 會下載 Laravel 原始碼到 L53_CRUD 專案資料夾
5. `$ cd L53_CRUD` 進入專案資料夾，沒特別說明的話後續指令都是在這資料夾下執行。
6. (optional) 如果你是用 `$ php composer.phar` 跑 composer 的人，記得把 `composer.phar` 檔複製一份到專案資料夾裡 `$ cp ../composer.phar ./`
7. 執行 `$ php artisan`，如果沒有錯誤訊息，就是 Laravel 裝好了
8. 如果有問題，可能是 Laravel 相依的 PHP 套件還沒裝好，下 `$ composer install` 來安裝
9. 執行 `$ php artisan serve` 並打開 <http://localhost:8000/> 應該可以看到 Laravel 專案初始的首頁
10. 按 `<command> + c` (Windows: `<ctrl> + c`) 可以終止 `artisan serve` 產生的 Web Server

#### Step 2. 建立「聯絡我們」表單

* 請練習看 commit 做了什麼事，有問題歡迎拿 commit 的 url 到 [Laravel.tw 台灣社群] 發問

1. 利用 `php artisan serve` 啟動 Web Server，並開啟 Laravel 首頁 <http://localhost:8000/>
2. 在 `routes/web.php` 裡增加 route `GET /contactUs`，並指向 `ContactUsController@index`
3. 打開 <http://localhost:8000/contactUs> 認識一下找不到 `ContactUsController@index` 時的錯誤訊息
4. 下指令建 controller `$ php artisan make:controller ContactUsController`
5. 增加 index method 在 controller 裡，並 `return 'This is Contact Us Page.';`
6. 測試 route 和 controller，重新整理 <http://localhost:8000/contactUs> 應該可以看到 `This is Contact Us Page.`
7. 修改 index method 回傳 `return view('contact.index');` 對應的檔案是 `resources/views/contact/index.blade.php`
8. 重新整理 <http://localhost:8000/contactUs> 認識一下找不到 `resources/views/contact/index.blade.php` 時的錯誤訊息
9. 手動建立 `resources/views/contact/index.blade.php` 檔，內容放 `This is conatct us view file.` 就好
10. 重新整理 <http://localhost:8000/contactUs> 應該會看到 `This is conatct us view file.`
11. 在 `contact/index.blade.php` 裡寫一般的 HTML，但 CSS 要放在 `public/css` 下，JS 要放在 `public/js` 下，引用時開頭要加 `/`
12. 舉例，要引用 `jquery.min.js` 請下載後放在 `public/js` 下；要引用 `bootstrap.min.css` 請下載後放在 `public/css` 下，在 `contact/index.blade.php` 裡這樣寫：
``` html
<link rel="stylesheet" href="/css/bootstrap.min.css" />
<script src="/js/jquery.min.js"></script>
```

13. 重新整理 <http://localhost:8000/contactUs> 看到「聯絡我們」表單 UI

#### Step 3. 牛刀小試，表單 POST 傳送資料到後端並顯示

1. 聯絡我們表單舉例，重點在 `action="/submitContact"` 和 `method='POST'`
```
<form action="/submitContact" method="POST">
    // 中間略
    <button type="submit">送出</button>
</form>
```
2. 到 <http://localhost:8000/contactUs> 輸入假資料按 `送出` 試試，認識一下找不到 `POST /submitContact` 時的錯誤訊息
3. 在 route 中加入 `POST /submitContact` 並指向 `ContactUsController@store`
4. 在 `ContactUsController` 中新增 `store` method 來處理 POST 進來的資料
5. 在 `store` method 中寫 `dd( request()->all() );` 可以 die & dump 所有 POST 進來的資料，用做 debug
6. 再回到 <http://localhost:8000/contactUs> 輸入假資料按 `送出`，認識一下 `TokenMismatchException` 的錯誤訊息
7. 在表單加入 `{{ csrf_field() }}`，如下：
```
<form action="/submitContact" method="POST">
    {{ csrf_field() }}
    // 中間略
    <button type="submit">送出</button>
</form>
```

8. 再回到 <http://localhost:8000/contactUs> 輸入假資料按 `送出`，畫面上應該會出現你剛剛輸入的資料了。

#### Step 4. 資料庫連線和測試

1. 建立 `l53_crud` 資料庫
2. 建立 `homestead` 使用者，設密碼為 `secret`
3. (重要) 把 `l53_crud` 資料庫的權限開給 `homestead` 使用者，先權限全開吧
4. 編輯 `L53_CRUD/.env` 檔

``` bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=l53_crud
DB_USERNAME=homestead
DB_PASSWORD=secret
```


5. 記得如果你是用 `$ php artisan serve` 開發，請關掉重啟才會讀取到新的 `.env` 設定
6. 建議先用一般的 MySQL client (ex: Sequel Pro) 程式連連看資料庫，連得上的話，照著設定一定也會可以連得上。
7. 執行 `php artisan migrate` 如果沒有錯誤訊息就表示 Laravel 連線資料庫正常，並用 MySQL client 檢查資料庫(i.e. database, 或簡稱 DB) 中多了哪些 tables
8. 用 Mac 的人可以裝 MAMP，但預設的 Port 是 8889，用 Open WebStart Page 可以看到資料庫相關設定
9. 用 Windows 的人可以裝 XAMPP / WAMP 等，或是裝 Wagon 一次搞定開發環境，請[參考這裡](http://www.laravel-dojo.com/opensource/wagon)

## Step 5. 建立 Laravel Migration 和 Model 用來建立及存取 DB table

* 剛剛你在 MySQL client 裡應該會看到 users、password\_reset、migrations 三個 tables，其中 users 和 password_reset 表是透過這些 migration 檔來建立的：
    - `database/migrations/2014_10_12_000000_create_users_table.php`
    - `database/migrations/2014_10_12_100000_create_password_resets_table.php`

* 現在，我們要建我們自己的 migration 檔，透過 migration 檔在 DB 中建 table

1. `$ php artisan make:model Contact -m` 會做兩件事
    - 產生新的 migration 檔在 `database/migrations/2016_09_XX_XXXXXX_create_contacts_table.php`
    - 產生新的 model 檔在 `app/Contact.php`
2. 編輯 `2016_09_XX_XXXXXX_create_contacts_table.php` 檔，檔名打 X 的部份是會隨時間改變的，可忽略，把「聯絡我們」表單中要存的欄位建立起來：
``` php
    Schema::create('contacts', function (Blueprint $table) {
        $table->increments('id');

        $table->string('firstName');
        $table->string('lastName');
        $table->string('email');
        $table->string('phone')->nullable();
        $table->string('message');

        $table->timestamps();
    });
```

4. 再執行 `$ php artisan migrate`，然後再用 MySQL client 檢查資料庫，你的 `contacts` table 應該就建好了
5. (資料表所有資料會不見唷！！！) 要清掉重建所有 tables 可以用 `$ php artisan migrate:refresh`
6. 只是清掉不重建 `$ php aritsan migrate:reset`

* Live Demo Only: `Tinker` 的用法，並示範利用 Model 存取資料表資料 So Easy~

## Step 6. 把「聯絡我們」表單收到的資料存進 DB

1. 注意 namespace，記得是用 `\App\Contact` 來使用 Model，不然就需要用 `use App\Contact;`
2. 編輯 `ContactUsController@store` 將 POST 進來的資料存進資料庫
``` php
    public function store()
    {
        var_dump(request()->all());

        $newContact = new \App\Contact();
        $newContact->firstName = request()->get('name');
        $newContact->lastName = request()->get('surname');
        $newContact->email = request()->get('email');
        $newContact->phone = request()->has('phone') ? request()->get('email') : '';
        $newContact->message = request()->get('message');
        $newContact->save();
    }
```

3. Live Demo Only: 介紹 `MassAssignmentException` 和 `Contact::create([...]);` 及 `$fillable` 屬性
4.




