# Maternity.id Project - Agent Guide

## Hard Rules

1. NEVER modify, rename, delete, or add to existing migration files. The database structure defined by the migrations is final.

2. NEVER change the database schema in any way (no new columns, no altered types, no new "fix" migrations) unless the owner explicitly instructs it.

3. Seeders MAY be modified freely (data only).

4. If a view, controller, feature, or query does not match the migrations, the application code must be changed to fit the migrations. Never the other way around.

5. Views MAY be changed when needed, but any change must stay consistent with the existing visual theme (colors, typography, spacing, component style, layout patterns). Reuse existing components and classes before creating new ones.

6. EVERY change to the project (code, views, seeders, config, docs) MUST be recorded in `docs/AGENT_LOG.md` following the format and rules below. A task is NOT considered finished until its log entry is written.

## Project Overview

**Product:** Maternity.id - A maternity class website where users can browse and join various prenatal classes/workshops, purchase learning-material books (e-books), and access health articles.

**Main User Roles:**
- **Member (Guest)**: Browse events, articles, products; login via Google OAuth; view personal profile
- **Member (Authenticated)**: Enroll in events, view notifications, manage subscriptions, access member-only features
- **Admin**: Create and manage events, articles, and educational materials; approve payments

**Main User Flows:**
1. Browse events (online/offline classes, workshops, seminars) → View details → Checkout → Upload payment proof → Admin verification → Approved status
2. Browse library/ebooks → View content
3. Browse articles → Read full content
4. Browse products → View items from merchants
5. Login via Google OAuth (Laravel Socialite) → Auto-create account with account_type = 'member' or 'admin' based on existing record

## Tech Stack & Versions

- **Backend:** PHP 8.3, Laravel 13.8
- **Frontend:** Tailwind CSS 4.3, Alpine.js 3.15, Vite 8.0
- **Database:** MySQL (configured via Laravel Eloquent ORM)
- **Authentication:** Laravel Socialite (Google OAuth)
- **Styling:** Custom CSS with Tailwind directives; uses Google Fonts (Plus Jakarta Sans, DM Serif Display, Caveat, Lexend, Poppins)
- **Icons:** FontAwesome 6.4.0 (CDN)
- **Build Tool:** Vite for CSS/JS bundling

## Setup & Commands

**Install & Setup:**
```bash
cd /mnt/Data/Development/JS/wibawa/src

# Copy .env.example to .env and configure (DB connection, etc.)
cp .env.example .env

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Generate application key
php artisan key:generate

# Run migrations (after configuring .env with MySQL)
php artisan migrate

# Run seeders (after migration)
php artisan db:seed

# Build assets (for production)
npm run build

# Run dev server (separately)
npm run dev
```

**Run Application:**
```bash
# Start Laravel development server
php artisan serve

# Or use the dev script (runs server, queue, logs, and Vite together)
composer run dev
```

**Run Tests:**
```bash
composer run test
```

**Linting:**
```bash
# Laravel Pint (PHP formatter)
vendor/bin/pint
```

## Project Structure

**Key Directories:**

| Path | Purpose |
|------|---------|
| `app/Http/Controllers/` | Controller classes (EventController, ArticleController, LoginController, etc.) |
| `app/Models/` | Eloquent models (Account, Admin, Member, Event, Article, Material) |
| `database/migrations/` | Database schema definitions (FINAL) |
| `database/seeders/` | Database seeders for initial data |
| `database/factories/` | Model factories for testing |
| `resources/views/` | Blade templates organized by feature |
| `resources/views/components/` | Reusable Blade components |
| `resources/css/` | Tailwind CSS entry point |
| `resources/js/` | Alpine.js initialization |
| `public/` | Publicly accessible files (images, index.php, .htaccess) |
| `config/` | Laravel configuration files |

**Important Controllers:**
- `EventController` - Browse, view, checkout events
- `ArticleController` - Browse and view health articles
- `EbookController` - Library/ebook browsing
- `ProductController` - Product catalog
- `LoginController` - Google OAuth flow
- `LogoutController` - Session termination
- `MyController` - Member profile management

**Important Models:**
- `Account` - Base user model (extends Authenticatable), hasOne Admin/Member
- `Admin` - Admin profile linked to Account
- `Member` - Member profile linked to Account
- `Event` - Event/class listing
- `Article` - Health education articles
- `Material` - E-books attached to events

## Database Overview

