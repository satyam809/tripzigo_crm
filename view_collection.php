<?php
$abcd = GetPageRecord('*', 'Collection', 'id="' . decode($_REQUEST['id']) . '"');
$collection_detail = mysqli_fetch_array($abcd);
$collection_id = $collection_detail['id'];
if ($collection_detail['id'] == '') {
    header('Location: ' . $fullurl . '');
    exit();
}

$collection_image = "select Collection_image.* from Collection_image,Collection where Collection.id=Collection_image.collection_id and collection_id = $collection_id";
$collection_image_rs = mysqli_query(db(), $collection_image) or die(mysqli_error());
// $collection_image_detail = mysqli_fetch_array($collection_image_rs);


$collection_itneraries = "select sys_packageBuilder.name from sys_packageBuilder,Collection_itineraries where Collection_itineraries.itinerary_id=sys_packageBuilder.id and sys_packageBuilder.publicly_visible=1 and collection_id=$collection_id";
$collection_itneraries_rs = mysqli_query(db(), $collection_itneraries) or die(mysqli_error());

$collection_tags = "select ts.*, t.name from Taggings ts, Tags t where t.id=ts.tags_id and tagable_id=$collection_id and taggable_type='collection'";
$collection_tags_rs = mysqli_query(db(), $collection_tags) or die(mysqli_error());

?>



<style>
    body {
        background-color: #f9fbfc !important;
    }

    html {
        background-color: #f9fbfc !important;
    }
</style>

