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