| Table | Purpose | Key Columns | Relationships |
|-------|---------|-------------|---------------|
| `accounts` | Base user accounts (both members and admins) | id (UUID), email, name, profile_img, account_type (member/admin), created_at, updated_at | HasOne: Admin, HasOne: Member |
| `admins` | Admin-specific data | account_id (PK, FK to accounts), assigned_at, position (maintainer/consultant), number_contact | BelongsTo: Account, HasMany: Events (created/uploaded), HasMany: Articles, HasMany: Materials (uploaded) |
| `members` | Member-specific data | account_id (PK, FK to accounts), gender, phone_number, salutation, birth_date, job, address, zip_code, institution, provision_by (FK to admins) | BelongsTo: Account, BelongsTo: Admin (provision) |
| `events` | Prenatal classes/workshops | id (UUID), name, slug, mentor_name, description, poster_img, date, location, venue (online/offline), status (draft/published), is_available, price, gc_invitation_link, created_by, created_at, updated_at | BelongsTo: Admin (created_by), HasMany: Materials |
| `articles` | Health education articles | id (UUID), title, keywords, slug, short_description, thumbnail_image, content, status (draft/published), author_id, created_at, updated_at | BelongsTo: Admin (author_id) |
| `materials` | E-books attached to events | id (UUID), event_id (FK), title, slug, description, thumbnail_image, content_link, viewer_count, uploaded_by (FK), created_at, updated_at | BelongsTo: Event, BelongsTo: Admin (uploaded_by) |

**Notes:**
- Foreign keys are defined in a separate migration file: `database/migrations/2026_09_12_034032_foreign_key_relationship.php`
- The base table migrations do NOT include the foreign key columns (they are added later in the FK migration)
- The FK migration file adds columns like `account_id`, `provision_by`, `event_id`, `uploaded_by`, `author_id`, `created_by` after the base tables are created
| `password_reset_tokens` | Password reset functionality | email (PK), token, created_at | - |
| `sessions` | Laravel session storage | id, user_id (nullable FK), ip_address, user_agent, payload, last_activity | - |

**Notes:**
- Foreign keys are defined in a separate migration file (`2026_09_12_034032_foreign_key_relationship.php`) that runs after base table migrations
- The FK migration adds foreign key columns (`account_id`, `provision_by`, `event_id`, `uploaded_by`, `author_id`, `created_by`) to tables after they are created
- The seeder for members contains `date_of_pregnancy` and `is_profile_complete` fields that are not in the migration

## Authentication Flow

**Google OAuth (Laravel Socialite):**

1. User clicks "Login with Google" → `GET /login/google` → `LoginController::requestGoogleLogin()`
2. User redirected to Google's OAuth consent screen
3. Google redirects back to `GET /login/google/callback` → `LoginController::callbackGoogleLogin()`
4. Controller uses `Socialite::driver('google')->user()` to get user data
5. Uses `Account::query()->updateOrCreate()` to find or create account by email
6. Auto-populates: name, profile_img (avatar), email
7. Logs user in with `Auth::login($user)`
8. Redirects to home page

**Account Types:**
- Existing accounts with `account_type = 'admin'` → Admin access
- New accounts or accounts with `account_type = 'member'` → Member access
- Admin accounts are created via seeders (AccountSeeder)

**Protected Routes:**
- `/profile`, `/my/account` - Member profile (requires authentication)
- `/logout` - Session termination

**Public Routes:**
- `/`, `/events`, `/articles`, `/library`, `/product` - Browse content
- `/login`, `/register` - Login forms
- `/events/{slug}`, `/articles/{slug}` - Public event/article details
- `/events/{slug}/checkout`, `/events/{slug}/verification`, `/events/{slug}/approved` - Event checkout flow

## Business Logic Notes

**Events & Enrollment:**
- Events are curated data in controllers (hardcoded arrays), not pulled from database yet
- Each event has: slug, title, description, mentor, date, location, venue (online/offline), price, gc_invitation_link
- Users can checkout events and upload payment proof
- Admin verifies payment and approves enrollment

**Articles & Library:**
- Articles and materials (e-books) have similar structures with thumbnail, content link, viewer count
- Materials can be attached to events or standalone
- All content is currently hardcoded in controllers

**Product Catalog:**
- Products are physical items from various merchants
- Each product has: title, category, image, location, price, TikTok URL, rating, sold count

**Visual Theme:**
- Primary color: `#DEA69E` (pinkish orange)
- Accent: `#7A9E7E` (green)
- Dark text: `#2A1614`, `#2D1E1E`
- Muted text: `#5C4542`, `#3D2B2B`
- Background: `#FAF0EE` (cream)

