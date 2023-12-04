<?php
include "inc.php";


$a = GetPageRecord('*', 'sys_userMaster', '  id="' . $_SESSION['userid'] . '"');
$invoiceData = mysqli_fetch_array($a);

$abc = GetPageRecord('*', 'sys_userMaster', 'id=1');
$companynamedata = mysqli_fetch_array($abc);
?>


<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({
    selector: ".editorclass",
    themes: "modern",
    plugins: [
      "advlist autolink lists link image charmap print preview anchor",
      "searchreplace visualblocks code fullscreen"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
  });
</script>

<?php if ($_REQUEST['action'] == 'addstaff') {


    $a = GetPageRecord('*', 'sys_userMaster', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
    $result = mysqli_fetch_array($a);


    ?>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <style type="text/css">
        <!--
        .style1 {
            color: #FFFFFF
        }

        -->
    </style>


    <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post"
          enctype="multipart/form-data">

        <div class="modal-body">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="validationCustom02">First Name </label>
                        <input type="text" class="form-control" required="" name="firstName"
                               value="<?php echo stripslashes($result['firstName']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="validationCustom02">Last Name </label>
                        <input type="text" class="form-control" required="" name="lastName"
                               value="<?php echo stripslashes($result['lastName']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="validationCustom02">Email (Username)</label>
                        <input type="text" class="form-control" required="" name="email"
                               value="<?php echo stripslashes($result['email']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="validationCustom02">Phone</label>
                        <input type="tel" class="form-control" required name="phone"
                               value="<?php echo stripslashes($result['phone']); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="validationCustom02">Role</label>


                        <select name="branchId" id="branchId" class="form-control">


                            <?php
                            $rs = GetPageRecord('*', 'roleMaster', ' 1 group by branchId order by name asc');
                            while ($rest = mysqli_fetch_array($rs)) {

                                $b = GetPageRecord('*', 'branchMaster', 'id="' . $rest['branchId'] . '"');
                                $branch = mysqli_fetch_array($b);
                                ?>

                                <option disabled="disabled"><?php echo stripslashes($branch['name']); ?></option>

                                <?php
                                $k = 0;
                                $rst = GetPageRecord('*', 'roleMaster', ' branchId="' . $branch['id'] . '" and parentId=0 order by name asc');
                                while ($restt = mysqli_fetch_array($rst)) {

                                    $ab = GetPageRecord('*', 'branchMaster', 'id="' . $restt['branchId'] . '" order by id asc');
                                    $branch2 = mysqli_fetch_array($ab);
                                    ?>


                                    <option value="<?php echo trim($restt['id']); ?>"
                                            <?php if ($result['branchId'] == trim($restt['id'])) { ?>selected="selected" <?php } ?>>
                                        --<?php echo stripslashes($restt['name']); ?>
                                        (<?php echo stripslashes($branch2['name']); ?>)
                                    </option>


                                    <?php
                                    $k = 100;
                                    $rsta = GetPageRecord('*', 'roleMaster', ' branchId="' . $branch['id'] . '" and parentId="' . $restt['id'] . '" order by name asc');
                                    while ($restta = mysqli_fetch_array($rsta)) {

                                        $ab = GetPageRecord('*', 'branchMaster', 'id="' . $restta['branchId'] . '" order by id asc');
                                        $branch3 = mysqli_fetch_array($ab);
                                        ?>

                                        <option value="<?php echo trim($restta['id']); ?>"
                                                <?php if ($result['branchId'] == trim($restta['id'])) { ?>selected="selected" <?php } ?>>
                                            ---<?php echo stripslashes($restta['name']); ?>
                                            (<?php echo stripslashes($branch3['name']); ?>)
                                        </option>


                                        <?php
                                        $k = 100;
                                        $rstaa = GetPageRecord('*', 'roleMaster', ' branchId="' . $branch['id'] . '" and parentId="' . $restta['id'] . '" order by name asc');
                                        while ($resttaa = mysqli_fetch_array($rstaa)) {

                                            $ab = GetPageRecord('*', 'branchMaster', 'id="' . $resttaa['branchId'] . '" order by id asc');
                                            $branch4 = mysqli_fetch_array($ab);
                                            ?>

                                            <option value="<?php echo trim($resttaa['id']); ?>"
                                                    <?php if ($result['branchId'] == trim($resttaa['id'])) { ?>selected="selected" <?php } ?>>
                                                ----<?php echo stripslashes($resttaa['name']); ?>
                                                (<?php echo stripslashes($branch4['name']); ?>)
                                            </option>


                                            <?php
                                            $k = 100;
                                            $rstaaa = GetPageRecord('*', 'roleMaster', ' branchId="' . $branch['id'] . '" and parentId="' . $resttaa['id'] . '" order by name asc');
                                            while ($resttaaa = mysqli_fetch_array($rstaaa)) {

                                                $ab = GetPageRecord('*', 'branchMaster', 'id="' . $resttaaa['branchId'] . '" order by id asc');
                                                $branch5 = mysqli_fetch_array($ab);
                                                ?>
                                                <option value="<?php echo trim($resttaaa['id']); ?>"
                                                        <?php if ($result['branchId'] == trim($resttaaa['id'])) { ?>selected="selected" <?php } ?>>
                                                    ----<?php echo stripslashes($resttaaa['name']); ?>
                                                    (<?php echo stripslashes($branch5['name']); ?>)
                                                </option>


                                                <?php
                                                $k = 100;
                                                $rstaaaa = GetPageRecord('*', 'roleMaster', ' branchId="' . $branch['id'] . '" and parentId="' . $resttaaa['id'] . '" order by name asc');
                                                while ($resttaaaa = mysqli_fetch_array($rstaaaa)) {

                                                    $ab = GetPageRecord('*', 'branchMaster', 'id="' . $resttaaaa['branchId'] . '" order by id asc');
                                                    $branch6 = mysqli_fetch_array($ab);
                                                    ?>

                                                    <option value="<?php echo trim($resttaaaa['id']); ?>"
                                                            <?php if ($result['branchId'] == trim($resttaaaa['id'])) { ?>selected="selected" <?php } ?>>
                                                        ------<?php echo stripslashes($resttaaaa['name']); ?>
                                                        (<?php echo stripslashes($branch6['name']); ?>)
                                                    </option>


                                                    <?php
                                                    $k = 100;
                                                    $rstaaaaa = GetPageRecord('*', 'roleMaster', ' branchId="' . $branch['id'] . '" and parentId="' . $resttaaaa['id'] . '" order by name asc');
                                                    while ($resttaaaaa = mysqli_fetch_array($rstaaaaa)) {
                                                        $ab = GetPageRecord('*', 'branchMaster', 'id="' . $resttaaaaa['branchId'] . '" order by id asc');
                                                        $branch7 = mysqli_fetch_array($ab);
                                                        ?>

                                                        <option value="<?php echo trim($resttaaaaa['id']); ?>"
                                                                <?php if ($result['branchId'] == trim($resttaaaaa['id'])) { ?>selected="selected" <?php } ?>>
                                                            -------<?php echo stripslashes($resttaaaaa['name']); ?>
                                                            (<?php echo stripslashes($branch7['name']); ?>)
                                                        </option>


                                                    <?php } ?>


                                                <?php } ?>


                                            <?php } ?>


                                        <?php } ?>


                                    <?php } ?>


                                <?php } ?>


                            <?php } ?>


                        </select>


                        <select name="userType" class="form-control" style="display:none;">
                            <option value="1" <?php if ($result["userType"] == 1) { ?> selected="selected" <?php } ?>>
                                Team
                            </option>
                            <!--<option value="2" <?php if ($result["userType"] == 2) { ?> selected="selected" <?php } ?>>Agent</option>-->
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <table width="100%" border="0" cellspacing="0" cellpadding="10"
                           style="border:1px solid #ddd; margin-bottom:20px;">
                        <tr>
                            <td height="30" colspan="2" align="left" valign="middle" bgcolor="#DEE6F8"><strong>Module
                                    Permission </strong></td>
                            <td width="13%" height="15" align="left" valign="middle" bgcolor="#DEE6F8">
                                <strong>View</strong></td>
                            <td width="46%" height="15" align="left" valign="middle" bgcolor="#DEE6F8">
                                <strong>Add/Edit</strong></td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Query</td>
                            <td width="13%" align="left"><input type="checkbox" name="permissionView[]" value="Query"
                                                                <?php if (strpos($result["permissionView"], 'Query') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td width="46%" align="left"><input type="checkbox" name="permissionAddEdit[]" value="Query"
                                                                <?php if (strpos($result["permissionAddEdit"], 'Query') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td align="right" style=" font-size:13px;">&nbsp;</td>
                            <td align="left">&nbsp;</td>
                            <td colspan="2" align="left"><select name="showQueryStatus" class="form-control">
                                    <option value="0" <?php if ($result["showQueryStatus"] == 0) { ?> selected="selected" <?php } ?>>
                                        Show Assigned Query Only
                                    </option>
                                    <option value="1" <?php if ($result["showQueryStatus"] == 1) { ?> selected="selected" <?php } ?>>
                                        Show Confirmed Query / Proposal Only
                                    </option>
                                    <option value="2" <?php if ($result["showQueryStatus"] == 2) { ?> selected="selected" <?php } ?>>
                                        Show All Query
                                    </option>
                                </select></td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td align="right" style=" font-size:13px;"><i class="fa fa-arrow-right"
                                                                          aria-hidden="true"></i></td>
                            <td align="left">Proposal</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="Proposal"
                                                    <?php if (strpos($result["permissionView"], 'Proposal') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left"><input type="checkbox" name="permissionAddEdit[]" value="Proposal"
                                                    <?php if (strpos($result["permissionAddEdit"], 'Proposal') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td align="right" style=" font-size:13px;"><i class="fa fa-arrow-right"
                                                                          aria-hidden="true"></i></td>
                            <td align="left">Mails</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="Mails"
                                                    <?php if (strpos($result["permissionView"], 'Mails') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left"><input type="checkbox" name="permissionAddEdit[]" value="Mails"
                                                    <?php if (strpos($result["permissionAddEdit"], 'Mails') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td align="right" style=" font-size:13px;"><i class="fa fa-arrow-right"
                                                                          aria-hidden="true"></i></td>
                            <td align="left">Task / Followup's</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="Task"
                                                    <?php if (strpos($result["permissionView"], 'Task') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left"><input type="checkbox" name="permissionAddEdit[]" value="Task"
                                                    <?php if (strpos($result["permissionAddEdit"], 'Task') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td align="right" style=" font-size:13px;"><i class="fa fa-arrow-right"
                                                                          aria-hidden="true"></i></td>
                            <td align="left">Suppliers Communication</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="Suppliers"
                                                    <?php if (strpos($result["permissionView"], 'Suppliers') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left"><input type="checkbox" name="permissionAddEdit[]" value="Suppliers"
                                                    <?php if (strpos($result["permissionAddEdit"], 'Suppliers') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td align="right" style=" font-size:13px;"><i class="fa fa-arrow-right"
                                                                          aria-hidden="true"></i></td>
                            <td align="left">Post Sales Supplier</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="TourExpences"
                                                    <?php if (strpos($result["permissionView"], 'TourExpences') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left"><input type="checkbox" name="permissionAddEdit[]" value="TourExpences"
                                                    <?php if (strpos($result["permissionAddEdit"], 'TourExpences') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td align="right" style=" font-size:13px;"><i class="fa fa-arrow-right"
                                                                          aria-hidden="true"></i></td>
                            <td align="left">Voucher</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="Operation"
                                                    <?php if (strpos($result["permissionView"], 'Operation') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left"><input type="checkbox" name="permissionAddEdit[]" value="Operation"
                                                    <?php if (strpos($result["permissionAddEdit"], 'Operation') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td align="right" style=" font-size:13px;"><i class="fa fa-arrow-right"
                                                                          aria-hidden="true"></i></td>
                            <td align="left">Billing</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="Billing"
                                                    <?php if (strpos($result["permissionView"], 'Billing') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left"><input type="checkbox" name="permissionAddEdit[]" value="Billing"
                                                    <?php if (strpos($result["permissionAddEdit"], 'Billing') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td align="right" style=" font-size:13px;"><i class="fa fa-arrow-right"
                                                                          aria-hidden="true"></i></td>
                            <td align="left">Guest Docs.</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="Guest"
                                                    <?php if (strpos($result["permissionView"], 'Guest') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left"><input type="checkbox" name="permissionAddEdit[]" value="Guest"
                                                    <?php if (strpos($result["permissionAddEdit"], 'Guest') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td align="right" style=" font-size:13px;"><i class="fa fa-arrow-right"
                                                                          aria-hidden="true"></i></td>
                            <td align="left">Payment Links</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="PaymentLinks"
                                                    <?php if (strpos($result["permissionView"], 'PaymentLinks') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left"><input type="checkbox" name="permissionAddEdit[]" value="PaymentLinks"
                                                    <?php if (strpos($result["permissionAddEdit"], 'PaymentLinks') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td width="3%" align="right" style=" font-size:13px;"><i class="fa fa-arrow-right"
                                                                                     aria-hidden="true"></i></td>
                            <td width="38%" align="left">History</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="History"
                                                    <?php if (strpos($result["permissionView"], 'History') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left"></td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Itinerary</td>
                            <td width="13%" align="left"><input type="checkbox" name="permissionView[]"
                                                                value="Itinerary"
                                                                <?php if (strpos($result["permissionView"], 'Itinerary') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td width="46%" align="left"><input type="checkbox" name="permissionAddEdit[]"
                                                                value="Itinerary"
                                                                <?php if (strpos($result["permissionAddEdit"], 'Itinerary') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Client</td>
                            <td width="13%" align="left"><input type="checkbox" name="permissionView[]" value="Client"
                                                                <?php if (strpos($result["permissionView"], 'Client') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td width="46%" align="left"><input type="checkbox" name="permissionAddEdit[]"
                                                                value="Client"
                                                                <?php if (strpos($result["permissionAddEdit"], 'Client') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Supplier</td>
                            <td width="13%" align="left"><input type="checkbox" name="permissionView[]"
                                                                value="SupplierMaster"
                                                                <?php if (strpos($result["permissionView"], 'SupplierMaster') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td width="46%" align="left"><input type="checkbox" name="permissionAddEdit[]"
                                                                value="SupplierMaster"
                                                                <?php if (strpos($result["permissionAddEdit"], 'SupplierMaster') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Report</td>
                            <td width="13%" align="left"><input type="checkbox" name="permissionView[]" value="Report"
                                                                <?php if (strpos($result["permissionView"], 'Report') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td width="46%" align="left">&nbsp;</td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd; display:none;">
                            <td colspan="2" align="left">Manual Voucher</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="ManualVoucher"
                                                    <?php if (strpos($result["permissionView"], 'ManualVoucher') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left">&nbsp;</td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Room Type</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="RoomType"
                                                    <?php if (strpos($result["permissionView"], 'RoomType') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left">&nbsp;</td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Meal Plan</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="MealPlan"
                                                    <?php if (strpos($result["permissionView"], 'MealPlan') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left">&nbsp;</td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Hotel</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="Hotel"
                                                    <?php if (strpos($result["permissionView"], 'Hotel') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left">&nbsp;</td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Activity</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="Activity"
                                                    <?php if (strpos($result["permissionView"], 'Activity') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left">&nbsp;</td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Transfer</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="Transfer"
                                                    <?php if (strpos($result["permissionView"], 'Transfer') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left">&nbsp;</td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <td colspan="2" align="left">Show Package Price</td>
                            <td align="left"><input type="checkbox" name="permissionView[]" value="PackagePrice"
                                                    <?php if (strpos($result["permissionView"], 'PackagePrice') !== false) { ?>checked="checked" <?php } ?> />
                            </td>
                            <td align="left">&nbsp;</td>
                        </tr>
                    </table>

                </div>


                <div class="col-md-6">
                    <label for="example-text-input" class="col-md-1 col-form-label">Active</label>
                    <div class="col-md-10">
                        <input name="status" type="checkbox" id="switch3" value="1" switch="bool"
                               <?php if ($result['status'] == 1 || $result['status'] == '') { ?>checked<?php } ?> />
                        <label for="switch3" data-on-label="Yes" data-off-label="No" style="margin-top: 6px;"></label>
                    </div>
                </div>

            </div>
        </div>

        <?php if ($_REQUEST['id'] != '') { ?>
            <div class="form-group row">
                <label for="example-text-input" class="col-md-12 col-form-label" style="padding-left: 30px;"><input
                            name="sendpass" type="checkbox" id="sendpass" value="1"/>&nbsp;&nbsp;Reset and send
                    temporary password to mail</label>

            </div>
        <?php } ?>
        <div class="modal-footer">
            <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary"
                   onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"/>
        </div>

        <input name="action" type="hidden" id="action" value="addstaff"/>
        <input name="old_email" type="hidden" id="old_email" value="<?php echo stripslashes($result['email']); ?>"/>
        <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>"/>
    </form>

<?php } ?>


<?php if ($_REQUEST['action'] == 'setlogoandinclusion') {

  $a = GetPageRecord('*', 'sys_userMaster', 'id="' . $_SESSION['userid'] . '" order by id desc');
  $result = mysqli_fetch_array($a);

?>





  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Invoice / Itinerary logo </label>
            <div class="custom-file">
              <input name="changeprofilepic" type="file" class="custom-file-input" id="customFile">
              <input name="oldchangeprofilepic" type="hidden" value="<?php echo $result['invoiceLogo']; ?>">
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Invoice terms and conditions </label>
            <textarea name="inclusion" rows="5" class="form-control editorclass" required=""><?php echo stripslashes($result['inclusion']); ?></textarea>
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Package terms and conditions </label>
            <textarea name="invoiceTerms" rows="5" class="form-control editorclass" required=""><?php echo stripslashes($result['invoiceTerms']); ?></textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Bank information </label>
            <textarea name="packageImportantTips" rows="5" class="form-control editorclass" required=""><?php echo stripslashes($result['packageImportantTips']); ?></textarea>
          </div>
        </div>


        <div class="col-md-12">
          <img src="images/leadgeticon.png" height="100" style="margin:40px 0px;" />
          <div class="form-group">
            <label for="validationCustom02">Google sheet URL for leads fetching </label>
            <input name="leadURL" type="text" class="form-control" value="<?php echo stripslashes($result['leadURL']); ?>" required="" />
          </div>
        </div>
      </div>


      <hr />


      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2"><img src="payment/Razorpay_logo.svg.png" height="30" /></td>
          <td width="95%" style="font-size: 20px; padding-top: 6px;">&nbsp;&nbsp;Payment Gateway Setting</td>
        </tr>
      </table>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="validationCustom02">API Key</label>
        <input name="paymentAPIKey" type="text" class="form-control" id="paymentAPIKey" value="<?php echo stripslashes($result['paymentAPIKey']); ?>" required="" />
      </div>
    </div>


    <div class="col-md-12">
      <div class="form-group">
        <label for="validationCustom02">API Secret</label>
        <input name="paymentAPISecret" type="text" class="form-control" id="paymentAPISecret" value="<?php echo stripslashes($result['paymentAPISecret']); ?>" required="" />
      </div>
    </div>


    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="setlogoandinclusion" />
  </form>

<?php } ?>



<?php if ($_REQUEST['action'] == 'organisationsettings') {

  $a = GetPageRecord('*', 'sys_userMaster', 'id="' . ($_SESSION['userid']) . '" order by id desc');
  $result = mysqli_fetch_array($a);

?>
  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Organisation name </label>
            <input name="invoiceCompany" type="text" class="form-control" id="invoiceCompany" value="<?php echo stripslashes($result['invoiceCompany']); ?>" required="">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Email </label>
            <input type="text" class="form-control" required="" name="invoiceEmail" value="<?php echo stripslashes($result['invoiceEmail']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Phone</label>
            <input type="text" class="form-control" required="" name="invoicePhone" value="<?php echo stripslashes($result['invoicePhone']); ?>">
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Address</label>
            <input type="text" class="form-control" required="" name="invoiceAddress" value="<?php echo stripslashes($result['invoiceAddress']); ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">GSTN</label>
            <input type="text" class="form-control" required="" name="Invoicegstn" value="<?php echo stripslashes($result['Invoicegstn']); ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">State</label>
            <input type="text" class="form-control" required="" name="invoiceState" value="<?php echo stripslashes($result['invoiceState']); ?>">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">State Code</label>
            <input type="text" class="form-control" required="" name="invoiceStateCode" value="<?php echo stripslashes($result['invoiceStateCode']); ?>">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Voucher PIN</label>
            <input type="text" class="form-control" required="" name="manualVoucherPin" value="<?php echo stripslashes($result['manualVoucherPin']); ?>">
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="organisationsettings" />
  </form>

<?php } ?>










<?php if ($_REQUEST['action'] == 'addtineraries') {

  $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
  $result = mysqli_fetch_array($a);

  if(isset($_REQUEST['id'])){
    $sql = "select * from Taggings ts, Tags t where t.id=ts.tags_id and ts.tagable_id=".decode($_REQUEST['id'])." and ts.taggable_type='itinerary' order by t.name";
    $rs_tags_edit = mysqli_query(db(), $sql) or die(mysqli_error());
  
    $sql = "select * from  sys_packageBuilder_image where itinerary_id=" . decode($_REQUEST['id']) . " order by id desc ";
    $rs2 = mysqli_query(db(), $sql) or die(mysqli_error());

  }
    
?>

<!-- ---------------- start tagsinput css -------------------- -->

<link rel='stylesheet' href='assets/css/bootstrap-tagsinput.css'>
<style>
.icon-github {
  background: no-repeat url('../img/github-16px.png');
  width: 16px;
  height: 16px;
}

.bootstrap-tagsinput {
  width: 69%;
}

.accordion {
  margin-bottom:-3px;
}

.accordion-group {
  border: none;
}

.twitter-typeahead .tt-query,
.twitter-typeahead .tt-hint {
  margin-bottom: 0;
}

.twitter-typeahead .tt-hint
{
  display: none;
}

.tt-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 160px;
  padding: 5px 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 14px;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
  cursor: pointer;
}

.tt-suggestion {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.428571429;
  color: #333333;
  white-space: nowrap;
}

.tt-suggestion:hover,
.tt-suggestion:focus {
color: #ffffff;
text-decoration: none;
outline: 0;
background-color: #428bca;
}



.container{
  margin: 20px;
}

/* autocomplete tagsinput*/
.label-info {
  background-color: #5bc0de;
  display: inline-block;
  padding: 0.2em 0.6em 0.3em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25em;
}
</style>

<!-- ---------------- stop tagsinput css -------------------- -->

  <form class="custom-validation" id="pressentertosubmitformdisable" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">



        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Itinerary Name
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($result['name']); ?>" required="">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Start Date </label>
            <input type="text" class="form-control reqfield" required="" name="startDate" id="startDate" value="<?php if ($_REQUEST['startDate'] != '' && $_REQUEST['startDate'] != '1970-01-01') {
                                                                                                                  echo date('d-m-Y', strtotime($_REQUEST['startDate']));
                                                                                                                } else {
                                                                                                                  if ($result['startDate'] != '') {
                                                                                                                    echo date('d-m-Y', strtotime($result['startDate']));
                                                                                                                  } else {
                                                                                                                    echo date('d-m-Y');
                                                                                                                  }
                                                                                                                } ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">End Date </label>
            <input type="text" class="form-control reqfield" required="" name="endDate" id="endDate" value="<?php if ($_REQUEST['endDate'] != '' && date('Y', strtotime($_REQUEST['startDate'])) > '1970') {
                                                                                                              echo date('d-m-Y', strtotime($_REQUEST['endDate']));
                                                                                                            } else {
                                                                                                              if ($result['endDate'] != '' &&  date('Y', strtotime($result['endDate'])) > 1970) {
                                                                                                                echo date('d-m-Y', strtotime($result['endDate']));
                                                                                                              } else {
                                                                                                                echo date('d-m-Y');
                                                                                                              }
                                                                                                            } ?>">
          </div>
        </div>

        <script>
          $(document).ready(function() {
            $("#startDate").datepicker({
              numberOfMonths: 2,
              dateFormat: 'dd-mm-yy',
              onSelect: function(selected) {
                $("#endDate").datepicker("option", "minDate", selected)
              }
            });
            $("#endDate").datepicker({
              dateFormat: 'dd-mm-yy',
              numberOfMonths: 2,
              onSelect: function(selected) {
                $("#startDate").datepicker("option", "maxDate", selected)
              }
            });
          });
        </script>

        <div class="col-md-2">
          <div class="form-group">
            <label for="validationCustom02">Adult</label>
            <input type="number" min="1" class="form-control reqfield" name="adult" value="<?php if ($_REQUEST['adult'] != '') {
                                                                                              echo $_REQUEST['adult'];
                                                                                            } else {
                                                                                              if ($result['adult'] < 1) {
                                                                                                echo '1';
                                                                                              } else {
                                                                                                echo $result['adult'];
                                                                                              }
                                                                                            }  ?>">
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label for="validationCustom02">Child</label>
            <input type="number" min="0" class="form-control" name="child" value="<?php if ($_REQUEST['child'] != '') {
                                                                                    echo $_REQUEST['child'];
                                                                                  } else {
                                                                                    echo $result['child'];
                                                                                  } ?>">
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Image
            </label>
            <input name="files[]" type="file" class="form-control reqfield" id="files" required="" multiple accept="image/png, image/gif, image/jpeg">
          </div>
  
          <div>
            <?php
            if (isset($_REQUEST['id'])) {
              while ($item = mysqli_fetch_array($rs2)) {
            ?>
                <div style="float:left;position:relative;margin:5px;" id="itineraryphoto100<?= $item['id'] ?>">
                  <span class="dropdown-item neweditpan" onclick="delete_single_itinerary_photo(<?= $item['id'] ?>);" style="cursor:pointer;position:absolute;right:-10px; top:-10px;z-index: 1;background-color: #c6e5f5;"><i class="fa fa-close" aria-hidden="true"></i></span>
                  <img src="package_image/<?php print_r($item['image_path']); ?>" alt="Snow" style="width:100px;height:100px;">
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
      
        <div class="col-md-8">
          <div class="form-group">
            <label for="validationCustom02">Destinations</label>
            <input type="text" class="form-control reqfield" name="destinations" placeholder="Enter comma separated destinations" value="<?php if ($_REQUEST['destination'] != '') {
                                                                                                                                            echo trim($_REQUEST['destination']);
                                                                                                                                          } else {
                                                                                                                                            echo stripslashes($result['destinations']);
                                                                                                                                          } ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Tagging</label>
            <input type="text" name="tagging" id="tag1" class="form-control" />
          </div>
        </div>
  

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Notes</label>
            <textarea name="notes" rows="2" class="form-control" placeholder="Notes"><?php echo stripslashes($result['notes']); ?></textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Location
            </label>
            <input name="location" type="text" class="form-control" id="name" value="<?php echo stripslashes($result['location']); ?>" required="">
          </div>
        </div>
        <div class="col-md-12">
              <div class="form-group">
                <label for="validationCustom02">Hotel
                </label>
                <select name="hotel" id="hotel" class="form-control">
                  <option value="0" <?php if ('0' == $result['hotel']) { ?>selected="selected" <?php } ?>>any</option>
                  <option value="1" <?php if ('1' == $result['hotel']) { ?>selected="selected" <?php } ?>>1 Star</option>
                  <option value="2" <?php if ('2' == $result['hotel']) { ?>selected="selected" <?php } ?>>2 Star</option>
                  <option value="3" <?php if ('3' == $result['hotel']) { ?>selected="selected" <?php } ?>>3 Star</option>
                  <option value="4" <?php if ('4' == $result['hotel']) { ?>selected="selected" <?php } ?>>4 Star</option>
                  <option value="5" <?php if ('5' == $result['hotel']) { ?>selected="selected" <?php } ?>>5 Star</option>
                </select>

              </div>
            </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description</label>
            <textarea name="description" rows="2" class="form-control" placeholder="Description"><?php echo stripslashes($result['description']); ?></textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Destination Type</label>
            <select name="destination_type" class="form-control">
              <option value="domestic" <?php if ('domestic' == $result['destination_type']) { ?>selected="selected" <?php } ?>>Domestic</option>
              <option value="international" <?php if ('international' == $result['destination_type']) { ?>selected="selected" <?php } ?>>International</option>
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Tour Type</label>
            <select name="tour_type" class="form-control">
              <option value="honeymoon" <?php if ('honeymoon' == $result['tour_type']) { ?>selected="selected" <?php } ?>>Honeymoon</option>
              <option value="family" <?php if ('family' == $result['tour_type']) { ?>selected="selected" <?php } ?>>Family</option>
              <option value="friends" <?php if ('friends' == $result['tour_type']) { ?>selected="selected" <?php } ?>>Friends</option>
              <option value="solo" <?php if ('solo' == $result['tour_type']) { ?>selected="selected" <?php } ?>>Solo</option>
              <option value="couple" <?php if ('couple' == $result['tour_type']) { ?>selected="selected" <?php } ?>>Couple</option>
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Activity Type</label>
            <select name="activity_type" class="form-control">
              <option value="adventure" <?php if ('adventure' == $result['activity_type']) { ?>selected="selected" <?php } ?>>Adventure</option>
              <option value="city" <?php if ('city' == $result['activity_type']) { ?>selected="selected" <?php } ?>>City</option>
              <option value="self_drive" <?php if ('self_drive' == $result['activity_type']) { ?>selected="selected" <?php } ?>>Self Drive</option>
              <option value="water_activities" <?php if ('water_activities' == $result['activity_type']) { ?>selected="selected" <?php } ?>>Water Activities</option>
              <option value="cultural" <?php if ('cultural' == $result['activity_type']) { ?>selected="selected" <?php } ?>>Cultural</option>
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Landscape Type</label>
            <select name="landscape_type" class="form-control">
              <option value="beach" <?php if ('beach' == $result['landscape_type']) { ?>selected="selected" <?php } ?>>Beach</option>
              <option value="mountain" <?php if ('mountain' == $result['landscape_type']) { ?>selected="selected" <?php } ?>>Mountain</option>
              <option value="city" <?php if ('city' == $result['landscape_type']) { ?>selected="selected" <?php } ?>>City</option>
              <option value="country_side" <?php if ('country_side' == $result['landscape_type']) { ?>selected="selected" <?php } ?>>Country Side</option>
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Publicly Visible</label>
            <select name="publicly_visible" class="form-control">
              <option value=1 <?php if (1 == $result['publicly_visible']) { ?>selected="selected" <?php } ?>>Yes</option>
              <option value=0 <?php if (0 == $result['publicly_visible'] && $result['publicly_visible']!="") { ?>selected="selected" <?php } ?>>No</option>
            </select>
          </div>
        </div>
        
        
        <div class="col-md-12">
          <div class="form-group">
            <label>Website Visible</label>
            <select name="website_visible" class="form-control">
              <option value=0 <?php if (0 == $result['website_visible']) { ?>selected="selected" <?php } ?>>No</option>
              <option value=1 <?php if (1 == $result['website_visible'] && $result['website_visible']!="") { ?>selected="selected" <?php } ?>>Yes</option>
            </select>
          </div>
        </div>

        <?php if ($withwebsite == 'yes') { ?>

          <?php if ($_REQUEST['fromquery'] != 1) { ?>

            <h5>Website Setting</h5>
            <hr />
            <div class="col-md-12">
              <div class="form-group">
                <label for="validationCustom02">Theme
                </label>
                <select name="packageThemeId" id="packageThemeId" class="form-control">
                  <?php

                  $rs = GetPageRecord('*', 'websitePackageTheme', ' status=1  order by name asc');
                  while ($rest = mysqli_fetch_array($rs)) {

                  ?>
                    <option value="<?php echo $rest['id']; ?>" <?php if ($rest['id'] == $result['packageThemeId']) { ?>selected="selected" <?php } ?>><?php echo $rest['name']; ?></option>
                  <?php } ?>
                </select>

              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="validationCustom02">Show on Website
                </label>
                <select name="showwebsite" id="showwebsite" class="form-control">
                  <option value="0" <?php if ('0' == $result['showwebsite']) { ?>selected="selected" <?php } ?>>No</option>
                  <option value="1" <?php if ('1' == $result['showwebsite']) { ?>selected="selected" <?php } ?>>Yes</option>
                </select>

              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="validationCustom02">Per Person Price
                </label>
                <input name="websiteCost" type="text" class="form-control reqfield" id="websiteCost" value="<?php echo stripslashes($result['websiteCost']); ?>">

              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="validationCustom02">Validity
                </label>
                <input name="websiteValidity" type="text" class="form-control reqfield" id="websiteValidity" value="<?php if ($_REQUEST['websiteValidity'] != '' && $_REQUEST['websiteValidity'] != '1970-01-01') {
                                                                                                                      echo date('d-m-Y', strtotime($_REQUEST['websiteValidity']));
                                                                                                                    } else {
                                                                                                                      if ($result['websiteValidity'] != '') {
                                                                                                                        echo date('d-m-Y', strtotime($result['websiteValidity']));
                                                                                                                      } else {
                                                                                                                        echo date('d-m-Y');
                                                                                                                      }
                                                                                                                    } ?>">

              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="validationCustom02">Popular
                </label>
                <select name="showinPopular" id="showinPopular" class="form-control">
                  <option value="0" <?php if ('0' == $result['showinPopular']) { ?>selected="selected" <?php } ?>>No</option>
                  <option value="1" <?php if ('1' == $result['showinPopular']) { ?>selected="selected" <?php } ?>>Yes</option>
                </select>

              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="validationCustom02">Special
                </label>
                <select name="showinSpecial" id="showinSpecial" class="form-control">
                  <option value="0" <?php if ('0' == $result['showinSpecial']) { ?>selected="selected" <?php } ?>>No</option>
                  <option value="1" <?php if ('1' == $result['showinSpecial']) { ?>selected="selected" <?php } ?>>Yes</option>
                </select>

              </div>
            </div>


            <div class="col-md-12">
              <div class="form-group">
                <label for="validationCustom02">Abount Package</label>
                <textarea name="aboutPackage" rows="3" class="form-control" placeholder=""><?php echo stripslashes($result['aboutPackage']); ?></textarea>
              </div>
            </div>

          <?php } ?>
        <?php } ?>

      </div>
    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addtineraries" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="queryid" type="hidden" id="queryid" value="<?php echo $_REQUEST['queryid']; ?>" />
  </form>

<!-- ---------------- start tagsinput js -------------------- -->

<script src='assets/js/typeahead.bundle.min.js'></script>
<script src='assets/js/bootstrap-tagsinput.min.js'></script>
<?php

$sql = "select * from  Tags order by name";
$rs_tags = mysqli_query(db(), $sql) or die(mysqli_error());
$tags_json= array();
while ($row = mysqli_fetch_array($rs_tags, MYSQLI_BOTH)) {
  $single["value"]=$row['id'];
  $single["text"]=$row['name'];
  $single["continent"]="";
  $tags_json[]=$single;
}

?>
  <script>
    
    var data = '<?php echo json_encode($tags_json); ?>';
console.log(data);
//var data =
//  '[{ "value": 1, "text": "Task 1", "continent": "Task" }, { "value": 2, "text": "Task 2", "continent": "Task" }, { "value": 3, "text": "Task 3", "continent": "Task" }, { "value": 4, "text": "Task 4", "continent": "Task" }, { "value": 5, "text": "Task 5", "continent": "Task" }, { "value": 6, "text": "Task 6", "continent": "Task" } ]';

  //get data pass to json
var task = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace("text"),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  local: jQuery.parseJSON(data) //your can use json type
});

task.initialize();

var elt = $("#tag1");
elt.tagsinput({
  itemValue: "value",
  itemText: "text",
  typeaheadjs: {
    name: "task",
    displayKey: "text",
    source: task.ttAdapter()
  }
});

</script>
<?php
 while ($t = mysqli_fetch_array($rs_tags_edit)) {
 ?>
<script>
//insert data to input in load page
elt.tagsinput("add", {
  value: <?php echo $t['id']; ?>,
  text: "<?php echo $t['name']; ?>",
  continent: ""
});
</script>

 <?php
}
?>

<!-- ---------------- stop tagsinput css -------------------- -->

<script>
$('#pressentertosubmitformdisable').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13 && e.target.name!='notes') { 
      e.preventDefault();
      return false;
  }
});
</script>

  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#websiteValidity").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>
<?php } ?>



<?php if ($_REQUEST['action'] == 'addcollection') {
  // $a = getAllRecord('*', 'sys_packageBuilder', 'order by id desc');
  // $result = mysqli_fetch_array($a);
  // print_r($result);
  // die();

  $a = GetPageRecord('*', 'Collection', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
  $result = mysqli_fetch_array($a);

  $sql = "select * from sys_packageBuilder where queryId=0 and publicly_visible=1 and queryId=0 and archiveThis=0 order by id desc ";
  $rs = mysqli_query(db(), $sql) or die(mysqli_error());
  // $row = mysqli_fetch_array($rs);



  if (isset($_REQUEST['id'])) {

    $sql = "select * from  Collection_image where collection_id=" . decode($_REQUEST['id']) . " order by id desc ";
    $rs2 = mysqli_query(db(), $sql) or die(mysqli_error());

    $sql = "select itinerary_id from  Collection_itineraries where collection_id=" . decode($_REQUEST['id']) . " order by id desc ";
    $rs3 = mysqli_query(db(), $sql) or die(mysqli_error());

    $sql = "select id from  Collection_itineraries where collection_id=" . decode($_REQUEST['id']) . " order by id desc ";
    $rs4 = mysqli_query(db(), $sql) or die(mysqli_error());

    $sql = "select * from Taggings ts, Tags t where t.id=ts.tags_id and ts.tagable_id=".decode($_REQUEST['id'])." and ts.taggable_type='collection' order by t.name";
    $rs_tags_edit = mysqli_query(db(), $sql) or die(mysqli_error());
      
    $collection_itineraries_array = array();
    while ($item2 = mysqli_fetch_array($rs3)) {
      $collection_itineraries_array[] = $item2[0];
    }
  }
?>

<!-- ---------------- start tagsinput css -------------------- -->

<link rel='stylesheet' href='assets/css/bootstrap-tagsinput.css'>
<style>
.icon-github {
  background: no-repeat url('../img/github-16px.png');
  width: 16px;
  height: 16px;
}

.bootstrap-tagsinput {
  width: 69%;
}

.accordion {
  margin-bottom:-3px;
}

.accordion-group {
  border: none;
}

.twitter-typeahead .tt-query,
.twitter-typeahead .tt-hint {
  margin-bottom: 0;
}

.twitter-typeahead .tt-hint
{
  display: none;
}

.tt-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 160px;
  padding: 5px 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 14px;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
  cursor: pointer;
}

.tt-suggestion {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.428571429;
  color: #333333;
  white-space: nowrap;
}

.tt-suggestion:hover,
.tt-suggestion:focus {
color: #ffffff;
text-decoration: none;
outline: 0;
background-color: #428bca;
}



.container{
  margin: 20px;
}

/* autocomplete tagsinput*/
.label-info {
  background-color: #5bc0de;
  display: inline-block;
  padding: 0.2em 0.6em 0.3em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25em;
}
</style>

<!-- ---------------- stop tagsinput css -------------------- -->

<form class="custom-validation" id="pressentertosubmitformdisable" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Collection Name
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($result['name']);
                                                                                          ?>" required>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Location
            </label>
            <input name="location" type="text" class="form-control reqfield" id="location" value="<?php echo stripslashes($result['location']);
                                                                                                  ?>" required>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Image
            </label>
            <input name="files[]" type="file" class="form-control reqfield" id="files" required="" multiple accept="image/png, image/gif, image/jpeg">
          </div>
  
          <div>
            <?php
            if (isset($_REQUEST['id'])) {
              while ($item = mysqli_fetch_array($rs2)) {
            ?>
                <div style="float:left;position:relative;margin:5px;" id="collectionphoto100<?= $item['id'] ?>">
                  <span class="dropdown-item neweditpan" onclick="delete_single_photo(<?= $item['id'] ?>);" style="cursor:pointer;position:absolute;right:-10px; top:-10px;z-index: 1;background-color: #c6e5f5;"><i class="fa fa-close" aria-hidden="true"></i></span>
                  <img src="collectionphotos/<?php print_r($item['image_path']); ?>" alt="Snow" style="width:100px;height:100px;">
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Tagging</label>
            <input type="text" name="tagging" id="tag1" class="form-control" />
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description</label>
            <textarea name='description' rows="2" class="form-control" placeholder="Description"><?php echo stripslashes($result['description']);
                                                                                                  ?></textarea>
          </div>
        </div>
  
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Itinerary</label>
            <select id="itinerary" name="itinerary[]" multiple="multiple" class="form-control" style="height: 200px;">
              <?php
              while ($row = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                if (in_array($row['id'], $collection_itineraries_array)) {
                  echo '<option selected value="' . $row['id'] . '">' . $row['name'] . '</option>';
                } else {
                  echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
              }

              ?>
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Destination Type</label>
            <select name="destination_type" class="form-control">
              <option value="domestic" <?php if ('domestic' == $result['destination_type']) { ?>selected="selected" <?php } ?>>Domestic</option>
              <option value="international" <?php if ('international' == $result['destination_type']) { ?>selected="selected" <?php } ?>>International</option>
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Location Type</label>
            <select name="location_type" class="form-control">
              <option value="region" <?php if ('region' == $result['location_type']) { ?>selected="selected" <?php } ?>>Region</option>
              <option value="country" <?php if ('country' == $result['location_type']) { ?>selected="selected" <?php } ?>>Country</option>
              <option value="state" <?php if ('state' == $result['location_type']) { ?>selected="selected" <?php } ?>>State</option>
              <option value="city" <?php if ('city' == $result['location_type']) { ?>selected="selected" <?php } ?>>City</option>
              <option value="place" <?php if ('place' == $result['location_type']) { ?>selected="selected" <?php } ?>>Place</option>
            </select>
          </div>
        </div>

      
      </div>
    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addcollection" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />

  </form>

<!-- ---------------- start tagsinput js -------------------- -->

<script src='assets/js/typeahead.bundle.min.js'></script>
<script src='assets/js/bootstrap-tagsinput.min.js'></script>
<?php

$sql = "select * from  Tags order by name";
$rs_tags = mysqli_query(db(), $sql) or die(mysqli_error());
$tags_json= array();
while ($row = mysqli_fetch_array($rs_tags, MYSQLI_BOTH)) {
  $single["value"]=$row['id'];
  $single["text"]=$row['name'];
  $single["continent"]="";
  $tags_json[]=$single;
}

?>
  <script>
    
    var data = '<?php echo json_encode($tags_json); ?>';
console.log(data);
//var data =
//  '[{ "value": 1, "text": "Task 1", "continent": "Task" }, { "value": 2, "text": "Task 2", "continent": "Task" }, { "value": 3, "text": "Task 3", "continent": "Task" }, { "value": 4, "text": "Task 4", "continent": "Task" }, { "value": 5, "text": "Task 5", "continent": "Task" }, { "value": 6, "text": "Task 6", "continent": "Task" } ]';

  //get data pass to json
var task = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace("text"),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  local: jQuery.parseJSON(data) //your can use json type
});

task.initialize();

var elt = $("#tag1");
elt.tagsinput({
  itemValue: "value",
  itemText: "text",
  typeaheadjs: {
    name: "task",
    displayKey: "text",
    source: task.ttAdapter()
  }
});

</script>
<?php
 while ($t = mysqli_fetch_array($rs_tags_edit)) {
 ?>
<script>
//insert data to input in load page
elt.tagsinput("add", {
  value: <?php echo $t['id']; ?>,
  text: "<?php echo $t['name']; ?>",
  continent: ""
});
</script>

 <?php
}
?>

<!-- ---------------- stop tagsinput css -------------------- -->

<script>
$('#pressentertosubmitformdisable').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13 && e.target.name!='description') { 
      e.preventDefault();
      return false;
  }
});
</script>

<?php } ?>




<?php if ($_REQUEST['action'] == 'addtaggings') {
  // $a = getAllRecord('*', 'sys_packageBuilder', 'order by id desc');
  // $result = mysqli_fetch_array($a);
  // print_r($result);
  // die();

  $a = GetPageRecord('*', 'Tags', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
  $result = mysqli_fetch_array($a);

  $sql = "select * from  Tag_type order by name";
  $rs = mysqli_query(db(), $sql) or die(mysqli_error());


?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Tags Name
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($result['name']); ?>" required>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Tag Type</label>

            <input list="browsers" name="type" class="form-control reqfield" value="<?php echo stripslashes($result['type']); ?>" required autocomplete="off" /></label>
            <datalist id="browsers">
              <?php
              while ($row = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                echo '<option>' . $row['name'] . '</option>';
              }
              ?>
            </datalist>
          </div>
        </div>


      </div>
    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addtaggings" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />

  </form>



<?php } ?>




<?php if ($_REQUEST['action'] == 'confirmitineararies' && $_REQUEST['id'] != '') {

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12" style="text-align:center;">
          <h4>You are about to confirm an itinerary</h4>

          This action cannot be undone.
        </div>



      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-success waves-effect waves-light">Confirm itinerary</button>
    </div>

    <input name="action" type="hidden" id="action" value="confirmitineararies" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="queryid" type="hidden" id="queryid" value="<?php echo $_REQUEST['queryid']; ?>" />
  </form>



<?php } ?>


<?php if ($_REQUEST['action'] == 'confirmtask' && $_REQUEST['id'] != '' && $_REQUEST['qid'] != '') {

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12" style="text-align:center;">
          <h4>You are about to confirm an task</h4>

          This action cannot be undone.
        </div>



      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-success waves-effect waves-light">Confirm</button>
    </div>

    <input name="action" type="hidden" id="action" value="confirmtask" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="qid" type="hidden" id="qid" value="<?php echo $_REQUEST['qid']; ?>" />
  </form>



<?php } ?>





<?php if ($_REQUEST['action'] == 'addAccommodation' && $_REQUEST['pid'] != '' && $_REQUEST['d'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
    $result = mysqli_fetch_array($a);
  }

  $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '" order by id desc');
  $resultdest = mysqli_fetch_array($a);



?>
  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Destination
            </label>
            <select name="destinationName" id="destinationName" class="form-control" onchange="loadhotel();" <?php if ($_REQUEST['loaddestinationidload'] != '') { ?> style="pointer-events: none;" <?php } ?>>
              <option value="">Select</option>
              <?php foreach (explode(',', $resultdest['destinations']) as $val) { ?>
                <option value="<?php echo trim($val); ?>" <?php if ($_REQUEST['loaddestinationidload'] == trim($val)) { ?>selected="selected" <?php } ?>><?php echo $val; ?></option>
              <?php } ?>
            </select>

          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Type</label>
            <select name="pricetype" id="pricetype" class="form-control" onchange="changepricetype();" <?php if ($_REQUEST['eventobjectid'] > 0) { ?> style="pointer-events: none;" <?php } ?>>
              <option value="1" <?php if ($result['hotelType'] == 1) { ?> selected="selected" <?php } ?>>Manual</option>
              <option value="2" <?php if ($result['hotelType'] == 2 || $_REQUEST['auto'] == 1) { ?> selected="selected" <?php } ?>>From Master</option>
            </select>
          </div>
        </div>
        <div class="col-md-12 manual">
          <div class="form-group">
            <label for="validationCustom02">Hotel Name
            </label>
            <input name="hotelName" type="text" id="hotelName" class="form-control" value="<?php echo stripslashes($result['name']); ?>" required="">
          </div>
        </div>

        <div class="col-md-12 master" style="display:none;">
          <div id="loadhoteldata" style="display:none;"></div>
          <div class="form-group">
            <label for="validationCustom02">Hotel Name
            </label>
            <select name="hotelnamemaster" id="hotelnamemaster" class="form-control" onchange="loadhoteldata();">
              <?php $n = 0;
              $a = GetPageRecord('*', 'hotelMaster', 'status=1');
              while ($resulthot = mysqli_fetch_array($a)) { ?>
                <option value="<?php echo strip($resulthot['id']); ?>" <?php if ($resulthot['name'] == $result['name']) { ?> selected="selected" <?php } ?>><?php echo strip($resulthot['name']); ?></option>
              <?php } ?>
            </select>
            <input type="hidden" name="hotelPriceId" id="hotelPriceId" value="0" />

          </div>
        </div>
        <script>
          function loadhotel() {
            var destinationName = encodeURI($('#destinationName').val());

            $('#hotelnamemaster').load('loadhotel.php?destinationName=' + destinationName + '&eventobjectid=<?php echo $_REQUEST['eventobjectid']; ?>');
          }


          <?php if ($_REQUEST['auto'] == 1) { ?>
            setTimeout(function() {
              changepricetype();
              loadhotel();
            }, 100);
          <?php } ?>
        </script>

        <script type="text/javascript">
          $(function() {

            // Single Select
            $("#hotelName").autocomplete({
              source: function(request, response) {
                // Fetch data
                $.ajax({
                  url: "ajax-city-search.php",
                  type: 'post',
                  dataType: "json",
                  data: {
                    search: request.term,
                    sectionType: 'Accommodation'
                  },
                  success: function(data) {
                    response(data);
                  }
                });
              },
              select: function(event, ui) {
                $('#hotelName').val(ui.item.label); // display the selected text 
                return false;
              }
            });


          });
        </script>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Category
            </label>
            <select name="hotelCategory" id="hotelCategory" class="form-control">
              <option value="1" <?php if ($result['hotelCategory'] == 1) { ?>selected="selected" <?php } ?>>1 Star</option>
              <option value="2" <?php if ($result['hotelCategory'] == 2) { ?>selected="selected" <?php } ?>>2 Star</option>
              <option value="3" <?php if ($result['hotelCategory'] == 3) { ?>selected="selected" <?php } ?>>3 Star</option>
              <option value="4" <?php if ($result['hotelCategory'] == 4) { ?>selected="selected" <?php } ?>>4 Star</option>
              <option value="5" <?php if ($result['hotelCategory'] == 5) { ?>selected="selected" <?php } ?>>5 Star</option>
            </select>
          </div>
        </div>

        <div class="col-md-6 master" style="display:none;">
          <div class="form-group">
            <label for="validationCustom02">Room Name</label>
            <select name="hotelRoommaster" id="hotelRoommaster" class="form-control" onchange="getroomname();getprice();">
              <?php $a = GetPageRecord('*', 'RoomTypeMaster', ' id in (select roomType from hotelRateList where hotelId in (select id from hotelMaster where name="' . $result['name'] . '"))');
              while ($resulthot = mysqli_fetch_array($a)) { ?>
                <option value="<?php echo strip($resulthot['name']); ?>" <?php if ($resulthot['name'] == $result['hotelRoom']) { ?> selected="selected" <?Php } ?>><?php echo strip($resulthot['name']); ?></option>
              <?php } ?>
            </select>
          </div>
        </div>


        <div class="col-md-6 manual">
          <div class="form-group">
            <label for="validationCustom02">Room Name
            </label>
            <input name="hotelRoom" id="hotelRoommanual" type="text" class="form-control" value="<?php echo stripslashes($result['hotelRoom']); ?>" required="">

            <script type="text/javascript">
              $(function() {

                // Single Select
                $("#hotelRoom").autocomplete({
                  source: function(request, response) {
                    // Fetch data
                    $.ajax({
                      url: "ajax-city-search.php",
                      type: 'post',
                      dataType: "json",
                      data: {
                        search: request.term,
                        room: 'roomhotel'
                      },
                      success: function(data) {
                        response(data);
                      }
                    });
                  },
                  select: function(event, ui) {
                    $('#hotelRoom').val(ui.item.label); // display the selected text 
                    return false;
                  }
                });


              });
            </script>
          </div>
        </div>
        <script>
          function getroomname() {
            $('#hotelRoommanual').val($('#hotelRoommaster').val());
          }
        </script>
        <div class="col-md-6 master" style="display:none;">
          <div class="form-group">
            <label for="validationCustom02">Meal Plan <?php echo $data['mealPlan']; ?></label>
            <select name="mealPlanmaster" id="mealPlanmaster" class="form-control" onchange="getmealname();getprice();">
              <?php $a = GetPageRecord('*', 'mealPlanMaster', ' id in (select mealPlan from hotelRateList where hotelId in (select id from hotelMaster where name="' . $result['name'] . '"))');
              while ($resulthot = mysqli_fetch_array($a)) { ?>
                <option value="<?php echo strip($resulthot['name']); ?>" <?php if ($resulthot['name'] == $result['mealPlan']) { ?> selected="selected" <?Php } ?>><?php echo strip($resulthot['name']); ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-6 manual">
          <div class="form-group">
            <label for="validationCustom02">Meal Plan
            </label>
            <input name="mealPlan" id="mealPlan" type="text" class="form-control manual" value="<?php echo stripslashes($result['mealPlan']); ?>">
            <script type="text/javascript">
              $(function() {

                // Single Select
                $("#mealPlan").autocomplete({
                  source: function(request, response) {
                    // Fetch data
                    $.ajax({
                      url: "ajax-city-search.php",
                      type: 'post',
                      dataType: "json",
                      data: {
                        search: request.term,
                        mealPlan: 'mealPlan'
                      },
                      success: function(data) {
                        response(data);
                      }
                    });
                  },
                  select: function(event, ui) {
                    $('#mealPlan').val(ui.item.label); // display the selected text 
                    return false;
                  }
                });


              });

              function changepricetype() {

                var pricetype = $('#pricetype').val();
                if (pricetype == 1) {
                  $('.manual').show();
                  $('.master').hide();
                }

                if (pricetype == 2) {
                  $('.manual').hide();
                  $('.master').show();
                }

              }
            </script>
          </div>
        </div>
        <script>
          function getmealname() {
            $('#mealPlan').val($('#mealPlanmaster').val());
          }
        </script>
        <script>
          function loadhoteldata() {

            var hotelnamemaster = $('#hotelnamemaster').val();
            var hotelRoommaster = encodeURI($('#hotelRoommaster').val());
            var mealPlanmaster = encodeURI($('#mealPlanmaster').val());

            $('#loadhoteldata').load('loadhoteldata.php?day=<?php echo $_REQUEST['d']; ?>&hotelnamemaster=' + hotelnamemaster + '&hotelRoommaster=' + hotelRoommaster + '&mealPlanmaster=' + mealPlanmaster);
            $.get('loadhoteldata.php?day=<?php echo $_REQUEST['d']; ?>&hotelnamemaster=' + hotelnamemaster, function(content) {
              // if you have one tinyMCE box on the page:
              tinyMCE.activeEditor.setContent(content);
            });

            <?php if ($result['id'] == '') { ?>

              $('#hotelCategory').load('loadhotelCategory.php?day=<?php echo $_REQUEST['d']; ?>&hotelnamemaster=' + hotelnamemaster);
              $('#hotelRoommaster').load('loadhotelRoomCategory.php?day=<?php echo $_REQUEST['d']; ?>&hotelnamemaster=' + hotelnamemaster);
              $('#mealPlanmaster').load('loadhotelMeal.php?day=<?php echo $_REQUEST['d']; ?>&hotelnamemaster=' + hotelnamemaster);

            <?php } ?>
          }

          function getprice() {
            var hotelnamemaster = $('#hotelnamemaster').val();
            var hotelRoommaster = encodeURI($('#hotelRoommaster').val());
            var mealPlanmaster = encodeURI($('#mealPlanmaster').val());

            $('#loadhoteldata').load('loadhoteldata.php?day=<?php echo $_REQUEST['d']; ?>&hotelnamemaster=' + hotelnamemaster + '&hotelRoommaster=' + hotelRoommaster + '&mealPlanmaster=' + mealPlanmaster);
          }
        </script>
        <div class="row" style="background:#f7f7f7;  padding: 10px; width: 100%; margin: auto; border: 1px solid #cccccc; margin: 10px 10px; border-radius: 4px;">
          <div style="margin-bottom:10px; width:100%;    padding-left: 10px;"><strong>Enter Number of Rooms</strong></div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="validationCustom02">Single
              </label>
              <input name="singleRoom" type="Number" min="0" class="form-control" value="<?php echo stripslashes($result['singleRoom']); ?>">
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="validationCustom02">Double
              </label>
              <input name="doubleRoom" type="Number" min="0" class="form-control" value="<?php if ($result['doubleRoom'] == '') {
                                                                                            echo '1';
                                                                                          }
                                                                                          echo stripslashes($result['doubleRoom']); ?>">
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="validationCustom02">Triple
              </label>
              <input name="tripleRoom" type="Number" min="0" class="form-control" value="<?php echo stripslashes($result['tripleRoom']); ?>">
            </div>
          </div>



          <div class="col-md-2">
            <div class="form-group">
              <label for="validationCustom02">Quad
              </label>
              <input name="quadRoom" type="Number" min="0" class="form-control" value="<?php echo stripslashes($result['quadRoom']); ?>">
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="validationCustom02">CWB
              </label>
              <input name="cwbRoom" type="Number" min="0" class="form-control" value="<?php echo stripslashes($result['cwbRoom']); ?>">
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="validationCustom02">CNB
              </label>
              <input name="cnbRoom" type="Number" min="0" class="form-control" value="<?php echo stripslashes($result['cnbRoom']); ?>">
            </div>
          </div>
        </div>


        <div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
          <div class="col-md-6">
            <div class="form-group">
              <label for="validationCustom02">Check-in date* </label>
              <input type="text" class="form-control" required="" name="startDate" id="startDate" value="<?php echo date('d-m-Y', strtotime($_REQUEST['d']));  ?>">
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="validationCustom02">Check-in time</label>


              <select name="checkIn" class="form-control" autocomplete="off">
                <?php
                if ($result['checkIn'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkIn']));
                } else {
                  $selectedtime = date('Y-m-d 14:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>

            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label for="validationCustom02">Check-out date*</label>
              <input type="text" class="form-control" required="" name="endDate" id="endDate" value="<?php if ($result['endDate'] != '') {
                                                                                                        echo date('d-m-Y', strtotime($result['endDate']));
                                                                                                      } else {
                                                                                                        echo date('d-m-Y', strtotime($_REQUEST['d']));
                                                                                                      } ?>">



            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="validationCustom02">Check-out time</label>
              <select name="checkOut" class="form-control" autocomplete="off">
                <?php
                if ($result['checkOut'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkOut']));
                } else {
                  $selectedtime = date('Y-m-d 11:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group">
              <table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td colspan="2"><input type="checkbox" name="showTime" class="stip1" value="1" style="width: 19px; height: 22px;" <?php if ($result['showTime'] == 1) { ?>checked="checked" <?php } ?>></td>
                  <td>&nbsp;Show Time </td>
                </tr>
              </table>

            </div>
          </div>

        </div>



        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description
            </label>
            <textarea name="description" id="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">
      <?php if ($_REQUEST['id'] != '') { ?>
        <button type="button" class="btn btn-danger waves-effect waves-light" style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
      <?php } ?>

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="addAccommodation" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
    <input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
  </form>


  <script>
    function dlt(id, pid) {
      if (confirm('Are you sure your want to delete?')) {
        $('#ActionDiv').load('actionpage.php?did=' + id + '&action=delteevent&pid=' + pid);
      }

    }


    $(function() {

      $('#startDate').datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
          $(this).datepicker('option', 'maxDate', $('#endDate').val());
        }
      });
      $('#endDate').datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
          $(this).datepicker('option', 'minDate', $('#startDate').val());
          if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);
        }
      });

    });
  </script>
  <?php if ($result['hotelType'] == 2) { ?> <script>
      changepricetype();
      loadhoteldata();
    </script> <?php }
          } ?>




<?php if ($_REQUEST['action'] == 'addActivity' && $_REQUEST['pid'] != '' && $_REQUEST['d'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
    $result = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">




        <?php
        $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '" order by id desc');
        $resultdest = mysqli_fetch_array($a);
        ?>
        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Destination
            </label>

            <select name="destinationName" id="destinationName" class="form-control" onchange="loadhotel();" <?php if ($_REQUEST['loaddestinationidload'] != '') { ?> style="pointer-events: none;" <?php } ?>>
              <option value="">Select</option>
              <?php foreach (explode(',', $resultdest['destinations']) as $val) { ?>
                <option value="<?php echo trim($val); ?>" <?php if ($_REQUEST['loaddestinationidload'] == trim($val)) { ?>selected="selected" <?php } ?>><?php echo $val; ?></option>
              <?php } ?>
            </select>


            <script>
              function loadhotel() {
                var destinationName = encodeURI($('#destinationName').val());

                $('#namemaster').load('loadactivity.php?destinationName=' + destinationName + '&eventobjectid=<?php echo $_REQUEST['eventobjectid']; ?>');
              }
            </script>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Type</label>



            <select name="pricetype" id="pricetype" class="form-control" onchange="changepricetype();" <?php if ($_REQUEST['eventobjectid'] > 0) { ?> style="pointer-events: none;" <?php } ?>>
              <option value="1" <?php if ($result['hotelType'] == 1) { ?> selected="selected" <?php } ?>>Manual</option>
              <option value="2" <?php if ($result['hotelType'] == 2 || $_REQUEST['auto'] == 1) { ?> selected="selected" <?php } ?>>From Master</option>
            </select>

          </div>
        </div>

        <div class="col-md-12 manual">
          <div class="form-group">
            <label for="validationCustom02">Name
            </label>
            <input name="name" type="text" class="form-control" id="servicename" value="<?php echo stripslashes($result['name']); ?>" required="">
            <script type="text/javascript">
              <?php if ($_REQUEST['auto'] == 1) { ?>
                setTimeout(function() {
                  changepricetype();
                  loadhotel();
                }, 100);
              <?php } ?>

              $(function() {

                // Single Select
                $("#servicename").autocomplete({
                  source: function(request, response) {
                    // Fetch data
                    $.ajax({
                      url: "ajax-city-search.php",
                      type: 'post',
                      dataType: "json",
                      data: {
                        search: request.term,
                        sectionType: 'Activity'
                      },
                      success: function(data) {
                        response(data);
                      }
                    });
                  },
                  select: function(event, ui) {
                    $('#servicename').val(ui.item.label); // display the selected text 
                    return false;
                  }
                });


              });
            </script>
          </div>
        </div>


        <div class="col-md-12 master" style="display:none;">
          <div class="form-group">
            <label for="validationCustom02">Name </label>
            <select name="namemaster" id="namemaster" class="form-control" onchange="loadhoteldata();">
              <option value="">Select</option>
              <?php $n = 0;
              $a = GetPageRecord('*', 'sightseeingMaster', ' status=1 and destination in (select id from cityMaster where name="' . trim($_REQUEST['loaddestinationidload']) . '" and status=1) ');
              while ($resulthot = mysqli_fetch_array($a)) { ?>
                <option value="<?php echo strip($resulthot['id']); ?>" <?php if ($resulthot['name'] == $result['name']) { ?> selected="selected" <?php } ?>><?php echo strip($resulthot['name']); ?></option>
              <?php } ?>
            </select>
            <input type="hidden" name="hotelPriceId" id="hotelPriceId" value="0" />
            <div id="loadsightdata" style="display:none;"></div>
            <script>
              function loadhoteldata() {
                var namemaster = $('#namemaster').val();

                $('#loadsightdata').load('loadsightseeingdata.php?day=<?php echo $_REQUEST['d']; ?>&namemaster=' + namemaster);
                $.get('loadsightseeingdata.php?day=<?php echo $_REQUEST['d']; ?>&namemaster=' + namemaster, function(content) {
                  // if you have one tinyMCE box on the page:
                  tinyMCE.activeEditor.setContent(content);
                });


              }

              function changepricetype() {

                var pricetype = $('#pricetype').val();
                if (pricetype == 1) {
                  $('.manual').show();
                  $('.master').hide();
                }

                if (pricetype == 2) {
                  $('.manual').hide();
                  $('.master').show();
                }

              }
            </script>
          </div>
        </div>



        <div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Date* </label>
              <input type="text" class="form-control" required="" name="startDate" id="startDate" value="<?php echo date('d-m-Y', strtotime($_REQUEST['d']));  ?>">
            </div>
          </div>


          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Start time</label>
              <select name="checkIn" class="form-control" autocomplete="off">
                <?php $thisday = date('Y-m-d'); ?>
                <?php
                if ($result['checkIn'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkIn']));
                } else {
                  $selectedtime = date('Y-m-d 13:00:00');
                }

                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">End time</label>
              <select name="checkOut" class="form-control" autocomplete="off">
                <?php $thisday = date('Y-m-d'); ?>
                <?php
                if ($result['checkOut'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkOut']));
                } else {
                  $selectedtime = date('Y-m-d 14:00:00');
                }
                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group">
              <table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td colspan="2"><input type="checkbox" name="showTime" class="stip1" value="1" style="width: 19px; height: 22px;" <?php if ($result['showTime'] == 1) { ?>checked="checked" <?php } ?>></td>
                  <td>&nbsp;Show Time </td>
                </tr>
              </table>

            </div>
          </div>

        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description
            </label>
            <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">
      <?php if ($_REQUEST['id'] != '') { ?>
        <button type="button" class="btn btn-danger waves-effect waves-light" style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
      <?php } ?>

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="addActivity" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
    <input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
  </form>

  <?php if ($result['hotelType'] == 2) { ?> <script>
      changepricetype();
      loadhoteldata();
    </script> <?php } ?>
  <script>
    function dlt(id, pid) {
      if (confirm('Are you sure your want to delete?')) {
        $('#ActionDiv').load('actionpage.php?did=' + id + '&action=delteevent&pid=' + pid);
      }

    }


    $(function() {

      $('#startDate').datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
          $(this).datepicker('option', 'maxDate', $('#endDate').val());
        }
      });
      $('#endDate').datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
          $(this).datepicker('option', 'minDate', $('#startDate').val());
          if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);
        }
      });

    });
  </script>
<?php } ?>




<?php if ($_REQUEST['action'] == 'addTransportation' && $_REQUEST['pid'] != '' && $_REQUEST['d'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
    $result = mysqli_fetch_array($a);
  }

  $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '" order by id desc');
  $resultdest = mysqli_fetch_array($a);
?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Destination
            </label>



            <select name="destinationName" id="destinationName" class="form-control" onchange="loadhotel();" <?php if ($_REQUEST['loaddestinationidload'] != '') { ?> style="pointer-events: none;" <?php } ?>>
              <option value="">Select</option>
              <?php foreach (explode(',', $resultdest['destinations']) as $val) { ?>
                <option value="<?php echo trim($val); ?>" <?php if ($_REQUEST['loaddestinationidload'] == trim($val)) { ?>selected="selected" <?php } ?>><?php echo $val; ?></option>
              <?php } ?>
            </select>
            <script>
              function loadhotel() {
                var destinationName = encodeURI($('#destinationName').val());

                $('#namemaster').load('loadtransfer.php?destinationName=' + destinationName + '&eventobjectid=<?php echo $_REQUEST['eventobjectid']; ?>');
              }
            </script>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Type</label>

            <select name="pricetype" id="pricetype" class="form-control" onchange="changepricetype();" <?php if ($_REQUEST['eventobjectid'] > 0) { ?> style="pointer-events: none;" <?php } ?>>
              <option value="1" <?php if ($result['hotelType'] == 1) { ?> selected="selected" <?php } ?>>Manual</option>
              <option value="2" <?php if ($result['hotelType'] == 2 || $_REQUEST['auto'] == 1) { ?> selected="selected" <?php } ?>>From Master</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Transfer Type
            </label>
            <select name="transferCategory" id="transferCategory" class="form-control">
              <option value="Private" <?php if ($result['transferCategory'] == 'Private') { ?>selected="selected" <?php } ?>>Private</option>
              <option value="SIC" <?php if ($result['transferCategory'] == 'SIC') { ?>selected="selected" <?php } ?>>SIC</option>
            </select>
          </div>
        </div>


        <div class="col-md-6 manual">
          <div class="form-group">
            <label for="validationCustom02">Name
            </label>
            <input name="name" type="text" class="form-control" id="servicename" value="<?php echo stripslashes($result['name']); ?>" required="">

            <script type="text/javascript">
              $(function() {

                // Single Select
                $("#servicename").autocomplete({
                  source: function(request, response) {
                    // Fetch data
                    $.ajax({
                      url: "ajax-city-search.php",
                      type: 'post',
                      dataType: "json",
                      data: {
                        search: request.term,
                        sectionType: 'Transportation'
                      },
                      success: function(data) {
                        response(data);
                      }
                    });
                  },
                  select: function(event, ui) {
                    $('#servicename').val(ui.item.label); // display the selected text 
                    return false;
                  }
                });


              });
            </script>
          </div>
        </div>

        <div class="col-md-6 master" style="display:none;">
          <div id="loadhoteldata" style="display:none;"></div>
          <div class="form-group">
            <label for="validationCustom02">Name
            </label>
            <select name="namemaster" id="namemaster" class="form-control" onchange="loadhoteldata();">
              <option value="">Select</option>
              <?php $n = 0;
              $a = GetPageRecord('*', 'transferMaster', 'status=1');
              while ($resulthot = mysqli_fetch_array($a)) { ?>
                <option value="<?php echo strip($resulthot['id']); ?>" <?php if ($resulthot['name'] == $result['name']) { ?> selected="selected" <?php } ?>><?php echo strip($resulthot['name']); ?></option>
              <?php } ?>
            </select>
            <input type="hidden" name="hotelPriceId" id="hotelPriceId" value="0" />
            <script>
              function loadhoteldata() {
                var namemaster = $('#namemaster').val();
                var transferCategory = $('#transferCategory').val();
                if (namemaster > 0) {
                  $('#loadhoteldata').load('loadtransferdata.php?day=<?php echo $_REQUEST['d']; ?>&namemaster=' + namemaster + '&transferCategory=' + transferCategory);
                  $.get('loadtransferdata.php?day=<?php echo $_REQUEST['d']; ?>&namemaster=' + namemaster + '&transferCategory=' + transferCategory, function(content) {
                    // if you have one tinyMCE box on the page:
                    tinyMCE.activeEditor.setContent(content);
                  });
                }
              }


              <?php if ($_REQUEST['auto'] == 1) { ?>
                setTimeout(function() {
                  changepricetype();
                  loadhotel();
                }, 100);
              <?php } ?>
            </script>
          </div>
        </div>


        <script>
          function changepricetype() {

            var pricetype = $('#pricetype').val();
            if (pricetype == 1) {
              $('.manual').show();
              $('.master').hide();
            }

            if (pricetype == 2) {
              $('.manual').hide();
              $('.master').show();
            }

          }
        </script>
        <div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Date* </label>
              <input type="text" class="form-control" required="" name="startDate" id="startDate" value="<?php echo date('d-m-Y', strtotime($_REQUEST['d']));  ?>">
            </div>
          </div>


          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Start time</label>
              <select name="checkIn" class="form-control" autocomplete="off">
                <option value="00:00">00:00</option>
                <?php
                if ($result['checkIn'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkIn']));
                } else {
                  $selectedtime = date('Y-m-d 13:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">End time</label>
              <select name="checkOut" class="form-control" autocomplete="off">
                <option value="00:00">00:00</option>
                <?php
                if ($result['checkOut'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkOut']));
                } else {
                  $selectedtime = date('Y-m-d 14:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group">
              <table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td colspan="2"><input type="checkbox" name="showTime" class="stip1" value="1" style="width: 19px; height: 22px;" <?php if ($result['showTime'] == 1) { ?>checked="checked" <?php } ?>></td>
                  <td>&nbsp;Show Time </td>
                </tr>
              </table>

            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description
            </label>
            <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">
      <?php if ($_REQUEST['id'] != '') { ?>
        <button type="button" class="btn btn-danger waves-effect waves-light" style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
      <?php } ?>

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="addTransportation" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
    <input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
    <input name="day" type="hidden" id="day" value="<?php echo $_REQUEST['d']; ?>" />
  </form>
  <?php if ($_REQUEST['id'] != '') { ?>
    <script>
      changepricetype();
      loadhoteldata();
    </script>
  <?php } ?>

  <script>
    function dlt(id, pid) {
      if (confirm('Are you sure your want to delete?')) {
        $('#ActionDiv').load('actionpage.php?did=' + id + '&action=delteevent&pid=' + pid);
      }

    }


    $(function() {

      $('#startDate').datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
          $(this).datepicker('option', 'maxDate', $('#endDate').val());
        }
      });
      $('#endDate').datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
          $(this).datepicker('option', 'minDate', $('#startDate').val());
          if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);
        }
      });

    });
  </script>
<?php } ?>



<?php if ($_REQUEST['action'] == 'addFeesInsurance' && $_REQUEST['pid'] != '' && $_REQUEST['d'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
    $result = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Name
            </label>
            <input name="name" type="text" class="form-control" id="servicename" value="<?php echo stripslashes($result['name']); ?>" required="">
            <script type="text/javascript">
              $(function() {

                // Single Select
                $("#servicename").autocomplete({
                  source: function(request, response) {
                    // Fetch data
                    $.ajax({
                      url: "ajax-city-search.php",
                      type: 'post',
                      dataType: "json",
                      data: {
                        search: request.term,
                        sectionType: 'FeesInsurance'
                      },
                      success: function(data) {
                        response(data);
                      }
                    });
                  },
                  select: function(event, ui) {
                    $('#servicename').val(ui.item.label); // display the selected text 
                    return false;
                  }
                });


              });
            </script>
          </div>
        </div>

        <?php
        $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '" order by id desc');
        $resultdest = mysqli_fetch_array($a);
        ?>
        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Destination
            </label>
            <select name="destinationName" class="form-control">
              <?php foreach (explode(',', $resultdest['destinations']) as $val) { ?>
                <option value="<?php echo $val; ?>" <?php if ($result['destinationName'] == $val) { ?>selected="selected" <?php } ?>><?php echo $val; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Date* </label>
              <input type="text" class="form-control" required="" name="startDate" id="startDate" value="<?php echo date('d-m-Y', strtotime($_REQUEST['d']));  ?>">
            </div>
          </div>

        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description
            </label>
            <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">
      <?php if ($_REQUEST['id'] != '') { ?>
        <button type="button" class="btn btn-danger waves-effect waves-light" style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
      <?php } ?>

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="addFeesInsurance" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
    <input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
  </form>


  <script>
    function dlt(id, pid) {
      if (confirm('Are you sure your want to delete?')) {
        $('#ActionDiv').load('actionpage.php?did=' + id + '&action=delteevent&pid=' + pid);
      }

    }


    $(function() {

      $('#startDate').datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
          $(this).datepicker('option', 'maxDate', $('#endDate').val());
        }
      });
      $('#endDate').datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
          $(this).datepicker('option', 'minDate', $('#startDate').val());
          if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);
        }
      });

    });
  </script>
<?php } ?>


<?php if ($_REQUEST['action'] == 'addMeal' && $_REQUEST['pid'] != '' && $_REQUEST['d'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
    $result = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Name
            </label>
            <input name="name" type="text" class="form-control" id="servicename" value="<?php echo stripslashes($result['name']); ?>" required="">
            <script type="text/javascript">
              $(function() {

                // Single Select
                $("#servicename").autocomplete({
                  source: function(request, response) {
                    // Fetch data
                    $.ajax({
                      url: "ajax-city-search.php",
                      type: 'post',
                      dataType: "json",
                      data: {
                        search: request.term,
                        sectionType: 'Meal'
                      },
                      success: function(data) {
                        response(data);
                      }
                    });
                  },
                  select: function(event, ui) {
                    $('#servicename').val(ui.item.label); // display the selected text 
                    return false;
                  }
                });


              });
            </script>
          </div>
        </div>

        <?php
        $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '" order by id desc');
        $resultdest = mysqli_fetch_array($a);
        ?>
        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Destination
            </label>
            <select name="destinationName" class="form-control">
              <?php foreach (explode(',', $resultdest['destinations']) as $val) { ?>
                <option value="<?php echo $val; ?>" <?php if ($result['destinationName'] == $val) { ?>selected="selected" <?php } ?>><?php echo $val; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Meal Type
            </label>
            <select name="mealCategory" class="form-control">
              <?php
              $a = GetPageRecord('*', 'mealPlanMaster', 'name!="" and status=1 order by id desc');
              while ($resultdest = mysqli_fetch_array($a)) {
              ?>
                <option value="<?php echo $resultdest['name']; ?>" <?php if ($resultdest['name'] == 'Breakfast') { ?>selected="selected" <?php } ?>><?php echo $resultdest['name']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>


        <div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Date* </label>
              <input type="text" class="form-control" required="" name="startDate" id="startDate" value="<?php echo date('d-m-Y', strtotime($_REQUEST['d']));  ?>">
            </div>
          </div>


          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Start time</label>
              <select name="checkIn" class="form-control" autocomplete="off">
                <?php
                if ($result['checkIn'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkIn']));
                } else {
                  $selectedtime = date('Y-m-d 13:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">End time</label>
              <select name="checkOut" class="form-control" autocomplete="off">
                <?php
                if ($result['checkOut'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkOut']));
                } else {
                  $selectedtime = date('Y-m-d 14:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td colspan="2"><input type="checkbox" name="showTime" class="stip1" value="1" style="width: 19px; height: 22px;" <?php if ($result['showTime'] == 1) { ?>checked="checked" <?php } ?>></td>
                  <td>&nbsp;Show Time </td>
                </tr>
              </table>

            </div>
          </div>

        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description
            </label>
            <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">
      <?php if ($_REQUEST['id'] != '') { ?>
        <button type="button" class="btn btn-danger waves-effect waves-light" style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
      <?php } ?>

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="addMeal" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" /><input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
  </form>


  <script>
    function dlt(id, pid) {
      if (confirm('Are you sure your want to delete?')) {
        $('#ActionDiv').load('actionpage.php?did=' + id + '&action=delteevent&pid=' + pid);
      }

    }


    $(function() {

      $('#startDate').datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
          $(this).datepicker('option', 'maxDate', $('#endDate').val());
        }
      });
      $('#endDate').datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
          $(this).datepicker('option', 'minDate', $('#startDate').val());
          if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);
        }
      });

    });
  </script>
<?php } ?>



<?php if ($_REQUEST['action'] == 'addFlight' && $_REQUEST['pid'] != '' && $_REQUEST['d'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
    $result = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-8">
          <div class="form-group">
            <label for="validationCustom02">Name
            </label>
            <input name="name" type="text" class="form-control" id="servicename" value="<?php echo stripslashes($result['name']); ?>" required="">
            <script type="text/javascript">
              $(function() {

                // Single Select
                $("#servicename").autocomplete({
                  source: function(request, response) {
                    // Fetch data
                    $.ajax({
                      url: "ajax-city-search.php",
                      type: 'post',
                      dataType: "json",
                      data: {
                        search: request.term,
                        sectionType: 'Flight'
                      },
                      success: function(data) {
                        response(data);
                      }
                    });
                  },
                  select: function(event, ui) {
                    $('#servicename').val(ui.item.label); // display the selected text 
                    return false;
                  }
                });


              });
            </script>
          </div>
        </div>


        <div class="col-md-4">
          <div class="form-group">
            <label for="validationCustom02">Flight No.
            </label>
            <input name="flightNo" type="text" class="form-control" value="<?php echo stripslashes($result['flightNo']); ?>" required="">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="validationCustom02">From Destination
            </label>
            <input name="fromDestination" type="text" class="form-control" value="<?php echo stripslashes($result['fromDestination']); ?>" required="">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="validationCustom02">To Destination
            </label>
            <input name="toDestination" type="text" class="form-control" value="<?php echo stripslashes($result['toDestination']); ?>" required="">
          </div>
        </div>


        <div class="col-md-4">
          <div class="form-group">
            <label for="validationCustom02">Flight Duration
            </label>
            <input name="flightDuration" type="text" class="form-control" value="<?php echo stripslashes($result['flightDuration']); ?>" required="">
          </div>
        </div>


        <div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Date* </label>
              <input type="text" class="form-control" required="" name="startDate" id="startDate" value="<?php echo date('d-m-Y', strtotime($_REQUEST['d']));  ?>">
            </div>
          </div>


          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Start time</label>
              <select name="checkIn" class="form-control" autocomplete="off">
                <?php
                if ($result['checkIn'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkIn']));
                } else {
                  $selectedtime = date('Y-m-d 13:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:55');
                for ($i = $start; $i <= $end; $i = $i + 5 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">End time</label>
              <select name="checkOut" class="form-control" autocomplete="off">
                <?php
                if ($result['checkOut'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkOut']));
                } else {
                  $selectedtime = date('Y-m-d 14:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:55');
                for ($i = $start; $i <= $end; $i = $i + 5 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>

        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description
            </label>
            <textarea name="description" rows="5" class="form-control"><?php echo stripslashes($result['description']); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">
      <?php if ($_REQUEST['id'] != '') { ?>
        <button type="button" class="btn btn-danger waves-effect waves-light" style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
      <?php } ?>

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="addOther" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" /><input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
  </form>


  <script>
    function dlt(id, pid) {
      if (confirm('Are you sure your want to delete?')) {
        $('#ActionDiv').load('actionpage.php?did=' + id + '&action=delteevent&pid=' + pid);
      }

    }


    $(function() {

      $('#startDate').datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
          $(this).datepicker('option', 'maxDate', $('#endDate').val());
        }
      });
      $('#endDate').datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
          $(this).datepicker('option', 'minDate', $('#startDate').val());
          if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);
        }
      });

    });
  </script>
<?php } ?>




<!---------------------Pricing--------------->




<?php if ($_REQUEST['action'] == 'editpricing' && $_REQUEST['sectionType'] != '' && $_REQUEST['id'] != '' && $_REQUEST['pid'] != '' && trim($_REQUEST['sectionType']) != 'Accommodation') {

    if ($_REQUEST['id'] != '') {
        $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
        $result = mysqli_fetch_array($a);
    }

    ?>


    <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post"
          enctype="multipart/form-data">

        <div class="modal-body">
            <div class="row">

                <?php if ($result['transferCategory'] == 'Private') { ?>

                    <!--<div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">No. of Vehicle</label>
                            <input name="vehicle" type="number" min="1" class="form-control" value="<?php /*if ($result['vehicle'] != '') {
                                echo stripslashes($result['vehicle']);
                            } else {
                                echo '1';
                            } */ ?>">
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Per Vehicle Cost</label>
                            <input name="adultCost" type="number" min="0" class="form-control" value="<?php /*if ($result['adultCost'] != '') {
                                echo stripslashes($result['adultCost']);
                            } else {
                                echo '0';
                            } */ ?>">
                        </div>
                    </div>-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Overall Pricing</label>
                            <input name="overall_pricing" type="number" min="0" class="form-control" id="childCost"
                                   value="<?php if ($result['overall_pricing'] != '') {
                                       echo stripslashes($result['overall_pricing']);
                                   } else {
                                       echo '0';
                                   } ?>">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="markupTotal">Markup &#8377;</label>
                            <input name="markupTotal" type="number" min="0" class="form-control" id="markupTotal"
                                   value="<?php if ($result['markupTotal'] != '') {
                                       echo stripslashes($result['markupTotal']);
                                   } else {
                                       echo '0';
                                   } ?>">
                        </div>
                    </div>


                <?php } else { ?>
                    <!--<div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Per Adult Cost</label>
                            <input name="adultCost" type="number" min="0" class="form-control" id="adultCost" value="<?php /*if ($result['adultCost'] != '') {
                                echo stripslashes($result['adultCost']);
                            } else {
                                echo '0';
                            } */ ?>">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Per Child Cost</label>
                            <input name="childCost" type="number" min="0" class="form-control" id="childCost" value="<?php /*if ($result['childCost'] != '') {
                                echo stripslashes($result['childCost']);
                            } else {
                                echo '0';
                            } */ ?>">
                        </div>
                    </div>-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Overall Pricing</label>
                            <input name="overall_pricing" type="number" min="0" class="form-control" id="childCost"
                                   value="<?php if ($result['overall_pricing'] != '') {
                                       echo stripslashes($result['overall_pricing']);
                                   } else {
                                       echo '0';
                                   } ?>">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="markupTotal">Markup &#8377;</label>
                            <input name="markupTotal" type="number" min="0" class="form-control" id="markupTotal"
                                   value="<?php if ($result['markupTotal'] != '') {
                                       echo stripslashes($result['markupTotal']);
                                   } else {
                                       echo '0';
                                   } ?>">
                        </div>
                    </div>
                <?php } ?>

                <?php if($result['sectionType'] != 'Flight') {?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="international">International</label>
                            <input name="international" type="checkbox" min="0" value="true" id="international"  <?php if ($result['international_trip'] == 'true') { echo 'checked';?>  <?php } else{ echo ''; } ?> >
                        </div>
                    </div>
                <?php } ?>

                <!--<div class="col-md-12">
                    <div class="form-group">
                        <label for="validationCustom02">Markup %</label>
                        <input name="markupPercent" type="number" min="0" class="form-control" id="markupPercent" value="<?php /*if ($result['markupPercent'] != '') {
                            echo stripslashes($result['markupPercent']);
                        } else {
                            echo '0';
                        } */ ?>">
                    </div>
                </div>-->


            </div>
        </div>

        <div class="modal-footer" style=" position:relative;">


            <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary"
                   onclick="this.form.submit(); this.value='Saving...';" style="float:right;"/>
<!--            this.disabled=true;-->
        </div>

        <input name="action" type="hidden" id="action" value="editpricing"/>
        <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>"/>
        <input name="pid" type="hidden" value="<?php echo $_REQUEST['pid']; ?>"/>
    </form>


<?php } ?>





<?php if ($_REQUEST['action'] == 'editpricing' && $_REQUEST['sectionType'] != '' && $_REQUEST['id'] != '' && $_REQUEST['pid'] != '' && trim($_REQUEST['sectionType']) == 'Accommodation') {

    if ($_REQUEST['id'] != '') {


        $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
        $result = mysqli_fetch_array($a);
    }

    ?>


    <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post"
          enctype="multipart/form-data">

        <div class="modal-body">
            <div class="row">


                <?php if ($result['singleRoom'] > 0) { ?>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Overall Pricing</label>
                            <input name="overall_pricing" type="number" min="0" class="form-control" id="childCost"
                                   value="<?php if ($result['overall_pricing'] != '') {
                                       echo stripslashes($result['overall_pricing']);
                                   } else {
                                       echo '0';
                                   } ?>">
                        </div>
                    </div>

                <?php } ?>

                <?php if ($result['doubleRoom'] > 0) { ?>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Overall Pricing</label>
                            <input name="overall_pricing" type="number" min="0" class="form-control" id="childCost"
                                   value="<?php if ($result['overall_pricing'] != '') {
                                       echo stripslashes($result['overall_pricing']);
                                   } else {
                                       echo '0';
                                   } ?>">
                        </div>
                    </div>
                <?php } ?>


                <?php if ($result['tripleRoom'] > 0) { ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Overall Pricing</label>
                            <input name="overall_pricing" type="number" min="0" class="form-control" id="childCost"
                                   value="<?php if ($result['overall_pricing'] != '') {
                                       echo stripslashes($result['overall_pricing']);
                                   } else {
                                       echo '0';
                                   } ?>">
                        </div>
                    </div>
                <?php } ?>



                <?php if ($result['quadRoom'] > 0) { ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Overall Pricing</label>
                            <input name="overall_pricing" type="number" min="0" class="form-control" id="childCost"
                                   value="<?php if ($result['overall_pricing'] != '') {
                                       echo stripslashes($result['overall_pricing']);
                                   } else {
                                       echo '0';
                                   } ?>">
                        </div>
                    </div>
                <?php } ?>


                <?php if ($result['cwbRoom'] > 0) { ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Overall Pricing</label>
                            <input name="overall_pricing" type="number" min="0" class="form-control" id="childCost"
                                   value="<?php if ($result['overall_pricing'] != '') {
                                       echo stripslashes($result['overall_pricing']);
                                   } else {
                                       echo '0';
                                   } ?>">
                        </div>
                    </div>
                <?php } ?>

                <?php if ($result['cnbRoom'] > 0) { ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="validationCustom02">Overall Pricing</label>
                            <input name="overall_pricing" type="number" min="0" class="form-control" id="childCost"
                                   value="<?php if ($result['overall_pricing'] != '') {
                                       echo stripslashes($result['overall_pricing']);
                                   } else {
                                       echo '0';
                                   } ?>">
                        </div>
                    </div>
                <?php } ?>


                <div class="col-md-12">
                    <div class="form-group">
                        <label for="markupTotal">Markup &#8377;</label>
                        <input name="markupTotal" type="number" min="0" class="form-control" id="markupTotal"
                               value="<?php if ($result['markupTotal'] != '') {
                                   echo stripslashes($result['markupTotal']);
                               } else {
                                   echo '0';
                               } ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="international">International</label>
                        <input name="international" type="checkbox" min="0" value="true" id="international" <?php if ($result['international_trip'] == 'true') { echo 'checked';?>  <?php } else{ echo ''; } ?> >
                    </div>
                </div>


            </div>
        </div>

        <div class="modal-footer" style=" position:relative;">


            <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary"
                   onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;"/>
        </div>

        <input name="action" type="hidden" id="action" value="editpricingAccommodation"/>
        <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>"/>
        <input name="pid" type="hidden" value="<?php echo $_REQUEST['pid']; ?>"/>
    </form>


