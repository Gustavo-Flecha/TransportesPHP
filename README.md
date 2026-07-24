# TransportesPHP - Transport Company Management System

[![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.0-7952B3?style=flat&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-Academic-green)](LICENSE)

> **Academic Project** - Transport Operations Management System developed as part of Systems Analyst degree coursework.

---

## Table of Contents

- [Overview](#overview)
- [Problem Statement](#problem-statement)
- [Key Features](#key-features)
- [Technologies & Stack](#technologies--stack)
- [Project Architecture](#project-architecture)
- [Folder Structure](#folder-structure)
- [Database Design](#database-design)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Screenshots](#screenshots)
- [Technical Decisions](#technical-decisions)
- [Security Implementation](#security-implementation)
- [What This Project Demonstrates](#what-this-project-demonstrates)
- [License](#license)
- [Author](#author)

---

## Overview

**TransportesPHP** is a web-based administrative panel designed to manage the core operations of a transport company. Built with **PHP (procedural)** and **MySQL**, this system handles driver registration, vehicle fleet management, and trip scheduling with visual status indicators based on date proximity.

The project showcases fundamental full-stack development skills including server-side session management, database interactions using both direct queries and stored procedures, and a modern Bootstrap-based user interface.

---

## Problem Statement

Transport companies require efficient systems to:
- Track drivers and vehicle information
- Schedule and monitor trips
- Visualize upcoming, current, and past trips at a glance
- Maintain data integrity across multiple entities (drivers, trucks, trips, destinations)

This project addresses these needs by providing a centralized web application with role-based access control and real-time trip status visualization.

---

## Key Features

### Authentication & Session Management
- Secure login system with server-side validation
- Session-based access control
- User-level role storage (foundation for future RBAC)
- Explicit logout functionality

### Driver Management
- Driver registration with comprehensive validation:
  - Name/Surname (minimum 3 characters)
  - DNI (National ID) with length validation
  - Alphanumeric username requirements
  - Password strength validation (uppercase, lowercase, numbers)
- Integration with stored procedure `InsertarUsuario`

### Vehicle Fleet Management
- Truck/Transport registration
- Dynamic brand catalog loading via `ListarMarcas` procedure
- Validation for: brand, model, year, license plate, and status
- Database insertion via `InsertarTransporte` stored procedure

### Trip Scheduling & Management
-  Trip creation with dynamic data loading:
  - Active drivers (`ObtenerChoferesActivos`)
  - Available vehicles (`ObtenerMarcasModelosPatentes`)
  - Destination catalog
-  Automated driver compensation calculation (percentage-based)
-  Visual trip status indicators based on date:
  - 🟢 **Green**: Past trips
  - 🔴 **Red**: Today's trips
  - 🟡 **Yellow**: Tomorrow's trips
  - 🔵 **Blue**: Future trips

### Trip Listing & Monitoring
-  Comprehensive trip view displaying:
  - Date, Destination
  - Vehicle details (Brand-Model-License Plate)
  - Driver assignment
  - Cost and calculated driver payment
-  Real-time color-coded status based on temporal proximity

---

## Technologies & Stack

### Backend
| Technology | Purpose |
|------------|---------|
| **PHP (Procedural)** | Server-side logic, session management, business rules |
| **MySQLi** | Database connectivity and query execution |
| **MySQL Stored Procedures** | Encapsulated data operations (CRUD) |
| **Prepared Statements** | SQL injection prevention in critical operations |

### Frontend
| Technology | Purpose |
|------------|---------|
| **Bootstrap 5** | Responsive UI framework |
| **NiceAdmin Template** | Professional admin dashboard layout |
| **Bootstrap Icons** | Icon library |
| **Boxicons** | Additional icon set |
| **TinyMCE** | Rich text editor (vendor included) |

### Development Tools
- **Prettier** - Code formatting
- **@prettier/plugin-php** - PHP code style consistency

---

## Project Architecture

### Architectural Pattern
The project follows a **classic monolithic PHP architecture** with layer separation:

```
┌─────────────────────────────────────────┐
│         Presentation Layer              │
│  (Root PHP files + Includes)            │
│  - login.php, index.php                 │
│  - camion_carga.php, chofer_carga.php   │
│  - viaje_carga.php, viajes_listado.php  │
└──────────────┬──────────────────────────┘
               │
┌──────────────▼──────────────────────────┐
│         Business Logic Layer            │
│  (funciones/ directory)                 │
│  - Validations                          │
│  - Data insertion functions             │
│  - Catalog retrieval                    │
└──────────────┬──────────────────────────┘
               │
┌──────────────▼──────────────────────────┐
│         Data Access Layer               │
│  - MySQLi connection                    │
│  - SQL queries                          │
│  - Stored Procedures                    │
└──────────────┬──────────────────────────┘
               │
┌──────────────▼──────────────────────────┐
│         MySQL Database                  │
│  - usuarios, marcas, destinos           │
│  - Stored Procedures                    │
└─────────────────────────────────────────┘
```

### Request Flow
1. **User Authentication** → Session creation with user details and role level
2. **Dashboard Access** → Session validation via `head.inc.php`
3. **Form Submission** → Server-side validation in `funciones/` directory
4. **Data Persistence** → Stored procedures or prepared statements
5. **Data Retrieval** → Query execution and HTML rendering with conditional logic

---

## Folder Structure

```
TransportesPHP/
│
├── assets/                      # Static resources
│   ├── css/                     # Stylesheets
│   ├── js/                      # JavaScript files
│   ├── img/                     # Images
│   └── vendor/                  # Third-party libraries (Bootstrap, TinyMCE, etc.)
│
├── includes/                    # Reusable layout components
│   ├── head.inc.php            # Session protection & HTML head
│   ├── header.inc.php          # Top navigation bar
│   ├── sidebar.inc.php         # Side menu
│   └── footer.inc.php          # Footer section
│
├── funciones/                   # Business logic layer
│   ├── conexion.php            # Database connection
│   ├── login_db.php            # Login authentication
│   ├── validacion_registro_usuario.php
│   ├── validacion_registro_camion.php
│   ├── insertar_usuarios.php
│   ├── insertar_camiones.php
│   ├── insertar_viajes.php
│   └── listados_*.php          # Data retrieval functions
│
├── 2ParcialLimpio/             # Academic documentation
│   ├── TP3_2doDesempenio.pdf   # Project requirements (9 pages)
│   └── HTML prototypes         # Initial static mockups
│
├── login.php                    # User authentication
├── index.php                    # Dashboard/Home
├── chofer_carga.php            # Driver registration
├── camion_carga.php            # Vehicle registration
├── viaje_carga.php             # Trip creation
├── viajes_listado.php          # Trip listing with visual status
└── cerrar_sesion.php           # Logout functionality
```

**File Distribution:**
- `.php` files: **25**
- `.js` files: **340** (mostly vendor libraries)
- `.css` files: **134** (Bootstrap + NiceAdmin theme)

---

## Database Design

### Tables (inferred from code)
- **usuarios** - User/driver records
- **marcas** - Vehicle brands
- **destinos** - Trip destinations
- **transportes** - Vehicle fleet
- **viajes** - Trip records

### Stored Procedures
| Procedure Name | Purpose |
|----------------|---------|
| `InsertarUsuario` | Driver/user registration |
| `InsertarTransporte` | Vehicle registration |
| `InsertarViajes` | Trip scheduling |
| `ListarMarcas` | Retrieve brand catalog |
| `ObtenerChoferesActivos` | Get active drivers list |
| `ObtenerMarcasModelosPatentes` | Get vehicle details |
| `ListarViajes` | Retrieve trip records with joins |

> ** Note:** Database schema scripts are not included in the repository. The application expects the database structure and stored procedures to be pre-configured.

---

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 8.0+
- Apache/Nginx web server
- phpMyAdmin (optional, for database management)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/Gustavo-Flecha/TransportesPHP.git
   cd TransportesPHP
   ```

2. **Set up the database**
   - Create a MySQL database (e.g., `transportes_db`)
   - Execute the schema creation script (see Configuration section)
   - Import stored procedures

3. **Configure web server**
   - Point document root to project directory
   - Enable `.htaccess` overrides (if using Apache)
   - Ensure PHP MySQLi extension is enabled

---

## Configuration

### Database Connection

Edit `funciones/conexion.php` with your database credentials:

```php
<?php
$host = "localhost";
$user = "your_db_user";
$password = "your_db_password";
$database = "transportes_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### Database Schema Setup

**Note:** Since no `.sql` file is included in the repository, you'll need to create:
1. Database tables based on the entities referenced in the code
2. Stored procedures used by the application (see Database Design section)
3. Sample data for brands and destinations

---

## Usage

1. **Access the application**
   - Navigate to `http://localhost/TransportesPHP/login.php`

2. **Login**
   - Enter valid credentials (must exist in `usuarios` table)
   - Session will be created with user details and role level

3. **Dashboard Features**
   - **Drivers**: Register new drivers with validated information
   - **Vehicles**: Add trucks with brand, model, year, and license plate
   - **Trips**: Schedule trips by selecting driver, vehicle, and destination
   - **Trip Listing**: View all trips with color-coded status indicators

4. **Logout**
   - Click logout to destroy session and return to login page

---

## Screenshots

### Dashboard
![Admin Dashboard]<img width="720" height="516" alt="Camiones2" src="https://github.com/user-attachments/assets/83cd1073-02ae-4549-ad26-be42f7cfab1d" />

*Main control panel built with NiceAdmin template*
*Trip overview with color-coded temporal status*

### Driver Registration
![Driver Form]<img width="720" height="456" alt="Camiones" src="https://github.com/user-attachments/assets/605bf77f-0e07-4b3a-8e68-971a1b21465e" />

*Driver registration with comprehensive validation rules*


---

## Technical Decisions

### 1. **Stored Procedures for Data Operations**
**Reasoning:** Encapsulates business logic at the database layer, reducing code duplication and centralizing data integrity rules.

**Benefits:**
- Improved performance for complex queries
- Transaction management at DB level
- Easier maintenance of business rules

### 2. **Session-Based Authentication**
**Approach:** Traditional PHP sessions with server-side storage of user credentials and role level.

**Implementation:**
- Session protection via `includes/head.inc.php`
- User context available across all protected pages
- Foundation for future role-based access control (RBAC)

### 3. **Layout Component Reusability**
**Pattern:** Separated common UI elements (header, sidebar, footer) into `includes/` directory.

**Advantages:**
- DRY (Don't Repeat Yourself) principle
- Consistent user experience
- Simplified maintenance and updates

### 4. **Prepared Statements for Critical Operations**
**Security consideration:** Used prepared statements with parameter binding for user, vehicle, and trip insertions.

**Impact:**
- Prevents SQL injection on data entry forms
- Demonstrates awareness of OWASP Top 10 vulnerabilities

### 5. **Server-Side Validation**
**Approach:** Dedicated validation functions in `funciones/` directory before database operations.

**Validation rules implemented:**
- String length minimums (names, DNI)
- Character composition (alphanumeric usernames)
- Password complexity (mixed case + numbers)
- Required field checks

---

## Security Implementation

### Implemented Security Measures

| Measure | Implementation | Location |
|---------|---------------|----------|
| **Session Control** | Access restriction to admin panel | `includes/head.inc.php` |
| **Explicit Logout** | Session destruction with `session_destroy()` | `cerrar_sesion.php` |
| **Input Sanitization** | `trim()`, `strip_tags()` on form inputs | Validation functions |
| **SQL Injection Prevention** | Prepared statements with parameter binding | `insertar_*.php` files |
| **Data Escaping** | `mysqli_real_escape_string()` | Various insertion functions |

---

## What This Project Demonstrates

### Technical Competencies

**Backend Development:**
- PHP procedural programming
- Session management and authentication flows
- MySQL database integration (MySQLi)
- Stored procedure implementation and consumption
- Server-side form validation
- Prepared statement usage for data persistence

**Frontend Development:**
- Bootstrap 5 responsive design
- Template integration (NiceAdmin)
- Dynamic content rendering
- Conditional UI logic (color-coded trip status)

**Software Engineering Practices:**
- Code organization and modularization
- Separation of concerns (partial layer separation)
- Reusable component design
- Input validation patterns
- Academic documentation and requirement adherence

### Problem-Solving Abilities
- Understanding of business domain (transport operations)
- Translation of academic requirements into functional code
- Implementation of temporal logic for trip status visualization
- Database design inference and stored procedure creation

---

## License

This project was developed as part of academic coursework for the **Systems Analyst** degree program. It is intended for educational and portfolio purposes.

---

## Author

**Gustavo Flecha**

- GitHub: [@Gustavo-Flecha](https://github.com/Gustavo-Flecha)
- Project Link: [https://github.com/Gustavo-Flecha/TransportesPHP](https://github.com/Gustavo-Flecha/TransportesPHP)

---

## Academic Context

This project was developed to fulfill the requirements of **TP3 - 2nd Performance Evaluation** as part of the Systems Analyst curriculum. The 9-page specification document (`2ParcialLimpio/TP3_2doDesempenio.pdf`) outlines the functional requirements, data model, and role-based rules implemented in this system.

The project demonstrates progression from static HTML prototypes to a fully functional PHP/MySQL application with authentication, data validation, and business logic implementation.

---

<div align="center">

**Built with** ❤️ **and** ☕ **for academic excellence and professional growth**

</div>