## Frontend & Theme Guide

**Layout Files:**
- `resources/views/components/layout.blade.php` - Main layout with header, footer, mobile bottom nav
- `resources/views/components/header.blade.php` - Sticky header with nav, search, notifications, profile dropdown
- `resources/views/components/footer.blade.php` - Footer with quick action pills, links, social media

**Reusable Components:**
- `event_card.blade.php` - Event listing card
- `article_card.blade.php` - Article listing card
- `product_card.blade.php` - Product listing card
- `ebook_card.blade.php` - Ebook listing card
- `bottom_nav.blade.php` - Mobile bottom navigation

**CSS Framework:**
- Tailwind CSS 4.3 with custom directives
- Font families: Plus Jakarta Sans (body), DM Serif Display (brand), Caveat (handwriting)
- Custom animations: heroFloat, blobMorph, stagger reveals

**Component Conventions:**
- Use existing color palette (`#DEA69E`, `#7A9E7E`, `#2A1614`, `#2D1E1E`)
- Rounded corners: `rounded-2xl`, `rounded-full`
- Shadow: `shadow-xs`, `shadow-sm`, `shadow-md`, `shadow-lg`, `shadow-xl`, `shadow-2xl`
- Hover states: `hover:bg-white/60`, `hover:text-[#782819]`, `hover:-translate-y-0.5`
- Transitions: `transition`, `duration-200`, `ease-in-out`

## Coding Conventions

**Naming:**
- Controllers: PascalCase + "Controller" suffix (EventController, ArticleController)
- Models: PascalCase singular (Account, Event, Article, Material)
- Routes: snake_case for readability (events.show, articles.index)
- Database: snake_case (event_id, account_id, created_at, updated_at)

**Validation:**
- No Form Request classes observed yet; validation likely in controllers
- Use Laravel's built-in validation when adding forms

**Logic Placement:**
- Business logic in controllers (current implementation)
- Consider creating service classes for complex operations (checkout flow, event enrollment)
- Keep controllers thin for maintainability

**Alpine.js Patterns:**
- Use `x-data`, `x-show`, `x-transition` for interactive UI
- Keep Alpine components localized to sections
- Use `@click.away` for dropdowns/modals

## Current Status

**Done:**
- [x] Basic Laravel 13.8 project setup
- [x] MySQL database schema (migrations for accounts, admins, members, events, articles, materials, sessions, cache)
- [x] Foreign keys defined in separate migration file (`2026_09_12_034032_foreign_key_relationship.php`)
- [x] Eloquent models (Account, Admin, Member, Event, Article, Material)
- [x] Google OAuth authentication (Socialite)
- [x] Route definitions (events, articles, library, product, profile)
- [x] Controllers with hardcoded curated data (EventController, ArticleController, ProductController, EbookController)
- [x] Blade layout and reusable components
- [x] Admin dashboard stub views
- [x] Auth views (login page)
- [x] Seeders for initial data (AccountSeeder, AdminSeeder, MemberSeeder, EventSeeder, ArticleSeeder, MaterialSeeder)

**In Progress:**
- [ ] Database table schema alignment (members missing columns, admins missing account_id)
- [ ] Actual database integration (controllers use hardcoded data, not Eloquent)
- [ ] Event checkout flow
- [ ] Payment verification workflow
- [ ] Profile management pages
- [ ] Admin CRUD operations

**Not Started:**
- [ ] Full admin dashboard with CRUD for events, articles, materials
- [ ] Product catalog from database (currently hardcoded)
- [ ] Member profile editing
- [ ] Payment processing integration
- [ ] Email notifications
- [ ] Search functionality
- [ ] Booking system

## Known Issues & Mismatches

**Schema Mismatches (Code expects columns not in migration):**

1. **members table** (`database/migrations/2026_07_23_000004_create_members_table.php`):
   - Migration does NOT have `date_of_pregnancy` column (but seeder has it)
   - Migration does NOT have `is_profile_complete` column (but seeder has it)

2. **admins table** (`database/migrations/2026_07_23_000003_create_admins_table.php`):
   - Migration does NOT have `account_id` column (but Admin model and seeder expect it)
   - Note: `account_id` is added by the FK migration (`2026_09_12_034032_foreign_key_relationship.php`)

3. **ForeignKey migration** (`database/migrations/2026_09_12_034032_foreign_key_relationship.php`):
   - Adds foreign key columns to existing tables after base migrations run
   - References `account_id` in admins and members tables which are added by this FK migration

