# MedAppoint - Medical Appointment Manager

MedAppoint is a modern, responsive web application built with Laravel to manage medical appointments. It allows patients to book services with doctors and enables medical staff to manage schedules efficiently.

## Features

- **i18n Support**: Full support for English, French, and Arabic.
- **Dynamic Search**: Real-time appointment filtering using AlpineJS and Axios.
- **Automated Mailing**: Email confirmations sent to patients upon appointment confirmation.
- **Premium UI**: Modern interface with glassmorphism effects and smooth transitions.
- **RESTful API**: Comprehensive API endpoints for external integrations.

---

## Installation

Follow these steps to set up the project locally:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/prjt_cc3.git
   cd prjt_cc3
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**:
   Update your `.env` file with your database credentials (default is SQLite).
   ```bash
   # For SQLite (default)
   DB_CONNECTION=sqlite
   ```

5. **Run Migrations & Seeders**:
   ```bash
   php artisan migrate --seed
   ```

6. **Start the application**:
   ```bash
   php artisan serve
   ```

---

## Default Login Credentials

After seeding the database, you can use the following accounts:

- **Doctor Account**:
    - **Email**: `doctor@example.com`
    - **Password**: `password`
- **Patient Account**:
    - Use any seeded patient email (check `users` table) with password `password`.

---

## API Documentation

### 1. List Appointments
**Method**: `GET`  
**URL**: `/api/appointments`  
**Description**: Returns a paginated list of all appointments.

**Example Response**:
```json
{
    "data": [
        {
            "id": 1,
            "patient": {
                "id": 2,
                "name": "John Doe",
                "email": "john@example.com"
            },
            "doctor": {
                "id": 1,
                "name": "Dr. Smith",
                "email": "doctor@example.com"
            },
            "service": {
                "id": 3,
                "name": "General Consultation",
                "price": 50
            },
            "date": "2026-05-10 14:30:00",
            "status": "confirmed"
        }
    ],
    "links": { ... },
    "meta": { ... }
}
```

### 2. Create Appointment
**Method**: `POST`  
**URL**: `/api/appointments`  
**Description**: Creates a new appointment.

**Body (JSON)**:
```json
{
    "user_id": 2,
    "doctor_id": 1,
    "service_id": 3,
    "date": "2026-06-15 10:00:00"
}
```

**Success Response (201 Created)**:
```json
{
    "data": {
        "id": 15,
        "patient": { ... },
        "doctor": { ... },
        "service": { ... },
        "date": "2026-06-15 10:00:00",
        "status": "pending"
    }
}
```

---

## License

The MedAppoint project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