<div class="wrapper">

    <div class="container-fluid">
        <div class="main-content">

            <div class="page-content">

                <div class="row">
                    <div class="col-md-12 col-xl-12" id="displayprofile">
                        <div class="systemcard">

                            <div style=" padding-bottom:20px; position:relative;">
                                <div class="float-right">
                                    <a href="display.html?ga=collection" style="position: absolute; right: 50px; top: 10px;"><button type="button" class="btn btn-primary btn-lg waves-effect waves-light" style="margin-bottom:10px;">Back</button></a>
                                </div>

                                <a class="dropdown-item neweditpan" style="cursor:pointer; position:absolute; right:0px; top:10px;z-index: 1;background-color: #c6e5f5;" onclick="loadpop2('Edit Collection',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static" popaction="action=addcollection&id=<?php echo encode($collection_detail['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </div>


                            <div id="clientsec">
                                <div style="font-size:16px; font-weight:600; margin-bottom:5px; margin-top:20px;">Collection Information</div>


                                <table border="0" cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td style="padding-right:100px;">Name</td>
                                        <td><?php echo stripslashes($collection_detail['name']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td><?php echo stripslashes($collection_detail['location']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><?php echo stripslashes($collection_detail['description']); ?></td>
                                    </tr>
                                    <tr style="margin-top: 3px;">
                                        <td>Linked Itineraries</td>
                                        <td>
                                                <?php
                                                while ($collection_itneraries_detail = mysqli_fetch_array($collection_itneraries_rs)) {
                                                ?>
                                                          <span class="badge badge-success"><?php print_r($collection_itneraries_detail['name']); ?></span>
                                                <?php
                                                }
                                                ?>
                                        </td>
                                    </tr>
                                    <tr style="margin-top: 3px;">
                                        <td>Collection Tags</td>
                                        <td>
                                                <?php
                                                while ($collection_tags_detail = mysqli_fetch_array($collection_tags_rs)) {
                                                ?>
                                                    <span class="badge badge-primary"><?php print_r($collection_tags_detail['name']); ?></span>
                                                <?php
                                                }
                                                ?>
                                        </td>
                                    </tr>
                                    <tr style="margin-top: 3px;">
                                        <td>Destination Type</td>
                                        <td><span class="badge badge-info"><?php echo $collection_detail['destination_type']; ?></span></td>
                                    </tr>
                                    <tr style="margin-top: 3px;">
                                        <td>Location Type</td>
                                        <td><span class="badge badge-info"><?php echo $collection_detail['location_type']; ?></span></td>
                                    </tr>
                                 </table>

                            </div>
                        </div>

                        <div class="systemcard" id="followupsec">
                            <div style=" background-color: #FFFFFF; padding-bottom: 10px; position: relative; ">
                                <div style="font-size:16px; font-weight:600; margin-bottom:5px;">Collection Image</div>
                            </div>
                            <style>
                                .column {
                                    float: left;
                                    width: 33.33%;
                                    padding: 5px;
                                }

                                /* Clear floats after image containers */
                                .row::after {
                                    content: "";
                                    clear: both;
                                    display: table;
                                }
                            </style>
                            <div class="row">
                                <?php
                                while ($collection_image_detail = mysqli_fetch_array($collection_image_rs)) {

                                    // print_r($collection_image_detail['image_path']);

                                ?>

                                    <div class="mx-2 my-2">
                                        <img src="collectionphotos/<?php print_r($collection_image_detail['image_path']); ?>" alt="Snow" style="width:150px;height:150px;">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>


                        </div>
                        <!-- <div class="systemcard" id="querysec">
                            <div style=" background-color: #FFFFFF; padding-bottom: 10px; position: relative; ">
                                <div style="font-size:16px; font-weight:600; margin-bottom:5px; position:relative;">Queries

                                    <a href="#" onclick="createqueryfromclient('<?php echo $_REQUEST['id']; ?>');" style="position:absolute; right:0px;"><button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" style="margin-bottom: 10px; border-radius:20px; padding: 5px 15px; width: 100%;text-align:left;"><i class="fa fa-plus" aria-hidden="true"></i> Add Query</button></a>
                                </div>
                            </div>

                            <table class="table table-hover mb-0">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Destination</th>
                                        <th>
                                            <div align="left">From</div>
                                        </th>
                                        <th>
                                            <div align="left">To</div>
                                        </th>
                                        <th>Requirement</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if ($LoginUserDetails['userType'] != 0) {

                                        if ($LoginUserDetails['showQueryStatus'] == 0) {
                                            $mainwhere = ' and (addedBy="' . $_SESSION['userid'] . '" or  assignTo="' . $_SESSION['userid'] . '")  ';
                                        }

                                        if ($LoginUserDetails['showQueryStatus'] == 1) {
                                            $mainwhere = ' and (statusId=5  or statusId=9) ';
                                        }

                                        if ($LoginUserDetails['showQueryStatus'] == 2) {
                                            $mainwhere = ' and 1  ';
                                        }

                                        if ($_REQUEST['statusid'] == 1) {
                                            //$noteswhere='and id in (select queryId from queryNotes) and statusId=1';
                                        }

                                        if ($_REQUEST['statusid'] == '') {
                                            //$noteswhere='and id in (select queryId from queryNotes)';
                                        }
                                    } else {
                                        $mainwhere = ' and 1 ';
                                    }





                                    $totalno = '1';
                                    $totalmail = '0';
                                    $select = '';
                                    $where = '';
                                    $rs = '';
                                    $select = '*';
                                    $wheremain = '';
                                    $where = ' where   clientId="' . $clientDetails['id'] . '" ' . $mainwhere . ' order by id desc';
                                    $limit = clean($_GET['records']);
                                    $page = clean($_GET['page']);
                                    $sNo = 1;
                                    $targetpage = 'display.html?ga=' . $_REQUEST['ga'] . '&keyword=' . $_REQUEST['keyword'] . '&';
                                    $rs = GetRecordList('*', 'queryMaster', '  ' . $where . '  ', '100', $page, $targetpage);

                                    $totalentry = $rs[1];

                                    $paging = $rs[2];
                                    while ($rest = mysqli_fetch_array($rs[0])) {
                                    ?>

                                        <tr>
                                            <td><a href="display.html?ga=query&view=1&id=<?php echo encode($rest['id']); ?>" target="_blank"><?php echo encode($rest['id']); ?></a></td>
                                            <td><span style="max-width:180px; overflow:hidden;overflow-wrap: break-word;"><?php
                                                                                                                            $string = '';
                                                                                                                            $string = preg_replace('/\.$/', '', $rest['destinationId']);
                                                                                                                            $array = explode(',', $string);
                                                                                                                            foreach ($array as $value) { ?>
                                                        <span class="badge badge-boxed  badge-soft-success" style=" background-color: #737373 !important; color:#fff; font-size: 11px; padding: 5px 6px;"><?php echo  getCityName($value); ?></span>
                                                    <?php } ?></span></td>
                                            <td>
                                                <div align="left"><?php echo date('d-m-Y', strtotime($rest['startDate'])); ?></div>
                                            </td>
                                            <td>
                                                <div align="left"><?php echo date('d-m-Y', strtotime($rest['endDate'])); ?></div>
                                            </td>
                                            <td><?php $rsb = GetPageRecord('*', 'queryServicesMaster', ' id="' . $rest['serviceId'] . '"');
                                                while ($restsource = mysqli_fetch_array($rsb)) {
                                                    echo stripslashes($restsource['name']);
                                                } ?></td>
                                            <td><?php echo getstatus($rest['statusId']); ?></td>
                                            <td><?php if (date('d-m-Y', strtotime($rest['dateAdded'])) == '01-01-1970') {
                                                    echo '-';
                                                } else {
                                                    echo date('d-m-Y', strtotime($rest['dateAdded']));
                                                } ?></td>
                                        </tr>


                                    <?php $totalno++;
                                    } ?>
                                </tbody>
                            </table>
                            <?php if ($totalno == 1) { ?><div style="padding:20px; text-align:center;">No Query Found</div><?php } ?>

                        </div> -->
                    </div>

                </div>

                <!-- end row -->

            </div>

            <!-- End Page-content -->


        </div>
    </div>
</div>