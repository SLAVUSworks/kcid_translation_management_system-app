Implement authentication and authorization system for an existing Laravel 13 Translation Management System using Laravel Breeze.

Project Context

* Existing project already has:

  * dashboard
  * translation modules
  * CRUD system
  * Tailwind CSS layout
* Existing structure:

  * resources/views/dashboard
  * resources/views/tl-manager
  * resources/views/layouts
* Existing routes are already modular.

Requirements

* Install and configure Laravel Breeze with Blade.
* Use the existing Tailwind design style.
* Do NOT redesign the existing dashboard layout completely.
* Integrate Breeze into the current layout structure.

User Identification Fields
Users must have:

* name
* email
* password

Role System
Use a simple role column on users table.

Roles:

* admin
* verified
* unverified

Default Behavior

* Every newly registered account must automatically get:

  * role = unverified
* Unverified users cannot access translation modules or perform any translation activity.
* Unverified users can only:

  * login
  * logout
  * edit limited profile information
  * access profile page

Access Rules
Admin:

* Full access to all modules and user management.

Verified:

* Can access translation modules and perform CRUD activities.

Unverified:

* Cannot access translation modules.
* Cannot access module CRUD pages.
* Should be redirected to a simple restricted dashboard page.

Profile Rules
Create a profile system integrated with Breeze.

Unverified User:

* Can only edit:

  * name
  * password
* Cannot upload profile photo.
* Profile photo upload UI must be hidden or disabled.

Verified/Admin User:

* Can upload profile photo.
* Store uploaded profile images in storage/app/public/profile-photos.
* Save path in users table.

Database Changes
Update users table:

* role (string)
* profile_photo (nullable string)

Middleware
Create middleware:

* admin
* verified

Behavior:

* verified middleware:

  * allow admin and verified
  * block unverified

* admin middleware:

  * allow only admin

User Management
Create admin-only user management page:

* list users
* change user role
* search users
* pagination

Routes
Protect translation module routes using middleware.

Example:

* translation modules:

  * verified middleware

* user management:

  * admin middleware

Views
Create:

* restricted dashboard for unverified users
* user management page for admins
* updated profile page

UI Requirements

* Keep existing Tailwind aesthetic.
* Maintain dark dashboard style already used in project.
* Reuse existing layout files where possible.
* Do not create a completely separate auth theme.

Important

* Use Laravel 13 conventions.
* Use route groups and middleware properly.
* Use form requests where appropriate.
* Avoid duplicated logic.
* Keep code modular and clean.
* Ensure unauthorized users cannot bypass restrictions through direct URL access.
