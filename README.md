## Prerequisites

Before you begin, ensure you have the following installed:

- Docker
- Docker Compose

## Setup

**Build and start the Docker containers:**

```sh
docker-compose up --build
```

The application should be running at `http://localhost:8080`.

## Endpoints

### CREATE EMPLOYEE

#### URI

POST http://localhost:8080/employees

#### Body examples

```json
{
  "provider_type": "A",
  "Role": "Software Engineer",
  "Password": "NewPass123!",
  "Gender": "F",
  "Birthday": "12-12-1995",
  "FullName": "Jane Doe",
  "Telephone": "123-456-7890",
  "EmailAddress": "jane.doe@example.com"
}
```

```json
{
  "provider_type": "B",
  "position": "Product Manager",
  "password": "SecurePass456!",
  "sex": "M",
  "day_of_birth": "05-05-1992",
  "name": "John",
  "surname": "Smith",
  "phone_number": "987-654-3210",
  "email": "john.smith@example.com"
}
```

### UPDATE EMPLOYEE

#### URI

PATCH http://localhost:8080/employees/{id}

#### Body examples

```json
{
  "provider_type": "X",
  "position": "Lead Engineer",
  "email": "jane.doe@company.com"
}
```

```json
{
  "provider_type": "X",
  "position": "Lead Engineer",
  "email": "jane.doe@company.com"
}
```
