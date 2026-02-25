// Supabase Configuration
// Get these values from your Supabase project settings > API
const SUPABASE_URL = 'https://zjaqmnswapusifgzmdjz.supabase.co';
const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InpqYXFtbnN3YXB1c2lmZ3ptZGp6Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzA0ODQ2MDAsImV4cCI6MjA4NjA2MDYwMH0.DramNYO2n1G6G3orIyBddDXgR0apo8bL53vC0fGM3zo';

// Initialize Supabase client
const supabaseClient = window.supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);
