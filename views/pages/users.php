<div class="container text-center">
    <div class="row">
        <div class="col-10" style="text-align: left;">
            <h1>Users: </h1>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                    </tr> 
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <th scope="row"><?= $user->getId(); ?></th>
                            <th><?= $user->getName(); ?></th>
                            <th><?= $user->getSurname(); ?></th>
                        </tr> 
                    <?php endforeach; ?>
                </tbody>
            </table> 
        </div>
    </div>
</div>
