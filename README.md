# CaféApi Library Test

[![Source Code](http://img.shields.io/badge/source-ViniciusRBezerra/autentique-blue.svg?style=flat-square)](https://github.com/ViniciusRBezerra/autentique)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/ViniciusRBezerra/autentique.svg?style=flat-square)](https://packagist.org/packages/ViniciusRBezerra/autentique)
[![Latest Version](https://img.shields.io/github/release/ViniciusRBezerra/autentique.svg?style=flat-square)](https://github.com/ViniciusRBezerra/autentique/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/ViniciusRBezerra/autentique.svg?style=flat-square)](https://scrutinizer-ci.com/g/ViniciusRBezerra/autentique)
[![Quality Score](https://img.shields.io/scrutinizer/g/ViniciusRBezerra/autentique.svg?style=flat-square)](https://scrutinizer-ci.com/g/ViniciusRBezerra/autentique)
[![Total Downloads](https://img.shields.io/packagist/dt/ViniciusRBezerra/autentique.svg?style=flat-square)](https://packagist.org/packages/cViniciusRBezerra/autentique)

###### Autentique is a website for signing documents online and this is an API for seamless integration with the website.

Autentique é um site para assinar documentos online e está é uma API para integração de maneira transparente com o site.

### Highlights

- Simple installation (Instalação simples)
- Abstraction of all API methods (Abstração de todos os métodos da API)
- Composer ready and PSR-2 compliant (Pronto para o composer e compatível com PSR-2)

## Installation

Uploader is available via Composer:

```bash
"ViniciusRBezerra/autentique": "^1.0"
```

or run

```bash
composer require ViniciusRBezerra/autentique
```

## Documentation

###### For details on how to use, see a sample folder in the component directory. In it you will have an example of use for each class. It works like this:

Para mais detalhes sobre como usar, veja uma pasta de exemplo no diretório do componente. Nela terá um exemplo de uso para cada classe. Ele funciona assim:

#### User endpoint:

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

Please see [CONTRIBUTING](https://github.com/ViniciusRBezerra/uploader/blob/master/CONTRIBUTING.md) for details.

## Support

###### Security: If you discover any security related issues, please email meu@email.com.br instead of using the issue tracker.

Se você descobrir algum problema relacionado à segurança, envie um e-mail para meu@email.com.br em vez de usar o rastreador de problemas.

Thank you

## Credits

- [Vinícius R. Bezerra](https://github.com/ViniciusRBezerra) (Developer)

## License

The MIT License (MIT). Please see [License File](https://github.com/ViniciusRBezerra/autentique/blob/master/LICENSE) for more information.