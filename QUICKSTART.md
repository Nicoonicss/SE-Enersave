# Quick Start Guide - SE-Enersave Backend

## Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher (or MariaDB)
- Composer (optional, not required for this simple setup)

## Step 1: Database Setup

1. Make sure MySQL is running
2. Create the database and tables:

```bash
mysql -u root -p < backend/database/migrations/create_tables.sql
```

This will create:
- Database: `enersave_db`
- Tables: `users`, `projects`, `project_timeline`, `reviews`

## Step 2: Configure Database

Edit `backend/config/config.php` and update your database credentials:

```php
'database' => [
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'enersave_db',
    'username' => 'root',        // Change if needed
    'password' => '',             // Add your password
],
```

## Step 3: Start the Server

### Option A: Using Scripts (Recommended)

**Windows:**
```bash
start-backend.bat
```

**Linux/Mac:**
```bash
chmod +x start-backend.sh
./start-backend.sh
```

### Option B: Manual Start

```bash
cd backend
php -S localhost:8000 -t . start-server.php
```

The server will be available at: `http://localhost:8000`

## Step 4: Test the API

### Option A: Using the Test Page

Open `backend/example-usage.html` in your browser and click the test buttons.

### Option B: Using cURL

**Register a new user:**
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d "{\"username\":\"johndoe\",\"email\":\"john@example.com\",\"password\":\"password123\",\"first_name\":\"John\",\"last_name\":\"Doe\"}"
```

**Login:**
```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d "{\"email\":\"john@example.com\",\"password\":\"password123\"}"
```

**Create a project:**
```bash
curl -X POST http://localhost:8000/api/projects \
  -H "Content-Type: application/json" \
  -d "{\"project_name\":\"Solar Farm\",\"community_name\":\"Green Valley\",\"project_description\":\"Solar installation\",\"location\":\"City, State\",\"contact_person\":\"John Doe\",\"contact_email\":\"john@example.com\",\"user_id\":1}"
```

**Get all projects:**
```bash
curl http://localhost:8000/api/projects
```

## API Endpoints

### Authentication
- `POST /api/auth/register` - Register a new user
- `POST /api/auth/login` - Login user

### Projects
- `GET /api/projects` - Get all projects
- `GET /api/projects/{id}` - Get project by ID
- `POST /api/projects` - Create new project
- `PUT /api/projects/{id}` - Update project
- `DELETE /api/projects/{id}` - Delete project
- `GET /api/users/{userId}/projects` - Get user's projects

## Example Response

### Successful Response:
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "id": 1,
        "username": "johndoe",
        "email": "john@example.com",
        "first_name": "John",
        "last_name": "Doe"
    }
}
```

### Error Response:
```json
{
    "success": false,
    "message": "Email already registered"
}
```

## Troubleshooting

### Database Connection Error
- Make sure MySQL is running
- Check credentials in `backend/config/config.php`
- Verify database was created: `mysql -u root -p -e "SHOW DATABASES;"`

### Port Already in Use
If port 8000 is busy, change it:
```bash
php -S localhost:8080 -t backend backend/api.php
```

### CORS Issues
If making requests from a different origin, update CORS settings in `backend/CORS.php`

## Next Steps

1. Integrate the API with your frontend
2. Add authentication middleware for protected routes
3. Implement file uploads for project images
4. Add search and filtering for projects
5. Implement pagination for large datasets

## Architecture

The backend follows SOLID principles:

- **Single Responsibility**: Each class has one job
- **Open/Closed**: Extend without modifying
- **Liskov Substitution**: Implement interfaces properly
- **Interface Segregation**: Specific interfaces
- **Dependency Inversion**: Depend on abstractions

See `backend/README.md` for detailed architecture documentation.

## Support

For issues or questions, check:
- `backend/README.md` for API documentation
- `backend/example-usage.html` for usage examples
- Code comments for implementation details

