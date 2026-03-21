# 🎓 Advanced Laravel College Management System

> ⚠️ **Important:** If you've been running the project before February 28, 2026, run `php artisan migrate:fresh --seed` to regenerate departments and courses. The latest version seeds realistic department names (Computer Science, AI, etc.) and department‑specific course titles.

A complete, production-ready Laravel 10+ College Management System featuring REST API with Sanctum authentication, Admin Panel, Student Portal, Faculty Portal, and comprehensive role-based access control.

## Project Status: ✅ COMPLETE & READY FOR PRODUCTION

**Version:** 1.0.0  
**Last Updated:** March 18, 2026  
**Status:** ✅ Production Ready

---

## 📋 What Has Been Built

### ✅ Core Components Implemented

#### 1. **Database Layer**

- ✅ 5 database tables with proper relationships
- ✅ Foreign key constraints with cascade delete
- ✅ Unique constraints (e.g., no duplicate enrollments)
- ✅ Soft deletes for courses
- ✅ Proper indexing for performance
- ✅ Database seeders with demo data

#### 2. **Eloquent Models** (5 Models)

- ✅ **User** - With roles (admin, student, faculty), API tokens, relationships
- ✅ **Department** - With hasMany(Faculty, Course)
- ✅ **Faculty** - With belongsTo(Department), hasMany(Course)
- ✅ **Course** - With soft deletes, relationships
- ✅ **Enrollment** - Bridges students and courses
- ✅ **Notice** - For faculty notices requiring admin approval

#### 3. **Authentication & Authorization**

- ✅ **Laravel Sanctum** - Token-based API authentication
- ✅ **Admin Middleware** - Restricts admin routes
- ✅ **Student Middleware** - Restricts student routes
- ✅ **Faculty Middleware** - Restricts faculty routes
- ✅ **Role-based Access Control** - Admin, Faculty, Student
- ✅ **API Token Management** - Create, revoke tokens

#### 4. **API Endpoints (21 Total)**

**Public (2):**

- POST /register - Register new user (any role)
- POST /login - Authenticate user

**Protected (19):**

- GET /me - Current user
- POST /logout - Logout

**Admin (13):**

- GET/POST /departments - CRUD operations
- GET /faculty - List faculty
- GET /courses - List courses
- GET /students - List students
- GET /enrollments - List enrollments
- GET/POST/DELETE /notices - Manage faculty notices

**Faculty (2):**

- GET /courses - List assigned courses
- GET /courses/{id} - Course details with students

**Student (7):**

- GET /courses - Browse courses
- GET /my-courses - Enrolled courses
- GET /profile - User profile
- POST /enroll/{course} - Enroll
- DELETE /unenroll/{course} - Unenroll

#### 5. **Form Request Validation (6 Classes)**

- ✅ StoreDepartmentRequest
- ✅ UpdateDepartmentRequest
- ✅ StoreFacultyRequest
- ✅ UpdateFacultyRequest
- ✅ StoreCourseRequest
- ✅ UpdateCourseRequest

#### 6. **API Resources (6 Classes)**

- ✅ UserResource
- ✅ DepartmentResource
- ✅ FacultyResource
- ✅ CourseResource
- ✅ EnrollmentResource
- ✅ NoticeResource

#### 7. **Controllers (18 Classes)**

**Admin Controllers (6):**

- AdminDashboardController
- AdminDepartmentController
- AdminFacultyController
- AdminStudentController
- AdminCourseController
- AdminNoticeController

**Student Controllers (3):**

- StudentDashboardController
- StudentCourseController
- StudentEnrollmentController

**Faculty Controllers (2):**

- FacultyDashboardController
- FacultyCourseController

**API Controllers (7):**

- AuthController
- Api/Admin/DepartmentController
- Api/Admin/FacultyController
- Api/Admin/CourseController
- Api/Admin/StudentController
- Api/Admin/EnrollmentController
- Api/Admin/NoticeController
- Api/Student/CourseController
- Api/Student/EnrollmentController
- Api/Faculty/CourseController

