# Hamilton County Child Theme - Setup Guide

## Quick Start Installation

### Step 1: Install Prerequisites

1. **Parent Theme**: Ensure `bd-basetheme-2023` is installed and available
2. **WordPress Version**: Requires WordPress 6.0 or higher
3. **PHP Version**: PHP 7.4 or higher recommended
4. **Node.js**: Version 14.x or higher - [Download Node.js](https://nodejs.org/)
5. **npm**: Comes bundled with Node.js

### Step 2: Install Node Dependencies

1. Open Terminal/Command Prompt
2. Navigate to the child theme directory:

    ```bash
    cd /path/to/wp-content/themes/hamco-child
    ```

3. Install dependencies:

    ```bash
    npm install
    ```

    This will install:

    - Tailwind CSS v3.4
    - Tailwind Typography plugin
    - Tailwind Forms plugin
    - Tailwind Aspect Ratio plugin
    - PostCSS and Autoprefixer

### Step 3: Build Tailwind CSS

1. For **development** (watches for file changes):

    ```bash
    npm run dev
    ```

    Leave this running while you develop. It will automatically rebuild CSS when you modify files.

2. For **production** (optimized build):

    ```bash
    npm run build
    ```

    Run this before deploying to production for minified, optimized CSS.

### Step 4: Activate Child Theme

1. Go to **Appearance > Themes**
2. Find **Hamilton County Child Theme**
3. Click **Activate**

### Step 5: Configure ACF Fields

The theme automatically registers new ACF field groups on activation:

-   Utility Bar Settings
-   Property Alert Settings
-   Welcome Section
-   Department Staff

To configure these:

1. Go to **General Options** in the admin menu
2. Fill in the following sections:
    - **Utility Bar Links**: Add Directory, Calendar, Chester links
    - **Welcome Section**: Add chairman photo and welcome text
    - **Property Alert**: Enable and configure tax alert message

### Step 6: Set Up Menus

1. Go to **Appearance > Menus**
2. Create/assign the following menu locations:
    - **Primary Menu**: Main header navigation
    - **Footer Resources**: Footer quick links column
    - **Footer Departments**: Department links in footer

### Step 7: Configure Homepage

1. Create/edit the homepage
2. Set template to **"Home Page Template"**
3. Configure ACF Options:
    - **Quick Links**: Add 6 quick link items
    - **Hero Slides**: Add slideshow images and content
    - **Featured Events**: Select events to display

## Troubleshooting Common Issues

### Issue: Tailwind styles not applying

**Solution:**

1. Verify CSS was compiled: Check if `assets/css/main.css` exists
2. Run build command: `npm run build`
3. Clear WordPress cache (if using caching plugin)
4. Check browser console for CSS loading errors
5. Verify file permissions on assets directory
6. Hard refresh browser (Cmd+Shift+R or Ctrl+Shift+R)

### Issue: npm install fails

**Solution:**

1. Check Node.js version: `node --version` (must be 14.x or higher)
2. Update npm: `npm install -g npm@latest`
3. Clear npm cache: `npm cache clean --force`
4. Delete `node_modules` and `package-lock.json`, then try again

### Issue: Build command hangs or fails

**Solution:**

1. Stop any running `npm run dev` processes
2. Check `tailwind.config.js` for syntax errors
3. Verify `src/input.css` exists and is properly formatted
4. Run `npm run build:dev` for unminified output with better error messages

### Issue: Mobile menu not working

**Solution:**

1. Check browser console for JavaScript errors
2. Verify Alpine.js is loading (View Page Source)
3. Clear any JavaScript optimization cache

### Issue: Missing Hamilton County logo

**Solution:**

1. The logo SVG is referenced from the parent theme
2. Ensure parent theme file exists: `/themes/bd-basetheme-2023/images/inline-hamco-logo-color.svg.php`
3. If missing, upload a logo image to Media Library and update header.php

### Issue: ACF fields not showing

**Solution:**

1. Ensure ACF Pro plugin is activated
2. Go to **Custom Fields > Tools**
3. Try syncing field groups
4. Check if fields are registered in `functions.php`

## Content Migration Checklist

When setting up the theme with existing content:

-   [ ] **General Options**

    -   [ ] Add utility bar links (Directory, Calendar, Chester)
    -   [ ] Configure welcome section content
    -   [ ] Upload chairman/leader photo
    -   [ ] Set up property alert text and link
    -   [ ] Add contact information (address, phone, hours)

-   [ ] **Quick Links**

    -   [ ] Add 6 quick link items with icons
    -   [ ] Configure titles and descriptions
    -   [ ] Set destination URLs

-   [ ] **Departments**

    -   [ ] Update department manager information
    -   [ ] Add department staff members
    -   [ ] Configure sidebar navigation links
    -   [ ] Upload relevant documents

-   [ ] **Footer Content**
    -   [ ] Set up footer menus
    -   [ ] Add social media URLs
    -   [ ] Configure newsletter signup (if applicable)
    -   [ ] Update copyright information

## Performance Optimization

### Enable Caching

1. Install a caching plugin (WP Rocket, W3 Total Cache)
2. Enable page caching
3. Enable browser caching
4. Minify CSS/JS if not handled by WindPress

### Image Optimization

1. Use WebP format for images where possible
2. Set appropriate image sizes in Media Settings
3. Enable lazy loading (built into theme)

### Tailwind CSS Optimization

1. **Always use production build** for live sites: `npm run build`
2. **PurgeCSS** is automatic - removes unused styles
3. **JIT Mode** is enabled by default in Tailwind v3
4. **Minification** happens automatically with production build
5. Keep `content` paths in `tailwind.config.js` accurate for optimal purging

## Security Considerations

1. Keep WordPress, themes, and plugins updated
2. Use strong passwords for all admin accounts
3. Implement SSL certificate
4. Regular backups of database and files
5. Consider security plugin (Wordfence, Sucuri)

## Support Resources

### Documentation

-   Theme README: `/themes/hamco-child/README.md`
-   Tailwind CSS Docs: [tailwindcss.com/docs](https://tailwindcss.com/docs)
-   Tailwind CLI: [tailwindcss.com/docs/installation](https://tailwindcss.com/docs/installation)
-   Alpine.js: [alpinejs.dev](https://alpinejs.dev)
-   Node.js: [nodejs.org/docs](https://nodejs.org/docs)

### Getting Help

-   Developer Support: support@blackwell.digital
-   Tailwind CSS Community: [github.com/tailwindlabs/tailwindcss/discussions](https://github.com/tailwindlabs/tailwindcss/discussions)
-   Theme Issues: Contact site administrator

## Development Notes

### Making Style Changes

1. Modify classes directly in PHP templates
2. Add custom CSS to `style.css` if needed
3. Update WindPress config for new colors/utilities
4. Always test responsive behavior

### Adding New Templates

1. Create new PHP file in theme directory
2. Add template header comment
3. Use Tailwind classes for styling
4. Follow existing template structure

### Updating ACF Fields

1. Make changes in WordPress admin
2. Export field groups as JSON
3. Store in `/acf-json/` directory (if using local JSON)
4. Or update registration in `functions.php`

## Final Checklist

Before going live:

-   [ ] All content migrated and displaying correctly
-   [ ] Mobile responsive testing completed
-   [ ] Forms tested and working
-   [ ] Search functionality verified
-   [ ] Navigation menus configured
-   [ ] Footer information updated
-   [ ] Social media links working
-   [ ] Contact information accurate
-   [ ] Performance optimizations applied
-   [ ] Security measures in place
-   [ ] Backup created
-   [ ] Analytics configured (if applicable)

---

_Last Updated: [Current Date]_
_Version: 1.0.0_