<?php } ?>



<?php if ($_REQUEST['action'] == 'medialibrary' && $_REQUEST['pid'] != '' && $_REQUEST['afunctin'] != '') {  ?>
  <style>
    .libouterbtn {
      border-bottom: 2px solid #ddd;
      overflow: hidden;
      margin-bottom: 15px;
    }

    .libouterbtn a {
      float: left;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 600;
      color: #333333;
      cursor: pointer;
      border-top-right-radius: 5px;
      border-top-left-radius: 5px;
    }

    .libouterbtn a:hover {
      background-color: #bdffe0 !important;
      color: #000 !important;
    }

    .libouterbtn .active {
      background-color: #2da36b;
      color: #fff !important;
    }

    .libbotouterbox {
      width: 110px;
      height: 110px;
      border-radius: 10px;
      display: inline-block;
      object-fit: inherit;
      overflow: hidden;
      cursor: pointer;
      margin: 0px 1px;
    }

    .libbotouterbox img {
      width: auto;
      min-width: 100%;
      height: 100%;
    }
  </style>


  <div class="libouterbtn">
    <a class="active" onclick="$('.libouterbtn a').removeClass('active');$(this).addClass('active');$('#liboutertype').val(1);funloaduploadedphotos(12);"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;Search</a>
    <a onclick="$('.libouterbtn a').removeClass('active');$(this).addClass('active');$('#liboutertype').val(2);funloaduploadedphotos(12);"><i class="fa fa-picture-o" aria-hidden="true"></i> &nbsp;My Uploads</a>
    <input name="liboutertype" id="liboutertype" type="hidden" value="1" />
  </div>



  <div class="row" style="padding: 0px 10px;">
    <div class="col-md-9 col-xl-9">
      <div class="form-group">
        <input id="keywordsearch" onkeyup="funloaduploadedphotos(12);" name="keywordsearch" type="search" min="0" class="form-control" placeholder="Search" value="">
      </div>

    </div>

    <div class="col-md-3 col-xl-3">
      <form class="custom-validation" action="frmaction.html" target="actoinfrm" id="upimg" novalidate="" id="uploadmediafrm" method="post" enctype="multipart/form-data">
        <input name="Upload" type="button" value="Upload Photo" id="savingphtobutton" onclick="$('#changeprofilepic').click();" class="btn btn-secondary btn-lg waves-effect waves-light">
        <input name="image[]" multiple id="changeprofilepic" onchange="uploadchk();" type="file" style="display:none;" /> <input name="action" type="hidden" id="action" value="uploadphototmedia" />
      </form>

    </div>
  </div>

  <div class="row" style="padding: 0px 10px;" id="loaduploadedphotos">

  </div>

  <script>
    function funloaduploadedphotos(totalnumbercount) {
      var keyword = encodeURI($('#keywordsearch').val());
      var liboutertype = ($('#liboutertype').val());
      $('#loaduploadedphotos').load('loaduploadedphotos.php?keyword=' + keyword + '&afunctin=<?php echo $_REQUEST['afunctin']; ?>&totalnumbercount=' + totalnumbercount + '&liboutertype=' + liboutertype);
    }
    funloaduploadedphotos(12);



    function uploadchk() {
      var $fileUpload = $("input[type='file']");
      if (parseInt($fileUpload.get(0).files.length) > 5) {
        alert("You can only upload a maximum of 5 files");
      } else {
        $('#upimg').submit();
        $('#savingphtobutton').attr('disabled', 'true');
        $('#savingphtobutton').val('Uploading...');
      }

    };
  </script>
<?php } ?>



