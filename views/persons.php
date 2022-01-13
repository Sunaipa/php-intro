<table class="table table-striped table-light table-bordered">
    <thead>
        <tr>
            <td>Prénom</td>
            <td>Nom</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($personList as $person): ?>
            <tr>
                <td><?= $person->first_name ?></td>
                <td><?= $person->last_name ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> 