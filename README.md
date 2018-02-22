# UGM Online Proceeding
Online proceeding of Universitas Gadjah Mada

## How to Install
1. Clone this repository to your local.
2. run `composer install`
3. Make new `.env` based on `.env.example`. Don't forget to modify the database connection on `.env`.
4. run `php aritsan key:generate`.
5. run `php artisan migrate --seed`.
6. run `php artisan storage:link`.
8. run `php artisan passport:install`. Copy passport grant `client id` and `client_secret` to your `.env`.
9. If you are on local development using XAMPP, we recomend you to [make Virtual Host](http://valuebound.com/resources/blog/how-to-setup-virtual-host-windows-7-xampp-server).

# Credits
## Contributors
- [@w1lldone](https://github.com/w1lldone)
- [@pepypeppep](https://github.com/pepypeppep)
- [@davieiycode](https://github.com/davieiycode)
- [@akhsin](https://github.com/akhsin)

## Development
- Built with [Laravel 5.5](https://laravel.com) PHP Framework
- [Passport](https://laravel.com/docs/5.5/passport) for API Security
- [Swagger PHP](http://zircote.com/swagger-php/) and [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger) for API documentations
- Frontend using [Bootstrap 4.0](http://getbootstrap.com/)

## Images and icons
- UGM Proceeding logo by [M Rafieiy](https://www.instagram.com/rafieiy/)
- Empty search ilustration by [Freepik](https://www.freepik.com/free-vector/businessman-with-magnifying-glass_1091811.htm)
- Error with laptop by [Freepik](https://www.freepik.com/free-vector/404-error-concept-with-laptop_1534899.htm)
- Under construction ilustration by [Freepik](https://www.freepik.com/free-vector/under-construction-template-in-flat-style_1723659.htm)
- Icons by [Fontawesome](https://github.com/FortAwesome/Font-Awesome)
