USE tienda_perifericos;

-- 1. USUARIOS (1 Admin, 2 Clientes)
-- ==========================================
INSERT INTO usuarios (nombre, password_hash, admin) VALUES 
-- Password original: admin123
('admin', '$2y$10$y9VuCjWpviT0g/mltnYZ9OYfiurKWGw4fG6KBGxhBTpKyc4beEKP6', 1),

-- Password original: test1234
('test-user-1', '$2y$10$AS2D5Ps/HpgXkBTiK7QU5.WhhsszoGLB3j9kXOGOvtQ3sWfeLc1za', 0),

-- Password original: test1234
('test-user-2', '$2y$10$AS2D5Ps/HpgXkBTiK7QU5.WhhsszoGLB3j9kXOGOvtQ3sWfeLc1za', 0);

-- ==========================================
-- 2. FABRICANTES
-- ==========================================
INSERT IGNORE INTO fabricante (id, nombre) VALUES 
(1, 'Logitech'),
(2, 'Razer'), 
(3, 'Artisan'), 
(4, 'Wooting'), 
(5, 'Lamzu'), 
(6, 'Zowie'), 
(7, 'Endgame Gear'),
(8, 'Cherry Xtrfy'),
(9, 'Pulsar'), 
(10, '8BitDo'), 
(11, 'Yuki Aim'),
(12, 'KANAMI');

-- ==========================================
-- 3. ESPECIFICACIONES DE PERIFÉRICOS
-- ==========================================

-- MOUSE (forma, sensor, peso)
INSERT INTO mouse (id, forma, sensor, peso) VALUES 
(1, 'Simétrica', 'HERO 2', '60g'),         -- Para el GPX 2
(2, 'Ergonómica', 'Focus Pro 30K', '63g'), -- Para el DAV3 Pro
(3, 'Simétrica', 'PAW3395', '49g'),        -- Para el Lamzu Atlantis
(4, 'Simétrica', 'PAW3395', '45g'),        -- Para el Lamzu Maya
(5, 'Simétrica', 'PAW3395', '55g'),        -- Para el Cherry M68
(6, 'Simétrica', 'PAW3395', '50g'),        -- Para el Endgame OP1 8K
(7, 'Ergonómica', 'HERO 25K', '63g'),      -- Para el prox3 (G Pro X)
(8, 'Ergonómica', 'PAW3395', '52g'),         -- Para Lamzu Thorn
(9, 'Simétrica', 'Focus Pro 35K', '54g'),    -- Para Viper V3 Pro
(10, 'Simétrica', 'PAW3395', '60g'),         -- Para Zowie S2-DW
(11, 'Simétrica', 'PAW3395', '60g'),         -- Para Zowie ZA13-DW
(12, 'Ergonómica', 'PAW3395', '54g'),        -- Para Pulsar Xlite V4
(13, 'Simétrica', 'PAW3395', '63g');         -- Para Endgame Gear XM2w

-- TECLADO (tamano, switches, rgb)
INSERT INTO teclado (id, tamano, switches, rgb) VALUES 
(1, '60%', 'Lekker Magnéticos', 'Sí'),     -- Para Wooting 60HE+
(2, 'Completo', 'Razer Green', 'Sí'),      -- Para BlackWidow V3
(3, 'Completo', 'GL Tactile', 'Sí'),       -- Para G915
(4, 'Completo', 'Mech-Membrane', 'Sí'),    -- Para Ornata
(5, 'Completo', 'Mech-Dome', 'Sí'),        -- Para G213
(6, 'Completo', 'Lekker Magnéticos', 'Sí'),  -- Para Wooting Two HE
(7, 'TKL', 'Kailh Box White', 'No');         -- Para 8BitDo Retro

-- MOUSEPAD (material, tamano, color)
INSERT INTO mousepad (id, material, tamano, color) VALUES 
(1, 'Tela Texturizada', 'XL', 'Vino/Negro'), -- Para Artisan Hien
(2, 'Tela Rápida', 'XL', 'Café/Negro'),      -- Para Artisan Raiden
(3, 'Tela Control', 'XL', 'Negro'),          -- Para Artisan Zero
(4, 'Tela Suave', 'L', 'Azul/Rojo'),         -- Para Zowie G-SR-SE
(5, 'Tela', 'XXL', 'Negro'),                 -- Para Logitech G840
(6, 'Tela Control', 'XL', 'Arte Samurai'),   -- Para Samurai
(7, 'Tela Rápida', 'XL', 'Arte Yuna'),       -- Para Yuna
(8, 'Tela', 'XL', 'Arte Sai');               -- Para SAI