<?php if ($_REQUEST['action'] == 'editDayDetails' && $_REQUEST['pid'] != '' && $_REQUEST['d'] != '') {

  if ($_REQUEST['pid'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'packageId="' . decode($_REQUEST['pid']) . '" and  packageDays="' . ($_REQUEST['d']) . '" order by id desc');
    $result = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Subject
            </label>
            <input name="daySubject" type="text" class="form-control" id="daySubject" value="<?php echo stripslashes($result['daySubject']); ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Details
            </label>
            <textarea name="dayDetails" rows="10" class="form-control"><?php echo stripslashes($result['dayDetails']); ?></textarea>
          </div>
        </div>





      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="editDayDetails" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['d']; ?>" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
  </form>



<?php } ?>


<?php if ($_REQUEST['action'] == 'editDayDetails2' && $_REQUEST['pid'] != '' && $_REQUEST['d'] != '') {

  if ($_REQUEST['pid'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'packageId="' . decode($_REQUEST['pid']) . '" and  packageDays="' . ($_REQUEST['d']) . '" order by id asc');
    $result = mysqli_fetch_array($a);
  }

  if ($_REQUEST['dayitid'] > 0) {
    $a = GetPageRecord('*', 'dayItineraryMaster', 'id="' . $_REQUEST['dayitid'] . '"');
    $result = mysqli_fetch_array($a);
  }


?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Subject
            </label>
            <input name="daySubject" type="text" class="form-control" id="daySubject" value="<?php if ($_REQUEST['dayitid'] > 0) {
                                                                                                echo stripslashes($result['name']);
                                                                                              } else {
                                                                                                echo stripslashes($result['daySubject']);
                                                                                              } ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Details
            </label>
            <textarea name="dayDetails" rows="10" class="form-control"><?php if ($_REQUEST['dayitid'] > 0) {
                                                                          echo stripslashes($result['details']);
                                                                        } else {
                                                                          echo stripslashes($result['dayDetails']);
                                                                        } ?></textarea>
          </div>
        </div>





      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" data-dismiss="modal" aria-label="Close" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="editDayDetails2" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['d']; ?>" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
    <input name="date" type="hidden" id="date" value="<?php echo $_REQUEST['date']; ?>" />
  </form>



<?php } ?>





