<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tasks/database/connection.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/language.php' ?>

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/header.php' ?>
    <title>Home</title>
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/tasks/includes/navbar.php' ?>
    <section class="w-100 p-3" style="height: calc(100vh - 100px);">
        <div style="padding-bottom: 5vh;">Bem vindo(a), 
            <?php 
                $name = explode(" ",  $_SESSION['userData']['nome'] );
                print_r("<strong>".$name[0]." ". $name[1]."</strong>"); 
            ?>.
        </div>
        <div class="row d-flex justify-content-start d-flex flex-sm-wrap p-2">
            <?php
            $query = $mysqli->query("SELECT * FROM `list` WHERE fk_id_user = {$_SESSION['userData']['id_user']}");
            $count = 1;
            while ($fetch = $query->fetch_array()) {
                ?>
                <div
                    class="col-12 col-xxl-12 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12  d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <?php
                        if (!empty($fetch['image_product'])) {
                            $imageData = base64_encode($fetch['image_product']);
                            echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="imagem produto" class="rounded card-img-top" style="height: 35vh;">';
                        } else {
                            echo '<img src="public/images/bag.png" alt="imagem produto" class="rounded card-img-top">';
                        }
                        ?>
                        <div class="card-body"
                            style="height: 15vh;">
                            <h6 class="card-title" style="overflow: hidden; text-overflow: clip ellipsis; white-space: nowrap;"><?php echo $fetch['descriptions'] ?></h6>
                            <p class="card-text"><?php echo $fetch['descriptions'] ?></p>
                        </div>
                        <ul class="card-body w-100 d-flex align-items-center" style="height:20vh;">
                            <li class="list-group-item text-center w-100">
                                <h6>Horário </h6>
                                <p><?php echo $fetch['time_shopping'] ?></p>
                            </li>
                            <li class="list-group-item text-center w-100">
                                <h6>Data </h6>
                                <p><?php echo $fetch['date_shopping'] ?></p>
                            </li>
                            <li class=" list-group-item text-center w-100">
                                <h6>Tamanho</h6>
                                <p><?php echo $fetch['option_size'] ?></p>
                            </li>
                        </ul>
                        <div class=" d-flex p-3 gap-3">
                            <?php
                            if ($fetch['status'] != "Done") {
                                echo
                                    '<a href="app/view/update.php?task_id=' . $fetch['id_list'] . '" class="btn btn-success w-100"><span class="glyphicon glyphicon-check">✔</span></a>';
                            }
                            ?>
                            <a href="app/view/delete.php?task_id=<?php echo $fetch['id_list'] ?>"
                                class="btn btn-danger w-100">
                                <span class="glyphicon glyphicon-remove">❌</span>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
        <button type="button" class="btn btn-primary rounded-circle fw-bold position-fixed bottom-0 end-0 m-3"
            style="height: 50px; width: 50px;" data-bs-toggle="modal" data-bs-target="#exampleModal"
            data-bs-whatever="@mdo">+</button>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php?p=add" method="POST" class="container" enctype="multipart/form-data">
                        <div class="form-group d-grid gap-2">
                            <label for="">Título</label>
                            <input type="text" name="title" pattern="^[a-zA-Z0-9]+$"
                                title="Apenas letras e números são permitidos"
                                class="form-control border border-2 border-dark" required>
                        </div>
                        <div class="form-group d-grid gap-2">
                            <label for="">Hora</label>
                            <input type="time" name="time" class="form-control border border-2 border-dark">
                        </div>
                        <div class="form-group d-grid gap-2">
                            <label for="">Data</label>
                            <input type="date" name="date" class="form-control border border-2 border-dark">
                        </div>
                        <div class="form-group d-grid gap-2">
                            <label for=""></label>
                            <select class="form-select d-grid gap-2 border border-2 border-dark" name="select-option">
                                <option selected>Selecione uma opção</option>
                                <option value="Pequeno">Pequeno</option>
                                <option value="Médio">Médio</option>
                                <option value="Grande">Grande</option>
                                <option value="Extra Grande">Extra Grande</option>
                            </select>
                        </div>
                        <div class="form-group d-grid gap-2 mb-3 py-3">
                            <input name="choose-file" class="form-control form-control-sm border border-2 border-dark"
                                id="formFileSm" accept="image/png, image/jpeg" type="file">
                        </div>
                        <div class="form-group d-grid gap-2 mb-3">
                            <label for="exampleFormControlTextarea1" pattern="^[a-zA-Z0-9]+$"
                                title="Apenas letras e números são permitidos" class="form-label">Descrição</label>
                            <textarea name="description" class="form-control border border-2 border-dark"
                                id="exampleFormControlTextarea1" style="resize:none;"
                                placeholder="Maximo de 10 palavras" maxlength="60" rows="5" value="0"
                                required></textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input border border-2 border-dark" name="optional" type="checkbox"
                                id="flexCheckDisabled">
                            <label class="form-check-label" for="flexCheckDisabled">
                                Item opcional?
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" name="add" class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>