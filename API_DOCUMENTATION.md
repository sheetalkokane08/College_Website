# College Management System - API Documentation

## Base URL

```
http://localhost:8000/api/v1
```

## Authentication

All protected endpoints require:

```
Authorization: Bearer {token}
```

Tokens are obtained from `/login` or `/register` endpoints.

---

## Public Endpoints

### 1. User Registration

**Endpoint:** `POST /register`

**Description:** Register a new account. By default users are created as students, but the `role` field may be supplied (`admin`, `faculty`, or `student`) when registering via API or web form.

**Request:**

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "+1234567890",
    "role": "student"  # optional, set to "admin" for an administrator, "faculty" for a faculty member
}
```

**Response:** `201 Created`

```json
{
    "message": "User registered successfully",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "student",
        "phone": "+1234567890",
        "profile_photo": null,
        "created_at": "2026-02-28T10:00:00.000000Z",
        "updated_at": "2026-02-28T10:00:00.000000Z"
    },
    "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
}
```

**Error Response:** `422 Unprocessable Entity`

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email has already been taken."]
    }
}
```

---

### 2. User Login

**Endpoint:** `POST /login`

**Description:** Authenticate user and get access token

**Request:**

```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Response:** `200 OK`

```json
{
    "message": "Login successful",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "student",
        "phone": "+1234567890",
        "profile_photo": null,
        "created_at": "2026-02-28T10:00:00.000000Z",
        "updated_at": "2026-02-28T10:00:00.000000Z"
    },
    "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
}
```

**Error Response:** `422 Unprocessable Entity`

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The provided credentials are incorrect."]
    }
}
```

---

## Protected Endpoints

### 3. Get Authenticated User

**Endpoint:** `GET /me`

**Authorization:** Required (any authenticated user)

**Response:** `200 OK`

```json
{
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "student",
        "phone": "+1234567890",
        "profile_photo": null,
        "created_at": "2026-02-28T10:00:00.000000Z",
        "updated_at": "2026-02-28T10:00:00.000000Z"
    }
}
```

---

### 4. User Logout

**Endpoint:** `POST /logout`

**Authorization:** Required (any authenticated user)

**Response:** `200 OK`

```json
{
    "message": "Logged out successfully"
}
```

---

## Admin API Endpoints

> **Note:** All admin endpoints require `role = admin`

### Departments

#### 5. List All Departments

**Endpoint:** `GET /admin/departments`

**Query Parameters:**

- `search` (string) - Search by name or code
- `per_page` (integer, default: 15) - Items per page
- `page` (integer, default: 1) - Page number

**Example:**

```
GET /admin/departments?search=Computer&per_page=10&page=1
```

**Response:** `200 OK`

```json
{
    "data": [
        {
            "id": 1,
            "name": "Computer Science",
            "code": "CS",
            "description": "Department of Computer Science",
            "created_at": "2026-02-28T10:00:00.000000Z",
            "updated_at": "2026-02-28T10:00:00.000000Z"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/v1/admin/departments?page=1",
        "last": "http://localhost:8000/api/v1/admin/departments?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://localhost:8000/api/v1/admin/departments",
        "per_page": 15,
        "to": 10,
        "total": 10
    }
}
```

---

#### 6. Create Department

**Endpoint:** `POST /admin/departments`

**Request:**

```json
{
    "name": "Engineering",
    "code": "ENG",
    "description": "School of Engineering"
}
```

**Response:** `201 Created`

```json
{
    "message": "Department created successfully",
    "data": {
        "id": 11,
        "name": "Engineering",
        "code": "ENG",
        "description": "School of Engineering",
        "created_at": "2026-02-28T10:00:00.000000Z",
        "updated_at": "2026-02-28T10:00:00.000000Z"
    }
}
```

---

#### 7. Get Department

**Endpoint:** `GET /admin/departments/{id}`

**Response:** `200 OK`

```json
{
    "data": {
        "id": 1,
        "name": "Computer Science",
        "code": "CS",
        "description": "Department of Computer Science",
        "created_at": "2026-02-28T10:00:00.000000Z",
        "updated_at": "2026-02-28T10:00:00.000000Z"
    }
}
```

---

#### 8. Update Department

**Endpoint:** `PUT /admin/departments/{id}`

**Request:**

```json
{
    "name": "Computer Science & Engineering",
    "code": "CSE",
    "description": "Updated description"
}
```

**Response:** `200 OK`

```json
{
    "message": "Department updated successfully",
    "data": {
        "id": 1,
        "name": "Computer Science & Engineering",
        "code": "CSE",
        "description": "Updated description",
        "created_at": "2026-02-28T10:00:00.000000Z",
        "updated_at": "2026-02-28T10:00:00.000000Z"
    }
}
```

---

#### 9. Delete Department

**Endpoint:** `DELETE /admin/departments/{id}`

**Response:** `200 OK`

```json
{
    "message": "Department deleted successfully"
}
```

---

### Faculty

#### 10. List Faculty

