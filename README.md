# wordpress-boilerplate

wordpressの開発環境です。


## Build Setup

```bash
# 開発開始 (wordpress mysql nodeを発火)
$ make start

# 開発開始 (nodeのみ発火)
$ yarn start

# 開発終了(wordpress mysql)
$ make kill
```

## Structure

```sh
.
├── dist                # 開発ファイルの書出先
├── node                # gulp、webpackなどの設定
├── production          # 本番環境向けのファイル書出先
├── src                 # 実際に手を動かすファイル
└── db-data             # データベースデータ
```
