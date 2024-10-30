CREATE DATABASE IF NOT EXISTS avaliapro;
\c avaliapro;  -- Conecta ao banco de dados avaliapro
-- Criação das sequências
CREATE SEQUENCE public.usuario_id_usuario_seq;
CREATE SEQUENCE public.setor_id_setor_seq;
CREATE SEQUENCE public.dispositivo_id_dispositivo_seq_1;
CREATE SEQUENCE public.avaliacao_id_avaliacao_seq;
CREATE SEQUENCE public.pergunta_id_pergunta_seq;
CREATE SEQUENCE public.resposta_id_resposta_seq;

-- Tabela de Usuários
CREATE TABLE public.usuario (
    id_usuario INTEGER NOT NULL DEFAULT nextval('public.usuario_id_usuario_seq'),
    usuario VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo_usuario VARCHAR(50) CHECK (tipo_usuario IN ('administrador', 'respondente')), -- Exemplo de restrição de tipo
    PRIMARY KEY (id_usuario)  -- Alterado para chave primária simples
);

ALTER SEQUENCE public.usuario_id_usuario_seq OWNED BY public.usuario.id_usuario;

-- Tabela de Setores
CREATE TABLE public.setor (
    id_setor INTEGER NOT NULL DEFAULT nextval('public.setor_id_setor_seq'),
    nome VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_setor)
);

ALTER SEQUENCE public.setor_id_setor_seq OWNED BY public.setor.id_setor;

-- Tabela de Dispositivos
CREATE TABLE public.dispositivo (
    id_dispositivo INTEGER NOT NULL DEFAULT nextval('public.dispositivo_id_dispositivo_seq_1'),
    id_setor INTEGER NOT NULL,
    nome VARCHAR(255) NOT NULL,
    status BOOLEAN NOT NULL,
    PRIMARY KEY (id_dispositivo)
);

ALTER SEQUENCE public.dispositivo_id_dispositivo_seq_1 OWNED BY public.dispositivo.id_dispositivo;

-- Tabela de Avaliações
CREATE TABLE public.avaliacao (
    id_avaliacao INTEGER NOT NULL DEFAULT nextval('public.avaliacao_id_avaliacao_seq'),
    id_setor INTEGER NOT NULL,
    inclusao TIMESTAMP NOT NULL,
    PRIMARY KEY (id_avaliacao)
);

ALTER SEQUENCE public.avaliacao_id_avaliacao_seq OWNED BY public.avaliacao.id_avaliacao;

-- Tabela de Perguntas
CREATE TABLE public.pergunta (
    id_pergunta INTEGER NOT NULL DEFAULT nextval('public.pergunta_id_pergunta_seq'),
    id_setor INTEGER NOT NULL,
    pergunta VARCHAR(255) NOT NULL,
    status BOOLEAN NOT NULL,
    PRIMARY KEY (id_pergunta)
);

ALTER SEQUENCE public.pergunta_id_pergunta_seq OWNED BY public.pergunta.id_pergunta;

-- Tabela de Respostas
CREATE TABLE public.resposta (
    id_resposta INTEGER NOT NULL DEFAULT nextval('public.resposta_id_resposta_seq'),
    id_pergunta INTEGER NOT NULL,
    id_avaliacao INTEGER NOT NULL,
    id_dispositivo INTEGER NOT NULL,
    id_setor INTEGER NOT NULL,
    resposta INTEGER NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_resposta)
);

ALTER SEQUENCE public.resposta_id_resposta_seq OWNED BY public.resposta.id_resposta;

-- Chaves Estrangeiras
ALTER TABLE public.pergunta ADD CONSTRAINT setor_pergunta_fk
FOREIGN KEY (id_setor)
REFERENCES public.setor (id_setor)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE public.avaliacao ADD CONSTRAINT setor_avaliacao_fk
FOREIGN KEY (id_setor)
REFERENCES public.setor (id_setor)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE public.dispositivo ADD CONSTRAINT setor_dispositivo_fk
FOREIGN KEY (id_setor)
REFERENCES public.setor (id_setor)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE public.resposta ADD CONSTRAINT dispositivo_resposta_fk
FOREIGN KEY (id_dispositivo)
REFERENCES public.dispositivo (id_dispositivo)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE public.resposta ADD CONSTRAINT avaliacao_resposta_fk
FOREIGN KEY (id_avaliacao)
REFERENCES public.avaliacao (id_avaliacao)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE public.resposta ADD CONSTRAINT pergunta_resposta_fk
FOREIGN KEY (id_pergunta)
REFERENCES public.pergunta (id_pergunta)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


