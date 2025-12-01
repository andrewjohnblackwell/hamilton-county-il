# Deployment Guide

## Pre-Deployment Checklist

Before deploying the Hamilton County Child Theme to production:

### 1. Build Production CSS

```bash
cd /path/to/themes/hamco-child
npm run build
```

This creates an optimized, minified CSS file at `assets/css/main.css`.

### 2. Verify Files

Ensure these files exist:

-   ✅ `assets/css/main.css` (compiled CSS)
-   ✅ `style.css` (WordPress theme metadata)
-   ✅ `functions.php`
-   ✅ All template files
-   ✅ `js/theme.js`

### 3. Files to Deploy

**Include:**

-   All `.php` files
-   `assets/` directory (with compiled CSS)
-   `js/` directory
-   `images/` directory
-   `style.css`
-   `template-parts/` directory

**Exclude (DO NOT upload to production):**

-   `node_modules/` - Dependencies (large, not needed)
-   `src/` - Source files (only for development)
-   `package.json` - Only needed for development
-   `package-lock.json` - Only needed for development
-   `tailwind.config.js` - Only needed for development
-   `.gitignore` - Git-specific

## Deployment Methods

### Method 1: FTP/SFTP Upload

1. Build production CSS locally: `npm run build`
2. Connect to server via FTP/SFTP
3. Upload only the necessary files (see "Files to Deploy" above)
4. Navigate to `/wp-content/themes/`
5. Upload `hamco-child` folder (excluding development files)

### Method 2: Git Deployment

If using Git for deployment:

1. **Before committing:**

    ```bash
    npm run build
    ```

2. **Add compiled CSS to Git:**

    Edit `.gitignore` to allow `assets/css/main.css`:

    ```gitignore
    # In .gitignore, comment out or remove:
    # assets/css/main.css
    ```

3. **Commit and push:**

    ```bash
    git add assets/css/main.css
    git commit -m "Build production CSS"
    git push origin main
    ```

4. **On production server:**
    ```bash
    git pull origin main
    ```

### Method 3: Automated Build (Advanced)

Set up a build script on your server:

1. **Install Node.js on production server**
2. **Add build script to deployment pipeline:**

    ```bash
    #!/bin/bash
    cd /path/to/wp-content/themes/hamco-child
    npm install --production
    npm run build
    ```

3. **Run on each deployment**

## Post-Deployment Steps

### 1. Activate Theme

1. Log into WordPress admin
2. Go to **Appearance > Themes**
3. Activate **Hamilton County Child Theme**

### 2. Clear Caches

-   **WordPress Cache**: Clear if using caching plugin
-   **Server Cache**: Clear server-side cache (Varnish, Redis, etc.)
-   **CDN Cache**: Purge CDN cache if applicable

### 3. Verify Styles

1. Visit homepage in incognito/private browser window
2. Inspect elements to verify Tailwind classes are applied
3. Check that `main.css` is loading (Network tab in DevTools)
4. Test responsive layouts on mobile devices

### 4. Configure ACF Fields

1. Go to **General Options**
2. Configure:
    - Utility Bar Links
    - Welcome Section
    - Property Alert
    - Contact Information
    - Quick Links

### 5. Test Functionality

-   ✅ Mobile menu opens/closes
-   ✅ Search form works
-   ✅ Navigation dropdowns function
-   ✅ Links are clickable
-   ✅ Department pages display correctly
-   ✅ Footer displays all columns

## Troubleshooting Deployment Issues

### Styles Not Loading

**Check:**

1. Is `assets/css/main.css` present on server?
2. File permissions: Should be 644 for CSS files
3. Clear all caches (WordPress, server, browser)
4. Check browser console for 404 errors

### File Permission Errors

**Fix:**

```bash
# For files
find . -type f -exec chmod 644 {} \;

# For directories
find . -type d -exec chmod 755 {} \;
```

### CSS File Not Found (404)

**Check:**

1. Verify file path in `functions.php`:
    ```php
    get_stylesheet_directory_uri() . '/assets/css/main.css'
    ```
2. Confirm file exists on server
3. Check `.htaccess` isn't blocking CSS files

## Updating the Theme

When making updates:

### Development Process

1. **Make changes locally**
2. **Test thoroughly**
3. **Build production CSS:**
    ```bash
    npm run build
    ```
4. **Deploy updated files**
5. **Clear caches**
6. **Test on production**

### Emergency Rollback

If issues occur:

1. **Deactivate child theme**
2. **Activate parent theme** (bd-basetheme-2023)
3. **Fix issues**
4. **Test locally**
5. **Redeploy**

## Performance Optimization

### After Deployment

1. **Enable caching** - WP Rocket, W3 Total Cache, etc.
2. **Enable Gzip compression** - Server-level
3. **Set up CDN** - For static assets
4. **Optimize images** - Use WebP format
5. **Enable lazy loading** - Built into theme

### Monitoring

-   Check page load times with GTmetrix or PageSpeed Insights
-   Monitor CSS file size (should be ~50KB minified)
-   Test on various devices and browsers

## Security Checklist

-   [ ] Remove development files from production
-   [ ] Ensure file permissions are correct (644 for files, 755 for directories)
-   [ ] Keep WordPress core updated
-   [ ] Keep parent theme updated
-   [ ] Install security plugin (Wordfence, Sucuri)
-   [ ] Use strong admin passwords
-   [ ] Enable SSL/HTTPS
-   [ ] Regular backups configured

## Support

If you encounter issues during deployment:

-   **Developer Support**: support@blackwell.digital
-   **Documentation**: See README.md and SETUP-GUIDE.md
-   **WordPress Support**: wordpress.org/support

---

**Last Updated**: October 2024  
**Theme Version**: 1.0.0
