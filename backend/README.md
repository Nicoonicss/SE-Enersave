# SE-Enersave Backend API

A PHP backend API built following SOLID principles for the SE-Enersave platform.

## Architecture

This backend follows the SOLID principles for clean, maintainable code:

### Single Responsibility Principle (SRP)
- Each class has a single, well-defined responsibility
- Models handle data operations
- Controllers handle HTTP requests
- Services handle business logic
- Repositories handle data access

### Open/Closed Principle (OCP)
- Classes are open for extension but closed for modification
- Interfaces define contracts that can be extended
- New features can be added without modifying existing code

### Liskov Substitution Principle (LSP)
- Derived classes are substitutable for their base classes
- All repositories implement RepositoryInterface
- All validators implement ValidatorInterface

### Interface Segregation Principle (ISP)
- Interfaces are specific and focused
- No client is forced to depend on methods it doesn't use
- Separate interfaces for different concerns

### Dependency Inversion Principle (DIP)
- High-level modules don't depend on low-level modules
- Both depend on abstractions (interfaces)
- Dependency injection is used throughout

## Directory Structure

```
backend/
├── api.php                 # Main entry point
├── bootstrap.php           # Dependency injection & setup
├── CORS.php               # CORS middleware
├── config/
│   ├── config.php        # Configuration
│   └── Database.php      # Database singleton
├── Models/
│   ├── Model.php         # Base model
│   ├── User.php          # User model
│   └── Project.php       # Project model
├── Repositories/
│   ├── RepositoryInterface.php
│   ├── UserRepository.php
│   └── ProjectRepository.php
├── Services/
│   ├── ServiceInterface.php
│   ├── AuthService.php
│   └── ProjectService.php
├── Controllers/
│   ├── Controller.php    # Base controller
│   ├── AuthController.php
│   └── ProjectController.php
├── Validators/
│   ├── ValidatorInterface.php
│   ├── RegistrationValidator.php
│   └── ProjectValidator.php
├── Router/
│   └── Router.php        # Simple router
└── database/
    └── migrations/
        └── create_tables.sql
```

## Setup

1. **Database Setup**
   ```bash
   mysql -u root -p < backend/database/migrations/create_tables.sql
   ```

2. **Configuration**
   Edit `backend/config/config.php` to match your database settings.

3. **Run Server**
   ```bash
   php -S localhost:8000 -t backend backend/api.php
   ```

## API Endpoints

### Authentication
- `POST /api/auth/register` - Register a new user
- `POST /api/auth/login` - Login user

### Projects
- `GET /api/projects` - Get all projects
- `GET /api/projects/{id}` - Get single project
- `POST /api/projects` - Create new project
- `PUT /api/projects/{id}` - Update project
- `DELETE /api/projects/{id}` - Delete project
- `GET /api/users/{userId}/projects` - Get user's projects

## Example Requests

### Register User
```bash
POST /api/auth/register
Content-Type: application/json

{
  "username": "johndoe",
  "email": "john@example.com",
  "password": "password123",
  "first_name": "John",
  "last_name": "Doe"
}
```

### Login
```bash
POST /api/auth/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password123"
}
```

### Create Project
```bash
POST /api/projects
Content-Type: application/json

{
  "project_name": "Solar Farm Installation",
  "community_name": "Green Valley",
  "project_description": "Large-scale solar installation",
  "location": "City, State, Country",
  "population": 500,
  "energy_type": "solar",
  "energy_capacity": 50.0,
  "budget": 100000,
  "timeline": "6-12 months",
  "challenges": "Lack of funding",
  "support_needed": "funding, technical",
  "contact_person": "John Doe",
  "contact_email": "john@example.com",
  "contact_phone": "+1 555-1234",
  "user_id": 1
}
```

## Testing

You can test the API using tools like:
- Postman
- cURL
- Browser's developer console

Example cURL:
```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{"username":"testuser","email":"test@example.com","password":"password123","first_name":"Test","last_name":"User"}'
```

## SOLID Principles Implementation

### Examples:

**Single Responsibility**: Each class has one job
- `AuthService` only handles authentication logic
- `AuthController` only handles HTTP requests for auth
- `UserRepository` only handles user data access

**Dependency Inversion**: Depend on abstractions
```php
class AuthService {
    private UserRepository $userRepository;  // Depends on interface, not concrete class
    private ?ValidatorInterface $validator;
}
```

**Open/Closed**: Extend without modifying
```php
// Can add new validators without modifying AuthService
class EmailValidator implements ValidatorInterface { }
class PhoneValidator implements ValidatorInterface { }
```

## Future Enhancements

- JWT token authentication
- File upload handling
- Caching layer
- API rate limiting
- Logging system
- Unit and integration tests
- More comprehensive validation

