# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 11 application called "Churrasqueando" - a barbecue event management system built for organizing barbecue gatherings with guest management and payment integration via MercadoPago. The application allows users to create barbecue events, manage guest invitations, and handle payments.

## Development Commands

**Backend (Laravel)**
- `php artisan serve` - Start development server
- `php artisan migrate` - Run database migrations
- `php artisan migrate:fresh --seed` - Fresh migration with seeding
- `vendor/bin/phpunit` - Run tests
- `vendor/bin/pint` - Code formatting (Laravel Pint)

**Frontend (Vite + Tailwind)**
- `npm run dev` - Start Vite development server
- `npm run build` - Build for production

**Docker Development**
- `docker-compose up -d` - Start all services (app, nginx, mysql)
- `docker-compose exec app php artisan migrate` - Run migrations in container
- Access app at http://localhost:8080

## Architecture

**Core Models & Relationships**
- `Barbecue` (UUID primary key) → User relationship, has many Guests
- `Guest` → belongs to Barbecue, stores invitation and payment status
- `User` → email-based authentication, has many Barbecues

**Key Controllers**
- `BarbecueController` - CRUD operations for barbecue events
- `GuestController` - Guest invitation management and RSVP handling
- `PaymentController` - MercadoPago integration for payment links
- `AuthController` - Custom login/register flow (email-based, no passwords)

**Payment Integration**
- Uses MercadoPago SDK (`mercadopago/dx-php`)
- Payment links generated per barbecue event
- Webhook handling for payment success/failure

**Database Setup**
- MySQL 8 in production/Docker
- SQLite for local development (default)
- UUID-based barbecue IDs for security

**Frontend Stack**
- Blade templates with AlpineJS for interactivity
- Tailwind CSS for styling
- Vite for asset compilation
- Lucide icons via `mallardduck/blade-lucide-icons`

**Barbecue Formats**
Configuration in `config/barbecue-formats.php` defines three event types:
- "Bring your own" - participants bring their own food
- "Split equally" - costs divided among participants
- "No contribution" - organizer provides everything