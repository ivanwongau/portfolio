<p id="forecast-period" style="display:none;"><?= $forecast_period ?></p>
<p id="contribution-safety-net" style="display:none;"><?= $property->contribution_safety_net ?> ></p>
<p id="GST" style="display:none;"><?= $property->GST ?> </p>
<p id="interest-rate" style="display:none;"><?= $property->interest_rate ?></p>
<p id="starting-balance" style="display:none;"><?= $property->starting_balance ?></p>
<p id="base-contribution-percentage" style="display:none;"><?= $property->base_contribution_percentage ?></p>
<p id="GST-status" style="display:none;"><?= $property->GST_Status ?></p>
<p id="display-period" style="display:none;"><?= $forecast_period_display  ?></p>
<p id="total-item" style="display:none;"><?= count($item_data)  ?></p>
<p id="number-of-lot" style="display:none;"><?php if ($lotOwnerData != null) {
                                                echo count($lotOwnerData);
                                            } else {
                                                echo 1;
                                            }  ?></p>





<p id="tax-rate" style="display:none;"><?= $property->tax_rate ?></p>





<div class="report-download-form">
    <div class="form-container">
        <?php echo  $this->Html->link(
            '<button class="btn btn-secondary back-btn" style="margin-bottom:10px;"><span>  Back</span></button>',
            ['controller' => 'Properties', 'action' => 'dashboard', $property->id],
            ['escape' => false]
        ); ?>
        <?= $this->Form->create($property); ?>

        <div class=" has-placeholder">
            <label class="mdl-textfield__label" for="inflation_rate">Inflation rate</label>
            <input class="form-control" type="number" max="100" step="0.0001" min="0"
                title="Please only enter digits and value between 1-100" value="<?= $inflation_rate * 100 ?>"
                name="inflation_rate" required>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
            <label class="mdl-textfield__label" for="contribution_safety_net">Contribution Safety Net</label>
            <input class="form-control" type="number" max="100" step="0.0001" min="0"
                title="Please only enter digits and value between 1-100"
                value="<?= $property->contribution_safety_net * 100 ?>" name="contribution_safety_net" required>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
            <label class="mdl-textfield__label" for="interest_rate">Interest Rate</label>
            <input class="form-control" type="number" max="100" step="0.0001" min="0"
                title="Please only enter digits and value between 1-100" value="<?= $property->interest_rate * 100 ?>"
                name="interest_rate" required>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
            <label class="mdl-textfield__label" for="GST">GST</label>
            <input class="form-control" type="number" max="100" step="0.0001" min="0"
                title="Please only enter digits and value between 1-100" value="<?= $property->GST * 100 ?>" name="GST"
                required>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
            <label class="mdl-textfield__label" for="tax_rate">Tax Rate</label>
            <input class="form-control" type="number" max="100" step="0.0001" min="0"
                title="Please only enter digits and value between 1-100" value="<?= $property->tax_rate * 100 ?>"
                name="tax_rate" required>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label has-placeholder">
            <label class="mdl-textfield__label" for="base_contribution_percentage">Base Contribution Percentage</label>
            <input class="form-control" type="number" max="100" step="0.0001" min="0"
                title="Please only enter digits and value between 1-100"
                value="<?= $property->base_contribution_percentage * 100 ?>" name="base_contribution_percentage"
                required>
        </div>
        <br>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>

</div>

<div class="section-a">
    <div class="header">
        <h2 class="section-title">Items Table</h2>

        <button onclick="printItemTable()" class="download-btn"><i class="fa fa-download"></i></button>
    </div>
    <div class="table-container" id="print-table-items">
        <table class="report-table table-decoration" id="report-table">
            <thead>

                <tr>
                    <th></th>
                    <th></th>
                    <th></th>

                    <th>Forecast Year</th>
                    <?php for ($k = 1; $k <= $forecast_period_display; $k++) {

                        echo "<th>$k</th>";
                    } ?>
                </tr>

                <tr>
                    <th>List of Items</th>
                    <th>Year Due</th>
                    <th>Life Span</th>
                    <th>Current Cost</th>
                    <?php for ($i = 0; $i < $forecast_period_display; $i++) {

                        $new_date = strtotime($property_date);
                        $new_date += $i * 31556952;
                        $new_date = date('M-Y', $new_date);
                        echo "<th>$new_date </th>";
                    } ?>

                </tr>
            </thead>

            <tr id="result" style="background:#FFFF9A; color:black; font-weight:bold;">
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <?php for ($i = 0; $i < $forecast_period; $i++) {


                    echo "<td></td>";
                } ?>

            </tr>

            <tbody>
                <?php
                $count = 0;
                foreach ($item_data as $item) : ?>

                <tr id=<?= "item$count" ?>>
                    <td><?= $item['item_name'] ?></td>
                    <td><?= $item['year_due'] ?></td>
                    <td><?= $item['expected_life'] ?></td>
                    <td>
                        <?php $display_item_total = number_format($item['item_total'], 2);
                            echo "$$display_item_total"; ?>
                    </td>
                    <?php
                        $first_year_cost = $item['item_total'] * (1 + $inflation_rate);
                        if ($item['year_due'] == 1) {
                            echo "<td style='color:black;background:coral;'>$first_year_cost  </td>";
                        } else {
                            echo "<td></td>";
                        }

                        $new_cost = $first_year_cost;

                        $start_year = date('Y', strtotime($property_date) - 31556952);
                        $remaining_year = $item['year_due'];


                        for ($i = 1; $i < $forecast_period; $i++) {

                            $new_cost = $new_cost + $new_cost * $inflation_rate;


                            $display = number_format(floatval($new_cost), 2);

                            $current_year = date('Y', strtotime($property_date) + $i * 31556952);



                            if ($current_year - $start_year == $remaining_year) {
                                echo "<td style='color:black;background:coral;'>$display</td>";
                                $remaining_year = $item['expected_life'];


                                $start_year = $current_year;
                            } else {

                                echo "<td></td>";
                            }
                        }
                        ?>
                </tr>

                <?php $count += 1;
                endforeach; ?>


            </tbody>
        </table>




    </div>