#### 8. **Web Interface (Blade Views)**

**Admin Panel (16 Views):**

- admin/dashboard.blade.php
- admin/departments/index.blade.php
- admin/departments/create.blade.php
- admin/departments/edit.blade.php
- admin/faculty/index.blade.php
- admin/faculty/create.blade.php
- admin/faculty/edit.blade.php
- admin/courses/index.blade.php
- admin/courses/create.blade.php
- admin/courses/edit.blade.php
- admin/students/index.blade.php
- admin/students/show.blade.php
- admin/notices/index.blade.php
- admin/notices/pending.blade.php

**Student Portal (3 Views):**

- student/dashboard.blade.php
- student/courses/index.blade.php

**Faculty Portal (4 Views):**

- faculty/dashboard.blade.php
- faculty/courses/index.blade.php
- faculty/courses/show.blade.php
- faculty/notices/index.blade.php
- faculty/notices/create.blade.php
- faculty/notices/edit.blade.php

**Layouts (3):**

- layouts/admin.blade.php
- layouts/faculty.blade.php
- layouts/student.blade.php

#### 9. **Routes**

**Web Routes:**

- Admin dashboard & CRUD operations
- Student dashboard & course management
- Faculty dashboard & course/notices management
- Flash messages & redirects

**API Routes:**

- v1 prefix for versioning
- Public authentication endpoints
- Protected admin endpoints
- Protected student endpoints
- Protected faculty endpoints

#### 10. **Database Features**

- ✅ 100+ Users (1 admin + 5 faculty + 100 students)
- ✅ 10 Departments
- ✅ 20 Faculty members
- ✅ 50 Courses
- ✅ Random enrollments (200-600 per run)

---

## ✨ Key Features

### 🔐 Authentication & Security

- **Laravel Sanctum** token-based API authentication
- Role-based access control (Admin, Faculty, Student)
- Secure password hashing
- CSRF protection
- Form request validation

### 👥 User Management

- Admin account for system management
- Student accounts with profile management
- Faculty directory with department assignments
- User enrollment tracking

### 📚 Academic Management

- **Departments** - Create and manage academic departments
- **Faculty** - Manage faculty members and their departments
- **Courses** - Full course management (CRUD operations)
- **Enrollments** - Track student enrollments and course rosters
- **Notices** - Faculty can create notices requiring admin approval

### 👨‍🏫 Faculty Panel

- **URL:** http://localhost:8000/faculty
- View and manage assigned courses
- Create/edit/delete notices for students and admins
- Notices must be approved by an admin before becoming public
- View enrolled students
- Department information
- Dashboard with course statistics

### 👨‍💼 Admin Panel

- Dashboard with real-time statistics
- Department management
- Faculty management
- Student listing and profile viewing
- Enrollment tracking
- Notice approval system
- Responsive Bootstrap 5 interface

### 👨‍🎓 Student Portal

- Dashboard with enrollment overview
- Course browsing with search and filtering
- Course enrollment/unenrollment
- View enrolled courses
- Profile management

### 🌐 REST API

- Fully RESTful API design
- Comprehensive API documentation
- Pagination on all list endpoints
- Search and filtering capabilities
- Proper HTTP status codes and error handling
- JSON API resources for consistent formatting

## 🏗️ Architecture

```
┌─────────────────────────────────────────┐
│      Web Interface (Blade)              │
│  (Admin + Student + Faculty Panels)     │
└─────────────────────────────────────────┘
           ↕
┌─────────────────────────────────────────┐
│     REST API (JSON)                     │
│     (Laravel Sanctum)                   │
└─────────────────────────────────────────┘
           ↕
┌─────────────────────────────────────────┐
│     Controllers & Business Logic        │
│     - Validation (Form Requests)        │
│     - Authorization (Middleware)        │
│     - Transformations (Resources)       │
└─────────────────────────────────────────┘
           ↕
┌─────────────────────────────────────────┐
│     Eloquent Models & Relationships     │
│     (User, Department, Faculty, etc.)   │
└─────────────────────────────────────────┘
           ↕
┌─────────────────────────────────────────┐
│     MySQL/PostgreSQL Database           │
└─────────────────────────────────────────┘
```