<?php if ($_REQUEST['action'] == 'editinclusionExclusionDetails' && $_REQUEST['pid'] != '') {

  if ($_REQUEST['pid'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '"  ');
    $result = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">



        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Inclusion Exclusion
            </label>
            <textarea name="inclusionExclusion" id="inclusionExclusion" rows="5" class="editorclass"><?php echo stripslashes($result['inclusionExclusion']); ?></textarea>
          </div>
        </div>





      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>
    <input name="d" type="hidden" id="d" value="<?php echo $_REQUEST['d']; ?>" />
    <input name="action" type="hidden" id="action" value="editinclusionExclusionDetails" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
  </form>



<?php } ?>


<?php if ($_REQUEST['action'] == 'edittermsandconditionsDetails' && $_REQUEST['pid'] != '') {

  if ($_REQUEST['pid'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '"  ');
    $result = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">



        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Terms and Conditions
            </label>
            <textarea name="terms" rows="5" class="editorclass"><?php echo stripslashes($result['terms']); ?></textarea>
          </div>
        </div>





      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>
    <input name="d" type="hidden" id="d" value="<?php echo $_REQUEST['d']; ?>" />
    <input name="action" type="hidden" id="action" value="edittermsandconditionsDetails" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
  </form>



<?php } ?>



<?php if ($_REQUEST['action'] == 'packageextramarkup' && $_REQUEST['pid'] != '') {

  if ($_REQUEST['pid'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '"  ');
    $result = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <!--<div class="col-md-12" <?php /*if ($_SESSION['userid'] != 1) { */?> style="display:none;" <?php /*} */?>>
          <div class="form-group">
            <label for="validationCustom02">Base Markup %
            </label>
            <input name="baseMarkup" type="number" min="0" class="form-control" value="<?php /*echo stripslashes($result['baseMarkup']); */?>" />
          </div>
        </div>-->


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Extra Markup
            </label>
            <input name="extraMarkup" type="number" min="0" class="form-control" value="<?php echo stripslashes($result['extraMarkup']); ?>" />
          </div>
        </div>





      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="packageextramarkup" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
  </form>



<?php } ?>






<?php if ($_REQUEST['action'] == 'shareitinerary' && $_REQUEST['pid'] != '') {

  if ($_REQUEST['pid'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '"  ');
    $result = mysqli_fetch_array($a);


    $rst = GetPageRecord('*', 'queryMaster', ' id in (select queryId from sys_packageBuilder where id="' . decode($_REQUEST['pid']) . '") order by id asc limit 0,5');
    $resultclient = mysqli_fetch_array($rst);
  }

?>
  <style>
    .intab .nav-link.active {
      background-color: #6c757d;
    }

    .intab .nav-link {
      margin: 0px 15px;
      border: 1px solid #ddd;
    }
  </style>
  <ul class="nav nav-pills nav-bg-custom nav-justified intab" role="tablist" style=" text-transform:uppercase;">
    <li class="nav-item" style="text-transform:uppercase;">
      <a class="nav-link active show" data-toggle="tab" href="#tb1" role="tab" aria-selected="true"><span class="d-none d-md-block">Share privately</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tb2" role="tab" aria-selected="false"><span class="d-none d-md-block">Share publicly</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span></a>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane active p-3" id="tb1" role="tabpanel">
      <p class="font-14 mb-3">Share your itinerary privately via email to specific recipients. Recipients will be prompted to create a login in order to view this itinerary.</p>
      <p class="font-14 mb-0">
      <h5 style="margin-bottom:0px;">Clients</h5>
      <span id="clientinfodata">Search and select client you would like to email this itinerary to.</span>
      </p>
      <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">
        <div class="row" style="padding: 0px 6px;  ">
          <div class="col-md-12 col-xl-12">
            <div class="form-group">
              <input id="clientkeywordsearch" onkeyup="loadSearchClients();" type="search" class="form-control" placeholder="Enter name, email, mobile" value="">
              <div style="margin-top:20px;" id="loadSearchClients">
                <div style="text-align:center; font-size:12px; color:#666666;">Search Client</div>
              </div>
            </div>
            <script>
              function loadSearchClients() {
                var clientkeywordsearch = $('#clientkeywordsearch').val();
                $('#loadSearchClients').load('loadSearchClients.php?keyword=' + clientkeywordsearch + '&pid=<?php echo $_REQUEST['pid']; ?>');
              }

              loadSearchClients();
            </script>
          </div>

        </div>

        <div class="row" style="padding: 0px 6px;">
          <div class="col-md-12 col-xl-12">
            <div class="form-group" style="  border-bottom: 1px solid #dedcdc;">
              <input id="ccmails" name="ccmails" class="form-control" value="" placeholder="CC Mail">

            </div>

          </div>

        </div>


        <p class="font-14 mb-0">
        <h5 style="margin-bottom:0px; margin-bottom:10px;">Add a message</h5>
        <div class="row" style="padding: 0px 6px;">
          <div class="col-md-12 col-xl-12">
            <div class="form-group" style="  border-bottom: 1px solid #dedcdc;">
              <textarea rows="4" class="form-control" name="shareMessage" placeholder="Enter message here"></textarea>

            </div>

          </div>

        </div>
        </p>

        <div class="modal-footer" style=" position:relative; padding-right:0px;">

          <input name="Save" type="submit" value="Send" id="savingbuttondd" class="btn btn-success btn-lg waves-effect waves-light" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
        </div>
        <input name="action" type="hidden" id="action" value="shareprivateclients" />
        <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
      </form>
    </div>
    <div class="tab-pane p-3" id="tb2" role="tabpanel">
      <p class="font-14 mb-3">Activate link to enable the ability to share this itinerary with anyone (no sign-in required).</p>
      <p class="font-14 mb-3">

        <script>
          $('#linkSharing').on('change', function() {
            var val = this.checked ? this.value : '';
            $('#sharelinkenable').submit();
          });
        </script>
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2">
            <div class="checkbox">
              <form class="custom-validation" action="frmaction.html" id="sharelinkenable" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">
                <input type="checkbox" name="linkSharing" id="linkSharing" value="1" <?php if ($result['linkSharing'] == 1) { ?>checked="checked" <?php } ?> style="width: 19px; height: 22px;">

                <input name="action" type="hidden" id="action" value="linkSharingaction" />
                <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
              </form>
            </div>
          </td>
          <td>&nbsp;&nbsp;Turn on link sharing</td>
        </tr>
      </table>
      </p>

      <div class="col-md-12 col-xl-12" style="padding:0px;">
        <a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $fullurlproposal; ?>sharepackage/<?php echo $_REQUEST['pid']; ?>/<?php echo cleanstring(stripslashes($result['name'])); ?>.html&amp;phone=+91<?php echo $resultclient['phone']; ?>" style="position: absolute; right: 0px; top: -4px;">
          <button type="button" class="btn btn-light btn-sm" style="background-color:#46cd93; color:#fff;"> <i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</button></a>


        <div style=" margin-bottom:5px;">With Price (Copy this link)</div>
        <div class="form-group">
          <input id="clientkeywordsearch" class="form-control" readonly="readonly" value="<?php echo $fullurlproposal; ?>sharepackage/<?php echo $_REQUEST['pid']; ?>/<?php echo cleanstring(stripslashes($result['name'])); ?>.html">


        </div>

      </div>

      <div class="col-md-12 col-xl-12" style="padding:0px;">

        <a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $fullurlproposal; ?>share/<?php echo $_REQUEST['pid']; ?>/<?php echo cleanstring(stripslashes($result['name'])); ?>.html&amp;phone=+91<?php echo $resultclient['phone']; ?>" style="position: absolute; right: 0px; top: -4px;">
          <button type="button" class="btn btn-light btn-sm" style="background-color:#46cd93; color:#fff;"> <i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</button></a>
        <div style=" margin-bottom:5px; color:#FF0000;">Without Price (Copy this link)</div>
        <div class="form-group">
          <input id="clientkeywordsearch" class="form-control" readonly="readonly" value="<?php echo $fullurlproposal; ?>share/<?php echo $_REQUEST['pid']; ?>/<?php echo cleanstring(stripslashes($result['name'])); ?>.html">


        </div>

      </div>
    </div>

  </div>


<?php } ?>






<?php if ($_REQUEST['action'] == 'addclient') {

  $a = GetPageRecord('*', 'userMaster', 'id="' . decode($_REQUEST['id']) . '"');
  $result = mysqli_fetch_array($a);
?>





  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-2">
          <div class="form-group">
            <label for="validationCustom02">&nbsp;&nbsp; </label>
            <select name="submitName" class="form-control">
              <option value="Mr." <?php if ($result['submitName'] == 'Mr.') { ?>selected="selected" <?php } ?>>Mr.</option>
              <option value="Mrs." <?php if ($result['submitName'] == 'Mrs.') { ?>selected="selected" <?php } ?>>Mrs.</option>
              <option value="Ms." <?php if ($result['submitName'] == 'Ms.') { ?>selected="selected" <?php } ?>>Ms.</option>
              <option value="Dr." <?php if ($result['submitName'] == 'Dr.') { ?>selected="selected" <?php } ?>>Dr.</option>
              <option value="Prof." <?php if ($result['submitName'] == 'Prof.') { ?>selected="selected" <?php } ?>>Prof.</option>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="validationCustom02">First Name </label>
            <input type="text" class="form-control reqfield" required="" name="firstName" value="<?php echo stripslashes($result['firstName']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Last Name </label>
            <input type="text" class="form-control reqfield" required="" name="lastName" value="<?php echo stripslashes($result['lastName']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Email </label>
            <input type="email" class="form-control reqfield" required="" name="email" value="<?php echo stripslashes($result['email']); ?>">
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label for="validationCustom02">Mobile</span> </label>

            <table border="0" cellpadding="0" cellspacing="0" class="groupfields">
              <tr>
                <td colspan="2"><input type="text" placeholder="+91" class="form-control" required="" name="mobileCode" value="<?php echo stripslashes($result['mobileCode']); ?>" style="    width:67px !important; margin-right:5px;"></td>
                <td><input type="text" class="form-control" required="" name="mobile" value="<?php echo stripslashes($result['mobile']); ?>" style="    width: 300px !important;" /></td>
              </tr>
            </table>


          </div>
        </div>




        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Email 2 </label>
            <input type="email" class="form-control" required="" name="email2" value="<?php echo stripslashes($result['email2']); ?>">
          </div>
        </div>



        <div class="col-md-4">
          <div class="form-group">
            <label for="validationCustom02">Mobile 2 </label>
            <table border="0" cellpadding="0" cellspacing="0" class="groupfields">
              <tr>
                <td colspan="2"><input type="text" class="form-control" placeholder="+91" required="" name="mobileCode2" value="<?php echo stripslashes($result['mobileCode2']); ?>" style="    width:67px !important; margin-right:5px;"></td>
                <td><input type="text" class="form-control" required="" name="mobile2" value="<?php echo stripslashes($result['mobile2']); ?>" style="    width: 300px !important;" /></td>
              </tr>
            </table>

          </div>
        </div>





        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">City (type slowly)<span class="redmtext">*</span></label>
            <input type="text" class="form-control reqfield" onkeyup="getSearchCIty('pickupCitySearch','pickupCity','searchcitylists');" id="pickupCitySearch" required="" name="pickupCitySearch" value="<?php echo getCityName($result['city']); ?>" autocomplete="off">
            <input name="city" id="pickupCity" type="hidden" value="<?php echo stripslashes($result['city']); ?>" />
            <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylists"></div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Address </label>
            <input type="text" class="form-control" name="address" value="<?php echo stripslashes($result['address']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Date of Birth </label>
            <input type="text" class="form-control" name="dob" id="dob" value="<?php if (date('d-m-Y', strtotime($result['dob'])) > '01-01-1970' && date('d-m-Y', strtotime($result['dob'])) != '30-11--0001') {
                                                                                  echo date('d-m-Y', strtotime($result['dob']));
                                                                                } ?>">
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Marriage Anniversary </label>
            <input type="text" class="form-control" name="marriageAnniversary" id="marriageAnniversary" value="<?php if (date('d-m-Y', strtotime($result['marriageAnniversary'])) > '01-01-1970') {
                                                                                                                  echo date('d-m-Y', strtotime($result['marriageAnniversary']));
                                                                                                                } ?>">
          </div>
        </div>
      </div>
    </div>



    <script>
      $(function() {
        $("#dob").datepicker({
          dateFormat: 'dd-mm-yy',
          maxDate: new Date(),
          changeMonth: true,
          changeYear: true,
          yearRange: "-90:+00"
        });

        $("#marriageAnniversary").datepicker({
          dateFormat: 'dd-mm-yy',
          maxDate: new Date(),
          changeMonth: true,
          changeYear: true,
          yearRange: "-90:+00"
        });
      });
    </script>

    <div class="modal-footer"> <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit();" />
    </div>

    <input name="action" type="hidden" id="action" value="addclient" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>


<?php if ($_REQUEST['action'] == 'showterms' && $_REQUEST['pid'] != '') {

  if ($_REQUEST['pid'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '"  ');
    $result = mysqli_fetch_array($a);
  }

?>


  <?php if ($result['terms'] != '') {
    echo stripslashes($result['terms']);
  } else {
    $a = GetPageRecord('*', 'sys_userMaster', 'id=1 order by id desc');
    $result = mysqli_fetch_array($a);
    echo stripslashes($result['invoiceTerms']);
  } ?>



<?php } ?>





<?php if ($_REQUEST['action'] == 'addtips' && $_REQUEST['pid'] != '') {

  $a = GetPageRecord('*', 'sys_PackageTips', 'id="' . decode($_REQUEST['id']) . '" and  packageId="' . decode($_REQUEST['pid']) . '"');
  $result = mysqli_fetch_array($a);
?>




  <script src="tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
    tinymce.init({
      selector: "#description",
      themes: "modern",
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
  </script>
  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class=" ">
      <div class="row">



        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Title<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" required="" name="title" value="<?php echo stripslashes($result['title']); ?>">
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description<span class="redmtext">*</span> </label>
            <textarea name="description" id="description" rows="6" class="form-control" required=""><?php echo stripslashes($result['description']); ?></textarea>
          </div>
        </div>


        <div class="col-md-12" style="display:none;">
          <div class="form-group">
            <label for="validationCustom02">Icon<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" required="" name="iconset" value="<?php echo stripslashes($result['iconset']); ?>">
          </div>
        </div>
        <div style="font:12px; display:none;">Pick icon from <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">https://fontawesome.com/v4.7.0/icons/</a></div>

      </div>
    </div>

    <div class="modal-footer" style="padding-right:0px;">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="    margin-right: 0px;" />

      <?php if ($_REQUEST['id'] != '') { ?>
        <button type="button" class="btn btn-danger waves-effect waves-light" style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
      <?php } ?>
    </div>
    <script>
      function dlt(id, pid) {
        if (confirm('Are you sure your want to delete?')) {
          $('#ActionDiv').load('actionpage.php?did=' + id + '&action=deltetips&pid=' + pid);
        }

      }
    </script>
    <input name="d" type="hidden" id="d" value="<?php echo $_REQUEST['d']; ?>" />
    <input name="action" type="hidden" id="action" value="addtips" />
    <input name="editId" type="hidden" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="pid" type="hidden" id="" value="<?php echo $_REQUEST['pid']; ?>" />
  </form>

<?php } ?>






<?php if ($_REQUEST['action'] == 'showquerymail' && $_REQUEST['id'] != '') {

  $a = GetPageRecord('*', 'queryMail', '  id="' . decode($_REQUEST['id']) . '"');
  $displayDataUser = mysqli_fetch_array($a);

  $a = GetPageRecord('*', 'queryMaster', 'id="' . decode($_REQUEST['queryId']) . '"');
  $displayData = mysqli_fetch_array($a);

  $abcd = GetPageRecord('*', 'userMaster', 'email="' . $displayDataUser['toEmail'] . '"');
  $clientInfoData = mysqli_fetch_array($abcd);

?>


  <div class="media mb-4" style="margin-bottom: 10px !important; padding-bottom: 10px; border-bottom: 1px solid #dedede;">
    <img class="d-flex mr-3 rounded-circle avatar-sm" src="<?php if ($clientInfoData['profilePhoto'] != '') { ?>profilepic/<?php echo $clientInfoData['profilePhoto']; ?><?php } else { ?>images/noimage.png<?php } ?>" alt="Generic placeholder image" style="width: 40px;">
    <div class="media-body">


      <h5 class="font-size-14" style="margin-bottom: 0px;margin-top: 0px;"><?php echo $clientInfoData['firstName']; ?> <?php echo $clientInfoData['lastName']; ?></h5>
      <small class="text-muted" style="font-size: 13px;"><?php echo $displayDataUser['toEmail']; ?></small><?php if ($displayDataUser['ccEmail'] != '') { ?> | <small class="text-muted" style="font-size: 13px;">CC: <?php echo $displayDataUser['ccEmail']; ?></small><?php } ?>



      <a href="#" title="Reply Mail" popaction="action=composemail&queryId=<?php echo $_REQUEST['queryId']; ?>&mailid=<?php echo $_REQUEST['id']; ?>&ac=reply" onclick="loadpop('Reply Mail',this,'900px')"><i class="mdi mdi-reply" style=" position: absolute; right: 20px; font-size: 20px; top: 22px;"></i></a>
    </div>
  </div>

  <h4 class="mt-0 font-size-16"><?php echo strip($displayDataUser['subject']); ?></h4>

  <p><?php echo strip($displayDataUser['details']); ?></p>
  <hr>



  <a href="#" popaction="action=composemail&queryId=<?php echo $_REQUEST['queryId']; ?>&mailid=<?php echo $_REQUEST['id']; ?>&ac=reply" onclick="loadpop('Reply Mail',this,'900px')" class="btn btn-secondary waves-effect mt-4"><i class="mdi mdi-reply"></i> Reply</a>




<?php } ?>









<?php if ($_REQUEST['action'] == 'composemail' && $_REQUEST['queryId'] != '') {

    $a = GetPageRecord('*', 'queryMaster', 'id="' . decode($_REQUEST['queryId']) . '"');
    $displayData = mysqli_fetch_array($a);

    $abcd = GetPageRecord('*', 'userMaster', 'id="' . $displayData['clientId'] . '"');
    $clientInfoData = mysqli_fetch_array($abcd);

    $s = GetPageRecord('name', 'cityMaster', 'id="' . $displayData['destinationId'] . '"');
    $packageDataMain = mysqli_fetch_array($s);

    $clientnameglobal = 'Tripzygo International';

    if($clientInfoData['submitName'] == 'Mr.'){
        $pronounce = 'Mr';
    }elseif($clientInfoData['submitName'] == 'Mrs.'){
        $pronounce = 'Mrs';
    }elseif($clientInfoData['submitName'] == 'Ms.'){
        $pronounce = 'Ms';
    }elseif($clientInfoData['submitName'] == 'Dr.'){
        $pronounce = 'Dr';
    }elseif ($clientInfoData['submitName'] == 'Prof.'){
        $pronounce = 'Prof';
    }else{
        $pronounce = 'Dear';
    }

    $subject = $pronounce . ' ' . stripslashes($clientInfoData['firstName']) . ' ' . '//'  . ' ' . $packageDataMain['name'] . ' ' . '//' . ' ' .$clientnameglobal . ' ' . '//' . ' ' . $_REQUEST['queryId'];

    if ($_REQUEST['mailid'] != '') {
        $a = GetPageRecord('*', 'queryMail', '  id="' . decode($_REQUEST['mailid']) . '"');
        $MailData = mysqli_fetch_array($a);
    }

    $voucherdata = '';
    if ($_REQUEST['voucherid'] != '') {
        $voucherdata = file_get_contents($fullurl . 'viewvoucher.php?id=' . $_REQUEST['voucherid'] . '&sendmail=1');
    }

    ?>
    <form class="custom-validation" action="frmaction.html" id="composemailfrm" target="actoinfrm" novalidate=""
          method="post" enctype="multipart/form-data">
        <div style="margin-bottom:20px; color:#000; font-size:13px;"><span
                    style="color:#999999;">From</span> <?php echo $LoginUserDetails['emailAccount'];
                    ?></div>
        <div class="media mb-4"
             style="padding-bottom: 10px; border-bottom: 1px solid #dedede; margin-bottom: 30px !important; border-top: 1px solid #dedede; padding-top: 10px; padding-left: 10px; background-color: #f5f5f5;">
            <img class="d-flex mr-3 rounded-circle avatar-sm"
                 src="<?php if ($clientInfoData['profilePhoto'] != '') { ?>profilepic/<?php echo $clientInfoData['profilePhoto']; ?><?php } else { ?>images/noimage.png<?php } ?>"
                 alt="Generic placeholder image" style="width: 40px;">
            <div class="media-body">
                <h5 class="font-size-14"
                    style="margin-bottom: 0px;margin-top: 0px;"><?php echo $clientInfoData['firstName']; ?><?php echo $clientInfoData['lastName']; ?></h5>
                <small class="text-muted" style=" font-size:13px;"><?php echo $clientInfoData['email']; ?></small>
            </div>
        </div>
        <div class="row spdiv">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="validationCustom02">CC</label>
                    <input type="text" class="form-control" name="cc" value="<?php echo $LoginUserDetails['email'] ;?>"
                           autocomplete="off">

                </div>
            </div>
        </div>
        <div class="row spdiv">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="validationCustom02">Reply To</label>
                    <input type="text" class="form-control" name="reply_to" value="<?php echo $LoginUserDetails['email'];?>"
                           autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row spdiv">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="validationCustom02">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject"
                           value="<?php echo $subject; ?>" autocomplete="off">

                </div>
            </div>

        </div>


        <div class="row spdiv">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="validationCustom02">Mail Body</label>
                    <textarea name="EmailDetails" rows="10" class="summernote"
                              id="EmailDetails"><?php echo $voucherdata; ?><?php if ($_REQUEST['mailid'] != '') { ?><br /><br /><br /><br /><div style="padding-left:10px; margin-left:10px; border-left:1px solid #ddd;"><?php echo strip($MailData['details']);
                        } ?></div><br /><br /><br /><br /><?php echo stripslashes($invoiceData['emailsignature']); ?></textarea>
                </div>
            </div>
        </div>


        <div class="row spdiv">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="validationCustom02">Attachment</label>
                    <input name="attachmentfile" type="file" id="file" class="form-control"/>
                </div>
            </div>
        </div>


        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Send Mail</button>
        </div>

        <link href="assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css"/>
        <script src="tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: "#EmailDetails",
                themes: "modern",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
        </script>

        <input type="hidden" name="action" value="composemail"/>
        <input type="hidden" name="queryId" value="<?php echo $_REQUEST['queryId']; ?>"/>
<!--        <input type="hidden" name="toEmail" value="<?php //echo $_REQUEST['toEmail']; ?>"/>-->
        <input type="hidden" name="toEmail" value="<?php echo $clientInfoData['email']; ?>"/>
    </form>
<?php } ?>



<?php if ($_REQUEST['action'] == 'addsupplier') {

  $a = GetPageRecord('*', 'userMaster', 'id="' . decode($_REQUEST['id']) . '" and  userType=5');
  $result = mysqli_fetch_array($a);
?>





  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">City (type slowly)<span class="redmtext"> </span></label>
            <input type="text" class="form-control reqfield" onkeyup="getSearchCIty('pickupCitySearch','pickupCity','searchcitylists');" id="pickupCitySearch" required="" name="pickupCitySearch" value="<?php echo getCityName($result['city']); ?>" autocomplete="off">
            <input name="city" id="pickupCity" type="hidden" value="<?php echo stripslashes($result['city']); ?>" />
            <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylists"></div>
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">

            <label for="validationCustom02">Company Name<span class="redmtext"> </span> </label>
            <input type="text" class="form-control reqfield" required="" name="company" value="<?php echo stripslashes($result['company']); ?>">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="validationCustom02">&nbsp;&nbsp; </label>
            <select name="submitName" class="form-control">
              <option value="Mr." <?php if ($result['submitName'] == 'Mr.') { ?>selected="selected" <?php } ?>>Mr.</option>
              <option value="Mrs." <?php if ($result['submitName'] == 'Mrs.') { ?>selected="selected" <?php } ?>>Mrs.</option>
              <option value="Ms." <?php if ($result['submitName'] == 'Ms.') { ?>selected="selected" <?php } ?>>Ms.</option>
              <option value="Dr." <?php if ($result['submitName'] == 'Dr.') { ?>selected="selected" <?php } ?>>Dr.</option>
              <option value="Prof." <?php if ($result['submitName'] == 'Prof.') { ?>selected="selected" <?php } ?>>Prof.</option>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="validationCustom02">First Name<span class="redmtext"> </span> </label>
            <input type="text" class="form-control reqfield" required="" name="firstName" value="<?php echo stripslashes($result['firstName']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Last Name </label>
            <input type="text" class="form-control reqfield" required="" name="lastName" value="<?php echo stripslashes($result['lastName']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Email </label>
            <input type="email" class="form-control reqfield" required="" name="email" value="<?php echo stripslashes($result['email']); ?>">
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label for="validationCustom02">Mobile </label>


            <table border="0" cellpadding="0" cellspacing="0" class="groupfields">
              <tr>
                <td colspan="2"><input type="text" class="form-control" required="" name="mobileCode" value="<?php echo stripslashes($result['mobileCode']); ?>" style="width: 78px !important;" placeholder="+91"></td>
                <td><input type="text" class="form-control reqfield" required="" name="mobile" value="<?php echo stripslashes($result['mobile']); ?>" style="    width: 300px !important;" /></td>
              </tr>
            </table>



          </div>
        </div>






        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Address </label>
            <input type="text" class="form-control" name="address" value="<?php echo stripslashes($result['address']); ?>">
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer"> <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addsupplier" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>








<?php if ($_REQUEST['action'] == 'schedulepayment') {

  $a = GetPageRecord('*', 'sys_PackagePayment', 'id="' . decode($_REQUEST['id']) . '"');
  $result = mysqli_fetch_array($a);


  $rs13ddd = GetPageRecord('*', 'sys_packageBuilderEvent', ' supplierCancellationDate!="" and  packageId="' . decode($_REQUEST['packageId']) . '" order by  supplierCancellationDate desc');
  $packageEvents = mysqli_fetch_array($rs13ddd);

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Amount*</label>
            <input name="amount" type="number" class="form-control" id="name" value="<?php if ($_REQUEST['id'] != '') {
                                                                                        echo $result['amount'];
                                                                                      } else {
                                                                                        echo stripslashes($_REQUEST['payment']);
                                                                                      } ?>" required="">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Date*</label>
            <input type="text" class="form-control" required="" name="startDate" id="startDate" value="<?php if ($_REQUEST['id'] != '') {
                                                                                                          echo date('d-m-Y', strtotime($result['paymentDate']));
                                                                                                        } else {
                                                                                                          echo date('d-m-Y');
                                                                                                        } ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Status*</label>
            <select name="status" id="paymentStatus" class="form-control" onchange="funpaid();">
                            <?php if($_REQUEST['id'] != ''){ ?>
                            <option value="1"
                                    <?php if ($result['paymentStatus'] == 1) { ?>selected="selected" <?php } ?>>Paid
                            </option>
                            <?php } ?>
                            <option value="2" <?php if ($_REQUEST['addpay'] != 1) {
                            if ($result['paymentStatus'] == 2) { ?>selected="selected" <?php }
                                    } else { ?>selected="selected" <?php } ?>>Scheduled
                            </option>
                        </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Remark</label>
            <textarea name="remark" rows="2" class="form-control"><?php echo stripslashes($result['remark']); ?></textarea>
          </div>
        </div>
        <script>
          function funpaid() {
            var paymentStatus = $('#paymentStatus').val();
            if (paymentStatus == 1) {
              $('.paid').show();
            } else {
              $('.paid').hide();
            }
            getreceipt();
          }
        </script>

        <div class="col-md-12 paid" style=" <?php if ($result['paymentStatus'] == 2) { ?> display:none; <?php } ?> <?php if ($_REQUEST['addpay'] == 1) { ?>display:none;<?php } ?>">
          <div class="form-group">
            <label for="validationCustom02">Payment Type*</label>
            <select name="transectionType" id="transectionType" class="form-control" onchange="getreceipt();">
              <option value="Cash" <?php if ($result['transectionType'] == 'Cash') { ?>selected="selected" <?php } ?>>Cash</option>
              <option value="Cheque" <?php if ($result['transectionType'] == 'Checks') { ?>selected="selected" <?php } ?>>Cheque</option>
              <option value="NEFT" <?php if ($result['transectionType'] == 'NEFT') { ?>selected="selected" <?php } ?>>NEFT</option>
              <option value="Mobile&nbsp;Payment" <?php if ($result['transectionType'] == 'Mobile&nbsp;Payment') { ?>selected="selected" <?php } ?>>Mobile&nbsp;Payment</option>
              <option value="Payzapp" <?php if ($result['transectionType'] == 'Payzapp') { ?>selected="selected" <?php } ?>>Payzapp</option>
              <option value="Razorpay" <?php if ($result['transectionType'] == 'Razorpay') { ?>selected="selected" <?php } ?>>Razorpay</option>
              <option value="Paypal" <?php if ($result['transectionType'] == 'Paypal') { ?>selected="selected" <?php } ?>>Paypal</option>
              <option value="Payu" <?php if ($result['transectionType'] == 'Payu') { ?>selected="selected" <?php } ?>>Payu</option>
              <option value="UPI" <?php if ($result['transectionType'] == 'UPI') { ?>selected="selected" <?php } ?>>UPI</option>
              <option value="IMPS" <?php if ($result['transectionType'] == 'IMPS') { ?>selected="selected" <?php } ?>>IMPS</option>
            </select>
          </div>
        </div>
        <script>
          function getreceipt() {
            var transectionType = encodeURI($('#transectionType').val());

            if (transectionType == 'Cash') {
              $('.receiptfield').show();
              $('.trans').hide();
            } else {
              $('.receiptfield').hide();
              $('.trans').show();
            }
          }
        </script>
        <div class="col-md-12 receiptfield" style=" <?php if ($result['paymentStatus'] == 2) { ?>display:none;<?php } ?>  <?php if ($_REQUEST['addpay'] == 1) { ?>display:none;<?php } ?>">
          <div class="form-group">
            <label for="validationCustom02">Receipt</label>
            <input type="file" class="form-control" name="receiptFile" />
          </div>
        </div>

        <div class="col-md-12 paid trans" style=" <?php if ($result['paymentStatus'] == 2) { ?>display:none;<?php } ?>  <?php if ($_REQUEST['addpay'] == 1) { ?>display:none;<?php } ?>">
          <div class="form-group">
            <label for="validationCustom02">Transection ID</label>
            <input name="paymentId" type="text" class="form-control" value="<?php echo stripslashes($result['paymentId']);  ?>" required="">
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer">

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" />
    </div>

    <input name="action" type="hidden" id="action" value="addquerypayment" />
    <input name="queryId" type="hidden" value="<?php echo $_REQUEST['queryId']; ?>" />
    <input name="packageId" type="hidden" value="<?php echo $_REQUEST['packageId']; ?>" />
    <input name="editid" type="hidden" value="<?php echo encode($result['id']); ?>" />
  </form>



  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
      });
    });
  </script>
