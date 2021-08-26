# PHP Micro Blog Framework

This is a PHP micro framework built from the ground up with the intent of being a self contained flat file blog website.  There are no dependencies ( other than Composer for autoloading ) and was developed in vanilla PHP.  The intent was to be as small as possible.

Why would anyone do that you ask? Especially when there are tons of FANTASTIC frameworks out there??  Why re-invent the wheel??

To learn!  This was a great exercise for me to get back into PHP and understand a little bit how MVC frameworks are constructed behind the scenes.

This includes its own; url router, controllers, views, configurations, flat file blog engine, and more. Oh and NO DATABASE here!

`NOTE:`  There are example blog posts in the "posts" folder and must adhere to that format.

`TODO:`  Could use pagination and maybe a template engine.

## How to run

```
composer install
```

Start server:
```
php -S localhost:8889 -t public
```

## Warning

This is not battle tested, there could very likely be some security holes that I missed, so use with caution.

## License

The program is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).
