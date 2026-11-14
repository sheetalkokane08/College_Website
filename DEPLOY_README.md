# Deploy kit for College_Website (Laravel)

Unzip INTO THE ROOT of your project (same folder as `artisan`), then:

    git add .
    git commit -m "Add deployment config"
    git push

## Option A - Render (recommended)
1. https://render.com -> New + -> Blueprint -> select your GitHub repo.
2. Render reads `render.yaml` and builds the Dockerfile.
3. In the web service's Environment settings, set `DATABASE_URL` to the
   existing PostgreSQL database's internal connection URL. Do not commit this
   secret to the repository.
4. Open the URL Render gives you after the service deploys.

The default Laravel seeder does not create an admin account or demo data.

## Option B - Vercel
Uses vercel.json + api/index.php. You must also:
- Framework Preset: Other, Build Command: npm run build
- Add the variables in .env.vercel.example (needs an external MySQL database)
- Uploaded files will not persist on Vercel.