-- ==========================================
-- 4. PRODUCTOS
-- idCat: 1=Mouse, 2=Teclado, 3=Mousepad
-- ==========================================
INSERT INTO productos (modelo, idObj, idFab, idCat, precio, unidades, img) VALUES 
-- Mouses (idCat = 1)
('Logitech G Pro X Superlight 2', 1, 1, 1, 2800.00, 15, 'gpx2w.webp'),
('Razer DeathAdder V3 Pro Faker', 2, 2, 1, 3200.00, 5, 'dav3pfaker.webp'),
('Lamzu Atlantis Mini', 3, 5, 1, 1900.00, 10, 'atlantismg.webp'),
('Lamzu Atlantis Mini 4K', 3, 5, 1, 2200.00, 8, 'atlantismini4kwb.webp'),
('Lamzu Maya X', 4, 5, 1, 2100.00, 12, 'mayaxb.webp'),
('Endgame Gear OP1 8K', 6, 7, 1, 1600.00, 20, 'op18k.webp'),
('Logitech G Pro X Superlight', 7, 1, 1, 2100.00, 4, 'prox3.png'),
('Lamzu Thorn White', 8, 5, 1, 2150.00, 10, 'thornw.webp'),
('Razer Viper V3 Pro Black', 9, 2, 1, 3100.00, 15, 'viperv3pb.webp'),
('Razer Viper V3 Pro White', 9, 2, 1, 3100.00, 12, 'viperv3pw.webp'),
('Zowie S2-DW Wireless', 10, 6, 1, 2800.00, 8, 's2dw.webp'),
('Zowie ZA13-DW Wireless', 11, 6, 1, 2800.00, 6, 'za13dw.webp'),
('Pulsar Xlite V4 Quiccs Edition', 12, 9, 1, 2400.00, 5, 'xlitev4vquiccs.webp'),
('Endgame Gear XM2w', 13, 7, 1, 2200.00, 14, 'xm2w.webp'),

-- Teclados (idCat = 2)
('Wooting 60HE+', 1, 4, 2, 3800.00, 3, '60HE+.webp'),
('Razer BlackWidow V3', 2, 2, 2, 2500.00, 9, 'BWV3.webp'),
('Logitech G915 Lightspeed', 3, 1, 2, 3500.00, 6, 'G915.webp'),
('Razer Ornata V3', 4, 2, 2, 1200.00, 14, 'Ornata.webp'),
('Logitech G213 Prodigy', 5, 1, 2, 900.00, 25, 'G213.webp'),
('Wooting Two HE', 6, 4, 2, 4200.00, 4, 'TwoHE.webp'),
('8BitDo Retro Mechanical C64', 7, 10, 2, 2100.00, 7, 'RetroMC64.webp'),
('8BitDo Retro Mechanical N Edition', 7, 10, 2, 2100.00, 9, 'RetroMN.webp'),
('Cherry Xtrfy M68 Pro', 5, 8, 2, 1850.00, 7, 'M68P.webp'),
('Cherry Xtrfy M68 Pro Ergo', 5, 8, 2, 1850.00, 6, 'M68Per.webp'),

-- Mousepads (idCat = 3)
('Artisan FX Hien Soft', 1, 3, 3, 1300.00, 11, 'FXHien.webp'),
('Artisan FX Raiden Mid', 2, 3, 3, 1350.00, 8, 'FXRaiden.webp'),
('Artisan FX Zero Soft', 3, 3, 3, 1400.00, 5, 'FXZeroO.webp'),
('Zowie G-SR-SE Rouge', 4, 6, 3, 850.00, 18, 'GSRSE.webp'),
('Logitech G840 XL', 5, 1, 3, 950.00, 22, 'G840.webp'),
('Yuki Aim Samurai', 6, 11, 3, 1100.00, 20, 'Samurai.webp'),
('KANAMI Yuna', 7, 12, 3, 950.00, 15, 'Yuna.webp'),
('KANAMI SAI', 8, 12, 3, 950.00, 18, 'SAI.webp');

