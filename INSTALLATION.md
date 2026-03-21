# Advanced Laravel College Management System

A complete Laravel 10+ College Management System with REST API, Admin Panel, Student Panel, and role-based access control.

## Features

- ✅ **REST API** with Laravel Sanctum authentication
- ✅ **Admin Panel** - Manage departments, faculty, courses, and students
- ✅ **Student Panel** - View profile, search courses, and enroll in courses
- ✅ **Role-Based Access Control** - Admin and Student roles
- ✅ **Laravel Sanctum** - Token-based API authentication
- ✅ **Form Request Validation** - Robust input validation
- ✅ **API Resources** - Formatted JSON responses
- ✅ **Eager Loading** - Optimized database queries
- ✅ **Pagination** - Built-in pagination for list views
- ✅ **Clean Architecture** - Well-organized code structure
- ✅ **Database Seeders** - Demo data included

## System Overview

### User Roles

**Admin**

- Full access to manage the system
- Can create, update, delete departments, faculty, courses
- Can view all students and their enrollment details
- Access to admin dashboard with statistics

**Faculty**

- Can view their assigned courses
- Can create/edit/delete notices (requires admin approval before visible to everyone)
- Can see all enrolled students in their courses
- Can view department information
- Access to faculty dashboard with course statistics
- Faculty accounts are linked by email to Faculty records

**Student**

- Can browse available courses
- Can enroll/unenroll from courses
- Can view their profile and enrolled courses
- Access to student dashboard

## Database Structure

### Users Table

```
id, name, email, password, role (enum: admin, student, faculty), phone, profile_photo, timestamps
```

### Departments Table

```
id, name, code, description, timestamps
```

### Faculty Table

```
id, name, email, phone, department_id (FK), timestamps
```

### Courses Table

```
id, name, code, description, credits, department_id (FK), faculty_id (FK), softDeletes, timestamps
```

### Enrollments Table

```
id, student_id (FK → users), course_id (FK → courses), semester, enrolled_at, timestamps
```

## Model Relationships

- **Department** → hasMany(Faculty), hasMany(Course)
- **Faculty** → belongsTo(Department), hasMany(Course)
- **Course** → belongsTo(Department), belongsTo(Faculty), belongsToMany(User as students), hasMany(Enrollment)
- **User** → belongsToMany(Course) [if student], hasMany(Enrollment)
- **Enrollment** → belongsTo(User), belongsTo(Course)

## Installation Instructions

### Prerequisites

- PHP 8.1+
- MySQL/PostgreSQL
- Composer
- Node.js & npm

### Step 1: Setup Laravel Project

```bash
# Navigate to project directory
cd /path/to/Laravel Projects/College_Website

# Install dependencies
composer install

# Install npm packages
npm install
```

### Step 2: Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key (already done if APP_KEY exists)
php artisan key:generate
```

Update `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=college_website
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3: Database Setup

```bash
# Run migrations
php artisan migrate

# Seed the database with demo data
php artisan db:seed
```

### Step 4: Setup Sanctum

```bash
# Publish Sanctum configuration (if needed)
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### Step 5: Storage Links

```bash
# Create storage symlink for file uploads (if using file storage)
php artisan storage:link
```

### Step 6: Run Development Server

```bash
# Start Laravel development server
php artisan serve

# In another terminal, run npm for asset compilation
npm run dev
```

Visit: `http://localhost:8000`

## Demo Credentials

> **Note:** When using the web registration form you can now choose a **role** (admin, faculty, or student). If you simply need an admin account for testing, use the seeded admin credentials below. The system also includes 5 pre-seeded faculty accounts. Also, the seeded departments and courses now use meaningful names like "Computer Science" or "Artificial Intelligence".

### Admin Account

```
Email: admin@example.com
Password: password
```

### Faculty Accounts

- **Count:** 5 pre-seeded faculty accounts (linked to faculty records by email)
- **Password:** password
- View faculty emails by checking the Faculty table in the database. Example query:
    ```bash
    php artisan tinker
    > App\Models\Faculty::pluck('email')
    ```

### Student Accounts

```
Email: Any student email (created during seeding)
Password: password
```

## API Endpoints

