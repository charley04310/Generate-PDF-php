
## Composer INIT  

If you are not using #Laravel as the example above or any framwork you can download composer with this command 

```bash
sudo apt install composer
```

and init new `composer.json` file to your project
```shell
composer init
```

When file is set up if you re not using framework add `autoload` composant to your `composer.json`

here an example how you can add it to your composer file : 
```json
"autoload": {
	"psr-4": {
		"App\\": "app/",
	}
},
```

## Install PDFTK server 
```bash
sudo apt install pdftk
```

Or by downloading on official website https://www.pdflabs.com/tools/pdftk-server/

## Install library to interact with PDFTK server 
```bash
composer require mikehaertl/php-pdftk
```

next you can check to `vendor/mikehaertl` if the folder exist

Feel free to get more informations about the library here : https://github.com/mikehaertl/php-pdftk 

## Create PDF form

Here an example how to edit form inside PDF using ADOBE acrobate and how to edit field name

![[Capture d’écran 2023-01-23 140416.png]]


# Basic usage of PDF generator

Here an example of laravel project above 
```php
use mikehaertl\pdftk\Pdf;

class GeneratePDF {
public function fillExistingPDF($fakeDataFields) {

$pdf = new Pdf(dirname(__FILE__).'/PDF_template/example_of_pdf.pdf');

// add method to construct your file name
$filename = 'pdf_'.rand(1, 1000).'.pdf';

// fill the form created on your pdf editor
$result = $pdf
->fillForm($fakeDataFields)

// save the PDF file to completed folder
->saveAs(dirname(__FILE__).'/completed/'.$filename);

if ($result === false) {
	return $pdf->getError();
}
return 'PDF saved to file system : at '. dirname(__FILE__).'/completed/'.$filename;
}
}
```

here an example of fake data colletion to interact with the fields expected 

```php
$fakeDataFields = [
	'numero_commande' => '1297BJHeft543mPo',
	'date_commande' => '2021-01-01',
	'company_name' => 'Terrassteel',
	'full_adress_company' => '1234 Main Street',
	'full_name_customer' => 'John Doe',
	'surface_terrasse' => '100m2',
];
```






<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
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

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
