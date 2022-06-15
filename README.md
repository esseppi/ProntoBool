# pronto bool

**------ambiente-----**
- framework
    1. laravel 8

- linguaggi 
    1. php 8.0.2
    1. JS

- package.json 
    1. vue-route 3.5.4
    1. vuetify 2.6.6
    1. vuetify-loader 1.7.3

**--DEV mode--**
<code> composer require barryvdh/laravel-debugbar --dev </code>

**--laravel--**
<code>composer require laravel/ui:^2.4</code>
<code>php artisan ui vue --auth</code>

**--terminal code--**
<code>composer update </code>
<code>composer install </code>
<code>npm install</code>
<code>composer dump-autoload</code>
<code>php artisan key:generate</code>

**-----DB----**
    **users**
        - id
        - name
        - email
        - password
    **lead**
        - name
        - email
        - message
        - phone 
        - profile_id (fk)
    **profesion**
        - name (type of profesion)
    **profile**
        - curriculum
        - pic
        - phone
        - description
        - profession_id(FK)
        - address
        - user_id(FK)
        - id
        - profile_id(FK)
        - sponsorship_id (FK)
    **-review-**
    - profile_id (FK)
    - name
    - email
    - message
    - vote
    - profile_id (FK)
**service**
    - profile_id (FK)
    - desc
    - price
    - profession_id (FK)
**sponsorships**
    - name
    - price
    - duration
    - profile_id' (FK)

