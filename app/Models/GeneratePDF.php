<?php

namespace App\Models;

use mikehaertl\pdftk\Pdf;


class GeneratePDF {


    public function fillExistingPDF($fakeDataFields) {

        // Make sur to add read the pdf on existing folder
        $pdf = new Pdf(dirname(__FILE__).'/PDF_template/your-template-PDF.pdf');

        // add method to construct your file name
        $filename = 'pdf_'.rand(1, 1000).'.pdf';

        // fill the formulaire create on your pdf editor
        $result = $pdf->fillForm($fakeDataFields)
                ->saveAs(dirname(__FILE__).'/completed/'.$filename);

        if ($result === false) {
            return $pdf->getError();
        }
        return 'PDF saved to file system : at '. dirname(__FILE__).'/completed/'.$filename;
    }
}
