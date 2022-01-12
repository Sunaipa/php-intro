<form method="POST">
    <div>
        <label class="form-label">Compétence</label>
        <input type="text" name="skill"  class="form-control">
    </div>
    <div>
        <button type="submit" name="submit">Go</button>
    </div>
</form>
<ul>
    <?php foreach($skills as $item): ?>
        <li><?= $item['label'] ?></li>
    <?php endforeach; ?>
</ul>

<!-- 
<ul>
    <?php foreach($skillsObj as $item): ?>
        <li><?= $item->label ?></li>
    <?php endforeach; ?>
</ul> 
-->