**Endpoint:** `GET /admin/faculty`

**Query Parameters:**

- `search` (string) - Search by name or email
- `department_id` (integer) - Filter by department
- `per_page` (integer, default: 15)
- `page` (integer, default: 1)

**Response:** `200 OK`

```json
{
  "data": [
    {
      "id": 1,
      "name": "Dr. Jane Smith",
      "email": "jane@example.com",
      "phone": "+1234567890",
      "department_id": 1,
      "department": {
        "id": 1,
        "name": "Computer Science",
        "code": "CS",
        "description": "Department of Computer Science",
        "created_at": "2026-02-28T10:00:00.000000Z",
        "updated_at": "2026-02-28T10:00:00.000000Z"
      },
      "created_at": "2026-02-28T10:00:00.000000Z",
      "updated_at": "2026-02-28T10:00:00.000000Z"
    }
  ],
  "links": {...},
  "meta": {...}
}
```

---

### Courses

#### 11. List Courses

**Endpoint:** `GET /admin/courses`

**Query Parameters:**

- `search` (string) - Search by name or code
- `department_id` (integer) - Filter by department
- `per_page` (integer, default: 15)
- `page` (integer, default: 1)

**Response:** `200 OK`

```json
{
  "data": [
    {
      "id": 1,
      "name": "Introduction to Computer Science",
      "code": "CS-101",
      "description": "Basic CS concepts",
      "credits": 3,
      "department_id": 1,
      "faculty_id": 1,
      "department": {...},
      "faculty": {...},
      "created_at": "2026-02-28T10:00:00.000000Z",
      "updated_at": "2026-02-28T10:00:00.000000Z"
    }
  ],
  "links": {...},
  "meta": {...}
}
```

---

#### 12. Get Course Details

**Endpoint:** `GET /admin/courses/{id}`

**Response:** `200 OK` (same as list item above)

---

### Students

#### 13. List Students

**Endpoint:** `GET /admin/students`

**Query Parameters:**

- `search` (string) - Search by name or email
- `per_page` (integer, default: 15)
- `page` (integer, default: 1)

**Response:** `200 OK`

```json
{
  "data": [
    {
      "id": 2,
      "name": "John Doe",
      "email": "john@example.com",
      "role": "student",
      "phone": "+1234567890",
      "profile_photo": null,
      "created_at": "2026-02-28T10:00:00.000000Z",
      "updated_at": "2026-02-28T10:00:00.000000Z"
    }
  ],
  "links": {...},
  "meta": {...}
}
```

---

#### 14. Get Student Details

**Endpoint:** `GET /admin/students/{id}`

**Response:** `200 OK` (same as above)

---

### Enrollments

#### 15. List Enrollments

**Endpoint:** `GET /admin/enrollments`

**Query Parameters:**

- `student_id` (integer) - Filter by student
- `course_id` (integer) - Filter by course
- `per_page` (integer, default: 15)
- `page` (integer, default: 1)

**Response:** `200 OK`

```json
{
  "data": [
    {
      "id": 1,
      "student_id": 2,
      "course_id": 1,
      "semester": "Fall 2024",
      "enrolled_at": "2026-02-28T10:00:00.000000Z",
      "student": {...},
      "course": {...},
      "created_at": "2026-02-28T10:00:00.000000Z",
      "updated_at": "2026-02-28T10:00:00.000000Z"
    }
  ],
  "links": {...},
  "meta": {...}
}
```

---

#### 16. Get Enrollment Details

**Endpoint:** `GET /admin/enrollments/{id}`

**Response:** `200 OK` (same as above)

---

## Faculty API Endpoints

> **Note:** All faculty endpoints require `role = faculty`. Faculty members can only access their own courses.

### Courses

#### 17. List Faculty's Courses

**Endpoint:** `GET /faculty/courses`

**Query Parameters:**

- `per_page` (integer, default: 15)
- `page` (integer, default: 1)

**Response:** `200 OK`

```json
{
    "data": [
        {
            "id": 1,
            "name": "Data Structures",
            "code": "DAT-001",
            "description": "Learn about data structures and algorithms",
            "credits": 3,
            "department_id": 1,
            "faculty_id": 1,
            "created_at": "2026-02-28T10:00:00.000000Z",
            "updated_at": "2026-02-28T10:00:00.000000Z",
            "department": { "id": 1, "name": "Computer Science", ... },
            "faculty": { "id": 1, "name": "Dr. John Smith", ... }
        }
    ],
    "meta": { "current_page": 1, "total": 5, ... }
}
```

---

#### 18. Get Faculty Course Details with Students

**Endpoint:** `GET /faculty/courses/{id}`

**Response:** `200 OK` - Returns course with enrolled students info

```json
{
    "data": {
        "id": 1,
        "name": "Data Structures",
        "code": "DAT-001",
        "credits": 3,
        "students_count": 25,
        "department": { ... },
        "faculty": { ... }
    }
}
```

**Error Response:** `403 Forbidden` - If faculty tries to access another faculty member's course

