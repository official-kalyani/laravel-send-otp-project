## Project Brief 

Hello Every One !
This is A Basic Laravel E-Commerce Web Project with Functional Admin Panel
In This Project We Are Using Laravel 8
In This Project We Are Shown Register User With Email Verification & Forget Password Process also With in Email
Now Check All Steps 

1) For Email Varification first, We Have to Make SMTP Mail Server Local

2) We Can Use Our Own Gmail Account For Doing This

3) First Go to "Manage Your Google Account"

4) Select "Security" on Left Side

5) Scroll Down And Select App Password

6) "Select the app and device you want to generate the app password for."
Select "Mail" For App
Select "Windows Computer" For Device
The Click on "Generate"

7) You Can Get A Password For SMTP Mail Server

8) Now got to ".env" file and update few on below points
..........................................................
<br>
MAIL_MAILER=smtp
<br>
MAIL_HOST=smtp.gmail.com
<br>
MAIL_PORT=587
<br>
MAIL_USERNAME=your mail id
<br>
MAIL_PASSWORD=password which you getting from "App Password"
<br>
MAIL_ENCRYPTION=tls
<br>
MAIL_FROM_ADDRESS=your mail id
<br>
MAIL_FROM_NAME="${APP_NAME}"
<br>
............................................................
<br>

rest of others don't need to change

Now here's the Register User With Email Verification & Forget Password Process also With in Email

## Bonus On This Project

In This Project We Are Shown Just Manually 
Add-Edit-Delete-Show Product From Admin Panel
and Show in the Main Home page
<br>

<h3 style="color: red">Note:</h3>
<p style="color: green">In Every Repository All Of You Can Get Bonus Part</p>

<br>




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.




## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# Laravel-8-User-Registration-with-Email-Varification-And-Forget-Password-By-Email
