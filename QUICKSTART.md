# 🚀 Quick Start Guide

## 60-Second Setup

> **Pro tip:** The registration form lets you choose a role (admin/faculty/student). Use the seeded admin account or register a new admin/faculty if you need to test multiple panels. Departments and courses seeded into the database now use meaningful names such as Computer Science, Artificial Intelligence, and Machine Learning.

Also, the system comes pre-seeded with 5 faculty accounts that map to actual faculty records.

```bash
# 1. Navigate to project
cd "/path/to/Laravel Projects/College_Website"

# 2. Install dependencies (if not already done)
composer install

# 3. Configure database (if not already done)
# Edit .env: DB_DATABASE=college_website

# 4. Run migrations with seeds
php artisan migrate:fresh --seed

# 5. Start the server
php artisan serve

# 6. (Optional) Compile assets in another terminal
npm run dev
```

**Done!** Your system is ready! ✅

---

## Access Your System

### 🔐 Admin Panel

- **URL:** http://localhost:8000/admin
- **Email:** admin@example.com
- **Password:** password

> Use this account or register as an admin (role field on registration). You will automatically be redirected to `/admin` after login if your role is set to admin.

### 👨‍� Faculty Portal

- **URL:** http://localhost:8000/faculty
- **Email:** (Any faculty email from seeded data, e.g., look at faculty records)
- **Password:** password

> Faculty members can only view and manage their own courses. The system matches faculty logins by email.

### 👨‍�🎓 Student Portal

- **URL:** http://localhost:8000/student
- **Email:** (Any student email from seeded data)
- **Password:** password

### 🌐 REST API

- **Base URL:** http://localhost:8000/api/v1
- **Documentation:** See API_DOCUMENTATION.md

---

## 📊 Your Database Is Ready

```
✓ 101 Users (1 admin + 100 students)
✓ 10 Departments
✓ 20 Faculty Members
✓ 50 Courses
✓ 389 Enrollments
```

---

## 🎯 Quick Demo

### Try the Admin Panel

1. Login to http://localhost:8000/admin
2. Go to Departments → Create new department
3. Go to Faculty → View faculty by department
4. Go to Courses → See all courses
5. Go to Students → View student details and enrollments

### Try the Student Portal

1. Logout from admin
2. Login to http://localhost:8000/student with any student email
3. View your dashboard
4. Browse "Courses" tab
5. Search and enroll in new courses
6. View "Dashboard" to see enrolled courses

### Try the API

```bash
# Get list of departments (as admin)
curl -X GET http://localhost:8000/api/v1/admin/departments \
  -H "Authorization: Bearer YOUR_ADMIN_TOKEN"

# Browse available courses (as student)
curl -X GET http://localhost:8000/api/v1/student/courses \
  -H "Authorization: Bearer YOUR_STUDENT_TOKEN"
```

---

## 📚 Learn More

- **Full Documentation:** See README.md
- **API Reference:** See API_DOCUMENTATION.md
- **Setup Guide:** See INSTALLATION.md
- **Project Summary:** See PROJECT_SUMMARY.md

---

## 🆘 Troubleshooting

### Can't connect to database?

```bash
# Check MySQL is running
mysql -u root -p

# Update .env with correct credentials
# Then retry: php artisan migrate:fresh --seed
```

### Port 8000 already in use?

```bash
php artisan serve --port=8001
```

### Views not loading?

```bash
php artisan view:clear
php artisan cache:clear
```

### API authentication failing?

```bash
# Check token format: "Authorization: Bearer TOKEN"
# Token obtained from /api/v1/login endpoint
```

---

## ✅ What You Get

✓ **Complete REST API** - 21 endpoints  
✓ **Admin Panel** - Full CRUD operations  
✓ **Student Portal** - Course browsing & enrollment  
✓ **Authentication** - Sanctum token-based  
✓ **Database** - Pre-seeded with demo data  
✓ **Documentation** - Comprehensive guides  
✓ **Security** - Role-based access control  
✓ **Performance** - Optimized queries  
✓ **Error Handling** - Proper HTTP status codes  
✓ **Bootstrap UI** - Responsive design

---

## 🎉 You're All Set!

Your Advanced Laravel College Management System is ready to use, extend, and deploy to production.

Happy coding! 🚀

---

**For detailed information, see the documentation files included in the project.**
