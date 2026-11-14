# CLAUDE

This project is a Laravel app prepared for deployment to Render and Vercel.

## Important

- Keep the Dockerfile and startup shell script in sync with the filesystem layout.
- Ensure the root app has `artisan` and `public/index.php`.
- For Vercel, use the PHP runtime entrypoint in `/api/index.php`.
