<?php
include "inc.php";

$id = decode($_REQUEST['id']);

$n = 1;
$rs = GetPageRecord('*', 'queryNotes', ' queryId="' . $id . '" order by id desc');
$cancelReason = "";
while ($rest = mysqli_fetch_array($rs)) {
  $status = getStatusBadge($rest['status']); // Extracted badge creation to a function

  // Fetching cancel reason from queryMaster
  $queryId = $rest['queryId'];
  $sql = "SELECT query_cancel FROM queryMaster WHERE id = $queryId";
  $result = mysqli_query(db(), $sql) or die(mysqli_error());
  //print_r($result);
  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $cancelReason = $row['query_cancel'];
    mysqli_free_result($result);
  }

  // Displaying notes
?>
  <div style="background-color: #ffffe1; border: 2px solid #ffdeae91; font-size: 14px; color: #000; margin-bottom: 10px; padding: 10px; border-radius: 4px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2%" align="left" valign="top"><i class="fa fa-thumb-tack" aria-hidden="true" style="font-size: 20px; color: #ff8d00;"></i></td>
        <td width="98%" align="left" valign="top" style="padding-left: 10px;">
          <?php echo $status; ?>
          <div style="margin-bottom: 5px; word-wrap: break-word; width: 100%; max-width: 300px;">
            <?php 
            if(!empty($cancelReason)){
            echo $cancelReason."<br/>";
            echo nl2br(stripslashes($rest['details'])); 
            }else{
              echo nl2br(stripslashes($rest['details']));
            }
            ?>
          </div>
          <div style="font-size: 12px;">
            <em><?php echo date('d/m/Y - h:i A', strtotime($rest['dateAdded'])); ?></em> by
            <?php
            $rsb = GetPageRecord('*', 'sys_userMaster', ' id="' . $rest['addedBy'] . '"');
            while ($restsource = mysqli_fetch_array($rsb)) {
              echo stripslashes($restsource['firstName'] . ' ' . $restsource['lastName']);
            }
            ?>
          </div>
        </td>
      </tr>
    </table>
  </div>
<?php
  $n++;
}
?>

<?php if ($n == 1) { ?>
  <div style="text-align:center; color:#999999;">No Notes</div>
<?php } ?>

<?php
// Helper function to get status badge
function getStatusBadge($status)
{
  switch ($status) {
    case 1:
      return '<span class="badge badge-primary" style="float: right;">New</span>';
    case 2:
      return '<span class="badge badge-primary" style="float: right;background:#0cb5b5">Active</span>';
    case 3:
      return '<span class="badge badge-primary" style="float: right;background:#0f1f3e">No Connect</span>';
    case 4:
      return '<span class="badge badge-primary" style="float: right;background:#e45555">Hot Lead</span>';
    case 5:
      return '<span class="badge badge-primary" style="float: right;background:#46cd93">Confirmed</span>';
    case 6:
      return '<span class="badge badge-primary" style="float: right;background:#6c757d">Cancelled</span>';
    case 7:
      return '<span class="badge badge-primary" style="float: right;">Invalid</span>';
    case 8:
      return '<span class="badge badge-primary" style="float: right;background:#cc00a9">Proposal Sent</span>';
    case 9:
      return '<span class="badge badge-primary" style="float: right; background:#ff6600">Follow Up</span>';
    case 11:
      return '<span class="badge badge-primary" style="float: right;background:#ff69a1">Changes</span>';
    case 12:
      return '<span class="badge badge-primary" style="float: right;background:#2104d8">Same day NC</span>';
    default:
      return '';
  }
}
?>