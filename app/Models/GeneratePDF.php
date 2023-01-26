<?php

namespace App\Models;

use mikehaertl\pdftk\Pdf;
use Codedge\Fpdf\Fpdf\Fpdf;

/*      Unité de mesure utilisé en argument dans les methodes FDPF est le millimetre

        largeur de la page : 210mm
        hauteur de la page : 297mm

        ->Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])
        ->AddPage([string orientation [, string size [, string rotation]]])

    -----[x]-----
    Abscisse du coin supérieur gauche. Si non précisée ou égale à null, l'abscisse courante est utilisée.

    -----[y]-----
    Ordonnée du coin supérieur gauche. Si non précisée ou égale à null, l'ordonnée courante est utilisée ;
    de plus, un saut de page est d'abord effectué si nécessaire (en cas de saut de page automatique) ;
    puis, après l'appel, l'ordonnée courante est positionnée en bas de l'image.

    -----[w]-----
    Largeur de l'image dans la page. Il y a trois cas possibles :

        Si la valeur est positive, elle représente la largeur en unité utilisateur
        Si la valeur est négative, sa valeur absolue représente la résolution horizontale en dpi
        Si elle n'est pas indiquée ou vaut zéro, elle est calculée automatiquement

    -----[h]-----
    Hauteur de l'image dans la page. Il y a trois cas possibles :

        Si la valeur est positive, elle représente la hauteur en unité utilisateur
        Si la valeur est négative, sa valeur absolue représente la résolution verticale en dpi
        Si elle n'est pas indiquée ou vaut zéro, elle est calculée automatiquement  */


class GeneratePDF {

    static public $fakeDataGarantie = [
        "ref_projet" => "12KJNH89OPN78",
        'numero_commande' => 'M88LMN13',
        'date_commande' => '2021-01-01',
        'company_name' => 'Terrassteel',
        'address_project' => '12 Avenue du soleil, 75000 Paris',
        'fullname_customer' => 'John Doe',
        'surface_m2' => '100 m2',
    ];

    static public $fakeDataTechnicalDocument = [

        // PAGE 2 : VOTRE PROJET
        "ref_projet" => "12KJNH76G7",
        "nom_projet" => "Projet Terrasse bois",
        "name_client_projet" => "John Doe",
        "surface_m2" => "100m2",
        "fulladresse_projet" => "18 Avenue de la République, 75000 Paris",
        "date_projet" => "2021-01-01",
        "version_projet" => "Version 1.0",
        "service_pose" => "Auto-construction",
        "delais_projet" => "Dès maintenant",
        "type_pose" => "Auto-construction",

        // PAGE 3 :  VOS ZONES DE SUPPORT
        "type_sol_zone_2" => "Sol béton",
        "hauteur_implentation_zone_2" => "200",
        "technologie_projet_zone_2" => "Oméga 35-65",
        "appui_projet_zone_2" => "Plot 18/36mm - 22mm",
        "epaisseur_revetement_zone_2" => "28mm",
        "epaisseur_joint_zone_2" => "0mm",

        "type_sol_zone_1" => "Sol béton",
        "hauteur_implentation_zone_1" => "200",
        "technologie_projet_zone_1" => "Oméga 35-65",
        "appui_projet_zone_1" => "Plot 18/36mm - 22mm",
        "epaisseur_revetement_zone_1" => "28mm",
        "epaisseur_joint_zone_1" => "0mm",

        // PAGE 4 : VOTRE REVETEMENT
        "revetement_description" => "Le revêtement en bois de type lame de pin sylvestre est un matériau naturel et durable qui apporte une touche chaleureuse et rustique à n'importe quelle pièce. Il est fabriqué à partir de bois de pin sylvestre de qualité supérieure, choisi pour sa résistance à la déformation et sa durabilité. Les lames de bois sont coupées à la longueur souhaitée et peuvent être utilisées pour recouvrir les murs, les plafonds ou les sols. Les lames de pin sylvestre peuvent être teintées dans une variété de couleurs pour s'adapter à la décoration de la pièce. En outre, ils sont facile à installer et à entretenir. Le revêtement en lame de pin sylvestre est un choix écologique et élégant pour les amateurs de bois naturel.",
        "sens_pose" => "Vertical",

        // PAGE 5 : VOTRE PROJET CODIFIÉ
        "solution_technologique" => "Double structure Oméga 35-65",
        "espacement_plot" => "2000",
        "espacement_eclisse" => "2000",
        "lambourde_mm" => "3000",
        "entraxe_mm" => "1000",
        "axe_mm" => "100",
    ];