<?php } ?>

<?php if ($_REQUEST['action'] == 'viewinvoice') {
?>

  <div id="invoiceBody" class='html-content'>

    <?php
    echo file_get_contents($fullurl . 'printInvoice.php?id=' . $_REQUEST['id'] . '&queryId=' . $_REQUEST['queryId'] . '&packageId=' . $_REQUEST['packageId']);

    ?>
  </div>
  <div class="modal-footer">
    <input name="Save" type="submit" value="Print" id="savingbutton" class="btn btn-primary" onclick='printDiv();' />
    <a href="actionpage.php?action=sendInvoicemail&id=<?php echo $_REQUEST['id']; ?>&queryId=<?php echo $_REQUEST['queryId']; ?>&packageId=<?php echo $_REQUEST['packageId']; ?>" target="actoinfrm" id="savingbutton" class="btn btn-primary">Send Mail</a>
  </div>

  <script>
    function printDiv() {

      var divToPrint = document.getElementById('invoiceBody');

      var newWin = window.open('', 'Print-Window');

      newWin.document.open();

      newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

      newWin.document.close();

      setTimeout(function() {
        newWin.close();
      }, 10);

    }
  </script>
<?php

} ?>



<?php if ($_REQUEST['action'] == 'viewvoucher') {
?>

  <div id="invoiceBody" class='html-content' style="font-size:14px;">

    <?php
    echo file_get_contents($fullurl . 'viewvoucherhtml.php?id=' . $_REQUEST['id'] . '&queryId=' . $_REQUEST['queryId'] . '&packageId=' . $_REQUEST['packageId']);

    ?>
  </div>
  <div class="modal-footer">
    <input name="Save" type="submit" value="Print" id="savingbutton" class="btn btn-primary" onclick='printDiv();' />
    <a style="cursor:pointer; color:#FFFFFF;" class="btn btn-primary" popaction="action=composemail&queryId=<?php echo $_REQUEST['queryId']; ?>&voucherid=<?php echo ($_REQUEST['id']); ?>" onclick="loadpop('Compose Mail',this,'900px')">Send Mail</a>
  </div>

  <script>
    function printDiv() {

      var divToPrint = document.getElementById('invoiceBody');

      var newWin = window.open('', 'Print-Window');

      newWin.document.open();

      newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

      newWin.document.close();

      setTimeout(function() {
        newWin.close();
      }, 10);

    }
  </script>
<?php

} ?>






<?php if ($_REQUEST['action'] == 'schedulepaymentPlan') {

  $a = GetPageRecord('*', 'sys_PackagePayment', 'id="' . decode($_REQUEST['id']) . '"');
  $result = mysqli_fetch_array($a);
?>
  <style>
    .paypen {
      text-align: center;
      color: #f24b4b;
      font-size: 26px;
      font-weight: 600;
    }
  </style>
  <div class="paypen">Total Amount: &#8377;<?php echo number_format(trim($_REQUEST['payment'])); ?></div>
  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">




        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Select Duration</label>
            <select name="paymentschedule" id="paymentschedule" class="form-control">
              <?php for ($i = 1; $i <= 12; $i++) { ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>


      </div>
    </div>

    <div class="modal-footer">

      <input name="Save" type="submit" value="Create" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="schedulepaymentPlan" />
    <input name="payment" type="hidden" value="<?php echo $_REQUEST['payment']; ?>" />
    <input name="queryId" type="hidden" value="<?php echo $_REQUEST['queryId']; ?>" />
    <input name="packageId" type="hidden" value="<?php echo $_REQUEST['packageId']; ?>" />
  </form>



  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
      });
    });
  </script>
<?php } ?>






<?php if ($_REQUEST['action'] == 'importFBleads') {

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">




        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Import Excel File</label>
            <input type="file" name="importfield" class="form-control" style="padding: 4px;" accept=".xls,.xlsx" />
          </div>
        </div>


      </div>
    </div>

    <div class="modal-footer">

      <input name="Save" type="submit" value="Import" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="importFBleads" />
  </form>



  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
      });
    });
  </script>
<?php } ?>





<?php if ($_REQUEST['action'] == 'viewmanualvoucher') {
?>

  <div id="invoiceBody" class='html-content' style="font-size:14px;">

    <?php
    echo file_get_contents($fullurl . 'viewmanualvoucher.php?id=' . $_REQUEST['id']);

    ?>
  </div>
  <div class="modal-footer">
    <input name="Save" type="submit" value="Print" id="savingbutton" class="btn btn-primary" onclick='printDiv();' />
    <a style="cursor:pointer; color:#FFFFFF;" class="btn btn-primary" popaction="action=composemailmanualvoucher&voucherid=<?php echo ($_REQUEST['id']); ?>" onclick="loadpop('Compose Mail',this,'900px')">Send Mail</a>
  </div>

  <script>
    function printDiv() {

      var divToPrint = document.getElementById('invoiceBody');

      var newWin = window.open('', 'Print-Window');

      newWin.document.open();

      newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

      newWin.document.close();

      setTimeout(function() {
        newWin.close();
      }, 10);

    }
  </script>
<?php

} ?>




