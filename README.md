# Maternity.id

> A centralized platform for maternity education, seminars, and e-learning — empowering pregnant and postpartum women with curated prenatal classes, health workshops, and educational content.

[![License: Proprietary](https://img.shields.io/badge/License-Proprietary-red.svg)](#license)

---

## 🎯 About Maternity.id

Maternity.id is a comprehensive web-based platform designed to solve the fragmented landscape of maternity education in Indonesia. Currently serving the Solo and Yogyakarta regions, the platform brings together expectant and postpartum mothers with quality seminars, workshops, e-books, and health articles from verified professionals.

### The Problem We Solve

- **Fragmented Information**: Maternity seminars and training are scattered across multiple social media platforms with no centralized discovery system
- **Difficult Search**: Prospective participants struggle to find events matching their specific needs (topic, location, format, price)
- **Manual Processes**: Registration and payment handling through WhatsApp and paper forms creates communication risks and delays
- **Low Reach**: Seminar organizers rely on inefficient conventional promotion methods
- **Limited Resources**: Users lack ongoing educational resources beyond individual seminar sessions

### Our Solution

Maternity.id provides:
- 🔍 **Unified Catalog** — Browseable, filterable seminar directory with transparent pricing
- 👥 **Google OAuth Integration** — Seamless one-click login without password management
- 💳 **Manual Payment Verification** — User-friendly payment proof upload with admin verification workflow
- 📚 **E-learning Library** — Curated e-books and materials tied to seminar enrollments
- 📰 **SEO-Optimized Articles** — Health education content for organic user acquisition
- 👨‍💼 **Partner Facilitation** — White-label event hosting for independent healthcare professionals
- 💬 **Real-Time Order Tracking** — Members monitor payment and enrollment status instantly
- 🎖️ **Admin Dashboard** — Comprehensive payment verification, content management, and financial reporting

---

## 🏗️ Project Structure

```
wibawa/
├── src/                              # Main Laravel application
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/          # Request handlers (events, articles, auth, etc.)
│   │   │   └── Middleware/           # Auth & authorization middleware
│   │   └── Models/                   # Eloquent models (Account, Member, Admin, etc.)
│   ├── database/
│   │   ├── migrations/               # Schema definitions (IMMUTABLE)
│   │   ├── seeders/                  # Initial data seeding
│   │   └── factories/                # Testing factories
│   ├── resources/
│   │   ├── views/                    # Blade templates
│   │   ├── components/               # Reusable Blade components
│   │   ├── css/                      # Tailwind CSS entry point
│   │   └── js/                       # Alpine.js initialization
│   ├── config/                       # Laravel configuration
│   ├── routes/                       # URL routing definitions
│   ├── .env.example                  # Environment template
│   └── composer.json                 # PHP dependencies
│
├── docs/                             # Project documentation
│   ├── problem-statement.md          # Business problem & opportunities
│   ├── srs.md                        # Software requirements specification
│   ├── user-stories.md               # Detailed user stories (all 28)
│   ├── product-backlog.md            # Prioritized feature backlog
│   ├── acceptance-criteria.md        # Testing criteria (Given-When-Then format)
│   ├── user-stories.md               # User story narratives
│   ├── erd.md                        # Entity relationship diagram
│   ├── data-dictionary.md            # Database field documentation
│   ├── timeline.md                   # Project timeline
│   ├── AGENT_LOG.md                  # Development work log
│   └── team-contract.md              # Team guidelines
│
└── README.md                         # This file
```

---

## 🗄️ Tech Stack

| Layer | Technology | Version |
|-------|-----------|---------|
| **Backend** | PHP, Laravel | 8.3, 13.8 |
| **Frontend** | Tailwind CSS, Alpine.js | 4.3, 3.15 |
| **Build Tool** | Vite | 8.0 |
| **Database** | MySQL | Latest (via Laravel Eloquent) |
| **Authentication** | Google OAuth 2.0 | Laravel Socialite |
| **Icons** | FontAwesome | 6.4.0 (CDN) |
| **Fonts** | Google Fonts | Plus Jakarta Sans, DM Serif Display, Poppins |

---

## 💾 Core Database Tables

| Table | Purpose | Key Relationships |
|-------|---------|-------------------|
| **accounts** | Base user authentication | HasOne: Admin / Member |
| **admins** | Admin profile data | BelongsTo: Account; HasMany: Events, Articles, Materials |
| **members** | Member profile & preferences | BelongsTo: Account, Admin (provision) |
| **events** | Seminars & workshops | BelongsTo: Admin (creator); HasMany: Materials, Orders |
| **articles** | Health education content | BelongsTo: Admin (author); BelongsToMany: Categories |
| **materials** | E-books & learning resources | BelongsTo: Event, Admin (uploader) |
| **categories** | Article & content categorization | BelongsToMany: Articles (N:M via pivot) |
| **orders** | Payment transactions | BelongsTo: Member; Stores: proof_image, status, rejection_reason |
| **sessions** | Laravel session storage | - |

> 📌 **Note**: Foreign keys are defined in migration `2026_09_12_034032_foreign_key_relationship.php` and applied after base tables are created.

---

## 🎨 Design System

### Color Palette
- **Primary**: `#DEA69E` (warm pinkish-orange)
- **Accent**: `#7A9E7E` (sage green)
- **Dark Text**: `#2A1614`, `#2D1E1E`
- **Muted Text**: `#5C4542`, `#3D2B2B`
- **Background**: `#FAF0EE` (cream)

### Typography
- **Body**: Plus Jakarta Sans (Google Fonts)
- **Headings**: DM Serif Display
- **Accent**: Caveat, Lexend, Poppins

### Component Conventions
- Rounded corners: `rounded-2xl`, `rounded-full`
- Shadows: `shadow-sm` through `shadow-2xl`
- Hover states: `hover:bg-white/60`, `hover:text-[#782819]`, `hover:-translate-y-0.5`
- Transitions: `transition`, `duration-200`, `ease-in-out`

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.3+
- Composer
- Node.js & npm
- MySQL database
- Google OAuth 2.0 credentials (Client ID & Secret)

### Installation & Setup

1. **Clone and navigate to source**:
   ```bash
   cd src
   cp .env.example .env
   ```

2. **Configure environment** (`.env`):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=maternity_id
   DB_USERNAME=root
   DB_PASSWORD=

   GOOGLE_CLIENT_ID=your-client-id
   GOOGLE_CLIENT_SECRET=your-client-secret
   
   FALLBACK_IMAGE_URL=https://your-cdn.com/fallback-image.jpg
   ```

3. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

4. **Generate application key**:
   ```bash
   php artisan key:generate
   ```

5. **Run migrations**:
   ```bash
   php artisan migrate
   ```

6. **Seed database** (creates demo data):
   ```bash
   php artisan db:seed
   ```

7. **Build assets**:
   ```bash
   npm run build
   ```

### Running the Application

**Development mode** (starts server + Vite watcher):
```bash
composer run dev
```

Or separately:
```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite asset watcher
npm run dev
```

**Production build**:
```bash
npm run build
```

---

## 📖 User Flows

### 1. New Member Onboarding
```
Guest → Login with Google → Create Account → Complete Profile (/complete-profile)
  → Browse Seminars (/seminars) → View Details → Checkout → Payment Upload
  → Admin Verifies → Access Activated → View Status (/orders/{id})
```

### 2. Browse & Filter Seminars
```
Guest/Member → /seminars → Apply Filters (topic, location, format, price)
  → View Filtered Results → Select Seminar → View Details (/seminars/{slug})
  → See Benefits, Price, Schedule → Optional: Bookmark
```

### 3. Payment & Verification Workflow
```
Member → Checkout → System Creates Order (status: menunggu_pembayaran)
  → /checkout/{order}/payment → View Bank Instructions
  → Upload Payment Proof → Status: menunggu_verifikasi → OrderReceivedMail Sent
  → [Admin Reviews] → Approve: Status → diverifikasi → Send WhatsApp Link
     → [Member Receives Access] → Status: selesai
     OR Reject: Status → ditolak + Rejection Reason Stored
  → Member Views Reason at /orders/{id} → Re-uploads Proof
```

### 4. Article Reading & Discovery
```
Guest → Search Engine (organic via SEO) → Article Page (/articles/{slug})
  → Read Content → See Related Seminar CTA → Optional: Login & Enroll
```

### 5. Admin Dashboard Operations
```
Admin → /admin/dashboard → View Finance Overview → /admin/orders
  → Review Payment Proofs → Approve/Reject with Reason
  → /admin/articles → Create/Edit Content → Publish
  → /admin/materials → Upload E-books → Link to Events
  → /admin/members → View Registrations & Subscriptions
```

---

## 🔐 Authentication & Authorization

### Google OAuth Flow
1. User clicks "Login with Google"
2. Redirected to Google OAuth consent screen
3. Returns with user profile data
4. System uses `updateOrCreate()` to find or create `Account` by email
5. Determines role: existing `admin` → Admin access; new/`member` → Member access
6. Session established via Laravel Auth

### Route Protection
- **Public Routes**: `/`, `/seminars`, `/articles`, `/library`, `/product`, `/login`
- **Member Routes** (auth required): `/profile`, `/checkout/{id}`, `/orders/{id}`, `/my-subscriptions`
- **Admin Routes** (auth + admin check): `/admin/dashboard`, `/admin/orders`, `/admin/articles`
  - Protected by `EnsureUserIsAdmin` middleware (checks `account_type === 'admin'`)
  - Non-admins redirected to home

### Session Management
- Google OAuth session managed by Laravel Guard
- Sessions stored in database via `sessions` table
- Optional: Redis for distributed sessions

---

## 📚 Key Features (MVP)

### For Members
| Feature | Route | Status |
|---------|-------|--------|
| Browse seminars with filters | `/seminars` | ✅ Integrated with DB |
| View seminar details | `/seminars/{slug}` | ✅ DB-driven |
| Complete profile after first login | `/complete-profile` | ✅ Implemented |
| Checkout & select subscription | `/checkout` | ✅ Creates orders |
| Upload payment proof | `/checkout/{order}/payment` | ✅ File upload + validation |
| Monitor order status in real-time | `/orders/{id}` | ✅ Status tracking |
| Access e-book library by subscription | `/library` | ✅ Role-based access |
| Read health articles | `/articles/{slug}` | ✅ DB-driven content |
| Edit profile & settings | `/profile` | 📋 In development |
| View subscription status | `/my-subscriptions` | 📋 In development |
| Bookmark favorite seminars | `/bookmarks` | 🎯 Future |

### For Admins
| Feature | Route | Status |
|---------|-------|--------|
| Dashboard overview | `/admin/dashboard` | ✅ Stub view ready |
| Verify payments | `/admin/orders` | ✅ Review & approve/reject |
| Manage seminars | `/admin/seminars` | 📋 CRUD implementation |
| Manage articles | `/admin/articles` | ✅ DB-driven content |
| Upload e-books/materials | `/admin/materials` | 📋 CRUD implementation |
| Financial reporting | `/admin/dashboard` (finance tab) | 🎯 Future |
| Member management | `/admin/members` | 📋 In development |

### Public Pages
| Page | Route | Status |
|------|-------|--------|
| Landing page | `/` | ✅ Info, upcoming events, testimonials, partner section |
| Article directory | `/articles` | ✅ DB-driven with SEO |
| Seminar directory (public preview) | `/seminars` | ✅ Limited, guest-friendly |
| Partner inquiry | `/ajukan-seminar` | 📋 Redirects to WhatsApp |

---

## 🔄 Subscription Models

### Akses E-book (E-book Access)
- **Type**: Full library access
- **Duration**: Time-limited (e.g., 1 month, 3 months, 1 year)
- **Price**: Variable
- **Access**: All e-books in library during active period
- **Auto-activation**: After admin verification

### Akses Seminar (Seminar Access)
- **Type**: Single-seminar enrollment
- **Includes**: Attendance + automatic e-book access for that seminar
- **Duration**: Seminar period + material access window
- **Price**: Per seminar
- **Access**: Specific seminar materials + event link (if applicable)
- **Auto-activation**: After admin verification

---

## 📋 Project Status

### Completed ✅
- [x] Laravel 13.8 project scaffolding
- [x] MySQL database schema & migrations
- [x] Google OAuth integration
- [x] Article feature (DB-driven, categorized, author credit)
- [x] Admin protection middleware
- [x] 20 seeded articles with categories
- [x] Admin dashboard stub & user display
- [x] Member & admin seeders
- [x] Blade component library
- [x] Tailwind CSS + Alpine.js setup

### In Progress 📋
- [ ] Complete member profile editing (`/profile`)
- [ ] Subscription status display (`/my-subscriptions`)
- [ ] Full event checkout workflow with payment proof upload
- [ ] Admin order verification panel & approval flow
- [ ] Admin CRUD for seminars & materials

### Future 🎯
- [ ] Payment gateway integration (Stripe/Midtrans)
- [ ] Real-time notifications & messaging
- [ ] Email notifications (OrderReceivedMail, verification confirmations)
- [ ] Search functionality with full-text indexing
- [ ] Bookmark/favorites system
- [ ] Member testimonials & reviews
- [ ] Financial dashboard with export capabilities
- [ ] SMS notifications for payment reminders
- [ ] Geographic expansion beyond Solo-Yogya
- [ ] Mobile app version

---

## 🧪 Testing & Quality

### Run Tests
```bash
composer run test
```

### PHP Code Formatting
```bash
vendor/bin/pint
```

### Database Refresh (Development)
```bash
# Reset all data and re-seed
php artisan migrate:fresh --seed
```

---

## 📞 Contact & Partner Programs

### For Event Facilitators / Healthcare Professionals
Maternity.id offers white-label event facilitation services. Visit the **Partner Section** on the landing page or contact via WhatsApp for details on:
- Venue & logistics support
- Marketing & promotion assistance
- Enrollment platform integration
- Payment processing facilitation

**WhatsApp Contact**: Available via "Partner Section" link on landing page.

### Submit a Seminar
Event organizers can submit seminar proposals via `/ajukan-seminar` for potential partnership and listing on the platform.

---

## 🤝 Development Notes

### Hard Rules
1. **NEVER modify database migrations** — the schema is immutable after creation
2. **Code must fit migrations**, not the reverse — always align application code to existing schema
3. **Seeders only** — database changes are restricted to seeder data only
4. **Theme consistency** — views must respect existing color palette, typography, and component patterns
5. **Document all changes** in `/docs/AGENT_LOG.md` — every commit must have an associated log entry

### Coding Conventions
- **Controllers**: PascalCase + "Controller" suffix
- **Models**: PascalCase singular (e.g., `Article`, `Event`)
- **Routes**: snake_case (e.g., `articles.show`, `events.index`)
- **Database**: snake_case columns & table names
- **Views**: Blade templates in `resources/views/{feature}/{action}.blade.php`

### AI-Friendly Development
This project is structured for AI-assisted development. Refer to:
- `src/AGENTS.md` — Comprehensive agent guide with project context
- `docs/AGENT_LOG.md` — Detailed work log for context continuity
- `/docs/srs.md` — Software requirements for feature specifications

---

## 📄 License

**Proprietary** — All rights reserved. This software and associated documentation is the exclusive property of Maternity.id. Unauthorized copying, distribution, modification, or use is strictly prohibited without explicit written permission.

---

## 📚 Documentation

Comprehensive project documentation is available in `/docs/`:
- **[Problem Statement](./docs/problem-statement.md)** — Business context & opportunities
- **[SRS](./docs/srs.md)** — Complete functional & non-functional requirements
- **[User Stories](./docs/user-stories.md)** — 28 detailed user narratives
- **[Product Backlog](./docs/product-backlog.md)** — Prioritized features with story points
- **[Acceptance Criteria](./docs/acceptance-criteria.md)** — Testable given-when-then criteria
- **[Data Dictionary](./docs/data-dictionary.md)** — Database field reference
- **[ERD](./docs/erd.md)** — Entity relationship diagram
- **[Agent Log](./docs/AGENT_LOG.md)** — Development work history
- **[Timeline](./docs/timeline.md)** — Project schedule

---

## 🎓 For Developers

### First-Time Setup Checklist
- [ ] Read `/docs/problem-statement.md` for business context
- [ ] Review `/docs/srs.md` for feature requirements
- [ ] Check `src/AGENTS.md` for development guidelines
- [ ] Install dependencies: `composer install && npm install`
- [ ] Configure `.env` with database & Google OAuth credentials
- [ ] Run migrations: `php artisan migrate`
- [ ] Seed demo data: `php artisan db:seed`
- [ ] Start dev server: `composer run dev`
- [ ] Visit `http://localhost:8000`

### Adding a New Feature
1. Reference the relevant user story in `/docs/user-stories.md`
2. Check acceptance criteria in `/docs/acceptance-criteria.md`
3. Follow coding conventions from `src/AGENTS.md`
4. Log your work in `/docs/AGENT_LOG.md` (append-only, never edit prior entries)
5. Keep database schema unchanged — modify application code instead
6. Test thoroughly before committing
7. Create descriptive commit messages

### Common Commands
```bash
# Start development
cd src && composer run dev

# Database operations
php artisan migrate                    # Apply migrations
php artisan migrate:fresh --seed       # Reset & reseed
php artisan db:seed SeedrClassName     # Run specific seeder

# Code quality
vendor/bin/pint                        # Format code

# Troubleshooting
php artisan tinker                     # Interactive shell
php artisan config:cache               # Clear & cache config
php artisan cache:clear                # Clear all caches
```

---

<p align="center">
  Built with ❤️ for maternal health education in Indonesia
</p>
