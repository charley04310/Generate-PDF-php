<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Models\FillImageInPDF ;
use App\Models\GeneratePDF ;

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

// fill FROM inside PDF
Route::get('pdf/garantie', function () {

    $template_pdf_name = 'certificat_extension_garantie.pdf';
    // FAKE data collection to fill the PDF
    $fakeDataCollection = GeneratePDF::$fakeDataGarantie;
    $reponse = GeneratePDF::fillFormFromTemplatePDF($template_pdf_name, $fakeDataCollection, false);

    return $reponse;
});

// add image before filling form PDF
Route::get('pdf/dossier-technique', function () {

    // Define the name of the PDF template
    $template_pdf_name = 'dossier_technique.pdf';

    // Define that we want insert image in the PDF
    $isImageInsert = true;

    // FAKE data collection to fill the PDF
    $fakeDataFormCollection = GeneratePDF::$fakeDataTechnicalDocument;
    $fakeDataImagesCollection = GeneratePDF::$fakeDataImagesProject;

    // enregiste un PDF avec les images du dossier technique dans le dossier temporaire et retourne le nom du fichier
    $image_pdf_name = GeneratePDF::insertImageToTechnicalProjectPDF($fakeDataImagesCollection);

    // enregiste un PDF dans le dossier temporaire avec les données du formulaire et retourne le nom du fichier
    $filled_pdf_name = GeneratePDF::fillFormFromTemplatePDF($template_pdf_name, $fakeDataFormCollection, $isImageInsert);

    // on fusionne le PDF avec l'image et on recupère le resultat de sortie
    $result = GeneratePDF::mergeImagePDFandFormPDF($filled_pdf_name, $image_pdf_name, $template_pdf_name, $fakeDataFormCollection['ref_projet']);

    // on supprime les fichiers temporaires qui ont permis de générer le PDF final
    File::delete('/home/charley/virdys/pdf-app/app/Models/PDF_temporary/'.$image_pdf_name);
    File::delete('/home/charley/virdys/pdf-app/app/Models/PDF_temporary/'.$filled_pdf_name);

    return $result;

});
