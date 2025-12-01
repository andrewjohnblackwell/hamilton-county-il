# Hamilton County WordPress Child Theme

A modern, Tailwind CSS-powered child theme for Hamilton County, Illinois. This theme transforms the Blackwell Digital Base Theme 2023 with a contemporary design inspired by Randolph County's aesthetic while maintaining Hamilton County's unique branding.

## Theme Features

-   **Tailwind CSS Integration**: Modern utility-first CSS framework for rapid development
-   **Responsive Design**: Mobile-first approach with breakpoints for all device sizes
-   **Accessibility**: WCAG AA compliant with semantic HTML and ARIA labels
-   **Alpine.js**: Lightweight JavaScript framework for interactive components
-   **Custom ACF Fields**: Extended options for content management

## Installation

### Prerequisites

-   **Node.js**: Version 14.x or higher ([Download](https://nodejs.org/))
-   **npm**: Comes with Node.js
-   **WordPress**: Version 6.0 or higher
-   **Parent Theme**: Blackwell Digital Base Theme 2023

### Setup Steps

1. **Install Parent Theme**: Ensure the Blackwell Digital Base Theme 2023 is installed
2. **Upload Child Theme**: Upload the `hamco-child` folder to `/wp-content/themes/`
3. **Install Node Dependencies**:

    ```bash
    cd /path/to/wp-content/themes/hamco-child
    npm install
    ```

4. **Build Tailwind CSS**:

    ```bash
    # For development (with file watching)
    npm run dev

    # For production (minified)
    npm run build
    ```

5. **Activate Theme**: Go to Appearance > Themes and activate "Hamilton County Child Theme"

## Tailwind CSS Configuration

### Development Workflow

The theme uses **Tailwind CLI** for building CSS. All custom styles are in `src/input.css` and compile to `assets/css/main.css`.

**Development mode** (watches for changes):

```bash
npm run dev
```

**Production build** (optimized and minified):

```bash
npm run build
```

### Custom Configuration

The theme's Tailwind configuration is in `tailwind.config.js`:

```javascript
module.exports = {
	content: [
		"./**/*.php",
		"./src/**/*.js",
		"./template-parts/**/*.php",
		"../bd-basetheme-2023/template-parts/**/*.php",
	],
	theme: {
		extend: {
			colors: {
				"hamco-green": "#006735",
				"navy-dark": "#0d1b2a",
				"blue-gray-light": "#e8f4f8",
			},
			// Additional customizations...
		},
	},
	plugins: [
		require("@tailwindcss/typography"),
		require("@tailwindcss/forms"),
		require("@tailwindcss/aspect-ratio"),
	],
}
```

### Source Files

-   **Source CSS**: `src/input.css` - Contains Tailwind directives and custom styles
-   **Compiled CSS**: `assets/css/main.css` - Auto-generated, enqueued by WordPress
-   **Config**: `tailwind.config.js` - Tailwind configuration

### Performance Optimization

-   **JIT Mode**: Enabled by default in Tailwind v3
-   **PurgeCSS**: Automatically removes unused styles in production
-   **Minification**: Enabled with `npm run build`
-   **File Watching**: `npm run dev` watches for changes and rebuilds automatically

## Content Management

### Theme Options

Navigate to **General Options** in the WordPress admin to configure:

#### Utility Bar Settings

-   **Utility Bar Links**: Add/edit links for the top navigation bar
    -   Link Text
    -   Link URL
    -   Icon Class (Font Awesome)

#### Welcome Section

-   **Enable/Disable**: Toggle the welcome section visibility
-   **Welcome Heading**: Customize the section title
-   **Welcome Content**: Rich text editor for welcome message
-   **Chairman Photo**: Upload chairman/leader photo
-   **Call to Action**: Configure button text and link

#### Property Alert

-   **Enable/Disable**: Toggle the property alert banner
-   **Alert Text**: Customize the alert message
-   **Alert URL**: Link to property tax information

### Department Pages

Department pages include several content sections:

1. **Department Manager**

    - Name, Title, Photo
    - Contact Information
    - Office Hours
    - Additional Notes

2. **Department Staff** (Repeater Field)

    - Staff Photo
    - Name and Title
    - Phone, Fax, Email
    - Address
    - Social Media Links

3. **Sidebar Navigation**

    - Custom links for department resources
    - Automatically styled with green background

4. **Department Resources**
    - Links Section
    - Documents & Forms
    - Tax Data (if applicable)

## Template Structure

### Main Templates

-   `header.php` - Site header with utility bar and main navigation
-   `footer.php` - Multi-column footer with contact info
-   `page-home.php` - Homepage template with all modules
-   `single-department.php` - Department page template
-   `page.php` - Default page template

### Template Parts

-   `module-hero-page.php` - Hero section with breadcrumbs
-   `module-quicklinks.php` - Quick links grid (3x2 desktop, 1 column mobile)
-   `module-welcome.php` - Welcome section with chairman photo
-   `module-property-alert.php` - Property tax alert banner
-   `module-featured-news.php` - Featured news section (inherited)
-   `module-featured-events.php` - Featured events section (inherited)

## Customization Guide

### Colors

The theme uses a custom color palette defined in the WindPress configuration:

-   **Primary Green**: `#006735` (Hamilton County green)
-   **Dark Navy**: `#0d1b2a` (Headers/Footers)
-   **Light Blue-Gray**: `#e8f4f8` (Background sections)

To modify colors, update the WindPress configuration or override in `style.css`.

### Typography

The theme uses Inter as the primary font. To change:

1. Update the font stack in WindPress config
2. Or add custom CSS in the child theme's `style.css`

### Navigation Menus

Configure menus in **Appearance > Menus**:

-   **Primary Menu** (menu-1): Main header navigation
-   **Footer Resources** (menu-2): Footer quick links
-   **Footer Departments** (menu-3): Department links in footer
-   **Footer Calendar** (menu-4): Calendar/events links

### Responsive Breakpoints

The theme uses Tailwind's default breakpoints:

-   `sm`: 640px and up
-   `md`: 768px and up
-   `lg`: 1024px and up
-   `xl`: 1280px and up
-   `2xl`: 1536px and up

## Browser Support

-   Chrome (latest 2 versions)
-   Firefox (latest 2 versions)
-   Safari (latest 2 versions)
-   Edge (latest 2 versions)
-   Mobile Safari (iOS 12+)
-   Chrome Mobile (Android 8+)

## Accessibility Features

-   Semantic HTML5 structure
-   ARIA labels for interactive elements
-   Skip navigation links
-   Keyboard navigation support
-   Color contrast WCAG AA compliant
-   Screen reader optimized

## Troubleshooting

### Styles Not Loading

1. Verify Tailwind CSS has been compiled: `npm run build`
2. Check that `assets/css/main.css` exists
3. Clear WordPress cache
4. Inspect browser console for CSS loading errors
5. Verify child theme is activated
6. Check file permissions on assets directory

### Build Errors

If `npm run build` fails:

1. Delete `node_modules` and reinstall: `rm -rf node_modules && npm install`
2. Check Node.js version: `node --version` (should be 14.x or higher)
3. Verify `tailwind.config.js` syntax is correct
4. Check for errors in `src/input.css`

### Missing Icons

The theme uses Font Awesome 6. Ensure the parent theme's Font Awesome assets are loading correctly.

### Mobile Menu Not Working

1. Verify Alpine.js is loading (check browser console)
2. Clear any JavaScript optimization/minification cache
3. Check for JavaScript errors in console

## Support

For theme support and customization:

-   Email: support@blackwell.digital
-   Documentation: [Theme Docs](#)
-   Issues: Contact your administrator

## License

This theme is licensed under GPL v2 or later.

## Credits

-   Developed by Blackwell Digital
-   Built with Tailwind CSS
-   Interactive components powered by Alpine.js
-   Icons by Font Awesome

## Changelog

### Version 1.0.0

-   Initial release
-   Tailwind CSS integration via WindPress
-   Responsive design implementation
-   Custom ACF fields for enhanced content management
-   Department staff management system
-   Property alert banner
-   Welcome section with chairman photo
-   Accessible navigation with keyboard support
