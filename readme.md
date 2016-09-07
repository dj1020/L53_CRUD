# Laradiner 讀書會 - Laravel CRUD 手把手基礎教學 by 閃亮亮

* 有問題歡迎到 [Laravel.tw 台灣社群] 發問
* 我寫的超細，請耐心照步驟一步步做，我真應該錄影片的
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
<script src="/js/jquery.min.js"></script>
<link rel="stylesheet" href="/css/bootstrap.min.css" />
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
6. 再回到 <http://localhost:8000/contactUs> 輸入假資料按 `送出`，認識一下 `TokenMissMatched` 的錯誤訊息
7. 在表單加入 `{{ csrf_field() }}`，如下：
```
<form action="/submitContact" method="POST">
    {{ csrf_field() }}
    // 中間略
    <button type="submit">送出</button>
</form>
```

8. 再回到 <http://localhost:8000/contactUs> 輸入假資料按 `送出`，畫面上應該會出現你剛剛輸入的資料了。

#### Step 5. 表單 POST 傳送資料到後端並顯示





