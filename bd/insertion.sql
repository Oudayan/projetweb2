INSERT INTO type_utilisateur VALUES(1, "Membre"),
(2, "Admin"),
(3, "Super Admin");

INSERT INTO membre VALUES (1, 3, "Hod", "David", "pacman_2018", "5922 St.Hubert", "514-3697777", "david.hod@gmail.com", 1, 1),
(2, 2, "Guzman", "Marcelo", "4651marcelo", "4651 Clark", "514-9630091", "killpuechess@hotmail.com", 1, 1),
(3, 2, "Tosin", "Guilherme", "mr.sirois", "711 Rue de Chevillon", "514-2328888", "guiherme.tosin@gmail.com", 1, 1),
(4, 1, "Peterson", "Oscar", "twoofthefew", "1786 Boulevard Manseau", "514-0201111", "peterson.oscar@gmail.com", 1, 1),
(5, 1, "Leclerc", "Noémie", "bagsGroove", "10220 Rue Laverdure","514-2313333", "noemie.leclerc@gmail.com", 1, 1),
(6, 1, "Leger", "Simon", "stablemates", "7599 Avenue de L'Épée", "514-4156666", "simon.leger@gmail.com", 1, 1),
(7, 1, "Demers", "Claudia", "time_for_rien", "1075 Rue de Bullion", "514-1234444", "claudia.demers@hotmail.com", 1, 1),
(8, 1, "Archer", "Bob", "pinkpanther", "4650 Avenue King-Edward", "514-8875564", "bob.archer@gmail.com", 1, 1),
(9, 1, "Rossi",  "Nicolas", "earlyModem", "5683 Pare", "514-4542211", "rossi.nicolas@hotmail.com", 1, 1),
(10, 1, "Melson", "Julien", "lazy_melody", "5930 rue Théverin", "514-2251516", "melson.julien@gmail.com", 1, 1);

INSERT INTO type_paiement VALUES (1, "Comptant"),
(2, "Chèque"),
(3, "Paypal");