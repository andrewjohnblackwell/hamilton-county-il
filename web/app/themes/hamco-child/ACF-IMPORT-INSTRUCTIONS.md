# ACF Field Import Instructions

## How to Import the ACF Fields

1. **Access ACF Tools**:

    - Go to WordPress Admin → Custom Fields → Tools
    - Or navigate to: `/wp-admin/edit.php?post_type=acf-field-group&page=acf-tools`

2. **Import the JSON File**:
    - Click on the "Import" tab
    - Click "Choose File" and select `acf-export.json` from the child theme folder
    - Click "Import JSON"
    - The field groups will be imported and activated

## Field Groups Included

### 1. **Hamilton County Theme Options** (Options Page Fields)

Located under: **General Options → General Theme Options**

-   **Utility Bar Settings**:
    -   `utility_bar_links` - Links for the top green bar (Directory, Calendar, Chester)
-   **Homepage Hero**:

    -   `homepage_hero_image` - Background image for hero section
    -   `homepage_hero_title` - Main headline
    -   `homepage_hero_subtitle` - Subtitle text
    -   `homepage_hero_cta` - Call to action button
    -   `hero_quick_links` - Optional quick link cards in hero

-   **Property Alert Banner**:

    -   `property_alert_enabled` - Toggle to show/hide
    -   `property_alert_text` - Alert message text
    -   `property_alert_link` - Link for "Click here for details"

-   **Welcome Section**:

    -   `welcome_section_enabled` - Toggle to show/hide
    -   `welcome_section_image` - Chairman/official photo
    -   `welcome_section_title` - Welcome heading
    -   `welcome_section_content` - Welcome message (WYSIWYG)
    -   `welcome_section_button_text` - CTA button text
    -   `welcome_section_button_link` - CTA button URL

-   **Quick Links**:

    -   `quicklinks_cards` - Homepage quick link cards (max 6)

-   **Footer Settings**:
    -   `courthouse_hours` - Operating hours
    -   `courthouse_address` - Physical address
    -   `courthouse_phone` - Main phone number
    -   `footer_departments` - Department links
    -   `footer_links` - Important links
    -   `social_media_links` - Social media profiles

### 2. **Page Hero Options** (Individual Pages)

Located on: **Any Page → Page Hero Options (sidebar)**

-   `hero_background_image` - Override featured image
-   `hero_custom_title` - Custom hero title
-   `hero_subtitle` - Optional subtitle

### 3. **Department Staff** (Department Pages)

Located on: **Department posts → Department Staff**

-   `department_manager_name` - Department head name
-   `department_manager_title` - Manager's title
-   `department_manager_photo` - Manager's photo
-   `department_staff` - Staff members repeater with:
    -   Photo, Name, Title
    -   Email, Phone, Fax
    -   Office Address
    -   Facebook URL

## After Import

1. **Populate the Fields**:

    - Go to **General Options** in the admin menu
    - Fill in the theme options (utility bar links, hero settings, etc.)
    - Save the options

2. **Test the Homepage**:

    - Visit the homepage to see the hero section
    - Check that quick links display
    - Verify the welcome section appears
    - Check footer information

3. **Configure Individual Pages**:

    - Edit any page to set custom hero images
    - Add hero titles and subtitles as needed

4. **Set Up Departments**:
    - Edit department posts
    - Add staff members and manager information

## Troubleshooting

If fields don't appear:

1. Make sure ACF Pro is activated
2. Check that field groups are set to "Active"
3. Clear any caching plugins
4. Verify the theme is activated

## Default Values

Many fields include sensible defaults:

-   Hero Title: "Hamilton County"
-   Hero Subtitle: "Serving the Community Since 1821"
-   Welcome Title: "Welcome to Hamilton County"
-   Courthouse Hours: "Monday - Friday, 8:30 AM - 4:30 PM"
-   Courthouse Address: "100 S Jackson Street, McLeansboro, IL 62859"

## Need Help?

If you encounter any issues:

1. Check that you're using ACF Pro (not the free version)
2. Ensure the child theme is active
3. Try deactivating and reactivating ACF Pro
4. Clear browser cache and WordPress cache
