<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
$(document).ready(function() {
    $("#cityInput").on("input", function() {
        var searchTerm = $(this).val();
        // console.log(searchTerm);
        $("#searchResults").html(''); // Clear previous results
        $.post("https://tripzygo.travel/crm/citysearch.php", { searchTerm: searchTerm }, function (data) {
            data = JSON.parse(data);
            console.log(data);
            data.forEach(function (option) {
                var optionElement = $("<div class='dropdown-item'>" + option.cityName + " (ID: " + option.cityId + ")</div>");
                // console.log(optionElement);
                $("#searchResults").append(optionElement);
            });

            $("#searchResults").show();
        });
    });

    $("#searchResults").on("click", ".dropdown-item", function() {
        var selectedCity = $(this).text();
        $("#cityInput").val(selectedCity);
        var idRegex = /\(ID: (\d+)\)/;

        // Match the regular expression against the string
        var city_id_ = selectedCity.match(idRegex);
        city_id = city_id_[1];
        console.log(city_id);
        $('#city_id').val(city_id);
        $("#searchResults").hide();
    });

    $(document).on("click", function (e) {
        if (!$(e.target).closest(".form-group2").length) {
            $("#searchResults").hide();
        }
    });
});

</script>

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">
                     <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card" style="min-height:500px;">
                            <div class="card-body">
                                <h4 class="card-title" style=" margin-top:0px;">User Mapping
                                <!--<div class="float-right" id="addmemberbtndiv">-->
                                <!--        <button id="addteammember" type="button" class="btn btn-secondary btn-lg waves-effect waves-light" onclick="loadpop('Add City mapping',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcitymapping">Add city mapping </button>-->
                                <!--    </div>-->
                                </h4>
                                <p class="card-title-desc">People within your organisation</p>
                                <!--<form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">-->
                                <div class="modal-body">
            <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post"
          enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="validationCustom02">Seller Name</label>
    <select class="form-control" required name="sellerName" id="mySelect">
        <?php
        // Assuming $conn is your database connection
        $result = mysqli_query(db(), "SELECT id, concat(firstName,' ',lastName) as Seller_name FROM `sys_userMaster` where status=1;");

        while ($row = mysqli_fetch_assoc($result)) {
            $sellerId = $row['id'];
            $sellerName = $row['Seller_name'];
            echo "<option value='$sellerId'>$sellerName (ID: $sellerId)</option>";
        }
        ?>
    </select>
            </div>
                <div class="form-group2">
                    <label for="validationCustom02">City</label>
                    <input type="text" class="form-control" required="" name="City" id="cityInput" autocomplete="off">
                    <input type="hidden" name="cityId" id="city_id">
                    <div id="searchResults"></div>
                    </div>

                </div>
                <div>
                                        <input type='hidden' name='action' value='insertUserCityMapping'>
                                        <br>
                                        <button type='submit' class='btn btn-primary btn-sm' >Insert</button>
                     </div>                   

            

               


               

            </div>
        </div>
        </form>
                                    <table class="table table-hover mb-0 col-md-8">

                                        <thead>
                                            <tr>
                                                <th width="2%">&nbsp;</th>
                                                <th>Name</th>
                                                <th>Destination</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        // Assuming db() is the function that returns your MySQL connection
                                        // $conn = db();
                                        $query = "SELECT sys_user_city_mapping.mapping_id as mapping_id, sys_user_city_mapping.city_id as city_id, cityMaster.name as city, concat(sys_userMaster.firstName,' ', sys_userMaster.lastName) as Seller FROM `sys_user_city_mapping` join cityMaster on sys_user_city_mapping.city_id = cityMaster.id join sys_userMaster on sys_user_city_mapping.user_id = sys_userMaster.id order by Seller,city;";
                                        $result = mysqli_query(db(), $query);

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>{$row['mapping_id']}</td>";
                                            // Fetch user name and destination based on user_id and city_id
                                            $userName = ($row['Seller']);
                                            $cityName = ($row['city']);
                                            $cityId = $row['city_id'];
                                            echo "<td>{$userName}</td>";
                                            echo "<td>{$cityName} (ID:{$cityId})</td>";
                                            echo "<td><form method='post' action='frmaction.html'  target='actoinfrm' onsubmit='return confirm(\"Are you sure you want to delete this entry?\")'>
                                        <input type='hidden' name='action' value='deleteUserCityMapping'>
                                        <input type='hidden' name='delete_mapping_id' value='{$row['mapping_id']}'>
                                        <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                        </form></td>";
                                            echo "</tr>";
                                        }

                                        // Close the database connection
                                        // mysqli_close($conn);
                                        ?>

                                    </tbody>
                    
                    </div>
                    </div>
                    </div>
                    </div>
                    