-- ==========================================
-- 5. COMPRAS (Transacciones Ficticias)
-- ==========================================
INSERT INTO compras (idUsuario, idProducto, total, precio, unidades, fecha) VALUES 
-- Compra 1: El cliente 1 (ID 2) compra un GPX 2 y un G840
(2, 1, 2800.00, 2800.00, 1, '2026-10-01 10:30:00'),
(2, 19, 950.00, 950.00, 1, '2026-10-01 10:30:00'),

-- Compra 2: El cliente 2 (ID 3) compra un Wooting 60HE+ y un Artisan Zero
(3, 10, 3800.00, 3800.00, 1, '2026-10-02 15:45:00'),
(3, 17, 1400.00, 1400.00, 1, '2026-10-02 15:45:00'),

-- Compra 3: El cliente 1 (ID 2) compra dos Razer Ornata para la oficina
(2, 13, 2400.00, 1200.00, 2, '2026-10-03 09:15:00');

-- ==========================================
-- 5. DESCRIPCIONES DE LOS PRODUCTOS
-- ==========================================

-- MOUSES
UPDATE productos SET descripcion = 'El mouse para esports definitivo, ahora con switches híbridos LIGHTFORCE y sensor HERO 2.' WHERE modelo = 'Logitech G Pro X Superlight 2';
UPDATE productos SET descripcion = 'Edición especial del rey demonio Faker. Diseño ultra ligero y ergonómico con sensor Focus Pro 30K.' WHERE modelo = 'Razer DeathAdder V3 Pro Faker';
UPDATE productos SET descripcion = 'Un mouse ultra ligero con diseño simétrico pensado para agarre de garra (claw grip). Agilidad pura.' WHERE modelo = 'Lamzu Atlantis Mini';
UPDATE productos SET descripcion = 'La evolución del Atlantis Mini con tasa de sondeo de 4000Hz para una respuesta instantánea y máxima precisión.' WHERE modelo = 'Lamzu Atlantis Mini 4K';
UPDATE productos SET descripcion = 'Tamaño mediano-grande con recubrimiento premium y rendimiento inalámbrico de primer nivel en forma simétrica.' WHERE modelo = 'Lamzu Maya X';
UPDATE productos SET descripcion = 'Precisión alemana llevada al límite. Mouse alámbrico con 8000Hz y diseño refinado para máxima comodidad.' WHERE modelo = 'Endgame Gear OP1 8K';
UPDATE productos SET descripcion = 'El clásico e icónico mouse superligero que revolucionó los esports mundiales.' WHERE modelo = 'Logitech G Pro X Superlight';
UPDATE productos SET descripcion = 'Diseño ergonómico y ultra ligero de 52g, diseñado específicamente para brindar máxima comodidad y desempeño sin fatiga.' WHERE modelo = 'Lamzu Thorn White';
UPDATE productos SET descripcion = 'El arma preferida de los campeones. Diseño simétrico refinado, sensor Focus Pro de 35K y desempeño inalámbrico perfecto.' WHERE modelo = 'Razer Viper V3 Pro Black';
UPDATE productos SET descripcion = 'Edición en color blanco del aclamado Viper V3 Pro. Elegancia, 54 gramos de peso y rendimiento superior.' WHERE modelo = 'Razer Viper V3 Pro White';
UPDATE productos SET descripcion = 'El legendario shape S2 ahora en formato inalámbrico. Construcción robusta y seguimiento perfecto para esports.' WHERE modelo = 'Zowie S2-DW Wireless';
UPDATE productos SET descripcion = 'Forma enfocada en dar soporte a la palma para agarre de garra puro, ahora libre de cables.' WHERE modelo = 'Zowie ZA13-DW Wireless';
UPDATE productos SET descripcion = 'Edición limitada Quiccs del Xlite V4. Ergonomía superior y arte urbano espectacular.' WHERE modelo = 'Pulsar Xlite V4 Quiccs Edition';
UPDATE productos SET descripcion = 'La esperada versión inalámbrica del mítico XM1. Forma de culto para claw grip con tecnología impecable.' WHERE modelo = 'Endgame Gear XM2w';

