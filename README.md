# NewsWebsite

NewsWebsite is a full news publishing platform with two sides: a public site where readers browse articles by category/reporter/date and leave comments, and an admin panel where writers/editors log in, publish articles with images, manage categories and reporters, and see a running activity log of who did what. Built with **vanilla PHP and MySQL**, no framework.

## What it does

**Public site**
- Browse all articles, or filter by category, reporter, month, and year (`getarticlesview.php` accepts a filter payload and falls back to a MySQL `LIKE '%'` wildcard for any filter left on "Select").
- View a single article with its comments (`shownewsdetails.php`).
- Sign up / log in as a reader, and post a comment while logged in — an unauthenticated comment attempt redirects to login and carries the article ID through so the user lands back on the same article after signing in.

**Admin panel** (separate login, separate `adminusers` table from public readers)
- Publish articles: title, subtitle, content, category, reporter, and an image upload (validated as a real image, size-capped, extension-checked).
- Edit existing articles, including swapping the image.
- New categories and new "guest" reporters are created on the fly the first time they're used in a post, rather than needing to be set up in advance.
- **Activity log**: every login, post, and edit is written to an `activitytable` with a username, action description, and timestamp — giving a basic audit trail of admin actions.
- **Gated admin signup**: registering a new admin account requires a shared "company code" (checked against a constant in `validate.php`) in addition to the normal signup fields — a simple way to keep the admin panel from being self-service to the public.

## Why it's built this way

**Two separate user tables and sessions (`user` vs `adminusers`).** Readers and admins are deliberately kept apart — a reader account can't accidentally get admin capabilities and vice versa, since they're different tables with different login endpoints (`checkuser.php` vs `admincheckuser.php`) setting the same `$_SESSION['username']` key but scoped to entirely different privilege contexts.

**Categories and reporters are inferred from content, not managed as a rigid taxonomy.** `insertarticle.php` and `updatearticle.php` check `in_array($category, $categories)` and only insert a new category row if it's genuinely new; the same pattern applies to "guest" reporters (`strpos($reporter, '[Guest]')`). This keeps content publishing fast — an editor doesn't have to go create a category before they can use it — at the cost of a stricter, pre-defined taxonomy.

**Activity logging is treated as a first-class side effect of every admin action**, not an afterthought bolted on later — every successful login, post, and edit writes its own `activitytable` row in the same request, right after the main write succeeds. That's a genuinely useful pattern for anyone building admin tooling: you get accountability for free instead of retrofitting it later.

**Filter fallback via SQL wildcards.** Rather than building a dynamic WHERE clause that only includes the filters actually selected, `getarticlesview.php` converts an unselected filter to `%` and always runs all four `LIKE` conditions. Simpler to write than conditional query building, though it does mean every filtered request touches all four columns regardless of how many the reader actually cares about.

## Tech stack

- PHP (vanilla, no framework) + `mysqli`
- MySQL/MariaDB (schema in `newsweb.sql`)
- HTML / CSS / vanilla JS + jQuery
- Bootstrap 4 for styling

## Getting started

1. Import `newsweb.sql` into a MySQL/MariaDB database named `newsweb`.
2. Update `connect.php` and `admin/connect.php` to match your local DB host/port (the code expects `localhost:3307` — adjust if yours runs on the default `3306`).
3. Update the hardcoded upload path in `admin/insertarticle.php` and `admin/updatearticle.php` (`C:/Xampp/htdocs/NewsWebsite/admin/uploads/`) to match wherever you're running the project from.
4. Serve the project root with PHP:
   ```bash
   php -S localhost:8000
   ```
5. Public site: `index.php`. Admin panel: `admin/index.php` (sign up via `admin/adminsignup.php` — you'll need the company code from `admin/validate.php`).

## Known limitations / next steps

- **Passwords are hashed with MD5** (`checkuser.php`, `admincheckuser.php`, `admincreateusers.php`) — MD5 isn't designed for password storage (no salt, fast to brute-force). Should move to `password_hash()`/`password_verify()`.
- **Most queries build SQL via direct string interpolation** rather than prepared statements, across both the public site and admin panel — this is a SQL injection risk that should be addressed with `mysqli_prepare`/`bind_param` throughout.
- **Upload path is a hardcoded absolute Windows path**, tying the app to one machine's file layout instead of a relative or environment-configured path.
- No automated tests yet.
