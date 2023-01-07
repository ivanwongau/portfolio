<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyMultiOwnership $propertyMultiOwnership
 */
?>
<?php
    foreach ($rename as $row):
		if ($row['id']==44){
            $DashboardMainPage_TotalItems = $row->name;
        }
        if ($row['id']==45){
            $DashboardMainPage_TotalItemsDueThisYear = $row->name;
        }
		if ($row['id']==46){
            $DashboardMainPage_PropertyReport = $row->name;
        }
        if ($row['id']==47){
            $DashboardMainPage_NotFinalised = $row->name;
            }

        if ($row['id']==48){
            $DashboardMainPage_Includes = $row->name;
        }
        if ($row['id']==49){
            $DashboardMainPage_OwnerType = $row->name;
        }
        if ($row['id']==50){
            $DashboardMainPage_OwnerCorpNumber = $row->name;
        }
        if ($row['id']==51){
            $DashboardMainPage_NumberOfLots = $row->name;
        }
        if ($row['id']==52){
            $DashboardMainPage_NumberOfLotLiabilities = $row->name;
        }
        if ($row['id']==53){
            $DashboardMainPage_StrataPlanNumber = $row->name;
        }
		if ($row['id']==54){
            $DashboardMainPage_PlanRegistrationDate = $row->name;
            }

        if ($row['id']==55){
            $DashboardMainPage_PropertyInformation = $row->name;
        }
        if ($row['id']==56){
            $DashboardMainPage_Calendar = $row->name;
        }
        if ($row['id']==57){
            $DashboardMainPage_ItemMaintenanceList = $row->name;
        }

        if ($row['id']==58){
			$DashboardMainPage_LevelsLocations = $row->name;
        }

    endforeach;
?>
<div class="property_add content">
	<div class="container-fluid property_add">

		<div class="text-field">
			<h1>Add multi ownership</h1>
			<!-- form  -->
			<?= $this->Form->create($propertyMultiOwnership) ?>
			<div class="text-field">
			    <label for="owner_corp_num">Owner Corp Number</label>
				<input type="text" pattern="[A-Za-z0-9 ]{1,50}" id="owner_corp_num" name="owner_corp_num" required class="form-control">

			</div>
            <div class="text-field">
			    <label for="Num_of_lot">Number of Lot</label>
				<input class="form-control" type="number" max = "600" min= "0"  id="Num_of_lot" name="Num_of_lot" required>

			</div>
            <div class="text-field">
			<label for="Num_of_lot_liabilities">Number of Lot Liabilities</label>
				<input class="form-control" type="number" id="Num_of_lot_liabilities" max ="999999" min="0" name="Num_of_lot_liabilities" required>

			</div>
			 <div class="text-field">
			    <label for="strata_plan_number">Strata Plan Number</label>
				<input class="form-control" type="text" id="strata_plan_number"  value = '<?= $property->first()->plan_of_subdivision_number ?>' pattern="[A-Za-z0-9 ]{1,50}" name="strata_plan_number" readonly>


			</div>
			 <div class="text-field">
                <label for="plan_registration_date">Plan Registration Date</label>
                <input class="form-control" type="date" id="plan_registration_date" name="plan_registration_date" required>
            </div>




			<!-- submit button -->
			<br>

			<button class='btn btn-primary '>
				SAVE
			</button>


			<?= $this->Form->end() ?>


		</div>
		<!-- 3rd column-->
	</div>

</div>
