 
   <?php require_once('issuu.php');
 
     $pub_url  = '/letraeimagem/docs/catalogo-bn-rio450anos_imprensa';
     $email    = '';
     $password = '';
 
     $issuu = new IssuuDownloader();
 
     //if (!$issuu->login($email, $password)) {
      // echo 'Unauthorized: Invalid e-mail or password';
     //  exit(-1);
     //}
     $pub_url = $issuu->getPublicationUrl($pub_url);
     if ($pub_url == null) {
       echo 'Publication not found';
       exit(-1);
     }
     $pub_id = $issuu->getPublicationId($pub_url);
     if ($pub_id == null) { 
       echo 'Publication ID not found';
       exit(-1);
     }
     $doc_properties = $issuu->getPublicationProperties($pub_id);
     if ($doc_properties == null) { 
       echo 'Publication properties not found (unauthorized?)';
       exit(-1);
     }
     $doc_info = $issuu->createDocumentInfo($doc_properties);
     if ($doc_info == null) { 
       echo 'Error getting document information';
       exit(-1);
     }
     $pdf_fname = $issuu->createPdf($doc_info);
     if ($pdf_fname == null) {
       echo 'Error creating PDF document';
       exit(-1);
     }
     // Do download of PDF file: real temporary file in $pdf_fname
     // Virtual filename in $doc_info['filename']
 
     $issuu->deletePdf($pdf_fname); // removes temporary file

?>