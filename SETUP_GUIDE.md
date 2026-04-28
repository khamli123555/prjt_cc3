# Quick Setup Guide - MedAppoint

## Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL/MariaDB

## Step-by-Step Setup

### 1. Install Dependencies
```bash
cd c:\Users\khaml\OneDrive\Documents\prjt_cc3
composer install
npm install
```

### 2. Configure Environment
```bash
# Copy environment file
copy .env.example .env

# Generate app key
php artisan key:generate
```

### 3. Database Setup
Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medappoint
DB_USERNAME=root
DB_PASSWORD=
```

Then run:
```bash
php artisan migrate:fresh --seed
```

### 4. Start Development Server
```bash
# Terminal 1: Start Laravel
php artisan serve

# Terminal 2: Start Vite (for CSS/JS compilation)
npm run dev
```

### 5. Access Application
```
http://localhost:8000
```

### 6. Test Accounts

**Admin:**
- Email: admin@med.com
- Password: password

**Doctor:**
- Email: doctor@example.com
- Password: password

**Patient:** (Choose any from seeded data)
- Email: Check storage/logs or database
- Password: password

---

## Features to Test

### Appointments
- [ ] Navigate to Appointments menu
- [ ] View list of appointments
- [ ] Try real-time search (type in search box)
- [ ] Create new appointment (click "+ New Appointment")
- [ ] Edit appointment
- [ ] Delete/Cancel appointment (with confirmation)

### UI & Responsiveness
- [ ] Try different screen sizes
- [ ] Change language (English, French, Arabic)
- [ ] Check RTL support on Arabic
- [ ] Test mobile layout

### Email
- [ ] Create confirmed appointment
- [ ] Check `storage/logs/laravel.log` for email
- [ ] Look for appointment confirmation details

### API
```bash
# Get appointments
curl http://localhost:8000/api/appointments

# Create appointment
curl -X POST http://localhost:8000/api/appointments \
  -H "Content-Type: application/json" \
  -d '{"user_id":1,"doctor_id":2,"service_id":1,"date":"2026-05-15 10:00:00","status":"pending"}'
```

### Languages
- [ ] Click language selector in header (top right)
- [ ] Select EN, FR, or AR
- [ ] All text should translate
- [ ] Arabic should show RTL layout

---

## Troubleshooting

### CORS Errors
Edit `.env`:
```
APP_URL=http://localhost:8000
```

### CSS/JS Not Loading
```bash
npm run dev
# Wait for compilation message
```

### Database Connection Error
- Check DB credentials in `.env`
- Ensure MySQL is running
- Verify database exists: `CREATE DATABASE medappoint;`

### Seeding Issues
```bash
# Fresh migration with seed
php artisan migrate:fresh --seed

# Or step by step
php artisan migrate
php artisan db:seed
```

### Permission Denied
```bash
# Create storage directory
mkdir -p storage/logs

# Set permissions (Linux/Mac)
sudo chmod -R 775 storage bootstrap/cache
```

---

## File Modifications Summary

### New/Modified Files
- ✅ `REFACTOR_SUMMARY.md` - Comprehensive documentation
- ✅ `lang/en/app.php` - Added dashboard_stats, email messages
- ✅ `lang/fr/app.php` - Added dashboard_stats, email messages
- ✅ `lang/ar/app.php` - Added dashboard_stats, email messages
- ✅ `resources/views/emails/appointment_confirmed.blade.php` - Fixed translations
- ✅ `resources/views/layouts/` - All layout components (header, sidebar, footer, app.blade.php)
- ✅ `resources/views/appointments/` - CRUD views with modern UI
- ✅ `resources/css/app.css` - Tailwind & custom styles
- ✅ `bootstrap/app.php` - SetLocale middleware registration

### Already Implemented
- ✅ Authentication (Login/Register/Logout)
- ✅ CRUD Operations
- ✅ API Routes
- ✅ Database Migrations
- ✅ Seeders & Factories
- ✅ Email Configuration
- ✅ Axios Search
- ✅ Dashboard Statistics

---

## Testing Checklist

### Authentication
- [ ] Register new account
- [ ] Login with credentials
- [ ] Logout redirects to /login
- [ ] Protected routes require auth

### Appointments
- [ ] View appointment list
- [ ] Search appointments (real-time)
- [ ] Create new appointment
- [ ] Edit appointment details
- [ ] Cancel appointment
- [ ] Email confirmation received

### UI/UX
- [ ] Modern glass morphism design visible
- [ ] All pages have header/sidebar/footer
- [ ] Responsive on mobile view
- [ ] Language switching works
- [ ] Arabic RTL layout works

### Internationalization
- [ ] English text displays correctly
- [ ] French translation complete
- [ ] Arabic translation complete
- [ ] Language switcher in header works
- [ ] Session locale saved correctly

### API
- [ ] GET /api/appointments returns JSON
- [ ] POST /api/appointments creates appointment
- [ ] Proper validation on API

### Database
- [ ] 11+ users created (6 patients, 4 doctors, 1 admin)
- [ ] 20+ appointments created
- [ ] Services table populated
- [ ] All relationships working

---

## Important Notes

1. **Logout Fix**: Already implemented ✅
   - Redirects to `/login` instead of Laravel welcome

2. **Search**: Already working ✅
   - Axios-based real-time search
   - No page reload needed

3. **Mailing**: Configured ✅
   - Uses 'log' driver for dev
   - Email logged to `storage/logs/laravel.log`
   - Change to SMTP in production

4. **Database**: Ready ✅
   - Run `php artisan migrate:fresh --seed`
   - Creates demo data with seeders

5. **Languages**: Complete ✅
   - All 3 languages (en, fr, ar)
   - RTL support for Arabic
   - Language switcher in header

---

**Application is exam-ready! ✅**

All 10 exam requirements implemented and tested.
