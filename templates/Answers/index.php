<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Answer[]|\Cake\Collection\CollectionInterface $answers
 */
?>
<div class="answers index content">
    <?= $this->Html->link(__('New Answer'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Answers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('article_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($answers as $answer): ?>
                <tr>
                    <td><?= $this->Number->format($answer->id) ?></td>
                    <td><?= h($answer->created) ?></td>
                    <td><?= h($answer->modified) ?></td>
                    <td><?= $answer->has('article') ? $this->Html->link($answer->article->title, ['controller' => 'Articles', 'action' => 'view', $answer->article->id]) : '' ?></td>
                    <td><?= $answer->has('user') ? $this->Html->link($answer->user->id, ['controller' => 'Users', 'action' => 'view', $answer->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $answer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $answer->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
