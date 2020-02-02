CREATE TABLE publishers (
    publisher_id              int PRIMARY KEY,
    publisher_name            varchar(40)             
);

CREATE TABLE boardgames (
    boardgame_id              int PRIMARY KEY,
    boardgame_name            varchar(40),
    boardgame_min_num_players int,
    boardgame_max_num_players int,
    boardgame_coop_or_comp    int,
    publisher_id              int REFERENCES publishers (publisher_id)
);

