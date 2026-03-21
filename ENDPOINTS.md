# API Endpoints Quick Reference

## Base URL

```
http://localhost:8000/api/v1
```

## Authentication

```
Authorization: Bearer {token}
```

---

## Public Endpoints (No Auth Required)

| Method | Endpoint    | Description          |
| ------ | ----------- | -------------------- |
| POST   | `/register` | Register new student |
| POST   | `/login`    | Login and get token  |

---

## Protected Endpoints (Auth Required)

| Method | Endpoint  | Description      | Auth     |
| ------ | --------- | ---------------- | -------- |
| GET    | `/me`     | Get current user | Any user |
| POST   | `/logout` | Logout user      | Any user |

---

## Admin Endpoints

### Faculty Notices (admin only)

| Method | Endpoint                          | Description          |
| ------ | --------------------------------- | -------------------- |
| GET    | `/admin/notices`                  | List all notices     |
| GET    | `/admin/notices/pending`          | List pending notices |
| POST   | `/admin/notices/{notice}/approve` | Approve notice       |
| DELETE | `/admin/notices/{notice}`         | Delete a notice      |

### Departments

| Method | Endpoint                  | Description          |
| ------ | ------------------------- | -------------------- |
| GET    | `/admin/departments`      | List all departments |
| POST   | `/admin/departments`      | Create department    |
| GET    | `/admin/departments/{id}` | Get department by ID |
| PUT    | `/admin/departments/{id}` | Update department    |
| DELETE | `/admin/departments/{id}` | Delete department    |

### Faculty

| Method | Endpoint              | Description       |
| ------ | --------------------- | ----------------- |
| GET    | `/admin/faculty`      | List all faculty  |
| GET    | `/admin/faculty/{id}` | Get faculty by ID |

### Faculty API Endpoints (for faculty users)

| Method | Endpoint                | Description            |
| ------ | ----------------------- | ---------------------- |
| GET    | `/faculty/courses`      | List your courses      |
| GET    | `/faculty/courses/{id}` | Details of your course |

### Courses

| Method | Endpoint              | Description      |
| ------ | --------------------- | ---------------- |
| GET    | `/admin/courses`      | List all courses |
| GET    | `/admin/courses/{id}` | Get course by ID |

### Students

| Method | Endpoint               | Description       |
| ------ | ---------------------- | ----------------- |
| GET    | `/admin/students`      | List all students |
| GET    | `/admin/students/{id}` | Get student by ID |

### Enrollments

| Method | Endpoint                  | Description          |
| ------ | ------------------------- | -------------------- |
| GET    | `/admin/enrollments`      | List all enrollments |
| GET    | `/admin/enrollments/{id}` | Get enrollment by ID |

---

## Student Endpoints

### Courses

| Method | Endpoint              | Description            |
| ------ | --------------------- | ---------------------- |
| GET    | `/student/courses`    | List available courses |
| GET    | `/student/my-courses` | Get enrolled courses   |

### Profile

| Method | Endpoint           | Description         |
| ------ | ------------------ | ------------------- |
| GET    | `/student/profile` | Get student profile |

### Enrollment

| Method | Endpoint                       | Description          |
| ------ | ------------------------------ | -------------------- |
| POST   | `/student/enroll/{courseId}`   | Enroll in course     |
| DELETE | `/student/unenroll/{courseId}` | Unenroll from course |

---

## Query Parameters

Most list endpoints support:

- `search` - Search by name/email/code
- `page` - Page number (default: 1)
- `per_page` - Items per page (default: 15)

Example:

```
GET /admin/departments?search=Computer&page=1&per_page=25
GET /student/courses?search=programming&department_id=1
```

---

## Status Codes

| Code | Meaning                      |
| ---- | ---------------------------- |
| 200  | OK - Success                 |
| 201  | Created - Resource created   |
| 204  | No Content                   |
| 400  | Bad Request                  |
| 401  | Unauthorized - No auth token |
| 403  | Forbidden - Wrong role       |
| 404  | Not Found                    |
| 422  | Validation Error             |
| 500  | Server Error                 |

---

## Example Requests

### Register

```bash
curl -X POST http://localhost:8000/api/v1/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
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
    "email": "john@example.com",
    "password": "password123"
  }'
```

### Get Departments

```bash
curl -X GET "http://localhost:8000/api/v1/admin/departments?search=computer" \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Create Department

```bash
curl -X POST http://localhost:8000/api/v1/admin/departments \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Engineering",
    "code": "ENG",
    "description": "School of Engineering"
  }'
```

### Browse Courses (Student)

```bash
curl -X GET "http://localhost:8000/api/v1/student/courses" \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Enroll in Course (Student)

```bash
curl -X POST http://localhost:8000/api/v1/student/enroll/5 \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "semester": "Fall 2024"
  }'
```

---

## Response Format

All responses are in JSON format:

**Success Response:**

```json
{
  "message": "Operation successful",
  "data": {...}
}
```

**List Response:**

```json
{
  "data": [...],
  "links": {...},
  "meta": {
    "current_page": 1,
    "total": 100,
    "per_page": 15
  }
}
```

**Error Response:**

```json
{
    "message": "Error description",
    "errors": {
        "field": ["Error message"]
    }
}
```

---

## Testing with Postman

1. Create environment variables:
    - `base_url`: http://localhost:8000
    - `token`: (obtained from login)

2. Use Bearer Token authentication:
    - Type: Bearer Token
    - Value: `{{token}}`

3. Test endpoints:
    - Import into Postman
    - Set environment
    - Send requests

---

## Total Endpoints

- **Public:** 2
- **Protected (any):** 2
- **Admin:** 10
- **Student:** 7
- **Total:** 21 endpoints

---

For complete API documentation, see `API_DOCUMENTATION.md`
