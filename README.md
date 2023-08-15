# Autentique Library

[![Source Code](http://img.shields.io/badge/source-viniciusrbezerra/autentique-blue.svg?style=flat-square)](https://github.com/viniciusrbezerra/autentique)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/viniciusrbezerra/autentique.svg?style=flat-square)](https://packagist.org/packages/viniciusrbezerra/autentique)
[![Latest Version](https://img.shields.io/github/release/viniciusrbezerra/autentique.svg?style=flat-square)](https://github.com/viniciusrbezerra/autentique/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/viniciusrbezerra/autentique.svg?style=flat-square)](https://scrutinizer-ci.com/g/viniciusrbezerra/autentique)
[![Quality Score](https://img.shields.io/scrutinizer/g/viniciusrbezerra/autentique.svg?style=flat-square)](https://scrutinizer-ci.com/g/viniciusrbezerra/autentique)
[![Total Downloads](https://img.shields.io/packagist/dt/viniciusrbezerra/autentique.svg?style=flat-square)](https://packagist.org/packages/cviniciusrbezerra/autentique)

###### Autentique is a website for signing documents online and this is an API for seamless integration with the website.

Autentique é um site para assinar documentos online e está é uma API para integração de maneira transparente com o site.

### Highlights

- Simple installation (Instalação simples)
- Abstraction of all API methods (Abstração de todos os métodos da API)
- Composer ready and PSR-2 compliant (Pronto para o composer e compatível com PSR-2)

## Installation

Uploader is available via Composer:

```bash
"viniciusrbezerra/autentique": "^1.0"
```

or run

```bash
composer require viniciusrbezerra/autentique
```

## Documentation

###### For details on how to use, see a sample folder in the component directory. In it you will have an example of use for each class. It works like this:

Para mais detalhes sobre como usar, veja uma pasta de exemplo no diretório do componente. Nela terá um exemplo de uso para cada classe. Ele funciona assim:

#### User endpoint:

Add your application configuration to a `.env` file in the root of your
project. **Make sure the `.env` file is added to your `.gitignore` so it is not
checked-in the code**

```shell
AUTENTIQUE_TOKEN="YOUR TOKEN HERE"
AUTENTIQUE_DEV_MODE="true or false"
```

```php
<?php

require __DIR__."/../vendor/autoload.php";

$document = new \Autentique\Document();
$folder = new \Autentique\Folder();

/**
 * Create Document
 */
$document = (new \Autentique\Document())->createDocument(
    "document_name",
    [
        ["email" => "email@gmail.com", "action" => "SIGN"],
    ],
    "path_to_document"
);

/**
 * Create Folder
 */
$createdFolder = $folder->createFolder("folder_name");

/**
 * Move document to folder
 */
$moveFile = (new \Autentique\Document())->moveDocumentToFolder($document->callback()->createDocument->id, $createdFolder->callback()->createFolder->id);

/**
 * Sign the document
 */
$sign = (new \Autentique\Document())->signDocument($document->callback()->createDocument->id);
```

## Contributing

Please see [CONTRIBUTING](https://github.com/viniciusrbezerra/uploader/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Vinícius R. Bezerra](https://github.com/viniciusrbezerra) (Developer)

## License

The MIT License (MIT). Please see [License File](https://github.com/viniciusrbezerra/autentique/blob/master/LICENSE) for more information.
