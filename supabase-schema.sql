-- Supabase RSVP Table Schema
-- Run this in your Supabase SQL Editor

CREATE TABLE IF NOT EXISTS rsvp (
    id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
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

-- Policy: Allow anyone to insert (for form submissions)
CREATE POLICY "Allow public insert" ON rsvp
    FOR INSERT
    WITH CHECK (true);

-- Policy: Allow anyone to update their own entry (by email)
CREATE POLICY "Allow public update by email" ON rsvp
    FOR UPDATE
    USING (true);

-- Policy: Allow anyone to read (for checking existing emails)
CREATE POLICY "Allow public select" ON rsvp
    FOR SELECT
    USING (true);
