<?php

namespace ViniciusRBezerra\Autentique;

class Folder extends Autentique
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $name
     * @return $this
     */
    public function createFolder(string $name): Autentique
    {
        $this->data->query = 'mutation CreateFolderMutation($folder: FolderInput!) {  createFolder(folder: $folder) { id name type created_at}}';
        $this->data->variables = ["folder" => ["name" => $name]];

        $this->execute();
        return $this;
    }

    /**
     * @param string $folderId
     * @return object
     */
    public function folder(string $folderId): object
    {
        $this->data->query = "query { folder(id: \"{$folderId}\") { id name type created_at } }";
        $this->execute();
        return $this->callback();
    }

    /**
     * @param int|null $limit
     * @return object
     */
    public function folders(?int $limit = null): object
    {
        $limit = empty($limit) ? 60 : $limit;
        $this->data->query = "query { folders(limit: {$limit}, page: 1) { total data { id name type created_at } } }";
        $this->execute();
        return $this->callback();
    }

    /**
     * @param string $folderId
     * @return $this
     */
    public function deleteFolder(string $folderId): Autentique
    {
        $this->data->query = "mutation { deleteFolder(id: \"{$folderId}\") }";
        $this->execute();
        return $this;
    }

    public function documentsByFolder(string $folderId): object
    {
        $this->data->query = "query { documentsByFolder(folder_id: \"{$folderId}\", limit: 60, page: 1) { total data { id name created_at files { original signed } signatures { public_id name email action { name } viewed { created_at } signed { created_at } rejected { created_at } } } } }";
        $this->execute();
        return $this->callback();
    }
}