## 📊 Database Schema

### Users Table

```
id | name | email | password | role (admin/faculty/student) | phone | profile_photo | timestamps
```

### Departments Table

```
id | name | code | description | timestamps
```

### Faculty Table

```
id | name | email | phone | department_id | timestamps
```

### Courses Table

```
id | name | code | description | credits | department_id | faculty_id | softDeletes | timestamps
```

### Enrollments Table

```
id | student_id | course_id | semester | enrolled_at | timestamps
```

### Notices Table

```
id | title | content | faculty_id | approved | approved_at | admin_id | timestamps
```

## 🚀 Quick Start

### Prerequisites

- PHP 8.1+
- Composer
- MySQL/PostgreSQL
- Node.js & npm

### Installation

```bash
# 1. Navigate to project directory
cd "path/to/Laravel Projects/College_Website"

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Configure database in .env
# DB_CONNECTION=mysql
# DB_DATABASE=college_website
# DB_USERNAME=root

# 5. Run migrations and seed
php artisan migrate:fresh --seed

# 6. Create storage symlink
php artisan storage:link

# 7. Start development server
php artisan serve
# In another terminal: npm run dev

# 8. Visit the application
# Admin: http://localhost:8000/admin
# Faculty: http://localhost:8000/faculty
# Student: http://localhost:8000/student
# API: http://localhost:8000/api/v1
```

_Most seeded data now contains realistic department and course names (e.g. Computer Science, Artificial Intelligence, Machine Learning)._

## 👤 Default Credentials

### Admin Account

```
Email: admin@example.com
Password: password
```

### Faculty Accounts

- Created during seeding (5 faculty accounts)
- Password: `password`
- Check database for faculty emails

### Student Accounts

- Created during seeding (100 student accounts)
- Password: `password`

## 📁 Complete File Structure

