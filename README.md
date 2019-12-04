<h1 align="center">Welcome to lara-admin-starter 👋</h1>
<a href="https://github.com/hallindavid/lara-admin-starter">
  <center><img src="resources/images/logo.jpg"></center>
</a>
<br />
<p align="center">
  <img alt="Version" src="https://img.shields.io/badge/version-1.0-blue.svg?cacheSeconds=2592000" />
  <a href="https://github.com/hallindavid/lara-admin-starter" target="_blank">
    <img alt="Documentation" src="https://img.shields.io/badge/documentation-yes-brightgreen.svg" />
  </a>
  <a href="https://github.com/kefranabg/readme-md-generator/graphs/commit-activity" target="_blank">
    <img alt="Maintenance" src="https://img.shields.io/badge/Maintained%3F-yes-green.svg" />
  </a>
  <a href="https://github.com/hallindavid/lara-admin-starter/blob/master/LICENSE"><img alt="GitHub license" src="https://img.shields.io/github/license/hallindavid/lara-admin-starter"></a>
  
</p>

## Contents
* [About the Project](#about-the-project)
* [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
  * [The Build](#the-build)
* [Authors](#authors)
* [Contributing](#contributing)
* [Show Your Support](#show-your-support)
* [License](#license)

## About the Project
<center><img src="https://res.cloudinary.com/davidhallin/image/upload/v1575476235/public-images/lara-admin-starter-screenshot.png"></center>
<br />
<p align="center">Quick-start template repo to get going on a Laravel 6, AdminLTE 3 project using some common tools like Vue.JS, Vue-snotify (for validation messages), Bootstrap Vue - For great tables and a few other things, Telescope pre-installed, and Jamesh for UUIDs on models.</p>

## Built With
* [Laravel](https://laravel.com)
* [AdminLTE 3](https://github.com/ColorlibHQ/AdminLTE) | [Docs](https://adminlte.io/docs/3.0/) | [Demo](https://adminlte.io/themes/dev/AdminLTE/index.html)
* [BootstrapVue](https://bootstrap-vue.js.org/)
* [Vue.js](https://vuejs.org/)
* [Vue-snotify](https://github.com/artemsky/vue-snotify)
* [Telescope](https://laravel.com/docs/6.x/telescope)
* [Laravel-UUID](https://packagist.org/packages/jamesh/laravel-uuid) - for UUIDs as keys in the database


## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

* Ensure your system meets the [Laravel Requirements](https://laravel.com/docs/6.x/installation#server-requirements)

### Installation

 
1. Clone the repo
```sh
git clone https://github.com/hallindavid/lara-admin-starter.git
```
2. Install NPM packages
```sh
npm install
```

3. Install Composer packages
```sh
composer install
```
4. Update your `.env` file to reflect your database settings and the serving method of choice.

5. run `php artisan migrate` to get the tables setup in the database

6. run `npm run watch` to modify real-time, or `npm run prod` to build production js files, or `npm run dev` to build dev js files.  This is just normal laravel stuff - nothing too fancy

7. (Optional) setup your hosts file so you can easily test the site
```
sudo vim /etc/hosts
```

### The Build
* Themed Pages for
  * Login
  * Register
  * Change Password
  * User Management
  * Forgot Password
* Themed Blade Layouts for
  * External - similar to the login page on the theme - all you have to do is fill in the box
  * App - General - loads the menu + all panels, really just for use after authentication has been completed
  * Carded - Just like App, but will make a card/panel in the page surrounding your content
  * Top Nav - for views when you really just want to the top part/no menu on the side
  * Carded Top Nav - same as Top Nav, but content is loaded into a card
* Panels for
  * Sidebar (contains)
    * Logo - you should have 1 horizontal and 1 square (for small), load them via resources, and they'll be copied to public on build
    * Menu - PHP array at the top, you can easily customize the items in it, or just html copy/paste it to make your own custom menu
  * Top Nav
  * Aside (bar on the right)
  * Footer
  * Breadcrumbs - load breadcrumbs on app or carded layouts by loading the view with breadcrumbs like 
```
    $breadcrumbs = [['name'=>'Dashboard','link'=>'/'], ['name'=>'New Page']];
    return view('page1')->with('breadcrumbs', $breadcrumbs); 
```
* Functionality
  * Basic Permissions, setup in DB Seeder right now
  * Authentication (via web, but has API-key in users table, and app.js passes it to axios globally, so you can do vue components really easily)
  * Admin Middleware - basic column in users table for `is_admin` 
  * Sass/JS Build AdminLTE, use the default laravel scripts for the build



## Authors

👤 **David Hallin & Evan Campbell-Weiner**

* Twitter: [@david\_hallin](https://twitter.com/david\_hallin)
* David's Github: [@hallindavid](https://github.com/hallindavid)
* Evan's Github: [@evancampbellweiner](https://github.com/evancampbellweiner)

## 🤝 Contributing

Contributions, issues and feature requests are welcome!<br />Feel free to check [issues page](https://github.com/hallindavid/lara-admin-starter/issues). 

## Show your support

Give a ⭐️ if this project helped you!

## License
Lara-Admin-Starter is licensed under MIT - but it's really just these two repos merged for an easy start - they are both licensed under MIT as well.

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

AdminLTE is a theme licensed under the [MIT license](https://opensource.org/licenses/MIT).

***
_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_