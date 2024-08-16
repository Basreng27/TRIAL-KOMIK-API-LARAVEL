// Query
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE account (
    id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255)
);

CREATE TABLE genre (
    id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
    genre VARCHAR(50)
);

CREATE TABLE komik (
    id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
    nama VARCHAR(255),
    chapter INT,
    last_update TIMESTAMP,
    id_genre UUID REFERENCES genre(id)
);
