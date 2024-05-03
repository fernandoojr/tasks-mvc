<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="/css/styles.css" />
<body>
    <h1>Lista de tarefas</h1>
    <a href="/nova">Nova Tarefa</a>
    <table border="1" width="1350">
        <thead>
            <tr>
                <th class="titulo-tabela">Data da tarefa</td>
                <th class="titulo-tabela">Descrição</td>
                <th class="titulo-tabela">Realizada?</td>
                <th><a href="">Cadastrar nova tarefa</a></th>
            </tr>
        </thead>
        <tbody>
            <?php use Project\Tasks\Entity\Task; /** @var Task $task */
            foreach($taskList as $task):?>
            <tr>
                <td><?= $task->getDate()?></td>
                <td><?= $task->getDescription()?></td>
                <td><?php if($task->getCompleted() === false) echo "Não";else echo "Sim";?></td>
                <td><a href="/excluir?id=<?=$task->id?>">Excluir</a></td>
                <td><a href="/editar?id=<?=$task->id?>">Editar</a></td>
                <td>
                    <a href="/status?id=<?=$task->id?>&status=<?=$task->getCompleted()?>">
                        <?php if($task->getCompleted() === false):?>
                            Marcar como realizada
                        <?php else:?>
                            Marcar como não realizada
                        <?php endif;?>
                    </a>
                </td>
            </tr>
        </tbody>
        <?php endforeach;?>
    </table>
</body>
</html>