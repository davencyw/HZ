// Supabase Configuration
// Get these values from your Supabase project settings > API
// (Do not commit real keys — use placeholders in version control or gitignore config.js)
const SUPABASE_URL = 'https://your-project-id.supabase.co';
const SUPABASE_ANON_KEY = 'your-anon-key-here';

// Initialize Supabase client
const supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
