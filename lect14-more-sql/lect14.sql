-- Add album 'Fight On' by artist 'Spirit of Troy'
SELECT * FROM albums
WHERE title LIKE '%fight%';

-- Find out what the artist_id is of Spirit of Troy
SELECT * FROM artists
WHERE name LIKE '%spirit%';
-- Spirit of Troy doesn't exist, let's go create an artist
INSERT INTO artists (name)
VALUES ('Spirit of Troy');
-- Add album 'Fight On' by artists 'Spirit of Troy'
INSERT INTO albums (title, artist_id)
VALUES ('Fight On', 276);
-- Check that new album was created
SELECT * FROM albums
ORDER BY album_id DESC;

-- Look for the track named 'All My Love' ID: 3316
SELECT * FROM tracks
WHERE name LIKE '%All My Love%';

-- Update 'All My Love' to be composed by Tommy Trojan and album is Fight On
UPDATE tracks
SET composer = 'Tommy Trojan', album_id = 348
WHERE track_id = 3316;

-- Delete the album 'Fight On'. First double check my WHERE clause is correct
SELECT * FROM albums
WHERE album_id = 348;
-- Can't delete 'Fight On' because the track 'All My Love' belongs to 'Fight On' (foreign key)
DELETE FROM albums 
WHERE album_id = 349;

-- Two choices: 1) Delete 'All My Love' track OR 2) Leave 'All My Love' alone, but update its album_id
UPDATE tracks
SET album_id = null
WHERE track_id = 3316;

-- Create a view that displays all albums and their artists names
-- Only show album id, album title, and artist name
CREATE OR REPLACE VIEW album_artists AS
SELECT album_id, title AS album_title, name AS artist_name
FROM albums
	JOIN artists
		ON albums.artist_id = artists.artist_id;
-- "Call" the view. or go get the view
SELECT * FROM album_artists
WHERE artist_name LIKE '%A%';

-- DELETE a view
DROP VIEW album_artists;



-- AGGREGATE FUNCTIONS
SELECT COUNT(*)
FROM tracks;

SELECT COUNT(*), COUNT(composer)
FROM tracks;

SELECT MAX(milliseconds), MIN(milliseconds), AVG(milliseconds), SUM(milliseconds)
FROM tracks;

SELECT MAX(milliseconds), track_id
FROM tracks
WHERE track_id = MAX(milliseconds);

-- How long is a specific album?
SELECT SUM(milliseconds)
FROM tracks
WHERE album_id = 2;

SELECT RAND();

SELECT * 
FROM tracks
ORDER BY RAND();

SELECT * FROM tracks;

SELECT album_id, name, MIN(milliseconds)
FROM tracks;

-- Find shortest track for EACH album
SELECT tracks.album_id, albums.title, AVG(milliseconds)
FROM tracks
	JOIN albums
		ON tracks.album_id = albums.album_id
GROUP BY album_id;


-- For each artist, show artists and number of their albums
SELECT album_id, COUNT(*)
FROM albums
GROUP BY artist_id;

-- JOIN to show the artist name and how many albums they each have
SELECT artists.name, COUNT(*)
FROM albums
	JOIN artists
		ON albums.album_id = artists.artist_id
GROUP BY albums.artist_id;



