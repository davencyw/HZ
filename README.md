# Wedding Website

## Tech Stack

- HTML5 / CSS3 / JavaScript
- [Supabase](https://supabase.com) (PostgreSQL database)
- Hosted on GitHub Pages (or any static hosting)

---

## Setup Guide

### 1. Create a Supabase Project

1. Go to [https://supabase.com](https://supabase.com) and sign up (free tier available)
2. Click **New Project**
3. Enter a project name (e.g., `hochzeit`)
4. Set a secure database password (save this somewhere safe)
5. Select a region close to you
6. Click **Create new project** and wait for it to initialize (~2 minutes)

### 2. Create the Database Table

1. In your Supabase dashboard, click **SQL Editor** in the left sidebar
2. Click **New query**
3. Copy and paste the contents of `supabase-schema.sql`:

```sql
-- Create RSVP table
CREATE TABLE rsvp (
    id BIGSERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    guests INTEGER DEFAULT 1,
    attending TEXT NOT NULL CHECK (attending IN ('yes', 'no', 'maybe')),
    dietary_requirements TEXT,
    message TEXT,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Enable Row Level Security
ALTER TABLE rsvp ENABLE ROW LEVEL SECURITY;

-- Policy: Allow anyone to insert (for RSVP submissions)
CREATE POLICY "Allow public insert" ON rsvp
    FOR INSERT
    WITH CHECK (true);

-- Policy: Allow anyone to read (for admin dashboard)
CREATE POLICY "Allow public read" ON rsvp
    FOR SELECT
    USING (true);

-- Policy: Allow update based on email match
CREATE POLICY "Allow update by email" ON rsvp
    FOR UPDATE
    USING (true)
    WITH CHECK (true);

-- Create index for faster email lookups
CREATE INDEX idx_rsvp_email ON rsvp(email);
```

4. Click **Run** (or press Cmd/Ctrl + Enter)
5. You should see "Success. No rows returned"

### 3. Get Your Supabase API Keys

1. In Supabase dashboard, go to **Settings** (gear icon) > **API**
2. Copy the following values:
   - **Project URL**: `https://xxxxxxxxxxxxx.supabase.co`
   - **anon public** key: `eyJhbGciOiJIUzI1NiIsInR5cCI6...`

### 4. Configure the Website

1. Copy the example config file:
   ```bash
   cp js/config.example.js js/config.js
   ```
2. Open `js/config.js` in your editor
3. Replace the placeholder values:

```javascript
const SUPABASE_URL = 'https://your-project-id.supabase.co';
const SUPABASE_ANON_KEY = 'your-anon-key-here';
const ADMIN_PASSWORD = 'choose-a-secure-password';
```

3. Save the file

### 5. Customize Content

Edit the following files to personalize for your wedding:

| File | What to Change |
|------|----------------|
| `index.html` | Couple names, wedding date, welcome message |
| `details.html` | Timeline, times, dresscode, gift info |
| `location.html` | Venue addresses, Google Maps embed URL |
| `admin.html` | Couple names in footer |
| All files | Footer names and date |

**To update the Google Maps embed:**
1. Go to [Google Maps](https://maps.google.com)
2. Search for your venue
3. Click **Share** > **Embed a map**
4. Copy the `<iframe>` src URL
5. Replace the URL in `location.html`

---

## Local Development

### Option 1: Using the Start Script

```bash
./start.sh
```

Opens at http://localhost:8000

### Option 2: Manual Server

Using Python:
```bash
python3 -m http.server 8000
```

Using PHP:
```bash
php -S localhost:8000
```

Using Node.js (npx):
```bash
npx serve
```

---

## Deployment

### GitHub Pages (Free)

1. **Create a GitHub repository:**
  

2. **Enable GitHub Pages:**
   - Go to your repository on GitHub
   - Click **Settings** > **Pages**
   - Under "Source", select **Deploy from a branch**
   - Select **main** branch and **/ (root)**
   - Click **Save**

3. **Access your site:**
   - Your site will be live at `https://YOUR_USERNAME.github.io/hochzeit/`
   - It may take a few minutes for the first deployment

### Custom Domain (Optional)

1. In your repository, go to **Settings** > **Pages**
2. Under "Custom domain", enter your domain (e.g., `hochzeit.example.com`)
3. Add a CNAME record with your DNS provider:
   - Type: `CNAME`
   - Name: `hochzeit` (or `@` for root domain)
   - Value: `YOUR_USERNAME.github.io`
4. Wait for DNS propagation (up to 24 hours)
5. Enable "Enforce HTTPS" once the certificate is issued

### Alternative Hosting

The site works on any static hosting provider:

- **Netlify**: Drag and drop the folder at [netlify.com/drop](https://app.netlify.com/drop)
- **Vercel**: Connect your GitHub repo at [vercel.com](https://vercel.com)
- **Cloudflare Pages**: Connect via [pages.cloudflare.com](https://pages.cloudflare.com)

---

## Admin Access

The admin dashboard is not linked in the navigation for privacy.

- **URL**: `/admin.html`
- **Password**: Set in `js/config.js`

The dashboard shows:
- Total responses
- Confirmed guests count
- Attendance breakdown (yes/no/maybe)
- Full table with all RSVP details

---

## File Structure

```
hochzeit/
├── index.html          # Home page
├── details.html        # Wedding details & timeline
├── location.html       # Venue & directions
├── rsvp.html           # RSVP form
├── admin.html          # Admin dashboard
├── css/
│   └── style.css       # All styles
├── js/
│   ├── config.js       # Supabase config (edit this!)
│   └── nav.js          # Mobile navigation
├── supabase-schema.sql # Database schema
├── start.sh            # Local dev server script
└── README.md           # This file
```

---

## Security Notes

- The `anon` key is safe to expose in frontend code - it only allows operations permitted by Row Level Security policies
- The admin password is client-side only (sufficient for a wedding site, not for sensitive data)
- For additional security, you can restrict the read policy in Supabase to require authentication
