<?php

use Razorpay\Api\Api;

include "inc.php";
?>

<?php
/*<script src="assets/js/jquery.min.js"></script>*/
?>

<?php
$fromemail = $_SESSION['userid'];

if (trim($_POST['action']) == 'updateProfile' && trim($_POST['firstName']) != '') {



  $firstName = addslashes($_POST['firstName']);
  $lastName = addslashes($_POST['lastName']);

  $submitName = addslashes($_POST['submitName']);

  $phone = addslashes($_POST['phone']);

  $address = addslashes($_POST['address']);
  $website = addslashes($_POST['website']);

  $countryCode = addslashes($_POST['countryCode']);

  $mobile = addslashes($_POST['mobile']);

  $emailsignature = addslashes($_POST['emailsignature']);

  $oldphoto = addslashes($_POST['oldchangeprofilepic']);
  $submitName = addslashes($_POST['submitName']);

  $editid = decode($_POST['editId']);







  if ($_FILES["changeprofilepic"]["tmp_name"] != "") {

    $rt = mt_rand() . strtotime(date("YMDHis"));

    $companyLogoFileName = basename($_FILES['changeprofilepic']['name']);

    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);

    $profilePhoto = time() . $rt . '.' . $companyLogoFileExtension;



    move_uploaded_file($_FILES["changeprofilepic"]["tmp_name"], "profilepic/{$profilePhoto}");
  }



  if ($profilePhoto == '') {

    $profilePhoto = $oldphoto;
  }







  $namevalue = 'phone="' . $phone . '",profilePhoto="' . $profilePhoto . '",mobile="' . $mobile . '",address="' . $address . '",website="' . $website . '",submitName="' . $submitName . '",countryCode="' . $countryCode . '",firstName="' . $firstName . '",lastName="' . $lastName . '"';



  $where = 'id="' . $editid . '"';

  updatelisting('sys_userMaster', $namevalue, $where);
?>

  <script>
    parent.redirectpage('display.html?ga=myprofile&save=1');
  </script>


<?php



}




if (trim($_POST['action']) == 'setlogoandinclusion') {

  $inclusion = addslashes($_POST['inclusion']);
  $leadURL = addslashes($_POST['leadURL']);

  $paymentAPIKey = addslashes($_POST['paymentAPIKey']);
  $paymentAPISecret = addslashes($_POST['paymentAPISecret']);

  $invoiceTerms = addslashes($_POST['invoiceTerms']);
  $packageImportantTips = addslashes($_POST['packageImportantTips']);
  $oldphoto = addslashes($_POST['oldchangeprofilepic']);

  if ($_FILES["changeprofilepic"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['changeprofilepic']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = time() . $rt . '.' . $companyLogoFileExtension;
    move_uploaded_file($_FILES["changeprofilepic"]["tmp_name"], "profilepic/{$profilePhoto}");
  }



  if ($profilePhoto == '') {
    $profilePhoto = $oldphoto;
  }


  $namevalue = 'inclusion="' . $inclusion . '",invoiceLogo="' . $profilePhoto . '",invoiceTerms="' . $invoiceTerms . '",leadURL="' . $leadURL . '",packageImportantTips="' . $packageImportantTips . '",paymentAPIKey="' . $paymentAPIKey . '",paymentAPISecret="' . $paymentAPISecret . '"';
  $where = 'id="' . $_SESSION['userid'] . '"';
  updatelisting('sys_userMaster', $namevalue, $where);
?>

  <script>
    parent.redirectpage('display.html?ga=setting&save=1');
  </script>


  <?php



}






if (trim($_REQUEST['action']) == 'changetheme' && $_SESSION['userid'] != '' && $_REQUEST['ccolor'] != '') {
  $where = 'id="' . $_SESSION['userid'] . '"';
  updatelisting('sys_userMaster', 'themeColor="#' . $_REQUEST['ccolor'] . '"', $where);
}







if (trim($_POST['action']) == 'addstaff' && trim($_POST['firstName']) != '' && trim($_POST['lastName']) != '' && trim($_POST['email']) != '') {
    include "config/mail.php";
    $email = addslashes($_POST['email']);
    $old_email = addslashes($_POST['old_email']);
    $branchId = addslashes($_POST['branchId']);
    $phone = addslashes($_POST['phone']);
    $userType = addslashes($_POST['userType']);
    $mobile = addslashes($_POST['mobile']);
    $city = addslashes($_POST['city']);
    $state = addslashes($_POST['stateId']);
    $country = addslashes($_POST['countryId']);
    $firstName = addslashes($_POST['firstName']);
    $lastName = addslashes($_POST['lastName']);
    $countryCode = addslashes($_POST['countryCode']);
    $status = ($_POST['status']);
    $countryCode = addslashes($_POST['countryCode']);
    $profile = addslashes($_POST['profile']);
    $profile = addslashes($_POST['profile']);
    $showQueryStatus = addslashes($_POST['showQueryStatus']);
    $editid = decode($_POST['editId']);

    $permissionView = '';
    foreach ($_POST['permissionView'] as $check) {
        $permissionView .= $check . ',';
    }

    $permissionAddEdit = '';
    foreach ($_POST['permissionAddEdit'] as $check) {
        $permissionAddEdit .= $check . ',';
    }

    $randPass = rand(999999, 100000);

    $ccmail = '';
    $file_name = '';


    $a = GetPageRecord('*', 'sys_userMaster', '  id=1');
    $invoiceData = mysqli_fetch_array($a);

    $subject = strip($invoiceData['invoiceCompany']) . ' Assistance';

    $mailbody = 'Dear ' . $firstName . ',<br /><br />
You have received this communication in response to the request for your ' . strip($invoiceData['invoiceCompany']) . ' System account password to be sent to you via e-mail.<br /><br />
Temporary Password: ' . $randPass . '<br /><br />
Please change your password as soon as possible, to ensure total privacy and confidentiality.<br /><br /> 
If you did not request for your password to be reset, please contact us at
' . $invoiceData['invoicePhone'] . ' or email us at ' . $invoiceData['invoiceEmail'] . '<br /><br />    
We hope to see you onboard again soon!<br /><br /> 
' . strip($invoiceData['emailsignature']) . '';


    if ($_FILES["changeprofilepic"]["tmp_name"] != "") {
        $rt = mt_rand() . strtotime(date("YMDHis"));
        $companyLogoFileName = basename($_FILES['changeprofilepic']['name']);
        $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
        $profilePhoto = time() . $rt . '.' . $companyLogoFileExtension;
        move_uploaded_file($_FILES["changeprofilepic"]["tmp_name"], "profilepic/{$profilePhoto}");
    }
    if ($profilePhoto == '') {
        $profilePhoto = $oldphoto;
    }

    $a = GetPageRecord('*', 'sys_userMaster', 'email="' . $old_email . '" and (userType=1 or userType=2)');
    $validateemail = mysqli_fetch_array($a);

    if ($editid != '') {

        if ($_POST['sendpass'] == 1) {
            $password = md5($randPass);
            send_attachment_mail($fromemail, $email, $subject, $mailbody, $ccmail . ',' . $_SESSION['username'], $file_name);
        } else {
            $password = $validateemail['password'];
        }


        $namevalue = 'showQueryStatus="' . $showQueryStatus . '",email="' . $email . '",phone="' . $phone . '",branchId="' . $branchId . '",password="' . $password . '",firstName="' . $firstName . '",lastName="' . $lastName . '",status="' . $status . '",userType="' . $userType . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",permissionView="' . rtrim($permissionView, ',') . '",permissionAddEdit="' . rtrim($permissionAddEdit, ',') . '"';
        $where = 'id="' . $editid . '"';
        updatelisting('sys_userMaster', $namevalue, $where);
        $lstaddid = $editid;
    } else {
        if ($validateemail['id'] == '') {
            $namevalue = 'email="' . $email . '",firstName="' . $firstName . '",phone="' . $phone . '",branchId="' . $branchId . '",lastName="' . $lastName . '",status="' . $status . '",userType="' . $userType . '",password="' . md5($randPass) . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",permissionView="' . rtrim($permissionView, ',') . '",permissionAddEdit="' . rtrim($permissionAddEdit, ',') . '"';
            $lstaddid = addlistinggetlastid('sys_userMaster', $namevalue);

            send_attachment_mail($fromemail, $email, $subject, $mailbody, $ccmail . ',' . $_SESSION['username'], $file_name);
        } else {
            ?>
            <script>
                alert('This email is already exists!');
                parent.$('.animated-progess').hide();
                parent.$('#stoppagediv').hide();
            </script>
            <?php
            exit();
        }
    }


    ?>
    <script>
        parent.redirectpage('display.html?ga=team&save=1');
    </script>
    <?php
}







if (trim($_POST['action']) == 'organisationsettings' && trim($_POST['invoiceCompany']) != '' && trim($_POST['invoiceEmail']) != '' && trim($_POST['invoicePhone']) != '' && trim($_POST['invoiceAddress']) != '') {
  $invoiceCompany = addslashes($_POST['invoiceCompany']);
  $invoiceEmail = addslashes($_POST['invoiceEmail']);
  $invoicePhone = addslashes($_POST['invoicePhone']);
  $invoiceAddress = addslashes($_POST['invoiceAddress']);
  $Invoicegstn = addslashes($_POST['Invoicegstn']);
  $invoiceState = addslashes($_POST['invoiceState']);
  $invoiceStateCode = addslashes($_POST['invoiceStateCode']);
  $manualVoucherPin = addslashes($_POST['manualVoucherPin']);


  $namevalue = 'invoiceCompany="' . $invoiceCompany . '",invoiceEmail="' . $invoiceEmail . '",invoicePhone="' . $invoicePhone . '",invoiceAddress="' . $invoiceAddress . '",Invoicegstn="' . $Invoicegstn . '",invoiceState="' . $invoiceState . '",invoiceStateCode="' . $invoiceStateCode . '",manualVoucherPin="' . $manualVoucherPin . '"';
  $where = 'id="' . $_SESSION['userid'] . '"';
  updatelisting('sys_userMaster', $namevalue, $where);


?>
  <script>
    parent.redirectpage('display.html?ga=setting&save=1');
  </script>
  <?php
}










if (trim($_POST['action']) == 'updatePassword' && trim($_POST['oldpassword']) != '' && trim($_POST['newpassword']) != '' && trim($_POST['repassword']) != '') {



  $oldpassword = trim($_POST['oldpassword']);

  $newpassword = trim($_POST['newpassword']);

  $repassword = trim($_POST['repassword']);

  $editid = decode($_POST['editId']);



  $a = GetPageRecord('*', 'sys_userMaster', 'password="' . md5($oldpassword) . '"');

  if (mysqli_num_rows($a) > 0) {



    if ($newpassword == $repassword) {

      $namevalue = 'password="' . md5($newpassword) . '",dateAdded="' . time() . '",addedBy="' . $_SESSION['userid'] . '"';

      $where = 'id="' . $editid . '"';

      updatelisting('sys_userMaster', $namevalue, $where);

  ?>

      <script>
        alert('Password updated successfully!');
      </script>

    <?php

    } else {

    ?>

      <script>
        alert('Confirm password did not match...!');
      </script>

    <?php

      exit();
    }
  } else {

    ?>

    <script>
      alert('Old password incorrect...! Please try again.');
    </script>

  <?php

    exit();
  }

  ?>

  <script>
    parent.redirectpage('display.html?ga=myprofile&save=1');
  </script>

<?php

}





if (trim($_POST['action']) == 'addtineraries' && trim($_POST['name']) != '' && trim($_POST['startDate']) != '' && trim($_POST['endDate']) != '') {

  $name = addslashes($_POST['name']);
  $queryid = addslashes($_POST['queryid']);
  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['endDate']));
  $websiteValidity = date('Y-m-d', strtotime($_POST['websiteValidity']));
  $adult = addslashes($_POST['adult']);
  $child = addslashes($_POST['child']);
  $destinations = addslashes($_POST['destinations']);
  $relate_key = addslashes($_POST['relate_key']);
  $aboutPackage = addslashes($_POST['aboutPackage']);
  $packageThemeId = addslashes($_POST['packageThemeId']);
  $showwebsite = (isset($_POST['showwebsite']) && !empty($_POST['showwebsite'])) ? addslashes($_POST['showwebsite']) :
      "0";
  $websiteCost = (isset($_POST['websiteCost']) && !empty($_POST['websiteCost'])) ? addslashes($_POST['websiteCost']) :
      "0";
  $showinPopular = (isset($_POST['showinPopular']) && !empty($_POST['showinPopular'])) ? addslashes($_POST['showinPopular']) :
      "0";
  $showinSpecial = (isset($_POST['showinSpecial']) && !empty($_POST['showinSpecial'])) ? addslashes($_POST['showinSpecial']) :
      "0";
  $notes = addslashes($_POST['notes']);
  $location = addslashes($_POST['location']);
  $hotel = addslashes($_POST['hotel']);
  // $aboutPackage = addslashes($_POST['aboutPackage']);
  $description = addslashes($_POST['description']);
  $editId = addslashes($_POST['editId']);
  $tagging = $_POST['tagging'];
  $destination_type = $_POST['destination_type'];
  $tour_type = $_POST['tour_type'];
  $activity_type = $_POST['activity_type'];
  $landscape_type = $_POST['landscape_type'];
  $publicly_visible = $_POST['publicly_visible'];
  $website_visible = $_POST['website_visible'];
  $mapURL = mysqli_real_escape_string(db(),$_POST['mapURL']);
  $keywords = mysqli_real_escape_string(db(),$_POST['keywords']);
  $web_pack_price = $_POST['web_pack_price'];
  $destination_search = $_POST['destination_search'];

  if ($_POST['queryid'] != '') {
    $queryId = decode($_POST['queryid']);
  } else {
    $queryId = 0;
  }

  $abcd = GetPageRecord('*', 'sys_userMaster', 'id="' . $_SESSION['userid'] . '" or addedBy="' . $_SESSION['userid'] . '"');
  $inclusiondata = mysqli_fetch_array($abcd);

  $days = daysbydates($startDate, $endDate) + 1;

  if ($editId != '') {
    deleteRecord('Taggings', 'tagable_id="' . decode($editId) . '" and taggable_type="itinerary"');

    if(isset($tagging) && !empty($tagging)) {
        $tags_id = explode(",", $tagging);
        if(is_array($tags_id) && (count($tags_id) > 0) && (!empty($tags_id[0]))) {
            foreach ($tags_id as $val) {
                $taggings_value = 'tags_id="' . $val . '",tagable_id="' . decode($editId) . '",taggable_type="itinerary"';
                $tags_lstaddid = addlistinggetlastid('Taggings', $taggings_value);
            }
        }
    }

    $namevalue = 'name="' . $name . '",startDate="' . $startDate . '",endDate="' . $endDate . '",adult="' . $adult . '",child="' . $child . '",days="' . $days . '",websiteCost="' . $websiteCost . '",websiteValidity="' . $websiteValidity . '",showwebsite="' . $showwebsite . '",destinations="' . $destinations . '",relate_key="' . $relate_key . '",aboutPackage="' . $aboutPackage . '",packageThemeId="' . $packageThemeId . '",showinPopular="' . $showinPopular . '",showinSpecial="' . $showinSpecial . '",notes="' . $notes . '",location="' . $location . '",hotel="' . $hotel . '",description="' . $description . '",destination_type="' . $destination_type . '",tour_type="' . $tour_type . '",activity_type="' . $activity_type . '",landscape_type="' . $landscape_type . '",publicly_visible="' . $publicly_visible .'", website_visible="'.$website_visible.'", mapURL="'.$mapURL.'",keywords="'.$keywords.'",web_pack_price ="'.$web_pack_price.'",destination_search="'.$destination_search.'",dateAdded="' . date('Y-m-d H:i:s') . '"';
    $where = 'id="' . decode($editId) . '"';
    updatelisting('sys_packageBuilder', $namevalue, $where);
    $lstaddid = decode($editId);

    $b = 0;
    $a = GetPageRecord('*', 'sys_packageBuilderEvent', 'packageId="' . decode($editId) . '" group by startDate order by startDate asc');
    while ($result = mysqli_fetch_array($a)) {

      if ($result['sectionType'] != 'Accommodation') {
        updatelisting('sys_packageBuilderEvent', 'startDate="' . date('Y-m-d', strtotime($_POST['startDate'] . ' + ' . $b . ' days')) . '",endDate="' . date('Y-m-d', strtotime($_POST['startDate'] . ' + ' . $b . ' days')) . '"', 'packageId="' . decode($editId) . '" and sectionType!="Accommodation" and startDate="' . $result['startDate'] . '"');
      }
      if ($result['sectionType'] == 'Accommodation') {
        $days = 0;
        if ($result['days'] > 1) {
          $days = $result['days'] + 1;
        } else {
          $days = $result['days'];
        }

        updatelisting('sys_packageBuilderEvent', 'startDate="' . date('Y-m-d', strtotime($_POST['startDate'] . ' + ' . $b . ' days')) . '",endDate="' . date('Y-m-d', strtotime($_POST['startDate'] . ' + ' . $days . ' days')) . '"', 'packageId="' . decode($editId) . '" and sectionType="Accommodation" and startDate="' . $result['startDate'] . '"');
      }
      $b++;
    }

    if (!empty(array_filter($_FILES['files']['name']))) {
      foreach ($_FILES['files']['tmp_name'] as $key => $value) {
        $rt = mt_rand() . strtotime(date("YMDHis"));
        $itineraryLogoFileName = basename($_FILES['files']['name'][$key]);
        $itineraryLogoFileExtension = pathinfo($itineraryLogoFileName, PATHINFO_EXTENSION);
        $itineraryPhoto = time() . $rt . '.' . $itineraryLogoFileExtension;
        if (!is_dir('package_image')) {
          mkdir('package_image');
        }
        move_uploaded_file($_FILES["files"]["tmp_name"][$key], "package_image/{$itineraryPhoto}");
        $itinerary_image_value = 'image_path="' . $itineraryPhoto  . '",itinerary_id ="' . decode($editId) . '"';
        $lst_imgaddid = addlistinggetlastid('sys_packageBuilder_image', $itinerary_image_value);
      }
    }
  } else {

    $namevalue = 'name="' . $name . '",startDate="' . $startDate . '",packageThemeId="' . $packageThemeId . '",aboutPackage="' . $aboutPackage . '",websiteValidity="' . $websiteValidity . '",showinPopular="' . $showinPopular . '",showinSpecial="' . $showinSpecial . '",endDate="' . $endDate . '",adult="' . $adult . '",websiteCost="' . $websiteCost . '",showwebsite="' . $showwebsite . '",child="' . $child . '",days="' . $days . '",queryId="' . $queryId . '",destinations="' . $destinations . '",relate_key="' . $relate_key . '",notes="' . $notes . '",location="' . $location . '",hotel="' . $hotel . '",description="' . $description . '",destination_type="' . $destination_type . '",tour_type="' . $tour_type . '",activity_type="' . $activity_type . '",landscape_type="' . $landscape_type . '",publicly_visible="' . $publicly_visible . '",website_visible="'.$website_visible.'",mapURL="'.$mapURL.'",keywords="'.$keywords.'",web_pack_price ="'.$web_pack_price.'",destination_search="'.$destination_search.'",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",inclusionExclusion="' . addslashes($inclusiondata['inclusion']) . '",terms="' . addslashes($inclusiondata['invoiceTerms']) . '",baseMarkup="10"';
    $lstaddid = addlistinggetlastid('sys_packageBuilder', $namevalue);

    $tags_id=explode(",",$tagging);
    foreach($tags_id as $val){
      $taggings_value = 'tags_id="' . $val . '",tagable_id="'.$lstaddid.'",taggable_type="itinerary"';
      $tags_lstaddid = addlistinggetlastid('Taggings', $taggings_value);  
    }
 
    if (!empty(array_filter($_FILES['files']['name']))) {
      foreach ($_FILES['files']['tmp_name'] as $key => $value) {
        $rt = mt_rand() . strtotime(date("YMDHis"));
        $itineraryLogoFileName = basename($_FILES['files']['name'][$key]);
        $itineraryLogoFileExtension = pathinfo($itineraryLogoFileName, PATHINFO_EXTENSION);
        $itineraryPhoto = time() . $rt . '.' . $itineraryLogoFileExtension;
        if (!is_dir('package_image')) {
          mkdir('package_image');
        }
        move_uploaded_file($_FILES["files"]["tmp_name"][$key], "package_image/{$itineraryPhoto}");
        $itinerary_image_value = 'image_path="' . $itineraryPhoto  . '",itinerary_id ="' . $lstaddid . '"';
        $lst_imgaddid = addlistinggetlastid('sys_packageBuilder_image', $itinerary_image_value);
      }
    }

    $rs = GetPageRecord($select, 'sys_userMaster', 'id=1 ');
    $editresult = mysqli_fetch_array($rs);

    $cancell = '<ul style="list-style-type: square;">
    <li>Date of booking to 30 days before travel the cancellation charges will be 25% of the tour cost</li>
    <li>30 to 15 days before travel - cancellation charges will be 50% of the tour cost</li>
    <li>15 to 7 days before travel - cancellation charges will be 75% of the tour cost</li>
    <li>0 to 7 days before travel - cancellation charges will be 100% of the tour cost. No refund shall be given</li>
    <li>Please Note: Cancellation policy is subject to change. It depends on the hotel policy.</li>
    <li>In peak season (example: long weekends, festival season, summer vacation etc.) most of the hotels charge 100% cancellation</li>
    </ul>
    <h3><strong>Airline Cancellation Policy:</strong></h3>
    <ul style="list-style-type: square;">
    <li>Your flights are non-refundable. In the event of cancellation, you will not get any refund for flights.</li>
    </ul>';

    $namevalue = 'packageId="' . $lstaddid . '",title="' . addslashes($editresult['inclusionsTitle']) . '",description="' . addslashes($editresult['packageInclusions']) . '",iconset="' . $editresult['inclusionsImg'] . '"';
    addlistinggetlastid('sys_PackageTips', $namevalue);

    $namevalue = 'packageId="' . $lstaddid . '",title="' . addslashes($editresult['importantTipsTitle']) . '",description="' . addslashes($editresult['packageImportantTips']) . '",iconset="' . $editresult['impTipsImg'] . '"';
    addlistinggetlastid('sys_PackageTips', $namevalue);

    $namevalue = 'packageId="' . $lstaddid . '",title="' . addslashes($editresult['exclusionsTitle']) . '",description="' . addslashes($editresult['packageExclusions']) . '",iconset="' . $editresult['exclusionsImg'] . '"';
    addlistinggetlastid('sys_PackageTips', $namevalue);

    $namevalue = 'packageId="' . $lstaddid . '",title="' . addslashes($editresult['travelInformationTitle']) . '",description="' . addslashes($editresult['packageTravelInfo']) . '",iconset="' . $editresult['travelInfoImg'] . '"';
    addlistinggetlastid('sys_PackageTips', $namevalue);

    $namevalue = 'packageId="' . $lstaddid . '",title="Cancellation Policy & Airline Cancellation Policy", description="'.addslashes($cancell).'",iconset="16450947871990465531643885187.jpg"';
    addlistinggetlastid('sys_PackageTips', $namevalue);

    $namevalue = 'packageId="' . $lstaddid . '",title="Things to Do", description="",iconset="16450947871990465531643885187.jpg"';
    addlistinggetlastid('sys_PackageTips', $namevalue);

    $namevalue = 'packageId="' . $lstaddid . '",title="Best time to visit", description="",iconset="16450947871990465531643885187.jpg"';
    addlistinggetlastid('sys_PackageTips', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo encode($lstaddid); ?>&save=1');
  </script>
<?php
}


if (trim($_POST['action']) == 'addcollection' && trim($_POST['name']) != '' && trim($_POST['description']) != '' && trim($_POST['location']) != '') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $location = $_POST['location'];
  $itenaries = $_POST['itinerary'];
  $tagging = $_POST['tagging'];
  $destination_type = $_POST['destination_type'];
  $location_type = $_POST['location_type'];
  $editId = addslashes($_POST['editId']);
  $current = date("Y-m-d h:i:s");
if($editId != '')
{
  deleteRecord('Taggings', 'tagable_id="' . decode($editId) . '" and taggable_type="collection"');
  $tags_id=explode(",",$tagging);
  foreach($tags_id as $val){
    $taggings_value = 'tags_id="' . $val . '",tagable_id="'.decode($editId).'",taggable_type="collection"';
    $tags_lstaddid = addlistinggetlastid('Taggings', $taggings_value);  
  }
 
  $namevalue = "name='".$name."',location='".$location."',description='".$description."',destination_type='". $destination_type . "',location_type='" . $location_type ."',updated_at='".$current."'";
  $where = 'id="' . decode($editId) . '"';
  updatelisting('Collection', $namevalue, $where);
  if ($itenaries) {
    deleteRecord('Collection_itineraries', 'collection_id="' . decode($editId) . '"');
    foreach ($itenaries as $key => $value) {
      $itenaries_value = 'collection_id="' .  decode($editId) . '",itinerary_id="' . $value . '"';
      $lst_iteaddid = addlistinggetlastid('Collection_itineraries', $itenaries_value);
    }
  }
  if (!empty(array_filter($_FILES['files']['name']))) {
    foreach ($_FILES['files']['tmp_name'] as $key => $value) {
      $rt = mt_rand() . strtotime(date("YMDHis"));
      $CollectionLogoFileName = basename($_FILES['files']['name'][$key]);
      $CollectionLogoFileExtension = pathinfo($CollectionLogoFileName, PATHINFO_EXTENSION);
      $collectionPhoto = time() . $rt . '.' . $CollectionLogoFileExtension;
      if (!is_dir('collectionphotos')) {
        mkdir('collectionphotos');
      }
      move_uploaded_file($_FILES["files"]["tmp_name"][$key], "collectionphotos/{$collectionPhoto}");
      $collection_image_value = 'image_path="' . $collectionPhoto  . '",collection_id ="' . decode($editId) . '"';
      $lst_imgaddid = addlistinggetlastid('Collection_image', $collection_image_value);
    }
  }
  ?>
  <script>
    parent.redirectpage('display.html?ga=collection&view=1&id=<?php echo $editId; ?>&save=1');
  </script>
<?php

}
else{

  $collection_value = 'description="' . $description . '",location="' . $location . '",name="' . $name . '",destination_type="' . $destination_type . '",location_type="' . $location_type . '"';
  $lstaddid = addlistinggetlastid('Collection', $collection_value);
  if ($itenaries) {
    foreach ($itenaries as $key => $value) {
      $itenaries_value = 'collection_id="' .  $lstaddid . '",itinerary_id="' . $value . '"';
      $lst_iteaddid = addlistinggetlastid('Collection_itineraries', $itenaries_value);
    }
  }
  $tags_id=explode(",",$tagging);
  foreach($tags_id as $val){
    $taggings_value = 'tags_id="' . $val . '",tagable_id="'.$lstaddid.'",taggable_type="collection"';
    $tags_lstaddid = addlistinggetlastid('Taggings', $taggings_value);  
  }
 
  if (!empty(array_filter($_FILES['files']['name']))) {
    foreach ($_FILES['files']['tmp_name'] as $key => $value) {
      $rt = mt_rand() . strtotime(date("YMDHis"));
      $CollectionLogoFileName = basename($_FILES['files']['name'][$key]);
      $CollectionLogoFileExtension = pathinfo($CollectionLogoFileName, PATHINFO_EXTENSION);
      $collectionPhoto = time() . $rt . '.' . $CollectionLogoFileExtension;
      if (!is_dir('collectionphotos')) {
        mkdir('collectionphotos');
      }
      move_uploaded_file($_FILES["files"]["tmp_name"][$key], "collectionphotos/{$collectionPhoto}");
      $collection_image_value = 'image_path="' . $collectionPhoto  . '",collection_id ="' . $lstaddid . '"';
      $lst_imgaddid = addlistinggetlastid('Collection_image', $collection_image_value);
    }
  }
  ?>
  <script>
    parent.redirectpage('display.html?ga=collection&view=1&id=<?php echo encode($lstaddid); ?>&save=1');
  </script>
<?php

}

}

if (trim($_POST['action']) == 'deletecollection') {
  deleteFiles('image_path','Collection_image',"collection_id=".$_POST['id']);
  deleteRecord('Collection',"id=".$_POST['id']);
  deleteRecord('Taggings', 'tagable_id="' . $_POST['id'] . '" and taggable_type="collection"');

}

if (trim($_POST['action']) == 'delete_single_photo') {
  deleteFiles('image_path','Collection_image',"id=".$_POST['id']);
  deleteRecord('Collection_image',"id=".$_POST['id']);
}


if (trim($_POST['action']) == 'delete_single_itinerary_photo') {
  deleteitineraryFiles('image_path','sys_packageBuilder_image',"id=".$_POST['id']);
  deleteRecord('sys_packageBuilder_image',"id=".$_POST['id']);
}

if (trim($_POST['action']) == 'addtaggings' && trim($_POST['name']) != '' && trim($_POST['type']) != '') {

  $name = $_POST['name'];
  $type = $_POST['type'];
  $current = date("Y-m-d h:i:s");
  $editId = addslashes($_POST['editId']);
  
  $sql = "select count(*) as count from  Tag_type where name='".$type."'";
  $rs = mysqli_query(db(), $sql) or die(mysqli_error());
  $typeexistornot = mysqli_fetch_array($rs, MYSQLI_BOTH);
  if($typeexistornot[0]==0){
    $taggings_value = 'name="' . $type . '"';
    addlistinggetlastid('Tag_type', $taggings_value);  
  }

  if($editId != '')
  {
    $namevalue = "name='".$name."',type='".$type."',updated_at='".$current."'";
    $where = 'id="' . decode($editId) . '"';
    updatelisting('Tags', $namevalue, $where);

    ?>
    <script>
      parent.redirectpage('display.html?ga=taggings&save=1');
    </script>
  <?php

  }
  else{
    $taggings_value = 'name="' . $name . '",type="' . $type . '"';
    $lstaddid = addlistinggetlastid('Tags', $taggings_value);

    ?>
    <script>
      parent.redirectpage('display.html?ga=taggings&save=1');
    </script>
  <?php

  }
}


