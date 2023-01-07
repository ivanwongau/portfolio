<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

use Cake\ORM\TableRegistry;

echo $this->Html->css('primaryTable.css');

?>


<?php if ($this->Identity->get('role') === '1') {
?>
<div class="row">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" style="display:inline-block;" href="#"
            <h4><b>View</b></h4>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="display:inline-block;" href=
                <?= $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>>
                <h4>Return to List</h4>
            </a>
        </li>
    </ul>

    <div class="column-responsive column-80">
        <div class="users view content">
            <h2><strong>User Information</strong></h2>

            <table>
                <tr>
                    <th>Name</th>
                    <td><?= h($user->first_name) . ' ' . h($user->surname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td>
                        <?php
                        if ($user->role == '1') {
                            echo "Managerial Clinician";
                        } else if ($user->role == '2') {
                            echo "Clinician";
                        } else if ($user->role == '3') {
                            echo "Client";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Home Address') ?></th>
                    <td><?= h($user->home_address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mobile No') ?></th>
                    <td><?= h($user->mobile_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($user->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($user->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Login') ?></th>
                    <td><?= h($user->last_login) ?></td>
                </tr>
            </table>


            <?php
            if ($user->role === '3') { ?>
                <br><br><br>
                <h4><strong>Client Details</strong></h4>
                <?php
                if (!empty($user->clients)) { ?>
                    <table>
                        <tr>
                            <th><?= __('Diabetes Type') ?></th>
                            <th><?= __('Past Births') ?></th>
                            <th><?= __('Medicare No') ?></th>
                            <th><?= __('Medicare Ref') ?></th>
                            <th><?= __('Medical History') ?></th>
                        </tr>
                        <?php foreach ($user->clients as $clients) : ?>
                            <tr>
                                <td><?= h($clients->diabetes_type) ?></td>
                                <td><?= h($clients->past_births) ?></td>
                                <td><?= h($clients->medicare_no) ?></td>
                                <td><?= h($clients->medicare_ref) ?></td>
                                <td><?= h($clients->medical_history) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <?php
                } else {
                    echo "User has not yet completed their client account";
                }
            }
            if ($user->role === '2' || $user->role === '1') { ?>
                <br><br><br>
                <h4><strong>Clinician Details</strong></h4>

                <?php
                if (!empty($user->clinicians)) {
                    ?>

                    <table>
                        <tr>
                            <th>Medical Specialty</th>
                        </tr>
                        <?php foreach ($user->clinicians as $clinician) : ?>
                            <tr>
                                <td><?= h($clinician->medical_specialty) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <?php
                } else {
                    echo "User has not yet completed their clinician account";
                }
            }
            ?>

        </div>
        <?php
        } ?>


        <?php if ($this->Identity->get('role') === '3' || $this->Identity->get('role') === '2') {
        ?>
        <div class="row">
            <div class="column-responsive column-80">
                <div class="users view content">
                    <h3><?= h($user->first_name . ' ' . $user->surname) ?></h3>
                    <table>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('First Name') ?></th>
                            <td><?= h($user->first_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Surname') ?></th>
                            <td><?= h($user->surname) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Home Address') ?></th>
                            <td><?= h($user->home_address) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Role') ?></th>
                            <td><?= h($user->role) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($user->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Mobile No') ?></th>
                            <td><?= $this->Number->format($user->mobile_no) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created Date') ?></th>
                            <td><?= h($user->created_date) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified Date') ?></th>
                            <td><?= h($user->modified_date) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Last Login') ?></th>
                            <td><?= h($user->last_login) ?></td>
                        </tr>
                    </table>

                    <div class="related">
                        <?php if (!empty($user->clinicians)) : ?>
                            <div class="table-responsive">
                                <table>
                                    <tr>
                                        <th><?= __('Id') ?></th>
                                        <th><?= __('Medical Specialty') ?></th>
                                        <th><?= __('User Id') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                    <?php foreach ($user->clinicians as $clinicians) : ?>
                                        <tr>
                                            <td><?= h($clinicians->id) ?></td>
                                            <td><?= h($clinicians->medical_specialty) ?></td>
                                            <td><?= h($clinicians->user_id) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('View'), ['controller' => 'Clinicians', 'action' => 'view', $clinicians->id]) ?>
                                                <?= $this->Html->link(__('Edit'), ['controller' => 'Clinicians', 'action' => 'edit', $clinicians->id]) ?>
                                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Clinicians', 'action' => 'delete', $clinicians->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clinicians->id)]) ?>
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
    </div>
    <?php
    }
    ?>


