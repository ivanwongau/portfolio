<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */

use Cake\ORM\TableRegistry;

echo $this->Html->css('secondaryTable.css');

?>

<div class="row">

    <ul class="nav nav-tabs">

        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><h4><b>View</b></h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=
                <?= $this->Url->build(['controller' => 'Clients', 'action' => 'index']); ?>>
                <h4>Return to List</h4></a>
        </li>

    </ul>


    <div class="column-responsive column-80">
        <div class="clients view content">

            <table>
                <h3><strong>Client Information</strong></h3>

                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $client->has('user') ? $this->Html->link($client->user->id, ['controller' => 'Users', 'action' => 'view', $client->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Client Name') ?></th>
                    <td><?= h($client->user->first_name . ' ' . $client->user->surname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Diabetes Type') ?></th>
                    <td><?= h($client->diabetes_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Medicare No') ?></th>
                    <td><?= h($client->medicare_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Past Births') ?></th>
                    <td><?= $this->Number->format($client->past_births) ?></td>
                </tr>
                <tr>
                    <th><?= __('Medicare Ref') ?></th>
                    <td><?= $this->Number->format($client->medicare_ref) ?></td>
                </tr>
                <tr>
                    <th><?= __('Medical History') ?></th>
                    <td><?= $this->Text->autoParagraph(h($client->medical_history)); ?></td>
                </tr>
            </table>

            <div class="related">
                <h4><strong><?= __('Assigned Clinicians') ?></strong></h4>
                <?php if (!empty($client->clinicians)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Medical Specialty') ?></th>
                                <th><?= __('User Id') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($client->clinicians as $clinician) :

                                // Searches for the clinician the user is assigned to
                                $usersQuery = TableRegistry::getTableLocator()->get('Users');
                                $assignedClinician = $usersQuery->find()->select([])
                                    ->where(['id' => $clinician->user_id])
                                    ->first();

                                ?>
                                <tr>
                                    <td><?= $assignedClinician->first_name . ' ' . $assignedClinician->surname ?></td>
                                    <td><?= h($clinician->medical_specialty) ?></td>
                                    <td><?= h($clinician->user_id) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Clinicians', 'action' => 'view', $clinician->id]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <div class="related">
                <h4><strong><?= __('Logged Client Conditions') ?></strong></h4>
                <?php if (!empty($client->client_conditions)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Insulin Level') ?></th>
                                <th><?= __('Weight') ?></th>
                                <th><?= __('BMI') ?></th>
                                <th><?= __('Logged Time') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($client->client_conditions as $clientConditions) : ?>
                                <tr>
                                    <td><?= h($clientConditions->insulin_level) ?></td>
                                    <td><?= h($clientConditions->weight) ?></td>
                                    <td><?= h($clientConditions->BMI) ?></td>
                                    <td><?= h($clientConditions->logged_time) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'ClientConditions', 'action' => 'edit', $clientConditions->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'ClientConditions', 'action' => 'delete', $clientConditions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientConditions->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><strong><?= __('Logged Food Intakes') ?></strong></h4>
                <?php if (!empty($client->food_intakes)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Food Eaten') ?></th>
                                <th><?= __('Logged Time') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($client->food_intakes as $foodIntakes) : ?>
                                <tr>
                                    <td><?= h($foodIntakes->food_eaten) ?></td>
                                    <td><?= h($foodIntakes->logged_time) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'FoodIntakes', 'action' => 'edit', $foodIntakes->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'FoodIntakes', 'action' => 'delete', $foodIntakes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $foodIntakes->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