---

## Student API Endpoints

> **Note:** All student endpoints require `role = student`

### Courses

#### 17. List Available Courses

**Endpoint:** `GET /student/courses`

**Query Parameters:**

- `search` (string) - Search by name or code
- `department_id` (integer) - Filter by department
- `per_page` (integer, default: 15)
- `page` (integer, default: 1)

**Response:** `200 OK` (same as admin courses list)

---

#### 18. Get Enrolled Courses

**Endpoint:** `GET /student/my-courses`

**Query Parameters:**

- `per_page` (integer, default: 15)
- `page` (integer, default: 1)

**Response:** `200 OK` (paginated list of student's enrolled courses)

---

### Profile

#### 19. Get Student Profile

**Endpoint:** `GET /student/profile`

**Response:** `200 OK`

```json
{
    "data": {
        "id": 2,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "student",
        "phone": "+1234567890",
        "profile_photo": null,
        "created_at": "2026-02-28T10:00:00.000000Z",
        "updated_at": "2026-02-28T10:00:00.000000Z"
    }
}
```

---

### Enrollment

#### 20. Enroll in Course

**Endpoint:** `POST /student/enroll/{courseId}`

**Request:**

```json
{
    "semester": "Fall 2024"
}
```

**Response:** `201 Created`

```json
{
  "message": "Successfully enrolled in course",
  "data": {
    "id": 101,
    "student_id": 2,
    "course_id": 1,
    "semester": "Fall 2024",
    "enrolled_at": "2026-02-28T10:00:00.000000Z",
    "student": {...},
    "course": {...},
    "created_at": "2026-02-28T10:00:00.000000Z",
    "updated_at": "2026-02-28T10:00:00.000000Z"
  }
}
```

**Error Response - Already Enrolled:** `422 Unprocessable Entity`

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "enrollment": ["You are already enrolled in this course"]
    }
}
```

---

#### 21. Unenroll from Course

**Endpoint:** `DELETE /student/unenroll/{courseId}`

**Response:** `200 OK`

```json
{
    "message": "Successfully unenrolled from course"
}
```

**Error Response:** `404 Not Found`

```json
{
    "message": "Enrollment not found"
}
```

---

## Error Responses

### 400 Bad Request

```json
{
    "message": "Bad request"
}
```

### 401 Unauthorized

```json
{
    "message": "Unauthenticated."
}
```

### 403 Forbidden

```json
{
    "message": "Unauthorized. Admin access required."
}
```

### 404 Not Found

```json
{
    "message": "Resource not found"
}
```

### 422 Unprocessable Entity

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "field": ["Error message"]
    }
}
```

### 500 Internal Server Error

```json
{
    "message": "Server error"
}
```

---

## Rate Limiting

Not currently implemented. Can be added using Laravel's rate limiting middleware.

---

## Pagination

All list endpoints return paginated responses with the following structure:

```json
{
  "data": [...],
  "links": {
    "first": "url",
    "last": "url",
    "prev": "url or null",
    "next": "url or null"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 5,
    "path": "url",
    "per_page": 15,
    "to": 15,
    "total": 75
  }
}
```

---

## HTTP Status Codes

| Code | Meaning               |
| ---- | --------------------- |
| 200  | OK                    |
| 201  | Created               |
| 204  | No Content            |
| 400  | Bad Request           |
| 401  | Unauthorized          |
| 403  | Forbidden             |
| 404  | Not Found             |
| 422  | Unprocessable Entity  |
| 500  | Internal Server Error |

---

## Examples with cURL

### Register

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

### Login

```bash
curl -X POST http://localhost:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "jane@example.com",
    "password": "password123"
  }'
```

### Get Available Courses

```bash
curl -X GET "http://localhost:8000/api/v1/student/courses?search=programming" \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Enroll in Course

```bash
curl -X POST http://localhost:8000/api/v1/student/enroll/5 \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "semester": "Fall 2024"
  }'
```

### Create Department (Admin)

```bash
curl -X POST http://localhost:8000/api/v1/admin/departments \
  -H "Authorization: Bearer ADMIN_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Business Administration",
    "code": "BUS",
    "description": "School of Business"
  }'
```

---

## Testing the API

### Using Postman

1. Download Postman from https://www.postman.com/downloads
2. Create a new collection
3. Set environment variable: `base_url = http://localhost:8000/api/v1`
4. Set environment variable: `token` (after login)
5. Create requests for each endpoint

### Using Insomnia

1. Download Insomnia from https://insomnia.rest
2. Import the endpoints
3. Use Bearer Token authentication

### Using ThunderClient (VS Code)

1. Install ThunderClient extension in VS Code
2. Create environment with `base_url` and `token`
3. Test endpoints directly from editor

---

## Useful Links

- API Base: http://localhost:8000/api/v1
- Admin Dashboard: http://localhost:8000/admin
- Student Dashboard: http://localhost:8000/student
- Laravel Docs: https://laravel.com/docs
