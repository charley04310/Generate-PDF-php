<?php

namespace App\Models;

use mikehaertl\pdftk\Pdf;
use Codedge\Fpdf\Fpdf\Fpdf;

class GeneratePDF {

    static public function insertImageToTechnicalProjectPDF(array $imagesTechnicalDocument) {

        /***
        This code creates a new instance of the FPDF class, creates a variable named $image_pdf_name and assigns a random number to it.
        Then, it adds pages to the pdf object created before and insert image to it with different positions and dimensions
        on each page. Then it saves the pdf object with images in a temporary folder and return the name of the pdf file with images.
        ***/

        $fpdf = new Fpdf();

        $image_pdf_name = 'pdf_image_'.rand(1, 1000).'.pdf';

        $fpdf->AddPage();
        $fpdf->AddPage();
        $fpdf->Image($imagesTechnicalDocument["page_2_left"], 20, 110, 70);
        $fpdf->Image($imagesTechnicalDocument["page_2_right"], 80, 100, 100);

        $fpdf->AddPage();
        $fpdf->Image($imagesTechnicalDocument["page_3"] , 30, 100, 150);

        $fpdf->AddPage();
        $fpdf->Image($imagesTechnicalDocument["page_4_header"], 30, 50, 150);
        $fpdf->Image($imagesTechnicalDocument["page_4_center"], 30, 130, 150);


        $fpdf->AddPage();
        $fpdf->Image($imagesTechnicalDocument["page_5"], 30, 115, 150);

        // sauvegarde le PDF avec les images dans le dossier temporaire
        $fpdf->Output('F', dirname(__FILE__).'/PDF_temporary/'.$image_pdf_name);

        // retourne le nom du fichier pdf avec les images
        return $image_pdf_name;

    }

    static public function mergeImagePDFandFormPDF(string $filled_pdf_name, string $image_pdf_name, string $template_pdf_name, string $fakeDataFields) {

        /*
        This code creates a new instance of the Pdf class, passing in the location of an existing PDF file.
        It then creates a variable for the background PDF file, and a variable for the name of the final PDF
        file (without the '.pdf' extension). The script then adds a new filename prefix "completed_" and a
        suffix with fakeDataFields value. It then uses the "multiBackground" method to merge the background
        PDF with the existing PDF and save the result to a specific folder. After that, it checks if the merge
        is successful and return the error if not, or the location of the merged pdf if it's successful. */

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
        $filename = $storageMode.'_'.$pdf_name_without_ext.'_'.$fakeDataFields["Ref_projet"].'.pdf';

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
