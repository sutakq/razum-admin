<script src="assets/js/validation.js" defer></script>
<?php
$user = $database->query("SELECT *, roles.name AS Role_Name, users.name AS User_Name FROM `users` JOIN `roles` ON users.role = roles.id WHERE users.id = " . $_GET['id'])->fetch(2);

// $Purchased = $database->query("SELECT * FROM `Purchased` JOIN `courses` ON Purchased.courseId = courses.id WHERE `userId` = " . $_GET['id'])->fetchAll(2);
$Purchased = $database->query("SELECT * FROM `Purchased` JOIN `courses` ON Purchased.courseId = courses.id WHERE `userId` = " . $_GET['id'])->fetchAll(2);

// $Purchased = $database->query("SELECT * FROM `Purchased` LEFT JOIN `courses` ON Purchased.courseId = courses.id WHERE `userId` = " . $_GET['id'])->fetchAll(2);

if (!isRole()) {
    die();
}
?>
<div class="container">

    <div class="admin-user-profile">
        <p>Пользователи /
            <?= $user['surname'] ?>
            <?= $user['User_Name'] ?>
        </p>
        <div class="admin-user-profile-info">
            <div class="admin-user-profile-about">
                <div class="admin-user-prodile-img">
                    <img src="<?= $user['image'] ?>" alt="">
                    <div class="admin-user-name">
                        <p>
                            <?= $user['surname'] ?>
                            <?= $user['User_Name'] ?>
                        </p>
                        <span class="gray">
                            <?= $user['Role_Name'] ?>
                        </span>
                    </div>
                </div>
                <div class="admin-user-info">
                    <h4>Информация</h4>
                    <p>Номер телефона: <span>
                            <?= $user['phone'] ?>
                        </span></p>
                    <p>Дата регистрации: <span>
                            <?= $user['date_create'] ?>
                        </span></p>
                    <p>ID: <span>
                            <?= $user['id'] ?>
                        </span></p>
                    <p id="openRole" class="go-to">Добавить роль</p>
                </div>
            </div>

            <div class="admin-user-profile-right">
                <div class="financ">
                    <h4>Финансовые операции</h4>
                    <div class="financ-header">
                        <p>Стоимость</p>
                        <p>Дата и время</p>
                        <p>Название курса</p>
                    </div>

                    <?php foreach ($Purchased as $item): ?>
                        <div class="financ-grid">
                            <span>
                                <?= $item['price'] ?> ₽
                            </span>
                            <p>
                                <?= $item['date_buy'] ?>
                            </p>
                            <div class="nameofcourse">
                                <div class="num-admin">
                                    <?= $item['id'] ?>
                                </div>
                                <p>
                                    <?= $item['name'] ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>



                <div class="admin-user-profile-courses">
                    <p>Активные курсы</p>
                    <div class="admin-user-profile-courses-items">
                        <div class="admin-user-profile-courses-name">
                            <div class="admin-user-profile-courses-left">
                                <p class="num-courses">32</p>
                                <span>Лечение ОКР</span>
                            </div>
                            <img src="assets/images/admin-icons/XSquare.png" alt="">
                        </div>
                        <div class="flex-column">
                            <p>Прогресс по курсу</p>
                            <a href="">Сертификат <img src="assets/images/admin-icons/courses.svg" alt=""></a>
                            <div class="progress-bar">
                                <div class="section green-bar">

                                </div>
                                <div class="section green-bar">

                                </div>
                                <div class="section red-bar">

                                </div>
                                <div class="section yellow-bar">

                                </div>
                            </div>
                        </div>



                        <div class="admin-user-profile-courses-name">
                            <div class="admin-user-profile-courses-left">
                                <p class="num-courses">20</p>
                                <span>Воспитание ребенка с РАС</span>
                            </div>
                            <img src="assets/images/admin-icons/XSquare.png" alt="">
                        </div>
                        <div class="flex-column">
                            <p>Прогресс по курсу</p>
                            <a href="">Сертификат <img src="assets/images/admin-icons/courses.svg" alt=""></a>
                            <div class="progress-bar">
                                <div class="section green-bar">

                                </div>
                                <div class="section gray-bar">

                                </div>
                                <div class="section gray-bar">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal" class="modalRole hidden">
        <form id="modalRole" method="POST" action="">
            <?php 
            $roles = $database->query("SELECT * FROM `roles`")->fetchAll(2);
            ?>
            <input type="hidden" value="<?= $_GET['id'] ?>" name="userid">
            <select name="newRole" id="">
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['id'] ?>">
                        <?= $role['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Выдать">
            <p id="close" class="close">X</p>
        </form>
    </div>
</div>
</div>

<script> 

let openRole =document.getElementById('openRole');
let close =document.getElementById('close');
openRole.addEventListener('click', function(){
    let modal =document.getElementById('modal');
    modal.classList.toggle('hidden');
})
close.addEventListener('click', function(){
    let modal =document.getElementById('modal');
    modal.classList.toggle('hidden');
})

</script>