### Base URL

```
http://localhost:8000/api/v1
```

### Authentication Endpoints (Public)

#### Register

```http
POST /register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "phone": "+1234567890"
}
```

**Response:**

```json
{
    "message": "User registered successfully",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "student",
        "phone": "+1234567890"
    },
    "token": "1|xxxxxxxxxxxxx"
}
```

#### Login

```http
POST /login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response:**

```json
{
  "message": "Login successful",
  "data": {...},
  "token": "1|xxxxxxxxxxxxx"
}
```

#### Get Authenticated User

```http
GET /me
Authorization: Bearer {token}
```

#### Logout

```http
POST /logout
Authorization: Bearer {token}
```

### Admin API Endpoints (Protected - requires admin role)

#### Departments

```http
GET /admin/departments
GET /admin/departments/{id}
POST /admin/departments
Content-Type: application/json

{
  "name": "Computer Science",
  "code": "CS",
  "description": "Department of Computer Science"
}

PUT /admin/departments/{id}
DELETE /admin/departments/{id}
```

#### Faculty

```http
GET /admin/faculty
GET /admin/faculty/{id}
```

#### Courses

```http
GET /admin/courses
GET /admin/courses/{id}
```

#### Students

```http
GET /admin/students
GET /admin/students/{id}
```

#### Enrollments

```http
GET /admin/enrollments
GET /admin/enrollments/{id}
```

### Student API Endpoints (Protected - requires student role)

#### Courses

```http
GET /student/courses
GET /student/my-courses
```

**Query Parameters:**

- `search` - Search by name or code
- `department_id` - Filter by department
- `per_page` - Items per page (default: 15)

#### Enrollment

```http
POST /student/enroll/{courseId}
Content-Type: application/json

{
  "semester": "Fall 2024"
}

DELETE /student/unenroll/{courseId}
```

#### Profile

```http
GET /student/profile
```

## Web Routes

### Admin Routes (Prefix: `/admin`)

```
GET  /                          - Dashboard
GET  /departments               - List departments
GET  /departments/create        - Create department form
POST /departments               - Store department
GET  /departments/{id}/edit     - Edit department form
PUT  /departments/{id}          - Update department
DELETE /departments/{id}        - Delete department

GET  /faculty                   - List faculty
GET  /faculty/create            - Create faculty form
POST /faculty                   - Store faculty
GET  /faculty/{id}/edit         - Edit faculty form
PUT  /faculty/{id}              - Update faculty
DELETE /faculty/{id}            - Delete faculty

GET  /courses                   - List courses
GET  /students                  - List students
GET  /students/{id}             - View student details
```

### Student Routes (Prefix: `/student`)

```
GET  /                          - Dashboard
GET  /courses                   - Available courses
GET  /courses/{id}              - View course details
GET  /enrolled                  - Enrolled courses
POST /enroll/{course}           - Enroll in course
DELETE /unenroll/{course}       - Unenroll from course
```

## Controller Structure

```
app/Http/Controllers/
├── Admin/
│   ├── DashboardController
│   ├── DepartmentController
│   ├── FacultyController
│   ├── StudentController
│   └── CourseController
├── Student/
│   ├── DashboardController
│   ├── CourseController
│   └── EnrollmentController
└── Api/
    ├── AuthController
    ├── Admin/
    │   ├── DepartmentController
    │   ├── FacultyController
    │   ├── CourseController
    │   ├── StudentController
    │   └── EnrollmentController
    └── Student/
        ├── CourseController
        ├── EnrollmentController
        └── ProfileController
