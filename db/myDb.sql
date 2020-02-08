DROP TABLE boardgames;
DROP TABLE publishers;


CREATE TABLE publishers (
    publisher_id              SERIAL PRIMARY KEY,
    publisher_name            varchar(40) UNIQUE             
);

CREATE TABLE boardgames (
    boardgame_id              SERIAL PRIMARY KEY,
    boardgame_name            varchar(40) UNIQUE,
    boardgame_min_num_players int,
    boardgame_max_num_players int,
    boardgame_coop_or_comp    int,
    publisher_id              int REFERENCES publishers(publisher_id)
);

INSERT INTO publishers VALUES (DEFAULT, 'test publisher');
INSERT INTO publishers VALUES (DEFAULT, 'Hasbro');

INSERT INTO boardgames VALUES (DEFAULT, 'Monopoly', 2, 8, (SELECT publisher_id FROM publishers WHERE publisher_name = 'Hasbro'));
INSERT INTO boardgames VALUES (DEFAULT, 'test game', 2, 8, (SELECT publisher_id FROM publishers WHERE publisher_name = 'Hasbro'));

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