</div>

<!-- Second Table -->
<div class="section-b">
    <div class="header">
        <h2 class="section-title">Sinking Funds Table</h2>
        <button onclick="printSummaryTable()" class="download-btn"><i class="fa fa-download"></i></button>

    </div>

    <div class="table-container" id="print-funds-flow">
        <table class=" sinking-fund-table table-decoration">
            <thead>
                <tr class=table-header id="annual-year">
                    <th>Forecast Year</th>
                    <?php for ($i = 1; $i <= $forecast_period_display; $i++) {

                        echo "<th>$i</th>";
                    } ?>
                </tr>
            </thead>
            <tbody class="sinking-fund-body">
                <tr style="background:#ccffcc; font-weight:bold;">
                    <td>Financial Year Ending</td>
                    <?php for ($i = 0; $i < $forecast_period_display; $i++) {
                        $new_date = strtotime($property_date);
                        $new_date += 31556952;

                        $new_date += $i * 31556952 - 86400;
                        $new_date = date('M-Y', $new_date);
                        echo "<td>$new_date </td>";
                    } ?>

                </tr>

                <tr>
                    <td>Balance From Previous Fund</td>
                    <td>$ <?= $starting_balance ?></td>
                    <?php for ($i = 1; $i < $forecast_period_display; $i++) {

                        echo "<td style= 'background:#999'></td>";
                    } ?>

                </tr>

                <tr class="balance_brought_forward">
                    <td>Balance Brought Forward</td>
                    <td>$ <?= $starting_balance ?></td>


                </tr>


                <tr class="BAC">
                    <td>Budgeted Annual Contribution</td>
                </tr>

                <tr class="interest-after-tax">
                    <td>Interest After Tax</td>

                </tr>

                <tr class="subtotal_1">
                    <td>Subtotal 1</td>

                </tr>

                <tr class="annual-expenditure">
                    <td>Annual Expenditure</td>

                </tr>

                <tr class="end_of_year_funds_available">
                    <td>Total-Available Funds</td>

                </tr>
            </tbody>


        </table>

    </div>

</div>







<div class="section-c">
    <div class="header">
        <h2 class="section-title">Available Funds Flow Chart</h2>
        <button onclick="printBarChart()" class="download-btn"><i class="fa fa-download"></i></button>

    </div>

    <div class="chart-container" style="width:1000px">
        <canvas id="myChart"></canvas>
    </div>

</div>


<div class="section-d">
    <div class="header">
        <h2 class="section-title">Available Funds Flow Chart - Line Chart</h2>
        <button onclick="printLineChart()" class="download-btn"><i class="fa fa-download"></i></button>

    </div>

    <div class="chart-container" style="width:1000px">
        <canvas id="line-chart"></canvas>
    </div>

</div>

<div class="section-e">

    <div class="header">
        <h2 class="section-title">Liabilities</h2>
        <button onclick="printLiabilityTable()" class="download-btn"><i class="fa fa-download"></i></button>

    </div>

    <div class="table-container" id="print-liabilities">
        <table class="liabilities-table table-decoration">
            <thead>
                <tr class="table-header" id="annual-year">
                    <th></th>
                    <th></th>
                    <?php for ($i = 1; $i <= $forecast_period_display; $i++) {

                        echo "<th> years $i</th>";
                    } ?>
                </tr>
            </thead>
            <tbody class="liabilities-body">
                <tr style=" font-weight:bold;" class="rate-per-lot-liability">
                    <td></td>
                    <td>Rate per Lot Liability</td>


                </tr>

                <tr class="total-lot-header" style="background:#FFFF9A;">
                    <td style="text-align:center; font-weight: bold;">Total Lots</td>
                    <td style="text-align:center; font-weight: bold;">Total Lot Liabilities</td>
                    <td colspan="<?= $forecast_period_display ?>">Total Contribution P.A</td>

                </tr>

                <tr class="total-lot">
                    <td style="text-align:center; ">
                        <?php
                        if ($ownership != null) {
                            echo $ownership[0]['Num_of_lot'];
                        } else {
                            echo 0;
                        } ?>
                    </td>
                    <td id="total-lot-liabilities">
                        <?php
                        if ($ownership != null) {
                            echo $ownership[0]['Num_of_lot_liabilities'];
                        } else {
                            echo 0;
                        } ?>
                    </td>

                </tr>


                <tr class="lot-header" style="background:#FFFF9A;">
                    <td style="text-align:center; font-weight: bold;">Lot No</td>
                    <td style="text-align:center; font-weight: bold;">No Liabilities</td>
                    <td colspan="<?= $forecast_period_display ?>">Lot Owners Annual Contributions Required</td>
                </tr>



                <?php if ($lotOwnerData == null) {
                    $placeHolder = 0;
                } else {
                    $placeHolder = count($lotOwnerData);
                }
                for ($i = 0; $i < $placeHolder; $i++) : ?>

                <tr id="lot-<?= $i + 1 ?>">
                    <td style="text-align: center;"><?= $lotOwnerData[$i]['lots_no'] ?></td>
                    <td id="no-liabilities-lot<?= $i + 1 ?>"><?= $lotOwnerData[$i]['no_liabilities'] ?></td>

                </tr>



                <?php endfor; ?>


            </tbody>


        </table>

    </div>

</div>




</body>

</html>
