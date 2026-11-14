# College Website

This is a Laravel application prepared for deployment to Render and Vercel.

## Local development

```bash
composer install
npm install
npm run build
php artisan migrate --seed
php artisan serve
```

## Deployment

- Render: `render.yaml`
- Vercel: `vercel.json`

More deployment notes are in `DEPLOY_README.md`.
