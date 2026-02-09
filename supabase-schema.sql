-- Supabase RSVP Table Schema
-- Run this in your Supabase SQL Editor

CREATE TABLE IF NOT EXISTS rsvp (
    id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
    name TEXT NOT NULL,
    guests INTEGER DEFAULT 1,
    attending TEXT NOT NULL CHECK (attending IN ('yes', 'no', 'maybe')),
    dietary_requirements TEXT,
    message TEXT,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Enable Row Level Security
ALTER TABLE rsvp ENABLE ROW LEVEL SECURITY;

-- Policy: Allow anyone to insert (for form submissions)
CREATE POLICY "Allow public insert" ON rsvp
    FOR INSERT
    WITH CHECK (true);
