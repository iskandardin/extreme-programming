# Development Guide - Extreme Programming Methodology

## Iterasi 1: Setup & Autentikasi ✓ (COMPLETED)

### Tasks Completed:
- [x] Database schema creation
- [x] User model implementation
- [x] Patient model implementation
- [x] Login form & validation
- [x] Registration form & validation
- [x] Session management
- [x] Basic styling & layouts
- [x] Patient dashboard

### Files Created:
```
config/
├── config.php (Main configuration)
├── constants.php (App constants)
└── database.php (DB connection)

app/
├── models/
│   ├── User.php
│   └── Patient.php
└── views/
    ├── auth/
    │   ├── login.php
    │   ├── register.php
    │   └── logout.php
    └── patient/
        └── dashboard.php

public/
├── index.php (Router)
├── css/
│   └── style.css
└── js/
    └── main.js

database/
└── schema.sql
```

## Iterasi 2: Health Data Input & Monitoring (TODO)

### Tasks to Complete:
- [ ] HealthData model
- [ ] Health data form (input vital signs)
- [ ] Health data validation
- [ ] Health history list
- [ ] Basic chart display (Chart.js)
- [ ] Real-time data display

### Files to Create:
```
app/
├── models/
│   └── HealthData.php
└── views/
    └── health/
        ├── add.php
        ├── list.php
        └── chart.php

public/
├── js/
│   └── chart.js
```

## Iterasi 3: Alerts & Notifications (TODO)

### Tasks to Complete:
- [ ] HealthAlert model
- [ ] Notification model
- [ ] Alert checking logic
- [ ] Email notifications
- [ ] Dashboard notifications
- [ ] Alert acknowledgement

### Files to Create:
```
app/
├── models/
│   ├── HealthAlert.php
│   └── Notification.php
└── views/
    └── notifications/
        ├── list.php
        └── alert.php
```

## Iterasi 4: Doctor Dashboard & Patient Management (TODO)

### Tasks to Complete:
- [ ] Doctor model
- [ ] Doctor dashboard
- [ ] Patient-Doctor relations
- [ ] Patient list for doctor
- [ ] Doctor can view patient health data
- [ ] Doctor can add notes

### Files to Create:
```
app/
├── models/
│   └── Doctor.php
└── views/
    └── doctor/
        ├── dashboard.php
        └── patient_detail.php
```

## Iterasi 5: Appointments & Prescriptions (TODO)

### Tasks to Complete:
- [ ] Appointment model
- [ ] Prescription model
- [ ] Appointment booking
- [ ] Appointment list
- [ ] Prescription management
- [ ] Prescription display

### Files to Create:
```
app/
├── models/
│   ├── Appointment.php
│   └── Prescription.php
└── views/
    └── appointment/
        ├── list.php
        ├── book.php
        └── prescriptions.php
```

## Iterasi 6: Admin Panel & Reports (TODO)

### Tasks to Complete:
- [ ] Admin dashboard
- [ ] User management
- [ ] System reports
- [ ] Activity logs
- [ ] Statistics & analytics
- [ ] Data export

### Files to Create:
```
app/
├── models/
│   └── AuditLog.php
└── views/
    └── admin/
        ├── dashboard.php
        ├── users.php
        └── reports.php
```

## Iterasi 7: Testing & Security (TODO)

### Tasks to Complete:
- [ ] Unit tests
- [ ] Integration tests
- [ ] Security audit
- [ ] Performance optimization
- [ ] Code review

### Files to Create:
```
tests/
└── unit/
    ├── UserTest.php
    ├── PatientTest.php
    └── HealthDataTest.php
```

---

## XP Best Practices

### Code Review Checklist:
- [ ] Code follows naming conventions
- [ ] Functions are small and focused
- [ ] Comments explain "why", not "what"
- [ ] No duplicate code
- [ ] Error handling implemented
- [ ] Security checks done
- [ ] SQL uses prepared statements

### Testing Checklist:
- [ ] Happy path works
- [ ] Error cases handled
- [ ] Edge cases considered
- [ ] Database transactions proper
- [ ] Session handling correct

### Security Checklist:
- [ ] SQL injection prevention (prepared statements)
- [ ] XSS prevention (htmlspecialchars)
- [ ] CSRF token usage
- [ ] Password hashing (bcrypt)
- [ ] Input validation
- [ ] Output sanitization

### Performance Checklist:
- [ ] Database queries optimized
- [ ] N+1 queries prevented
- [ ] Indexes used properly
- [ ] No unnecessary loops
- [ ] CSS/JS minified

---

## Running Tests

```bash
# Unit tests
php tests/unit/UserTest.php

# Run all tests
php tests/run_tests.php
```

## Code Standards

### Naming Conventions:
- Classes: PascalCase (User, Patient, HealthData)
- Methods: camelCase (getByUserId, createPatient)
- Variables: snake_case ($user_id, $patient_data)
- Constants: SCREAMING_SNAKE_CASE (SITE_URL, MAX_FILE_SIZE)

### File Organization:
- Controllers handle requests
- Models handle database
- Views handle display
- Config handles settings

### Comment Style:
```php
/**
 * Short description
 * 
 * Longer description if needed
 * 
 * @param type $param Description
 * @return type Description
 */
```

---

## Deployment Checklist

- [ ] Change APP_ENVIRONMENT to 'production'
- [ ] Set secure database credentials
- [ ] Enable error logging
- [ ] Disable debug output
- [ ] Set proper file permissions
- [ ] Create .env file for secrets
- [ ] Run security audit
- [ ] Test all features
- [ ] Backup database

---

## Support & Help

For more information about the system:
- Check README.md for overview
- Check database/schema.sql for DB structure
- Check config/constants.php for configuration
- Follow PSR-4 autoloading standards
