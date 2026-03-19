# TaskForge

TaskForge is a powerful, intuitive, and highly scalable project and task management system engineered to streamline workflows across layered organizations. Built with **Laravel 12** and styled beautifully leveraging **Tailwind CSS 4** and **DaisyUI**, TaskForge connects teams effortlessly by unifying workspace organization, granular task assignments, targeted team announcements, SaaS billing, and real-time activity tracking.

## Features

- **Multi-Tenancy SaaS & Billing:** Integrated with Stripe via Laravel Cashier. Managers can upgrade their workspaces to Pro or Pro Plus tiers to unlock unlimited workspaces and employee limits natively.
- **Role-Based Access Control (RBAC):** Three distinct operating roles (Admin, Manager, Employee) guaranteeing secure and scoped interfaces for everyone.
- **Dynamic Workspace Management:** Managers can create and track detailed workspaces, managing the team members involved within projects efficiently.
- **Robust Task Management:** Fully-fledged task lifecycle tools including priority setting, status timelines, constraints, and granular due dates.
- **Rich Collaboration Elements:** Internal task commenting systems and drag-and-drop secure file attachment handling built-in natively. 
- **Activity Tracking (Observers):** Built-in Laravel Observers automatically log historical progress footprints, so you know exactly who did what and when.
- **Hub Announcements:** Multi-tiered communication boards restricted by visibility rules allowing global network "Public Announcements" versus targeted localized "Team Announcements."
- **Dashboard Analytics:** Visual indicators tracking pending workloads, upcoming due dates, and progressive workspace pipeline metrics at a glance.

---

## Technology Stack

**Backend:**
- [PHP 8.2+](https://php.net/)
- [Laravel Framework 12.x](https://laravel.com/)
- [Laravel Cashier (Stripe)](https://laravel.com/docs/billing)

**Frontend:**
- [Tailwind CSS 4.x](https://tailwindcss.com/)
- [DaisyUI 5.x](https://daisyui.com/) (Component Library)
- [Vite 7.x](https://vitejs.dev/) (Build Tool)

**Architecture Details:**
- Authentication bootstrapped securely.
- Eloquent ORM interacting with MySQL/SQLite configurations gracefully out-of-the-box.
- Modern flex and strictly `z-index` scoped responsive view panels relying on modular Blade components.

---

## Prerequisites

Before you begin, ensure you have met the following requirements:
* PHP >= 8.2 installed on your local environment.
* [Composer](https://getcomposer.org/) globally installed.
* [Node.js](https://nodejs.org/) and NPM.
* A relational Database setup (MySQL, PostgreSQL, or SQLite).
* Standard Stripe SDK Keys (for billing webhooks and checkout sessions).

---

## Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/0abdullahbhutto0/taskforge-scd.git
   cd taskforge
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install NPM dependencies:**
   ```bash
   npm install
   ```

4. **Environment Configuration:**
   Create a local configuration copy and enter your local database and Stripe API credentials into the newly formed `.env` file.
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Migrate and Seed Database:**
   Push the schema to your engine and populate it utilizing the provided Seeders (i.e., `AdminUserSeeder`).
   ```bash
   php artisan migrate --seed
   ```

7. **Link Storage (Required for File Attachments & Avatars):**
   ```bash
   php artisan storage:link
   ```

8. **Spin up the Local Server:**
   TaskForge conveniently provides a built-in concurrent script. Run this command to handle serving Laravel, processing background queues, and hot-reloading Vite frontend assets simultaneously:
   ```bash
   composer run dev
   ```

   *Navigate to `http://127.0.0.1:8000` to access the application.*

   **Note on Webhooks:** For Stripe checkouts to sync subscription changes locally during development, you must run the Stripe CLI forwarder: 
   `stripe listen --forward-to localhost:8000/stripe/webhook`

---

## Roles & Usage

*   **Administrators:** The command center. Admins can moderate new user registrations (Approve/Reject), dictate global application roles securely via the **User Management** hub, monitor workspaces overridingly, and broadcast global 'Public Announcements'.
*   **Managers:** Project coordinators (Tenant Owners) who create dedicated workspaces, funnel tasks to their specific team subset, and have authorization to deploy 'Team Announcements' geared securely toward members inside their supervision scope. Managers also manage their Stripe Billing Subscriptions enabling higher capacity limits.
*   **Employees:** Task assignees executing the deliverables. They're locked natively restricting access strictly to view relevant metrics, act exclusively on tasks directly assigned, log internal progress checks, add supportive comments, and consume only permitted network announcements. 

---

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

---

> **Note:** TaskForge natively limits data leaks enforcing severe route and query-level policy validations guaranteeing absolute data integrity across varying horizontal and vertical privilege structures.
