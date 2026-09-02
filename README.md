# LegalConnect Pakistan

A comprehensive law firm platform connecting customers with verified lawyers across Pakistan.

## Live Demo

**Website:** https://lawyeruk.kesug.com/

## Demo Accounts

| Role | Email | Password | Dashboard URL |
|------|-------|----------|---------------|
| Admin | admin223@gmail.com | admin123 | https://lawyeruk.kesug.com/admin/dashboard |
| Lawyer | locallawyer@gmail.com | lawyer223 | https://lawyeruk.kesug.com/lawyer/dashboard |
| Customer | localcustomer@gmail.com | customer223 | https://lawyeruk.kesug.com/dashboard |
| Demo Customer | customer223@gmail.com | customer14 | https://lawyeruk.kesug.com/dashboard |

## Features

### Customer Panel
- Search & filter lawyers by specialization, city, experience
- Book appointments with time slot selection
- Real-time chat with lawyers
- View & manage appointments
- Rate & review lawyers

### Lawyer Panel
- Manage profile & specializations
- Set availability & time slots
- Accept/reject appointments
- Real-time chat with customers
- View case history

### Admin Panel
- Dashboard with statistics
- Manage lawyers (approve/verify)
- Manage customers
- Manage specializations
- View all appointments

## Tech Stack

- **Framework:** Laravel 8
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Authentication:** Laravel Auth
- **Real-time:** AJAX polling for chat

## Database Schema

- users, lawyers, customers, admins
- specializations, lawyer_specialization
- time_slots, appointments, chats
- meetings, payments, notifications

## Installation

1. Clone the repository:
   `ash
   git clone https://github.com/talal2504a/lawyer-uk.git
   cd lawyer-uk
   `

2. Install dependencies:
   `ash
   composer install
   npm install
   `

3. Configure environment:
   `ash
   cp .env.example .env
   php artisan key:generate
   `

4. Set your database credentials in .env

5. Run migrations:
   `ash
   php artisan migrate
   `

6. Start the server:
   `ash
   php artisan serve
   `

## Project Structure

`
app/
├── Http/Controllers/    # Admin, Auth, Customer, Lawyer controllers
├── Models/              # User, Lawyer, Appointment, Chat, etc.
├── Middleware/          # Auth, NoCache, Role-based
resources/
├── views/
│   ├── admin/           # Admin dashboard & management
│   ├── lawyer/          # Lawyer dashboard & chat
│   ├── customer/        # Customer booking & appointments
│   ├── layouts/         # App, admin, lawyer, customer layouts
│   ├── components/      # Navbar, hero, cards, etc.
│   └── welcome.blade.php
routes/
├── web.php              # All application routes
database/
├── migrations/          # Database schema
`

## Routes

- / - Homepage
- /login, /register - Authentication
- /customer/search - Find lawyers
- /customer/lawyer/{id} - Lawyer profile & booking
- /customer/dashboard - Customer dashboard
- /lawyer/dashboard - Lawyer dashboard
- /admin/dashboard - Admin dashboard

## Security

- Password hashing (bcrypt)
- CSRF protection
- Role-based middleware
- Input validation
- SQL injection prevention (Eloquent ORM)

## License

This project is open-sourced under the MIT License.
