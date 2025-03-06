<?php
include $_SERVER['DOCUMENT_ROOT'] . '/tasks/database/connection.php';

if (isset($_POST['add'])) {
    if ($_POST['title'] != "" && $_POST['description'] != "") {
        $title = mysqli_real_escape_string($mysqli, $_POST['title']);
        $date = mysqli_real_escape_string($mysqli, $_POST['date']);
        $time = mysqli_real_escape_string($mysqli, $_POST['time']);
        $selectOption = mysqli_real_escape_string($mysqli, $_POST['select-option']);
        $chooseFile = 'choose-file'; // Nome do campo do arquivo no formulário
        $image = $_FILES[$chooseFile];
        
        if ($image['error'] == 0): // Verifica se o arquivo foi enviado corretamente
            $nomeFinal = time() . '.jpg'; // Define o nome final do arquivo

            // Tenta gravar o arquivo no servidor temporariamente
            if (move_uploaded_file($image['tmp_name'], $nomeFinal)):

                // Pega o conteúdo binário da imagem
                $tamanhoImg = filesize($nomeFinal);
                $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));

                // Apaga o arquivo após ler o conteúdo
                unlink($nomeFinal);

                $description = mysqli_real_escape_string($mysqli, $_POST['description']);
                $optional = mysqli_real_escape_string($mysqli, $_POST['optional']);

                // Insere os dados no banco de dados
                $query = "INSERT INTO list(
                    title, 
                    time_shopping, 
                    date_shopping, 
                    descriptions, 
                    image_product, 
                    option_size, 
                    optional, 
                    fk_id_user) 
                VALUES (
                    '{$title}', 
                    '{$time}', 
                    '{$date}', 
                    '{$description}', 
                    '{$mysqlImg}', 
                    '{$selectOption}', 
                    '{$optional}', 
                    '{$_SESSION['userData']['id_user']}'
                )";

                if ($mysqli->query($query)) {
                    header('Location: ./');
                } else {
                    echo "Erro ao inserir no banco de dados.";
                }
            else:
                echo "Erro ao mover o arquivo para o servidor.";
            endif;
        else:
            echo "Você não fez o upload da imagem corretamente.";
        endif;
    }
}
?>
