<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});




Route::get('/fill-existing-PDF', function (App\Models\GeneratePDF $generatePDF) {

    // FAKE data collection to fill the PDF
    $fakeDataFields = [

        'numero_commande' => '1297BJHeft543mPo',
        'date_commande' => '2021-01-01',
        'company_name' => 'Terrassteel',
        'full_adress_company' => '1234 Main Street',
        'full_name_customer' => 'John Doe',
        'surface_terrasse' => '100m2',

    ];

    $reponse = $generatePDF->fillExistingPDF($fakeDataFields);

    
    return $reponse;
});