-- TECLADOS
UPDATE productos SET descripcion = 'El teclado más rápido del mundo. Formato 60% con switches magnéticos Lekker y actuación ajustable (Rapid Trigger).' WHERE modelo = 'Wooting 60HE+';
UPDATE productos SET descripcion = 'Teclado mecánico completo con los clásicos switches verdes de Razer, clic táctil y sonoro con RGB Chroma.' WHERE modelo = 'Razer BlackWidow V3';
UPDATE productos SET descripcion = 'Teclado mecánico inalámbrico de bajo perfil. Materiales premium, switches táctiles y diseño ultra delgado.' WHERE modelo = 'Logitech G915 Lightspeed';
UPDATE productos SET descripcion = 'Teclado de perfil bajo con switches meca-membrana, ofreciendo el clic mecánico con el toque suave de la membrana.' WHERE modelo = 'Razer Ornata V3';
UPDATE productos SET descripcion = 'Teclado para juegos resistente a salpicaduras con teclas Mech-Dome, reposamanos integrado y RGB LIGHTSYNC.' WHERE modelo = 'Logitech G213 Prodigy';
UPDATE productos SET descripcion = 'Toda la tecnología magnética y Rapid Trigger del 60HE en un formato de teclado completo.' WHERE modelo = 'Wooting Two HE';
UPDATE productos SET descripcion = 'Nostalgia pura inspirada en la Commodore 64, con switches mecánicos clicky y super botones programables gigantes.' WHERE modelo = '8BitDo Retro Mechanical C64';
UPDATE productos SET descripcion = 'Diseño clásico inspirado en la mítica consola NES. Formato TKL, con pad direccional y de botones estilo árcade extraíbles.' WHERE modelo = '8BitDo Retro Mechanical N Edition';
UPDATE productos SET descripcion = 'Teclado mecánico inalámbrico de bajo perfil. Materiales premium, switches táctiles y diseño ultra delgado.' WHERE modelo = 'Cherry Xtrfy M68 Pro';
UPDATE productos SET descripcion = 'Teclado mecánico inalámbrico de bajo perfil. Materiales premium, switches táctiles y diseño ultra delgado.' WHERE modelo = 'Cherry Xtrfy M68 Pro Ergo';

-- MOUSEPADS
UPDATE productos SET descripcion = 'El rey de la durabilidad y el deslizamiento texturizado. Superficie híbrida con una mezcla perfecta de velocidad y frenado.' WHERE modelo = 'Artisan FX Hien Soft';
UPDATE productos SET descripcion = 'Superficie de tela ultra lisa. Deslizamiento rapidísimo y suave, ideal para tracking sin fricción.' WHERE modelo = 'Artisan FX Raiden Mid';
UPDATE productos SET descripcion = 'El estándar de oro para el control. Tejido de alta calidad para precisión sin sacrificar la agilidad inicial.' WHERE modelo = 'Artisan FX Zero Soft';
UPDATE productos SET descripcion = 'Mousepad de tela eSports por excelencia. Deslizamiento suave, constante e ideal para juegos tácticos como Valorant o CS:GO.' WHERE modelo = 'Zowie G-SR-SE Rouge';
UPDATE productos SET descripcion = 'Superficie de escritorio completo para máxima libertad de movimiento, grosor ideal para nivelar la mesa.' WHERE modelo = 'Logitech G840 XL';
UPDATE productos SET descripcion = 'Mousepad de tela de edición limitada con arte espectacular y superficie orientada a la velocidad y el tracking continuo.' WHERE modelo = 'Yuki Aim Samurai';
UPDATE productos SET descripcion = 'Superficie de control refinado con una estética asombrosa, ideal para frenadas precisas.' WHERE modelo = 'Padsmith Yuna';
UPDATE productos SET descripcion = 'Mousepad de alto rendimiento con balance perfecto entre velocidad y control y gráficos únicos de alta calidad.' WHERE modelo = 'Padsmith SAI';