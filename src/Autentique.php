<?php

namespace ViniciusRBezerra\Autentique;

use stdClass;

/**
 * Class Source
 */
abstract class Autentique
{
    /** @var string */
    private string $url = "https://api.autentique.com.br/v2/graphql";

    /** @var string */
    private string $token;

    /** @var bool */
    protected bool $devMode;

    /** @var object  */
    private object $callback;

    /** @var object  */
    protected object $data;

    /** @var array  */
    protected array $header = [];

    /**
     * Source constructor.
     */
    public function __construct()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $this->token = $_ENV['AUTENTIQUE_TOKEN'];
        $this->devMode = $_ENV['AUTENTIQUE_DEV_MODE'];

        $this->data = new stdClass();
        $this->header[] = "Authorization: Bearer {$this->token}";
    }

    /**
     * @param string $documentId
     * @param string $folderId
     * @return $this
     */
    public function moveDocumentToFolder(string $documentId, string $folderId): Autentique
    {
        $this->data->query = "mutation { moveDocumentToFolder(document_id: \"{$documentId}\", folder_id: \"{$folderId}\") }";
        $this->execute();
        return $this;
    }

    /** @return object */
    public function callback(): object
    {
        return isset($this->callback->data) ? $this->callback->data : $this->callback;
    }

    /**
     * @param bool|null $json
     */
    protected function execute(?bool $json = true)
    {
        $this->header[] = $json ? "Content-Type: application/json" : "Content-Type: multipart/form-data";

        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, ($json ? json_encode((array)$this->data) : (array) $this->data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->header);
        $this->callback = json_decode(curl_exec($curl));
        curl_close($curl);
    }
}