<?php if ($_REQUEST['action'] == 'composemailmanualvoucher' && $_REQUEST['voucherid'] != '') {


  $voucherdata = '';
  if ($_REQUEST['voucherid'] != '') {


    $voucherdata = file_get_contents($fullurl . 'viewmanualvoucher.php?id=' . $_REQUEST['voucherid'] . '&sendmail=1');
  }

?>
  <form class="custom-validation" action="frmaction.html" id="composemailfrm" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">
    <div style="margin-bottom:20px; color:#000; font-size:13px;"><span style="color:#999999;">From</span> <?php echo $LoginUserDetails['emailAccount']; ?></div>

    <div class="row spdiv">
      <div class="col-md-12">
        <div class="form-group">
          <label for="validationCustom02">Mail To</label>
          <input type="text" class="form-control" name="toEmail" value="" autocomplete="off">

        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label for="validationCustom02">CC</label>
          <input type="text" class="form-control" name="cc" value="" autocomplete="off">

        </div>
      </div>




    </div>
    <div class="row spdiv">
      <div class="col-md-12">
        <div class="form-group">
          <label for="validationCustom02">Subject</label>
          <input type="text" class="form-control" name="subject" id="subject" value="" autocomplete="off">

        </div>
      </div>

    </div>

    <div class="row spdiv">
      <div class="col-md-12">
        <div class="form-group">
          <label for="validationCustom02">Attachment</label>
          <input type="file" class="form-control" name="attachment" id="attachment" autocomplete="off" style="padding: 4px;">
        </div>
      </div>

    </div>


    <div class="row spdiv">
      <div class="col-md-12">
        <div class="form-group">
          <label for="validationCustom02">Mail Body</label>
          <textarea name="EmailDetails" rows="10" class="summernote" id="EmailDetails"><?php echo $voucherdata; ?><?php if ($_REQUEST['mailid'] != '') { ?><br /><br /><br /><br /><div style="padding-left:10px; margin-left:10px; border-left:1px solid #ddd;"><?php echo strip($MailData['details']);
                                                                                                                                                                                                                                                                } ?></div><br /><br /><br /><br /><?php echo stripslashes($invoiceData['emailsignature']); ?></textarea>
        </div>
      </div>
    </div>


    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Send Mail </button>
    </div>

    <link href="assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
    <script src="tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
      tinymce.init({
        selector: "#EmailDetails",
        themes: "modern",
        plugins: [
          "advlist autolink lists link image charmap print preview anchor",
          "searchreplace visualblocks code fullscreen"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
      });
    </script>

    <input type="hidden" name="action" value="composemailmanualvoucher" />
  </form>
<?php } ?>






<?php if ($_REQUEST['action'] == 'addmealplan') {

  $a = GetPageRecord('*', 'mealPlanMaster', 'id="' . decode($_REQUEST['id']) . '"');
  $result = mysqli_fetch_array($a);
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Name</label>
            <input type="text" class="form-control reqfield" required="" name="name" value="<?php echo stripslashes($result['name']); ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Status*</label>
            <select name="status" id="ff" class="form-control">
              <option value="1" <?php if ($result['status'] == 1) { ?>selected="selected" <?php } ?>>Active</option>
              <option value="2" <?php if ($result['status'] == 2) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer"> <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addmealplan" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>




<?php if ($_REQUEST['action'] == 'addDestination') {

  $a = GetPageRecord('*', 'cityMaster', 'id="' . decode($_REQUEST['id']) . '"');
  $result = mysqli_fetch_array($a);
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Name<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" required="" name="name" value="<?php echo stripslashes($result['name']); ?>">
          </div>
        </div>



      </div>
    </div>

    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="cityMaster" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>






<?php if ($_REQUEST['action'] == 'addLeisure' && $_REQUEST['pid'] != '' && $_REQUEST['d'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
    $result = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Name
            </label>
            <input name="name" type="text" class="form-control" id="name" value="<?php if ($result['name'] != '') {
                                                                                    echo stripslashes($result['name']);
                                                                                  } else {
                                                                                    echo 'Day at Leisure';
                                                                                  } ?>" required="">
          </div>
        </div>


        <?php
        $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '" order by id desc');
        $resultdest = mysqli_fetch_array($a);
        ?>
        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Destination
            </label>
            <select name="destinationName" class="form-control">
              <?php foreach (explode(',', $resultdest['destinations']) as $val) { ?>
                <option value="<?php echo $val; ?>" <?php if ($result['destinationName'] == $val) { ?>selected="selected" <?php } ?>><?php echo $val; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px; display:none;">
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Date* </label>
              <input type="text" class="form-control" required="" name="startDate" id="startDate" value="<?php echo date('d-m-Y', strtotime($_REQUEST['d']));  ?>">
            </div>
          </div>


          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Start time</label>
              <select name="checkIn" class="form-control" autocomplete="off">
                <?php
                if ($result['checkIn'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkIn']));
                } else {
                  $selectedtime = date('Y-m-d 13:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">End time</label>
              <select name="checkOut" class="form-control" autocomplete="off">
                <?php
                if ($result['checkOut'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkOut']));
                } else {
                  $selectedtime = date('Y-m-d 14:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>

        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description
            </label>
            <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">
      <?php if ($_REQUEST['id'] != '') { ?>
        <button type="button" class="btn btn-danger waves-effect waves-light" style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
      <?php } ?>

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="addLeisure" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
    <input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
  </form>


  <script>
    function dlt(id, pid) {
      if (confirm('Are you sure your want to delete?')) {
        $('#ActionDiv').load('actionpage.php?did=' + id + '&action=delteevent&pid=' + pid);
      }

    }


    $(function() {

      $('#startDate').datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
          $(this).datepicker('option', 'maxDate', $('#endDate').val());
        }
      });
      $('#endDate').datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
          $(this).datepicker('option', 'minDate', $('#startDate').val());
          if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);
        }
      });

    });
  </script>
<?php } ?>







<?php if ($_REQUEST['action'] == 'addCruise' && $_REQUEST['pid'] != '' && $_REQUEST['d'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
    $result = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Name
            </label>
            <input name="name" type="text" class="form-control" id="servicename" value="<?php echo stripslashes($result['name']); ?>" required="">

            <script type="text/javascript">
              $(function() {

                // Single Select
                $("#servicename").autocomplete({
                  source: function(request, response) {
                    // Fetch data
                    $.ajax({
                      url: "ajax-city-search.php",
                      type: 'post',
                      dataType: "json",
                      data: {
                        search: request.term,
                        sectionType: 'Cruise'
                      },
                      success: function(data) {
                        response(data);
                      }
                    });
                  },
                  select: function(event, ui) {
                    $('#servicename').val(ui.item.label); // display the selected text 
                    return false;
                  }
                });


              });
            </script>
          </div>
        </div>


        <?php
        $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '" order by id desc');
        $resultdest = mysqli_fetch_array($a);
        ?>
        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Destination
            </label>
            <select name="destinationName" class="form-control">
              <?php foreach (explode(',', $resultdest['destinations']) as $val) { ?>
                <option value="<?php echo $val; ?>" <?php if ($result['destinationName'] == $val) { ?>selected="selected" <?php } ?>><?php echo $val; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Date* </label>
              <input type="text" class="form-control" required="" name="startDate" id="startDate" value="<?php echo date('d-m-Y', strtotime($_REQUEST['d']));  ?>">
            </div>
          </div>


          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">Start time</label>
              <select name="checkIn" class="form-control" autocomplete="off">
                <?php
                if ($result['checkIn'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkIn']));
                } else {
                  $selectedtime = date('Y-m-d 13:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom02">End time</label>
              <select name="checkOut" class="form-control" autocomplete="off">
                <?php
                if ($result['checkOut'] != '') {
                  $selectedtime = date('Y-m-d H:i:s', strtotime($result['checkOut']));
                } else {
                  $selectedtime = date('Y-m-d 14:00:00');
                }


                $thisday = date('Y-m-d');
                $start = strtotime('00:00');
                $end = strtotime('23:30');
                for ($i = $start; $i <= $end; $i = $i + 15 * 60) {
                  $thisdaytime = date('H:i:s', $i);
                  $newthisday = date('Y-m-d H:i:s', strtotime($thisday . ' ' . $thisdaytime));
                ?>
                  <option value="<?php echo $newthisday; ?>" <?php if ($selectedtime == $newthisday) { ?> selected="selected" <?php } ?>><?php echo date('g:i A', $i); ?></option>
                <?php  }  ?>
              </select>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group">
              <table border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td colspan="2"><input type="checkbox" name="showTime" class="stip1" value="1" style="width: 19px; height: 22px;" <?php if ($result['showTime'] == 1) { ?>checked="checked" <?php } ?>></td>
                  <td>&nbsp;Show Time </td>
                </tr>
              </table>

            </div>
          </div>

        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description
            </label>
            <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer" style=" position:relative;">
      <?php if ($_REQUEST['id'] != '') { ?>
        <button type="button" class="btn btn-danger waves-effect waves-light" style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
      <?php } ?>

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;" />
    </div>

    <input name="action" type="hidden" id="action" value="addCruise" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
    <input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
  </form>


  <script>
    function dlt(id, pid) {
      if (confirm('Are you sure your want to delete?')) {
        $('#ActionDiv').load('actionpage.php?did=' + id + '&action=delteevent&pid=' + pid);
      }

    }


    $(function() {

      $('#startDate').datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
          $(this).datepicker('option', 'maxDate', $('#endDate').val());
        }
      });
      $('#endDate').datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
          $(this).datepicker('option', 'minDate', $('#startDate').val());
          if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);
        }
      });

    });
  </script>
<?php } ?>




<?php if ($_REQUEST['action'] == 'addGuest') {
  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sys_guests', 'id="' . decode($_REQUEST['id']) . '"');
    $result = mysqli_fetch_array($a);
  }
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <label for="validationCustom02">&nbsp;&nbsp; </label>
            <select name="submitName" class="form-control">
              <option value="Mr." <?php if ($result['submitName'] == 'Mr.') { ?>selected="selected" <?php } ?>>Mr.</option>
              <option value="Mrs." <?php if ($result['submitName'] == 'Mrs.') { ?>selected="selected" <?php } ?>>Mrs.</option>
              <option value="Ms." <?php if ($result['submitName'] == 'Ms.') { ?>selected="selected" <?php } ?>>Ms.</option>
              <option value="Dr." <?php if ($result['submitName'] == 'Dr.') { ?>selected="selected" <?php } ?>>Dr.</option>
              <option value="Prof." <?php if ($result['submitName'] == 'Prof.') { ?>selected="selected" <?php } ?>>Prof.</option>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="validationCustom02">First Name<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" required="" name="firstName" value="<?php echo stripslashes($result['firstName']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Last Name<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" required="" name="lastName" value="<?php echo stripslashes($result['lastName']); ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Gender<span class="redmtext">*</span> </label>
            <select name="gender" class="form-control">
              <option value="Male" <?php if ($result['submitName'] == 'Male') { ?>selected="selected" <?php } ?>>Male</option>
              <option value="Female" <?php if ($result['submitName'] == 'Female') { ?>selected="selected" <?php } ?>>Female</option>
              <option value="Other" <?php if ($result['submitName'] == 'Other') { ?>selected="selected" <?php } ?>>Other</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Date of Birth* </label>
            <input type="text" class="form-control" required="" name="startDate" id="startDate" value="<?php if ($result['dob'] != '') {
                                                                                                          echo date('d-m-Y', strtotime($result['dob']));
                                                                                                        } else {
                                                                                                          echo date('d-m-Y');
                                                                                                        } ?>">
          </div>
        </div>


      </div>
    </div>

    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addGuest" />
    <input name="queryId" type="hidden" id="" value="<?php echo $_REQUEST['queryId']; ?>" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>
  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy',
        maxDate: new Date(),
        changeMonth: true,
        changeYear: true,
        yearRange: "-90:+00"
      });

    });
  </script>
<?php } ?>





<?php if ($_REQUEST['action'] == 'addGuestDocuments') {
  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sys_guests', 'id="' . decode($_REQUEST['id']) . '"');
    $result = mysqli_fetch_array($a);
  }
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="45%">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="validationCustom02">Pan Card</label>
                  <input type="file" class="form-control" name="panCard" id="panCard" style="padding:4px;">
                </div>
              </div>
            </td>
            <td width="55%" align="center"><?php $n = 0;
                                            $a = GetPageRecord('*', 'sys_guestsDucument', 'guestId="' . decode($_REQUEST['id']) . '" and documentType="PanCard"');
                                            while ($result = mysqli_fetch_array($a)) { ?><a href="<?php echo $fullurl; ?>profilepic/<?php echo $result['document']; ?>" class="btn btn-info btn-sm waves-effect waves-light" style="margin: 3px;" target="_blank"><?php //echo ++$n; 
                                                                                                                                                                                                                                                                  ?> Download Pan Card</a><?php } ?></td>
          </tr>
          <tr>
            <td>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="validationCustom02">Passport Front</label>
                  <input type="file" class="form-control" name="passportFront" id="passportFront" style="padding:4px;">
                </div>
              </div>
            </td>
            <td align="center"><?php $n = 0;
                                $a = GetPageRecord('*', 'sys_guestsDucument', 'guestId="' . decode($_REQUEST['id']) . '" and documentType="PassportFront"');
                                while ($result = mysqli_fetch_array($a)) { ?><a href="<?php echo $fullurl; ?>profilepic/<?php echo $result['document']; ?>" class="btn btn-info btn-sm waves-effect waves-light" style="margin: 3px;" target="_blank"><?php //echo ++$n; 
                                                                                                                                                                                                                                                      ?> Download Passport Front</a><?php } ?></td>
          </tr>
          <tr>
            <td>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="validationCustom02">Passport Back</label>
                  <input type="file" class="form-control" name="passportBack" id="passportBack" style="padding:4px;">
                </div>
              </div>
            </td>
            <td align="center"><?php $n = 0;
                                $a = GetPageRecord('*', 'sys_guestsDucument', 'guestId="' . decode($_REQUEST['id']) . '" and documentType="PassportBack"');
                                while ($result = mysqli_fetch_array($a)) { ?><a href="<?php echo $fullurl; ?>profilepic/<?php echo $result['document']; ?>" class="btn btn-info btn-sm waves-effect waves-light" style="margin: 3px;" target="_blank"><?php //echo ++$n; 
                                                                                                                                                                                                                                                      ?> Download Passport Back</a><?php } ?></td>
          </tr>
          <tr>
            <td>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="validationCustom02">Flight</label>
                  <input type="file" class="form-control" name="flight[]" multiple id="flight" style="padding:4px;">
                </div>
              </div>
            </td>
            <td align="center"><?php $n = 0;
                                $a = GetPageRecord('*', 'sys_guestsDucument', 'guestId="' . decode($_REQUEST['id']) . '" and documentType="Flight"');
                                while ($result = mysqli_fetch_array($a)) { ?><a href="<?php echo $fullurl; ?>profilepic/<?php echo $result['document']; ?>" class="btn btn-info btn-sm waves-effect waves-light" style="margin: 3px;" target="_blank"><?php echo ++$n; ?> Download Flight</a><?php } ?></td>
          </tr>
        </table>



      </div>
    </div>

    <div class="modal-footer">
      <input name="Save" type="submit" value="Upload Documents" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addGuestDocuments" />
    <input name="queryId" type="hidden" id="" value="<?php echo $_REQUEST['queryId']; ?>" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>








<?php if ($_REQUEST['action'] == 'addSupplierRemark' && $_REQUEST['queryId'] != '' && $_REQUEST['id'] != '') {

?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">


        <div class="col-md-10">
          <div class="form-group">

            <textarea name="remark" rows="2" class="form-control" id="remark" required="" placeholder="Enter Remark..."></textarea>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">

            <input name="Save" type="submit" value="Submit" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';$('#remark').val('');" style="width: 100%; padding: 17px 0px;" />
          </div>
        </div>

        <div class="row" style="width:100%; padding-right:0px; padding-left:28px;">
          <div class=" " id="queryNotes" style="width:100%; "> </div>
        </div>
        <script>
          function querySupplierNotes() {
            $('#queryNotes').load('loadSupplierQueryNotes.php?serviceId=<?php echo $_REQUEST['id']; ?>&queryId=<?php echo $_REQUEST['queryId']; ?>');
          }
          querySupplierNotes();
        </script>



      </div>
    </div>


    <input name="action" type="hidden" id="action" value="addSupplierNotes" />
    <input name="queryId" type="hidden" id="" value="<?php echo $_REQUEST['queryId']; ?>" />
    <input name="id" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>




<?php if ($_REQUEST['action'] == 'addcurrencyexchange') {

  $a = GetPageRecord('*', 'currencyExchangeMaster', 'id="' . decode($_REQUEST['id']) . '"');
  $result = mysqli_fetch_array($a);
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Name<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" required="" name="name" value="<?php echo stripslashes($result['name']); ?>">
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Rate<span class="redmtext">*</span> </label>
            <input type="number" class="form-control" required="" name="rate" value="<?php echo stripslashes($result['rate']); ?>">
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Status*</label>
            <select name="status" id="ff" class="form-control">
              <option value="1" <?php if ($result['status'] == 1) { ?>selected="selected" <?php } ?>>Active</option>
              <option value="2" <?php if ($result['status'] == 2) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addcurrencyexchange" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>







<?php if ($_REQUEST['action'] == 'addpostsalessupplier') {
  $rs1 = GetPageRecord('*', 'queryMaster', 'id="' . decode($_REQUEST['queryId']) . '"');
  $editresult = mysqli_fetch_array($rs1);

  $rs = GetPageRecord('*', 'sys_packageBuilderEvent', ' id="' . decode($_REQUEST['id']) . '" order by id asc');
  $rest = mysqli_fetch_array($rs);

  $aadv = GetPageRecord('count(id) as totalnotes', 'supplierNotes', 'serviceId="' . $rest['id'] . '"');
  $notesyes = mysqli_fetch_array($aadv);

  $netCost = 0;
  $markupValue = 0;
  $gross = 0;

  $predate = date('d-m-Y', strtotime($editresult['startDate']));


  if ($rest['sectionType'] == 'Accommodation') {
    $netCost = round($rest['singleRoomCost'] * $rest['singleRoom']) + ($rest['doubleRoomCost'] * $rest['doubleRoom']) + ($rest['tripleRoomCost'] * $rest['tripleRoom']) + ($rest['quadRoomCost'] * $rest['quadRoom']) + ($rest['cwbRoomCost'] * $rest['cwbRoom']) + ($rest['cnbRoomCost'] * $rest['cnbRoom']);
  } else {

    if ($rest['transferCategory'] == 'Private') {
      $netCost = round($rest['vehicle'] * $rest['adultCost']);
    } else {

      $netCost = round($rest['adultCost'] * $editresult['adult']) + ($rest['childCost'] * $editresult['child']);

      if ($rest['sectionType'] == 'Flight') {
        $netflightcosting = $netCost + $netflightcosting;
      }
    }
  }

  $totalnetCost = $netCost + $totalnetCost;

  $markupValue = ($rest['markupPercent'] * $netCost / 100);
  $gross = round($netCost + $markupValue);

  $totalGross = $gross + $totalGross;


  if ($rest['supplierAmount'] > 0) {
    //$netCost=$rest['supplierAmount'];
  }



?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td>
              <div class="form-group">
                <label for="validationCustom02">Supplier<span class="redmtext">*</span> </label>
                <select id="supplierId" name="supplierId" class="select2 form-control" autocomplete="off" style=" font-size:12px; width: 160px;">
                  <option value="">Select</option>
                  <?php
                  $rs2 = GetPageRecord('*', 'userMaster', '  status=1 and userType=5 order by firstName asc');
                  while ($restsup = mysqli_fetch_array($rs2)) {
                  ?>
                    <option value="<?php echo $restsup['id']; ?>" <?php if ($restsup['id'] == $rest['supplierId']) { ?>selected="selected" <?php } ?>><?php echo $restsup['company']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </td>
            <td>
              <div class="form-group">
                <label for="validationCustom02">Booking&nbsp;Status<span class="redmtext">*</span> </label>
                <select id="bookingStatusId" name="bookingStatusId" class="select2 form-control" onchange="calculateAmt();" autocomplete="off" style="font-size: 12px; padding-right: 0px; padding-left: 4px; color:#fff; background-color:#<?php if ($rest['bookingStatusId'] == 0) { ?>e77350<?php } ?><?php if ($rest['bookingStatusId'] == 1) { ?>e3445a<?php } ?><?php if ($rest['bookingStatusId'] == 2) { ?>01c875<?php } ?><?php if ($rest['bookingStatusId'] == 3) { ?>a55cd9<?php } ?><?php if ($rest['bookingStatusId'] == 4) { ?>323232<?php } ?>;">
                  <option value="0" <?php if ($rest['bookingStatusId'] == 0) { ?>selected="selected" <?php } ?>>Mail Sent</option>
                  <option value="1" <?php if ($rest['bookingStatusId'] == 1) { ?>selected="selected" <?php } ?>>Pending Confirmation</option>
                  <option value="2" <?php if ($rest['bookingStatusId'] == 2) { ?>selected="selected" <?php } ?>>Confirmed</option>
                  <option value="3" <?php if ($rest['bookingStatusId'] == 3) { ?>selected="selected" <?php } ?>>Not Confirmed</option>
                  <option value="4" <?php if ($rest['bookingStatusId'] == 4) { ?>selected="selected" <?php } ?>>Rates Negotiation</option>
                </select>
              </div>
            </td>
            <td class="confno" <?php if ($rest['bookingStatusId'] != 2) { ?> style="display:none;" <?php } ?>>
              <div class="form-group">
                <label for="validationCustom02">Conf&nbsp;No. </label>
                <input class="form-control" type="text" name="confirmationNo" id="confirmationNo" value="<?php echo $rest['confirmationNo']; ?>" placeholder="Confirmation No" />
              </div>
            </td>
            <td>
              <div class="form-group">
                <label for="validationCustom02">Payment&nbsp;Status<span class="redmtext">*</span> </label>
                <select id="statusId" name="statusId" class="select2 form-control" autocomplete="off" style="font-size: 12px; padding-right: 0px; padding-left: 4px; color:#fff; background-color:#<?php if ($rest['status'] == 0) { ?>e77350<?php } ?><?php if ($rest['status'] == 1) { ?>01c875<?php } ?>;">
                  <option value="0" <?php if ($rest['status'] == 0) { ?>selected="selected" <?php } ?>>Payment Pending</option>
                  <option value="1" <?php if ($rest['status'] == 1) { ?>selected="selected" <?php } ?>>Amount Paid</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="form-group">
                <label for="validationCustom02">Due&nbsp;Date </label>
                <input name="dueDate" type="text" class="form-control supplierduedate" readonly="readonly" id="dueDate" style=" text-align:center; background-color:transparent; font-size:12px; <?php if ($rest['dueDate'] != '' && date('d-m-Y', strtotime($rest['dueDate'])) != '01-01-1970' && $rest['dueDate'] < date('Y-m-d')) {  ?>border:1px solid #FF0000;<?php } ?>" value="<?php if ($rest['dueDate'] != '' && date('d-m-Y', strtotime($rest['dueDate'])) != '01-01-1970') {
                                                                                                                                                                                                                                                                                                                                                                                        echo date('d-m-Y', strtotime($rest['dueDate']));
                                                                                                                                                                                                                                                                                                                                                                                      } ?>" />
              </div>
            </td>
            <td>
              <div class="form-group">
                <label for="validationCustom02">Cancellation&nbsp;Date </label>
                <input name="suppliercancellationdate" type="text" class="form-control suppliercancellationdate" readonly="readonly" id="startDate" style=" text-align:center; background-color:transparent; font-size:12px; <?php if ($rest['dueDate'] != '' && date('d-m-Y', strtotime($rest['dueDate'])) != '01-01-1970' && $rest['dueDate'] < date('Y-m-d')) {  ?>border:1px solid #FF0000;<?php } ?>" value="<?php if ($rest['supplierCancellationDate'] != '' && date('d-m-Y', strtotime($rest['supplierCancellationDate'])) != '01-01-1970') {
                                                                                                                                                                                                                                                                                                                                                                                                                    echo date('d-m-Y', strtotime($rest['supplierCancellationDate']));
                                                                                                                                                                                                                                                                                                                                                                                                                  } ?>" />
              </div>
            </td>
            <td>
              <div class="form-group">
                <label for="validationCustom02">Supplier&nbsp;Amount<span class="redmtext">*</span> </label>
                <input type="number" min="0" class="form-control datepick" name="supplierAmount" id="supplierAmount" style=" text-align:center; background-color:transparent; font-size:12px;" value="<?php if ($rest['supplierAmount'] > 0) {
                                                                                                                                                                                                        echo $rest['supplierAmount'];
                                                                                                                                                                                                      } else {
                                                                                                                                                                                                        echo $netCost;
                                                                                                                                                                                                      } ?>" readonly="readonly" />
              </div>
            </td>
            <td>
              <div class="form-group">
                <label for="validationCustom02">Paid&nbsp;Amt. </label>
                <input type="number" min="0" class="form-control" name="paidAmount" id="paidAmount" onkeyup="calculatepaidAmt();" onchange="calculatepaidAmt();" style=" text-align:center; background-color:transparent; font-size:12px;" value="<?php echo $rest['paidAmount']; ?>" max="<?php echo $netCost; ?>" />
                <script>
                  $('#paidAmount').on('input', function() {
                    var value = $(this).val();
                    var supplierAmount = $('#supplierAmount').val();
                    if ((value !== '') && (value.indexOf('.') === -1)) {
                      $(this).val(Math.max(Math.min(value, supplierAmount), -supplierAmount));
                    }
                  });
                </script>
              </div>
            </td>
          </tr>


          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
              <div class="form-group">
                <label for="validationCustom02">Pending&nbsp;Amt. </label>
                <input type="text" min="0" class="form-control" name="pendingAmount" id="pendingAmount" style=" text-align:center; background-color:transparent; font-size:12px;" value="<?php if ($rest['supplierAmount'] > 0) {
                                                                                                                                                                                            echo $rest['supplierAmount'] - $rest['paidAmount'];
                                                                                                                                                                                          } else {
                                                                                                                                                                                            echo $netCost - $rest['paidAmount'];
                                                                                                                                                                                          } ?>" readonly="readonly" />
              </div>
            </td>
          </tr>
        </table>

      </div>
    </div>
    <script>
      function savedata() {}




      function calculateAmt() {

        var bookingStatusId = encodeURI($('#bookingStatusId').val());

        if (bookingStatusId == 2) {
          $('.confno').show();
        } else {
          $('.confno').hide();
        }

      }





      function calculatepaidAmt() {
        var paidAmount = Number($('#paidAmount').val());
        var supplierAmount = Number($('#supplierAmount').val());
        $('#pendingAmount').val(supplierAmount - paidAmount);

      }


      function savedatamanual() {}

      $(function() {
        $(".supplierduedate").datepicker();
        $(".suppliercancellationdate").datepicker();
      });
    </script>
    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit();  this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="savesuppliercosting" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="queryId" type="hidden" id="" value="<?php echo $_REQUEST['queryId']; ?>" />
  </form>

<?php } ?>









<?php if ($_REQUEST['action'] == 'showtodayspayments') {

?>

  <div class="col-xl-6">
    <div class="card">
      <div class="card-body" style="height: 400px;">
        <p class="text-muted font-weight-medium mt-1 mb-2"><i class="fa fa-file-text" aria-hidden="true"></i> Today's Payment Collection </p>
        <div style="height:330px; overflow:auto;">
          <table class="table table-hover mb-0" style="border:1px solid #ddd;">

            <thead>
              <tr>
                <th>Query ID </th>
                <th>Client</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $totalno = 1;

              if ($LoginUserDetails['showQueryStatus'] == 1) {

                $a = GetPageRecord('*', 'sys_PackagePayment', ' 1 and DATE(paymentDate)<="' . date('Y-m-d') . '" and paymentStatus!=1   order by paymentDate asc');
              } else {
                $a = GetPageRecord('*', 'sys_PackagePayment', ' 1 and DATE(paymentDate)<="' . date('Y-m-d') . '" and paymentStatus!=1 and queryId in(select id from queryMaster where 1 ' . $mainwhere . ')  order by paymentDate asc');
              }



              while ($paymentlist = mysqli_fetch_array($a)) {


                $b3d = GetPageRecord('*', 'userMaster', 'id in (select clientId from queryMaster where id="' . $paymentlist['queryId'] . '" )');
                $clientData = mysqli_fetch_array($b3d);
              ?>

                <tr style="font-size:12px;">
                  <td align="left" valign="top"><a href="display.html?ga=query&view=1&id=<?php echo encode($paymentlist['queryId']); ?>" target="_blank"><?php echo encode($paymentlist['queryId']); ?></a></td>
                  <td align="left" valign="top"><?php echo stripslashes($clientData['firstName']); ?> <?php echo stripslashes($clientData['lastName']); ?></td>
                  <td align="left" valign="top">&#8377;<?php echo ($paymentlist['amount']); ?></td>
                  <td align="left" valign="top"><?php echo date('d/m/Y - h:i A', strtotime($paymentlist['paymentDate'])); ?> </td>
                  <td align="left" valign="top"><?php if ($paymentlist['paymentStatus'] == 1) { ?><span class="badge badge-success">Paid</span><?php } ?>

                    <?php if (date('Y-m-d H:i:s', strtotime($paymentlist['paymentDate'])) >= date('Y-m-d H:i:s')) {
                      if ($paymentlist['paymentStatus'] == 2) { ?><span class="badge badge-warning">Scheduled</span><?php }
                                                                                                                } else {
                                                                                                                  if ($paymentlist['paymentStatus'] == 2) { ?>
                        <span class="badge badge-danger">Overdue</span>
                    <?php }
                                                                                                                } ?>
                  </td>
                </tr>


              <?php $totalno++;
              } ?>
            </tbody>
          </table>
        </div>


      </div>
    </div>
  </div>

<?php } ?>