if (trim($_POST['action']) == 'deletetaggings') {
  deleteRecord('Tags',"id=".$_POST['id']);
}


if (trim($_POST['action']) == 'confirmitineararies' && trim($_POST['editId']) != '' && trim($_POST['queryid']) != '') {


  $namevalue = 'confirmQuote=0,confirmedBy="",confirmDate=""';
  $where = 'queryId="' . decode($_POST['queryid']) . '"';
  updatelisting('sys_packageBuilder', $namevalue, $where);


  $namevalue = 'packageId="' . decode($_POST['editId']) . '"';
  $where = 'queryId="' . decode($_POST['queryid']) . '"';
  updatelisting('sys_invoiceMaster', $namevalue, $where);

  $namevalue = 'packageId="' . decode($_POST['editId']) . '"';
  $where = 'queryId="' . decode($_POST['queryid']) . '"';
  updatelisting('sys_PackagePayment', $namevalue, $where);



  $namevalue = 'confirmQuote=1,confirmedBy="' . $_SESSION['userid'] . '",confirmDate="' . date('Y-m-d H:i:s') . '"';
  $where = 'id="' . decode($_POST['editId']) . '"';
  updatelisting('sys_packageBuilder', $namevalue, $where);

  updatelisting('queryMaster', 'statusid=9', 'id="' . decode($_POST['queryid']) . '"');

?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['queryid']; ?>&c=2&save=1');
  </script>
<?php
}





if (trim($_POST['action']) == 'confirmtask' && trim($_POST['editId']) != '' && trim($_POST['qid']) != '') {

  $namevalue = 'makeDone=1,confirmDate="' . date('Y-m-d H:i:s') . '"';
  $where = 'id="' . decode($_POST['editId']) . '" and queryId="' . decode($_POST['qid']) . '"';
  updatelisting('queryTask', $namevalue, $where);

?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['qid']; ?>&c=3&save=1');
  </script>
<?php
}





if (trim($_POST['action']) == 'addAccommodation' && trim($_POST['hotelName']) != '' && trim($_POST['hotelRoom']) != '' && trim($_POST['startDate']) != '' && trim($_POST['endDate']) != '') {




  $hotelName = addslashes($_POST['hotelName']);
  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['endDate']));
  $hotelRoom = addslashes($_POST['hotelRoom']);


  $hotelCategory = addslashes($_POST['hotelCategory']);
  $mealPlan = addslashes($_POST['mealPlan']);
  $singleRoom = addslashes($_POST['singleRoom']);
  $doubleRoom = addslashes($_POST['doubleRoom']);
  $tripleRoom = addslashes($_POST['tripleRoom']);
  $quadRoom = addslashes($_POST['quadRoom']);
  $cwbRoom = addslashes($_POST['cwbRoom']);
  $cnbRoom = addslashes($_POST['cnbRoom']);
  $checkIn = addslashes($_POST['checkIn']);
  $checkOut = addslashes($_POST['checkOut']);
  $description = addslashes($_POST['description']);
  $showTime = addslashes($_POST['showTime']);
  $pid = decode($_POST['pid']);
  $editId = addslashes($_POST['editId']);
  $packageDays = addslashes($_POST['packageDays']);
  $destinationName = addslashes(trim($_POST['destinationName']));

  $days = daysbydates($startDate, $endDate);
  if ($days == 0) {
    $days = 1;
  }

  $addprice = '';
  $pricetype = addslashes($_POST['pricetype']);
  if ($pricetype == 2) {
    $hotelnamemaster = addslashes($_POST['hotelnamemaster']);

    $a = GetPageRecord('*', 'hotelMaster', 'id="' . $hotelnamemaster . '"');
    $resulthot = mysqli_fetch_array($a);
    $hotelName = $resulthot['name'];



    $hotelPriceId = addslashes($_POST['hotelPriceId']);

    $ab = GetPageRecord('*', 'hotelRateList', 'id="' . $hotelPriceId . '" ');
    $data = mysqli_fetch_array($ab);

    $addprice = ',singleRoomCost="' . ($data['single'] * $days) . '",doubleRoomCost="' . ($data['doublePrice'] * $days) . '",tripleRoomCost="' . ($data['triple'] * $days) . '",quadRoomCost="' . ($data['quad'] * $days) . '",cwbRoomCost="' . ($data['childBed'] * $days) . '",cnbRoomCost="' . ($data['extraAdult'] * $days) . '"';

    $hotelRoommaster = addslashes($_POST['hotelRoommaster']);

    $a = GetPageRecord('*', 'RoomTypeMaster', 'name="' . $hotelRoommaster . '"');
    $roomData = mysqli_fetch_array($a);
    $hotelRoom = $roomData['name'];

    $mealPlanmaster = addslashes($_POST['mealPlanmaster']);

    $a = GetPageRecord('*', 'mealPlanMaster', 'name="' . $mealPlanmaster . '"');
    $mealData = mysqli_fetch_array($a);
    $mealPlan = $mealData['name'];
  }




  if ($editId != '') {

    $namevalue = 'hotelType="' . $pricetype . '",hotelId="' . $hotelnamemaster . '",hotelPriceId="' . $hotelPriceId . '",name="' . $hotelName . '",startDate="' . $startDate . '",endDate="' . $endDate . '",description="' . $description . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",days="' . $days . '",destinationName="' . $destinationName . '",showTime="' . $showTime . '"' . $addprice . '';
    $where = 'id="' . decode($editId) . '"';
    updatelisting('sys_packageBuilderEvent', $namevalue, $where);
  } else {

    $namevalue = 'hotelType="' . $pricetype . '",hotelId="' . $hotelnamemaster . '",hotelPriceId="' . $hotelPriceId . '",name="' . $hotelName . '",packageId="' . $pid . '",packageDays="' . $packageDays . '",description="' . $description . '",startDate="' . $startDate . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",sectionType="Accommodation",addedBy="' . $_SESSION['userid'] . '",days="' . $days . '",dateAdded="' . date('Y-m-d H:i:s') . '",destinationName="' . $destinationName . '",showTime="' . $showTime . '"' . $addprice . '';
    $lstaddid = addlistinggetlastid('sys_packageBuilderEvent', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>');
  </script>
<?php
}











if (trim($_REQUEST['action']) == 'delteevent' && trim($_REQUEST['did']) != '' && trim($_REQUEST['pid']) != '') {

  $abcd = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . decode($_REQUEST['did']) . '"');
  $result = mysqli_fetch_array($abcd);

  deleteRecord('sys_packageBuilderEvent', 'id="' . decode($_REQUEST['did']) . '" and packageId="' . decode($_REQUEST['pid']) . '"');



?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $result['packageDays']; ?>&save=1');
  </script>
<?php
}












