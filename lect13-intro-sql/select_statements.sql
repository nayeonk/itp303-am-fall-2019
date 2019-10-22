-- SELECT all columns from tracks table, Limit is 1000 by default
SELECT * FROM tracks;
SELECT * FROM artists;

-- Display tracks that cost more than 0.99
-- Sort them from shortest to longest in length
SELECT * FROM tracks
WHERE unit_price > 0.99
ORDER by milliseconds DESC;

-- Display only track_id, name, milliseconds, and unit_price
SELECT track_id, name, milliseconds, unit_price
FROM tracks
WHERE unit_price > 0.99
ORDER by milliseconds DESC;

SELECT * FROM tracks
WHERE composer IS NULL;

-- Display tracks that have 'you'  or 'day' in their names
SELECT * FROM tracks
WHERE name LIKE '%you%' OR name LIKE '%day%';

-- Display tracks that are composed by U2 that have 'you' or 'day' in their names
SELECT * FROM tracks
WHERE( name LIKE '%you%' OR name LIKE '%day%')
AND composer LIKE '%u2';

-- Display all albums and artists corresponding to each album.
-- Only show album title and artist name
SELECT title AS album_title, name AS artist_name
FROM albums
JOIN artists
ON albums.artist_id = artists.artist_id;

-- Display All Jazz tracks
SELECT * FROM tracks
WHERE genre_id = 2;

-- Display all Jazz tracks
-- Show track name, genre name, album title, and artist name
SELECT * FROM tracks
JOIN genres
	ON tracks.genre_id = genres.genre_id
JOIN albums
	ON tracks.album_id = albums.album_id
JOIN artists
	ON albums.artist_id = artists.artist_id
WHERE tracks.genre_id = 2;
