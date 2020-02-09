DROP TABLE boardgames;
DROP TABLE publishers;


CREATE TABLE publishers (
    publisher_id              SERIAL NOT NULL PRIMARY KEY,
    publisher_name            varchar(40) UNIQUE             
);

CREATE TABLE boardgames (
    boardgame_id              SERIAL PRIMARY KEY,
    boardgame_name            varchar(40) UNIQUE,
    boardgame_min_players int,
    boardgame_max_players int,
    boardgame_coop_or_comp    varchar(15),
    publisher_id              int NOT NULL REFERENCES publishers(publisher_id)
);

INSERT INTO publishers VALUES (DEFAULT, 'other');
INSERT INTO publishers VALUES (DEFAULT, 'Z-Man Games');
INSERT INTO publishers VALUES (DEFAULT, 'Hasbro');
INSERT INTO publishers VALUES (DEFAULT, 'Test Publisher');

INSERT INTO boardgames VALUES (DEFAULT, 'Monopoly', 2, 8, 'Competitive', (SELECT publisher_id FROM publishers WHERE publisher_name = 'Hasbro'));
INSERT INTO boardgames VALUES (DEFAULT, 'test game', 2, 8, 'Competitive', (SELECT publisher_id FROM publishers WHERE publisher_name = 'Test Publisher'));
INSERT INTO boardgames VALUES (DEFAULT, 'Pandemic', 2, 8, 'Cooperative', (SELECT publisher_id FROM publishers WHERE publisher_name = 'Z-Man Games'));

SELECT 
boardgame_name,
publisher_id
FROM 
boardgames;

SELECT 
publisher_id 
FROM
boardgames;

SELECT 
publisher_id,
publisher_name
FROM 
publishers;

DELETE FROM boardgames;
DELETE FROM publishers;