if (trim($_POST['action']) == 'addActivity' && trim($_POST['name']) != '' && trim($_POST['startDate']) != '') {
  $packageDays = addslashes($_POST['packageDays']);
  $hotelName = addslashes($_POST['name']);
  $showTime = addslashes($_POST['showTime']);
  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['startDate']));
  $hotelRoom = addslashes($_POST['hotelRoom']);
  $hotelCategory = addslashes($_POST['hotelCategory']);
  $mealPlan = addslashes($_POST['mealPlan']);
  $singleRoom = addslashes($_POST['singleRoom']);
  $doubleRoom = addslashes($_POST['doubleRoom']);
  $tripleRoom = addslashes($_POST['tripleRoom']);
  $quadRoom = addslashes($_POST['quadRoom']);
  $cwbRoom = addslashes($_POST['cwbRoom']);
  $cnbRoom = addslashes($_POST['cnbRoom']);
  $checkIn = addslashes($_POST['checkIn']);
  $checkOut = addslashes($_POST['checkOut']);
  $pid = decode($_POST['pid']);
  $editId = addslashes($_POST['editId']);
  $description = addslashes($_POST['description']);
  $destinationName = addslashes(trim($_POST['destinationName']));
  $days = daysbydates($startDate, $endDate) + 1;



  $addprice = '';
  $pricetype = addslashes($_POST['pricetype']);
  if ($pricetype == 2) {
    $namemaster = addslashes($_POST['namemaster']);

    $a = GetPageRecord('*', 'sightseeingMaster', 'id="' . $namemaster . '"');
    $resulthot = mysqli_fetch_array($a);
    $hotelName = $resulthot['name'];

    $hotelPriceId = addslashes($_POST['hotelPriceId']);

    $ab = GetPageRecord('*', 'sightseeingRateList', 'id="' . $hotelPriceId . '" ');
    $data = mysqli_fetch_array($ab);



    $addprice = ',adultCost="' . $data['adult'] . '",childCost="' . $data['child'] . '"';
  }





  if ($editId != '') {


    $namevalue = 'hotelType="' . $pricetype . '",hotelId="' . $namemaster . '",hotelPriceId="' . $hotelPriceId . '",name="' . $hotelName . '",startDate="' . $startDate . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",description="' . $description . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",days="' . $days . '",destinationName="' . $destinationName . '",showTime="' . $showTime . '",eventPhoto="' . $resulthot['photo'] . '"' . $addprice . '';
    $where = 'id="' . decode($editId) . '"';
    updatelisting('sys_packageBuilderEvent', $namevalue, $where);
  } else {

    if ($pricetype == 2) {
      $description = $resulthot['details'];
    }

    $namevalue = 'hotelType="' . $pricetype . '",hotelId="' . $hotelnamemaster . '",hotelPriceId="' . $hotelPriceId . '",name="' . $hotelName . '",packageId="' . $pid . '",startDate="' . $startDate . '",packageDays="' . $packageDays . '",description="' . $description . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",sectionType="Activity",addedBy="' . $_SESSION['userid'] . '",days="' . $days . '",dateAdded="' . date('Y-m-d H:i:s') . '",destinationName="' . $destinationName . '",showTime="' . $showTime . '",eventPhoto="' . $resulthot['photo'] . '"' . $addprice . '';
    $lstaddid = addlistinggetlastid('sys_packageBuilderEvent', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>');
  </script>
<?php
}






if (trim($_POST['action']) == 'addTransportation' && trim($_POST['name']) != '' && trim($_POST['startDate']) != '' && trim($_POST['transferCategory']) != '') {
  $packageDays = addslashes($_POST['packageDays']);
  $hotelName = addslashes($_POST['name']);
  $showTime = addslashes($_POST['showTime']);
  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['startDate']));
  $hotelRoom = addslashes($_POST['hotelRoom']);
  $hotelCategory = addslashes($_POST['hotelCategory']);
  $mealPlan = addslashes($_POST['mealPlan']);
  $singleRoom = addslashes($_POST['singleRoom']);
  $doubleRoom = addslashes($_POST['doubleRoom']);
  $tripleRoom = addslashes($_POST['tripleRoom']);
  $quadRoom = addslashes($_POST['quadRoom']);
  $cwbRoom = addslashes($_POST['cwbRoom']);
  $cnbRoom = addslashes($_POST['cnbRoom']);
  $checkIn = addslashes($_POST['checkIn']);
  $checkOut = addslashes($_POST['checkOut']);
  $transferCategory = addslashes($_POST['transferCategory']);
  $destinationName = addslashes(trim($_POST['destinationName']));
  $pid = decode($_POST['pid']);
  $editId = addslashes($_POST['editId']);
  $description = addslashes($_POST['description']);
  $eventPhoto = addslashes($_POST['eventPhoto']);
  $days = daysbydates($startDate, $endDate) + 1;





  $addprice = '';
  $pricetype = addslashes($_POST['pricetype']);
  if ($pricetype == 2) {
    $namemaster = addslashes($_POST['namemaster']);

    $a = GetPageRecord('*', 'transferMaster', 'id="' . $namemaster . '"');
    $resulthot = mysqli_fetch_array($a);
    $hotelName = $resulthot['name'];

    $hotelPriceId = addslashes($_POST['hotelPriceId']);

    if ($transferCategory == 'SIC') {
      $transferCategory = 1;
    }
    if ($transferCategory == 'Private') {
      $transferCategory = 2;
    }

    $ab = GetPageRecord('*', 'transferRateList', ' parentId="' . $resulthot['id'] . '" and startDate<="' . $_REQUEST['day'] . '" and transferType="' . $transferCategory . '" order by id desc');
    $data = mysqli_fetch_array($ab);
    if ($data['transferType'] == 1) {
      $addprice = ',adultCost="' . $data['adult'] . '",childCost="' . $data['child'] . '"';
    }

    if ($data['transferType'] == 2) {
      $addprice = ',vehicle="1",adultCost="' . $data['vehicleCost'] . '"';
    }
  }






  if ($editId != '') {

    $namevalue = 'hotelType="' . $pricetype . '",hotelId="' . $hotelnamemaster . '",hotelPriceId="' . $hotelPriceId . '",name="' . $hotelName . '",startDate="' . $startDate . '",endDate="' . $endDate . '",description="' . $description . '",eventPhoto="' . $eventPhoto . '",transferCategory="' . $_POST['transferCategory'] . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",days="' . $days . '",destinationName="' . $destinationName . '",showTime="' . $showTime . '"' . $addprice . '';
    $where = 'id="' . decode($editId) . '"';
    updatelisting('sys_packageBuilderEvent', $namevalue, $where);
  } else {

    $namevalue = 'hotelType="' . $pricetype . '",hotelId="' . $hotelnamemaster . '",hotelPriceId="' . $hotelPriceId . '",name="' . $hotelName . '",packageId="' . $pid . '",startDate="' . $startDate . '",description="' . $description . '",eventPhoto="' . $eventPhoto . '",packageDays="' . $packageDays . '",endDate="' . $endDate . '",transferCategory="' . $_POST['transferCategory'] . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",sectionType="Transportation",addedBy="' . $_SESSION['userid'] . '",days="' . $days . '",dateAdded="' . date('Y-m-d H:i:s') . '",destinationName="' . $destinationName . '",showTime="' . $showTime . '"' . $addprice . '';
    $lstaddid = addlistinggetlastid('sys_packageBuilderEvent', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>');
  </script>
<?php
}






if (trim($_POST['action']) == 'addFeesInsurance' && trim($_POST['name']) != '' && trim($_POST['startDate']) != '') {
  $packageDays = addslashes($_POST['packageDays']);
  $hotelName = addslashes($_POST['name']);
  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['startDate']));
  $hotelRoom = addslashes($_POST['hotelRoom']);
  $hotelCategory = addslashes($_POST['hotelCategory']);
  $mealPlan = addslashes($_POST['mealPlan']);
  $singleRoom = addslashes($_POST['singleRoom']);
  $doubleRoom = addslashes($_POST['doubleRoom']);
  $tripleRoom = addslashes($_POST['tripleRoom']);
  $quadRoom = addslashes($_POST['quadRoom']);
  $cwbRoom = addslashes($_POST['cwbRoom']);
  $cnbRoom = addslashes($_POST['cnbRoom']);
  $checkIn = addslashes($_POST['checkIn']);
  $checkOut = addslashes($_POST['checkOut']);
  $pid = decode($_POST['pid']);
  $editId = addslashes($_POST['editId']);
  $description = addslashes($_POST['description']);
  $destinationName = addslashes(trim($_POST['destinationName']));
  $days = daysbydates($startDate, $endDate) + 1;

  if ($editId != '') {

    $namevalue = 'name="' . $hotelName . '",startDate="' . $startDate . '",endDate="' . $endDate . '",description="' . $description . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",days="' . $days . '",destinationName="' . $destinationName . '"';
    $where = 'id="' . decode($editId) . '"';
    updatelisting('sys_packageBuilderEvent', $namevalue, $where);
  } else {

    $namevalue = 'name="' . $hotelName . '",packageId="' . $pid . '",startDate="' . $startDate . '",description="' . $description . '",packageDays="' . $packageDays . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",sectionType="FeesInsurance",addedBy="' . $_SESSION['userid'] . '",days="' . $days . '",dateAdded="' . date('Y-m-d H:i:s') . '",destinationName="' . $destinationName . '"';
    $lstaddid = addlistinggetlastid('sys_packageBuilderEvent', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>');
  </script>
<?php
}





if (trim($_POST['action']) == 'addOther' && trim($_POST['name']) != '' && trim($_POST['startDate']) != '') {
  $packageDays = addslashes($_POST['packageDays']);





  $hotelName = addslashes($_POST['name']);
  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['startDate']));
  $hotelRoom = addslashes($_POST['hotelRoom']);
  $hotelCategory = addslashes($_POST['hotelCategory']);
  $mealPlan = addslashes($_POST['mealPlan']);
  $singleRoom = addslashes($_POST['singleRoom']);
  $doubleRoom = addslashes($_POST['doubleRoom']);
  $tripleRoom = addslashes($_POST['tripleRoom']);
  $quadRoom = addslashes($_POST['quadRoom']);
  $cwbRoom = addslashes($_POST['cwbRoom']);
  $cnbRoom = addslashes($_POST['cnbRoom']);
  $checkIn = addslashes($_POST['checkIn']);
  $checkOut = addslashes($_POST['checkOut']);
  $pid = decode($_POST['pid']);
  $editId = addslashes($_POST['editId']);
  $description = addslashes($_POST['description']);

  $flightNo = addslashes($_POST['flightNo']);
  $fromDestination = addslashes($_POST['fromDestination']);
  $toDestination = addslashes($_POST['toDestination']);
  $flightDuration = addslashes($_POST['flightDuration']);

  $days = daysbydates($startDate, $endDate) + 1;

  if ($editId != '') {

    $namevalue = 'name="' . $hotelName . '",startDate="' . $startDate . '",description="' . $description . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",days="' . $days . '",flightNo="' . $flightNo . '",fromDestination="' . $fromDestination . '",toDestination="' . $toDestination . '",flightDuration="' . $flightDuration . '"';
    $where = 'id="' . decode($editId) . '"';
    updatelisting('sys_packageBuilderEvent', $namevalue, $where);
  } else {

    $namevalue = 'name="' . $hotelName . '",packageId="' . $pid . '",description="' . $description . '",startDate="' . $startDate . '",packageDays="' . $packageDays . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",sectionType="Flight",addedBy="' . $_SESSION['userid'] . '",days="' . $days . '",dateAdded="' . date('Y-m-d H:i:s') . '",flightNo="' . $flightNo . '",fromDestination="' . $fromDestination . '",toDestination="' . $toDestination . '",flightDuration="' . $flightDuration . '"';
    $lstaddid = addlistinggetlastid('sys_packageBuilderEvent', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>');
  </script>
<?php
}










if (trim($_POST['action']) == 'addMeal' && trim($_POST['name']) != '' && trim($_POST['startDate']) != '') {
  $packageDays = addslashes($_POST['packageDays']);
  $hotelName = addslashes($_POST['name']);
  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['startDate']));
  $hotelRoom = addslashes($_POST['hotelRoom']);
  $hotelCategory = addslashes($_POST['hotelCategory']);
  $mealPlan = addslashes($_POST['mealPlan']);
  $singleRoom = addslashes($_POST['singleRoom']);
  $doubleRoom = addslashes($_POST['doubleRoom']);
  $tripleRoom = addslashes($_POST['tripleRoom']);
  $quadRoom = addslashes($_POST['quadRoom']);
  $cwbRoom = addslashes($_POST['cwbRoom']);
  $cnbRoom = addslashes($_POST['cnbRoom']);
  $checkIn = addslashes($_POST['checkIn']);
  $checkOut = addslashes($_POST['checkOut']);
  $showTime = addslashes($_POST['showTime']);
  $pid = decode($_POST['pid']);
  $editId = addslashes($_POST['editId']);
  $mealCategory = addslashes($_POST['mealCategory']);
  $description = addslashes($_POST['description']);
  $destinationName = addslashes(trim($_POST['destinationName']));
  $days = daysbydates($startDate, $endDate) + 1;

  if ($editId != '') {

    $namevalue = 'name="' . $hotelName . '",startDate="' . $startDate . '",description="' . $description . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",mealCategory="' . $mealCategory . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",days="' . $days . '",destinationName="' . $destinationName . '",showTime="' . $showTime . '"';
    $where = 'id="' . decode($editId) . '"';
    updatelisting('sys_packageBuilderEvent', $namevalue, $where);
  } else {

    $namevalue = 'name="' . $hotelName . '",packageId="' . $pid . '",description="' . $description . '",startDate="' . $startDate . '",packageDays="' . $packageDays . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",mealCategory="' . $mealCategory . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",sectionType="Meal",addedBy="' . $_SESSION['userid'] . '",days="' . $days . '",dateAdded="' . date('Y-m-d H:i:s') . '",destinationName="' . $destinationName . '",showTime="' . $showTime . '"';
    $lstaddid = addlistinggetlastid('sys_packageBuilderEvent', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&pd=<?php echo $_REQUEST['packageDays']; ?>');
  </script>
<?php
}

if(trim($_POST['action'])=='editpricing' && trim($_POST['adultCost'])!='' && trim($_POST['editId'])!='' && trim($_POST['pid'])!=''){
  $adultCost=addslashes(trim($_POST['adultCost']));  
  
  
  
  $childCost=addslashes(trim($_POST['childCost']));   
  
  
  
  $vehicle=addslashes(trim($_POST['vehicle']));
  
  
  
  $markupPercent=isset($_POST['markupPercent'])? addslashes(trim($_POST['markupPercent'])):0;  
  $markupPercent = ($markupPercent == '')? 0: $markupPercent;

  
  
  
  $editId=addslashes($_POST['editId']);   
  
  
  
        
  
  
  
      
  
  
  
  $rs2=GetPageRecord('*','currencyExchangeMaster','id=2 order by id asc');
  
  
  
  $restsup=mysqli_fetch_array($rs2); 
  
  
  
  
  
  
  
   
  
  
  
  $namevalue ='adultCost="'.$adultCost.'",childCost="'.$childCost.'",vehicle="'.$vehicle.'",markupPercent="'.$markupPercent.'",markupValue="'.$markupValue.'",currencyId="2",currencyValue="'.($restsup['rate']).'"';  

  //echo $namevalue;
  
  
  
  $where='id="'.decode($editId).'"';    
  
  
  
  updatelisting('sys_packageBuilderEvent',$namevalue,$where);  
  
  
  
  
  
  
  
   
  
  
  
  
  
  
  
  ?> 
  
  
  
  <script> 
  
  parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_POST['pid']; ?>&save=1&b=2');
  
  
  
  </script> 
  
  
  
  <?php 
  
  
  
  }














if (trim($_POST['action']) == 'editpricing' && trim($_POST['overall_pricing']) != '' && trim($_POST['editId']) != '' && trim($_POST['pid']) != '') {
        $pid = $_POST['pid'];
        $overall_pricing = addslashes($_POST['overall_pricing']);
        $markupPercent = addslashes(trim($_POST['markupTotal']));
        $markupTotal = $markupPercent;
        $international = addslashes($_POST['international']);
        $editId = addslashes($_POST['editId']);

        $rs2 = GetPageRecord('*', 'currencyExchangeMaster', 'id=2 order by id asc');
        $restsup = mysqli_fetch_array($rs2);

        $namevalue = 'adultCost="' . $adultCost . '",childCost="' . $childCost . '",vehicle="' . $vehicle . '",markupPercent="' . $markupPercent . '",markupValue="' . $markupValue . '",currencyId="2",currencyValue="' . ($restsup['rate']) . '",overall_pricing="'.$overall_pricing.'" ,markupTotal="'.$markupTotal.'", international_trip="'.$international.'"';
        $where = 'id="' . decode($editId) . '"';
        updatelisting('sys_packageBuilderEvent', $namevalue, $where);

        $dataForMarkup = GetTotalOfColumn('markupTotal', 'sys_packageBuilderEvent','packageId="' . decode($pid) . '" and sectionType!="Leisure" and markupTotal>0');
        $total_of_markup = $dataForMarkup[0];

        $namevalue = 'extraMarkup="' . $total_of_markup . '"';
        $where = 'id="' . decode($pid) . '" ';
        updatelisting('sys_packageBuilder', $namevalue, $where);

        ?>
    <script>
        parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_POST['pid']; ?>&save=1&b=2');
    </script>
    <?php
}





if (trim($_POST['action']) == 'editpricingAccommodation' && trim($_POST['editId']) != '' && trim($_POST['pid']) != '') {

    $pid = $_POST['pid'];
    $singleRoomCost = addslashes(trim($_POST['singleRoomCost']));
    $doubleRoomCost = addslashes(trim($_POST['doubleRoomCost']));
    $tripleRoomCost = addslashes(trim($_POST['tripleRoomCost']));
    $quadRoomCost = addslashes(trim($_POST['quadRoomCost']));
    $cwbRoomCost = addslashes(trim($_POST['cwbRoomCost']));
    $cnbRoomCost = addslashes(trim($_POST['cnbRoomCost']));
    $markupPercent = addslashes(trim($_POST['markupPercent']));
    $overall_pricing = addslashes(trim($_POST['overall_pricing']));
    $markupPercent = addslashes(trim($_POST['markupTotal']));
    $markupTotal = $markupPercent;
    $international = addslashes($_POST['international']);
    $editId = addslashes($_POST['editId']);

    $rs2 = GetPageRecord('*', 'currencyExchangeMaster', 'id=2 order by id asc');
    $restsup = mysqli_fetch_array($rs2);

    $namevalue = 'singleRoomCost="' . $singleRoomCost . '",doubleRoomCost="' . $doubleRoomCost . '",tripleRoomCost="' . $tripleRoomCost . '",quadRoomCost="' . $quadRoomCost . '",cwbRoomCost="' . $cwbRoomCost . '",cnbRoomCost="' . $cnbRoomCost . '",markupPercent="' . $markupPercent . '",markupValue="' . $markupValue . '",currencyId="2",currencyValue="' . ($restsup['rate']) . '",overall_pricing="'.$overall_pricing.'",markupTotal="'.$markupTotal.'",international_trip="'.$international.'" ';
    $where = 'id="' . decode($editId) . '"';
    updatelisting('sys_packageBuilderEvent', $namevalue, $where);

    $dataForMarkup = GetTotalOfColumn('markupTotal', 'sys_packageBuilderEvent','packageId="' . decode($pid) . '" and sectionType!="Leisure" and markupTotal>0');
    $total_of_markup = $dataForMarkup[0];

    $namevalue = 'extraMarkup="' . $total_of_markup . '"';
    $where = 'id="' . decode($pid) . '" ';
    updatelisting('sys_packageBuilder', $namevalue, $where);

    ?>
    <script>
        parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_POST['pid']; ?>&save=1&b=2');
    </script>
    <?php
}









if (trim($_REQUEST['action']) == 'updatebillingtype' && trim($_REQUEST['pid']) != '') {

  $namevalue = 'billingType="' . $_REQUEST['billingType'] . '"';
  $where = 'id="' . decode($_REQUEST['pid']) . '"';
  updatelisting('sys_packageBuilder', $namevalue, $where);


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=2&save=1');
  </script>
<?php
}





if (trim($_POST['action']) == 'savepageduedate' && trim($_POST['pid']) != '' && trim($_POST['depositAmount']) != '' && trim($_POST['depositDueDate']) != '') {

  $namevalue = 'depositAmount="' . $_POST['depositAmount'] . '",depositDueDate="' . date('Y-m-d', strtotime($_POST['depositDueDate'])) . '"';
  $where = 'id="' . decode($_REQUEST['pid']) . '"';
  updatelisting('sys_packageBuilder', $namevalue, $where);


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=2&save=1');
  </script>
<?php
}






if (trim($_REQUEST['action']) == 'uploadphototmedia') {

  $totalImg = count($_FILES["image"]["tmp_name"]);

  for ($i = 0; $i <= $totalImg; $i++) {
    if ($_FILES["image"]["tmp_name"][$i] != "") {
      $rt = time();
      $companyLogoFileName = basename($_FILES['image']['name'][$i]);
      $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
      $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
      move_uploaded_file($_FILES["image"]["tmp_name"][$i], "package_image/{$profilePhoto}");

      $namevalue = 'name="' . $profilePhoto . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '"';
      addlistinggetlastid('sysMediaLibrary', $namevalue);
    }
  }
?>
  <script>
    parent.funloaduploadedphotos(12);
  </script>

<?php

}






if (trim($_REQUEST['action']) == 'setpackagecoverphoto' && trim($_REQUEST['imagename']) != ''  && trim($_REQUEST['pid']) != '') {

  //print_r($_REQUEST['pid']); exit;
  $coverPhoto = $_REQUEST['imagename'];

  $timename = time();

  if (strpos($_REQUEST['imagename'], 'https://') !== false) {

    $content = file_get_contents($_REQUEST['imagename']);
    file_put_contents('package_image/' . $timename . '.jpg', $content);

    $coverPhoto = $timename . '.jpg';
  }



  $namevalue = 'coverPhoto="' . $coverPhoto . '"';
  $where = 'id="' . decode($_REQUEST['pid']) . '"';
  updatelisting('sys_packageBuilder', $namevalue, $where);
}





if (trim($_POST['action']) == 'editDayDetails') {

  $namevalue = 'daySubject="' . addslashes($_POST['daySubject']) . '",dayDetails="' . addslashes($_POST['dayDetails']) . '"';
  $where = 'packageId="' . decode($_REQUEST['pid']) . '" and packageDays="' . ($_REQUEST['editId']) . '"';
  updatelisting('sys_packageBuilderEvent', $namevalue, $where);


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=3&save=1&d=<?php echo $_REQUEST['editId']; ?>');
  </script>
<?php
}

if (trim($_POST['action']) == 'editDayDetails2') {

  $namevalue = 'daySubject="' . addslashes($_POST['daySubject']) . '",dayDetails="' . addslashes($_POST['dayDetails']) . '"';
  $where = 'packageId="' . decode($_REQUEST['pid']) . '" and packageDays="' . ($_REQUEST['editId']) . '"';
  updatelisting('sys_packageBuilderEvent', $namevalue, $where);


?>
  <script>
    parent.load_build_day_details('<?php echo $_REQUEST['editId']; ?>', '<?php echo $_REQUEST['date']; ?>');
    parent.$('.modal').modal('hide');
  </script>
<?php
}


if (trim($_POST['action']) == 'addEditFaq') {

    if(isset($_POST['fid']) && !empty($_POST['fid']) && (intval($_POST['fid']) > 0)){
        $namevalue = 'title="' . mysqli_real_escape_string(db(),$_POST['question']) . '",description="' .
        mysqli_real_escape_string(db(),$_POST['answer']) . '"';
        $where = 'packageId="' . decode($_POST['pid']) . '" and id="' . ($_POST['fid']) . '"';
        updatelisting('sys_packageFAQs', $namevalue, $where);
    }
    else{
        $namevalue = 'packageId="' . decode($_POST['pid']) . '",title="' . mysqli_real_escape_string(db(),
                $_POST['question']) . '",description="' . mysqli_real_escape_string(db(), $_POST['answer']) . '"';
        addlistinggetlastid('sys_packageFAQs', $namevalue);
    }
    ?>
    <script>
        parent.load_build_day_details('120000', '<?php echo date('Y-m-d'); ?>');
        parent.$('.modal').modal('hide');
    </script>
    <?php
}


if (trim($_POST['action']) == 'updateImgAltText') {
    if((intval($_POST['altIndx']) > 0) && (intval($_POST['itnryId']) > 0) && !empty($_POST['altText'])){
        $altIndx = $_POST['altIndx'];
        $namevalue = 'imgAlt'.$altIndx.' = "' . mysqli_real_escape_string(db(),$_POST['altText']) . '"';
        $where = 'id="' . $_POST['itnryId'] . '"';
        echo updatelisting('sys_packageBuilder', $namevalue, $where);
    }
}



if (trim($_POST['action']) == 'deleteFaq') {
    if (isset($_POST['faqId']) && !empty($_POST['faqId']) && (intval($_POST['faqId']) > 0)) {
        deleteRecord('sys_packageFAQs', 'id="' . $_POST['faqId'] . '"');
        echo '1';
    }
}


if (trim($_REQUEST['action']) == 'seteventcoverphoto' && trim($_REQUEST['imagename']) != ''  && trim($_REQUEST['id']) != ''  && trim($_REQUEST['pid']) != '') {



  $coverPhoto = $_REQUEST['imagename'];

  $timename = time();

  if (strpos($_REQUEST['imagename'], 'https://') !== false) {

    $content = file_get_contents($_REQUEST['imagename']);
    file_put_contents('package_image/' . $timename . '.jpg', $content);

    $coverPhoto = $timename . '.jpg';
  }



  $namevalue = 'eventPhoto="' . $coverPhoto . '"';
  $where = 'packageId="' . decode($_REQUEST['pid']) . '" and id="' . ($_REQUEST['id']) . '"';
  updatelisting('sys_packageBuilderEvent', $namevalue, $where);
}



if (trim($_REQUEST['action']) == 'daydetailsphoto' && trim($_REQUEST['imagename']) != ''  && trim($_REQUEST['id']) != '') {



  $coverPhoto = $_REQUEST['imagename'];

  $timename = time();

  if (strpos($_REQUEST['imagename'], 'https://') !== false) {

    $content = file_get_contents($_REQUEST['imagename']);
    file_put_contents('package_image/' . $timename . '.jpg', $content);

    $coverPhoto = $timename . '.jpg';
  }



  $namevalue = 'eventPhoto="' . $coverPhoto . '"';
  $where = 'id="' . ($_REQUEST['id']) . '"';
  updatelisting('dayItineraryMaster', $namevalue, $where);
}




if (trim($_REQUEST['action']) == 'editinclusionExclusionDetails'  && trim($_REQUEST['pid']) != '') {

  $namevalue = 'inclusionExclusion="' . addslashes($_REQUEST['inclusionExclusion']) . '"';
  $where = 'id="' . decode($_REQUEST['pid']) . '" ';
  updatelisting('sys_packageBuilder', $namevalue, $where);


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=3&save=1&d=<?php echo $_REQUEST['d']; ?>');
  </script>
<?php
}


if (trim($_REQUEST['action']) == 'edittermsandconditionsDetails'  && trim($_REQUEST['pid']) != '') {

  $namevalue = 'terms="' . addslashes($_REQUEST['terms']) . '"';
  $where = 'id="' . decode($_REQUEST['pid']) . '" ';
  updatelisting('sys_packageBuilder', $namevalue, $where);


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&save=1&pd=100000');
  </script>
<?php
}




if (trim($_REQUEST['action']) == 'packageextramarkup'  && trim($_REQUEST['pid']) != '') {

//  $namevalue = 'extraMarkup="' . $_REQUEST['extraMarkup'] . '",baseMarkup="' . $_REQUEST['baseMarkup'] . '"';
  $namevalue = 'extraMarkup="' . $_REQUEST['extraMarkup'] . '"';

  $where = 'id="' . decode($_REQUEST['pid']) . '" ';
  updatelisting('sys_packageBuilder', $namevalue, $where);


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=2&save=1');
  </script>
<?php
}





if (trim($_POST['action']) == 'shareprivateclients'  && trim($_POST['pid']) != '' && $_POST['sendcheck'] != '') {

  include "config/mail.php";

  $ccmail = $_SESSION['username'] . ',' . $_POST['ccmails'];
  $hobby = $_POST['sendcheck'];
  $shareMessage = addslashes($_POST['shareMessage']);

  foreach ($hobby as $hobys => $value) {

    $ab = GetPageRecord('*', 'sys_userMaster', ' id in (select addedBy from  sys_userMaster where id="' . $_SESSION['userid'] . '")');
    $invoiceData = mysqli_fetch_array($ab);

    $ab2 = GetPageRecord('*', 'sys_userMaster', ' id="' . $_SESSION['userid'] . '"');
    $invoiceData222 = mysqli_fetch_array($ab2);

    $ab2pk = GetPageRecord('*', 'sys_packageBuilder', ' id="' . decode($_POST['pid']) . '"');
    $packageDataMain = mysqli_fetch_array($ab2pk);

    $a = GetPageRecord('*', 'userMaster', 'id="' . decode($value) . '"  ');
    $userdata = mysqli_fetch_array($a);


    $subject = 'Quotation ' . $_POST['pid'] . ' ' . $clientnameglobal;
    $mailbody = '
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f3f3f3;min-width:350px;font-size:1px;line-height:normal">
      <tbody><tr>
        <td align="center" valign="top">
          <table cellpadding="0" cellspacing="0" border="0" width="600" class="m_6354632776220649125table750" style="width:100%;max-width:600px;min-width:350px;background:#f3f3f3">
            <tbody><tr>
              <td class="m_6354632776220649125mob_pad" width="25" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>
              <td align="center" valign="top">
                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%!important;min-width:100%;max-width:100%;background:#f3f3f3">
                  <tbody><tr>
                    <td class="m_6354632776220649125top_pad" style="height:25px;line-height:25px;font-size:23px"><div style="height:30px;">&nbsp;</div></td>
                  </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#ffffff;border-radius:10px;width:100%!important;min-width:100%;max-width:100%">
                  <tbody><tr>
                    <td class="m_6354632776220649125mob_pad" width="25" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>
                    <td align="center" valign="top">
                      <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%!important;min-width:100%;max-width:100%">
                        <tbody><tr>
                          <td align="center" valign="top">
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%!important;min-width:100%;max-width:100%">
                              <tbody>
                                <tr>
                                  <td align="left" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top"><div style="height:30px;">&nbsp;</div></td>
                                </tr>
                                <tr>
                                <td align="left" valign="top">
                                  <span style="font-family:Arial,sans-serif;color:#1a1a1a;font-size:40px;line-height:38px;font-weight:300;letter-spacing:-1.5px">Hi ' . stripslashes($userdata['firstName']) . ',</span>                                <br>
<br>
<span style="font-family:Arial,sans-serif;color:#343642;font-size:22px;line-height:30px;font-weight:300">' . stripslashes($shareMessage) . '</span></td>
                              </tr>
                              <tr>
                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>
                                  <span style="font-family:Arial,sans-serif;color:#343642;font-size:22px;line-height:30px;font-weight:300">Please click the button below to view your itinerary.                                  </span>                                </td>
                              </tr>
                              <tr>
                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="center" valign="top">
                                  <table cellpadding="0" cellspacing="0" border="0" style="background:#525a68;border-radius:30px;border:2px solid #525a68">
                                    <tbody><tr>
                                      <td align="left" valign="top">
                                        <a href="' . $fullurlproposal . 'sharepackage/' . $_POST['pid'] . '/' . cleanstring(stripslashes($packageDataMain['name'])) . '.html" style="display:inline-block;border:1px solid #525a68;border-radius:30px;padding:15px 27px;font-family:Arial,sans-serif;color:#ffffff;font-size:20px;text-decoration:none" target="_blank">
                                        View your&nbsp;itinerary                                        </a>                                      </td>
                                    </tr>
                                  </tbody></table>                                </td>
                              </tr>
                              <tr>
                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>
                                  <span style="font-family:Arial,sans-serif;color:#888;font-size:12px;line-height:18px;font-weight:300">You are receiving this email because you have engaged with and/or are a customer of ' . stripslashes($invoiceData['invoiceCompany']) . '. We promise to only send you emails regarding your itinerary and we will never give your details to an external party or individual.</span>                                </td>
                              </tr>
                              <tr>
                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>
                                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%!important;min-width:100%;max-width:100%;border-width:2px;border-style:solid;border-color:#c0c7cd;border-bottom:none;border-left:none;border-right:none">
                                    <tbody><tr>
                                      <td style="height:28px;line-height:28px;font-size:26px">&nbsp;</td>
                                    </tr>
                                  </tbody></table>
                                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                      <td valign="middle">
                                        <span style="font-family:Arial,sans-serif;color:#343642;font-size:14px;line-height:18px;font-weight:300">' . stripslashes($invoiceData222['emailsignature']) . '</span>                                      </td>
                                    </tr>
                                  </tbody></table>                                </td>
                              </tr>
                              <tr>
                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>
                              </tr>
                              <tr>
                                <td style="height:30px;line-height:30px;font-size:28px">&nbsp;</td>
                              </tr>
                            </tbody></table>                          </td>
                        </tr>
                      </tbody></table>                    </td>
                    <td class="m_6354632776220649125mob_pad" width="25" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>
                  </tr>
                </tbody></table>              </td>
              <td class="m_6354632776220649125mob_pad" width="25" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>
            </tr>
              <tr>
                <td class="m_6354632776220649125mob_pad" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>
                <td align="center" valign="top"><div style="height:30px;">&nbsp;</div></td>
                <td class="m_6354632776220649125mob_pad" style="width:25px;max-width:25px;min-width:25px">&nbsp;</td>
              </tr>
          </tbody></table>
        </td>
      </tr>
    </tbody></table> 
';


    $namevalue = 'packageId="' . decode($_POST['pid']) . '",clientId="' . $userdata['id'] . '",	email="' . $userdata['email'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    $lstaddid = addlistinggetlastid('sys_ShareProposal', $namevalue);




    send_attachment_mail($fromemail, $userdata['email'], $subject, $mailbody, $ccmail . ',' . $_SESSION['username'], $file_name);
  }


  $abs = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '"  ');
  $packagedatas = mysqli_fetch_array($abs);

  if ($packagedatas['id'] != '') {
    $namevalue2 = 'details="' . addslashes($mailbody) . '",subject="' . addslashes($subject) . '",fromEmail="' . $_SESSION['username'] . '",toEmail="' . $userdata['email'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",queryId="' . $packagedatas['queryId'] . '"';
    addlistinggetlastid('queryMail', $namevalue2);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=3&save=3');
  </script>
<?php
}




if (trim($_REQUEST['action']) == 'linkSharingaction'  && trim($_REQUEST['pid']) != '') {

  $namevalue = 'linkSharing="' . $_REQUEST['linkSharing'] . '"';
  $where = 'id="' . decode($_REQUEST['pid']) . '" ';
  updatelisting('sys_packageBuilder', $namevalue, $where);
}













if (trim($_REQUEST['action']) == 'addduplicatepackage'  && trim($_REQUEST['pid']) != '') {

  $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['pid']) . '" ');
  $packagedata = mysqli_fetch_array($a);


  echo $namevalue = 'name="' . addslashes($packagedata['name']) . ' - Duplicate' . '",startDate="' . $packagedata['startDate'] . '",endDate="' . $packagedata['endDate'] . '",adult="' . $packagedata['adult'] . '",child="' . $packagedata['child'] . '",days="' . $packagedata['days'] . '",destinations="' . $packagedata['destinations'] . '",notes="' . addslashes($packagedata['notes']) . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",inclusionExclusion="' . addslashes($packagedata['inclusionExclusion']) . '",depositAmount="' . $packagedata['depositAmount'] . '",depositDueDate="' . $packagedata['depositDueDate'] . '",billingType="' . $packagedata['billingType'] . '",bookingDays="' . $packagedata['bookingDays'] . '",grossPrice="' . $packagedata['grossPrice'] . '",netPrice="' . $packagedata['netPrice'] . '",extraMarkup="' . $packagedata['extraMarkup'] . '",linkSharing="' . $packagedata['linkSharing'] . '",coverPhoto="' . $packagedata['coverPhoto'] . '",terms="' . addslashes($packagedata['terms']) . '",queryId="' . decode($_REQUEST['queryid']) . '"';
  $lstaddid = addlistinggetlastid('sys_packageBuilder', $namevalue);



  $rs = GetPageRecord('*', 'sys_PackageTips', ' packageId="' . decode($_REQUEST['pid']) . '" order by id asc');
  while ($eventDatatips = mysqli_fetch_array($rs)) {

    $namevalue = 'packageId="' . $lstaddid . '",title="' . addslashes($eventDatatips['title']) . '",description="' . addslashes($eventDatatips['description']) . '",iconset="' . addslashes($eventDatatips['iconset']) . '"';
    addlistinggetlastid('sys_PackageTips', $namevalue);
  }



  $rs = GetPageRecord('*', 'sys_packageBuilderEvent', ' packageId="' . decode($_REQUEST['pid']) . '" order by id asc');
  while ($eventData = mysqli_fetch_array($rs)) {


    $namevalue = 'packageId="' . $lstaddid . '",startDate="' . $eventData['startDate'] . '",endDate="' . $eventData['endDate'] . '",checkIn="' . $eventData['checkIn'] . '",checkOut="' . $eventData['checkOut'] . '",singleRoom="' . $eventData['singleRoom'] . '",doubleRoom="' . $eventData['doubleRoom'] . '",tripleRoom="' . $eventData['tripleRoom'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",quadRoom="' . $eventData['quadRoom'] . '",cwbRoom="' . $eventData['cwbRoom'] . '",cnbRoom="' . $eventData['cnbRoom'] . '",name="' . addslashes($eventData['name']) . '",hotelCategory="' . $eventData['hotelCategory'] . '",hotelRoom="' . addslashes($eventData['hotelRoom']) . '",mealPlan="' . addslashes($eventData['mealPlan']) . '",sectionType="' . $eventData['sectionType'] . '",days="' . $eventData['days'] . '",transferCategory="' . $eventData['transferCategory'] . '",vehicle="' . $eventData['vehicle'] . '",packageDays="' . $eventData['packageDays'] . '",mealCategory="' . addslashes($eventData['mealCategory']) . '",description="' . addslashes($eventData['description']) . '",adultCost="' . $eventData['adultCost'] . '",childCost="' . $eventData['childCost'] . '",markupPercent="' . $eventData['markupPercent'] . '",markupValue="' . $eventData['markupValue'] . '",singleRoomCost="' . $eventData['singleRoomCost'] . '",doubleRoomCost="' . $eventData['doubleRoomCost'] . '",tripleRoomCost="' . $eventData['tripleRoomCost'] . '",quadRoomCost="' . $eventData['quadRoomCost'] . '",cwbRoomCost="' . $eventData['cwbRoomCost'] . '",cnbRoomCost="' . $eventData['cnbRoomCost'] . '",daySubject="' . addslashes($eventData['daySubject']) . '",dayDetails="' . addslashes($eventData['dayDetails']) . '",eventPhoto="' . $eventData['eventPhoto'] . '",flightNo="' . $eventData['flightNo'] . '",fromDestination="' . $eventData['fromDestination'] . '",toDestination="' . $eventData['toDestination'] . '",flightDuration="' . $eventData['flightDuration'] . '",destinationName="' . $eventData['destinationName'] . '"';
    addlistinggetlastid('sys_packageBuilderEvent', $namevalue);
  }



?>
  <script>
    <?php if ($_REQUEST['queryid'] != '') { ?>
      parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryid']; ?>&status=1&c=2&save=1');

    <?php } else { ?>
      parent.redirectpage('display.html?ga=itineraries&save=1');
    <?php } ?>
  </script>
<?php
}








if (trim($_REQUEST['action']) == 'insertitinerary'  && trim($_REQUEST['id']) != ''  && trim($_REQUEST['qid']) != '') {

  $a = GetPageRecord('*', 'sys_packageBuilder', 'id="' . decode($_REQUEST['id']) . '" ');
  $packagedata = mysqli_fetch_array($a);


  $namevalue = 'name="' . addslashes($packagedata['name']) . '' . '",startDate="' . $packagedata['startDate'] . '",endDate="' . $packagedata['endDate'] . '",adult="' . $packagedata['adult'] . '",child="' . $packagedata['child'] . '",days="' . $packagedata['days'] . '",destinations="' . $packagedata['destinations'] . '",notes="' . addslashes($packagedata['notes']) . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",inclusionExclusion="' . addslashes($packagedata['inclusionExclusion']) . '",depositAmount="' . $packagedata['depositAmount'] . '",depositDueDate="' . $packagedata['depositDueDate'] . '",billingType=1,bookingDays="' . $packagedata['bookingDays'] . '",grossPrice="' . $packagedata['grossPrice'] . '",netPrice="' . $packagedata['netPrice'] . '",extraMarkup="' . $packagedata['extraMarkup'] . '",linkSharing="' . $packagedata['linkSharing'] . '",coverPhoto="' . $packagedata['coverPhoto'] . '",terms="' . addslashes($packagedata['terms']) . '",queryId="' . decode($_REQUEST['qid']) . '"';
  $lstaddid = addlistinggetlastid('sys_packageBuilder', $namevalue);



  $rs = GetPageRecord('*', 'sys_PackageTips', ' packageId="' . decode($_REQUEST['id']) . '" order by id asc');
  while ($eventDatatips = mysqli_fetch_array($rs)) {

    $namevalue = 'packageId="' . $lstaddid . '",title="' . addslashes($eventDatatips['title']) . '",description="' . addslashes($eventDatatips['description']) . '",iconset="' . addslashes($eventDatatips['iconset']) . '"';
    addlistinggetlastid('sys_PackageTips', $namevalue);
  }



  $rs = GetPageRecord('*', 'sys_packageBuilderEvent', ' packageId="' . decode($_REQUEST['id']) . '" order by id asc');
  while ($eventData = mysqli_fetch_array($rs)) {


    $namevalue = 'packageId="' . $lstaddid . '",startDate="' . $eventData['startDate'] . '",endDate="' . $eventData['endDate'] . '",checkIn="' . $eventData['checkIn'] . '",checkOut="' . $eventData['checkOut'] . '",singleRoom="' . $eventData['singleRoom'] . '",doubleRoom="' . $eventData['doubleRoom'] . '",tripleRoom="' . $eventData['tripleRoom'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",quadRoom="' . $eventData['quadRoom'] . '",cwbRoom="' . $eventData['cwbRoom'] . '",cnbRoom="' . $eventData['cnbRoom'] . '",name="' . addslashes($eventData['name']) . '",hotelCategory="' . $eventData['hotelCategory'] . '",hotelRoom="' . addslashes($eventData['hotelRoom']) . '",mealPlan="' . addslashes($eventData['mealPlan']) . '",sectionType="' . $eventData['sectionType'] . '",days="' . $eventData['days'] . '",transferCategory="' . $eventData['transferCategory'] . '",vehicle="' . $eventData['vehicle'] . '",packageDays="' . $eventData['packageDays'] . '",mealCategory="' . addslashes($eventData['mealCategory']) . '",description="' . addslashes($eventData['description']) . '",adultCost="' . $eventData['adultCost'] . '",childCost="' . $eventData['childCost'] . '",markupPercent="' . $eventData['markupPercent'] . '",markupValue="' . $eventData['markupValue'] . '",singleRoomCost="' . $eventData['singleRoomCost'] . '",doubleRoomCost="' . $eventData['doubleRoomCost'] . '",tripleRoomCost="' . $eventData['tripleRoomCost'] . '",quadRoomCost="' . $eventData['quadRoomCost'] . '",cwbRoomCost="' . $eventData['cwbRoomCost'] . '",cnbRoomCost="' . $eventData['cnbRoomCost'] . '",daySubject="' . addslashes($eventData['daySubject']) . '",dayDetails="' . addslashes($eventData['dayDetails']) . '",eventPhoto="' . $eventData['eventPhoto'] . '",flightNo="' . $eventData['flightNo'] . '",fromDestination="' . $eventData['fromDestination'] . '",toDestination="' . $eventData['toDestination'] . '",flightDuration="' . $eventData['flightDuration'] . '",destinationName="' . $eventData['destinationName'] . '"';
    addlistinggetlastid('sys_packageBuilderEvent', $namevalue);
  }



?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['qid']; ?>&c=2&save=1');
  </script>
  <?php
}









if (trim($_POST['action']) == 'addclient' && trim($_POST['submitName']) != '' && trim($_POST['firstName']) != ''  && trim($_POST['mobile']) != '' && trim($_POST['email']) != '' && trim($_POST['city']) != '') {

  $city = addslashes($_POST['city']);
  $email = addslashes($_POST['email']);
  $mobile = addslashes($_POST['mobile']);
  $mobileCode = addslashes($_POST['mobileCode']);
  $email2 = addslashes($_POST['email2']);
  $mobile2 = addslashes($_POST['mobile2']);
  $mobileCode2 = addslashes($_POST['mobileCode2']);
  $firstName = addslashes($_POST['firstName']);
  $lastName = addslashes($_POST['lastName']);
  $submitName = addslashes($_POST['submitName']);
  $address = addslashes($_POST['address']);
  $editid = decode($_POST['editId']);

  $dob = date('Y-m-d', strtotime($_POST['dob']));

  $marriageAnniversary = date('Y-m-d', strtotime($_POST['marriageAnniversary']));

  if ($dob == '01-01-1970') {
    $dob = '';
  }
  if ($marriageAnniversary == '01-01-1970') {
    $marriageAnniversary = '';
  }


  $a = GetPageRecord('*', 'cityMaster', 'id="' . $city . '"');
  $datacity = mysqli_fetch_array($a);

  $a = GetPageRecord('*', 'stateMaster', 'id="' . $datacity['stateId'] . '"');
  $datas = mysqli_fetch_array($a);

  $a = GetPageRecord('*', 'countryMaster', 'id="' . $datas['countryId'] . '"');
  $datac = mysqli_fetch_array($a);


  $state = addslashes($datas['id']);
  $country = addslashes($datac['id']);



  $a = GetPageRecord('*', 'sys_userMaster', 'email="' . $email . '" and (userType=1 or userType=2 or userType=4)');
  $validateemail = mysqli_fetch_array($a);

  if ($editid != '') {



    $namevalue = 'city="' . $city . '",email="' . $email . '",mobile="' . $mobile . '",mobileCode="' . $mobileCode . '",submitName="' . $submitName . '",email2="' . $email2 . '",mobile2="' . $mobile2 . '",mobileCode2="' . $mobileCode2 . '",state="' . $state . '",country="' . $country . '",firstName="' . $firstName . '",lastName="' . $lastName . '",address="' . $address . '",dob="' . $dob . '",marriageAnniversary="' . $marriageAnniversary . '",dateAdded="' . time() . '",addedBy="' . $_SESSION['userid'] . '"';
    $where = 'id="' . $editid . '"';
    updatelisting('userMaster', $namevalue, $where);
  } else {
    if ($validateemail['id'] == '') {
      $namevalue = 'email="' . $email . '",city="' . $city . '",mobile="' . $mobile . '",mobileCode="' . $mobileCode . '",submitName="' . $submitName . '",email2="' . $email2 . '",dob="' . $dob . '",marriageAnniversary="' . $marriageAnniversary . '",mobile2="' . $mobile2 . '",mobileCode2="' . $mobileCode2 . '",state="' . $state . '",country="' . $country . '",firstName="' . $firstName . '",lastName="' . $lastName . '",address="' . $address . '",status=1,profileId=5,userType=4,dateAdded="' . time() . '",addedBy="' . $_SESSION['userid'] . '"';
      $lstaddid = addlistinggetlastid('userMaster', $namevalue);
    } else {
  ?>
      <script>
        alert('This email is already exists!');
        parent.$('.animated-progess').hide();
        parent.$('#stoppagediv').hide();

        parent.$('#savingbutton').prop("disabled", false);
        parent.$('#savingphtobutton').prop("disabled", false);
        parent.$('#savingbutton').val("Save");
      </script>
  <?php
      exit();
    }
  }


  ?>
  <script>
    parent.redirectpage('display.html?ga=clients&save=1');
  </script>
<?php
}




if (trim($_POST['action']) == 'addtips' && trim($_POST['title']) != '' && trim($_POST['description']) != '' && trim($_POST['iconset']) != '' && trim($_POST['pid']) != '') {


  $title = addslashes($_POST['title']);
  $description = addslashes($_POST['description']);
  $iconset = addslashes($_POST['iconset']);
  $editId = decode($_POST['editId']);
  $packageId = decode($_POST['pid']);



  if ($editId != '') {



    $namevalue = 'title="' . $title . '",description="' . $description . '",iconset="' . $iconset . '"';
    $where = 'id="' . $editId . '" and packageId="' . $packageId . '"';
    updatelisting('sys_PackageTips', $namevalue, $where);
  } else {
    $namevalue = 'title="' . $title . '",description="' . $description . '",iconset="' . $iconset . '",packageId="' . $packageId . '"';
    $lstaddid = addlistinggetlastid('sys_PackageTips', $namevalue);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&save=1&pd=100000');
  </script>
<?php
}



if (trim($_REQUEST['action']) == 'deltetips' && trim($_REQUEST['did']) != '' && trim($_REQUEST['pid']) != '') {
  deleteRecord('sys_PackageTips', 'id="' . decode($_REQUEST['did']) . '" and packageId="' . decode($_REQUEST['pid']) . '"');
?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=3&save=1');
  </script>
<?php
}













//===================================Add Query===========================================

//if($_POST['action']=='addQuery' &&  $_POST['startDate']!='' && $_POST['endDate']!=''  && $_POST['name']!='' && $_POST['email']!='' && $_POST['mobile']!='' && $_POST['country']!='' && $_POST['state']!='' && $_POST['city']!='' && $_POST['fromCity']!='' && $_POST['destinationId']!=''){ 
if ($_POST['action'] == 'addQuery') {

    include "config/mail.php";

    $startDate = date('Y-m-d', strtotime($_POST['startDate']));

    $endDate = date('Y-m-d', strtotime($_POST['endDate']));

    $submitName = addslashes($_POST['submitName']);

    $name = addslashes($_POST['name']);

    $mobile = addslashes($_POST['mobile']);

    $webqueryid = addslashes($_POST['webqueryid']);

    $priorityStatus = addslashes($_POST['priorityStatus']);

    $country = addslashes($_POST['country']);

    $email = addslashes($_POST['email']);

    $state = addslashes($_POST['state']);

    $travelMonth = addslashes($_POST['travelMonth']);

    $city = addslashes($_POST['city']);

    $clientId = decode($_POST['clientId']);

    $clientId = decode($_POST['clientId']);

    $fromCity = addslashes($_POST['fromCity']);

    //add email signature

    $kk = GetPageRecord('*', 'sys_userMaster', 'id="' . $_SESSION['userid'] . '"');

    $userDetail = mysqli_fetch_array($kk);

    $emailsignature = $userDetail['emailsignature'];

    //end email sign.

    if (isset($_POST['destinationId'])) {

        foreach ($_POST['destinationId'] as $k4 => $v4) {

            $destinationId .= $_POST['destinationId'][$k4] . ',';
        }
    }

    $string = '';

    $string = preg_replace('/\.$/', '', $destinationId);

    $array = explode(',', $string);

    foreach ($array as $value) {

        $rs1 = GetPageRecord('name', 'cityMaster', ' id="' . $value . '"');
        $editresult = mysqli_fetch_array($rs1);

        $destinationIdName .= $editresult['name'] . ', ';
    }

    $randPass = rand(999999, 100000);

    $serviceId = addslashes($_POST['serviceId']);

    $adult = addslashes(strip_tags($_POST['adult']));

    $child = addslashes(strip_tags($_POST['child']));

    $infant = addslashes(strip_tags($_POST['infant']));

    $assignTo = addslashes(strip_tags($_POST['assignTo']));

    $addedBy = addslashes(strip_tags($_POST['addedBy']));

    $leadSource = addslashes(strip_tags($_POST['leadSource']));

    $title = addslashes(strip_tags($_POST['title']));

    $details = addslashes(strip_tags($_POST['details']));

    $start = strtotime($startDate);

    $end = strtotime($endDate);

    $day = ceil(abs($end - $start) / 86400);

    if ($day == 1) {
        $night = 1;
    } else {
        $night = $day - 1;
    }

    $dateAdded = date('Y-m-d H:i:s');

    if ($clientId == '' || $clientId == '0') {

        $bb = GetPageRecord('*', 'userMaster', 'email="' . $email . '" and userType=4');

        $clientidcheck = mysqli_fetch_array($bb);

        if ($clientidcheck['email'] == '') {
            $namevalue4 = 'userType="4",submitName="' . $submitName . '",firstName="' . $name . '",mobile="' . $mobile . '",password="' . md5($randPass) . '",status=1,email="' . $email . '",country="' . $country . '",state="' . $state . '",city="' . $city . '",addedBy="' . $addedBy . '",dateAdded="' . time() . '"';
            $clientId = addlistinggetlastid('userMaster', $namevalue4);
        } else {
            $clientId = $clientidcheck['id'];
        }
    }

    if (trim($_POST['startDate']) == '' or trim($_POST['endDate']) == '') {
        $night = 0;
        $day = 0;
    }

    if ($_REQUEST['editid'] == '') {

        $rs = GetPageRecord($select, 'sys_userMaster', 'id=1 ');

        $invoicedataa = mysqli_fetch_array($rs);

        $namevalue2 = 'subject="' . $title . '",fromEmail="' . $_SESSION['username'] . '",toEmail="' . $email . '",dateAdded="' . $dateAdded . '",addedBy="' . $addedBy . '"';

        $querymailid = addlistinggetlastid('queryMail', $namevalue2);

        $bodycontent = '<div style="padding:30px 0px; background-color:#F4FDFF;  text-align:center">

<img src="' . $fullurl . 'profilepic/' . $invoicedataa['invoiceLogo'] . '"  height="50" width="200" style="margin-bottom:20px;">

<div style=" max-width:600px;  background-color:#FFFFFF; margin:auto;  border:1px solid #F2F2F2; border-top:4px #419bf3 solid; padding:20px; text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:13px; ">

  <h4>Your Query Detail</h4> 

  While replying to this query, please dont change the subject line.





  <div style="margin-top:20px;border-top:2px solid #F2F2F2; padding:10px; background-color:#F7F7F7; margin-bottom:20px;">

  <div style="margin-bottom:20px;"><table width="100%" border="0" cellpadding="4" cellspacing="0" style="font-size:12px;">

      <tbody>

        <tr>

          <td colspan="2" align="left" valign="top" bgcolor="#EFEFEF" style="padding:10px; font-size:15px;"><strong>Contact Detail</strong></td>

          </tr>

        <tr>

        <td width="25%" align="left" valign="top"><strong>Name</strong></td>

        <td width="25%" align="left" valign="top"><strong>Phone/Mobile</strong></td>

        </tr>

      <tr>

        <td width="25%" align="left" valign="top">' . $_POST['name'] . '</td>

        <td width="25%" align="left" valign="top">' . $_POST['mobile'] . '</td>

        </tr>

    </tbody></table>

  </div>

    <div style="margin-bottom:10px;"><table width="100%" border="0" cellpadding="4" cellspacing="0" style="font-size:12px;">

      <tbody>

	   <tr>

          <td colspan="4" align="left" valign="top" bgcolor="#EFEFEF" style="padding:10px; font-size:15px;"><strong>Query Detail</strong></td>

          </tr>

	  <tr>

        <td width="25%" align="left" valign="top"><strong>From  Date</strong></td> 

        <td width="25%" align="left" valign="top"><strong>To  Date</strong></td>

        <td width="25%" align="left" valign="top"><strong>Destination</strong></td>

        <td width="25%" align="left" valign="top"><strong>Duration</strong></td>

      </tr>

      <tr>

	

	



	

        <td width="25%" align="left" valign="top">' . $_POST['startDate'] . '</td>

        <td width="25%" align="left" valign="top">' . $_POST['endDate'] . '</td>

        <td width="25%" align="left" valign="top">' . $destinationIdName . '</td>

        <td width="25%" align="left" valign="top">' . $night . ' Nights / ' . $day . ' Days</td>

		

      </tr>

    </tbody></table></div>

	<div><table width="100%" border="0" cellpadding="4" cellspacing="0" style="font-size:12px;">

      <tbody><tr>

        <td width="25%" align="left" valign="top"><strong>Created Date</strong></td>

        <td width="25%" align="left" valign="top"><strong>Adult</strong></td>

        <td width="25%" align="left" valign="top"><strong>Child</strong></td>

        <td width="25%" align="left" valign="top"><strong>Infant</strong></td>

      </tr>

      <tr>

        <td width="25%" align="left" valign="top">' . date('d-m-Y h:i A') . '</td>

        <td width="25%" align="left" valign="top">' . $_POST['adult'] . '</td>

        <td width="25%" align="left" valign="top">' . $_POST['child'] . '</td>

        <td width="25%" align="left" valign="top">' . $_POST['infant'] . '</td>

      </tr>

    </tbody></table>

	</div>

  </div>

  <div>



  </div>

  </div>

</div><br>' . $details . '<br><br>' . $emailsignature;

        $namevalue = 'startDate="' . $startDate . '",endDate="' . $endDate . '",name="' . $name . '",phone="' . $mobile . '",countryId="' . $country . '",stateId="' . $state . '",cityId="' . $city . '",email="' . $email . '",destinationId="' . $destinationId . '",serviceId="' . $serviceId . '",adult="' . $adult . '",child="' . $child . '",infant="' . $infant . '",assignTo="' . $assignTo . '", leadSource="' . $leadSource . '",title="' . $title . '",details="' . $details . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",day="' . $day . '",updateDate="' . $dateAdded . '",clientId="' . $clientId . '",fromCity="' . $fromCity . '",travelMonth="' . $travelMonth . '",priorityStatus="' . $priorityStatus . '"';

        $queryId = addlistinggetlastid('queryMaster', $namevalue);

        $namevalue2 = 'subject="#' . makeQueryId($queryId) . ' Query Created!",details="' . addslashes($bodycontent) . '",queryId="' . $queryId . '"';

        $where = 'id="' . $querymailid . '"';

        updatelisting('queryMail', $namevalue2, $where);

        $namevalue3 = 'details="Query Created",queryId="' . $queryId . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",logType="add_query"';

        addlisting('queryLogs', $namevalue3);

        $namevalue4 = 'details="New Query Assigned", taskType="Notification",queryId="' . $queryId . '",reminderDate="' . $dateAdded . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",assignTo="' . $assignTo . '"';

        addlisting('queryTask', $namevalue4);

        $mailto = $email;

        $subject = '#' . makeQueryId($queryId) . ' Query Created!';

        send_attachment_mail($fromemail, $mailto, $subject, $bodycontent . '<img src="' . $fullurl . 'rmail.php?q=' . $querymailid . '" width="0" height="0">', $ccmail, $file_name);

    } else {

        $namevalue = 'startDate="' . $startDate . '",endDate="' . $endDate . '",name="' . $name . '",phone="' . $mobile . '",countryId="' . $country . '",stateId="' . $state . '",cityId="' . $city . '",email="' . $email . '",destinationId="' . $destinationId . '",serviceId="' . $serviceId . '",adult="' . $adult . '",child="' . $child . '",infant="' . $infant . '",leadSource="' . $leadSource . '",title="' . $title . '",details="' . $details . '",day="' . $day . '",updateDate="' . $dateAdded . '",clientId="' . $clientId . '",fromCity="' . $fromCity . '",travelMonth="' . $travelMonth . '",priorityStatus="' . $priorityStatus . '",submitName="' . $submitName . '", addedBy="'.$addedBy.'"';

        $where = 'id="' . decode($_POST['editid']) . '"';
        updatelisting('queryMaster', $namevalue, $where);

        $namevalue4 = 'submitName="' . $submitName . '",firstName="' . $name . '",mobile="' . $mobile . '",email="' . $email . '"';
        updatelisting('userMaster', $namevalue4, 'id="' . $clientId . '"');

        $namevalue3 = 'details="Query Update",queryId="' . decode($_POST['editid']) . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",logType="edit_query"';

        addlisting('queryLogs', $namevalue3);
    }

    ?>
    <script>
        parent.redirectpage('display.html?ga=query&save=1');
    </script>
    <?php
}




if (trim($_REQUEST['action']) == 'changeassignstatus' && trim($_REQUEST['queryid']) != '' && trim($_REQUEST['assignTo']) != '') {



  $id = decode($_REQUEST['queryid']);

  $assignTo = $_REQUEST['assignTo'];

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');

  $namevalue = 'assignTo="' . $assignTo . '",updateDate="' . $dateAdded . '"';
  $where = 'id="' . $id . '"';

  updatelisting('queryMaster', $namevalue, $where);


    $namevalue3 = 'details="Assign Query",queryId="' . $id . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",userId="' . $assignTo . '",logType="assign_query"';
    addlisting('queryLogs', $namevalue3);

    $namevalue4 = 'details="New Query Assigned", taskType="Notification",queryId="' . $id . '",reminderDate="'.$dateAdded.'",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",assignTo="' . $assignTo . '"';

    addlisting('queryTask', $namevalue4);
}









if (trim($_REQUEST['action']) == 'addnotes' && trim($_REQUEST['queryid']) != '' && trim($_REQUEST['details']) != '') {





  $queryid = decode($_REQUEST['queryid']);

  $details = addslashes($_REQUEST['details']);

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');



  $namevalue = 'queryId="' . $queryid . '",details="' . $details . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';

  addlisting('queryNotes', $namevalue);





  $namevaluek = 'details="Note Created",queryId="' . $queryid . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",statusComment="' . $details . '",logType="add_note"';
  addlisting('queryLogs', $namevaluek);



?>

  <script>
    parent.queryNotes();
    parent.$('#notedetails').val('');
  </script>



<?php

}








if (trim($_REQUEST['action']) == 'addtask' && trim($_REQUEST['details']) != '') {


    $queryid = decode($_REQUEST['queryid']);
    $details = addslashes($_REQUEST['details']);
    $reminderDate = date('Y-m-d', strtotime($_REQUEST['reminderDate']));
    $reminderTime = $_REQUEST['reminderTime'];
    $status = addslashes($_REQUEST['status']);
    $taskType = addslashes($_REQUEST['taskType']);
    $assignTo = addslashes($_REQUEST['assignTo']);
    $reminderDate = $reminderDate . ' ' . $reminderTime;
    $reminderDate = date('Y-m-d H:i:s', strtotime($reminderDate));
    $addedBy = $_SESSION['userid'];
    $dateAdded = date('Y-m-d H:i:s');


    $namevalue = 'queryId="' . $queryid . '",details="' . $details . '",status="' . $status . '",reminderDate="' . $reminderDate . '",assignTo="' . $assignTo . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",taskType="' . $taskType . '"';
    addlisting('queryTask', $namevalue);


    $namevaluek = 'details="' . $taskType . ' Created",queryId="' . $queryid . '",addedBy="' . $addedBy . '",statusComment="' . $details . '",dateAdded="' . $dateAdded . '",logType="add_task"';
    addlisting('queryLogs', $namevaluek);


    ?>

    <script>
        parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryid']; ?>&c=3&save=1');
    </script>


<?php }









if (trim($_POST['action']) == 'composemail' && $_POST['queryId'] != '' && $_POST['subject'] != '' && $_POST['EmailDetails'] != '') {









  $subject = addslashes($_POST['subject']);

  $EmailDetails = addslashes($_POST['EmailDetails']);

  $queryId = decode($_POST['queryId']);

  $day = addslashes($_POST['day']);

  $toEmail = addslashes($_POST['toEmail']);
	
  $reply_to = $_POST['reply_to'];

  $cc = addslashes($_POST['cc']);



?>
  <script src="assets/js/jquery.min.js"></script>
  <script>
    parent.$('#popcontent').html('<div style="padding:10px; text-align:center;"><img src="images/loading.gif" width="32" ></div>');
  </script>

  <?php







  $namevaluelog = 'dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",queryId="' . ($queryId) . '",fromEmail="' . ($LoginUserDetails['emailAccount']) . '",toEmail="' . ($toEmail) . '",subject="' . $subject . '",details="' . ($EmailDetails) . '",ccEmail="' . $cc . '"';

  $lastid = addlistinggetlastid('queryMail', $namevaluelog);





  $namevaluek = 'details="Mail Sent to (' . $toEmail . ')",queryId="' . $queryId . '",addedBy="' . $_SESSION['userid'] . '",statusComment="",dateAdded="' . date('Y-m-d H:i:s') . '",logType="add_mail"';
  addlisting('queryLogs', $namevaluek);



  if ($_FILES["attachmentfile"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['attachmentfile']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $receiptFile = time() . $rt . '.' . $companyLogoFileExtension;
    move_uploaded_file($_FILES["attachmentfile"]["tmp_name"], "voucherAttachments/{$receiptFile}");
  }



  include "config/mail.php";





  $ccmail = $cc;

  $file_ename = $receiptFile;

  send_attachment_mail_with_reply_to($fromemail, $toEmail, stripslashes($subject), stripslashes($EmailDetails . '<img src="' . $fullurl . 'readmail.php?m=' . encode($lastid) . '" width="0" height="0">'), $ccmail . ',' . $_SESSION['username'], $file_ename, $reply_to);






  ?>

  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo encode($queryId); ?>&c=7&save=1');
  </script>



<?php  }



if (trim($_POST['action']) == 'sendtosupplier' && $_POST['queryid'] != '' && $_POST['subject'] != '' && $_POST['EmailDetails'] != '') {
  $subject = addslashes($_POST['subject']);
  $EmailDetails = addslashes($_POST['EmailDetails']);
  $queryId = decode($_POST['queryid']);
  $cc = addslashes($_POST['ccmail']);



?>

  <script>
    parent.$('#popcontent').html('<div style="padding:10px; text-align:center;"><img src="images/loading.gif" width="32" ></div>');
  </script>

  <?php


  include "config/mail.php";


  $hobby = $_POST['sendcheck'];
  $shareMessage = addslashes($_POST['shareMessage']);

  foreach ($hobby as $hobys => $value) {
    $sup = 1;

    $a = GetPageRecord('*', 'userMaster', 'id="' . decode($value) . '"  ');
    $userdata = mysqli_fetch_array($a);


    $toEmail = addslashes($userdata['email']);

    $namevaluelog = 'dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",queryId="' . ($queryId) . '",fromEmail="' . ($LoginUserDetails['emailAccount']) . '",toEmail="' . ($toEmail) . '",subject="' . $subject . '",details="' . ($EmailDetails) . '",ccEmail="' . $cc . '"';
    $lastid = addlistinggetlastid('queryMail', $namevaluelog);



    $namevaluek = 'details="Mail Sent to (' . $toEmail . ')",queryId="' . $queryId . '",addedBy="' . $_SESSION['userid'] . '",statusComment="",dateAdded="' . date('Y-m-d H:i:s') . '",logType="add_mail"';
    addlisting('queryLogs', $namevaluek);
    
    
     if ($_FILES["attachmentfile"]["tmp_name"] != "") {
      $rt = mt_rand() . strtotime(date("YMDHis"));
      $companyLogoFileName = basename($_FILES['attachmentfile']['name']);
      $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
      $receiptFile = time() . $rt . '.' . $companyLogoFileExtension;
      move_uploaded_file($_FILES["attachmentfile"]["tmp_name"], "voucherAttachments/{$receiptFile}");
    }



    $ccmail = $cc;
    //$file_name = '';
    
    $file_name = $receiptFile;
    send_attachment_mail($fromemail, $toEmail, stripslashes($subject), stripslashes($EmailDetails . '<img src="' . $fullurl . 'readmail.php?m=' . encode($lastid) . '" width="0" height="0">'), $ccmail . ',' . $_SESSION['username'], $file_name);
  }
  ?>

  <script>
    <?php if ($sup != 1) { ?>
      alert('Please select supplier from list!');
    <?php } else { ?>
      parent.redirectpage('display.html?ga=query&view=1&id=<?php echo encode($queryId); ?>&c=7&save=1');
    <?php } ?>
  </script>



  <?php  }












if (trim($_POST['action']) == 'addsupplier' && trim($_POST['submitName']) != '' && trim($_POST['company']) != '' && trim($_POST['firstName']) != '' && trim($_POST['lastName']) != '' && trim($_POST['mobile']) != '' && trim($_POST['email']) != '' && trim($_POST['city']) != '') {


  $company = addslashes($_POST['company']);
  $submitName = addslashes($_POST['submitName']);
  $email = addslashes($_POST['email']);
  $city = addslashes($_POST['city']);
  $mobile = addslashes($_POST['mobile']);
  $mobileCode = addslashes($_POST['mobileCode']);
  $firstName = addslashes($_POST['firstName']);
  $lastName = addslashes($_POST['lastName']);
  $address = addslashes($_POST['address']);
  $editid = decode($_POST['editId']);




  $a = GetPageRecord('*', 'cityMaster', 'id="' . $city . '"');
  $datacity = mysqli_fetch_array($a);

  $a = GetPageRecord('*', 'stateMaster', 'id="' . $datacity['stateId'] . '"');
  $datas = mysqli_fetch_array($a);

  $a = GetPageRecord('*', 'countryMaster', 'id="' . $datas['countryId'] . '"');
  $datac = mysqli_fetch_array($a);


  $state = addslashes($datas['id']);
  $country = addslashes($datac['id']);



  $a = GetPageRecord('*', 'sys_userMaster', 'email="' . $email . '" and userType=5');
  $validateemail = mysqli_fetch_array($a);

  if ($editid != '') {



    $namevalue = 'email="' . $email . '",city="' . $city . '",mobile="' . $mobile . '",mobileCode="' . $mobileCode . '",state="' . $state . '",submitName="' . $submitName . '",country="' . $country . '",company="' . $company . '",firstName="' . $firstName . '",lastName="' . $lastName . '",address="' . $address . '",dateAdded="' . time() . '",addedBy="' . $_SESSION['userid'] . '"';
    $where = 'id="' . $editid . '"';
    updatelisting('userMaster', $namevalue, $where);
  } else {
    if ($validateemail['id'] == '') {
      $namevalue = 'email="' . $email . '",city="' . $city . '",mobile="' . $mobile . '",mobileCode="' . $mobileCode . '",submitName="' . $submitName . '",state="' . $state . '",country="' . $country . '",company="' . $company . '",firstName="' . $firstName . '",lastName="' . $lastName . '",address="' . $address . '",status=1,profileId=5,userType=5,dateAdded="' . time() . '",addedBy="' . $_SESSION['userid'] . '"';
      $lstaddid = addlistinggetlastid('userMaster', $namevalue);
    } else {
  ?>
      <script>
        alert('This email is already exists!');
        parent.$('.animated-progess').hide();
        parent.$('#stoppagediv').hide();

        parent.$('#savingbutton').prop("disabled", false);
        parent.$('#savingphtobutton').prop("disabled", false);
        parent.$('#savingbutton').val("Save");
      </script>
  <?php
      exit();
    }
  }


  ?>
  <script>
    parent.redirectpage('display.html?ga=suppliers&save=1');
  </script>
  <?php
}



if (trim($_POST['action']) == 'addquerypayment' && $_POST['queryId'] != '' && $_POST['packageId'] != '' && $_POST['amount'] != '') {


  if ($_FILES["receiptFile"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['receiptFile']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $receiptFile = time() . $rt . '.' . $companyLogoFileExtension;
    move_uploaded_file($_FILES["receiptFile"]["tmp_name"], "package_image/{$receiptFile}");
  }



  if ($_POST['transectionType'] != 'Cash' && $_POST['paymentId'] == '' && $_POST['status'] == 1) {
  ?>
    <script>
      alert('Transection ID is empty!');
    </script>
  <?php
    exit();
  }

  if ($_POST['transectionType'] == 'Cash' && $_FILES["receiptFile"]["tmp_name"] == '' && $_POST['status'] == 1) {
  ?>
    <script>
      alert('Receipt is empty!');
    </script>
  <?php
    exit();
  }

  if ($_POST['editid'] > 0) {

    $namevalue2 = 'queryId="' . decode($_POST['queryId']) . '",packageId="' . decode($_POST['packageId']) . '",amount="' . trim($_REQUEST['amount']) . '",paymentDate="' . date('Y-m-d H:i:s', strtotime($_REQUEST['startDate'] . ' ' . date('H:i:s'))) . '",paymentBy="' . $_SESSION['userid'] . '",paymentStatus="' . $_POST['status'] . '",transectionType="' . $_POST['transectionType'] . '",paymentId="' . $_POST['paymentId'] . '",receiptFile="' . $receiptFile . '",remark="' . addslashes($_POST['remark']) . '"';
    $where = 'id="' . decode($_POST['editid']) . '"';
    updatelisting('sys_PackagePayment', $namevalue2, $where);

    updatelisting('queryMaster', 'statusId="5"', 'id="' . decode($_REQUEST['queryId']) . '"');
  } else {

    $namevalue2 = 'queryId="' . decode($_POST['queryId']) . '",packageId="' . decode($_POST['packageId']) . '",amount="' . trim($_REQUEST['amount']) . '",paymentDate="' . date('Y-m-d H:i:s', strtotime($_REQUEST['startDate'])) . '",paymentBy="' . $_SESSION['userid'] . '",paymentStatus="' . $_POST['status'] . '",transectionType="' . $_POST['transectionType'] . '",paymentId="' . $_POST['paymentId'] . '",remark="' . addslashes($_POST['remark']) . '"';
    addlistinggetlastid('sys_PackagePayment', $namevalue2);
  }

  $namevalue3 = 'details="Update Payment",queryId="' . decode($_REQUEST['queryId']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",logType="edit_query"';
  addlisting('queryLogs', $namevalue3);

    $assign_to_data = GetPageRecord('assignTo', 'queryMaster', 'id="'.decode($_POST['queryId']).'"');
    $assign_to_result = mysqli_fetch_array($assign_to_data);

    $namevalue4 = 'details="Payment Scheduled", taskType="Reminder", queryId="' . decode($_POST['queryId']) . '",reminderDate="' .  date('Y-m-d H:i:s', strtotime($_REQUEST['startDate'])) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",assignTo="'.$assign_to_result['assignTo'].'"';

    addlisting('queryTask', $namevalue4);


  ?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=5&save=1');
  </script>
<?php
}




if (trim($_REQUEST['action']) == 'genrateinvoice' && $_REQUEST['queryId'] != '' && $_REQUEST['packageId'] != '' && $_REQUEST['amount'] != '') {


  $rs13 = GetPageRecord('*', 'sys_invoiceMaster', 'queryId!="" and queryId="' . decode($_REQUEST['queryId']) . '" order by id desc');
  if (mysqli_num_rows($rs13) < 1) {
    $invoiceData = mysqli_fetch_array($rs13);
    $invoiceid = round($invoiceData['id'] + 1);


    $invoiceId = 'GI/' . date('y', strtotime(' -1 year')) . '-' . date('y') . '/' . str_pad($invoiceid, 3, '0', STR_PAD_LEFT) . '';


    $namevalue2 = 'queryId="' . decode($_REQUEST['queryId']) . '",packageId="' . decode($_REQUEST['packageId']) . '",amount="' . trim($_REQUEST['amount']) . '",invoiceDate="' . date('Y-m-d H:i:s') . '",genrateBy="' . $_SESSION['userid'] . '",invoiceId="' . $invoiceId . '"';
    addlistinggetlastid('sys_invoiceMaster', $namevalue2);



    $namevalue3 = 'details="Invoice Generated",queryId="' . decode($_REQUEST['queryId']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",logType="edit_query"';
    addlisting('queryLogs', $namevalue3);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=5&save=1');
  </script>
<?php
}



if (trim($_REQUEST['action']) == 'saveGSTpackagebuilder' && trim($_REQUEST['pid']) != '') {
  $id = decode($_REQUEST['pid']);
  $cgst = $_REQUEST['cgst'];
  $sgst = $_REQUEST['sgst'];
  $igst = $_REQUEST['igst'];
  $tcsPercent = $_REQUEST['tcsPercent'];
  $totalDiscount = $_REQUEST['totalDiscount'];
  $showcgst = $_REQUEST['showcgst'];
  $showsgst = $_REQUEST['showsgst'];
  $showigst = $_REQUEST['showigst'];
  $showtcs = $_REQUEST['showtcs'];
  $totalCost = $_REQUEST['totalCost'];
  $ebo = $_REQUEST['ebo'];
  $namevalue = 'cgst="' . $cgst . '",sgst="' . $sgst . '",igst="' . $igst . '",showcgst="' . $showcgst . '",showsgst="' . $showsgst . '",showigst="' . $showigst . '",showtcs="' . $showtcs . '",tcsPercent="' . $tcsPercent . '",totalDiscount="' . $totalDiscount . '",ebo="' . $ebo . '"';
  $where = 'id="' . $id . '"';
  updatelisting('sys_packageBuilder', $namevalue, $where);



?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_REQUEST['pid']; ?>&b=2');
  </script>
<?php
}







if (trim($_REQUEST['action']) == 'sendpaymentlink'  && $_REQUEST['pid'] != '' && $_REQUEST['qid'] != '' && $_REQUEST['id'] != '') {

  $queryId = decode($_REQUEST['qid']);
  $packageId = decode($_REQUEST['pid']);
  $id = decode($_REQUEST['id']);

  $fd = GetPageRecord('*', 'queryMaster', 'id="' . $queryId . '"');
  $queryData = mysqli_fetch_array($fd);

  $rsa = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');
  $userDetail = mysqli_fetch_array($rsa);

  $rs = GetPageRecord($select, 'sys_userMaster', 'id in (select addedBy from sys_userMaster where id="' . $queryData['addedBy'] . '") ');
  $invoicedataa = mysqli_fetch_array($rs);


  //if($_REQUEST['sendlink']==1){
  $subject = 'Payment Request  (via ' . strip($invoicedataa['invoiceCompany']) . ')';


  $mailbody = file_get_contents($fullurl . 'packagePaymentLink.php?pid=' . $_REQUEST['pid'] . '&id=' . $_REQUEST['id'] . '&qid=' . $_REQUEST['qid'] . '&sendlink=' . $_REQUEST['sendlink']);


  include "config/mail.php";
  $ccmail = $_POST['ccmails'];
  $file_name = '';
  send_attachment_mail($fromemail, $userDetail['email'], stripslashes($subject), stripslashes($mailbody), $ccmail . ',' . $_SESSION['username'], $file_name);



  $namevalue = 'paymentLinkDate="' . date('Y-m-d H:i:s') . '"';
  $where = 'id="' . $id . '"';
  updatelisting('sys_PackagePayment', $namevalue, $where);

?>

  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['qid']; ?>&c=5&save=1');
  </script>



<?php  }






if (trim($_REQUEST['action']) == 'sendInvoicemail'  && $_REQUEST['id'] != '' && $_REQUEST['queryId'] != '' && $_REQUEST['packageId'] != '') {

  $queryId = decode($_REQUEST['queryId']);
  $packageId = decode($_REQUEST['packageId']);
  $id = decode($_REQUEST['id']);

  $fd = GetPageRecord('*', 'queryMaster', 'id="' . $queryId . '"');
  $queryData = mysqli_fetch_array($fd);

  $rsa = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');
  $userDetail = mysqli_fetch_array($rsa);

  $rs = GetPageRecord($select, 'sys_userMaster', 'id in (select addedBy from sys_userMaster where id="' . $queryData['addedBy'] . '") ');
  $invoicedataa = mysqli_fetch_array($rs);

  $rsaa = GetPageRecord('*', 'sys_invoiceMaster', ' id="' . decode($_REQUEST['id']) . '" order by id desc');
  $invoiceData = mysqli_fetch_array($rsaa);


  $abasd = GetPageRecord('*', 'sys_userMaster', ' id="' . $_SESSION['userid'] . '" ');
  $signature = mysqli_fetch_array($abasd);

  $subject = 'Invoice: #' . $invoiceData['invoiceId'] . ' - ' . strip($invoicedataa['invoiceCompany']) . '';

  $mailbody = file_get_contents($fullurl . 'printInvoice.php?queryId=' . $_REQUEST['queryId'] . '&id=' . $_REQUEST['id'] . '&packageId=' . $_REQUEST['packageId']);
  $mailbody = $mailbody . '<br /><br /><br />' . strip($signature['emailsignature']);

  include "config/mail.php";
  $ccmail = $cc;
  $file_name = '';
  send_attachment_mail($fromemail, $userDetail['email'], stripslashes($subject), stripslashes($mailbody), $ccmail . ',' . $_SESSION['username'], $file_name);



  $namevalue = 'emailDate="' . date('Y-m-d H:i:s') . '"';
  $where = 'id="' . $id . '"';
  updatelisting('sys_invoiceMaster', $namevalue, $where);

?>

  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=5&save=1');
  </script>



  <?php  }





if (trim($_REQUEST['action']) == 'gethoteldatavaoucher'  && $_REQUEST['packageId'] != '' && $_REQUEST['queryId'] != '' && $_REQUEST['hotel'] != '') {

  $rsa = GetPageRecord('*', 'sys_packageBuilderEvent', 'id="' . $_REQUEST['hotel'] . '"');
  $enventData = mysqli_fetch_array($rsa);

  $rs = GetPageRecord('*', 'sys_packageBuilderEvent', ' name="' . $enventData['name'] . '" and sectionType="Accommodation"  order by id asc');
  while ($rest = mysqli_fetch_array($rs)) {
    $roomTypename .= stripslashes($rest['hotelRoom']) . ', ';
  }

  if ($enventData['id'] != '') {
  ?>
    <script>
      $('#destinationId').val('<?php echo stripslashes($enventData['destinationName']); ?>');
      $('#startDate').val('<?php echo date('d-m-Y', strtotime($enventData['startDate'])); ?>');
      $('#endDate').val('<?php echo date('d-m-Y', strtotime($enventData['endDate'])); ?>');
      $('#noOfRooms').val('<?php echo $enventData['singleRoom'] + $enventData['doubleRoom'] + $enventData['tripleRoom'] + $enventData['quadRoom'] + $enventData['cwbRoom'] + $enventData['cnbRoom']; ?>');
      $('#roomType').val('<?php echo stripslashes($enventData['hotelRoom']); ?>');
      $('#nights').val('<?php echo daysbydates($enventData['startDate'], $enventData['endDate']); ?>');
      $('#hotel').val('<?php echo stripslashes($enventData['name']); ?>');
    </script>

  <?php
  } else {

  ?>
    <script>
      $('#destinationId').val('');
      $('#startDate').val('');
      $('#endDate').val('');
      $('#noOfRooms').val('0');
      $('#roomType').val('');
      $('#nights').val('0');
      $('#hotel').val('');
    </script>

  <?php }
}






if (trim($_POST['action']) == 'addvoucher' && $_POST['queryId'] != '' && $_POST['packageId'] != '' && $_POST['hotel'] != '' && $_POST['confirmationNo'] != '' && $_POST['welcomeContent'] != '') {


  $inclusionsvalue = '';
  foreach ($_POST['inclusions'] as $check) {
    $inclusionsvalue .= $check . ',';
  }



  if ($_POST['editid'] > 0) {

    $namevalue2 = 'queryId="' . decode($_POST['queryId']) . '",packageId="' . decode($_POST['packageId']) . '",bannerImage="' . trim($_REQUEST['bannerImage']) . '",hotel="' . trim($_REQUEST['hotel']) . '",confirmationNo="' . addslashes($_REQUEST['confirmationNo']) . '",destination="' . addslashes($_REQUEST['destination']) . '",leadPaxName="' . addslashes($_REQUEST['leadPaxName']) . '",remark="' . addslashes($_REQUEST['remark']) . '",nights="' . trim($_REQUEST['nights']) . '",startDate="' . date('Y-m-d', strtotime($_REQUEST['startDate'])) . '",endDate="' . date('Y-m-d', strtotime($_REQUEST['endDate'])) . '",addedBy="' . $_SESSION['userid'] . '",noOfRooms="' . $_POST['noOfRooms'] . '",roomType="' . $_POST['roomType'] . '",transferMode="' . $_POST['transferMode'] . '",welcomeContent="' . addslashes($_POST['welcomeContent']) . '",mealPlan="' . $_POST['mealPlan'] . '",inclusions="' . $inclusionsvalue . '",dateAdded="' . date('Y-m-d H:i:s') . '",adult="' . $_REQUEST['adult'] . '",child="' . $_REQUEST['child'] . '",infant="' . $_REQUEST['infant'] . '",supplierName="' . addslashes($_REQUEST['supplierName']) . '"';
    $where = 'id="' . $_POST['editid'] . '"';
    updatelisting('sys_voucherMaster', $namevalue2, $where);


    $namevalue3 = 'details="Edit Voucher",queryId="' . decode($_REQUEST['queryId']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",logType="edit_query"';
    addlisting('queryLogs', $namevalue3);
  } else {

    $namevalue2 = 'queryId="' . decode($_POST['queryId']) . '",packageId="' . decode($_POST['packageId']) . '",bannerImage="' . trim($_REQUEST['bannerImage']) . '",hotel="' . trim($_REQUEST['hotel']) . '",confirmationNo="' . addslashes($_REQUEST['confirmationNo']) . '",destination="' . addslashes($_REQUEST['destination']) . '",remark="' . addslashes($_REQUEST['remark']) . '",leadPaxName="' . addslashes($_REQUEST['leadPaxName']) . '",nights="' . trim($_REQUEST['nights']) . '",startDate="' . date('Y-m-d', strtotime($_REQUEST['startDate'])) . '",endDate="' . date('Y-m-d', strtotime($_REQUEST['endDate'])) . '",addedBy="' . $_SESSION['userid'] . '",noOfRooms="' . $_POST['noOfRooms'] . '",roomType="' . $_POST['roomType'] . '",transferMode="' . $_POST['transferMode'] . '",welcomeContent="' . addslashes($_POST['welcomeContent']) . '",mealPlan="' . $_POST['mealPlan'] . '",inclusions="' . $inclusionsvalue . '",dateAdded="' . date('Y-m-d H:i:s') . '",adult="' . $_REQUEST['adult'] . '",child="' . $_REQUEST['child'] . '",infant="' . $_REQUEST['infant'] . '",supplierName="' . addslashes($_REQUEST['supplierName']) . '"';
    addlistinggetlastid('sys_voucherMaster', $namevalue2);

    $namevalue3 = 'details="Add Voucher",queryId="' . decode($_REQUEST['queryId']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",logType="edit_query"';
    addlisting('queryLogs', $namevalue3);
  }







  ?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=8&save=1');
  </script>
<?php
}



if (trim($_POST['action']) == 'schedulepaymentPlan' && $_POST['queryId'] != '' && $_POST['packageId'] != '' && $_POST['payment'] > 0) {

  $paymentschedule = trim($_POST['paymentschedule']);
  $payment = trim($_POST['payment']);

  $totalpay = round($payment / $paymentschedule);

  for ($i = 1; $i <= $paymentschedule; $i++) {

    $namevalue2 = 'queryId="' . decode($_POST['queryId']) . '",packageId="' . decode($_POST['packageId']) . '",amount="' . $totalpay . '",paymentStatus="2",paymentDate="' . date('Y-m-d') . '"';
    addlistinggetlastid('sys_PackagePayment', $namevalue2);
  }
?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=5&save=1');
  </script>
<?php
}






if (trim($_REQUEST['action']) == 'sendpaymentWithoutLink'  && $_REQUEST['pid'] != '' && $_REQUEST['qid'] != '' && $_REQUEST['id'] != '') {

  $queryId = decode($_REQUEST['qid']);
  $packageId = decode($_REQUEST['pid']);
  $id = decode($_REQUEST['id']);

  $fd = GetPageRecord('*', 'queryMaster', 'id="' . $queryId . '"');
  $queryData = mysqli_fetch_array($fd);

  $rsa = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');
  $userDetail = mysqli_fetch_array($rsa);

  $rs = GetPageRecord($select, 'sys_userMaster', 'id in (select addedBy from sys_userMaster where id="' . $queryData['addedBy'] . '") ');
  $invoicedataa = mysqli_fetch_array($rs);


  if ($_REQUEST['acn'] == 1) {
    $subject = 'Payment Acknowledgement (via ' . strip($invoicedataa['invoiceCompany']) . ')';
  } else {
    $subject = 'Payment Request (via ' . strip($invoicedataa['invoiceCompany']) . ')';
  }



  $mailbody = file_get_contents($fullurl . 'packagePaymentLink.php?pid=' . $_REQUEST['pid'] . '&id=' . $_REQUEST['id'] . '&qid=' . $_REQUEST['qid'] . '&wt=1');


  include "config/mail.php";
  $ccmail = $_POST['ccmails'];
  $file_name = '';
  send_attachment_mail($fromemail, $userDetail['email'], stripslashes($subject), stripslashes($mailbody), $ccmail . ',' . $_SESSION['username'], $file_name);



  $namevalue = 'paymentWithoutLinkDate="' . date('Y-m-d H:i:s') . '"';
  $where = 'id="' . $id . '"';
  updatelisting('sys_PackagePayment', $namevalue, $where);

?>

  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['qid']; ?>&c=5&save=1');
  </script>



<?php  }



if (trim($_REQUEST['action']) == 'saveconfee' && $_REQUEST['queryId'] != '' && $_REQUEST['id'] != '') {

  $conFee = trim($_REQUEST['conFee']);

  $namevalue2 = 'conFee="' . $conFee . '"';
  $where = 'id="' . decode($_REQUEST['id']) . '"';
  updatelisting('sys_PackagePayment', $namevalue2, $where);
}

if (trim($_REQUEST['action']) == 'sendSelectedPaymentPlanToMail' && $_REQUEST['queryId'] != '' && $_REQUEST['packageId'] != '') {

  $sendPaymentPlan = trim($_REQUEST['sendPaymentPlan']);
  $queryId = decode($_REQUEST['queryId']);
  $packageId = decode($_REQUEST['packageId']);



  $fd = GetPageRecord('*', 'queryMaster', 'id="' . $queryId . '"');
  $queryData = mysqli_fetch_array($fd);

  $rsa = GetPageRecord('*', 'userMaster', 'id="' . $queryData['clientId'] . '"');
  $userDetail = mysqli_fetch_array($rsa);

  $rs = GetPageRecord($select, 'sys_userMaster', 'id in (select addedBy from sys_userMaster where id="' . $queryData['addedBy'] . '") ');
  $invoicedataa = mysqli_fetch_array($rs);



  $subject = 'Payment Plan (via ' . strip($invoicedataa['invoiceCompany']) . ')';

  $mailbody = file_get_contents($fullurl . 'packagePaymentLink.php?pid=' . $_REQUEST['packageId'] . '&qid=' . $_REQUEST['queryId'] . '&shal=1');


  include "config/mail.php";
  $ccmail = trim($_POST['ccmails']);
  $file_name = '';
  send_attachment_mail($fromemail, $userDetail['email'], stripslashes($subject), stripslashes($mailbody), $ccmail . ',' . $_SESSION['username'], $file_name);



  $namevalue2 = 'sendPaymentPlanDate="' . date('Y-m-d H:i:s') . '"';
  $where = 'id="' . decode($_REQUEST['queryId']) . '"';
  updatelisting('queryMaster', $namevalue2, $where);

?>

  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryId']; ?>&c=5&save=1');
  </script>



<?php
}










if (trim($_POST['action']) == 'savemailsetting' && trim($_POST['fromName']) != '' && trim($_POST['emailAccount']) != '' && trim($_POST['emailPassword']) != '' && trim($_POST['smtpServer']) != '' && trim($_POST['emailPort']) != '') {


  $fromName = $_POST['fromName'];
  $emailAccount = $_POST['emailAccount'];
  $emailPassword = $_POST['emailPassword'];
  $smtpServer = $_POST['smtpServer'];
  $emailPort = $_POST['emailPort'];
  $securityType = $_POST['securityType'];

  $namevalue = 'fromName="' . $fromName . '",emailAccount="' . $emailAccount . '",emailPassword="' . $emailPassword . '",smtpServer="' . $smtpServer . '",emailPort="' . $emailPort . '",securityType="' . $securityType . '"';
  $where = 'id="' . $_SESSION['userid'] . '"';
  updatelisting('sys_userMaster', $namevalue, $where);



?>
  <script>
    parent.redirectpage('display.html?ga=mailsetting&save=1');
  </script>
<?php  }





if ($_POST['action'] == 'importFBleads' && $_FILES['importfield']['name'] != '') {
  require_once('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require_once('spreadsheet-reader-master/SpreadsheetReader.php');

  $addedBy = $_SESSION['userid'];
  $dateAdded = date('Y-m-d H:i:s');

  $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

  if (in_array($_FILES["importfield"]["type"], $allowedFileType)) {
    $targetPath = 'importfiles/' . $_FILES['importfield']['name'];
    move_uploaded_file($_FILES['importfield']['tmp_name'], $targetPath);
    $n = 0;
    $Reader = new SpreadsheetReader($targetPath);
    $sheetCount = count($Reader->sheets());
    for ($i = 0; $i < $sheetCount; $i++) {
      $Reader->ChangeSheet($i);

      foreach ($Reader as $Row) {
        $n++;
        if ($n > 1) {
          $leadsource = trim($Row[0]);
          $travelMonth = trim($Row[1]);
          $description = trim($Row[2]);
          $clientName = trim($Row[3]);
          $email = trim($Row[4]);
          $phone = trim($Row[5]);
          $fromCity = trim($Row[6]);
          $destination = trim($Row[7]);
          $chekin = date('Y-m-d', strtotime(trim($Row[8])));
          $checkout = date('Y-m-d', strtotime(trim($Row[9])));
          $adult = trim($Row[10]);
          $child = trim($Row[11]);
          $infant = trim($Row[12]);
          $details = trim($Row[13]);

          $clientId = '';

          if ($clientName == '') {
            $clientName = $phone;
          }

          if ($leadsource == 'fb' || $leadsource == 'ig') {

            if ($leadsource == 'fb') {
              $leadSource = '13';
            }

            if ($leadsource == 'ig') {
              $leadSource = '14';
            }
          } else {

            $a = GetPageRecord('*', 'querySourceMaster', 'name="' . $leadsource . '"');
            if (mysqli_num_rows($a) > 0) {
              $datalead = mysqli_fetch_array($a);
              $leadSource = $datalead['id'];
            } else {
              $leadSource = '16';
            }
          }

          $a = GetPageRecord('*', 'cityMaster', 'name="' . $destination . '"');
          if (mysqli_num_rows($a) > 0) {
            $datacity = mysqli_fetch_array($a);
            $destinationId = $datacity['id'];
          } else {
            $namevalue = 'name="' . $destination . '",status=1';
            $lstDest = addlistinggetlastid('cityMaster', $namevalue);
            $destinationId = $lstDest;
          }

          $assignedToId = 0;

          $a2 = GetPageRecord('*', 'sys_user_city_mapping', 'city_id="' . $destinationId . '"');
          $userCount = mysqli_num_rows($a2);
          if ($userCount > 0) {
              if($userCount > 1){
                  $userIdArr = [];
                  while($res = mysqli_fetch_assoc($a2)){
                      $userIdArr[] = $res['user_id'];
                  }

                  $userIds = implode(',',$userIdArr);

                  $getUserWithMinQry = GetPageRecord('assignTo,COUNT(id) as minNewQry', 'queryMaster', " statusId=1 and assignTo IN($userIds) GROUP BY assignTo ORDER BY minNewQry ASC LIMIT 1" );
                  if(mysqli_num_rows($getUserWithMinQry) > 0){
                      $userData = mysqli_fetch_assoc($getUserWithMinQry);
                      $assignedToId = $userData['assignTo'];

                  }
                  else{
                      $maxSrchIndx = (count($userIdArr) - 1);
                      $assignedToId = $userIdArr[rand(0,$maxSrchIndx)];
                  }
              }
              else{
                  $getUser = mysqli_fetch_assoc($a2);
                  $assignedToId = $getUser['user_id'];
              }
          }
          else{
              $assignedToId = 1;
          }

          $a = GetPageRecord('*', 'userMaster', 'mobile="' . $phone . '" and userType=4');
          if (mysqli_num_rows($a) > 0) {
            $profilename = mysqli_fetch_array($a);
            $clientName = $profilename['firstName'] . ' ' . $profilename['lastName'];
            $clientId = $profilename['id'];
          } else {
            $namevalue = 'email="' . $email . '",mobile="' . $phone . '",firstName="' . $clientName . '",status=1,profileId=5,userType=4,dateAdded="' . time() . '",addedBy="' . $_SESSION['userid'] . '"';
            $clientId = addlistinggetlastid('userMaster', $namevalue);
          }

          $b = GetPageRecord('*', 'sys_userMaster', 'id="' . $assignedToId . '"');
          $agentdetails = mysqli_fetch_array($b);
          $agentname = $agentdetails['firstName'] . ' ' . $agentdetails['lastName'];
          if($agentdetails['mobile'] == ''){
                  $agentphone = $agentdetails['phone'];
              }
          else{
            $agentphone = $agentdetails['mobile'];
          }

          if ($phone != '') {
            $namevalue = 'startDate="' . $chekin . '",endDate="' . $checkout . '",name="' . $clientName . '",phone="' . $phone . '",cityId="",email="' . $email . '",destinationId="' . $destinationId . '",serviceId="1",adult="' . $adult . '",child="' . $child . '",infant="' . $infant . '",assignTo="' .$assignedToId .'",leadSource="' . $leadSource . '",details="' . $description . ' (' . $details . ')' . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",updateDate="' . $dateAdded . '",clientId="' . $clientId . '",fromCity="Delhi",travelMonth="' . $travelMonth . '"';
            $queryId = addlistinggetlastid('queryMaster', $namevalue);
          }
		  
		  
          if ($assignedToId != 1) {	
            $userid = '2000217680';
            $passwd = 'ksrcbmxS';
            $supportTeam = '8544811103';

            $msgReqURL = 'https://media.smsgupshup.com/GatewayAPI/rest?userid=2000217680&password='.$passwd.'&send_to='.$phone.'&v=1.1&format=json&msg_type=TEXT&method=SENDMESSAGE&msg=Dear+'.urlencode($clientName).'%2C%0A%0AThank+you+for+contacting+us%21+Our+travel+buddy+'.urlencode($agentname).'+will+contact+you+shortly%21%F0%9F%98%87%0A%0AYou+can+also+reach+out+to+our+travel+buddy%21+%F0%9F%93%9E+%0A%0A%2ATravel+Buddy%2A%3A+%2A'.urlencode($agentname).'%2A+%0A%2AContact+Details%2A%3A++%2A'.$agentphone.'%2A+%0A%0ABe+Ready+To+Save+Huge+On+Flights+%E2%9C%88%EF%B8%8F%2C+Stays+%F0%9F%8F%A8%2C++Holiday+%F0%9F%9B%84%2C+%26+Cabs+for+your+next+trip+to+'.urlencode($destination).'+%F0%9F%9A%95%0A%0APlan+Your+Trip+with+Us+Now%21%F0%9F%98%89';
                  
            $curl1 = curl_init($msgReqURL);
            curl_setopt($curl1, CURLOPT_POST, true);
            curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
            $result1 = curl_exec($curl1);
            curl_close($curl1);
            echo "\n\ntest: ".$result1;
          }
        }
      }
    }
  } else {
    echo $type = "error";
    echo $message = "Invalid File Type. Upload Excel File.";
  }

?>



  <script>
    parent.redirectpage('display.html?ga=query&save=1');
  </script>



<?php }









if (trim($_POST['action']) == 'addmanualvoucher' && $_POST['hotel'] != '' && $_POST['confirmationNo'] != '' && $_POST['welcomeContent'] != '') {






  if ($_POST['editid'] > 0) {
    $namevalue2 = 'bannerImage="' . trim($_REQUEST['bannerImage']) . '",hotel="' . trim($_REQUEST['hotel']) . '",confirmationNo="' . addslashes($_REQUEST['confirmationNo']) . '",destination="' . addslashes($_REQUEST['destination']) . '",leadPaxName="' . addslashes($_REQUEST['leadPaxName']) . '",remark="' . addslashes($_REQUEST['remark']) . '",nights="' . trim($_REQUEST['nights']) . '",startDate="' . date('Y-m-d', strtotime($_REQUEST['startDate'])) . '",endDate="' . date('Y-m-d', strtotime($_REQUEST['endDate'])) . '",addedBy="' . $_SESSION['userid'] . '",noOfRooms="' . $_POST['noOfRooms'] . '",roomType="' . $_POST['roomType'] . '",transferMode="' . $_POST['transferMode'] . '",welcomeContent="' . addslashes($_POST['welcomeContent']) . '",mealPlan="' . $_POST['mealPlan'] . '",inclusions="' . addslashes($_POST['inclusions']) . '",dateAdded="' . date('Y-m-d H:i:s') . '",adult="' . $_REQUEST['adult'] . '",child="' . $_REQUEST['child'] . '",infant="' . $_REQUEST['infant'] . '",supplierName="' . addslashes($_REQUEST['supplierName']) . '"';
    $where = 'id="' . $_POST['editid'] . '"';
    updatelisting('sys_manualVoucherMaster', $namevalue2, $where);
  } else {

    $namevalue2 = 'bannerImage="' . trim($_REQUEST['bannerImage']) . '",hotel="' . trim($_REQUEST['hotel']) . '",confirmationNo="' . addslashes($_REQUEST['confirmationNo']) . '",destination="' . addslashes($_REQUEST['destination']) . '",remark="' . addslashes($_REQUEST['remark']) . '",leadPaxName="' . addslashes($_REQUEST['leadPaxName']) . '",nights="' . trim($_REQUEST['nights']) . '",startDate="' . date('Y-m-d', strtotime($_REQUEST['startDate'])) . '",endDate="' . date('Y-m-d', strtotime($_REQUEST['endDate'])) . '",addedBy="' . $_SESSION['userid'] . '",noOfRooms="' . $_POST['noOfRooms'] . '",roomType="' . $_POST['roomType'] . '",transferMode="' . $_POST['transferMode'] . '",welcomeContent="' . addslashes($_POST['welcomeContent']) . '",mealPlan="' . $_POST['mealPlan'] . '",inclusions="' . addslashes($_POST['inclusions']) . '",dateAdded="' . date('Y-m-d H:i:s') . '",adult="' . $_REQUEST['adult'] . '",child="' . $_REQUEST['child'] . '",infant="' . $_REQUEST['infant'] . '",supplierName="' . addslashes($_REQUEST['supplierName']) . '"';
    addlistinggetlastid('sys_manualVoucherMaster', $namevalue2);
  }







?>
  <script>
    parent.redirectpage('display.html?ga=manualvoucher&save=1');
  </script>
<?php
}





if (trim($_POST['action']) == 'composemailmanualvoucher' && $_POST['subject'] != '' && $_POST['EmailDetails'] != '') {
  $subject = addslashes($_POST['subject']);
  $EmailDetails = addslashes($_POST['EmailDetails']);
  $day = addslashes($_POST['day']);
  $toEmail = addslashes($_POST['toEmail']);
  $cc = addslashes($_POST['cc']);



  if ($_FILES["attachment"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['attachment']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $attachment = time() . $rt . '.' . $companyLogoFileExtension;
    move_uploaded_file($_FILES["attachment"]["tmp_name"], "voucherAttachments/{$attachment}");
  }



?>
  <script>
    parent.$('#popcontent').html('<div style="padding:10px; text-align:center;"><img src="images/loading.gif" width="32" ></div>');
  </script>
  <?php

  include "config/mail.php";

  $ccmail = $cc;
  $file_name = '';
  send_attachment_mail($fromemail, $toEmail, stripslashes($subject), stripslashes($EmailDetails . '<img src="' . $fullurl . 'readmail.php?m=' . encode($lastid) . '" width="0" height="0">'), $ccmail . ',' . $_SESSION['username'], $attachment);
  ?>

  <script>
    parent.redirectpage('display.html?ga=manualvoucher&id=<?php echo encode($queryId); ?>&save=1');
  </script>



  <?php  }

if ($_POST['action'] == 'loginmanualvoucher' && trim($_POST['pin']) != '') {
  $pin = trim($_POST['pin']);

  $ras = GetPageRecord('*', 'sys_userMaster', 'id=1 and manualVoucherPin="' . $pin . '"');
  if (mysqli_num_rows($ras) > 0) {
    $_SESSION['manualVoucherPin'] = $pin;
  ?>
    <script>
      parent.redirectpage('display.html?ga=manualvoucher');
    </script>
  <?php
  } else {
  ?>
    <script>
      alert('Pin not matched!');
    </script>
  <?php
  }
}




if (trim($_POST['action']) == 'addmealplan') {


  if ($_POST['editId'] > 0) {
    $namevalue2 = 'name="' . trim($_REQUEST['name']) . '",status="' . ($_REQUEST['status']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('mealPlanMaster', $namevalue2, $where);
  } else {

    $namevalue2 = 'name="' . trim($_REQUEST['name']) . '",status="' . ($_REQUEST['status']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '"';
    addlistinggetlastid('mealPlanMaster', $namevalue2);
  }

  ?>
  <script>
    parent.redirectpage('display.html?ga=mealplan&save=1');
  </script>
<?php
}



if (trim($_POST['action']) == 'cityMaster') {


  if ($_POST['editId'] > 0) {
    $namevalue2 = 'name="' . trim($_REQUEST['name']) . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('cityMaster', $namevalue2, $where);
  } else {

    $namevalue2 = 'name="' . trim($_REQUEST['name']) . '"';
    addlistinggetlastid('cityMaster', $namevalue2);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=destinations&save=1');
  </script>
<?php
}





if (trim($_POST['action']) == 'addLeisure' && trim($_POST['name']) != '' && trim($_POST['startDate']) != '') {
  $packageDays = addslashes($_POST['packageDays']);
  $hotelName = addslashes($_POST['name']);
  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['startDate']));
  $hotelRoom = addslashes($_POST['hotelRoom']);
  $hotelCategory = addslashes($_POST['hotelCategory']);
  $mealPlan = addslashes($_POST['mealPlan']);
  $singleRoom = addslashes($_POST['singleRoom']);
  $doubleRoom = addslashes($_POST['doubleRoom']);
  $tripleRoom = addslashes($_POST['tripleRoom']);
  $quadRoom = addslashes($_POST['quadRoom']);
  $cwbRoom = addslashes($_POST['cwbRoom']);
  $cnbRoom = addslashes($_POST['cnbRoom']);
  $checkIn = addslashes($_POST['checkIn']);
  $checkOut = addslashes($_POST['checkOut']);
  $pid = decode($_POST['pid']);
  $editId = addslashes($_POST['editId']);
  $description = addslashes($_POST['description']);
  $destinationName = addslashes(trim($_POST['destinationName']));
  $days = daysbydates($startDate, $endDate) + 1;

  if ($editId != '') {

    $namevalue = 'name="' . $hotelName . '",startDate="' . $startDate . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",description="' . $description . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",days="' . $days . '",destinationName="' . $destinationName . '"';
    $where = 'id="' . decode($editId) . '"';
    updatelisting('sys_packageBuilderEvent', $namevalue, $where);
  } else {

    $namevalue = 'name="' . $hotelName . '",packageId="' . $pid . '",startDate="' . $startDate . '",packageDays="' . $packageDays . '",description="' . $description . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",sectionType="Leisure",addedBy="' . $_SESSION['userid'] . '",days="' . $days . '",dateAdded="' . date('Y-m-d H:i:s') . '",destinationName="' . $destinationName . '"';
    $lstaddid = addlistinggetlastid('sys_packageBuilderEvent', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_POST['pid']; ?>&save=1');
  </script>
<?php
}



if (trim($_POST['action']) == 'addInclusions') {



  if ($_FILES["inclusionsImg"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['inclusionsImg']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $inclusionsImg = time() . $rt . '.' . $companyLogoFileExtension;
    move_uploaded_file($_FILES["inclusionsImg"]["tmp_name"], "package_image/{$inclusionsImg}");
  }

  if ($inclusionsImg == '') {
    $inclusionsImg = trim($_POST['inclusionsImgOld']);
  }



  if ($_FILES["impTipsImg"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName1 = basename($_FILES['impTipsImg']['name']);
    $companyLogoFileExtension1 = pathinfo($companyLogoFileName1, PATHINFO_EXTENSION);
    $impTipsImg = time() . $rt . '.' . $companyLogoFileExtension1;
    move_uploaded_file($_FILES["impTipsImg"]["tmp_name"], "package_image/{$impTipsImg}");
  }

  if ($impTipsImg == '') {
    $impTipsImg = trim($_POST['impTipsImgOld']);
  }



  if ($_FILES["exclusionsImg"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName2 = basename($_FILES['exclusionsImg']['name']);
    $companyLogoFileExtension2 = pathinfo($companyLogoFileName2, PATHINFO_EXTENSION);
    $exclusionsImg = time() . $rt . '.' . $companyLogoFileExtension2;
    move_uploaded_file($_FILES["exclusionsImg"]["tmp_name"], "package_image/{$exclusionsImg}");
  }

  if ($exclusionsImg == '') {
    $exclusionsImg = trim($_POST['exclusionsImgOld']);
  }

  if ($_FILES["travelInfoImg"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName3 = basename($_FILES['travelInfoImg']['name']);
    $companyLogoFileExtension3 = pathinfo($companyLogoFileName3, PATHINFO_EXTENSION);
    $travelInfoImg = time() . $rt . '.' . $companyLogoFileExtension3;
    move_uploaded_file($_FILES["travelInfoImg"]["tmp_name"], "package_image/{$travelInfoImg}");
  }

  if ($travelInfoImg == '') {
    $travelInfoImg = trim($_POST['travelInformationImgOld']);
  }

  $namevalue2 = 'inclusionsTitle="' . addslashes(($_POST['inclusionsTitle'])) . '",importantTipsTitle="' . addslashes(($_POST['importantTipsTitle'])) . '",exclusionsTitle="' . addslashes(($_POST['exclusionsTitle'])) . '",travelInformationTitle="' . addslashes(($_POST['travelInformationTitle'])) . '",inclusionsImg="' . $inclusionsImg . '",packageInclusions="' . addslashes(($_POST['packageInclusions'])) . '",impTipsImg="' . $impTipsImg . '",packageImportantTips="' . addslashes(($_POST['packageImportantTips'])) . '",exclusionsImg="' . $exclusionsImg . '",packageExclusions="' . addslashes(($_POST['packageExclusions'])) . '",travelInfoImg="' . $travelInfoImg . '",packageTravelInfo="' . addslashes(($_POST['packageTravelInfo'])) . '"';
  $where = 'id="1"';
  updatelisting('sys_userMaster', $namevalue2, $where);


?>
  <script>
    parent.redirectpage('display.html?ga=inclusions&save=1');
  </script>
<?php
}






if (trim($_POST['action']) == 'addCruise' && trim($_POST['name']) != '' && trim($_POST['startDate']) != '') {
  $packageDays = addslashes($_POST['packageDays']);
  $hotelName = addslashes($_POST['name']);
  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['startDate']));
  $hotelRoom = addslashes($_POST['hotelRoom']);
  $hotelCategory = addslashes($_POST['hotelCategory']);
  $mealPlan = addslashes($_POST['mealPlan']);
  $singleRoom = addslashes($_POST['singleRoom']);
  $doubleRoom = addslashes($_POST['doubleRoom']);
  $tripleRoom = addslashes($_POST['tripleRoom']);
  $quadRoom = addslashes($_POST['quadRoom']);
  $cwbRoom = addslashes($_POST['cwbRoom']);
  $cnbRoom = addslashes($_POST['cnbRoom']);
  $checkIn = addslashes($_POST['checkIn']);
  $checkOut = addslashes($_POST['checkOut']);
  $showTime = addslashes($_POST['showTime']);
  $pid = decode($_POST['pid']);
  $editId = addslashes($_POST['editId']);
  $description = addslashes($_POST['description']);
  $destinationName = addslashes(trim($_POST['destinationName']));
  $days = daysbydates($startDate, $endDate) + 1;

  if ($editId != '') {

    $namevalue = 'name="' . $hotelName . '",startDate="' . $startDate . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",description="' . $description . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '",days="' . $days . '",destinationName="' . $destinationName . '",showTime="' . $showTime . '"';
    $where = 'id="' . decode($editId) . '"';
    updatelisting('sys_packageBuilderEvent', $namevalue, $where);
  } else {

    $namevalue = 'name="' . $hotelName . '",packageId="' . $pid . '",startDate="' . $startDate . '",packageDays="' . $packageDays . '",description="' . $description . '",endDate="' . $endDate . '",hotelRoom="' . $hotelRoom . '",hotelCategory="' . $hotelCategory . '",mealPlan="' . $mealPlan . '",singleRoom="' . $singleRoom . '",doubleRoom="' . $doubleRoom . '",tripleRoom="' . $tripleRoom . '",quadRoom="' . $quadRoom . '",cwbRoom="' . $cwbRoom . '",cnbRoom="' . $cnbRoom . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",sectionType="Cruise",addedBy="' . $_SESSION['userid'] . '",days="' . $days . '",dateAdded="' . date('Y-m-d H:i:s') . '",destinationName="' . $destinationName . '",showTime="' . $showTime . '"';
    $lstaddid = addlistinggetlastid('sys_packageBuilderEvent', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=itineraries&view=1&id=<?php echo $_POST['pid']; ?>&save=1');
  </script>
<?php
}




if (trim($_POST['action']) == 'stepverificationaction') {


  $namevalue = 'stepVerification=0,qrCodeOn=0';
  $where = '1';
  updatelisting('sys_userMaster', $namevalue, $where);


  foreach ($_POST['stipverification'] as $check) {
    $namevalue = 'stepVerification=1';
    $where = 'id="' . decode($check) . '"';
    updatelisting('sys_userMaster', $namevalue, $where);
  }


  foreach ($_POST['qrcodeon'] as $checkqrcodeon) {
    $namevalue = 'qrCodeOn=1';
    $where = 'id="' . decode($checkqrcodeon) . '" and id!=1';
    updatelisting('sys_userMaster', $namevalue, $where);
  }

  $namevalue = 'qrCodeOn=1';
  $where = 'id=1';
  updatelisting('sys_userMaster', $namevalue, $where);

?>
  <script>
    parent.redirectpage('display.html?ga=team&save=1');
  </script>

  <?php


}



if (trim($_REQUEST['action']) == 'chqqr') {
  if ($LoginUserDetails['qrCode'] == $LoginUserDetails['verifyQrCode']) {
  ?>
    <script>
      redirectpage('<?php echo $fullurl; ?>');
    </script>
  <?php
  }
}







if (trim($_POST['action']) == 'addGuest' && trim($_POST['submitName']) != '' && trim($_POST['firstName']) != '' && trim($_POST['lastName']) != '' && trim($_POST['gender']) != '' && trim($_POST['startDate']) != '') {
  $submitName = addslashes($_POST['submitName']);
  $firstName = addslashes($_POST['firstName']);
  $lastName = addslashes($_POST['lastName']);
  $gender = addslashes($_POST['gender']);
  $dob = date('Y-m-d', strtotime($_POST['startDate']));
  $editid = decode($_POST['editId']);
  $queryId = decode($_POST['queryId']);


  if ($editid != '') {

    $namevalue = 'queryId="' . $queryId . '",gender="' . $gender . '",dob="' . $dob . '",firstName="' . $firstName . '",lastName="' . $lastName . '",submitName="' . $submitName . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    $where = 'id="' . $editid . '"';
    updatelisting('sys_guests', $namevalue, $where);
  } else {

    $namevalue = 'queryId="' . $queryId . '",gender="' . $gender . '",dob="' . $dob . '",firstName="' . $firstName . '",lastName="' . $lastName . '",submitName="' . $submitName . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    $lstaddid = addlistinggetlastid('sys_guests', $namevalue);
  }


  ?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['queryId']; ?>&c=10&save=1');
  </script>
<?php
}




if (trim($_POST['action']) == 'addGuestDocuments') {

  $editId = decode($_POST['editId']);
  $queryId = decode($_POST['queryId']);


  if ($_FILES["panCard"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['panCard']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $panCard = time() . $rt . '.' . $companyLogoFileExtension;
    move_uploaded_file($_FILES["panCard"]["tmp_name"], "profilepic/{$panCard}");


    $namevalue = 'queryId="' . $queryId . '",guestId="' . $editId . '",documentType="PanCard",document="' . $panCard . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    addlistinggetlastid('sys_guestsDucument', $namevalue);
  }



  if ($_FILES["passportFront"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['passportFront']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $passportFront = time() . $rt . '.' . $companyLogoFileExtension;
    move_uploaded_file($_FILES["passportFront"]["tmp_name"], "profilepic/{$passportFront}");

    $namevalue = 'queryId="' . $queryId . '",guestId="' . $editId . '",documentType="PassportFront",document="' . $passportFront . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    addlistinggetlastid('sys_guestsDucument', $namevalue);
  }



  if ($_FILES["passportBack"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['passportBack']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $passportBack = time() . $rt . '.' . $companyLogoFileExtension;
    move_uploaded_file($_FILES["passportBack"]["tmp_name"], "profilepic/{$passportBack}");

    $namevalue = 'queryId="' . $queryId . '",guestId="' . $editId . '",documentType="PassportBack",document="' . $passportBack . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    addlistinggetlastid('sys_guestsDucument', $namevalue);
  }





  $totfile = count($_FILES["flight"]["tmp_name"]);

  for ($i = 0; $i <= $totfile; $i++) {
    if ($_FILES["flight"]["tmp_name"][$i] != "") {
      $rt = mt_rand() . strtotime(date("YMDHis"));
      $companyLogoFileName = basename($_FILES['flight']['name'][$i]);
      $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
      $flight = time() . $rt . '.' . $companyLogoFileExtension;
      move_uploaded_file($_FILES["flight"]["tmp_name"][$i], "profilepic/{$flight}");

      $namevalue = 'queryId="' . $queryId . '",guestId="' . $editId . '",documentType="Flight",document="' . $flight . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
      addlistinggetlastid('sys_guestsDucument', $namevalue);
    }
  }









?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['queryId']; ?>&c=10&save=1');
  </script>
  <?php
}




if (trim($_REQUEST['action']) == 'savesuppliercosting' && $_REQUEST['editId'] != '') {

  $confirmationNo = addslashes($_REQUEST['confirmationNo']);
  $supplierId = addslashes($_REQUEST['supplierId']);
  $status = addslashes($_REQUEST['statusId']);
  $paidAmount = addslashes($_REQUEST['paidAmount']);
  $pendingAmount = addslashes($_REQUEST['pendingAmount']);
  $bookingStatusId = addslashes($_REQUEST['bookingStatusId']);
  $lossAmount = addslashes($_REQUEST['lossAmount']);
  $marginAmount = addslashes($_REQUEST['marginAmount']);




  $r1selectedCurrency = addslashes($_REQUEST['r1Currency']);

  $r1Currencyrate = addslashes($_REQUEST['r1Currencyrate']);
  $r1XErate = addslashes($_REQUEST['r1XErate']);
  $r1Cost = addslashes($_REQUEST['r1Cost']);

  $r2Currencyrate = addslashes($_REQUEST['r2Currencyrate']);
  $r2XErate = addslashes($_REQUEST['r2XErate']);
  $r2Cost = addslashes($_REQUEST['r2Cost']);


  if ($bookingStatusId == 2 && $confirmationNo == '') {
  ?>
    <script>
      alert('Please enter confirmation number...!');
      parent.$('#savingbutton').val('Save');
    </script>
  <?php
    exit();
  }
  $supplierAmount = addslashes($_REQUEST['supplierAmount']);
  $dueDate = date('Y-m-d', strtotime($_REQUEST['dueDate']));
  $suppliercancellationdate = date('Y-m-d', strtotime($_REQUEST['suppliercancellationdate']));

  $namevalue = 'supplierId="' . $supplierId . '",bookingStatusId="' . $bookingStatusId . '",supplierAmount="' . $supplierAmount . '",dueDate="' . $dueDate . '",paidAmount="' . $paidAmount . '",pendingAmount="' . $pendingAmount . '",supplierCancellationDate="' . $suppliercancellationdate . '",status="' . $status . '",confirmationNo="' . $confirmationNo . '",lossAmount="' . $lossAmount . '",marginAmount="' . $marginAmount . '",r1selectedCurrency="' . $r1selectedCurrency . '",r1Currencyrate="' . $r1Currencyrate . '",r1XErate="' . $r1XErate . '",r1Cost="' . $r1Cost . '",r2Currencyrate="' . $r2Currencyrate . '",r2XErate="' . $r2XErate . '",r2Cost="' . $r2Cost . '"';
  $where = 'id="' . decode($_REQUEST['editId']) . '"';
  updatelisting('sys_packageBuilderEvent', $namevalue, $where);

  ?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_POST['queryId']; ?>&c=9&save=1');
  </script>
<?php

}



if (trim($_POST['action']) == 'addSupplierNotes' && trim($_POST['queryId']) != '' && trim($_POST['id']) != '' && trim($_POST['remark']) != '') {

  $queryId = decode($_POST['queryId']);
  $serviceId = decode($_POST['id']);
  $remark = addslashes($_POST['remark']);

  $namevalue = 'queryId="' . $queryId . '",serviceId="' . $serviceId . '",details="' . $remark . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
  addlistinggetlastid('supplierNotes', $namevalue);

?>
  <script>
    parent.querySupplierNotes();
  </script>
<?php
}







if (trim($_REQUEST['action']) == 'deletebill' && trim($_REQUEST['parentId']) != '' && trim($_REQUEST['id']) != '') {
  deleteRecord('sys_PackagePayment', 'id="' . decode($_REQUEST['id']) . '"');
?>
  <script>
    parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['parentId']; ?>&save=1&c=5');
  </script>
<?php
}




if (trim($_POST['action']) == 'addcurrencyexchange') {


  if ($_POST['editId'] > 0) {
    $namevalue2 = 'name="' . trim($_REQUEST['name']) . '",rate="' . ($_REQUEST['rate']) . '",status="' . ($_REQUEST['status']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('currencyExchangeMaster', $namevalue2, $where);
  } else {

    $namevalue2 = 'name="' . trim($_REQUEST['name']) . '",rate="' . ($_REQUEST['rate']) . '",status="' . ($_REQUEST['status']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '"';
    addlistinggetlastid('currencyExchangeMaster', $namevalue2);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=currencyExchange');
  </script>
<?php
}




if (trim($_REQUEST['action']) == 'saveprice') {

  $rs2 = GetPageRecord('*', 'currencyExchangeMaster', 'id="' . $_REQUEST['currency'] . '" order by id asc');
  $restsup = mysqli_fetch_array($rs2);

  $namevalue2 = 'r1Currency="' . trim($_REQUEST['currency']) . '",r1XE="' . ($restsup['rate']) . '"';
  $where = 'id="' . decode($_REQUEST['editId']) . '"';
  //updatelisting('sys_packageBuilderEvent',$namevalue2,$where);  


?>
  <script>
    parent.$('.exchangecurr').text('<?php echo rtrim(rtrim((string)number_format($_REQUEST['netCost'] / $restsup['rate'], 2, ".", ""), "0"), "."); ?>');
    parent.$('#r1Currencyrate').val('<?php echo rtrim(rtrim((string)number_format($_REQUEST['netCost'] / $restsup['rate'], 2, ".", ""), "0"), "."); ?>');
    parent.$('#r2Currency').val('<?php echo rtrim(rtrim((string)number_format($_REQUEST['netCost'] / $restsup['rate'], 2, ".", ""), "0"), "."); ?>');

    parent.$('.currname').text('<?php echo $restsup['name']; ?>');

    parent.$('#r1XE').text('<?php echo $restsup['rate']; ?>');
    parent.$('#r1XErate').val('<?php echo $restsup['rate']; ?>');
    parent.$('#r2XE').val('<?php echo $restsup['rate']; ?>');

    parent.$('#r2totalCost').text('<?php echo rtrim(rtrim((string)number_format($_REQUEST['netCost'], 2, ".", ""), "0"), "."); ?>');
    parent.$('#r2Cost').text('<?php echo rtrim(rtrim((string)number_format($_REQUEST['netCost'], 2, ".", ""), "0"), "."); ?>');
  </script>
<?php
}



if (trim($_REQUEST['action']) == 'savepricemanual') {

  $convert = round($_REQUEST['r2Currency'] * $_REQUEST['r2XE']);


  $namevalue2 = 'r2XE="' . trim($_REQUEST['r2XE']) . '",r2Currency="' . $convert . '"';
  $where = 'id="' . decode($_REQUEST['editId']) . '"';
  //updatelisting('sys_packageBuilderEvent',$namevalue2,$where);  


?>
  <script>
    parent.$('#r2Cost').val('<?php echo $convert; ?>');
    parent.$('#r2totalCost').text('<?php echo $convert; ?>');
    parent.$('#supplierAmount').val('<?php echo $convert; ?>');
    parent.$('#pendingAmount').val('<?php echo $convert - $_REQUEST['paidAmount']; ?>');
  </script>
<?php
}






if (trim($_POST['action']) == 'addHotelMaster' && $_POST['name'] != '' && $_POST['destination'] != '') {

  $name = addslashes($_POST['name']);
  $category = addslashes($_POST['category']);
  $destination = addslashes($_POST['destination']);
  $status = addslashes(strip_tags($_POST['status']));
  $address = addslashes(strip_tags($_POST['address']));
  $details = addslashes(($_POST['details']));
  $contactPerson = addslashes(($_POST['contactPerson']));
  $contactPersonEmail = addslashes(($_POST['contactPersonEmail']));
  $contactPersonPhone = addslashes(($_POST['contactPersonPhone']));
  $imgLink = addslashes(($_POST['imgLink']));
  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');


  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();

    $companyLogoFileName = basename($_FILES['image']['name']);

    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);

    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);

    move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($_REQUEST['editId'] == '') {

    $namevalue = 'name="' . $name . '",category="' . $category . '",countryId="' . $countryId . '",destination="' . $destination . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",amenities="' . $amenities . '",hotelPhoto="' . $profilePhoto . '",address="' . $address . '",hotelType="' . $hotelType . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",details="' . $details . '",mapURL="' . $mapURL . '",contactPerson="' . $contactPerson . '",contactPersonEmail="' . $contactPersonEmail . '",contactPersonPhone="' . $contactPersonPhone . '",imgLink="' . $imgLink . '"';
    addlisting('hotelMaster', $namevalue);
  } else {


    $namevalue = 'name="' . $name . '",category="' . $category . '",countryId="' . $countryId . '",destination="' . $destination . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",amenities="' . $amenities . '",hotelPhoto="' . $profilePhoto . '",address="' . $address . '",hotelType="' . $hotelType . '",checkIn="' . $checkIn . '",checkOut="' . $checkOut . '",details="' . $details . '",mapURL="' . $mapURL . '",contactPerson="' . $contactPerson . '",contactPersonEmail="' . $contactPersonEmail . '",contactPersonPhone="' . $contactPersonPhone . '",imgLink="' . $imgLink . '"';

    $where = 'id="' . decode($_POST['editId']) . '"';

    updatelisting('hotelMaster', $namevalue, $where);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=hotel&save=1');
  </script>
<?php
}







if (trim($_POST['action']) == 'addhotelratelist' && trim($_POST['startDate']) != '' && trim($_POST['endDate']) != '' && trim($_POST['roomType']) != '' && trim($_POST['mealPlan']) != '' && trim($_POST['hotelId']) != '') {



  $startDate = date('Y-m-d', strtotime($_POST['startDate']));

  $endDate = date('Y-m-d', strtotime($_POST['endDate']));

  $roomType = addslashes($_POST['roomType']);
  $noOfDays = addslashes($_POST['noOfDays']);
  $maxpax = addslashes($_POST['maxpax']);

  $mealPlan = addslashes($_POST['mealPlan']);

  $currencyId = addslashes($_POST['currencyId']);

  $supplierId = addslashes($_POST['supplierId']);

  $single = addslashes($_POST['single']);

  $double = addslashes($_POST['double']);
  $oldlogo = addslashes($_POST['oldlogo']);
  $singlemarkup = addslashes($_POST['singlemarkup']);
  $doublemarkup = addslashes($_POST['doublemarkup']);
  $triplemarkup = addslashes($_POST['triplemarkup']);
  $quadmarkup = addslashes($_POST['quadmarkup']);
  $childBedmarkup = addslashes($_POST['childBedmarkup']);
  $extraBedmarkup = addslashes($_POST['extraBedmarkup']);
  $transferId = addslashes($_POST['transferId']);
  $infent = addslashes($_POST['infent']);

  $triple = addslashes($_POST['triple']);

  $quad = addslashes($_POST['quad']);

  $childBed = addslashes($_POST['childBed']);
  $details = addslashes($_POST['details']);

  $extraAdult = addslashes($_POST['extraAdult']);

  $status = addslashes(strip_tags($_POST['status']));
  $extraNight = addslashes(strip_tags($_POST['extraNight']));

  $hotelId = addslashes(decode($_POST['hotelId']));

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');







  if ($_REQUEST['editid'] == '') {



    $namevalue = 'startDate="' . $startDate . '",endDate="' . $endDate . '",roomType="' . $roomType . '",mealPlan="' . $mealPlan . '",currencyId="' . $currencyId . '",supplierId="' . $supplierId . '",single="' . $single . '",doublePrice="' . $double . '",triple="' . $triple . '",quad="' . $quad . '",childBed="' . $childBed . '",extraAdult="' . $extraAdult . '",photo="' . $filename . '",details="' . $details . '",status="' . $status . '",addedBy="' . $addedBy . '",hotelId="' . $hotelId . '",dateAdded="' . $dateAdded . '",singlemarkup="' . $singlemarkup . '",doublemarkup="' . $doublemarkup . '",triplemarkup="' . $triplemarkup . '",quadmarkup="' . $quadmarkup . '",childBedmarkup="' . $childBedmarkup . '",extraBedmarkup="' . $extraBedmarkup . '",infent="' . $infent . '",maxpax="' . $maxpax . '",extraNight="' . $extraNight . '",noOfDays="' . $noOfDays . '",transferId="' . $transferId . '"';

    addlisting('hotelRateList', $namevalue);
  } else {



    $namevalue = 'startDate="' . $startDate . '",endDate="' . $endDate . '",roomType="' . $roomType . '",mealPlan="' . $mealPlan . '",currencyId="' . $currencyId . '",supplierId="' . $supplierId . '",single="' . $single . '",doublePrice="' . $double . '",triple="' . $triple . '",quad="' . $quad . '",childBed="' . $childBed . '",extraAdult="' . $extraAdult . '",photo="' . $filename . '",details="' . $details . '",status="' . $status . '",addedBy="' . $addedBy . '",hotelId="' . $hotelId . '",dateAdded="' . $dateAdded . '",hotelMarkup="' . $hotelMarkup . '",singlemarkup="' . $singlemarkup . '",doublemarkup="' . $doublemarkup . '",triplemarkup="' . $triplemarkup . '",quadmarkup="' . $quadmarkup . '",childBedmarkup="' . $childBedmarkup . '",extraBedmarkup="' . $extraBedmarkup . '",infent="' . $infent . '",maxpax="' . $maxpax . '",extraNight="' . $extraNight . '",noOfDays="' . $noOfDays . '",transferId="' . $transferId . '"';

    $where = 'id="' . decode($_POST['editid']) . '"';

    updatelisting('hotelRateList', $namevalue, $where);
  }







?>

  <script>
    parent.$('#popcontent').load('loadpopup.php?action=addHotelRate&id=<?php echo $_POST['hotelId']; ?>');
  </script>

<?php

}






if (trim($_POST['action']) == 'addactivity' && $_POST['name'] != '' && $_POST['destination'] != '') {

  $name = addslashes($_POST['name']);
  $destination = addslashes($_POST['destination']);
  $status = addslashes(strip_tags($_POST['status']));
  $address = addslashes(strip_tags($_POST['address']));
  $details = addslashes(($_POST['details']));

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');


  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();
    $companyLogoFileName = basename($_FILES['image']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
    move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",countryId="' . $countryId . '",destination="' . $destination . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '",details="' . $details . '"';
    addlisting('sightseeingMaster', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",countryId="' . $countryId . '",destination="' . $destination . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '",details="' . $details . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('sightseeingMaster', $namevalue, $where);
  }
?>
  <script>
    parent.redirectpage('display.html?ga=activity&save=1');
  </script>
<?php
}







if (trim($_POST['action']) == 'addActivityRate' && trim($_POST['startDate']) != '' && trim($_POST['endDate']) != '' && trim($_POST['parentId']) != '') {



  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['endDate']));

  $sightseeingType = 1;
  $adult = addslashes($_POST['adult']);
  $child = addslashes($_POST['child']);
  $child2 = addslashes($_POST['child2']);
  $vehicleCost = addslashes($_POST['vehicleCost']);
  $status = addslashes(strip_tags($_POST['status']));
  $parentId = addslashes(decode($_POST['parentId']));
  $addedBy = $_SESSION['userid'];
  $dateAdded = date('Y-m-d H:i:s');

  if ($_REQUEST['editid'] == '') {
    $namevalue = 'startDate="' . $startDate . '",endDate="' . $endDate . '",sightseeingType="' . $sightseeingType . '",adult="' . $adult . '",child="' . $child . '",child2="' . $child2 . '",vehicleCost="' . $vehicleCost . '",parentId="' . $parentId . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';
    addlisting('sightseeingRateList', $namevalue);
  } else {
    $namevalue = 'startDate="' . $startDate . '",endDate="' . $endDate . '",sightseeingType="' . $sightseeingType . '",adult="' . $adult . '",child="' . $child . '",child2="' . $child2 . '",vehicleCost="' . $vehicleCost . '",parentId="' . $parentId . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';
    $where = 'id="' . decode($_POST['editid']) . '"';
    updatelisting('sightseeingRateList', $namevalue, $where);
  }

?>
  <script>
    parent.$('#popcontent').load('loadpopup.php?action=addActivityRate&id=<?php echo $_POST['parentId']; ?>');
  </script>
<?php
}






if (trim($_POST['action']) == 'addtransfer' && $_POST['name'] != '' && $_POST['destination'] != '') {

  $name = addslashes($_POST['name']);
  $destination = addslashes($_POST['destination']);
  $status = addslashes(strip_tags($_POST['status']));
  $address = addslashes(strip_tags($_POST['address']));
  $details = addslashes(($_POST['details']));

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');


  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();
    $companyLogoFileName = basename($_FILES['image']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
    move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",countryId="' . $countryId . '",destination="' . $destination . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '",details="' . $details . '"';
    addlisting('transferMaster', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",countryId="' . $countryId . '",destination="' . $destination . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '",details="' . $details . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('transferMaster', $namevalue, $where);
  }
?>
  <script>
    parent.redirectpage('display.html?ga=transfer&save=1');
  </script>
<?php
}






if (trim($_POST['action']) == 'addtransferRate' && trim($_POST['startDate']) != '' && trim($_POST['endDate']) != '' && trim($_POST['transferType']) != '' && trim($_POST['parentId']) != '') {



  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['endDate']));

  $transferType = addslashes($_POST['transferType']);
  $adult = addslashes($_POST['adult']);
  $child = addslashes($_POST['child']);
  $child2 = addslashes($_POST['child2']);
  $vehicleCost = addslashes($_POST['vehicleCost']);
  $status = addslashes(strip_tags($_POST['status']));
  $parentId = addslashes(decode($_POST['parentId']));
  $addedBy = $_SESSION['userid'];
  $dateAdded = date('Y-m-d H:i:s');

  if ($_REQUEST['editid'] == '') {
    $namevalue = 'startDate="' . $startDate . '",endDate="' . $endDate . '",transferType="' . $transferType . '",adult="' . $adult . '",child="' . $child . '",child2="' . $child2 . '",vehicleCost="' . $vehicleCost . '",parentId="' . $parentId . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';
    addlisting('transferRateList', $namevalue);
  } else {
    $namevalue = 'startDate="' . $startDate . '",endDate="' . $endDate . '",transferType="' . $transferType . '",adult="' . $adult . '",child="' . $child . '",child2="' . $child2 . '",vehicleCost="' . $vehicleCost . '",parentId="' . $parentId . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';
    $where = 'id="' . decode($_POST['editid']) . '"';
    updatelisting('transferRateList', $namevalue, $where);
  }

?>
  <script>
    parent.$('#popcontent').load('loadpopup.php?action=addtransferRate&id=<?php echo $_POST['parentId']; ?>');
  </script>
<?php
}





if ($_POST['action'] == 'importhotelExcel' && $_FILES['importfield']['name'] != '') {

  require_once('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require_once('spreadsheet-reader-master/SpreadsheetReader.php');
  $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

  if (in_array($_FILES["importfield"]["type"], $allowedFileType)) {
    $targetPath = 'importfiles/' . $_FILES['importfield']['name'];
    move_uploaded_file($_FILES['importfield']['tmp_name'], $targetPath);
    $Reader = new SpreadsheetReader($targetPath);
    $sheetCount = count($Reader->sheets());
    for ($i = 0; $i < $sheetCount; $i++) {
      $Reader->ChangeSheet($i);

      foreach ($Reader as $Row) {

        $hotelName = trim($Row[0]);
        $category = trim($Row[1]);
        $destination = trim($Row[2]);
        $fromDate = trim($Row[3]);
        $toDate = trim($Row[4]);
        $roomType = trim($Row[5]);
        $mealPlan = trim($Row[6]);
        $single = trim($Row[7]);
        $double = trim($Row[8]);
        $triple = trim($Row[9]);
        $quad = trim($Row[10]);
        $childBed = trim($Row[11]);
        $extraBed = trim($Row[12]);
        $contactPerson = trim($Row[13]);
        $contactPersonEmail = trim($Row[14]);
        $contactPersonPhone = trim($Row[15]);
        $imgLink = trim($Row[16]);

        $addedBy = $_SESSION['userid'];
        $dateAdded = date('Y-m-d H:i:s');


        //fecth destination 

        $bb = GetPageRecord('*', 'cityMaster', 'name="' . $destination . '"');
        $destinationidcheck = mysqli_fetch_array($bb);

        if ($destinationidcheck['id'] == '') {
          $namevalue4 = 'name="' . $destination . '"';
          $destinationnewid = addlistinggetlastid('cityMaster', $namevalue4);
          $destinationIdFinal = $destinationnewid;
        } else {
          $destinationIdFinal = $destinationidcheck['id'];
        }
        $status = 1;

        //add hotel 
        if ($hotelName != '' && $hotelName != 'Hotel name' && $category != '' && $destination != '') {
          $whereChecka = 'name="' . $hotelName . '" and destination="' . $destinationIdFinal . '"';
          $checkCode = checkduplicate('hotelMaster', $whereChecka);

          if ($checkCode == 'yes') {


            $htes = GetPageRecord('*', 'hotelMaster', 'name="' . $hotelName . '" and destination="' . $destinationIdFinal . '"');
            $hoteledit = mysqli_fetch_array($htes);



            $roomlist = GetPageRecord('*', 'RoomTypeMaster', ' 1 and status=1 and name="' . $roomType . '" order by id desc');
            $roomdata = mysqli_fetch_array($roomlist);

            if ($roomdata['id'] == '') {
              $namevalue4 = 'name="' . $roomType . '"';
              $destinationnewid = addlistinggetlastid('RoomTypeMaster', $namevalue4);
              $roomType = $destinationnewid;
            } else {
              $roomType = $roomdata['id'];
            }



            //meal plan

            $meallist = GetPageRecord('*', 'mealPlanMaster', ' 1 and status=1 and name="' . $mealPlan . '" order by id desc');
            $mealdata = mysqli_fetch_array($meallist);

            if ($mealdata['id'] == '') {
              $mealPlan = addlistinggetlastid('mealPlanMaster', 'name="' . $mealPlan . '"');
            } else {
              $mealPlan = $mealdata['id'];
            }



            //currency id 
            $currenlist = GetPageRecord('*', 'currencyMaster', ' 1 and status=1 and name="' . $currency . '" order by id desc');
            $currendata = mysqli_fetch_array($currenlist);
            $currency = $currendata['id'];

            if ($_SESSION['userid'] != '1') {
              $parentId = $_SESSION['userid'];
            } else {
              if ($LoginUserDetails['userType'] == '2') {
                $parentId = $LoginUserDetails['parentId'];
              } else {
                $parentId = $LoginUserDetails['id'];
              }
            }

            //fecth supplier 


            //insert room rate

            $whereCheckb = 'hotelId="' . $hoteledit['id'] . '" and startDate="' . date('Y-m-d', strtotime($fromDate)) . '" and endDate="' . date('Y-m-d', strtotime($toDate)) . '"   and roomType="' . $roomType . '" and mealPlan="' . $mealPlan . '"';
            $checkCodeaa = checkduplicate('hotelRateList', $whereCheckb);

            $namevalueaa = 'startDate="' . date('Y-m-d', strtotime($fromDate)) . '",endDate="' . date('Y-m-d', strtotime($toDate)) . '",roomType="' . $roomType . '",mealPlan="' . $mealPlan . '",single="' . $single . '",doublePrice="' . $double . '",triple="' . $triple . '",quad="' . $quad . '",childBed="' . $childBed . '",extraAdult="' . $extraBed . '",status="0",addedBy="' . $addedBy . '",hotelId="' . $hoteledit['id'] . '",dateAdded="' . $dateAdded . '"';

            if ($checkCodeaa == 'yes') {
              $whereaa = 'hotelId="' . $hoteledit['id'] . '" and startDate="' . date('Y-m-d', strtotime($fromDate)) . '" and endDate="' . date('Y-m-d', strtotime($toDate)) . '"   and roomType="' . $roomType . '" and mealPlan="' . $mealPlan . '"';
              updatelisting('hotelRateList', $namevalueaa, $whereaa);
            } else {
              addlisting('hotelRateList', $namevalueaa);
            }
          } else {

            //////////////////-----------------ADD HOTEL---------------------------------------



            $namevalue = 'name="' . $hotelName . '",category="' . $category . '",destination="' . $destinationIdFinal . '",status="1",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",contactPerson="' . addslashes($contactPerson) . '",contactPersonEmail="' . addslashes($contactPersonEmail) . '",contactPersonPhone="' . addslashes($contactPersonPhone) . '",imgLink="' . addslashes($imgLink) . '"';
            $hotelId = addlistinggetlastid('hotelMaster', $namevalue);
            //add room price 
            //room type

            $roomlist = GetPageRecord('*', 'RoomTypeMaster', ' 1 and status=1 and name="' . $roomType . '" order by id desc');
            $roomdata = mysqli_fetch_array($roomlist);


            if ($roomdata['id'] == '') {
              $namevalue4 = 'name="' . $roomType . '"';
              $destinationnewid = addlistinggetlastid('RoomTypeMaster', $namevalue4);
              $roomType = $destinationnewid;
            } else {
              $roomType = $roomdata['id'];
            }



            //meal plan

            $meallist = GetPageRecord('*', 'mealPlanMaster', ' 1 and status=1 and name="' . $mealPlan . '" order by id desc');
            $mealdata = mysqli_fetch_array($meallist);

            if ($mealdata['id'] == '') {
              $mealPlan = addlistinggetlastid('mealPlanMaster', 'name="' . $mealPlan . '"');
            } else {
              $mealPlan = $mealdata['id'];
            }



            //currency id 
            $currenlist = GetPageRecord('*', 'currencyMaster', ' 1 and status=1 and name="' . $currency . '" order by id desc');
            $currendata = mysqli_fetch_array($currenlist);
            $currency = $currendata['id'];

            if ($_SESSION['userid'] != '1') {
              $parentId = $_SESSION['userid'];
            } else {
              if ($LoginUserDetails['userType'] == '2') {
                $parentId = $LoginUserDetails['parentId'];
              } else {
                $parentId = $LoginUserDetails['id'];
              }
            }

            //fecth supplier 


            //insert room rate

            $whereCheckb = 'hotelId="' . $hotelId . '" and startDate="' . date('Y-m-d', strtotime($fromDate)) . '" and endDate="' . date('Y-m-d', strtotime($toDate)) . '"   and roomType="' . $roomType . '" and mealPlan="' . $mealPlan . '"';
            $checkCodeaa = checkduplicate('hotelRateList', $whereCheckb);

            $namevalueaa = 'startDate="' . date('Y-m-d', strtotime($fromDate)) . '",endDate="' . date('Y-m-d', strtotime($toDate)) . '",roomType="' . $roomType . '",mealPlan="' . $mealPlan . '",single="' . $single . '",doublePrice="' . $double . '",triple="' . $triple . '",quad="' . $quad . '",childBed="' . $childBed . '",extraAdult="' . $extraBed . '",status="0",addedBy="' . $addedBy . '",hotelId="' . $hotelId . '",dateAdded="' . $dateAdded . '"';

            if ($checkCodeaa == 'yes') {
              $whereaa = 'hotelId="' . $hotelId . '" and startDate="' . date('Y-m-d', strtotime($fromDate)) . '" and endDate="' . date('Y-m-d', strtotime($toDate)) . '"   and roomType="' . $roomType . '" and mealPlan="' . $mealPlan . '"';
              updatelisting('hotelRateList', $namevalueaa, $whereaa);
            } else {
              addlisting('hotelRateList', $namevalueaa);
            }
          }
        }
        //add hotel 
      }
    }
  } else {

    echo $type = "error";
    echo $message = "Invalid File Type. Upload Excel File.";
  }
?>
  <script>
    parent.redirectpage('display.html?ga=hotel&save=1');
  </script>
<?php }




if ($_POST['action'] == 'importactivityExcel' && $_FILES['importfield']['name'] != '') {

  require_once('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require_once('spreadsheet-reader-master/SpreadsheetReader.php');
  $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

  if (in_array($_FILES["importfield"]["type"], $allowedFileType)) {
    $targetPath = 'importfiles/' . $_FILES['importfield']['name'];
    move_uploaded_file($_FILES['importfield']['tmp_name'], $targetPath);
    $Reader = new SpreadsheetReader($targetPath);
    $sheetCount = count($Reader->sheets());
    for ($i = 0; $i < $sheetCount; $i++) {
      $Reader->ChangeSheet($i);

      foreach ($Reader as $Row) {

        $activityName = trim($Row[0]);
        $destination = trim($Row[1]);
        $fromDate = trim($Row[2]);
        $toDate = trim($Row[3]);
        $adultCost = trim($Row[4]);
        $childCost = trim($Row[5]);

        $addedBy = $_SESSION['userid'];
        $dateAdded = date('Y-m-d H:i:s');


        //fecth destination 

        $bb = GetPageRecord('*', 'cityMaster', 'name="' . $destination . '"');
        $destinationidcheck = mysqli_fetch_array($bb);

        if ($destinationidcheck['id'] == '') {
          $namevalue4 = 'name="' . $destination . '"';
          $destinationnewid = addlistinggetlastid('cityMaster', $namevalue4);
          $destinationIdFinal = $destinationnewid;
        } else {
          $destinationIdFinal = $destinationidcheck['id'];
        }
        $status = 1;

        //add hotel 
        if ($activityName != '' && $activityName != 'Activity Name' && $destination != '') {
          $whereChecka = 'name="' . $hotelName . '" and destination="' . $destinationIdFinal . '"';
          $checkCode = checkduplicate('sightseeingMaster', $whereChecka);

          if ($checkCode == 'yes') {
          } else {
            $namevalue = 'name="' . $activityName . '",destination="' . $destinationIdFinal . '",status="1",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';
            $hotelId = addlistinggetlastid('sightseeingMaster', $namevalue);


            if ($_SESSION['userid'] != '1') {
              $parentId = $_SESSION['userid'];
            } else {
              if ($LoginUserDetails['userType'] == '2') {
                $parentId = $LoginUserDetails['parentId'];
              } else {
                $parentId = $LoginUserDetails['id'];
              }
            }

            //fecth supplier 


            //insert room rate

            $whereCheckb = 'parentId="' . $hotelId . '" and startDate="' . date('Y-m-d', strtotime($fromDate)) . '" and endDate="' . date('Y-m-d', strtotime($toDate)) . '"';
            $checkCodeaa = checkduplicate('sightseeingRateList', $whereCheckb);

            $namevalueaa = 'startDate="' . date('Y-m-d', strtotime($fromDate)) . '",endDate="' . date('Y-m-d', strtotime($toDate)) . '",adult="' . $adultCost . '",child="' . $childCost . '",status="0",addedBy="' . $addedBy . '",parentId="' . $hotelId . '",dateAdded="' . $dateAdded . '"';

            if ($checkCodeaa == 'yes') {
              $whereaa = 'parentId="' . $hotelId . '" and startDate="' . date('Y-m-d', strtotime($fromDate)) . '" and endDate="' . date('Y-m-d', strtotime($toDate)) . '"';
              updatelisting('sightseeingRateList', $namevalueaa, $whereaa);
            } else {
              addlisting('sightseeingRateList', $namevalueaa);
            }
          }
        }
        //add hotel 
      }
    }
  } else {

    echo $type = "error";
    echo $message = "Invalid File Type. Upload Excel File.";
  }
?>
  <script>
    parent.redirectpage('display.html?ga=activity&save=1');
  </script>
<?php }




if ($_POST['action'] == 'importransferExcel' && $_FILES['importfield']['name'] != '') {

  require_once('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require_once('spreadsheet-reader-master/SpreadsheetReader.php');
  $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

  if (in_array($_FILES["importfield"]["type"], $allowedFileType)) {
    $targetPath = 'importfiles/' . $_FILES['importfield']['name'];
    move_uploaded_file($_FILES['importfield']['tmp_name'], $targetPath);
    $Reader = new SpreadsheetReader($targetPath);
    $sheetCount = count($Reader->sheets());
    for ($i = 0; $i < $sheetCount; $i++) {
      $Reader->ChangeSheet($i);

      foreach ($Reader as $Row) {

        $activityName = trim($Row[0]);
        $destination = trim($Row[1]);
        $fromDate = trim($Row[2]);
        $toDate = trim($Row[3]);
        $type = trim($Row[4]);
        $adultCost = trim($Row[5]);
        $childCost = trim($Row[6]);
        $vehicleCost = trim($Row[7]);
        $transferType = 1;
        if ($type == 'SIC' || $type == 'sic') {
          $transferType = 1;
        }
        if ($type == 'PVT' || $type == 'pvt' || $type == 'private') {
          $transferType = 2;
        }

        $addedBy = $_SESSION['userid'];
        $dateAdded = date('Y-m-d H:i:s');


        //fecth destination 

        $bb = GetPageRecord('*', 'cityMaster', 'name="' . $destination . '"');
        $destinationidcheck = mysqli_fetch_array($bb);

        if ($destinationidcheck['id'] == '') {
          $namevalue4 = 'name="' . $destination . '"';
          $destinationnewid = addlistinggetlastid('cityMaster', $namevalue4);
          $destinationIdFinal = $destinationnewid;
        } else {
          $destinationIdFinal = $destinationidcheck['id'];
        }
        $status = 1;



        if ($_SESSION['userid'] != '1') {
          $parentId = $_SESSION['userid'];
        } else {
          if ($LoginUserDetails['userType'] == '2') {
            $parentId = $LoginUserDetails['parentId'];
          } else {
            $parentId = $LoginUserDetails['id'];
          }
        }



        //add hotel 
        if ($activityName != '' && $activityName != 'Transfer Name' && $destination != '') {
          $whereChecka = 'name="' . $activityName . '" and destination="' . $destinationIdFinal . '"';
          $checkCode = checkduplicate('transferMaster', $whereChecka);

          if ($checkCode == 'yes') {


            $bbtt = GetPageRecord('*', 'transferMaster', 'name="' . $activityName . '" and destination="' . $destinationIdFinal . '"');
            $trnsId = mysqli_fetch_array($bbtt);
            $hotelId = $trnsId['id'];

            $whereCheckb = 'parentId="' . $hotelId . '" and startDate="' . date('Y-m-d', strtotime($fromDate)) . '" and endDate="' . date('Y-m-d', strtotime($toDate)) . '" and transferType="' . $transferType . '"';
            $checkCodeaa = checkduplicate('transferRateList', $whereCheckb);

            $namevalueaa = 'startDate="' . date('Y-m-d', strtotime($fromDate)) . '",endDate="' . date('Y-m-d', strtotime($toDate)) . '",transferType="' . $transferType . '",adult="' . $adultCost . '",child="' . $childCost . '",vehicleCost="' . $vehicleCost . '",status="0",addedBy="' . $addedBy . '",parentId="' . $hotelId . '",dateAdded="' . $dateAdded . '"';

            if ($checkCodeaa == 'yes') {
              $whereaa = 'parentId="' . $hotelId . '" and startDate="' . date('Y-m-d', strtotime($fromDate)) . '" and endDate="' . date('Y-m-d', strtotime($toDate)) . '",transferType="' . $transferType . '"';
              updatelisting('transferRateList', $namevalueaa, $whereaa);
            } else {
              addlisting('transferRateList', $namevalueaa);
            }
          } else {
            $namevalue = 'name="' . $activityName . '",destination="' . $destinationIdFinal . '",status="1",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';
            $hotelId = addlistinggetlastid('transferMaster', $namevalue);





            $whereCheckb = 'parentId="' . $hotelId . '" and startDate="' . date('Y-m-d', strtotime($fromDate)) . '" and endDate="' . date('Y-m-d', strtotime($toDate)) . '" and transferType="' . $transferType . '"';
            $checkCodeaa = checkduplicate('transferRateList', $whereCheckb);

            $namevalueaa = 'startDate="' . date('Y-m-d', strtotime($fromDate)) . '",endDate="' . date('Y-m-d', strtotime($toDate)) . '",transferType="' . $transferType . '",adult="' . $adultCost . '",child="' . $childCost . '",vehicleCost="' . $vehicleCost . '",status="0",addedBy="' . $addedBy . '",parentId="' . $hotelId . '",dateAdded="' . $dateAdded . '"';

            if ($checkCodeaa == 'yes') {
              $whereaa = 'parentId="' . $hotelId . '" and startDate="' . date('Y-m-d', strtotime($fromDate)) . '" and endDate="' . date('Y-m-d', strtotime($toDate)) . '",transferType="' . $transferType . '"';
              updatelisting('transferRateList', $namevalueaa, $whereaa);
            } else {
              addlisting('transferRateList', $namevalueaa);
            }
          }
        }
        //add hotel 
      }
    }
  } else {

    echo $type = "error";
    echo $message = "Invalid File Type. Upload Excel File.";
  }
?>
  <script>
    parent.redirectpage('display.html?ga=transfer&save=1');
  </script>
<?php }



if (trim($_POST['action']) == 'addroomtype' && $_POST['name'] != '') {

  $name = addslashes($_POST['name']);
  $status = addslashes(strip_tags($_POST['status']));

  $addedBy = $_SESSION['userid'];
  $dateAdded = date('Y-m-d H:i:s');


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';
    addlisting('RoomTypeMaster', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('RoomTypeMaster', $namevalue, $where);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=roomtype&save=1');
  </script>
<?php
}





if (trim($_POST['action']) == 'bulkassignquery' && $_POST['assignToPerson'] > 0) {

  foreach ($_POST['assignall'] as $val) {
    $namevalue = 'assignTo="' . $_POST['assignToPerson'] . '"';
    $where = 'id="' . decode($val) . '"';
    updatelisting('queryMaster', $namevalue, $where);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=query&statusid=1');
  </script>
<?php
}





if (trim($_POST['action']) == 'addleadsource') {


  if ($_POST['editId'] > 0) {
    $namevalue2 = 'name="' . trim($_REQUEST['name']) . '",status="' . ($_REQUEST['status']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('querySourceMaster', $namevalue2, $where);
  } else {

    $namevalue2 = 'name="' . trim($_REQUEST['name']) . '",status="' . ($_REQUEST['status']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '"';
    addlistinggetlastid('querySourceMaster', $namevalue2);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=leadsource&save=1');
  </script>
<?php
}





if (trim($_REQUEST['action']) == 'saveinternalnote' && trim($_REQUEST['queryId']) != '') {
  updatelisting('queryMaster', 'internalnote="' . addslashes(trim($_REQUEST['internalnote'])) . '"', 'id="' . decode($_REQUEST['queryId']) . '"');
}






if (trim($_POST['action']) == 'addRoomType') {


  if ($_POST['editId'] > 0) {
    $namevalue2 = 'name="' . trim($_REQUEST['name']) . '",status="' . ($_REQUEST['status']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('RoomTypeMaster', $namevalue2, $where);
  } else {

    $namevalue2 = 'name="' . trim($_REQUEST['name']) . '",status="' . ($_REQUEST['status']) . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . date('Y-m-d H:i:s') . '"';
    addlistinggetlastid('RoomTypeMaster', $namevalue2);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=roomType&save=1');
  </script>
<?php
}



if ($_REQUEST['action'] == 'eventsorting') {
  $n = 1;
  foreach ($_POST['sr'] as $index => $value) {

    $namevalue = 'sr="' . $n . '"';
    echo $where = 'id="' . $value . '"';
    updatelisting('sys_packageBuilderEvent', $namevalue, $where);
    $n++;
  }
}







if (trim($_POST['action']) == 'addclientgroup' && trim($_POST['name']) != '') {


  $name = addslashes($_POST['name']);
  $description = addslashes($_POST['description']);
  $status = addslashes($_POST['status']);
  $editid = decode($_POST['editId']);


  if ($editid != '') {



    $namevalue = 'name="' . $name . '",description="' . $description . '",status="' . $status . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    $where = 'id="' . $editid . '"';
    updatelisting('clientGroupMaster', $namevalue, $where);
  } else {
    $namevalue = 'name="' . $name . '",description="' . $description . '",status="' . $status . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    $lstaddid = addlistinggetlastid('clientGroupMaster', $namevalue);
  }



?>
  <script>
    parent.redirectpage('display.html?ga=clients-group&save=1');
  </script>
<?php
}








if (trim($_POST['action']) == 'bulkclientaddtogroup' && $_POST['assignToPerson'] > 0) {

  foreach ($_POST['assignall'] as $val) {

    $a = GetPageRecord('*', 'clientGroupContacts', 'clientId="' . decode($val) . '"  and groupId="' . $_POST['assignToPerson'] . '" ');
    $result = mysqli_fetch_array($a);

    if ($result['id'] == '') {

      $namevalue = 'clientId="' . decode($val) . '",groupId="' . $_POST['assignToPerson'] . '"';
      addlistinggetlastid('clientGroupContacts', $namevalue);
    }
  }

?>
  <script>
    parent.redirectpage('display.html?ga=clients&&save=1');
  </script>
<?php
}



if (trim($_POST['action']) == 'bulkclientremovefromgroup' && $_POST['assignToPerson'] > 0) {

  foreach ($_POST['assignall'] as $val) {

    $namevalue = 'clientId="' . decode($val) . '",groupId="' . $_POST['assignToPerson'] . '"';
    addlistinggetlastid('clientGroupContacts', $namevalue);


    deleteRecord('clientGroupContacts', 'clientId="' . decode($val) . '" and groupId="' . $_POST['assignToPerson'] . '"');
  }

?>
  <script>
    parent.redirectpage('display.html?ga=clients-group-contacts&g=<?php echo encode($_POST['assignToPerson']); ?>&&save=1');
  </script>
<?php
}




if (trim($_POST['action']) == 'addemailtemplate' && trim($_POST['name']) != '') {


  $name = addslashes($_POST['name']);
  $details = addslashes($_POST['details']);
  $subject = addslashes($_POST['subject']);
  $editid = decode($_POST['editid']);


  if ($editid != '') {



    $namevalue = 'name="' . $name . '",details="' . $details . '",subject="' . $subject . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    $where = 'id="' . $editid . '"';
    updatelisting('templateMaster', $namevalue, $where);
  } else {
    $namevalue = 'name="' . $name . '",details="' . $details . '",subject="' . $subject . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    addlistinggetlastid('templateMaster', $namevalue);
  }



?>
  <script>
    parent.redirectpage('display.html?ga=mailing-templates&save=1');
  </script>
<?php
}




if (trim($_POST['action']) == 'bulktemplatedelete') {

  foreach ($_POST['assignall'] as $val) {


    deleteRecord('templateMaster', 'id="' . decode($val) . '"');
  }

?>
  <script>
    parent.redirectpage('display.html?ga=mailing-templates&save=1');
  </script>
<?php
}







if (trim($_POST['action']) == 'sendcampaignsmail' && trim($_POST['sendType']) != '' && trim($_POST['name']) != '' && trim($_POST['groupId']) != '' && trim($_POST['templateId']) != '') {

  include "config/mail.php";

  $name = addslashes($_POST['name']);
  $subject = addslashes($_POST['subject']);
  $groupId = addslashes($_POST['groupId']);
  $templateId = addslashes($_POST['templateId']);
  $sendType = addslashes($_POST['sendType']);
  $testEmail = addslashes($_POST['testEmail']);
  $fromEmail = addslashes($_POST['fromEmail']);
  $fromName = addslashes($_POST['fromName']);
  $birthdaywish = addslashes($_POST['birthdaywish']);

  $wheremore = '';
  if ($_REQUEST['birthdaywish'] != '') {
    $wheremore = ' and clientId in (select id from userMaster where month(dob)="' . date('m') . '" )';
  }
  if ($_REQUEST['anniversary'] != '') {
    $wheremore = ' and clientId in (select id from userMaster where month(marriageAnniversary)="' . date('m') . '" )';
  }


  $abcd = GetPageRecord('*', 'clientGroupMaster', 'id="' . decode($groupId) . '"');
  $cgroupdata = mysqli_fetch_array($abcd);

  $abcde = GetPageRecord('*', 'templateMaster', 'id="' . decode($templateId) . '"');
  $templatedata = mysqli_fetch_array($abcde);


  $mailerdetails = $templatedata['details'];
  $mailerdetails = str_replace('{Client Name}', $cuserddetails['firstName'], $mailerdetails);



  if ($sendType == 2) {

    $ccmail = '';
    $file_name = '';
    send_attachment_mail($fromEmail, $testEmail, stripslashes($subject), stripslashes($mailerdetails), $ccmail, $file_name);
  } else {

    $namevalue = 'scheduleDate="' . date('Y-m-d H:i:s') . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",status=1,deleteStatus=0,templateId="' . decode($templateId) . '",customerGroup="' . decode($groupId) . '",fromName="' . $fromName . '",title="' . $name . '",fromEmail="' . $fromEmail . '",details="' . addslashes($templatedata['details']) . '",emails="' . $emails . '",contacts="' . $emails . '",subject="' . addslashes($_POST['subject']) . '"';

    $campaignId = addlistinggetlastid('campaignMaster', $namevalue);



    $emails = 0;
    $rscon = GetPageRecord('*', 'clientGroupContacts', ' groupId="' . decode($groupId) . '" ' . $wheremore . ' ');
    while ($restContact = mysqli_fetch_array($rscon)) {


      $abcd = GetPageRecord('*', 'userMaster', 'id="' . $restContact['clientId'] . '"');
      $cuserddetails = mysqli_fetch_array($abcd);


      $mailerdetails = $templatedata['details'];
      $mailerdetails = str_replace('{Client Name}', $cuserddetails['firstName'], $mailerdetails);
      $subject = str_replace('{Client Name}', $cuserddetails['firstName'], $_REQUEST['subject']);

      $ccmail = '';
      $file_name = '';
      send_attachment_mail($fromEmail, $cuserddetails['email'], stripslashes($subject), stripslashes($mailerdetails . '<img src="' . $fullurl . 'readmail.php?c=' . $campaignId . '" width="0" height="0">'), $ccmail, $file_name);


      $emails++;
    }





    $namevalue2 = 'scheduleDate="' . date('Y-m-d H:i:s') . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '",status=1,deleteStatus=0,templateId="' . decode($templateId) . '",customerGroup="' . decode($groupId) . '",fromName="' . $fromName . '",title="' . $name . '",fromEmail="' . $fromEmail . '",details="' . addslashes($templatedata['details']) . '",emails="' . $emails . '",contacts="' . $emails . '",subject="' . addslashes($_POST['subject']) . '"';

    $where = 'id="' . $campaignId . '"';
    updatelisting('campaignMaster', $namevalue2, $where);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=maketing-dashboard&sentcamp=1');
  </script>
<?php
}










if (trim($_POST['action']) == 'addemailtemplate' && trim($_POST['name']) != '') {


  $name = addslashes($_POST['name']);
  $bannerHeading = addslashes($_POST['bannerHeading']);
  $pageURL = str_replace(' ', '-', addslashes($_POST['pageURL']));
  $bannerSubHeading = addslashes($_POST['bannerSubHeading']);
  $enquiryHeading = addslashes($_POST['enquiryHeading']);
  $enquirySubHeading = addslashes($_POST['enquirySubHeading']);
  $contactNumber = addslashes($_POST['contactNumber']);
  $emailId = addslashes($_POST['emailId']);
  $address = addslashes($_POST['address']);
  $mainHeading = addslashes($_POST['mainHeading']);
  $description = addslashes($_POST['description']);
  $leadSource = addslashes($_POST['leadSource']);
  $facebook = addslashes($_POST['facebook']);
  $instagram = addslashes($_POST['instagram']);
  $twitter = addslashes($_POST['twitter']);
  $youtube = addslashes($_POST['youtube']);
  $pinterest = addslashes($_POST['pinterest']);
  $metaTitle = addslashes($_POST['metaTitle']);
  $metaDescription = addslashes($_POST['metaDescription']);
  $metaKeyword = addslashes($_POST['metaKeyword']);
  $headerScript = addslashes($_POST['headerScript']);
  $footerScript = addslashes($_POST['footerScript']);
  $oldphoto = addslashes($_POST['bannerold']);
  $status = addslashes($_POST['status']);
  $packages = addslashes($_POST['packages']);
  $editid = decode($_POST['editid']);




  if ($_FILES["banner"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['banner']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = time() . $rt . '.' . $companyLogoFileExtension;
    move_uploaded_file($_FILES["banner"]["tmp_name"], "package_image/{$profilePhoto}");
  }
  if ($profilePhoto == '') {
    $profilePhoto = $oldphoto;
  }



  if ($editid != '') {

    $namevalue = 'name="' . $name . '",bannerHeading="' . $bannerHeading . '",bannerSubHeading="' . $bannerSubHeading . '",packages="' . $packages . '",enquiryHeading="' . $enquiryHeading . '",enquirySubHeading="' . $enquirySubHeading . '",contactNumber="' . $contactNumber . '",emailId="' . $emailId . '",address="' . $address . '",mainHeading="' . $mainHeading . '",description="' . $description . '",leadSource="' . $leadSource . '",facebook="' . $facebook . '",instagram="' . $instagram . '",twitter="' . $twitter . '",youtube="' . $youtube . '",pinterest="' . $pinterest . '",metaTitle="' . $metaTitle . '",metaDescription="' . $metaDescription . '",metaKeyword="' . $metaKeyword . '",headerScript="' . $headerScript . '",footerScript="' . $footerScript . '",pageURL="' . $pageURL . '",banner="' . $profilePhoto . '",status="' . $status . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    $where = 'id="' . $editid . '"';
    updatelisting('landingPages', $namevalue, $where);
  } else {
    $namevalue = 'name="' . $name . '",bannerHeading="' . $bannerHeading . '",bannerSubHeading="' . $bannerSubHeading . '",packages="' . $packages . '",enquiryHeading="' . $enquiryHeading . '",enquirySubHeading="' . $enquirySubHeading . '",contactNumber="' . $contactNumber . '",emailId="' . $emailId . '",address="' . $address . '",mainHeading="' . $mainHeading . '",description="' . $description . '",leadSource="' . $leadSource . '",facebook="' . $facebook . '",instagram="' . $instagram . '",twitter="' . $twitter . '",youtube="' . $youtube . '",pinterest="' . $pinterest . '",metaTitle="' . $metaTitle . '",metaDescription="' . $metaDescription . '",metaKeyword="' . $metaKeyword . '",headerScript="' . $headerScript . '",footerScript="' . $footerScript . '",pageURL="' . $pageURL . '",banner="' . $profilePhoto . '",status="' . $status . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    addlistinggetlastid('landingPages', $namevalue);
  }



?>
  <script>
    parent.redirectpage('display.html?ga=landingpages&save=1');
  </script>
<?php
}







if (trim($_POST['action']) == 'addsignature' && trim($_POST['emailsignature']) != '') {

  $namevalue = 'emailsignature="' . addslashes($_REQUEST['emailsignature']) . '"';
  $where = 'id="' . $_SESSION['userid'] . '"';
  updatelisting('sys_userMaster', $namevalue, $where);

?>
  <script>
    parent.redirectpage('display.html?ga=myprofile&save=1');
  </script>

<?php }


if (trim($_POST['action']) == 'addnotebook' && trim($_POST['id']) != '') {

  $namevalue = 'details="' . addslashes($_POST['notedescription']) . '"';
  $where = 'id="' . decode($_POST['id']) . '"';
  updatelisting('notebookMaster', $namevalue, $where);
}



if (trim($_POST['action']) == 'addcmspage' && trim($_POST['name']) != '' && trim($_POST['url']) != '' && trim($_POST['pageType']) != '') {


  $name = addslashes($_POST['name']);
  $pageType = addslashes($_POST['pageType']);
  $url = addslashes($_POST['url']);
  $description = addslashes($_POST['description']);
  $status = addslashes($_POST['status']);
  $metaTitle = addslashes($_POST['metaTitle']);
  $metaKeyword = addslashes($_POST['metaKeyword']);
  $metaDesctiption = addslashes($_POST['metaDesctiption']);
  $editid = decode($_POST['editid']);



  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();
    $companyLogoFileName = basename($_FILES['image']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
    move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($editid != '') {



    $namevalue = 'name="' . $name . '",pageType="' . $pageType . '",url="' . $url . '",description="' . $description . '",status="' . $status . '",photo="' . $profilePhoto . '",metaTitle="' . $metaTitle . '",metaKeyword="' . $metaKeyword . '",metaDesctiption="' . $metaDesctiption . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    $where = 'id="' . $editid . '"';
    updatelisting('cmsPages', $namevalue, $where);
  } else {
    $namevalue = 'name="' . $name . '",pageType="' . $pageType . '",url="' . $url . '",description="' . $description . '",status="' . $status . '",metaTitle="' . $metaTitle . '",metaKeyword="' . $metaKeyword . '",metaDesctiption="' . $metaDesctiption . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    addlistinggetlastid('cmsPages', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=cms-pages&save=1');
  </script>
<?php
}











if (trim($_POST['action']) == 'addwebsitesetting' && trim($_POST['companyName']) != '') {


  $companyName = addslashes($_POST['companyName']);
  $oldphotologo = addslashes($_POST['websiteLogo']);
  $oldphotowebsiteFavicon = addslashes($_POST['websiteFavicon']);
  $contactPhone = addslashes($_POST['contactPhone']);
  $contactEmail = addslashes($_POST['contactEmail']);
  $whatsAppNumber = addslashes($_POST['whatsAppNumber']);
  $queryEmail = addslashes($_POST['queryEmail']);
  $contactAddress = addslashes($_POST['contactAddress']);
  $headerScript = addslashes($_POST['headerScript']);
  $footerScript = addslashes($_POST['footerScript']);

  $metaTitle = addslashes($_POST['metaTitle']);
  $metaKeyword = addslashes($_POST['metaKeyword']);
  $metaDesctiption = addslashes($_POST['metaDesctiption']);
  $facebookURL = addslashes($_POST['facebookURL']);
  $twitterURL = addslashes($_POST['twitterURL']);
  $instagramURL = addslashes($_POST['instagramURL']);
  $youtubeURL = addslashes($_POST['youtubeURL']);



  if ($_FILES["logoattachment"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['logoattachment']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $websiteLogo = time() . $rt . '.' . $companyLogoFileExtension;

    move_uploaded_file($_FILES["logoattachment"]["tmp_name"], "profilepic/{$websiteLogo}");
  }
  if ($websiteLogo == '') {
    $websiteLogo = $oldphotologo;
  }



  if ($_FILES["faviiconattachment"]["tmp_name"] != "") {
    $rt = mt_rand() . strtotime(date("YMDHis"));
    $companyLogoFileName = basename($_FILES['faviiconattachment']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $websiteFavicon = time() . $rt . '.' . $companyLogoFileExtension;

    move_uploaded_file($_FILES["faviiconattachment"]["tmp_name"], "profilepic/{$websiteFavicon}");
  }
  if ($websiteFavicon == '') {
    $websiteFavicon = $oldphotowebsiteFavicon;
  }





  $namevalue = 'companyName="' . $companyName . '",websiteLogo="' . $websiteLogo . '",websiteFavicon="' . $websiteFavicon . '",contactPhone="' . $contactPhone . '",contactEmail="' . $contactEmail . '",metaTitle="' . $metaTitle . '",metaKeyword="' . $metaKeyword . '",metaDesctiption="' . $metaDesctiption . '",whatsAppNumber="' . $whatsAppNumber . '",queryEmail="' . $queryEmail . '",contactAddress="' . $contactAddress . '",headerScript="' . $headerScript . '",footerScript="' . $footerScript . '",facebookURL="' . $facebookURL . '",twitterURL="' . $twitterURL . '",instagramURL="' . $instagramURL . '",youtubeURL="' . $youtubeURL . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
  $where = 'id=1';
  updatelisting('websiteSetting', $namevalue, $where);

?>
  <script>
    parent.redirectpage('display.html?ga=website-setting&save=1');
  </script>
<?php
}










if (trim($_POST['action']) == 'addwebsitebanner' && $_POST['name'] != '') {

  $name = addslashes($_POST['name']);
  $status = addslashes(strip_tags($_POST['status']));

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');


  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();
    $companyLogoFileName = basename($_FILES['image']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
    move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '"';
    addlisting('homeBanner', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('homeBanner', $namevalue, $where);
  }
?>
  <script>
    parent.redirectpage('display.html?ga=home-banner&save=1');
  </script>
<?php
}







if (trim($_POST['action']) == 'addwebsitetestimonial' && $_POST['name'] != '') {

  $name = addslashes($_POST['name']);
  $destinationName = addslashes($_POST['destinationName']);
  $description = addslashes($_POST['description']);
  $status = addslashes(strip_tags($_POST['status']));

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');


  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();
    $companyLogoFileName = basename($_FILES['image']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
    move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",status="' . $status . '",destinationName="' . $destinationName . '",description="' . $description . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '"';
    addlisting('websiteTestimonials', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",status="' . $status . '",destinationName="' . $destinationName . '",description="' . $description . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('websiteTestimonials', $namevalue, $where);
  }
?>
  <script>
    parent.redirectpage('display.html?ga=testimonials&save=1');
  </script>
<?php
}







if (trim($_POST['action']) == 'addwebsitedestination' && $_POST['name'] != '') {

  $name = addslashes($_POST['name']);
  $status = addslashes(strip_tags($_POST['status']));

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');


  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();
    $companyLogoFileName = basename($_FILES['image']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
    move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '"';
    addlisting('websiteDestination', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('websiteDestination', $namevalue, $where);
  }
?>
  <script>
    parent.redirectpage('display.html?ga=website-destinations&save=1');
  </script>
<?php
}






if (trim($_POST['action']) == 'addwebsiteaboutdestination' && $_POST['name'] != '') {

  $name = addslashes($_POST['name']);
  $description = addslashes($_POST['description']);
  $destinationId = addslashes($_POST['destinationId']);
  $status = addslashes(strip_tags($_POST['status']));

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');


  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();
    $companyLogoFileName = basename($_FILES['image']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
    move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '",description="' . $description . '",destinationId="' . $destinationId . '"';
    addlisting('websiteAboutDestination', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '",description="' . $description . '",destinationId="' . $destinationId . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('websiteAboutDestination', $namevalue, $where);
  }
?>
  <script>
    parent.redirectpage('display.html?ga=about-website-destinations&save=1');
  </script>
<?php
}




if (trim($_POST['action']) == 'addwebsitephoto' && $_POST['name'] != '') {

  $name = addslashes($_POST['name']);
  $status = addslashes(strip_tags($_POST['status']));

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');


  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();
    $companyLogoFileName = basename($_FILES['image']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
    move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '"';
    addlisting('websitePhotoGallery', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('websitePhotoGallery', $namevalue, $where);
  }
?>
  <script>
    parent.redirectpage('display.html?ga=website-photo-gallery&save=1');
  </script>
<?php
}








if (trim($_POST['action']) == 'addwebsiteblogpost' && trim($_POST['name']) != '') {


  $name = addslashes($_POST['name']);
  $description = addslashes($_POST['description']);
  $status = addslashes($_POST['status']);
  $metaTitle = addslashes($_POST['metaTitle']);
  $metaKeyword = addslashes($_POST['metaKeyword']);
  $metaDesctiption = addslashes($_POST['metaDesctiption']);
  $editid = decode($_POST['editid']);



  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();
    $companyLogoFileName = basename($_FILES['image']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
    move_uploaded_file($_FILES["image"]["tmp_name"], "blogphotos/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($editid != '') {

    $namevalue = 'name="' . $name . '",description="' . $description . '",status="' . $status . '",photo="' . $profilePhoto . '",metaTitle="' . $metaTitle . '",metaKeyword="' . $metaKeyword . '",metaDesctiption="' . $metaDesctiption . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    $where = 'id="' . $editid . '"';
    updatelisting('websiteBlog', $namevalue, $where);
  } else {
    $namevalue = 'name="' . $name . '",description="' . $description . '",status="' . $status . '",photo="' . $profilePhoto . '",metaTitle="' . $metaTitle . '",metaKeyword="' . $metaKeyword . '",metaDesctiption="' . $metaDesctiption . '",dateAdded="' . date('Y-m-d H:i:s') . '",addedBy="' . $_SESSION['userid'] . '"';
    addlistinggetlastid('websiteBlog', $namevalue);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=website-blog&save=1');
  </script>
<?php
}







if (trim($_POST['action']) == 'addwebsitetheme' && $_POST['name'] != '') {

  $name = addslashes($_POST['name']);
  $status = addslashes(strip_tags($_POST['status']));

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');


  if ($_FILES["image"]["tmp_name"] != "") {

    $rt = time();
    $companyLogoFileName = basename($_FILES['image']['name']);
    $companyLogoFileExtension = pathinfo($companyLogoFileName, PATHINFO_EXTENSION);
    $profilePhoto = str_replace(' ', '_', substr($companyLogoFileName, 0, strpos($companyLogoFileName, ".")) . $rt . '.' . $companyLogoFileExtension);
    move_uploaded_file($_FILES["image"]["tmp_name"], "package_image/{$profilePhoto}");
  } else {
    $profilePhoto = $_REQUEST['oldlogo'];
  }


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '"';
    addlisting('websitePackageTheme', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",photo="' . $profilePhoto . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('websitePackageTheme', $namevalue, $where);
  }
?>
  <script>
    parent.redirectpage('display.html?ga=package-theme&save=1');
  </script>
<?php
}









if (trim($_POST['action']) == 'addcompanyexpense' && $_POST['amount'] != '' && $_POST['paymentType'] != '') {




  if ($_POST['editid'] > 0) {

    $namevalue2 = 'amount="' . trim($_REQUEST['amount']) . '",paymentDate="' . date('Y-m-d H:i:s', strtotime($_REQUEST['startDate'] . ' ' . date('H:i:s'))) . '",paymentBy="' . $_SESSION['userid'] . '",paymentStatus="' . $_POST['status'] . '",paymentType="' . $_POST['paymentType'] . '",remark="' . addslashes($_POST['remark']) . '"';
    $where = 'id="' . decode($_POST['editid']) . '"';
    updatelisting('expenseMaster', $namevalue2, $where);
  } else {

    $namevalue2 = 'amount="' . trim($_REQUEST['amount']) . '",paymentDate="' . date('Y-m-d H:i:s', strtotime($_REQUEST['startDate'])) . '",paymentBy="' . $_SESSION['userid'] . '",paymentStatus="' . $_POST['status'] . '",paymentType="' . $_POST['paymentType'] . '",remark="' . addslashes($_POST['remark']) . '"';
    addlistinggetlastid('expenseMaster', $namevalue2);
  }


?>
  <script>
    parent.redirectpage('display.html?ga=company-expense&save=1');
  </script>
<?php
}







if (trim($_POST['action']) == 'loadpackagecommnet' && $_POST['pid'] != '' && $_POST['comment'] != '') {


  addlistinggetlastid('packageComment', 'packageId="' . trim($_REQUEST['pid']) . '",addDate="' . date('Y-m-d H:i:s') . '",comment="' . addslashes($_REQUEST['comment']) . '"');


  $abcd = GetPageRecord('*', 'sys_packageBuilder', 'id="' . $_REQUEST['pid'] . '"');
  $result = mysqli_fetch_array($abcd);


  addlisting('queryTask', 'queryId="' . $_REQUEST['pid'] . '",details="New Comment on ' . addslashes($result['name']) . '",status="1",dateAdded="' . date('Y-m-d H:i:s') . '",taskType="Notification",notificationType="1"');
?>
  <script>
    parent.funloadpackagecommnet();
  </script>
<?php
}











if (trim($_POST['action']) == 'addautomation' && $_POST['queryStatus'] != 0 && $_POST['packageId'] != 0 && $_POST['destinationId'] != "") {

  $queryStatus = addslashes($_POST['queryStatus']);
  $packageId = addslashes($_POST['packageId']);
  $destinationId = addslashes($_POST['destinationId']);
  $details = addslashes($_POST['details']);
  $startDate = date('Y-m-d', strtotime($_POST['startDate']));
  $endDate = date('Y-m-d', strtotime($_POST['endDate']));

  $status = addslashes(strip_tags($_POST['status']));
  $addedBy = $_SESSION['userid'];
  $dateAdded = date('Y-m-d H:i:s');


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'queryStatus="' . $queryStatus . '",packageId="' . $packageId . '",destinationId="' . $destinationId . '",details="' . $details . '",startDate="' . $startDate . '",endDate="' . $endDate . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';
    addlisting('automationMaster', $namevalue);
  } else {
    $namevalue = 'queryStatus="' . $queryStatus . '",packageId="' . $packageId . '",destinationId="' . $destinationId . '",details="' . $details . '",startDate="' . $startDate . '",endDate="' . $endDate . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('automationMaster', $namevalue, $where);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=automation&save=1');
  </script>
<?php
}









if (trim($_POST['action']) == 'adddayitinerary' && $_POST['name'] != '' && $_POST['destination'] != '') {

  $name = addslashes($_POST['name']);
  $destination = addslashes($_POST['destination']);
  $status = addslashes(strip_tags($_POST['status']));
  $address = addslashes(strip_tags($_POST['address']));
  $details = addslashes(($_POST['details']));

  $addedBy = $_SESSION['userid'];

  $dateAdded = date('Y-m-d H:i:s');



  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",destination="' . $destination . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",details="' . $details . '"';
    addlisting('dayItineraryMaster', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",destination="' . $destination . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",details="' . $details . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('dayItineraryMaster', $namevalue, $where);
  }
?>
  <script>
    parent.redirectpage('display.html?ga=dayitinerarysmaster&save=1');
  </script>
<?php
}



if (trim($_POST['action']) == 'addbranch' && $_POST['name'] != '' && $_POST['destinations'] != '') {

  $name = addslashes($_POST['name']);
  $destinations = addslashes($_POST['destinations']);
  $status = addslashes(strip_tags($_POST['status']));

  $addedBy = $_SESSION['userid'];
  $dateAdded = date('Y-m-d H:i:s');


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",destinations="' . $destinations . '"';
    addlisting('branchMaster', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",destinations="' . $destinations . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('branchMaster', $namevalue, $where);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=branches&save=1');
  </script>
<?php
}




if (trim($_POST['action']) == 'addrole' && $_POST['name'] != '' && $_POST['branchId'] != '' && $_POST['parentId'] != '') {

  $name = addslashes($_POST['name']);
  $parentId = addslashes($_POST['parentId']);
  $branchId = addslashes($_POST['branchId']);
  $destinations = addslashes($_POST['destinations']);
  $status = addslashes(strip_tags($_POST['status']));

  $addedBy = $_SESSION['userid'];
  $dateAdded = date('Y-m-d H:i:s');


  if ($_REQUEST['editId'] == '') {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",parentId="' . $parentId . '",branchId="' . $branchId . '"';
    addlisting('roleMaster', $namevalue);
  } else {
    $namevalue = 'name="' . $name . '",status="' . $status . '",addedBy="' . $addedBy . '",dateAdded="' . $dateAdded . '",parentId="' . $parentId . '",branchId="' . $branchId . '"';
    $where = 'id="' . decode($_POST['editId']) . '"';
    updatelisting('roleMaster', $namevalue, $where);
  }

?>
  <script>
    parent.redirectpage('display.html?ga=roles&save=1');
  </script>
<?php
}






if (trim($_REQUEST['action']) == 'updateSalesTarget' && $_REQUEST['targetYear'] != '' && $_REQUEST['salesPersonId'] != '') {

  for ($i = 1; $i <= 12; $i++) {

    $ba = GetPageRecord('*', 'salesTargetMaster', ' salesPersonId="' . decode($_REQUEST['salesPersonId']) . '" and targetMonth="' . addslashes(trim($i)) . '" and targetYear="' . addslashes(trim($_REQUEST['targetYear'])) . '"');
    if (mysqli_num_rows($ba) > 0) {
      $targetData = mysqli_fetch_array($ba);

      $namevalue = 'targetAmount="' . addslashes(trim($_REQUEST['targetAmount' . $i])) . '"';
      $where = 'id="' . $targetData['id'] . '"';
      updatelisting('salesTargetMaster', $namevalue, $where);
    } else {

      $namevalue2 = 'targetMonth="' . addslashes(trim($i)) . '",targetYear="' . addslashes(trim($_REQUEST['targetYear'])) . '",targetAmount="' . addslashes(trim($_REQUEST['targetAmount' . $i])) . '",salesPersonId="' . decode($_REQUEST['salesPersonId']) . '"';
      $lstaddid = addlistinggetlastid('salesTargetMaster', $namevalue2);
    }
  }



?>
  <script>
    parent.redirectpage('display.html?targetYear=<?php echo $_REQUEST['targetYear']; ?>&id=<?php echo $_REQUEST['salesPersonId']; ?>&Save=View+Year&ga=team&add=1');
  </script>
  <?php
}







if ($_REQUEST['action'] == 'createflyer' && $_REQUEST['typevar'] != '') {
  $typevar = $_REQUEST['typevar'];
  $pageWidth = '0px';
  $pageHeight = '0px';

  if ($typevar == 'Instagram Story') {
    $pageWidth = '1080px';
    $pageHeight = '1920px';
  }


  if ($typevar == 'Instagram Post') {
    $pageWidth = '1080px';
    $pageHeight = '1080px';
  }

  if ($typevar == 'Facebook Post') {
    $pageWidth = '1200px';
    $pageHeight = '630px';
  }
  if ($typevar == 'Emailer') {
    $pageWidth = '800px';
    $pageHeight = '1000px';
  }

  if ($pageWidth != '0px') {

    $namevalue = 'userId="' . $_SESSION['userid'] . '",projectType="' . trim($typevar) . '",name="New Project",pageWidth="' . $pageWidth . '",pageHeight="' . $pageHeight . '",editDate="' . date('Y-m-d H:i:s') . '",addDate="' . date('Y-m-d H:i:s') . '"';
    $lastid = addlistinggetlastid('flyer_project', $namevalue);

  ?>
    <script>
      window.location.href = "flyer-designer/edit-project.html?id=<?php echo encode($lastid); ?>";
    </script>
<?php

  }
}

?>

<?php if (trim($_REQUEST['action']) == 'editpaymentpricing' && trim($_REQUEST['pid']) != '') {

    $query_id = $_POST['queryid'];
    $price = $_POST['payment_pricing'];
    $id = $_REQUEST['pid'];
    $description = $_POST['description'];
    $dateAdded = date('Y-m-d H:i:s');

    $namevalue = 'amount="' . $price . '", description="' . $description . '", updated_at="'.$dateAdded.'"';
    $where = 'id="' . $id . '" ';
    updatelisting('queryPaymentLinks', $namevalue, $where);

    $payment_link_data = GetPageRecord('reference_id', 'queryPaymentLinks', 'id="' . $id. '"');
    $payment_link_result = mysqli_fetch_array($payment_link_data);
    $reference_id = $payment_link_result['reference_id'];

    $name_value_1 = 'amount="'.$price.'"';
    $where_1 = 'paymentId="'.$reference_id.'"';
    updatelisting('sys_PackagePayment', $name_value_1, $where_1);

    ?>
    <script>
        parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $query_id; ?>&c=11&save=1');
    </script>
    <?php
}
?>

<?php if (trim($_REQUEST['action']) == 'addpaymentpricing' && trim($_REQUEST['queryid']) != '') {

    $reference_id = 'ref_' . time() . substr(md5(mt_rand()), 0, 5);
    $query_id = decode($_REQUEST['queryid']);
    $price = $_POST['payment_pricing'];
    $description = $_POST['description'];
    $status = 'created';
    $created_by = $LoginUserDetails['id'];
    $dateAdded = date('Y-m-d H:i:s');

    $namevalue = 'query_id="' . $query_id . '", reference_id="'.$reference_id.'", amount="' . $price . '", description="' . $description . '", status="'.$status.'", created_by="' . $created_by . '", created_at="'.$dateAdded.'", updated_at="'.$dateAdded.'"';

    addlisting('queryPaymentLinks', $namevalue);

    $name_value_1 = 'paymentId="'.$reference_id.'", queryId="'.$query_id.'", amount="'.$price.'", paymentStatus="2", transectionType="razorpay", remark="razorpay" ';

    addlisting('sys_PackagePayment', $name_value_1);

    ?>
    <script>
        parent.redirectpage('display.html?ga=query&view=1&id=<?php echo $_REQUEST['queryid']; ?>&c=11&save=1');
    </script>
    <?php
}
?>

<?php if (trim($_REQUEST['action']) == 'sendpaymentlinksms' && trim($_REQUEST['paymentLinkId']) != '') {

    $payment_link_id = $_POST['paymentLinkId'];

    $payment_link_data = GetPageRecord('query_id,amount,description,payment_link_id,status,reference_id', 'queryPaymentLinks', 'id="' . $payment_link_id . '"');
    $payment_link_result = mysqli_fetch_array($payment_link_data);

    $query_id = $payment_link_result['query_id'];
    $price = $payment_link_result['amount'] * 100;
    $description = $payment_link_result['description'];
    $payment_link_id_from_db = $payment_link_result['payment_link_id'];
    $status = $payment_link_result['status'];
    $reference_id = $payment_link_result['reference_id'];

    $query_data = GetPageRecord('name,email,phone', ' queryMaster ', 'id="' . $query_id . '"');
    $query_data_result = mysqli_fetch_array($query_data);

    $name = $query_data_result['name'];
    $email = $query_data_result['email'];
    $phone = '+91' . $query_data_result['phone'];

    require('config/config.php');
    require('payment/razorpay-php/Razorpay.php');

    $api = new Api($keyId, $keySecret);

    if ($payment_link_id_from_db == '') {
        $payment_link = $api->paymentLink->create(
            array('amount' => $price,
                'currency' => 'INR',
                'description' => $description,
                'customer' => array(
                    'name' => $name,
                    'email' => $email,
                    'contact' => $phone),
                'notify' => array('sms' => true),
                'reminder_enable' => false,
            )
        );

        if ($payment_link->status == 'created') {
            $payment_link_api_id = $payment_link->id;
            $payment_link_url = $payment_link->short_url;
            $payment_link_status = 'sent';
            $name_value = 'payment_link_id="' . $payment_link_api_id . '", payment_link_url="' . $payment_link_url . '", status="' . $payment_link_status . '"';
            $where = 'id="' . $payment_link_id . '" ';
            updatelisting('queryPaymentLinks', $name_value, $where);
            $name_value_1 = 'paymentStatus="3"';
            $where_1 = 'paymentId="' . $reference_id . '" ';
            updatelisting('sys_PackagePayment', $name_value_1, $where_1);
            header('Content-Type: application/json; charset=utf-8');
            $data = array('success' => true, 'msg' => 'Payment Link Sent Successfully.');
            echo json_encode($data);
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'msg' => 'Something Went Wrong ! Please Try Again']);
        }
        exit;
    } else {
        if($status == 'paid'){
            header('Content-Type: application/json; charset=utf-8');
            $data = array('success' => false, 'msg' => 'Payment Is Already Paid By Client.', 'info' => true);
        }else{
            $medium = "sms";
            $payment_link_resend = $api->paymentLink->fetch($payment_link_id_from_db)->notifyBy($medium);
            header('Content-Type: application/json; charset=utf-8');
            $data = array('success' => true, 'msg' => 'Payment Link Sent Successfully.');
        }
        echo json_encode($data);
        exit;
    }

}
?>

<?php if (trim($_REQUEST['action']) == 'sendpaymentlinkwhatsapp' && trim($_REQUEST['paymentLinkId']) != '') {

    $payment_link_id = $_POST['paymentLinkId'];

    $payment_link_data = GetPageRecord('query_id,amount,description,payment_link_id,payment_link_url,status,reference_id', 'queryPaymentLinks', 'id="' . $payment_link_id . '"');
    $payment_link_result = mysqli_fetch_array($payment_link_data);

    $query_id = $payment_link_result['query_id'];
    $price = $payment_link_result['amount'] * 100;
    $description = $payment_link_result['description'];
    $status = $payment_link_result['status'];
    $reference_id = $payment_link_result['reference_id'];

    $query_data = GetPageRecord('name,email,phone', ' queryMaster ', 'id="' . $query_id . '"');
    $query_data_result = mysqli_fetch_array($query_data);

    $name = $query_data_result['name'];
    $email = $query_data_result['email'];
    $phone = '+91' . $query_data_result['phone'];
    $payment_link_id_from_db = $payment_link_result['payment_link_id'];
    $payment_link_url_from_db = $payment_link_result['payment_link_url'];

    require('config/config.php');
    require('payment/razorpay-php/Razorpay.php');

    $api = new Api($keyId, $keySecret);

    if ($payment_link_id_from_db == '') {
        $payment_link = $api->paymentLink->create(
            array('amount' => $price,
                'currency' => 'INR',
                'description' => $description,
                'customer' => array(
                    'name' => $name,
                    'email' => $email,
                    'contact' => $phone),
                'reminder_enable' => false,
            )
        );

        if ($payment_link->status == 'created') {
            $payment_link_api_id = $payment_link->id;
            $payment_link_url = $payment_link->short_url;
            $payment_link_status = 'sent';
            $name_value = 'payment_link_id="' . $payment_link_api_id . '", payment_link_url="' . $payment_link_url . '", status="' . $payment_link_status . '"';
            $where = 'id="' . $payment_link_id . '" ';
            updatelisting('queryPaymentLinks', $name_value, $where);
            $name_value_1 = 'paymentStatus="3"';
            $where_1 = 'paymentId="' . $reference_id . '" ';
            updatelisting('sys_PackagePayment', $name_value_1, $where_1);
            $url = 'https://api.whatsapp.com/send?text=' . str_replace(' ', '', $payment_link->short_url) . '&phone=' . $phone;
            header('Content-Type: application/json; charset=utf-8');
            $data = array('success' => true, 'msg' => 'Payment Link Sent Successfully.', 'url' => $url);
            echo json_encode($data);
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'msg' => 'Something Went Wrong ! Please Try Again']);
        }
        exit;
    }else{
        if ($status == 'paid'){
            header('Content-Type: application/json; charset=utf-8');
            $data = array('success' => false, 'msg' => 'Payment Is Already Paid By Client.', 'info' => true);
        }else{
            $url = 'https://api.whatsapp.com/send?text=' . str_replace(' ', '', $payment_link_url_from_db) . '&phone=' . $phone;
            header('Content-Type: application/json; charset=utf-8');
            $data = array('success' => true, 'msg' => 'Payment Link Sent Successfully.', 'url' => $url);
        }
        echo json_encode($data);
        exit;
    }

}
?>

<?php if (trim($_REQUEST['action']) == 'schedulebreak' && trim($_REQUEST['userid']) != '') {

    $minutes = $_POST['breaktime'];
    $break_start_time = date('Y-m-d H:i');
    $created_at = date('Y-m-d H:i');
    $break_end_time = date('Y-m-d H:i:s', strtotime(sprintf('+ %d second', $minutes * 60)));
    $status = 'scheduled';
    $url = $_POST['url'];
    $user_id = $_POST['userid'];

    $namevalue = 'user_id="'.$user_id.'", minutes="'.$minutes.'", break_start_time="'.$break_start_time.'", break_end_time="'.$break_end_time.'", created_at="'.$created_at.'", status="'.$status.'" ';

    addlisting('useractivities', $namevalue);

    updatelisting('sys_userMaster','onlineStatus=1,is_scheduled="yes"','id="'.$user_id.'"');

    $_SESSION['break_scheduled'] = 1;

    ?>
    <script>
        parent.redirectpage('<?php echo $url; ?>');
    </script>
    <?php
}
?>

<?php if (trim($_REQUEST['action']) == 'cancelSchedule' && trim($_REQUEST['id']) != '') {

    $user_id = $_SESSION['userid'];
    $id = $_POST['id'];
    $name_value = 'status="cancelled"';
    $where = 'id="'.$id.'"';
    $is_proccesed = GetPageRecord('*', 'useractivities', 'id="'.$id.'"');
    $is_proccesed_results = mysqli_fetch_array($is_proccesed);
    if($is_proccesed_results['status'] == 'processed'){
        header('Content-Type: application/json; charset=utf-8');
        $data = array('success' => true, 'msg' => 'Schedule Break Is Already Processed.');
    }else{
        updatelisting('useractivities', $name_value, $where);
        updatelisting('sys_userMaster','onlineStatus=2,is_scheduled="no"','id="'.$user_id.'"');
        header('Content-Type: application/json; charset=utf-8');
        $data = array('success' => true, 'msg' => 'Schedule Break Cancelled Successfully.');
    }
    echo json_encode($data);
    exit;

}
?>

<?php if (trim($_REQUEST['action']) == 'AskForDeletePermission' && trim($_REQUEST['billId']) != '') {
    $bill_id = decode($_POST['billId']);
    $query_id = decode($_POST['queryId']);
    $asked_by = $_SESSION['userid'];
    $permission_status = 'pending';
    $date_time = date('Y-m-d H:i:s');

    $check_for_already_asked_permission = GetPageRecord('id', 'sys_PackagePayment', 'id="'.$bill_id.'" and permission_status="pending"');
    $check_for_already_asked_permission_result = mysqli_fetch_array($check_for_already_asked_permission);

    $count = count($check_for_already_asked_permission_result);

    if($count > 0){
        header('Content-Type: application/json; charset=utf-8');
        $data = array('success' => false, 'msg' => 'You Already Asked Permission For Delete This Bill.', 'info' => true);
    }else{

        $asked_by_data = GetPageRecord('firstName,lastName', 'sys_userMaster', 'id="'.$asked_by.'"');
        $asked_by_result = mysqli_fetch_array($asked_by_data);

        $details = $asked_by_first_name . ' ' . $asked_by_last_name . ' Asked For Permission To Delete Bill No ' . encode($bill_id);

        $name_value_2 = 'details="'.$details.'", taskType="PermissionNotification", queryId="' . $query_id . '",reminderDate="' . $date_time . '",addedBy="' . $asked_by . '",dateAdded="' . $date_time . '",assignTo="1", notificationType="3"';

        addlisting('queryTask', $name_value_2);

        updatelisting('sys_PackagePayment','permission_status="pending"','id="'.$bill_id.'"');

        header('Content-Type: application/json; charset=utf-8');
        $data = array('success' => true, 'msg' => 'Permission Request Sent Successfully.');

    }
    echo json_encode($data);
    exit;

}
?>

<?php if (trim($_REQUEST['action']) == 'GivePermissionToDelete' && trim($_REQUEST['notification_id']) != '' && trim($_REQUEST['bill_id']) != '') {

    $notification_id = $_POST['notification_id'];
    $bill_id = $_POST['bill_id'];
    $date_time = date('Y-m-d H:i:s');
    $permission_status = $_POST['permission_status'];

    $notification_data = GetPageRecord('*', 'queryTask', 'id="'.$notification_id.'"');
    $notification_result = mysqli_fetch_array($notification_data);

    if($permission_status == 'yes'){

        $details = 'Permission To Delete Bill No ' . $bill_id . ' Is Accepted By Admin.';
        $name_value = 'details="'.$details.'", taskType="PermissionNotificationStatusAccepted", queryId="' . $notification_result['queryId'] . '",reminderDate="' . $date_time . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . $date_time . '",assignTo="'.$notification_result['addedBy'].'", notificationType="4"';

        addlisting('queryTask', $name_value);

        updatelisting('sys_PackagePayment','permission_status="accepted"','id="'.decode($bill_id).'"');

        updatelisting('queryTask', 'makeDone=1', 'id="'.$notification_id.'"');

        header('Content-Type: application/json; charset=utf-8');
        $data = array('success' => true, 'msg' => 'Permission Granted Successfully.');
    }else{
        $details = 'Permission To Delete Bill No ' . $bill_id . ' Is Rejected By Admin.';
        $name_value = 'details="'.$details.'", taskType="PermissionNotificationStatusDeclined", queryId="' . $notification_result['queryId'] . '",reminderDate="' . $date_time . '",addedBy="' . $_SESSION['userid'] . '",dateAdded="' . $date_time . '",assignTo="'.$notification_result['addedBy'].'", notificationType="4"';

        addlisting('queryTask', $name_value);

        updatelisting('sys_PackagePayment','permission_status="declined"','id="'.decode($bill_id).'"');

        updatelisting('queryTask', 'makeDone=1', 'id="'.$notification_id.'"');

        header('Content-Type: application/json; charset=utf-8');
        $data = array('success' => true, 'msg' => 'Permission Declined Successfully.');
    }
    echo json_encode($data);
    exit;
}
?>

<?php
if (trim($_REQUEST['action']) == 'deleteBillUser' && trim($_REQUEST['parentId']) != '' && trim($_REQUEST['id']) != '') {
    deleteRecord('sys_PackagePayment', 'id="' . decode($_REQUEST['id']) . '"');
    header('Content-Type: application/json; charset=utf-8');
    $data = array('success' => true, 'msg' => 'Bill Deleted Successfully.', 'url' => 'display.html?ga=query&view=1&id='.$_REQUEST['parentId'].'&save=1&c=5');
    echo json_encode($data);
    exit;
}
?>

<script>
  parent.$('#savingbutton').prop("disabled", false);
  parent.$('#savingphtobutton').val('Upload Photo');
  parent.$('#savingbutton').prop("disabled", false);
  parent.$('#savingphtobutton').prop("disabled", false);
  parent.$('#savingbutton').val("Save");
</script>
