# Wedding Website

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

---

## Local Development

### Option 1: Using the Start Script

```bash
./start.sh
```

Opens at http://localhost:8000