**Solution:** The application code (models, seeders) must be changed to fit the migrations. Currently:
- Member model and seeder need `date_of_pregnancy`, `is_profile_complete` columns added to migration
- Admin model and seeder need `account_id` column (added by FK migration)

**Missing Features:**
- No actual database queries in controllers (all data hardcoded)
- No payment processing integration
- No file upload for payment proofs
- No email verification
- No event booking confirmation workflow

## Next Steps

**Priority (Deadline Focused):**

1. **Fix Schema Mismatches** (CRITICAL)
   - Update migrations to include missing columns, OR
   - Update models/seeders to match current migrations
   - Run `php artisan migrate:fresh --seed` to verify

2. **Database Integration**
   - Replace hardcoded data in EventController, ArticleController with Eloquent queries
   - Implement pagination and filtering

3. **Event Checkout Flow**
   - Create payment verification upload
   - Implement admin approval workflow
   - Add verification and approved views

4. **Member Profile**
   - Complete profile editing page
   - Add member-specific features

5. **Admin Dashboard**
   - Implement CRUD for events
   - Implement CRUD for articles
   - Implement payment approval panel

**Secondary:**
- Product catalog from database
- Search functionality
- Email notifications
- Responsive design polish

## Handoff Protocol & Change Log Rules

### At the start of every session

1. Read `AGENTS.md` fully.

2. Read `docs/AGENT_LOG.md`: the 10 most recent entries, plus ANY entry whose Status is `Partial` or `Blocked`, no matter how old.

3. Run `git status` and `git log --oneline -20` and compare them with the log. If the log and the actual repo state disagree (uncommitted changes, unlogged commits), tell the owner and record the discrepancy in the log before continuing.

4. Summarize your understanding of the project, the last known state, and your plan to the owner, then wait for confirmation on anything ambiguous. Do NOT write or change code before this summary.

### During the session

- Do not change existing architectural or design decisions without explaining why and getting the owner's approval.

- Work in small, focused units. Log after EACH meaningful unit of work (a feature, a fix, a refactor), not only at the end of the session, because the session or account limit may end abruptly.

- Prefer one commit per logged unit of work, and include the log update in the same commit. Put the commit hash or short message in the log entry when available.

### Before finishing any task (and before your final reply)

1. Run `git diff --stat -- database/migrations` and confirm it is empty. If it is not, revert those changes immediately.

2. Write the log entry in `docs/AGENT_LOG.md`.

3. If the change affects project state, update the "Current Status", "Known Issues & Mismatches", and "Next Steps" sections of AGENTS.md too. Keep AGENTS.md concise: remove outdated information instead of only appending.

4. If you are being cut off or running out of budget, write a `Partial` entry with the exact stopping point FIRST, before anything else.

### Change log rules (`docs/AGENT_LOG.md`)

- Append-only: NEVER edit, reorder, or delete existing entries. If a past entry turns out to be wrong, add a new entry that corrects it and references the old one.

- Newest entry goes at the TOP, directly under the file header.

- Log everything, including failed attempts, reverted changes, and experiments, together with why they failed. This prevents the next agent from repeating them.

- Be concrete: real file paths, class/method names, route names, table names. Never write vague summaries like "fixed some bugs".

- Write for a reader who has zero knowledge of the conversation.

- Never record secrets (API keys, OAuth client secrets, passwords, .env values).

- If the file grows beyond ~500 lines, move older entries to `docs/agent-log-archive/YYYY-MM.md` (verbatim, unchanged), keep the most recent 30 entries in the main file, and leave a note in the header pointing to the archive.

### Entry format (use exactly this structure)

```
## [YYYY-MM-DD HH:MM] Short descriptive title

- **Agent/Session:** tool and model name if known (account is unknown/irrelevant)

- **Type:** feat | fix | refactor | style | seed | docs | chore | investigation

- **Status:** Done | Partial | Blocked

- **Files changed:** list of paths (mark each as added / modified / deleted)

- **What changed:** concrete description of the change

- **Why:** the reason and the reasoning behind the decision, including alternatives rejected

- **Progress detail:** if Partial or Blocked: exactly where work stopped, what is done, what remains, and what is broken right now

- **Verification:** commands/tests/manual checks run and their result, or "Not tested"

- **Migration check:** "Confirmed: no migration files touched" (or details if a mismatch was resolved on the code side)

- **Side effects / risks:** anything that might break or behave unexpectedly

- **Suggestions / next steps:** what the next agent should do or watch out for

- **Commit:** hash or message, if committed
```
