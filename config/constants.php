<?php
/**
 * Application Constants
 */

// App Info
define('APP_NAME', 'Health Monitoring System');
define('APP_VERSION', '1.0.0');
define('APP_ENVIRONMENT', 'development'); // development, production

// Paths
define('BASE_PATH', dirname(dirname(__FILE__)));
define('PUBLIC_PATH', BASE_PATH . '/public');
define('APP_PATH', BASE_PATH . '/app');
define('CONFIG_PATH', BASE_PATH . '/config');
define('VIEWS_PATH', APP_PATH . '/views');
define('CONTROLLERS_PATH', APP_PATH . '/controllers');
define('MODELS_PATH', APP_PATH . '/models');

// URL
define('SITE_URL', 'http://localhost/extreme-programming');
define('API_URL', SITE_URL . '/api');

// Security
define('SESSION_TIMEOUT', 3600); // 1 hour
define('PASSWORD_HASH_ALGO', PASSWORD_BCRYPT);
define('PASSWORD_HASH_OPTIONS', ['cost' => 10]);

// Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'health_monitoring');
define('DB_CHARSET', 'utf8mb4');

// User Roles
define('ROLE_PATIENT', 'patient');
define('ROLE_DOCTOR', 'doctor');
define('ROLE_ADMIN', 'admin');

// Alert Types
define('ALERT_CRITICAL', 'critical');
define('ALERT_WARNING', 'warning');
define('ALERT_NORMAL', 'normal');

// Notification Types
define('NOTIF_INFO', 'info');
define('NOTIF_WARNING', 'warning');
define('NOTIF_DANGER', 'danger');
define('NOTIF_SUCCESS', 'success');

// Health Parameters - Normal Ranges
define('HEART_RATE_MIN', 60);
define('HEART_RATE_MAX', 100);

define('SYSTOLIC_MIN', 90);
define('SYSTOLIC_MAX', 120);
define('DIASTOLIC_MIN', 60);
define('DIASTOLIC_MAX', 80);

define('BODY_TEMP_MIN', 36.1);
define('BODY_TEMP_MAX', 37.2);

define('RESPIRATORY_RATE_MIN', 12);
define('RESPIRATORY_RATE_MAX', 20);

define('BLOOD_OXYGEN_MIN', 95);
define('BLOOD_OXYGEN_MAX', 100);

// BMI Categories
define('BMI_UNDERWEIGHT_MAX', 18.5);
define('BMI_NORMAL_MAX', 24.9);
define('BMI_OVERWEIGHT_MAX', 29.9);
define('BMI_OBESE_MIN', 30.0);

// Appointment Status
define('APPOINTMENT_SCHEDULED', 'scheduled');
define('APPOINTMENT_COMPLETED', 'completed');
define('APPOINTMENT_CANCELLED', 'cancelled');
define('APPOINTMENT_RESCHEDULED', 'rescheduled');

// Pagination
define('ITEMS_PER_PAGE', 10);
define('ITEMS_PER_PAGE_SMALL', 5);

// File Upload
define('UPLOAD_DIR', PUBLIC_PATH . '/uploads');
define('PROFILE_PHOTO_DIR', UPLOAD_DIR . '/profiles');
define('MAX_FILE_SIZE', 5242880); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif']);

// Error Messages
define('ERROR_DATABASE', 'Database connection error');
define('ERROR_UNAUTHORIZED', 'Unauthorized access');
define('ERROR_INVALID_DATA', 'Invalid data provided');
define('ERROR_NOT_FOUND', 'Resource not found');

// Success Messages
define('SUCCESS_LOGIN', 'Login successful');
define('SUCCESS_REGISTER', 'Registration successful');
define('SUCCESS_UPDATE', 'Data updated successfully');
define('SUCCESS_DELETE', 'Data deleted successfully');
define('SUCCESS_CREATE', 'Data created successfully');

// Email Configuration (for notifications)
define('MAIL_FROM', 'noreply@healthmonitoring.com');
define('MAIL_FROM_NAME', APP_NAME);
define('SMTP_HOST', 'localhost');
define('SMTP_PORT', 587);
define('SMTP_USER', '');
define('SMTP_PASS', '');
