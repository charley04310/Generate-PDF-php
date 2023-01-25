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

    $template_pdf_name = 'certif_extension_garant.pdf';

    // FAKE data collection to fill the PDF
    $fakeDataFields = [
        "Ref_projet" => "123456789",
        'numero_commande' => '1297BJHeft543mPo',
        'date_commande' => '2021-01-01',
        'company_name' => 'Terrassteel',
        'full_adress_company' => '1234 Main Street',
        'full_name_customer' => 'John Doe',
        'surface_terrasse' => '100m2',

    ];

    $reponse = GeneratePDF::fillFormFromTemplatePDF($template_pdf_name, $fakeDataFields, false);


    return $reponse;
});

// add image before filling form PDF
Route::get('pdf/dossier-technique', function () {

    // An Example of wood description
    $revetement_description = "Le revêtement en bois de type lame de pin sylvestre est un matériau naturel et durable qui apporte une touche chaleureuse et rustique à n'importe quelle pièce. Il est fabriqué à partir de bois de pin sylvestre de qualité supérieure, choisi pour sa résistance à la déformation et sa durabilité. Les lames de bois sont coupées à la longueur souhaitée et peuvent être utilisées pour recouvrir les murs, les plafonds ou les sols. Les lames de pin sylvestre peuvent être teintées dans une variété de couleurs pour s'adapter à la décoration de la pièce. En outre, ils sont facile à installer et à entretenir. Le revêtement en lame de pin sylvestre est un choix écologique et élégant pour les amateurs de bois naturel.";
    $template_pdf_name = 'dossier_technique_form.pdf';
    $isImageInsert = true;

    // FAKE data collection to fill the PDF
    $fakeDataFields = [
        "Ref_projet" => "123456789",
        "Nom_client_projet" => "John Doe",
        "surface_m2" => "100m2",
        "fulladresse_projet" => "1234 Main Street",
        "date_projet" => "2021-01-01",
        "version_projet" => "1.0",
        "service_psoe" => "Auto-construction",
        "delais_projet" => "1 mois",
        "type_pose" => "Pose collée",
        "type_sol" => "Sol béton",
        "hauteur_implentation" => "0.5m",
        "technologie_projet" => "Technologie 1",
        "appui_projet" => "Appui 1",
        "epaisseur_revetement" => "0.5mm",
        "epaisseur_joint" => "0.5mm",
        "revetement_description" => $revetement_description,
        "sens_pose" => "Sens 1",
        "solution_technologique" => "Solution 1",
        "espacement_plot" => "0.5mm",
        "espacement_eclisse" => "0.5mm",
        "lambourde_mm" => "0.5mm",
        "entraxe_mm" => "0.5mm",
        "axe_mm" => "0.5mm",
    ];
    // FAKE data collection of images to insert in the PDF
    $imagesTechnicalDocument = [
        "page_2_left" => "/home/charley/virdys/pdf-app/public/images/page_2_left.png",
        "page_2_right" => "/home/charley/virdys/pdf-app/public/images/page_2_right.png",
        "page_3" => "/home/charley/virdys/pdf-app/public/images/page_3_center.png",
        "page_4_header" => "/home/charley/virdys/pdf-app/public/images/page_4_header.png",
        "page_4_center" => "/home/charley/virdys/pdf-app/public/images/page_4_center.png",
        "page_5" => "/home/charley/virdys/pdf-app/public/images/page_5.png",
    ];

    // enregiste un PDF avec les images du dossier technique dans le dossier temporaire et retourne le nom du fichier
    $image_pdf_name = GeneratePDF::insertImageToTechnicalProjectPDF($imagesTechnicalDocument);

    // enregiste un PDF dans le dossier temporaire avec les données du formulaire et retourne le nom du fichier
    $filled_pdf_name = GeneratePDF::fillFormFromTemplatePDF($template_pdf_name, $fakeDataFields, $isImageInsert);

    // on fusionne le PDF avec l'image et on recupère le resultat de sortie
    $result = GeneratePDF::mergeImagePDFandFormPDF($filled_pdf_name, $image_pdf_name, $template_pdf_name, $fakeDataFields['Ref_projet']);

    // on supprime les fichiers temporaires qui ont permis de générer le PDF final
    File::delete('/home/charley/virdys/pdf-app/app/Models/PDF_temporary/'.$image_pdf_name);
    File::delete('/home/charley/virdys/pdf-app/app/Models/PDF_temporary/'.$filled_pdf_name);


    return $result;

});
