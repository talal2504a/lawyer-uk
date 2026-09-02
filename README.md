# LegalConnect Pakistan 🇵🇰

**Live Demo:** https://lawyeruk.kesug.com/
**Platform:** Laravel 8 + PHP 8.1 + MySQL

---

## 📊 Demo Accounts

| Role | Email | Password | Dashboard URL |
|------|-------|----------|---------------|
| 🔑 **Admin** | admin223@gmail.com | pass admin123 | https://lawyeruk.kesug.com/admin/dashboard |
| ⚖️ **Lawyer** | locallawyer@gmail.com | lawyer223 | https://lawyeruk.kesug.com/lawyer/dashboard |
| 👤 **Customer** | localcustomer@gmail.com | customer223 | https://lawyeruk.kesug.com/dashboard |
| 👤 **Demo Customer** | customer223@gmail.com | customer14 | https://lawyeruk.kesug.com/dashboard |

---

## 📁 Project Data Structure

### Root Directory: `c:\lawyer/`
```
c:\lawyer/
├── README.md                    # This file
├── deploy_pkg/                  # Production-ready Laravel package (7374 files)
│   ├── app/                     # Application code
│   ├── bootstrap/               # Framework bootstrap
│   ├── config/                  # Configuration files
│   ├── database/
│   │   ├── migrations/          # Database table schemas
│   │   └── seeders/             # Demo data seeders
│   ├── public/                  # Public assets (CSS, JS, images)
│   ├── resources/
│   │   ├── views/                # Blade templates
│   │   ├── css/js/              # Compiled assets
│   ├── routes/
│   │   ├── web.php               # Web routes
│   │   └── api.php               # API routes
│   ├── storage/
│   │   ├── app/                  # Uploaded files
│   │   ├── framework/
│   │   ├── logs/                # Application logs
│   ├── vendor/                   # Composer dependencies
│   ├── artisan                   # Laravel CLI
│   ├── composer.json             # Dependencies
│   ├── .env                      # Environment config
│   └── .htaccess
│
├── lwyer/                       # Local development copy
│   └── laywer/
│       └── legalconnect-pakistan/# Local Laravel project (9859 files)
│           ├── app/
│           ├── database/
│           ├── resources/views/
│           ├── routes/
│           ├── verify_sql.sql     # Database schema
│           └── README.md
└── README.md                    # This file

---

## 🔧 Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 8, PHP 8.1 |
| **Database** | MySQL 8.0 |
| **Frontend** | Blade Templates, Tailwind CSS, Alpine.js |
| **Icons** | Material Symbols (Google) |
| **Fonts** | Inter, Playfair Display |
| **Hosting** | InfinityFree (Free) |
| **Domain** | lawyeruk.kesug.com (InfinityFree subdomain) |

---

## 🗄️ Database Schema

### Tables (15 total):

| # | Table | Description |
|---|-------|-------------|
| 1 | `users` | All user accounts (customers, lawyers, admins) |
| 2 | `lawyers` | Lawyer profiles (bio, specialization, experience) |
| 3 | `lawyer_specializations` | Many-to-many: lawyers ↔ specializations |
| 4 | `specializations` | Legal specialties (Criminal, Family, Corporate, etc.) |
| 5 | `appointments` | Booking records |
| 6 | `chats` | Messaging system |
| 7 | `notifications` | System notifications |
| 8 | `reviews` | Lawyer reviews |
| 9 | `blog_posts` | Legal blog |
| 10 | `blog_categories` | Blog categories |
| 11 | `faq` | FAQ entries |
| 12 | `contact_messages` | Contact form submissions |
| 13 | `admin_settings` | Admin settings |
| 14 | `password_resets` | Password reset tokens |
| 15 | `failed_jobs` | Failed queued jobs |

---

## 🚀 Features

### Public Features:
- ✅ Responsive homepage with lawyer directory
- ✅ Lawyer search + filtering
- ✅ Lawyer profile pages
- ✅ Booking system (slot-based)
- ✅ Contact forms + FAQ
- ✅ SEO optimized (meta tags, sitemap.xml)
- ✅ Mobile responsive design
- ⚠️ Ads: Adsterra Popunder, Social Bar, Banner 468x60

### Customer Features:
- ✅ User registration + login
- ✅ Dashboard with appointment history
- ✅ Book appointments with lawyers
- ✅ Real-time chat with lawyers (3-second auto-refresh)
- ✅ No page refresh required for chat
- ✅ My Appointments tracking

### Lawyer Features:
- ✅ Lawyer dashboard
- ✅ Appointment management
- ✅ Chat interface (modal-based, real-time)
- ✅ Accept/reject appointments
- ✅ Profile management

### Admin Features:
- ✅ Admin dashboard
- ✅ Lawyer management
- ✅ Appointment system overview
- ✅ User management

---

## 🛠️ Installation (Local Dev)

```bash
# Clone repository
git clone [repo-url]
cd deploy_pkg

# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Set database credentials in .env
php artisan migrate --seed

# Run development server
php artisan serve
```

### .env Configuration:
```env
APP_NAME="LegalConnect Pakistan"
APP_ENV=production
APP_KEY=base64:[KEY]
APP_DEBUG=false
APP_URL=https://lawyeruk.kesug.com

DB_CONNECTION=mysql
DB_HOST=sql303.infinityfree.com
DB_PORT=3306
DB_DATABASE=if0_42811837_lwyer
DB_USERNAME=if0_42811837
DB_PASSWORD=nf5o5dQCPXdz9
```

---

## 📡 Project Routes

### Public Routes:
- `/` - Homepage (lawyer directory + search)
- `/about` - About page
- `/contact` - Contact page
- `/login` - Login page
- `/register` - Registration page
- `/lawyer/{id}` - Lawyer profile page

### Customer Routes:
- `/dashboard` - Customer dashboard
- `/customer/appointments` - Appointment history
- `/customer/chat/{appointmentId}` - Chat interface

### Lawyer Routes:
- `/lawyer/dashboard` - Lawyer dashboard
- `/lawyer/appointments` - Manage appointments
- `/lawyer/chat/{appointmentId}` - Chat interface

### Admin Routes:
- `/admin/dashboard` - Admin dashboard
- `/admin/lawyers` - Manage lawyers
- `/admin/appointments` - All appointments

---

## 🛡️ Security Notes

1. **Environment file** (`.env`) is outside web root → Not accessible publicly
2. **Application source** (`/lc/`) protected via `.htaccess` → Returns 403/404
3. **Public access** only through `/htdocs/index.php` → Single entry point
4. **Passwords** are hashed (bcrypt) in database
5. **Chat messages** are sanitized before display

---

## 🧪 Testing the Flow

1. **Login** as customer: localcustomer@gmail.com / customer223
2. **Find lawyers** → Click any lawyer
3. **Book appointment** → Select date + time slot → confirm
4. **Chat** → Go to My Appointments → open chat modal
5. **Send message** → Appears instantly (no page refresh)
6. **Lawyer side** → Login as lawyer → Accept appointment → chat back

---

## 📋 Changelog

- ✅ Fixed: Booking flow route mismatch
- ✅ Fixed: Chat modal on lawyer appointments page
- ✅ Added: Google Site Verification meta tag
- ✅ Added: Adsterra ads (Popunder, Social Bar, Banner 468x60)
- ✅ Added: Cache clearing mechanism
- ✅ Optimized: SEO meta tags + structured data
- ✅ Added: Real-time chat (3s auto-refresh)

---

## 📞 Support

For questions or issues:
- Local dev docs: `lwyer/laywer/legalconnect-pakistan/README.md`
- Database schema: `lwyer/laywer/verify_sql.sql`
- Production code: `deploy_pkg/`