```
College_Website/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php ✅
│   │   │   │   ├── DepartmentController.php ✅
│   │   │   │   ├── FacultyController.php ✅
│   │   │   │   ├── StudentController.php ✅
│   │   │   │   ├── CourseController.php ✅
│   │   │   │   └── NoticeController.php ✅
│   │   │   ├── Student/
│   │   │   │   ├── DashboardController.php ✅
│   │   │   │   ├── CourseController.php ✅
│   │   │   │   └── EnrollmentController.php ✅
│   │   │   ├── Faculty/
│   │   │   │   ├── DashboardController.php ✅
│   │   │   │   └── CourseController.php ✅
│   │   │   └── Api/
│   │   │       ├── AuthController.php ✅
│   │   │       ├── Admin/
│   │   │       │   ├── DepartmentController.php ✅
│   │   │       │   ├── FacultyController.php ✅
│   │   │       │   ├── CourseController.php ✅
│   │   │       │   ├── StudentController.php ✅
│   │   │       │   ├── EnrollmentController.php ✅
│   │   │       │   └── NoticeController.php ✅
│   │   │       ├── Student/
│   │   │       │   ├── CourseController.php ✅
│   │   │       │   └── EnrollmentController.php ✅
│   │   │       └── Faculty/
│   │   │           └── CourseController.php ✅
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php ✅
│   │   │   ├── StudentMiddleware.php ✅
│   │   │   └── FacultyMiddleware.php ✅
│   │   ├── Requests/
│   │   │   ├── StoreDepartmentRequest.php ✅
│   │   │   ├── UpdateDepartmentRequest.php ✅
│   │   │   ├── StoreFacultyRequest.php ✅
│   │   │   ├── UpdateFacultyRequest.php ✅
│   │   │   ├── StoreCourseRequest.php ✅
│   │   │   └── UpdateCourseRequest.php ✅
│   │   └── Resources/
│   │       ├── UserResource.php ✅
│   │       ├── DepartmentResource.php ✅
│   │       ├── FacultyResource.php ✅
│   │       ├── CourseResource.php ✅
│   │       ├── EnrollmentResource.php ✅
│   │       └── NoticeResource.php ✅
│   ├── Models/
│   │   ├── User.php ✅
│   │   ├── Department.php ✅
│   │   ├── Faculty.php ✅
│   │   ├── Course.php ✅
│   │   ├── Enrollment.php ✅
│   │   └── Notice.php ✅
│   └── Providers/
│       └── (existing - configured)
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php ✅
│   │   ├── 2025_02_28_000001_create_departments_table.php ✅
│   │   ├── 2025_02_28_000002_create_faculty_table.php ✅
│   │   ├── 2025_02_28_000003_create_courses_table.php ✅
│   │   ├── 2025_02_28_000004_create_enrollments_table.php ✅
│   │   └── 2025_02_28_000005_create_notices_table.php ✅
│   ├── factories/
│   │   ├── DepartmentFactory.php ✅
│   │   ├── FacultyFactory.php ✅
│   │   ├── CourseFactory.php ✅
│   │   ├── EnrollmentFactory.php ✅
│   │   └── NoticeFactory.php ✅
│   └── seeders/
│       └── DatabaseSeeder.php ✅
├── resources/views/
│   ├── layouts/
│   │   ├── admin.blade.php ✅
│   │   ├── faculty.blade.php ✅
│   │   └── student.blade.php ✅
│   ├── admin/
│   │   ├── dashboard.blade.php ✅
│   │   ├── departments/
│   │   │   ├── index.blade.php ✅
│   │   │   ├── create.blade.php ✅
│   │   │   └── edit.blade.php ✅
│   │   ├── faculty/
│   │   │   ├── index.blade.php ✅
│   │   │   ├── create.blade.php ✅
│   │   │   └── edit.blade.php ✅
│   │   ├── courses/
│   │   │   ├── index.blade.php ✅
│   │   │   ├── create.blade.php ✅
│   │   │   └── edit.blade.php ✅
│   │   ├── students/
│   │   │   ├── index.blade.php ✅
│   │   │   └── show.blade.php ✅
│   │   └── notices/
│   │       ├── index.blade.php ✅
│   │       └── pending.blade.php ✅
│   ├── student/
│   │   ├── dashboard.blade.php ✅
│   │   └── courses/
│   │       └── index.blade.php ✅
│   └── faculty/
│       ├── dashboard.blade.php ✅
│       ├── courses/
│       │   ├── index.blade.php ✅
│       │   └── show.blade.php ✅
│       └── notices/
│           ├── index.blade.php ✅
│           ├── create.blade.php ✅
│           └── edit.blade.php ✅
├── routes/
│   ├── api.php ✅
│   ├── web.php ✅
│   └── console.php (existing)
├── bootstrap/
│   └── app.php ✅
├── config/
│   └── sanctum.php ✅
└── Documentation/
    ├── README.md ✅
    ├── INSTALLATION.md ✅
    ├── API_DOCUMENTATION.md ✅
    ├── ENDPOINTS.md ✅
    ├── QUICKSTART.md ✅
    ├── PROJECT_SUMMARY.md ✅
    └── CHECKLIST.md ✅
```

## 🔌 API Endpoints

### Base URL

```
http://localhost:8000/api/v1
```

### Authentication

All protected endpoints require:

```
Authorization: Bearer {token}
```

### Public Endpoints

