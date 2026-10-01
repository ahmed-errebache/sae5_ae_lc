# SAÉ 5 — Réseau Cocagne
Binôme : Lucas Charpentier, Ahmed Errebache — BUT3 Informatique, IUT de Saint-Dié

## Stack
Symfony 7.4 · PHP 8.3-FPM · PostgreSQL 16 · nginx 1.27 · Docker Compose

## Lancer le projet (dev)
```bash
cp .env.example .env          # puis changer les mots de passe
docker compose up -d --build
```
- Application : http://localhost:8080
- Adminer : http://localhost:8081 (serveur `database`)

## Commandes utiles
```bash
docker compose exec php php bin/console make:entity
docker compose exec php php bin/console make:migration
docker compose exec php php bin/console doctrine:migrations:migrate
```

## Production
```bash
docker compose -f compose.yaml up -d --build
```
