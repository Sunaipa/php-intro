<h1>Liste des personnes</h1>

<div class="mb-4 mt-3">
	<h3><strong>Ajout d'une personne</strong></h3>
	<form method="POST" class="row p-4">
		<div class="mb-3 col">
			<label class="form-label"> Prénom </label>
			<input type="text" class="form-control" name="first_name" value="<?= $currentPerson->first_name ?>">
		</div>
		<div class="mb-3 col">
			<label class="form-label"> Nom </label>
			<input type="text" class="form-control" name="last_name" value="<?= $currentPerson->last_name ?>">
		</div>
		<input type="hidden" name="id" value="<?= $currentPerson->id ?>">

		<button class="btn btn-sm btn-success" name="submit">Ajout</button>
	</form>
</div>

<table class="table table-striped table-light table-bordered">
	<thead>
		<tr>
			<td>Prénom</td>
			<td>Nom</td>
			<td>Supprimer</td>
			<td>Modifier</td>

		</tr>
	</thead>
	<tbody>
		<?php foreach ($personList as $person) : ?>
			<tr>
				<td><?= $person->first_name ?></td>
				<td><?= $person->last_name ?></td>
				<td>
					<a href="<?= getLinkToRoute("pdo_persons", ["id" => $person->id, "action" => "delete"]) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Etes vous sur de vouloir supprimer cette personne ?')">Supprimer
					</a>
				</td>
				<td>
					<a href="<?= getLinkToRoute("pdo_persons", ["id" => $person->id, "action" => "update"]) ?>" class="btn btn-sm btn-primary">Modifier
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>