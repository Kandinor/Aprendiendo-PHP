DROP TABLE IF EXISTS `auth_tokens`;
DROP TABLE IF EXISTS `usuarios`;


CREATE TABLE `usuarios` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `email`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Todas las contraseñas son 1234

INSERT INTO usuarios (email) VALUES (
  'guru@dwes.es'
);

CREATE TABLE `auth_tokens` (
    `id`                MEDIUMINT NOT NULL AUTO_INCREMENT,
    `token`             char(33),
    `id_user_generador` MEDIUMINT not null,
    `id_user_consumido` MEDIUMINT,
    `consumido`         int default 0,
    CONSTRAINT fk_id_user_gen FOREIGN KEY (id_user_generador) REFERENCES usuarios(id),
    CONSTRAINT fk_id_user_con FOREIGN KEY (id_user_consumido) REFERENCES usuarios(id),
    PRIMARY KEY (`id`)
);

INSERT INTO auth_tokens (token, id_user_generador) VALUES (
  'qwert', 1
);

-- Usuario ya registrado. Tendrá id 2

INSERT INTO usuarios (email) VALUES (
  'jorge@dwes.es'
);

-- Token en estado de consumido
INSERT INTO auth_tokens (token, id_user_generador, id_user_consumido, consumido) VALUES (
  'asdfg', 1, 2, 1
);

