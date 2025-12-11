//cambiando nombre a tabla sesionesVirtuales

ALTER TABLE sesionesVirtuales RENAME TO sv;

ALTER TABLE registro RENAME TO usuarios;

ALTER TABLE sv ADD COLUMN link_video VARCHAR (255);


ALTER TABLE sv ADD FOREIGN KEY usuarioID_FK FOREIGN KEY (usuarioId) REFRERENCES usuarios(id);

//conviertiendo los id int a bigint
ALTER TABLE sv MODIFY COLUMN id BIGINT AUTO_INCREMENTAL NOT NULL;

//creando una tabla pivote sv_usuario

CREATE TABLE sv_usuario(
    id BIGINT PRIMARY KEY AUTO_INCREMENTAL,
    usuarioId BIGINT,
    svId BIGINT,
CONSTRAINT sv_id_FK FOREIGN KEY(svId) REFERENCES sv(id),
CONSTRAINT usuario_id_FK FOREIGN KEY (usuarioId) REFERENCES usuarios(id)
);

INSERT INTO sv_usuario(usuarioId, svId) VALUES (7,1);
DELETE FROM sv_usuario WHERE usuarioId=7;
