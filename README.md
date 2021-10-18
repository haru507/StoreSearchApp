# StoreSearchApp

docker-compose.ymlがあるファイル内で
```$ mkdir mysql nginx php```

でフォルダを作成してください。

``` $ docker-compose up -d ``` で全て起動するかと思います。
※環境にもよりますが、多少時間がかかります。

あと、www/html/signs/config.php に「DBのユーザ」と「パスワード」と「DBのIPアドレス」を入力してください。
DBのIPアドレスについては下記のページを参照してください。
[Docker設定](https://qiita.com/saken649/items/00e752d89f2a6c5a82f6)

HotPepper API と GoogleMapsAPI の API Keyは各自取得してファイルに適用してください。
