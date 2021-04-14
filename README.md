# Entretien-Uppler---Travaux

## Environnement de développement

### Pré-requis

* PHP 7.4
* Composer
* Symfony CLI
* Docker
* Docker-compose
* nodejs et npm

Vous pouves vérifier les pré-requis (sauf Docker et Docker-compose) avec la commande suivante (de la CLI Symfony)

```bash
symfony check:requirements
```

### Lancer l'environement de développement

```bash
composer install
npm install
npm run build
docker-compose up -d
symfony serve -d
```

### Ajouter des donnée de tests

```bash
symfony console doctrine:fixtures:load
```

### Lancer des tests

```bash
php bin/phpunit --testdox
```
