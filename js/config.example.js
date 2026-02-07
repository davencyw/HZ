// Supabase Configuration
// Copy this file to config.js and fill in your values
// DO NOT commit config.js to version control!

// Get these from: Supabase Dashboard > Settings > API
const SUPABASE_URL = 'https://your-project-id.supabase.co';
const SUPABASE_ANON_KEY = 'your-anon-key-here'; // "anon" / "public" key (safe for frontend)

// Initialize Supabase client
const supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