    static public $fakeDataImagesProject = [
        //"page_2_plan_3D" => "/home/charley/virdys/pdf-app/public/images/page_2_left.png",
        "page_2_plan_3D" => null ,
        "page_2_plan_2D" => "/home/charley/virdys/pdf-app/public/images/page_2_right.png",
        "page_3_plan_zone_support" => "/home/charley/virdys/pdf-app/public/images/page_3_center.png",
        "page_4_revetement_header" => "/home/charley/virdys/pdf-app/public/images/page_4_header.png",
        "page_4_plan_revetement" => "/home/charley/virdys/pdf-app/public/images/page_4_center.png",
        "page_5_plan_2D" => "/home/charley/virdys/pdf-app/public/images/page_5.png",
    ];

    static public function insertImageToTechnicalProjectPDF(array $imagesTechnicalDocument) {

        $fpdf = new Fpdf();
        $image_pdf_name = 'pdf_image_'.rand(1, 1000).'.pdf';

        // add the first page
        $fpdf->AddPage();
        // add second page
        $fpdf->AddPage();

        // si le plan 2D est n'est pas identifier on affiche l'image au milieu de la page
        if($imagesTechnicalDocument["page_2_plan_3D"] === null){
            $fpdf->Image($imagesTechnicalDocument["page_2_plan_2D"], 40, 90, 130);

        }else{
            $fpdf->Image($imagesTechnicalDocument["page_2_plan_3D"], 20, 110, 70);
            $fpdf->Image($imagesTechnicalDocument["page_2_plan_2D"], 100, 100, 90);
        }

        // add the third page
        $fpdf->AddPage();
        $fpdf->Image($imagesTechnicalDocument["page_3_plan_zone_support"] , 30, 100, 150);

        // add the fourth page
        $fpdf->AddPage();
        $fpdf->Image($imagesTechnicalDocument["page_4_revetement_header"], 30, 50, 150);
        $fpdf->Image($imagesTechnicalDocument["page_4_plan_revetement"], 30, 130, 150);

        // add the fifth page
        $fpdf->AddPage();
        $fpdf->Image($imagesTechnicalDocument["page_5_plan_2D"], 30, 115, 150);

        // save the pdf in a temporary folder
        $fpdf->Output('F', dirname(__FILE__).'/PDF_temporary/'.$image_pdf_name);

        // return the name of the pdf with the images
        return $image_pdf_name;

    }

    static public function mergeImagePDFandFormPDF(string $filled_pdf_name, string $image_pdf_name, string $template_pdf_name, string $fakeDataFields) {

        // Make sur to add read the pdf on existing
        $pdf = new Pdf(dirname(__FILE__).'/PDF_temporary/'. $filled_pdf_name);

        $pdf_background = dirname(__FILE__).'/PDF_temporary/'. $image_pdf_name;
        $pdf_name = str_replace('.pdf', '', $template_pdf_name);

        // add method to construct your file name
        $filename = 'completed_'.$pdf_name.'_'.$fakeDataFields.'.pdf';

        // fill the formulaire create on your pdf editor
        $result = $pdf->multiBackground($pdf_background)
                ->saveAs(dirname(__FILE__).'/PDF_completed/'.$filename);

        if ($result === false) {
            return $pdf->getError();
        }
        return 'Your Merge is successfully create at : '.  dirname(__FILE__).'/PDF_completed/'.$filename;
    }

    static public function fillFormFromTemplatePDF(string $template_pdf_name, array $fakeDataFields, bool $isImageInsert) {

        $storageMode = $isImageInsert ? 'temporary' : 'completed';
        $pdf_name_without_ext = str_replace('.pdf', '', $template_pdf_name);

        // Make sur to add read the pdf on existing
        $pdf = new Pdf(dirname(__FILE__).'/PDF_template/'.$template_pdf_name);

        // feel free to add your own method to construct your file name
        $filename = $storageMode.'_'.$pdf_name_without_ext.'_'.$fakeDataFields["ref_projet"].'.pdf';

        // fill the formulaire create on your pdf editor
        $result = $pdf->fillForm($fakeDataFields)
        // save the pdf in a temporary folder
                ->saveAs(dirname(__FILE__). '/PDF_'.$storageMode.'/' .$filename);
        if ($result === false) {
            return $pdf->getError();
        }

        if($isImageInsert){
            return $filename;

        }else{
            return 'Your Form is successfully filled and create at : '.  dirname(__FILE__).'/PDF_'.$storageMode.'/'.$filename;
        }
    }
}