| Method | Endpoint    | Description         |
| ------ | ----------- | ------------------- |
| POST   | `/register` | Register new user   |
| POST   | `/login`    | Login and get token |

### Protected Endpoints

| Method | Endpoint  | Description      | Role |
| ------ | --------- | ---------------- | ---- |
| GET    | `/me`     | Get current user | Any  |
| POST   | `/logout` | Logout           | Any  |

### Admin Endpoints

| Method | Endpoint                      | Description          |
| ------ | ----------------------------- | -------------------- |
| GET    | `/admin/departments`          | List departments     |
| POST   | `/admin/departments`          | Create department    |
| GET    | `/admin/departments/{id}`     | Get department       |
| PUT    | `/admin/departments/{id}`     | Update department    |
| DELETE | `/admin/departments/{id}`     | Delete department    |
| GET    | `/admin/faculty`              | List faculty         |
| GET    | `/admin/courses`              | List courses         |
| GET    | `/admin/students`             | List students        |
| GET    | `/admin/enrollments`          | List enrollments     |
| GET    | `/admin/notices`              | List all notices     |
| GET    | `/admin/notices/pending`      | List pending notices |
| POST   | `/admin/notices/{id}/approve` | Approve notice       |
| DELETE | `/admin/notices/{id}`         | Delete notice        |

### Faculty Endpoints

| Method | Endpoint                | Description                  |
| ------ | ----------------------- | ---------------------------- |
| GET    | `/faculty/courses`      | List assigned courses        |
| GET    | `/faculty/courses/{id}` | Course details with students |

### Student Endpoints

| Method | Endpoint                       | Description              |
| ------ | ------------------------------ | ------------------------ |
| GET    | `/student/courses`             | Browse available courses |
| GET    | `/student/my-courses`          | Get enrolled courses     |
| GET    | `/student/profile`             | Get student profile      |
| POST   | `/student/enroll/{courseId}`   | Enroll in course         |
| DELETE | `/student/unenroll/{courseId}` | Unenroll from course     |

See [API_DOCUMENTATION.md](API_DOCUMENTATION.md) for complete API reference with examples.

## 🌐 Web Routes

### Admin Panel (`/admin`)

| Method   | Route                   | Description     |
| -------- | ----------------------- | --------------- |
| GET      | `/`                     | Dashboard       |
| GET/POST | `/departments`          | CRUD operations |
| GET/POST | `/faculty`              | CRUD operations |
| GET/POST | `/courses`              | CRUD operations |
| GET      | `/students`             | List students   |
| GET      | `/students/{id}`        | View student    |
| GET      | `/notices`              | List notices    |
| GET      | `/notices/pending`      | Pending notices |
| POST     | `/notices/{id}/approve` | Approve notice  |

### Faculty Panel (`/faculty`)

| Method   | Route           | Description      |
| -------- | --------------- | ---------------- |
| GET      | `/`             | Dashboard        |
| GET      | `/courses`      | Assigned courses |
| GET      | `/courses/{id}` | Course details   |
| GET/POST | `/notices`      | Manage notices   |

### Student Panel (`/student`)

| Method | Route                | Description    |
| ------ | -------------------- | -------------- |
| GET    | `/`                  | Dashboard      |
| GET    | `/courses`           | Browse courses |
| POST   | `/enroll/{course}`   | Enroll         |
| DELETE | `/unenroll/{course}` | Unenroll       |

## 🔒 Middleware

- **AdminMiddleware** - Restrict to admin users only
- **StudentMiddleware** - Restrict to student users only
- **FacultyMiddleware** - Restrict to faculty users only
- **auth** - Authentication requirement
- **verified** - Email verification
- **sanctum** - API token authentication

## ✔️ Validation

All inputs are validated using Form Requests:

- **StoreDepartmentRequest** - Department creation validation
- **UpdateDepartmentRequest** - Department update validation
- **StoreFacultyRequest** - Faculty creation validation
- **UpdateFacultyRequest** - Faculty update validation
- **StoreCourseRequest** - Course creation validation
- **UpdateCourseRequest** - Course update validation

