<?php

namespace ViniciusRBezerra\Autentique;

use CURLFile;

class Document extends Autentique
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $name
     * @param array $signers
     * @param string $file
     * @return $this
     */
    public function createDocument(string $name, array $signers, string $file): Autentique
    {
        $data["query"] = 'mutation CreateDocumentMutation($document: DocumentInput!, $signers: [SignerInput!]!, $file: Upload!) {createDocument(sandbox: '.($this->devMode ? 'true' : 'false').', document: $document, signers: $signers, file: $file) {id name refusable sortable created_at signatures { public_id name email created_at action { name } link { short_link } user { id name email }}}}';
        $data["variables"] = [
            "document" => ["name" => $name],
            "signers" => $signers,
            "file" => null
        ];

        $this->data->operations = json_encode($data);
        $this->data->map = '{"file": ["variables.file"]}';
        $this->data->file = new CURLFile($file);

        $this->execute(false);
        return $this;
    }

    /**
     * @param string $documentId
     * @return object
     */
    public function document(string $documentId): object
    {
        $this->data->query = "query { document(id: \"{$documentId}\") { id name refusable sortable created_at files { original signed } signatures { public_id name email created_at action { name } link { short_link } user { id name email } email_events { sent opened delivered refused reason } viewed { ...event } signed { ...event } rejected { ...event } } } } fragment event on Event { ipv4 ipv6 reason created_at geolocation { country countryISO state stateISO city zipcode latitude longitude } }";
        $this->execute();
        return $this->callback();
    }

    /**
     * @param int|null $limit
     * @return object
     */
    public function documents(?int $limit = null): object
    {
        $limit = empty($limit) ? 60 : $limit;
        $this->data->query = "query { documents(limit: {$limit}, page: 1) { total data { id name refusable sortable created_at signatures { public_id name email created_at action { name } link { short_link } user { id name email } viewed { created_at } signed { created_at } rejected { created_at } } files { original signed } } } }";
        $this->execute();
        return $this->callback();
    }

    /**
     * @param string $documentId
     * @return $this
     */
    public function deleteDocument(string $documentId): Autentique
    {
        $this->data->query = "mutation { deleteDocument(id: \"{$documentId}\") }";
        $this->execute();
        return $this;
    }

    /**
     * @param string $document
     * @return $this
     */
    public function signDocument(string $document): Autentique
    {
        $this->data->query = "mutation { signDocument(id: \"{$document}\") }";
        $this->execute();
        return $this;
    }

}