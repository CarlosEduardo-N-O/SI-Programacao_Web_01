<?php
session_start();
include "../config.php";

// Verifica se a sessão possui os valores necessários
if (!isset($_SESSION['id_dispositivo']) || !isset($_SESSION['id_setor']) || !isset($_SESSION['id_avaliacao'])) {
    header("Location: resposta_dispositivo.php");
    exit();
}

$id_dispositivo = $_SESSION['id_dispositivo'];
$id_setor = $_SESSION['id_setor'];
$id_avaliacao = $_SESSION['id_avaliacao'];

$stmt = $pdo->prepare("SELECT id_pergunta, pergunta, ordem FROM pergunta WHERE id_setor = ? AND status = true ORDER BY ordem ASC");
$stmt->execute([$id_setor]);
$perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_SESSION['indice_pergunta'])) {
    $_SESSION['indice_pergunta'] = 0;
}

$total_perguntas = count($perguntas);

if (isset($_POST['acao'])) {
    $indice_atual = $_SESSION['indice_pergunta'];
    $id_pergunta_atual = $perguntas[$indice_atual]['id_pergunta'];
    $resposta = isset($_POST['resposta']) ? $_POST['resposta'] : null;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';

    if ($resposta !== null) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM resposta WHERE id_avaliacao = ? AND id_pergunta = ? AND id_dispositivo = ?");
        $stmt->execute([$id_avaliacao, $id_pergunta_atual, $id_dispositivo]);
        $existe = $stmt->fetchColumn();

        if ($existe > 0) {
            $stmt = $pdo->prepare("UPDATE resposta SET resposta = ?, descricao = ? WHERE id_avaliacao = ? AND id_pergunta = ? AND id_dispositivo = ?");
            $stmt->execute([$resposta, $descricao, $id_avaliacao, $id_pergunta_atual, $id_dispositivo]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO resposta (id_avaliacao, id_pergunta, id_dispositivo, id_setor, resposta, descricao) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$id_avaliacao, $id_pergunta_atual, $id_dispositivo, $id_setor, $resposta, $descricao]);
        }
    }

    if ($_POST['acao'] == 'proximo' && $_SESSION['indice_pergunta'] < $total_perguntas - 1) {
        $_SESSION['indice_pergunta']++;
    } elseif ($_POST['acao'] == 'anterior' && $_SESSION['indice_pergunta'] > 0) {
        $_SESSION['indice_pergunta']--;
    } elseif ($_POST['acao'] == 'enviar') {
        header("Location: resposta_salva.php");
        exit();
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$indice_atual = $_SESSION['indice_pergunta'];
$pergunta_atual = $perguntas[$indice_atual];

// Recupera a resposta salva, se houver
$stmt = $pdo->prepare("SELECT resposta, descricao FROM resposta WHERE id_avaliacao = ? AND id_pergunta = ? AND id_dispositivo = ?");
$stmt->execute([$id_avaliacao, $pergunta_atual['id_pergunta'], $id_dispositivo]);
$resposta_salva = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/img/logo.png" type="image/x-icon">
    <title>Adicionar Resposta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            /* 100% da altura da viewport */
            display: flex;
            justify-content: center;
            /* Centraliza horizontalmente */
            align-items: center;
            /* Centraliza verticalmente */
            margin: 0;
            /* Remove margens padrão */
        }

        .container {
            max-width: 100%;
            /* Ocupar quase 100% da largura da tela */
            margin: auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: relative;
            /* Para o posicionamento do botão "Voltar" */
        }

        label {
            font-size: 2rem;
            /* Aumenta o tamanho da fonte da pergunta */
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            /* Faz o label se comportar como um flex container */
            justify-content: center;
            /* Centraliza o conteúdo dentro do label */
        }


        .radio-group {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            /* Para alinhar os números na parte inferior */
            margin-bottom: 20px;
        }

        .radio-group input {
            display: none;
            /* Esconde os botões de rádio padrão */
        }

        .radio-group label {
            flex: 1;
            margin: 0 5px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            /* Aumenta o tamanho da fonte */
        }

        /* Cores dos botões */
        #resposta0+label {
            background-color: #ff0000;
        }

        /* Vermelho */
        #resposta1+label {
            background-color: #ff4d00;
        }

        /* Laranja */
        #resposta2+label {
            background-color: #ff8000;
        }

        /* Laranja claro */
        #resposta3+label {
            background-color: #ffcc00;
        }

        /* Amarelo */
        #resposta4+label {
            background-color: #ccff00;
        }

        /* Amarelo claro */
        #resposta5+label {
            background-color: #99ff00;
        }

        /* Verde claro */
        #resposta6+label {
            background-color: #66ff00;
        }

        /* Verde claro */
        #resposta7+label {
            background-color: #33cc00;
        }

        /* Verde médio */
        #resposta8+label {
            background-color: #00cc00;
        }

        /* Verde médio */
        #resposta9+label {
            background-color: #00b300;
        }

        /* Verde escuro */
        #resposta10+label {
            background-color: #009900;
        }

        /* Efeito ao selecionar */
        input:checked+label {
            opacity: 1;
            /* Remove a opacidade para o botão selecionado */
            filter: brightness(0.75);
            font-weight: bold;
            /* Torna o texto em negrito para destaque */
        }

        .btn-container {
            display: flex;
            margin-top: 20px;
            /* Espaçamento superior */
        }

        .btn-proximo-enviar {
            flex: 1;
            text-align: center;
        }

        .btn-proximo {
            width: 200px;
            /* Ajuste o tamanho conforme necessário */
            font-size: 1.2rem;
            /* Aumenta o tamanho da fonte */
        }

        .voltar-container {
            position: absolute;
            /* Permite posicionar o botão "Voltar" na parte inferior esquerda */
            bottom: 20px;
            /* Distância do fundo */
            left: 20px;
            /* Distância da esquerda */
        }
        </style>
</head>

<body>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label><?php echo htmlspecialchars($pergunta_atual['pergunta']); ?></label>
                <div class="radio-group">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <input type="radio" id="resposta<?php echo $i; ?>" name="resposta" value="<?php echo $i; ?>"
                            <?php echo (isset($resposta_salva['resposta']) && $resposta_salva['resposta'] == $i) ? 'checked' : ''; ?> required>
                        <label for="resposta<?php echo $i; ?>"><?php echo $i; ?></label>
                    <?php endfor; ?>
                </div>
                <textarea class="form-control mt-2" name="descricao" placeholder="Descrição (opcional)"><?php echo isset($resposta_salva['descricao']) ? htmlspecialchars($resposta_salva['descricao']) : ''; ?></textarea>
            </div>
            <div class="btn-container">
                <div class="btn-anterior">
                    <?php if ($indice_atual == 0): ?>
                        <button type="submit" name="acao" value="anterior" class="btn btn-secondary" disabled>Anterior</button>
                    <?php else: ?>
                        <button type="submit" name="acao" value="anterior" class="btn btn-secondary">Anterior</button>
                    <?php endif; ?>
                </div>
                <div class="btn-proximo-enviar">
                    <?php if ($indice_atual == $total_perguntas - 1): ?>
                        <button type="submit" name="acao" value="enviar" class="btn btn-success ml-2">Enviar Pesquisa</button>
                    <?php else: ?>
                        <button type="submit" name="acao" value="proximo" class="btn btn-primary btn-proximo ml-2">Próximo</button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
    <div class="voltar-container">
        <a href="resposta_espera.php" class="btn btn-secondary">Voltar</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>