```

## Middleware

- **AdminMiddleware** - Restricts access to admin users only
- **StudentMiddleware** - Restricts access to student users only
- **auth:sanctum** - API authentication middleware

## API Resources

- `UserResource` - User information
- `DepartmentResource` - Department information
- `FacultyResource` - Faculty information with department
- `CourseResource` - Course information with relationships
- `EnrollmentResource` - Enrollment information with student and course

## Form Requests (Validation)

- `StoreDepartmentRequest` - Validate department creation
- `UpdateDepartmentRequest` - Validate department update
- `StoreFacultyRequest` - Validate faculty creation
- `UpdateFacultyRequest` - Validate faculty update
- `StoreCourseRequest` - Validate course creation
- `UpdateCourseRequest` - Validate course update

## Database Seeding

The database seeder creates:

```
✓ 1 Admin user
✓ 10 Departments
✓ 20 Faculty members
✓ 50 Courses
✓ 100 Students
✓ Random enrollments (2-6 courses per student)
```

Run seeder:

```bash
php artisan db:seed
```

Or reset and seed:

```bash
php artisan migrate:refresh --seed
```

## File Structure

```
College_Website/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   ├── Requests/
│   │   └── Resources/
│   ├── Models/
│   └── Providers/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       ├── admin/
│       └── student/
├── routes/
│   ├── api.php
│   └── web.php
├── .env
├── composer.json
└── package.json
```

## Key Features Implemented

### 1. REST API with Sanctum

- ✅ Token-based authentication
- ✅ API resource formatting
- ✅ Pagination support
- ✅ Search and filtering
- ✅ Error handling

### 2. Admin Panel

- ✅ Dashboard with statistics
- ✅ Department management (CRUD)
- ✅ Faculty management (CRUD)
- ✅ Student management
- ✅ Enrollment tracking

### 3. Student Panel

- ✅ Dashboard with enrollment info
- ✅ Course browsing with search/filter
- ✅ Course enrollment/unenrollment
- ✅ Profile view
- ✅ Enrolled courses list

### 4. Security

- ✅ Role-based access control
- ✅ Authorization middleware
- ✅ Form request validation
- ✅ CSRF protection
- ✅ Sanctum token authentication

### 5. Best Practices

- ✅ Eloquent relationships
- ✅ Eager loading (prevent N+1 queries)
- ✅ Soft deletes on courses
- ✅ Unique constraints (no duplicate enrollments)
- ✅ Clean code organization
- ✅ RESTful API design

## Troubleshooting

### Database Connection Error

```bash
# Update .env with correct database credentials
# Then run:
php artisan migrate:refresh --seed
```

### Migration Error - Foreign Key

```bash
# Check MySQL version (8.0+ required for certain constraints)
# Or disable foreign key checks temporarily:
php artisan migrate:refresh --seed --force
```

### API Token Not Working

```bash
# Ensure Sanctum middleware is configured in routes/api.php
# Verify Authorization header: Bearer {token}
```

### Views Not Loading

```bash
# Clear cache and recompile
php artisan view:clear
php artisan cache:clear
npm run build
```

## API Testing Examples

### Using cURL

#### Register Student

```bash
curl -X POST http://localhost:8000/api/v1/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Jane Doe",
    "email": "jane@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "+1234567890"
  }'
```

#### Login

```bash
curl -X POST http://localhost:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "jane@example.com",
    "password": "password123"
  }'
```

#### Get Enrolled Courses

```bash
curl -X GET http://localhost:8000/api/v1/student/my-courses \
  -H "Authorization: Bearer YOUR_TOKEN"
```

#### Enroll in Course

```bash
curl -X POST http://localhost:8000/api/v1/student/enroll/1 \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "semester": "Fall 2024"
  }'
```

### Using Postman

1. Create new collection
2. Set base URL: `http://localhost:8000/api/v1`
3. Use `Bearer Token` for Authorization
4. Import endpoints and test

## Production Checklist

- [ ] Set `APP_DEBUG=false` in .env
- [ ] Set `APP_ENV=production`
- [ ] Update database credentials
- [ ] Configure MAIL settings
- [ ] Set up HTTPS/SSL
- [ ] Configure QUEUE driver
- [ ] Set up log rotation
- [ ] Run `php artisan optimize`
- [ ] Run `npm run build` (or `build:prod`)
- [ ] Configure backup strategy
- [ ] Set up monitoring

## Support & Documentation

- Laravel Documentation: https://laravel.com/docs
- Laravel Sanctum: https://laravel.com/docs/sanctum
- Bootstrap Documentation: https://getbootstrap.com/docs

## License

This project is open source and available under the MIT license.

## Author

College Management System - Built with Laravel 10+

---

**Version:** 1.0.0  
**Last Updated:** February 28, 2026
