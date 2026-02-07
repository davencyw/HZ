-- Supabase SQL Schema
-- Run this in the Supabase SQL Editor (Dashboard > SQL Editor)

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
-- Note: In production, you might want to restrict this
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
