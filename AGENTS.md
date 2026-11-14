# AGENTS

This repository contains a Laravel application intended to be deployed with a Docker-based Render configuration and a Vercel PHP runtime fallback.

## Development

- `composer install`
- `npm install`
- `npm run build`
- `php artisan serve`

## Deployment

- Render uses `render.yaml` and `Dockerfile`
- Vercel uses `vercel.json` and `api/index.php`
- The deployment should be run from the root project directory with `artisan` present
