Our software is a web-based platform designed to connect rural and remote communities
with sustainable energy solutions

Steven Mitchell Mamites: JavaScripts/Functionalities
Jer Erick Dumalagan: Login/Registration
Monico Vian Baxal: CSS for Login/Registration and other parts of the website

## Backend API

The backend is a PHP API built following SOLID principles.

### Quick Start

#### Windows:
```bash
start-backend.bat
```

#### Linux/Mac:
```bash
chmod +x start-backend.sh
./start-backend.sh
```

#### Manual Start:
```bash
cd backend
php -S localhost:8000 -t . start-server.php
```

### Database Setup

1. Make sure MySQL/MariaDB is running
2. Run the migration:
```bash
mysql -u root -p < backend/database/migrations/create_tables.sql
```

3. Configure database settings in `backend/config/config.php`

### API Endpoints

- `POST /api/auth/register` - Register new user
- `POST /api/auth/login` - Login user
- `GET /api/projects` - List all projects
- `POST /api/projects` - Create project
- `GET /api/projects/{id}` - Get project by ID
- `PUT /api/projects/{id}` - Update project
- `DELETE /api/projects/{id}` - Delete project
- `GET /api/users/{userId}/projects` - Get user's projects

For detailed API documentation, see [backend/README.md](backend/README.md)

### Testing the API

Use curl or Postman to test:

```bash
# Register a user
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{"username":"testuser","email":"test@example.com","password":"password123","first_name":"Test","last_name":"User"}'

# Login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password123"}'
```