CREATE TYPE user_role AS ENUM ('Admin', 'Formateur', 'Etudiant');
CREATE TYPE niveau AS ENUM('IMITER', 'S_ADAPTER', 'TRANSPOSER');

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role user_role NOT NULL
);

CREATE TABLE classes (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    nombre INT NOT NULL,
    promo VARCHAR(100) NOT NULL,
    taux INT NOT NULL
);

CREATE TABLE sprints (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_debut DATE,
    date_fin DATE,
    classe_id INT REFERENCES classes(id) ON DELETE CASCADE
);

CREATE TABLE etudiants (
    user_id INT PRIMARY KEY REFERENCES users(id) ON DELETE CASCADE,
    username VARCHAR(50) UNIQUE,
    level VARCHAR(50),
    classe_id INT REFERENCES classes(id)
);

CREATE TABLE formateurs (
    user_id INT PRIMARY KEY REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE formateur_classe (
    formateur_id INT REFERENCES formateurs(user_id),
    classe_id INT REFERENCES classes(id),
    PRIMARY KEY (formateur_id, classe_id)
);

CREATE TABLE briefs (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(50), 
    sprint_id INT REFERENCES sprints(id) ON DELETE CASCADE,
    date_debut DATE,
    date_fin DATE,
);

CREATE TABLE rendu (
    id SERIAL PRIMARY KEY,
    text text,
    link VARCHAR(255),
    date_soumission TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE rendu_etudiant (
    etudiant_id INT REFERENCES etudiants(user_id) ON DELETE CASCADE,
    rendu_id INT REFERENCES rendu(id) ON DELETE CASCADE,
    brief_id INT REFERENCES briefs(id) ON DELETE CASCADE,
    PRIMARY KEY (etudiant_id, rendu_id)
);

CREATE TABLE competences (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE competence_brief (
    brief_id INT REFERENCES briefs(id) ON DELETE CASCADE,
    competence_id INT REFERENCES competences(id) ON DELETE CASCADE,
    PRIMARY KEY (brief_id, competence_id)
);

CREATE TABLE evaluations (
    id SERIAL PRIMARY KEY,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    commentaire TEXT,
    niveau_maitrise niveau NOT NULL,
    etudiant_id INT REFERENCES etudiants(user_id),
    formateur_id INT REFERENCES formateurs(user_id),
    brief_id INT REFERENCES briefs(id),
    competence_id INT REFERENCES competences(id)
);

--docker exec -it my_postgres psql -U postgres -d youcode_sprint