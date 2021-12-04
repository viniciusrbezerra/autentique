<?php
require __DIR__."/../vendor/autoload.php";
/**
 * Create Document
 */
$document = (new \ViniciusRBezerra\Autentique\Document())->createDocument(
    "document_name",
    [
        ["email" => "email@gmail.com", "action" => "SIGN"],
    ],
    "path_to_document"
);

/**
 * Create Folder
 */
$createdFolder = (new \ViniciusRBezerra\Autentique\Folder())->createFolder("folder_name");

/**
 * Move document to folder
 */
$moveFile = (new \ViniciusRBezerra\Autentique\Document())->moveDocumentToFolder($document->callback()->createDocument->id, $createdFolder->callback()->createFolder->id);

/**
 * Sign the document
 */
$sign = (new \ViniciusRBezerra\Autentique\Document())->signDocument($document->callback()->createDocument->id);