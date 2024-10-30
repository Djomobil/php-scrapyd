# PHP Scrapyd Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/josephdelassalle/php_scrapyd_package.svg?style=flat-square)](https://packagist.org/packages/josephdelassalle/php_scrapyd_package)
[![Total Downloads](https://img.shields.io/packagist/dt/josephdelassalle/php_scrapyd_package.svg?style=flat-square)](https://packagist.org/packages/josephdelassalle/php_scrapyd_package)

Package de communication avec l'API Scrapyd pour gérer les spiders et les tâches de scraping.

## Installation

Vous pouvez installer le package via Composer :

```bash
composer require josephdelassalle/php_scrapyd_package
```

## Configuration

Ajoutez votre configuration Scrapyd dans `.env` ou directement dans le code :

```plaintext
SCRAPYD_BASE_URL=http://localhost:6800
SCRAPYD_USERNAME=your_username
SCRAPYD_PASSWORD=your_password
```

## Utilisation

Exemples d'utilisation du package pour interagir avec l'API Scrapyd.

### Initialisation du Service

```php
use Djomobil\PhpScrapyd\Services\ScrapydService;
use Djomobil\PhpScrapyd\Helpers\HttpHelper;

$scrapydService = new ScrapydService(
    new HttpHelper(),
    'http://localhost:6800',
    'your_username',
    'your_password'
);
```

### Planification d'un Job

```php
$jobId = $scrapydService->job()->scheduleJob([
    'project' => 'my_project',
    'spider' => 'my_spider'
]);

echo "Job ID: $jobId";
```

### Récupération du Statut du Daemon

```php
$status = $scrapydService->daemon()->getDaemonStatus();
print_r($status);
```

## Tests

Exécutez les tests avec :

```bash
vendor/bin/phpunit
```

## Contribuer

Les contributions sont les bienvenues ! Merci de bien vouloir ouvrir une issue ou un pull request pour signaler un problème ou proposer une amélioration.

### Linting

Assurez-vous que votre code respecte les standards de `phpcs` :

```bash
composer lint
```

## Déploiement sur Packagist

Le package est déployé automatiquement sur [Packagist](https://packagist.org/) à chaque nouvelle version taggée.