<?php if ($_REQUEST['action'] == 'sendSelectedPaymentPlanToMail') {
  $queryId = decode($_REQUEST['queryId']);
  $packageId = decode($_REQUEST['packageId']);



  $fd = GetPageRecord('*', 'queryMaster', 'id="' . $queryId . '"');
  $queryData = mysqli_fetch_array($fd);

  $rsa = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');
  $userDetail = mysqli_fetch_array($rsa);
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Mail Send To<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" readonly="" name="name" value="<?php echo $userDetail['email']; ?>">
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">CC Mails<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" name="ccmails" value="">
          </div>
        </div>


      </div>
    </div>

    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="sendSelectedPaymentPlanToMail" />
    <input name="queryId" type="hidden" id="" value="<?php echo $_REQUEST['queryId']; ?>" />
    <input name="packageId" type="hidden" id="" value="<?php echo $_REQUEST['packageId']; ?>" />
  </form>

<?php } ?>





<?php if ($_REQUEST['action'] == 'sendpaymentlink') {
  $queryId = decode($_REQUEST['qid']);
  $packageId = decode($_REQUEST['pid']);
  $id = decode($_REQUEST['id']);



  $fd = GetPageRecord('*', 'queryMaster', 'id="' . $queryId . '"');
  $queryData = mysqli_fetch_array($fd);

  $rsa = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');
  $userDetail = mysqli_fetch_array($rsa);
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Mail Send To<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" readonly="" name="name" value="<?php echo $userDetail['email']; ?>">
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">CC Mails<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" name="ccmails" value="">
          </div>
        </div>


      </div>
    </div>

    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="sendpaymentlink" />
    <input name="qid" type="hidden" id="" value="<?php echo $_REQUEST['qid']; ?>" />
    <input name="pid" type="hidden" id="" value="<?php echo $_REQUEST['pid']; ?>" />
    <input name="id" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="sendlink" type="hidden" id="" value="<?php echo $_REQUEST['sendlink']; ?>" />
  </form>

<?php } ?>






<?php if ($_REQUEST['action'] == 'sendpaymentWithoutLink') {
  $queryId = decode($_REQUEST['qid']);
  $packageId = decode($_REQUEST['pid']);
  $id = decode($_REQUEST['id']);



  $fd = GetPageRecord('*', 'queryMaster', 'id="' . $queryId . '"');
  $queryData = mysqli_fetch_array($fd);

  $rsa = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');
  $userDetail = mysqli_fetch_array($rsa);
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Mail Send To<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" readonly="" name="name" value="<?php echo $userDetail['email']; ?>">
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">CC Mails<span class="redmtext">*</span> </label>
            <input type="text" class="form-control" name="ccmails" value="">
          </div>
        </div>


      </div>
    </div>

    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="sendpaymentWithoutLink" />
    <input name="qid" type="hidden" id="" value="<?php echo $_REQUEST['qid']; ?>" />
    <input name="pid" type="hidden" id="" value="<?php echo $_REQUEST['pid']; ?>" />
    <input name="id" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="amt" type="hidden" id="" value="<?php echo $_REQUEST['amt']; ?>" />
    <input name="acn" type="hidden" id="" value="<?php echo $_REQUEST['acn']; ?>" />
  </form>

<?php } ?>









<?php if ($_REQUEST['action'] == 'addhotel') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'hotelMaster', 'id="' . decode($_REQUEST['id']) . '"');
    $data = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Hotel name
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($data['name']); ?>" required="">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Category</label>
            <select id="category" name="category" class="select2 form-control reqfield" autocomplete="off" style="width:100%;">

              <option value="">Select</option>

              <option value="1" <?php if ('1' == $data['category']) { ?>selected="selected" <?php } ?>>1 Star</option>

              <option value="2" <?php if ('2' == $data['category']) { ?>selected="selected" <?php } ?>>2 Star</option>

              <option value="3" <?php if ('3' == $data['category']) { ?>selected="selected" <?php } ?>>3 Star</option>

              <option value="4" <?php if ('4' == $data['category']) { ?>selected="selected" <?php } ?>>4 Star</option>

              <option value="5" <?php if ('5' == $data['category']) { ?>selected="selected" <?php } ?>>5 Star</option>



            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Destination</label>
            <input type="text" class="form-control" onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" required="" name="fromCity" value="<?php echo getCityName($data['destination']); ?>" autocomplete="off">
            <input name="destination" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($data['destination']); ?>" />
            <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>
          </div>
        </div>



        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Hotel Details</label>
            <textarea name="details" rows="6" class="form-control"><?php echo stripslashes($data['details']); ?></textarea>
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Hotel Photo*
            </label>
            <input name="image" type="file" id="changeprofilepic" class="form-control">

            <input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['hotelPhoto']; ?>" />

          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Contact Person</label>
            <input type="text" class="form-control" name="contactPerson" value="<?php echo strip($data['contactPerson']); ?>" autocomplete="off">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Email</label>
            <input type="text" class="form-control" name="contactPersonEmail" value="<?php echo strip($data['contactPersonEmail']); ?>" autocomplete="off">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Phone</label>
            <input type="text" class="form-control" name="contactPersonPhone" value="<?php echo strip($data['contactPersonPhone']); ?>" autocomplete="off">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Status*
            </label>
            <select name="status" class="form-control" autocomplete="off">

              <option value="1" <?php if ('1' == $data['status']) { ?>selected="selected" <?php } ?>>Active</option>

              <option value="0" <?php if ('0' == $data['status']) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Hotel Link
            </label>
            <input type="text" class="form-control" name="imgLink" value="<?php echo strip($data['imgLink']); ?>" autocomplete="off">
          </div>
        </div>




      </div>

    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />

    </div>

    <input name="action" type="hidden" id="action" value="addHotelMaster" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>



  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>
<?php } ?>






<?php if ($_REQUEST['action'] == 'addHotelRate' && $_REQUEST['id'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'hotelMaster', 'id="' . decode($_REQUEST['id']) . '"');
    $Hoteldata = mysqli_fetch_array($a);


    $ab = GetPageRecord('*', 'hotelRateList', 'id="' . decode($_REQUEST['editid']) . '"');
    $data = mysqli_fetch_array($ab);
  }

?>
  <h4 style="margin-bottom:10px; font-weight:600;"><?php echo stripslashes($Hoteldata['name']); ?></h4>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <table width="100%" border="0" cellpadding="2" cellspacing="0">
          <tr>
            <td width="10%">From Date</td>
            <td width="10%">To</td>
            <td width="12%">Room&nbsp;Type</td>
            <td width="8%">Meal&nbsp;Plan</td>
            <td width="10%">Single</td>
            <td width="10%">Double</td>
            <td width="10%">Triple</td>
            <td width="10%">Quad</td>
            <td width="10%">CWB</td>
            <td width="10%">CNB</td>
            <td width="5%">&nbsp;</td>
          </tr>
          <tr>
            <td width="10%"><input name="startDate" id="startDate" type="text" class="form-control" readonly="readonly" value="<?php if ($data['startDate'] != '') {
                                                                                                                                  echo date('d-m-Y', strtotime($data['startDate']));
                                                                                                                                } ?>"></td>
            <td width="10%"><input name="endDate" id="endDate" type="text" class="form-control" readonly="readonly" value="<?php if ($data['endDate'] != '') {
                                                                                                                              echo date('d-m-Y', strtotime($data['endDate']));
                                                                                                                            } ?>"></td>
            <td width="12%"><select id="roomType" name="roomType" class="select2 form-control" autocomplete="off" style="width:100%;">

                <option value="">Select</option>



                <?php

                $rs = GetPageRecord('*', 'RoomTypeMaster', ' status=1  order by name asc');
                while ($rest = mysqli_fetch_array($rs)) {

                ?>

                  <option value="<?php echo $rest['id']; ?>" <?php if ($rest['id'] == $data['roomType']) { ?>selected="selected" <?php } ?>><?php echo $rest['name']; ?></option>

                <?php } ?>

              </select></td>
            <td width="8%"><select id="mealPlan" name="mealPlan" class="select2 form-control" autocomplete="off" style="width:100%;">





                <?php

                $rs = GetPageRecord('*', 'mealPlanMaster', ' status=1  order by name asc');

                while ($rest = mysqli_fetch_array($rs)) {

                ?>

                  <option value="<?php echo $rest['id']; ?>" <?php if ($rest['id'] == $data['mealPlan']) { ?>selected="selected" <?php } ?>><?php echo $rest['name']; ?></option>

                <?php } ?>

              </select></td>
            <td width="10%"><input name="single" type="text" class="form-control" value="<?php echo $data['single']; ?>"></td>
            <td width="10%"><input name="double" type="text" class="form-control" value="<?php echo $data['doublePrice']; ?>"></td>
            <td width="10%"><input name="triple" type="text" class="form-control" value="<?php echo $data['triple']; ?>"></td>
            <td width="10%"><input name="quad" type="text" class="form-control" value="<?php echo $data['quad']; ?>"></td>
            <td width="10%"><input name="childBed" type="text" class="form-control" value="<?php echo $data['childBed']; ?>"></td>
            <td width="5%"><input name="extraAdult" type="text" class="form-control" value="<?php echo $data['extraAdult']; ?>"></td>
            <td width="5%"><input name="Save" type="submit" value="<?php if ($_REQUEST['editid'] != '') { ?>Save<?php } else { ?>Add<?php } ?>" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" /></td>
          </tr>
        </table>





      </div>

    </div>


    <input name="editid" type="hidden" value="<?php echo $_REQUEST['editid']; ?>">
    <input name="hotelId" type="hidden" value="<?php echo $_REQUEST['id']; ?>">
    <input name="action" type="hidden" value="addhotelratelist">


  </form>

  <h5 style="margin-bottom:10px; font-weight:600;">Rate List</h5>

  <table class="table table-hover mb-0">

    <thead>
      <tr>
        <th>From</th>
        <th>To</th>
        <th>Room Type </th>
        <th>Meal Plan </th>
        <th>Single</th>
        <th>Double</th>
        <th>Triple</th>
        <th>Quad</th>
        <th>CWB</th>
        <th>CNB</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $nc = 1;
      $rs = GetPageRecord('*', 'hotelRateList', ' hotelId="' . decode($_REQUEST['id']) . '"  order by startDate asc ');
      while ($rest = mysqli_fetch_array($rs)) {
        $nc++;

        $rs33 = GetPageRecord($select, 'RoomTypeMaster', 'id="' . $rest['roomType'] . '" ');
        $roomtypename = mysqli_fetch_array($rs33);

        $rs333 = GetPageRecord($select, 'mealPlanMaster', 'id="' . $rest['mealPlan'] . '" ');
        $mealplanname = mysqli_fetch_array($rs333);
      ?>

        <tr <?php if (decode($_REQUEST['editid']) == $rest['id']) { ?>style="background-color:#FFFFCC" <?php } ?>>
          <td><?php echo date('d/m/Y', strtotime($rest['startDate'])); ?></td>
          <td><?php echo date('d/m/Y', strtotime($rest['endDate'])); ?></td>
          <td><?php echo stripslashes($roomtypename['name']); ?></td>
          <td><?php echo stripslashes($mealplanname['name']); ?></td>
          <td><?php echo stripslashes($rest['single']); ?></td>
          <td><?php echo stripslashes($rest['doublePrice']); ?></td>
          <td><?php echo stripslashes($rest['triple']); ?></td>
          <td><?php echo stripslashes($rest['quad']); ?></td>
          <td><?php echo stripslashes($rest['childBed']); ?></td>
          <td><?php echo stripslashes($rest['extraAdult']); ?></td>
          <td> <?php if (decode($_REQUEST['editid']) != $rest['id']) { ?><div class="">
                <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-dots-vertical"></i> </button>
                <div class="dropdown-menu" style="">


                  <a class="dropdown-item" onclick="$('#popcontent').load('loadpopup.php?action=addHotelRate&id=<?php echo $_REQUEST['id']; ?>&editid=<?php echo encode($rest['id']); ?>');" style="cursor:pointer;">Edit Rate</a>
                </div>
              </div><?php } ?> </td>
        </tr>


      <?php $totalno++;
      } ?>
    </tbody>
  </table>

  <?php if ($nc == 1) { ?>
    <div style="text-align:center; padding:10px; ">No Rate</div>
  <?php } ?>

  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>
<?php } ?>








<?php if ($_REQUEST['action'] == 'addactivity') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sightseeingMaster', 'id="' . decode($_REQUEST['id']) . '"');
    $data = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Activity name</label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($data['name']); ?>" required="">
          </div>
        </div>



        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Destination</label>
            <input type="text" class="form-control" onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" required="" name="fromCity" value="<?php echo getCityName($data['destination']); ?>" autocomplete="off">
            <input name="destination" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($data['destination']); ?>" />
            <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>
          </div>
        </div>




        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Activity Details</label>
            <textarea name="details" rows="6" class="form-control"><?php echo stripslashes($data['details']); ?></textarea>
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Activity Photo*
            </label>
            <input name="image" type="file" id="changeprofilepic" class="form-control">

            <input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['photo']; ?>" />

          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Status*
            </label>
            <select name="status" class="form-control" autocomplete="off">

              <option value="1" <?php if ('1' == $data['status']) { ?>selected="selected" <?php } ?>>Active</option>

              <option value="0" <?php if ('0' == $data['status']) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>


      </div>

    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addactivity" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>



  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>
<?php } ?>






<?php if ($_REQUEST['action'] == 'addActivityRate' && $_REQUEST['id'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'sightseeingMaster', 'id="' . decode($_REQUEST['id']) . '"');
    $Hoteldata = mysqli_fetch_array($a);

    $ab = GetPageRecord('*', 'sightseeingRateList', 'id="' . decode($_REQUEST['editid']) . '"');
    $data = mysqli_fetch_array($ab);
  }

?>
  <h4 style="margin-bottom:10px; font-weight:600;"><?php echo stripslashes($Hoteldata['name']); ?></h4>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <table width="100%" border="0" cellpadding="2" cellspacing="0">
          <tr>
            <td width="10%">From Date</td>
            <td width="10%">To</td>
            <td width="10%" class="sic">Adult</td>
            <td width="10%" class="sic">Child</td>
            <td width="10%" class="pvt" style="display:none;">Vehicle Cost</td>
            <td width="5%">&nbsp;</td>
          </tr>
          <tr>
            <td width="10%"><input name="startDate" id="startDate" type="text" class="form-control" readonly="readonly" value="<?php if ($data['startDate'] != '') {
                                                                                                                                  echo date('d-m-Y', strtotime($data['startDate']));
                                                                                                                                } ?>"></td>
            <td width="10%"><input name="endDate" id="endDate" type="text" class="form-control" readonly="readonly" value="<?php if ($data['endDate'] != '') {
                                                                                                                              echo date('d-m-Y', strtotime($data['endDate']));
                                                                                                                            } ?>"></td>
            <td width="10%" class="sic"><input name="adult" type="number" class="form-control" value="<?php echo $data['adult']; ?>"></td>
            <td width="10%" class="sic"><input name="child" type="number" class="form-control" value="<?php echo $data['child']; ?>"></td>
            <td width="10%" class="pvt" style="display:none;"><input name="vehicleCost" type="number" class="form-control" value="<?php echo $data['vehicleCost']; ?>"></td>
            <td width="5%"><input name="Save" type="submit" value="<?php if ($_REQUEST['editid'] != '') { ?>Save<?php } else { ?>Add<?php } ?>" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" /></td>
          </tr>
        </table>
        <script>
          function checktype() {
            var sightseeingType = $('#sightseeingType').val();
            if (sightseeingType == 1) {
              $('.sic').show();
              $('.pvt').hide();
            }

            if (sightseeingType == 2) {
              $('.sic').hide();
              $('.pvt').show();
            }

          }
          <?php if ($_REQUEST['editid'] != '') { ?> checktype();
          <?php } ?>
        </script>
      </div>
    </div>
    <input name="editid" type="hidden" value="<?php echo $_REQUEST['editid']; ?>">
    <input name="parentId" type="hidden" value="<?php echo $_REQUEST['id']; ?>">
    <input name="action" type="hidden" value="addActivityRate">
  </form>

  <h5 style="margin-bottom:10px; font-weight:600;">Rate List</h5>

  <table class="table table-hover mb-0">

    <thead>
      <tr>
        <th>From</th>
        <th>To</th>
        <th>Adult</th>
        <th>Child</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $nc = 1;
      $rs = GetPageRecord('*', 'sightseeingRateList', ' parentId="' . decode($_REQUEST['id']) . '"  order by startDate asc ');
      while ($rest = mysqli_fetch_array($rs)) {
        $nc++;
      ?>

        <tr <?php if (decode($_REQUEST['editid']) == $rest['id']) { ?>style="background-color:#FFFFCC" <?php } ?>>
          <td><?php echo date('d/m/Y', strtotime($rest['startDate'])); ?></td>
          <td><?php echo date('d/m/Y', strtotime($rest['endDate'])); ?></td>
          <td><?php echo stripslashes($rest['adult']); ?></td>
          <td><?php echo stripslashes($rest['child']); ?></td>
          <td> <?php if (decode($_REQUEST['editid']) != $rest['id']) { ?><div class="">
                <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-dots-vertical"></i> </button>
                <div class="dropdown-menu" style="">


                  <a class="dropdown-item" onclick="$('#popcontent').load('loadpopup.php?action=addActivityRate&id=<?php echo $_REQUEST['id']; ?>&editid=<?php echo encode($rest['id']); ?>');" style="cursor:pointer;">Edit Rate</a>
                </div>
              </div><?php } ?> </td>
        </tr>


      <?php $totalno++;
      } ?>
    </tbody>
  </table>

  <?php if ($nc == 1) { ?>
    <div style="text-align:center; padding:10px; ">No Rate</div>
  <?php } ?>

  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>
<?php } ?>







<?php if ($_REQUEST['action'] == 'addtransfer') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'transferMaster', 'id="' . decode($_REQUEST['id']) . '"');
    $data = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Transfer name
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($data['name']); ?>" required="">
          </div>
        </div>



        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Destination</label>
            <input type="text" class="form-control reqfield" onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" required="" name="fromCity" value="<?php echo getCityName($data['destination']); ?>" autocomplete="off">
            <input name="destination" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($data['destination']); ?>" />
            <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>
          </div>
        </div>




        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Transfer Details</label>
            <textarea name="details" rows="6" class="form-control"><?php echo stripslashes($data['details']); ?></textarea>
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Transfer Photo*
            </label>
            <input name="image" type="file" id="changeprofilepic" class="form-control">

            <input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['photo']; ?>" />

          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Status*
            </label>
            <select name="status" class="form-control" autocomplete="off">

              <option value="1" <?php if ('1' == $data['status']) { ?>selected="selected" <?php } ?>>Active</option>

              <option value="0" <?php if ('0' == $data['status']) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>


      </div>

    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addtransfer" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>



  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>
<?php } ?>




<?php if ($_REQUEST['action'] == 'addtransferRate' && $_REQUEST['id'] != '') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'transferMaster', 'id="' . decode($_REQUEST['id']) . '"');
    $Hoteldata = mysqli_fetch_array($a);

    $ab = GetPageRecord('*', 'transferRateList', 'id="' . decode($_REQUEST['editid']) . '"');
    $data = mysqli_fetch_array($ab);
  }

?>
  <h4 style="margin-bottom:10px; font-weight:600;"><?php echo stripslashes($Hoteldata['name']); ?></h4>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <table width="100%" border="0" cellpadding="2" cellspacing="0">
          <tr>
            <td width="10%">From Date</td>
            <td width="10%">To</td>
            <td width="12%">Type</td>
            <td width="10%" class="sic">Adult</td>
            <td width="10%" class="sic">Child</td>
            <td width="10%" class="pvt" style="display:none;">Vehicle Cost</td>
            <td width="5%">&nbsp;</td>
          </tr>
          <tr>
            <td width="10%"><input name="startDate" id="startDate" type="text" class="form-control" readonly="readonly" value="<?php if ($data['startDate'] != '') {
                                                                                                                                  echo date('d-m-Y', strtotime($data['startDate']));
                                                                                                                                } ?>"></td>
            <td width="10%"><input name="endDate" id="endDate" type="text" class="form-control" readonly="readonly" value="<?php if ($data['endDate'] != '') {
                                                                                                                              echo date('d-m-Y', strtotime($data['endDate']));
                                                                                                                            } ?>"></td>
            <td width="12%"><select id="transferType" name="transferType" class="select2 form-control" autocomplete="off" style="width:100%;" onchange="checktype();">
                <option value="1" <?php if ($data['transferType'] == 1) { ?> selected="selected" <?php } ?>>SIC</option>
                <option value="2" <?php if ($data['transferType'] == 2) { ?> selected="selected" <?php } ?>>PVT</option>
              </select></td>
            <td width="10%" class="sic"><input name="adult" type="number" class="form-control" value="<?php echo $data['adult']; ?>"></td>
            <td width="10%" class="sic"><input name="child" type="number" class="form-control" value="<?php echo $data['child']; ?>"></td>
            <td width="10%" class="pvt" style="display:none;"><input name="vehicleCost" type="number" class="form-control" value="<?php echo $data['vehicleCost']; ?>"></td>
            <td width="5%"><input name="Save" type="submit" value="<?php if ($_REQUEST['editid'] != '') { ?>Save<?php } else { ?>Add<?php } ?>" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" /></td>
          </tr>
        </table>
        <script>
          function checktype() {
            var transferType = $('#transferType').val();
            if (transferType == 1) {
              $('.sic').show();
              $('.pvt').hide();
            }

            if (transferType == 2) {
              $('.sic').hide();
              $('.pvt').show();
            }

          }
          <?php if ($_REQUEST['editid'] != '') { ?> checktype();
          <?php } ?>
        </script>
      </div>
    </div>
    <input name="editid" type="hidden" value="<?php echo $_REQUEST['editid']; ?>">
    <input name="parentId" type="hidden" value="<?php echo $_REQUEST['id']; ?>">
    <input name="action" type="hidden" value="addtransferRate">
  </form>

  <h5 style="margin-bottom:10px; font-weight:600;">Rate List</h5>

  <table class="table table-hover mb-0">

    <thead>
      <tr>
        <th>From</th>
        <th>To</th>
        <th>Type </th>
        <th>Adult</th>
        <th>Child</th>
        <th>Vehicle</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $nc = 1;
      $rs = GetPageRecord('*', 'transferRateList', ' parentId="' . decode($_REQUEST['id']) . '"  order by startDate asc ');
      while ($rest = mysqli_fetch_array($rs)) {
        $nc++;
      ?>

        <tr <?php if (decode($_REQUEST['editid']) == $rest['id']) { ?>style="background-color:#FFFFCC" <?php } ?>>
          <td><?php echo date('d/m/Y', strtotime($rest['startDate'])); ?></td>
          <td><?php echo date('d/m/Y', strtotime($rest['endDate'])); ?></td>
          <td><?php if ($rest['transferType'] == 1) {
                echo 'SIC';
              }
              if ($rest['transferType'] == 2) {
                echo 'PVT';
              } ?></td>
          <td><?php echo stripslashes($rest['adult']); ?></td>
          <td><?php echo stripslashes($rest['child']); ?></td>
          <td><?php echo stripslashes($rest['vehicleCost']); ?></td>
          <td> <?php if (decode($_REQUEST['editid']) != $rest['id']) { ?><div class="">
                <button type="button" class="optionmenu" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-dots-vertical"></i> </button>
                <div class="dropdown-menu" style="">


                  <a class="dropdown-item" onclick="$('#popcontent').load('loadpopup.php?action=addtransferRate&id=<?php echo $_REQUEST['id']; ?>&editid=<?php echo encode($rest['id']); ?>');" style="cursor:pointer;">Edit Rate</a>
                </div>
              </div><?php } ?> </td>
        </tr>


      <?php $totalno++;
      } ?>
    </tbody>
  </table>

  <?php if ($nc == 1) { ?>
    <div style="text-align:center; padding:10px; ">No Rate</div>
  <?php } ?>

  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>
<?php } ?>







