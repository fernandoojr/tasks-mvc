<?php
/** @var Task $task */
use Project\Tasks\Entity\Task;
?>
<form method="post">
    <h2>Envie uma tarefa!</h2>
    <div>
        <label>Data da tarefa (dd/mm/aaaa)</label>
        <input name="date" value="<?=$task?->getDate()?>" required placeholder="Por exemplo: 25/07/2000" id='date' />
    </div>

    <div>
        <label>Descrição</label>
        <input name="description" value="<?=$task?->getDescription()?>" required placeholder="Neste campo, dê uma breve descrição sobre a tarefa" id='description' />
    </div>
    <input class="formulario__botao" type="submit" value="Enviar" />
</form>
</main>