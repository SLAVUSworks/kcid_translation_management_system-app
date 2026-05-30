Refactor the Laravel Breeze UI integration to use the existing Translation Manager dashboard layout instead of the default Breeze layout.

Current Project Structure

* Main dashboard layout:

  * resources/views/tl-manager/layouts/app.blade.php
* Existing dashboard pages already use:

  * tl-manager.layouts.app
* Existing partials:

  * tl-manager/layouts/partials/navbar.blade.php
  * tl-manager/layouts/partials/sidebar.blade.php
  * tl-manager/layouts/partials/footer.blade.php

Goal
Completely remove the default Breeze page structure and integrate all auth/profile pages into the existing dashboard UI system.

Requirements

1. Layout Integration

* All authenticated pages must extend:

  * tl-manager.layouts.app
* Do not use:

  * x-app-layout
  * Breeze navigation layout
  * Breeze default containers/cards

2. Profile Pages
   Refactor:

* resources/views/profile/edit.blade.php
* resources/views/profile/partials/*

So they visually match the existing dashboard style.

Requirements:

* Use existing spacing/padding conventions
* Use existing dashboard card styles
* Use existing dark theme
* Maintain responsive behavior
* Preserve all Breeze functionality

3. Auth Pages
   Refactor:

* login
* register
* forgot password
* reset password
* verify email
* confirm password

Requirements:

* Reuse existing Tailwind aesthetic from dashboard
* Do not use Breeze default centered card UI
* Match sidebar/navbar visual language where appropriate
* Keep authentication logic unchanged

4. Navigation
   Integrate authenticated user menu into:

* tl-manager/layouts/partials/navbar.blade.php

Display:

* user name
* role
* profile link
* logout button

5. Restricted Dashboard

* resources/views/dashboard/restricted.blade.php

Must also use:

* tl-manager.layouts.app

6. Cleanup
   Remove unused Breeze layout files/components if no longer needed.

Examples:

* old Breeze navigation
* unused x-app-layout wrappers
* unused auth card wrappers

But do NOT remove components still used by auth logic.

7. Important

* Preserve all existing authentication functionality
* Preserve middleware behavior
* Do not rewrite backend auth logic
* Focus only on UI/layout integration
* Reuse existing dashboard structure as much as possible
* Avoid duplicate layout systems
