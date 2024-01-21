# Event Management Platform

## Introduction
The app facilitates event organization by allowing admins to configure event details on the homepage, sell tickets for various passes, scan tickets QR codes, manage sponsors. Writers contribute articles to the blog. Super admin register other admins and writers. 

## Usage (development)

1. Start Docker
2. Run `docker compose up`
3. Visit http://127.0.0.1:80

## Technologies
- Laravel 10
- PHP 8.0
- Mysql 5.7
- Redis
- Composer:
    - [spatie/laravel-permission](https://spatie.be/docs/laravel-permission/v5/introduction)
    - [tightenco/ziggy](https://github.com/tighten/ziggy)
    - [spatie/flysystem-dropbox](https://github.com/spatie/flysystem-dropbox)
- NPM:
    - Vue 3 (composition api)
    - Vue-router
    - SASS
    - Axios
- Other:
    - [CKEditor5](https://ckeditor.com/)

## Dropbox
[Dropbox](https://www.dropbox.com/home) is used to store the user images.
- [API documentation.](https://www.dropbox.com/developers/documentation/http/documentation)
- [To make it works.](https://github.com/spatie/flysystem-dropbox/issues/86)
- [How to get credentials.](https://gist.github.com/phuze/755dd1f58fba6849fbf7478e77e2896a)
- To get DROPBOX_ACCESS_CODE:
    - https://www.dropbox.com/oauth2/authorize?client_id=<YOUR_APP_KEY>&response_type=code&token_access_type=offline
- To get DROPBOX_REFRESH_TOKEN:
    - curl https://api.dropbox.com/oauth2/token -d code=<ACCESS_CODE> -d grant_type=authorization_code -u <APP_KEY>:<APP_SECRET>