<?php if ($_REQUEST['action'] == 'importhotelExcel') {
?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Improt Excel
            </label>
            <input type="file" class="form-control" name="importfield" style="padding:4px;" />
          </div>
        </div>

      </div>

    </div>

    <div class="modal-footer">

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="importhotelExcel" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>







<?php if ($_REQUEST['action'] == 'importactivityExcel') {
?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Improt Excel
            </label>
            <input type="file" class="form-control" name="importfield" style="padding:4px;" />
          </div>
        </div>

      </div>

    </div>

    <div class="modal-footer">

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="importactivityExcel" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>





<?php if ($_REQUEST['action'] == 'importransferExcel') {
?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Improt Excel
            </label>
            <input type="file" class="form-control" name="importfield" style="padding:4px;" />
          </div>
        </div>

      </div>

    </div>

    <div class="modal-footer">

      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="importransferExcel" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>






<?php if ($_REQUEST['action'] == 'addleadsource') {

  $a = GetPageRecord('*', 'querySourceMaster', 'id="' . decode($_REQUEST['id']) . '"');
  $result = mysqli_fetch_array($a);
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Name </label>
            <input type="text" class="form-control reqfield" required="" name="name" value="<?php echo stripslashes($result['name']); ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Status</label>
            <select name="status" id="ff" class="form-control">
              <option value="1" <?php if ($result['status'] == 1) { ?>selected="selected" <?php } ?>>Active</option>
              <option value="2" <?php if ($result['status'] == 2) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer"><input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addleadsource" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>





<?php if ($_REQUEST['action'] == 'addRoomType') {

  $a = GetPageRecord('*', 'RoomTypeMaster', 'id="' . decode($_REQUEST['id']) . '"');
  $result = mysqli_fetch_array($a);
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Name </label>
            <input type="text" class="form-control reqfield" required="" name="name" value="<?php echo stripslashes($result['name']); ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Status*</label>
            <select name="status" id="ff" class="form-control">
              <option value="1" <?php if ($result['status'] == 1) { ?>selected="selected" <?php } ?>>Active</option>
              <option value="2" <?php if ($result['status'] == 2) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addRoomType" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>









<?php if ($_REQUEST['action'] == 'addclientgroup') {

  $a = GetPageRecord('*', 'clientGroupMaster', 'id="' . decode($_REQUEST['id']) . '"  ');
  $result = mysqli_fetch_array($a);
?>





  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Group Name<span class="redmtext">*</span> </label>
            <input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($result['name']); ?>" required="">
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description </label>
            <input type="text" class="form-control" name="description" value="<?php echo stripslashes($result['description']); ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description </label>
            <select name="status" class="form-control" onchange="funpaid();">
              <option value="1" <?php if ($result['status'] == 1) { ?>selected="selected" <?php } ?>>Active</option>
              <option value="0" <?php if ($result['status'] == 0) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>
      </div>
    </div>




    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addclientgroup" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>








<?php if ($_REQUEST['action'] == 'viewtemplate' && $_REQUEST['id'] != '') {

  $a = GetPageRecord('*', 'templateMaster', 'id="' . decode($_REQUEST['id']) . '"  ');
  $result = mysqli_fetch_array($a);
?>
  <div style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:16px;"><strong>Name:</strong> <?php echo stripslashes($result['name']); ?></div>
  <div style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:16px; margin-bottom:30px;"><strong>Email Subject: </strong><?php echo stripslashes($result['subject']); ?></div>

<?php

  echo stripslashes($result['details']);
} ?>







<?php if ($_REQUEST['action'] == 'viewcampaign' && $_REQUEST['id'] != '') {

  $a = GetPageRecord('*', 'campaignMaster', 'id="' . decode($_REQUEST['id']) . '" order by id desc');
  $result = mysqli_fetch_array($a);

  $abcde = GetPageRecord('*', 'templateMaster', 'id="' . $result['templateId'] . '"');
  $templatedata = mysqli_fetch_array($abcde);

  $abcd = GetPageRecord('*', 'contactGroupMaster', 'id="' . $result['customerGroup'] . '"');
  $cgroupdata = mysqli_fetch_array($abcd);

?>




  <div style="margin-bottom:5px; padding-bottom:5px; border-bottom:1px solid #ddd; "><strong>Campaign: </strong><?php echo stripslashes($result['title']); ?> (<?php echo encode($result['id']); ?>)</div>
  <div style="margin-bottom:5px; padding-bottom:5px; border-bottom:1px solid #ddd; "><strong>Mailing Group: </strong><?php echo stripslashes($cgroupdata['name']); ?></div>
  <div style="margin-bottom:5px; padding-bottom:5px; border-bottom:1px solid #ddd; "><strong>Template Name: </strong><?php echo stripslashes($templatedata['name']); ?></div>
  <div style="margin-bottom:5px; padding-bottom:5px;border-bottom:1px solid #ddd;"><strong>By: </strong><?php echo getUserNameNew($result['addedBy']); ?> (<?php echo displaydateindatetme($result['dateAdded']); ?>)</div>
  <div style="margin-bottom:5px; padding-bottom:5px;border-bottom:1px solid #ddd;"><strong>Mail From: </strong><?php echo stripslashes($result['fromName']); ?> < <?php echo stripslashes($result['fromEmail']); ?>>
  </div>
  <div style="margin-bottom:10px; padding-bottom:5px;   "><strong>Mail Subject: </strong><?php echo stripslashes($result['subject']); ?></div>

  <div style="width:100%; overflow:auto; padding:10px; border:2px dashed #ccc; margin-top:10px;"><?php echo stripslashes($result['details']); ?></div>


  <div class="modal-footer">

    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



  </div>

<?php } ?>

<?php if ($_REQUEST['action'] == 'exportitinerary' && $_REQUEST['pid'] != '') { ?>

  <div style="padding:20px;">
    <a href="<?php echo $fullurl; ?>tcpdf/pdf/download-package.php?pageurl=<?php echo $fullurl; ?>downloadpackagepdf.php?id=<?php echo $_REQUEST['pid']; ?>" target="_blank" style="padding: 20px; font-size: 22px; font-weight: 700; display: block; margin-bottom: 10px; border: 2px dashed #8CFFDF; background-color: #EAFFFD; text-align: center; color: #333333; text-align: center; border-radius: 5px;"><i class="fa fa-image"></i> Export With Images</a>

    <a href="https://v2.api2pdf.com/chrome/pdf/url?url=<?php echo $fullurl; ?>downloadpackagepdf_withimage2.php?id=<?php echo $_REQUEST['pid']; ?>&apikey=e196cd2c-d5d2-467b-b99b-3ad60f24c20e" target="_blank" style="padding: 20px; font-size: 22px; font-weight: 700; display: block; margin-bottom: 10px; border: 2px dashed #8CFFDF; background-color: #EAFFFD; text-align: center; color: #333333; text-align: center; border-radius: 5px;"><i class="fa fa-image"></i> Export With Images Option 2</a>

    <a href="https://v2.api2pdf.com/chrome/pdf/url?url=<?php echo $fullurl; ?>downloadpackagepdf_withimage3.php?id=<?php echo $_REQUEST['pid']; ?>&apikey=e196cd2c-d5d2-467b-b99b-3ad60f24c20e" target="_blank" style="padding: 20px; font-size: 22px; font-weight: 700; display: block; margin-bottom: 10px; border: 2px dashed #8CFFDF; background-color: #EAFFFD; text-align: center; color: #333333; text-align: center; border-radius: 5px;"><i class="fa fa-image"></i> Export With Images Option 3</a>


    <a href="<?php echo $fullurl; ?>downloadpackagepdf_noimage.php?id=<?php echo $_REQUEST['pid']; ?>" target="_blank" style="padding: 20px; font-size: 22px; font-weight: 700; display: block; margin-bottom: 10px; border: 2px dashed #ff8c8c; background-color: #ffeaea; text-align: center; color: #333333; text-align: center; border-radius: 5px;"><i class="fa fa-download"></i> Export Without Images</a>


    <a href="<?php echo $fullurl; ?>downloadpackagepdf_noimage_four_option.php?id=<?php echo $_REQUEST['pid']; ?>" target="_blank" style="padding: 20px; font-size: 22px; font-weight: 700; display: block; margin-bottom: 10px; border: 2px dashed #ff8c8c; background-color: #ffeaea; text-align: center; color: #333333; text-align: center; border-radius: 5px;"><i class="fa fa-download"></i> Export With Images Option 4</a>
  </div>

<?php } ?>



<?php if ($_REQUEST['action'] == 'selectpackage') { ?>
  <div style="padding:10px;">
    <input name="searchpackagekeyword" id="searchpackagekeyword" type="text" style="padding:15px; border:1px solid #ddd; font-size:16px; width:100%; box-sizing:border-box;" placeholder="Search Package" onkeyup="loadselectpackages();" />
  </div>
  <div style="margin-top:10px; max-height:400px; overflow:auto;" id="loadselectpackages">

  </div>
  <script>
    function loadselectpackages() {
      var searchpackagekeyword = encodeURI($('#searchpackagekeyword').val());
      var packalready = $('#selectedpackageslist').val();
      $('#loadselectpackages').load('loadselectpackages.php?searchpackagekeyword=' + searchpackagekeyword + '&packalready=' + packalready);
    }
    loadselectpackages();
  </script>

<?php } ?>






<?php if ($_REQUEST['action'] == 'addsignature') {
  $abcd = GetPageRecord('*', 'sys_userMaster', 'id="' . $_SESSION['userid'] . '"');
  $result = mysqli_fetch_array($abcd);

?>

  <script type="text/javascript">
    tinymce.init({
      selector: "#emailsignature",
      themes: "modern",
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
  </script>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">
    <div style="padding:10px;">
      <textarea class="form-control summernote" id="emailsignature" name="emailsignature" rows="6" placeholder=""><?php echo strip($result['emailsignature']); ?></textarea>
    </div>



    <div class="modal-footer">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addsignature" />
  </form>
<?php } ?>






<?php if ($_REQUEST['action'] == 'addwebsitebanner') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'homeBanner', 'id="' . decode($_REQUEST['id']) . '"');
    $data = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Banner Name
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($data['name']); ?>" required="">
          </div>
        </div>











        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Photo (1600 x 600)
            </label>
            <input name="image" type="file" id="changeprofilepic" class="form-control">

            <input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['photo']; ?>" />

          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Status*
            </label>
            <select name="status" class="form-control" autocomplete="off">

              <option value="1" <?php if ('1' == $data['status']) { ?>selected="selected" <?php } ?>>Active</option>

              <option value="0" <?php if ('0' == $data['status']) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>


      </div>

    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addwebsitebanner" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>



  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>
<?php } ?>




<?php if ($_REQUEST['action'] == 'addwebsitetestimonial') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'websiteTestimonials', 'id="' . decode($_REQUEST['id']) . '"');
    $data = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Name
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($data['name']); ?>" required="">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Destination
            </label>
            <input name="destinationName" type="text" class="form-control reqfield" id="destinationName" value="<?php echo stripslashes($data['destinationName']); ?>" required="">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Testimonial
            </label>
            <textarea name="description" rows="5" class="form-control reqfield" id="description" required=""><?php echo stripslashes($data['description']); ?></textarea>
          </div>
        </div>







        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Photo
            </label>
            <input name="image" type="file" id="changeprofilepic" class="form-control">

            <input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['photo']; ?>" />

          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Status*
            </label>
            <select name="status" class="form-control" autocomplete="off">

              <option value="1" <?php if ('1' == $data['status']) { ?>selected="selected" <?php } ?>>Active</option>

              <option value="0" <?php if ('0' == $data['status']) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>


      </div>

    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addwebsitetestimonial" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>




<?php } ?>

<?php if ($_REQUEST['action'] == 'addwebsitedestination') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'websiteDestination', 'id="' . decode($_REQUEST['id']) . '"');
    $data = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Destination Name
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($data['name']); ?>" required="">
          </div>
        </div>











        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Photo
            </label>
            <input name="image" type="file" id="changeprofilepic" class="form-control">

            <input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['photo']; ?>" />

          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Status*
            </label>
            <select name="status" class="form-control" autocomplete="off">

              <option value="1" <?php if ('1' == $data['status']) { ?>selected="selected" <?php } ?>>Active</option>

              <option value="0" <?php if ('0' == $data['status']) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>


      </div>

    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addwebsitedestination" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>



  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>
<?php } ?>


<?php if ($_REQUEST['action'] == 'addwebsiteaboutdestination') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'websiteAboutDestination', 'id="' . decode($_REQUEST['id']) . '"');
    $data = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Destination
            </label>
            <select id="destinationId" name="destinationId" class="select2 form-control" autocomplete="off" style="width:100%;">
              <?php

              $rs = GetPageRecord('*', 'websiteDestination', ' status=1  order by name asc');
              while ($rest = mysqli_fetch_array($rs)) {

              ?>
                <option value="<?php echo $rest['id']; ?>" <?php if ($rest['id'] == $data['destinationId']) { ?>selected="selected" <?php } ?>><?php echo $rest['name']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Title
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($data['name']); ?>" required="">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Description
            </label>
            <textarea name="description" rows="10" class="form-control" id="description"><?php echo stripslashes($data['description']); ?></textarea>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Photo
            </label>
            <input name="image" type="file" id="changeprofilepic" class="form-control">

            <input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['photo']; ?>" />

          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Status*
            </label>
            <select name="status" class="form-control" autocomplete="off">

              <option value="1" <?php if ('1' == $data['status']) { ?>selected="selected" <?php } ?>>Active</option>

              <option value="0" <?php if ('0' == $data['status']) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>


      </div>

    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addwebsiteaboutdestination" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>




<?php } ?>





<?php if ($_REQUEST['action'] == 'addwebsitephoto') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'websitePhotoGallery', 'id="' . decode($_REQUEST['id']) . '"');
    $data = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Title
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($data['name']); ?>" required="">
          </div>
        </div>











        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Photo
            </label>
            <input name="image" type="file" id="changeprofilepic" class="form-control">

            <input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['photo']; ?>" />

          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Status*
            </label>
            <select name="status" class="form-control" autocomplete="off">

              <option value="1" <?php if ('1' == $data['status']) { ?>selected="selected" <?php } ?>>Active</option>

              <option value="0" <?php if ('0' == $data['status']) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>


      </div>

    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addwebsitephoto" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>




<?php } ?>




<?php if ($_REQUEST['action'] == 'addwebsitetheme') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'websitePackageTheme', 'id="' . decode($_REQUEST['id']) . '"');
    $data = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Theme Name
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($data['name']); ?>" required="">
          </div>
        </div>











        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Icon (128 x 128)
            </label>
            <input name="image" type="file" id="changeprofilepic" class="form-control">

            <input name="oldlogo" type="hidden" id="oldlogo" value="<?php echo $data['photo']; ?>" />

          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Status*
            </label>
            <select name="status" class="form-control" autocomplete="off">

              <option value="1" <?php if ('1' == $data['status']) { ?>selected="selected" <?php } ?>>Active</option>

              <option value="0" <?php if ('0' == $data['status']) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>


      </div>

    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addwebsitetheme" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>



  <script>
    $(function() {
      $("#startDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>
<?php } ?>










<?php if ($_REQUEST['action'] == 'addcompanyexpense') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'expenseMaster', 'id="' . decode($_REQUEST['id']) . '"');
    $result = mysqli_fetch_array($a);
  }


?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12 paid" style=" <?php if ($result['paymentStatus'] == 2) { ?> display:none; <?php } ?> <?php if ($_REQUEST['addpay'] == 1) { ?>display:none;<?php } ?>">
          <div class="form-group">
            <label for="validationCustom02">Payment Type*</label>
            <select name="paymentType" id="paymentType" class="form-control">
              <?php
              $rs = GetPageRecord('*', 'expenseTypeMaster', ' status=1  order by name asc');
              while ($rest = mysqli_fetch_array($rs)) {
              ?>
                <option value="<?php echo stripslashes($rest['id']); ?>" <?php if ($result['paymentType'] == $rest['id']) { ?>selected="selected" <?php } ?>><?php echo stripslashes($rest['name']); ?></option>
              <?php } ?>

            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Amount*</label>
            <input name="amount" type="number" class="form-control" id="name" value="<?php if ($_REQUEST['id'] != '') {
                                                                                        echo $result['amount'];
                                                                                      } ?>" required="">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Date*</label>
            <input type="text" class="form-control" required="" name="startDate" id="expenseDate" value="<?php if ($_REQUEST['id'] != '') {
                                                                                                            echo date('d-m-Y', strtotime($result['paymentDate']));
                                                                                                          } else {
                                                                                                            echo date('d-m-Y');
                                                                                                          } ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Status*</label>
            <select name="status" id="paymentStatus" class="form-control" onchange="funpaid();">
              <option value="1" <?php if ($result['paymentStatus'] == 1) { ?>selected="selected" <?php } ?>>Paid</option>
              <option value="2" <?php if ($_REQUEST['addpay'] != 1) {
                                  if ($result['paymentStatus'] == 2) { ?>selected="selected" <?php }
                                                                                          } else { ?>selected="selected" <?php } ?>>Pending</option>

            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Remark</label>
            <textarea name="remark" rows="2" class="form-control"><?php echo stripslashes($result['remark']); ?></textarea>
          </div>
        </div>



      </div>
    </div>



    <div class="modal-footer">
      <input name="Cancel" type="button" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray">
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" />
    </div>

    <input name="action" type="hidden" id="action" value="addcompanyexpense" />
    <input name="editid" type="hidden" value="<?php echo encode($result['id']); ?>" />
  </form>



  <script>
    $(function() {
      $("#expenseDate").datepicker({
        dateFormat: 'dd-mm-yy'
      });


    });
  </script>
<?php } ?>









<?php if ($_REQUEST['action'] == 'addautomation') {



  $startDate = date('d-m-Y');
  $endDate = date('d-m-Y', strtotime('+1 Months'));

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'automationMaster', 'id="' . decode($_REQUEST['id']) . '"');
    $result = mysqli_fetch_array($a);


    $startDate = date('d-m-Y', strtotime($result['startDate']));
    $endDate = date('d-m-Y', strtotime($result['endDate']));
  }









?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body" style="padding-top:0px;">
      <div class="row">

        <div class="col-md-12">
          <div style="border: 1px solid #ffde9a; background-color: #fffbd5; padding: 10px; margin-bottom: 18px;margin-top: -10px;">System will send auto mail with selected itinerary on change event with query stage according to selected start and end date to client travel date.</div>
          <div class="form-group">
            <label for="validationCustom02">Query Stage</label>
            <select name="queryStatus" id="queryStatus" class="form-control">
              <option value="0">Select</option>
              <?php
              $rs = GetPageRecord('*', 'queryStatusMaster', ' 1 and id<5  order by id asc');
              while ($rest = mysqli_fetch_array($rs)) {
              ?>
                <option value="<?php echo stripslashes($rest['id']); ?>" <?php if ($result['queryStatus'] == $rest['id']) { ?>selected="selected" <?php } ?>><?php echo stripslashes($rest['name']); ?></option>
              <?php } ?>

            </select>
          </div>
        </div>


        <div class="col-lg-12">
          <div class="form-group">
            <label for="validationCustom02">Destination <span class="redmtext">*</span></label>
            <input type="text" class="form-control" onkeyup="getSearchCIty('pickupCitySearch','pickupCity','searchcitylists');" id="pickupCitySearch" required="" name="pickupCitySearch" value="<?php echo getCityName($result['destinationId']); ?>" autocomplete="off">
            <input name="destinationId" id="pickupCity" type="hidden" value="<?php echo stripslashes($result['destinationId']); ?>" />
            <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylists"></div>


          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Itinerary <span class="redmtext">*</span></label>
            <select name="packageId" id="packageId" class="form-control">
              <option value="0">Select</option>
              <?php
              $rs = GetPageRecord('*', 'sys_packageBuilder', ' 1 and  queryId=0 order by name asc');
              while ($rest = mysqli_fetch_array($rs)) {
              ?>
                <option value="<?php echo stripslashes($rest['id']); ?>" <?php if ($result['packageId'] == $rest['id']) { ?>selected="selected" <?php } ?>><?php echo stripslashes($rest['name']); ?> (<?php echo encode($rest['id']); ?>)</option>
              <?php } ?>

            </select>
          </div>
        </div>





        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Start Date <span class="redmtext">*</span></label>
            <input type="text" class="form-control redborder" id="startDatestart" name="startDate" readonly="" placeholder="From" value="<?php if ($startDate != '1970-01-01' && $startDate != '01-01-1970') {
                                                                                                                                            echo $startDate;
                                                                                                                                          } ?>">
          </div>
        </div>





        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">End Date <span class="redmtext">*</span></label>
            <input type="text" class="form-control redborder" id="endDateend" name="endDate" readonly="" placeholder="To" value="<?php if ($endDate != '1970-01-01' && $endDate != '01-01-1970') {
                                                                                                                                    echo $endDate;
                                                                                                                                  } ?>">
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Display Message</label>
            <textarea name="details" cols="" rows="4" class="form-control" placeholder="This message will show on itinerary"><?php echo stripslashes($result['details']); ?></textarea>
          </div>
        </div>



        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Status</label>
            <select name="status" id="ff" class="form-control">
              <option value="1" <?php if ($result['status'] == 1) { ?>selected="selected" <?php } ?>>Active</option>
              <option value="2" <?php if ($result['status'] == 2) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addautomation" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>





  <script>
    $(document).ready(function() {
      $("#startDatestart").datepicker({
        numberOfMonths: 2,
        dateFormat: 'dd-mm-yy',
        onSelect: function(selected) {
          $("#endDateend").datepicker("option", "minDate", selected)
        }
      });
      $("#endDateend").datepicker({
        dateFormat: 'dd-mm-yy',
        numberOfMonths: 2,
        onSelect: function(selected) {
          $("#startDatestart").datepicker("option", "maxDate", selected)
        }
      });
    });

    $(function() {
      $("#startDatestart").datepicker({
        dateFormat: 'dd-mm-yy'
      });

      $("#endDateend").datepicker({
        dateFormat: 'dd-mm-yy'
      });
    });
  </script>

<?php } ?>








<?php if ($_REQUEST['action'] == 'adddayitinerary') {

  if ($_REQUEST['id'] != '') {
    $a = GetPageRecord('*', 'dayItineraryMaster', 'id="' . decode($_REQUEST['id']) . '"');
    $data = mysqli_fetch_array($a);
  }

?>


  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Destination</label>
            <input type="text" class="form-control reqfield" onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" required="" name="fromCity" value="<?php echo getCityName($data['destination']); ?>" autocomplete="off">
            <input name="destination" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($data['destination']); ?>" />
            <div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Title
            </label>
            <input name="name" type="text" class="form-control reqfield" id="name" value="<?php echo stripslashes($data['name']); ?>" required="">
          </div>
        </div>








        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Details</label>
            <textarea name="details" rows="6" class="form-control"><?php echo stripslashes($data['details']); ?></textarea>
          </div>
        </div>





        <div class="col-md-6">
          <div class="form-group">
            <label for="validationCustom02">Status*
            </label>
            <select name="status" class="form-control" autocomplete="off">

              <option value="1" <?php if ('1' == $data['status']) { ?>selected="selected" <?php } ?>>Active</option>

              <option value="0" <?php if ('0' == $data['status']) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>


      </div>

    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="adddayitinerary" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
  </form>




<?php } ?>



<?php if ($_REQUEST['action'] == 'addbranch') {

  $a = GetPageRecord('*', 'branchMaster', 'id="' . decode($_REQUEST['id']) . '"');
  $result = mysqli_fetch_array($a);
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Name </label>
            <input type="text" class="form-control reqfield" required="" name="name" value="<?php echo stripslashes($result['name']); ?>">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Destinations</label>
            <input type="text" class="form-control reqfield" required="" name="destinations" value="<?php echo stripslashes($result['destinations']); ?>" placeholder="Enter comma seprated destination">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Status*</label>
            <select name="status" id="ff" class="form-control">
              <option value="1" <?php if ($result['status'] == 1) { ?>selected="selected" <?php } ?>>Active</option>
              <option value="2" <?php if ($result['status'] == 2) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addbranch" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>

<?php } ?>



<?php if ($_REQUEST['action'] == 'addrole') {

  $a = GetPageRecord('*', 'roleMaster', 'id="' . decode($_REQUEST['id']) . '"');
  $result = mysqli_fetch_array($a);
?>

  <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">

    <div class="modal-body">
      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Branch</label>


            <select name="branchId" id="branchId" class="form-control" onchange="showbranches();">

              <?php
              $rs = GetPageRecord('*', 'branchMaster', ' status=1 order by name asc');
              while ($rest = mysqli_fetch_array($rs)) {
              ?>
                <option value="<?php echo trim($rest['id']); ?>" <?php if ($result['branchId'] == trim($rest['id'])) { ?>selected="selected" <?php } ?>><?php echo stripslashes($rest['name']); ?></option>
              <?php } ?>
            </select>

            <script>
              function showbranches() {
                var branchId = $('#branchId').val();
                $('#parentId').load('loadroals.php?branchidmain=' + branchId);
              }
            </script>


            <select name="userType" class="form-control" style="display:none;">
              <option value="1" <?php if ($result["userType"] == 1) { ?> selected="selected" <?php } ?>>Team</option>
              <!--<option value="2" <?php if ($result["userType"] == 2) { ?> selected="selected" <?php } ?>>Agent</option>-->
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Parent</label>


            <select name="parentId" id="parentId" class="form-control">
              <option value="0" <?php if ($result['parentId'] == 0) { ?>selected="selected" <?php } ?>>No Parent</option>
              <?php
              if ($_REQUEST['id'] != '') {
                $rs = GetPageRecord('*', 'roleMaster', ' status=1 and branchId="' . $result['branchId'] . '" order by id asc');
                while ($rest = mysqli_fetch_array($rs)) {
              ?>
                  <option value="<?php echo trim($rest['id']); ?>" <?php if ($result['parentId'] == trim($rest['id'])) { ?>selected="selected" <?php } ?>><?php echo stripslashes($rest['name']); ?></option>
              <?php }
              } ?>
            </select>


            <select name="userType" class="form-control" style="display:none;">
              <option value="1" <?php if ($result["userType"] == 1) { ?> selected="selected" <?php } ?>>Team</option>
              <!--<option value="2" <?php if ($result["userType"] == 2) { ?> selected="selected" <?php } ?>>Agent</option>-->
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Role Name </label>
            <input type="text" class="form-control reqfield" required="" name="name" value="<?php echo stripslashes($result['name']); ?>">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="validationCustom02">Status*</label>
            <select name="status" id="ff" class="form-control">
              <option value="1" <?php if ($result['status'] == 1) { ?>selected="selected" <?php } ?>>Active</option>
              <option value="2" <?php if ($result['status'] == 2) { ?>selected="selected" <?php } ?>>Inactive</option>

            </select>
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer">
      <input name="Cancel" type="submit" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-lg waves-effect waves-light btn-primary-gray" />
      <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" />
    </div>

    <input name="action" type="hidden" id="action" value="addrole" />
    <input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
  </form>
  <?php
  if ($_REQUEST['id'] == '') {
  ?>
    <script>
      showbranches();
    </script>
  <?php } ?>
<?php } ?>
    
    <?php if ($_REQUEST['action'] == 'editpaymentpricing' && $_REQUEST['pid'] != '') {

    if ($_REQUEST['pid'] != '') {
        $a = GetPageRecord('*', 'queryPaymentLinks', 'id="' . $_REQUEST['pid'] . '"  ');
        $result = mysqli_fetch_array($a);
    }
    ?>
    <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post"
          enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="validationCustom02">Price
                        </label>
                        <input name="payment_pricing" type="number" min="0" class="form-control"
                               value="<?php echo $result['amount']; ?>" <?php if($result['status'] == 'sent' || $result['status'] == 'paid'){ echo 'disabled'; } ?> />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="validationCustom02">Description
                        </label>
                        <textarea name="description" type="text" class="form-control"><?php echo $result['description'];?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style=" position:relative;">
            <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary"
                   onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;"/>
        </div>
        <input name="action" type="hidden" id="action" value="editpaymentpricing"/>
        <input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>"/>
        <input name="queryid" type="hidden" id="queryid" value="<?php echo $_REQUEST['queryid']; ?>"/>
    </form>
<?php } ?>

<?php if ($_REQUEST['action'] == 'addpaymentlink' && $_REQUEST['queryid'] != '') {

    if ($_REQUEST['pid'] != '') {
        $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . $_REQUEST['pid'] . '"  ');
        $result = mysqli_fetch_array($a);
    }
    ?>
    <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post"
          enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="validationCustom02">Price
                        </label>
                        <input name="payment_pricing" type="number" min="0" class="form-control"
                               value=""/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="validationCustom02">Description
                        </label>
                        <textarea name="description" type="text" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style=" position:relative;">
            <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary"
                   onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;"/>
        </div>
        <input name="action" type="hidden" id="action" value="addpaymentpricing"/>
        <input name="queryid" type="hidden" id="queryid" value="<?php echo $_REQUEST['queryid']; ?>"/>
    </form>
<?php } ?>
    
    
<?php if ($_REQUEST['action'] == 'schedulebreak' && $_REQUEST['userid'] != '') {

    ?>
    <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post"
          enctype="multipart/form-data">
        <div class="modal-body">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="breaktime">Break Time</label>
                    <input type="number" name="breaktime" value="" placeholder="Input number as minutues" id="breaktime" class="form-control">
                </div>
            </div>
        </div>
        <div class="modal-footer" style=" position:relative;">
            <input name="Save" type="submit" value="Save" id="savingbutton" class="btn btn-primary"
                   onclick="this.form.submit(); this.disabled=true; this.value='Saving...';" style="float:right;"/>
        </div>
        <input name="action" type="hidden" id="action" value="schedulebreak"/>
        <input name="url" type="hidden" id="url" value="<?php echo $_REQUEST['url']; ?>"/>
        <input name="userid" type="hidden" id="userid" value="<?php echo $_REQUEST['userid']; ?>"/>
    </form>
<?php } ?>
