<!doctype html>
<html>
  <head>
    <title>php-rtm sample application</title>
    <meta charset="utf-8">
    <link href="http://twitter.github.io/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 10px;
        }
        td.priority {
            width: 5px;
            padding: 0;
        }
        td.priority-1 {
            background-color: #EA5200 !important;
        }
        td.priority-2 {
            background-color: #0060BF !important;
        }
        td.priority-3 {
            background-color: #359AFF !important;
        }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <h1>Lists</h1>
          <div class="well">
            <ul class="nav nav-list">
              <? foreach ($lists as $list): ?>
              <? if ($list->getSmart() == 0 && $list->getDeleted() == 0 && $list->getArchived() == 0): ?>
              <li class="<? if ($list->getId() === $currentListId) { echo 'active'; } ?>">
                <a href="/?listId=<?= $list->getId() ?>"><?= $list->getName() ?></a>
              </li>
              <? endif; ?>
              <? endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="span9">
          <h1>Tasks</h1>
          <? if (isset($tasks)): ?>
          <table class="table table-striped">
            <? foreach($tasks as $task): ?>
            <? if ($task->getTask()->getCompleted() == '' && $task->getTask()->getDeleted() == ''): ?>
            <tr>
              <td class="priority <? if ($task->getTask()->getPriority()) { echo 'priority-' . $task->getTask()->getPriority(); } ?>"></td>
              <td><?= $task->getName() ?></td>
            </tr>
            <? endif; ?>
            <? endforeach; ?>
          </table>
          <? else: ?>
            <div class="alert">Choose some from the left sidebar</div>
          <? endif; ?>
        </div>
      </div>
    </div>
  </body>
</html>