## 📦 Database Seeding

The included seeder creates:

- **1** Admin user
- **5** Faculty users
- **10** Departments
- **20** Faculty members
- **50** Courses
- **100** Students
- **Random enrollments** (2-6 courses per student)
- **Sample notices**

```bash
php artisan db:seed
php artisan migrate:refresh --seed  # Reset and seed
```

## 🧪 Testing the API

### Using cURL

```bash
# Register
curl -X POST http://localhost:8000/api/v1/register \
  -H "Content-Type: application/json" \
  -d '{"name":"John","email":"john@test.com","password":"password123","password_confirmation":"password123"}'

# Login
curl -X POST http://localhost:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@test.com","password":"password123"}'

# Get available courses
curl -X GET http://localhost:8000/api/v1/student/courses \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Using Postman

1. Import endpoints from API documentation
2. Set up Bearer Token authentication
3. Test endpoints with environment variables

## 🎨 Frontend

### Admin Dashboard

- Statistics cards (total students, courses, faculty, departments)
- Recent enrollments table
- Navigation sidebar
- Responsive Bootstrap 5 design

### Faculty Portal

- Course management
- Notice creation and editing
- Student lists per course

### Student Portal

- Welcome dashboard with enrollment overview
- Course browsing with search/filter
- Course details and enrollment buttons
- Enrolled courses listing

## 🔧 Configuration

### Environment Variables

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:xxxx
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=college_website
DB_USERNAME=root
DB_PASSWORD=
```

## 🚀 Production Deployment

1. **Set production environment**

    ```bash
    APP_ENV=production
    APP_DEBUG=false
    ```

2. **Optimize application**

    ```bash
    php artisan optimize
    php artisan config:cache
    php artisan route:cache
    ```

3. **Build assets**

    ```bash
    npm run build
    ```

4. **Set up SSL/HTTPS**
    - Use Let's Encrypt or similar

5. **Configure server**
    - Set document root to `public/`
    - Configure PHP-FPM
    - Set up database backups

6. **Enable caching**
    - Redis for cache and sessions
    - Database query optimization

## 📝 Documentation

- [Installation Guide](INSTALLATION.md) - Detailed setup instructions
- [API Documentation](API_DOCUMENTATION.md) - Complete API reference
- [Endpoints Quick Reference](ENDPOINTS.md) - API endpoints overview
- [Quick Start Guide](QUICKSTART.md) - 60-second setup
- [Project Summary](PROJECT_SUMMARY.md) - Implementation details
- [Checklist](CHECKLIST.md) - Complete feature checklist
- [Laravel Documentation](https://laravel.com/docs) - Framework docs

## 🐛 Troubleshooting

### Database Connection Failed

```bash
# Check .env database credentials
# Verify MySQL is running
mysql -u root -p
# Run migrations
php artisan migrate
```

### Sanctum Not Working

```bash
# Reinstall Sanctum
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### View Not Rendering

```bash
php artisan view:clear
php artisan cache:clear
npm run dev
```

### Storage Access Issues

```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

## 💡 Best Practices Implemented

✅ RESTful API design
✅ Eloquent relationships and eager loading
✅ Form request validation
✅ API Resources for JSON responses
✅ Pagination on list endpoints
✅ Soft deletes on courses
✅ Unique constraints on enrollments
✅ Role-based access control
✅ Clean code organization
✅ Comprehensive error handling
✅ Database transaction support
✅ Query optimization

## 🤝 Contributing

Feel free to submit issues and enhancement requests!

## 📄 License

This project is open source and available under the MIT License.

## 👨‍💻 Author

College Management System - Built with ❤️ using Laravel 10+

---

**Version:** 1.0.0  
**Last Updated:** March 18, 2026  
**Status:** ✅ Production Ready
