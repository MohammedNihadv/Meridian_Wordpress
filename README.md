# Meridian Studio — Custom WordPress Theme (TFD-02)

A production-grade, custom WordPress theme developed for **Meridian Studio** based on the design brief **TFD-02**. The theme is built from scratch utilizing clean, semantic HTML5, fluid layouts, and secure backend systems.

---

## Key Features

- **Semantic Page Templates**: Fully custom layouts for Home, Studio (About), Services, Journal (Archive), Single Posts, and Contact.
- **Dynamic CPT Grid**: Implements the Custom Post Type `meridian_project` (Selected Work) on the homepage.
- **Fluid Layout System**: Optimized for responsive viewing across breakpoints (360px / 768px / 1024px / 1440px) using CSS clamp scales and a 12-column grid.
- **Secure AJAX Contact Form**: Implements client-side validation (inline validation on blur, shake effect on error) and secure WordPress AJAX handling (nonce validation, honeypot spam protection, IP rate limiting).
- **Free Database Inquiry Logger**: Automatically saves contact form submissions directly to a private Custom Post Type (`meridian_inquiry`) in the database. Inquiries can be viewed, reviewed, and managed from a customized dashboard table in the WordPress Admin Panel, requiring no external setup or paid SMTP accounts.
- **CSS-First Animations**: Subtle fade-up reveals utilizing `IntersectionObserver` that automatically collapse to instant loads if `prefers-reduced-motion` is enabled.
- **Grayscale Embedded Map**: Features a modern, custom-styled grayscale inverted Google Map block.
- **Automatic Setup Seeding**: Automatically creates and template-assigns default page options (Home, Studio, Services, Journal, Contact) upon activating the theme.

---

## Tech Stack

- **Core**: WordPress (PHP 8+, MySQL)
- **Styling**: Vanilla CSS3 (Custom Variables, CSS Grid, Flexbox, Clamp Scales)
- **Frontend Logic**: Vanilla JavaScript (ES6+, Fetch API, IntersectionObserver)
- **Architecture**: Custom Post Types (CPT), Native AJAX, Custom Page Templates
- **Design Assets**: SVG Vectors, Google Fonts (Newsreader, Hanken Grotesk, IBM Plex Mono)

---

## Theme Directory Map

```text
Meridian_Build/
├── assets/
│   ├── css/
│   │   └── main.css             # Main stylesheet (variables, responsive grid, visual tokens)
│   ├── js/
│   │   └── main.js              # Sticky header, mobile overlay menu, intersection reveals, AJAX form
│   └── images/                  # Polished visual placeholders & team member cards
├── inc/                         # Modular includes (split from functions.php)
│   ├── admin-columns.php        # Custom dashboard columns for inquiry post type
│   ├── ajax-handlers.php        # Secure contact form AJAX submission handler
│   ├── custom-post-types.php    # Custom post types (Projects & Inquiries)
│   ├── enqueue.php              # Styles and scripts enqueuing
│   ├── setup.php                # Theme support and menu registrations
│   └── theme-setup-pages.php    # Auto page creation & DB template path migration helper
├── page-templates/              # Custom Page Templates
│   ├── page-about.php           # About / Studio layout template (5-column team grid)
│   ├── page-contact.php         # Contact template split details & form
│   └── page-services.php        # Services template detail rows
├── template-parts/              # Reusable template components
│   ├── card-journal.php         # Reusable card component for journal feed
│   └── card-project.php         # Reusable card component for selected work
├── archive.php                  # Archive page layout
├── footer.php                   # Global site footer (dark theme, aligned container grid)
├── front-page.php               # Homepage layout template
├── functions.php                # Slim include loader
├── header.php                   # Global header (responsive menu, admin bar offsets)
├── index.php                    # Journal Listing feed (featured post + category filters + card grid)
├── single.php                   # Single blog post template
├── style.css                    # WordPress Theme metadata declarations
└── screenshot.png               # WordPress dashboard preview thumbnail
```

---

## Local Installation & Setup

### Option 1: Installation via ZIP Download (Recommended for Reviewers)
1. **Download ZIP**: Go to the GitHub repository page ([MohammedNihadv/Meridian_Wordpress](https://github.com/MohammedNihadv/Meridian_Wordpress)), click the green **Code** button, and select **Download ZIP**.
2. **Upload to WordPress**:
   - Log into your WordPress Dashboard (`/wp-admin`).
   - Navigate to **Appearance > Themes > Add New Theme** (or **Add New** at the top).
   - Click **Upload Theme** at the top.
   - Choose the downloaded ZIP file and click **Install Now**.
3. **Activate**: Once installed, click the **Activate** link.

### Option 2: Installation via Git / Local Workspace
1. **Place Theme Folder**: Clone the repository or copy this theme directory into your local WordPress themes folder:
   `C:\xampp\htdocs\wordpress\wp-content\themes\meridian-theme`
   *(Alternatively, link it using a directory junction in PowerShell)*:
   ```powershell
   cmd /c mklink /J "C:\xampp\htdocs\wordpress\wp-content\themes\meridian-theme" "c:\Users\yourusername\Desktop\foldername\Meridian_Build"
   ```
2. **Activate Theme**: Log into the WordPress Dashboard (`/wp-admin`), navigate to **Appearance > Themes**, and click **Activate** on the **Meridian Studio Theme**.

### Post-Activation Configuration
1. **Reading Configuration**: Navigation pages are automatically seeded on activation. Go to **Settings > Reading**:
   - Set **Your homepage displays** to **A static page**.
   - Set **Homepage** to **Home**.
   - Set **Posts page** to **Journal**.
2. **CPT Projects**: To populate the "Selected Work" section on the homepage, go to **Projects > Add New** and publish your projects with title, thumbnail, and tags.
3. **Contact AJAX Action**: The form posts inquiries securely. Ensure PHP has mail server routing configured locally or via an SMTP plugin to test email delivery.
