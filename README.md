# index.spa.php

composer.json
```
{
    "repositories": [
    {
	"url": "git@github.com:bermud-ru/index.spa.php.git",
	"type": "git"
    }
    ],
    "require": {
	"bermud-ru/index.spa.php":"*@dev"
    },

    "scripts": {
	"post-install-cmd": [
	"./vendor/bermud-ru/index.spa.php/post-install"
	],
	"post-update-cmd": [
	"./vendor/bermud-ru/index.spa.php/post-update"
	]
    }
}
```

php.ini
```
; Always populate the $HTTP_RAW_POST_DATA variable. PHP's default behavior is
; to disable this feature and it will be removed in a future version.
; If post reading is disabled through enable_post_data_reading,
; $HTTP_RAW_POST_DATA is *NOT* populated.
; http://php.net/always-populate-raw-post-data

always_populate_raw_post_data = -1
```