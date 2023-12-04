<div class="wrapper">
    <div class="container-fluid">
        <div class="main-content">

            <div class="page-content">



                <!-- start page title -->


                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-body" style="padding:0px;">
                                <h4 class="card-title cardtitle">Taggings
                                    <!-- <form action="" class="newsearchsecform" style="left:86px;" method="get" enctype="multipart/form-data">
                                        <input type="text" name="keyword" class="form-control newsearchsec" placeholder="Search by name" value="<?php echo $_REQUEST['keyword']; ?>" style="margin-top: 3px;">
                                        <input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />
                                    </form> -->


                                    <div class="float-right">
                                        <!-- <?php if (strpos($LoginUserDetails["permissionAddEdit"], 'Itinerary') !== false) { ?> <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" onclick="loadpop2('Itinerary setup',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static" popaction="action=addtineraries">Create itinerary</button> <?php } ?> -->

                                        <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light" onclick="loadpop2('Taggings setup',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static" popaction="action=addtaggings">Create Taggings</button>
                                    </div>
                                </h4>


                                <table class="table table-hover mb-0">

                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Created</th>
                                            <th>Last Updated</th>
                                            <th width="1%">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $totalno = '1';
                                        $select = '*';
                                        $wheremain = '';
                                        $where = ' where 1 ' . '  order by id desc';
                                        $rs = GetRecordList($select, 'Tags', '  ' . $where . '  ', '25', '', '');
                                        $totalentry = $rs[1];
                                        $paging = $rs[2];
                                        while ($rest = mysqli_fetch_array($rs[0])) {
                                        ?>

                                            <tr>
                                                <td>
                                                    <!-- <a href="display.html?ga=taggings&view=1&id=<?php // echo encode($rest['id']); ?>"> -->
                                                        <?php echo $rest['name']; ?>
                                                    <!-- </a> -->
                                                </td>
                                                <td>
                                                    <?php echo $rest['type']; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d/m/Y - h:i A', strtotime($rest['created_at'])); ?>    
                                                </td>
                                                <td>
                                                    <?php echo date('d/m/Y - h:i A', strtotime($rest['updated_at'])); ?>    
                                                </td>
                                                <td width="1%">
                                                    <a class="dropdown-item neweditpan" style="cursor:pointer;background-color: #c6e5f5;" onclick="loadpop2('Edit Taggings',this,'600px')" data-toggle="modal" data-target="#myModal2" data-backdrop="static" popaction="action=addtaggings&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <button onclick="delete_data(<?= $rest['id'] ?>,'deletetaggings','taggings');" class="dropdown-item neweditpan" style="float:left;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        <?php $totalno++;
                                        } ?>
                                    </tbody>
                                </table>
                                <?php if ($totalno == 1) { ?>
                                    <div style="text-align:center; padding:40px 0px; font-size:14px; color:#999999;">No Taggings</div>
                                <?php } else { ?>
                                    <div class="mt-3 pageingouter">
                                        <div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
                                        <div class="pagingnumbers"><?php echo $paging; ?></div>

                                    </div>

                                <?php } ?>
                            </div>


                        </div>


                    </div>

                </div>
                <!--end col-->

                <!-- end row -->

            </div>

            <!-- End Page-content -->


        </div>
    </div>
</div>


<script>
    function duplicatePackage(id) {
        var result = confirm("Are you sure you want to create duplicate package?");
        if (result == true) {
            $('#ActionDiv').load('actionpage.php?pid=' + id + '&action=addduplicatepackage');
        } else {
            return false;
        }
    }
</script>