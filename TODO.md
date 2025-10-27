# TODO: Redirect Admin Login to admin/index

-   [x] Update routes/web.php: Add ->name('admin.index') to the admin route and fix middleware array to ['auth', 'isAdmin']
-   [x] Modify app/Http/Controllers/AuthController.php: Change the redirect to use the route name 'admin.index' after successful login
-   [x] Update app/Http/Middleware/isAdmin.php: Change redirect for non-admins to '/login' instead of '/admin'
