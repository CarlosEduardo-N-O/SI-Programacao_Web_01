BEGIN;

ALTER TABLE IF EXISTS public.dispositivo
DROP CONSTRAINT IF EXISTS setor_dispositivo_fk;

ALTER TABLE IF EXISTS public.pergunta
DROP CONSTRAINT IF EXISTS setor_pergunta_fk;

ALTER TABLE IF EXISTS public.resposta
DROP CONSTRAINT IF EXISTS dispositivo_resposta_fk;

ALTER TABLE IF EXISTS public.resposta
DROP CONSTRAINT IF EXISTS fk_resposta_avaliacao;

ALTER TABLE IF EXISTS public.resposta
DROP CONSTRAINT IF EXISTS pergunta_resposta_fk;

DROP TABLE IF EXISTS public.avaliacao;

CREATE TABLE IF NOT EXISTS public.avaliacao (
    id_avaliacao serial NOT NULL,
    id_setor integer NOT NULL,
    inclusao timestamp without time zone NOT NULL,
    id_dispositivo integer,
    CONSTRAINT pk_avaliacao PRIMARY KEY (id_avaliacao)
);

DROP TABLE IF EXISTS public.dispositivo;

CREATE TABLE IF NOT EXISTS public.dispositivo
(
    id_dispositivo serial NOT NULL,
    id_setor integer NOT NULL,
    nome character varying(255) COLLATE pg_catalog."default" NOT NULL,
    status boolean NOT NULL,
    CONSTRAINT dispositivo_pkey PRIMARY KEY (id_dispositivo)
);

DROP TABLE IF EXISTS public.pergunta;

CREATE TABLE IF NOT EXISTS public.pergunta
(
    id_pergunta serial NOT NULL,
    id_setor integer NOT NULL,
    pergunta character varying(255) COLLATE pg_catalog."default" NOT NULL,
    status boolean NOT NULL,
    ordem integer,
    CONSTRAINT pergunta_pkey PRIMARY KEY (id_pergunta)
);

DROP TABLE IF EXISTS public.resposta;

CREATE TABLE IF NOT EXISTS public.resposta
(
    id_resposta serial NOT NULL,
    id_pergunta integer NOT NULL,
    id_avaliacao integer NOT NULL,
    id_dispositivo integer NOT NULL,
    id_setor integer NOT NULL,
    resposta integer NOT NULL,
    descricao character varying(255) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT resposta_pkey PRIMARY KEY (id_resposta)
);

DROP TABLE IF EXISTS public.setor;

CREATE TABLE IF NOT EXISTS public.setor
(
    id_setor serial NOT NULL,
    nome character varying(255) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT setor_pkey PRIMARY KEY (id_setor)
);

DROP TABLE IF EXISTS public.usuario;

CREATE TABLE IF NOT EXISTS public.usuario
(
    id_usuario serial NOT NULL,
    usuario character varying(255) COLLATE pg_catalog."default" NOT NULL,
    senha character varying(255) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario)
);

ALTER TABLE IF EXISTS public.dispositivo
ADD CONSTRAINT setor_dispositivo_fk FOREIGN KEY (id_setor) REFERENCES public.setor (id_setor) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE IF EXISTS public.pergunta
ADD CONSTRAINT setor_pergunta_fk FOREIGN KEY (id_setor) REFERENCES public.setor (id_setor) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE IF EXISTS public.resposta
ADD CONSTRAINT dispositivo_resposta_fk FOREIGN KEY (id_dispositivo) REFERENCES public.dispositivo (id_dispositivo) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE IF EXISTS public.resposta
ADD CONSTRAINT fk_resposta_avaliacao FOREIGN KEY (id_avaliacao) REFERENCES public.avaliacao (id_avaliacao) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE CASCADE;

ALTER TABLE IF EXISTS public.resposta
ADD CONSTRAINT pergunta_resposta_fk FOREIGN KEY (id_pergunta) REFERENCES public.pergunta (id_pergunta) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION;

END;