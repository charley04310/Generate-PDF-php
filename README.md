## Composer INIT

If you are not using #Laravel as the example above or any framwork you can download composer with this command

```bash
sudo apt install composer
```

and init new `composer.json` file to your project

```shell
composer init
```

| WARNING: Only if your ne not using FrameWork ! |
| ---------------------------------------------- |

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

## Install library to fill image into existing PDF

next you can check to `vendor/codedge` if the folder exist

```bash
composer require codedge/laravel-fpdf
```

Feel free to get more informations about the library here : https://github.com/codedge/laravel-fpdf

## Create PDF form using Adobe ACROBATE

Here an example how to edit form inside PDF using ADOBE acrobate and how to edit field name

![alt text](https://github.com/charley04310/Generate-PDF-php/blob/main/data_fields.png)

## Example of basic usage of both library link together

[Link text Here](https://github.com/charley04310/Generate-PDF-php/blob/main/app/Models/GeneratePDF.php)
