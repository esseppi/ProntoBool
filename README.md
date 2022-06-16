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

//da qui è quello di henri da cui prendo spunto

separare js per il front office e per il back office in webpack.mix.js: mix.js('resources/js/admin.js', 'public/js')
.js('resources/js/front.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css');

nelle view andare ad usare i file js e css corretti:

<script src="{{ asset('js/admin.js') }}" defer></script>
oppure

<script src="{{ asset('js/front.js') }}" defer></script>
e gli stili

require('./bootstrap');

window.Vue = require('vue'); window.Axios = require('axios');

import App from './views/App.vue';

const app = new Vue({ el: '#app', render: h => h(App), });

se serve il router:

npm install vue-router@3

fare una cartella Pages dove mettere i componenti specifici delle pagine

aggiornare il file front.js: import VueRouter from 'vue-router'; // import di tutte le pagine

Vue.use(VueRouter);

const router = new VueRouter({ mode: 'history', routes: [ { path: '/', name: 'home', component: PageHome, }, // ... { path: '/blog/:slug', name: 'postShow', component: PostShow, props: true, }, { path: '*', name: 'page404', component: Page404, }, ], });

const app = new Vue({ el: '#app', render: h => h(App), router, });

a questo punto usare:

https://v2.vuejs.org/v2/guide/
https://router.vuejs.org/
https://laravel.com/docs/7.x/