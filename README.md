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

## Create PDF form

Here an example how to edit form inside PDF using ADOBE acrobate and how to edit field name

![alt text](https://github.com/charley04310/Generate-PDF-php/blob/main/data_fields.png)


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
