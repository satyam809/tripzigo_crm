<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
$namevalue = 'onlineStatus=2';

$where = 'id="' . $_SESSION['userid'] . '" and is_scheduled="no"';

updatelisting('sys_userMaster', $namevalue, $where);

$ars = GetPageRecord('invoiceLogo', 'sys_userMaster', 'id=1');

$companyLogoAdmin = mysqli_fetch_array($ars);

$user_id = $_SESSION['userid'];

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$is_break_scheduled = countlisting('user_id', 'useractivities', 'where user_id="' . $user_id . '" and status="scheduled"');

if ($is_break_scheduled > 0){
    $color = '#ff6a00';
}else{
    $color = '#009900';
}

$scheduled_data = GetPageRecord('*', 'useractivities', 'user_id="'.$user_id.'" and status="scheduled"');

$scheduled_result = mysqli_fetch_array($scheduled_data);

?>



<?php //if ($expirydate < date('Y-m-d')) { ?>


<!--<div style="text-align:center; font-size:25px; padding-top:50px; color:#CC0000;">Your subscription hasbeen expired.-->
<!--    Please contact to support for renewal. www.travbizz.com-->
<!--</div>-->


<?php 
    //exit();} ?>


<div id="preloader" style="background-color: #ffffffdb;">


    <div id="status">


        <div class="spinner"></div>


    </div>


</div>


<div id="tograypanelmenu">


    <div class="logonavitop">


        <a href="<?php echo $fullurl; ?>" class="topmainlogomain"><img
                src="profilepic/<?php echo stripslashes($companyLogoAdmin['invoiceLogo']); ?>" /></a>


        <a class="topmainlogomainmobile" onclick="$('#navigation').toggle();"><i class="fa fa-bars"
                aria-hidden="true"></i></a>


    </div>


    <div id="searchblk"></div>


    <div class="headersearchbarouter">


        <table width="100%" border="0" cellpadding="0" cellspacing="0">


            <tr>


                <td colspan="2"><select name="topsearchtype" id="topsearchtype" onchange="topsearchstart();">


                        <option value="All">All</option>


                        <option value="Queries">Queries</option>


                        <option value="Itineraries">Itineraries</option>


                        <option value="Clients">Clients</option>


                    </select></td>


                <td width="90%">


                    <input type="text" name="topsearchkeyword" id="topsearchkeyword" placeholder="Search"
                        style="border-left:1px solid #ddd;" onfocus="opensearch();" onkeyup="topsearchstart();" />
                </td>


            </tr>


        </table>


        <i class="fa fa-search" aria-hidden="true"></i>


        <div id="topsearchresult"></div>


    </div>


    <script>
    function opensearch() {


        $('#searchblk').show();


        $('.headersearchbarouter').addClass('searchstart');


        $('html').css('overflow', 'hidden');


    }


    function topsearchstart() {


        var topsearchtype = encodeURI($('#topsearchtype').val());


        var topsearchkeyword = encodeURI($('#topsearchkeyword').val());


        $('#topsearchresult').load('topsearchresult.php?keyword=' + topsearchkeyword + '&topsearchtype=' +
            topsearchtype);


    }


    $("#searchblk").click(function() {


        $('#searchblk').hide();


        $('.headersearchbarouter').removeClass('searchstart');


        $('html').css('overflow', 'visible');


    });
    </script>

    <div class="navirightlink">


        <div class="welcomename icon-container" title="User Menu"
            onclick="$('.headerslideright').removeClass('width480');openusermenu();$('.usermenu').show();$('.createnewmenu').hide();$('.showreminders').hide();$('.createnotification').hide();$('.workinghoursstrip').show();">
            <?php echo substr($LoginUserDetails['firstName'], 0, 1); ?>
            <div style="background-color: <?php echo $color; ?>" class='status-circle'></div>
        </div>


    </div>

    <div class="rightmenu">


        <a title="Create New"
            onclick="openusermenu();$('.usermenu').hide();$('.createnewmenu').show();$('.createnotification').hide();$('.showreminders').hide();$('.workinghoursstrip').hide();$('.headerslideright').addClass('width480');"><i
                class="fa fa-plus-circle" aria-hidden="true"></i></a>


        <a href="display.html?ga=inbox" title="Inbox"><i class="fa fa-envelope" aria-hidden="true"></i></a>

        <a href="javascript:void(0);" title="Reminders" style="position:relative;"
            onclick="openusermenu();$('.usermenu').hide();$('.createnewmenu').hide();$('.createnotification').hide();$('.showreminders').show();$('.workinghoursstrip').hide();$('#loadreminders').load('load_reminders.php');"><i
                class="fa fa-calendar-check-o" aria-hidden="true"></i>
            <div class="loadtopnotifications">1</div>
        </a>

        <a href="javascript:void(0);" title="Notification" style="position:relative;"
            onclick="openusermenu();$('.usermenu').hide();$('.createnewmenu').hide();$('.createnotification').show();$('#loadnotificationscreate').load('loadnotificationscreate.php');"><i
                class="fa fa-bell-o" aria-hidden="true"></i>
            <div class="topnotifications">1</div>
        </a>

        <a href="display.html?ga=flyerdesigner" style="position:relative; display:none;">
            <div
                style="background: rgb(195,74,34); background: linear-gradient(0deg, rgba(195,74,34,1) 0%, rgb(253 98 45) 100%); font-size: 14px; color: #fff; font-weight: 600; padding: 5px 10px; margin-top: -2px; border-radius: 24px; ">
                <table border="0" cellpadding="0" cellspacing="00">
                    <tr>
                        <td colspan="2" style=" padding-right:5px;"><img
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABmJLR0QA/wD/AP+gvaeTAAAD2klEQVRYhcWWX2hbVRzHP+femyakWQvTTbM6K4xWrBNRV1Fxbmxvc/rg2IQN//Rhgi9DsKKdOFsYopWKf0D2oA8Km/8KXQt9GA5kZWW16spQZ9vVtiFd0z9r2qS5N7m5/3xoGxKapCFN5/fpnt+553w+3D/nHPifI3J1BMLhp01Z3g9UFjOxlUwOGqY5L0DFcf6u27YtUJDAaDTaqChyiyzL3mLAK9E0DV3X00u/4fD2Tr//l5wC49Hojy532eH1gFei6wk0LZ5RE2A5Did2+v1frtSklYvRaLSxVPAlmLSq5oAsBJ//GQrtXSWguJTmUsGXDbJmWeKjDIGxxcU9siSVl5LvOHm7H/8nFLoPQAEQtr17/USDzVMf4o5PIEQZhj3NzfJXUd1PZr3dkpz7gXEJwILN6+VvCTbhSYQRwgsouPQhqmeOUq5fyXq/sEUFkOVLKSKKPobLNDOL9gwCg62R1rxjSyLgUftApH11TgTs6FJf8vrGC1iuuzILyZHUpaFUbbxAfNM+HEddbtlgDqX65n3H8o5V8nWGElN0zHQxb9xih7eWI/4XkHI436p6izsnP0YYAbBjOEJmzvcac76G4gQ6prroiZ2nTBEgw4D+L1eGfubN6lPc61n9WA13DZPVZzDmehDmAgnXA5jy1rxwyPEK2qc66dWW4WnxuE3agu8zpo1nnUyLx1GVh4l59hQEzyrQPnWePq0TWcq+lnpcDp/ePE0gHsyo63qCZDKZasctHXuN5XCVwBK8Kyc8XeKTiZaUhJ5Mpna+y+FrHLraRH1vA49dfpl3h84wo8+vLdAe6igIni7RNtFCIBpEU1Usx6Jt9Byv/9XKUGzp7GE4Fp3TPTz/RyM/TF7M+kQEQOvIN90DxoUDhcIB4qbFrxMLmAkf++/Yxe/RwRQ4Vx6prKW55jg7vFUIhyMP+v0/KQABbfxu2V0Y3LIdRsIa16aiJC0H0Dk7eaGgsQORYQ5dbeKVqgM03POsC9ZYB9ITSZiML8QZnlPRTbvQYati2iZfB7uIGLFdwDkFIKYr1/tnFx6t8Ci4JAlZCBKmjW5ZLOoW07EkcdMqGpovCoAat2eH57QNAawVCUARcvh2g12SMpsSKJfKem63gK/MewnSjo413S/FbqgTJT0X5kqtd3ts+OC3myBtIaqvfOg9SZRkd84bSUjUV9SdXGln/PzPXTr1ffdM74u2U/xvthb84Jbd33XtbT6aVQDg2OUP3uiPDJ6+oQZL+jpqvdtj9RV1J88+884X6fWcy9/x/s+eWtTVfaZjrevErAg57HP5Ln71xIm+9cyzYfkPRuyROSvGH0YAAAAASUVORK5CYII="
                                width="20">

                        </td>
                        <td style="text-shadow: 1px 1px #00000047;">Flyer Designer</td>
                    </tr>
                </table>
            </div>
        </a>
    </div>
    <?php require_once('./header/activity.php')?>
    <div class="row" id="loadFlashMessages">

    </div>

    

</div>

<!-- <div id="currentactivitytype">

</div> -->



<div class="rnblk">


    <div class="headerslideright ">


        <div class="userinformationbox usermenu">


            <table width="100%" border="0" cellpadding="0" cellspacing="0">


                <tr>


                    <td colspan="2" align="left" valign="middle">
                        <div class="nameboxxx"><?php echo substr($LoginUserDetails['firstName'], 0, 1); ?></div>
                    </td>


                    <td width="80%" align="left" valign="middle">


                        <div style="margin-bottom:0px; font-size:16px; font-weight:700;">
                            <?php echo stripslashes($LoginUserDetails['firstName']) . ' ' . stripslashes($LoginUserDetails['lastName']); ?>
                        </div>


                        <div style="margin-bottom:0px; font-size:14px; font-weight:400;">Email:
                            <strong><?php echo($LoginUserDetails['email']); ?></strong>
                        </div>


                        <div style="margin-bottom:0px; font-size:13px; font-weight:400;">Last Login:
                            <strong><?php echo date('d/m/Y - h:i A', strtotime($LoginUserlog['lLogin'])); ?></strong>
                        </div>


                    </td>


                </tr>


            </table>


            <i class="fa fa-times" aria-hidden="true"
                style="position:absolute; right:15px; top:10px; color:#666666; font-size:18px; cursor:pointer;"
                onclick="closeusermenu();"></i>


        </div>


        <div class="workinghoursstrip"><i class="fa fa-clock-o" aria-hidden="true"></i> Today's Working Hours: <span
                class="showcurrentworkinghours">0</span></div>


        <script>
        function showcurrentworkinghours() {


            $('.showcurrentworkinghours').load('todaysworkinghours.php?page=<?php echo $actual_link; ?>');


        }

        var intervalId = window.setInterval(function() {


            showcurrentworkinghours();


        }, 60000);


        showcurrentworkinghours();

        setInterval(function() {
            $.get('check_break_time.php', function(data) {});
        }, 30000);

        $('#loadFlashMessages').load('flash_message.php');
        </script>

        <div class="contnetin usermenu">


            <?php


            $where = 'id=1';


            $rs = GetPageRecord($select, 'sys_userMaster', $where);


            $LoginUserDetailscompany = mysqli_fetch_array($rs);


            ?>


            <div class="head17">Organization</div>


            <div class="cont"><i class="fa fa-building-o" aria-hidden="true"></i>
                &nbsp;<?php echo stripslashes($LoginUserDetailscompany['invoiceCompany']); ?></div>


            <hr />


            <a href="display.html?ga=myprofile"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;My Profile</a>


            <a href="display.html?ga=mailsetting"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;Mail
                Setting</a>


            <?php if ($LoginUserDetails['userType'] == 0) { ?>


            <a href="display.html?ga=team"><i class="fa fa-users" aria-hidden="true"></i> &nbsp;Team</a>

            <?php if ($is_break_scheduled > 0) { ?>
            <a style="color: orange;" href="javascript:void(0);" id="cancelSchedule"
                onclick="cancelSchedule('<?php echo $scheduled_result['id']; ?>')"><i class="fa fa-clock-o"
                    aria-hidden="true"></i>
                &nbsp;Schedule Break</a>
            <?php } else { ?>
            <a href="javascript:void(0);" id="addBreakSchedule" onclick="loadpop('Schedule Break',this,'400px')"
                data-toggle="modal" data-target=".bs-example-modal-center"
                popaction="action=schedulebreak&userid=<?php echo $_SESSION['userid']; ?>&url=<?php echo $actual_link; ?>"><i
                    class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;Schedule Break</a>
            <?php } ?>

            <a href="display.html?ga=setting"><i class="fa fa-cog" aria-hidden="true"></i> &nbsp;Settings</a>

            <?php } ?>

            <?php if ($LoginUserDetails['userType'] == 1) { ?>

            <?php if ($is_break_scheduled > 0) { ?>
            <a style="color: orange;" href="javascript:void(0);" id="cancelSchedule"
                onclick="cancelSchedule('<?php echo $scheduled_result['id']; ?>')"><i class="fa fa-clock-o"
                    aria-hidden="true"></i>
                &nbsp;Schedule Break</a>
            <?php } else { ?>
            <a href="javascript:void(0);" id="addBreakSchedule" onclick="loadpop('Schedule Break',this,'400px')"
                data-toggle="modal" data-target=".bs-example-modal-center"
                popaction="action=schedulebreak&userid=<?php echo $_SESSION['userid']; ?>&url=<?php echo $actual_link; ?>"><i
                    class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;Schedule Break</a>
            <?php } ?>

            <?php } ?>

            <a href="#" id="logoffpopup"
                onclick="loadpop('Are you sure you want to Logout this session: ',this,'600px')" data-toggle="modal"
                data-target=".bs-example-modal-center"
                popaction="action=logoffhourspopup&userid=<?php echo $_SESSION['userid']; ?>&username=<?php echo $_SESSION['username']; ?>"
                style="color:#CC3300;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>


            <hr />


            <?php if ($_SESSION['userid'] == 1) {


                $now = time();


                $your_date = strtotime($expirydate);


                $datediff = $your_date - $now;


                ?>


            <!--<div style="text-align: left; padding: 10px; line-height: 23px; background-color: #fdffd4; border: 1px solid #ffe191;">-->
            <!--    Total Remaining <strong><?php echo round($datediff / (60 * 60 * 24)); ?> Days</strong><br/>-->


            <!--    Expiry Date: <strong><?php echo date('d-m-Y', strtotime($expirydate)); ?></strong></div>-->


            <hr />


            <?php } ?>


            <div class="head17">Need Help?</div>


            <a href="mailto:info@tripzygo.in" target="_blank" style="color:#333333;"><i class="fa fa-envelope-o"
                    aria-hidden="true"></i> &nbsp;info@tripzygo.in</a>


            <a href="https://www.tripzygo.in" target="_blank" style="color:#333333;"><i class="fa fa-desktop"
                    aria-hidden="true"></i> &nbsp;https://www.tripzygo.in/</a>


        </div>


        <div class="contnetin createnewmenu">


            <div class="head17" style="position:relative;">Masters & Settings<i class="fa fa-times" aria-hidden="true"
                    style="position: absolute; right: 0px; top: -5px; color: #666666; font-size: 18px; cursor: pointer;"
                    onclick="closeusermenu();"></i></div>


            <div class="mastericons">


                <a href="display.html?ga=suppliers">


                    <img
                        src="data:image/png;base64,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" />


                    <div class="titilemaster">Suppliers</div>


                </a>


                <a href="display.html?ga=destinations">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAADMElEQVRYhe2Xz28bRRTHvzOzu157va5jx41jSJSAoK16qVTUNAXRBgERZw5ceugxfwHN0SeE+Aty44C4cAdRQE1UBRA/FLVBFQIaVHBim9hObO96vb9mhgNJlJAGEpaSIO1HetKO5unp8zQ7q33ACYdsP0y//aXcvXFrdpLsT//vobsXczMTmJuZOC6XR6IctPHqW1+cBSMTGqMvKoxd5FwMB1zkCCGcMfRUyla5FMuez+9wgsXPbk5+/zgE9xzx9avjuF/pYvnhBnRNsUsFE6WcmS4MpJBJ6TB0FVwI+AHHpu1is9vHasNy1ppd4QUcKmNfu37woSRy0et7SwvlqfAoMq+88/kFFewNAK9/9OblZ/cJnh8roDRoYuR0BmYqcaRObdfHWsNCdd1yf1lv+7bra5rC7nu++FgKfk8S9qNkYY0lOp3+RlJVkvoIFXQYRJzXFWVaQD6va4w9Xcrpdx/U1e07sOeIX37uqSNJ7SatazgzkseZkbwOQPcCjlrLulht2heanV6v1XHgBUQN3JyaNCA1hfmGrobDOTNRzBn66FAWZkoDANx9UN+pe+A7GJWEyjBWzGKsmGUAMo9IUQ9Th/59yvESC0YlFoxKLBiVWDAqsWBUYsGoxIJRiQWjcuAfdafnotq00Gg7fq1lO13HU1w/TECCKoz6SV3x85kUHRowjCcKGVrMGWD03+93j+C9lTpqTRsP621IgRah+DYI+TyXWCZgv1IXlT76fiplZDuOV2r3vHOVRvvS0k/16TAU44Onkv3RoazxZMFUivk0NIUdWkRIiWrTwkp1wwOwM7HtCFJK4DoOrjyTxQ+VFm7NTg7+Rb36ViwBeB8ArpXn0zUur7Ta/Ze++/m314JQnD1lJvqjpzOpoYG0mjOTSCc1aCqDBOB4Aayeh/XNnqw0utbaupWghKyGXLzHCT7YJyiExI2pP6a6d2+vHLrzbRbKUzaAT7Zi9lp5Xg9FeKltu1c11rospTwnpMxzLlOEEq5S2qIUdT8U34Rc3BaEL35684Xqn+s+tqluoTzlArizFf+YE3+LY8GoxIJRiQWjcuIF93yoZ+a+Oi6P/y+/A01FRwNR8TOVAAAAAElFTkSuQmCC" />


                    <div class="titilemaster">Destinations</div>


                </a>


                <a href="display.html?ga=inclusions">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAAA5ElEQVRYhe2UvQ3CMBSED8RSQGagYAeQoGYGKKAExgDEDPwMkEksJSBIYapIAdlJXh6xXbyvtWx90vkOEHh0bAeL/UW7FNnMI6NLr+zSaDxsx+aH8+FqPes6MWAgglxEkIsIcindQRPFzcp3smzHTFD2lSxoerzNQQ8+YhHkIiXhEnzEIshFSsIl+IhFkIuUhEvwEQcvSI64KdR/muNMEADWs++/mj4z7E6xVun7brvjLeKi3HLSt7bMi2BdOcCDIEUOcCxIlQMcC26PsVbJq7YcUNHiptNgQz2y22o6iP76qFDBB24mbopzPuDKAAAAAElFTkSuQmCC" />


                    <div class="titilemaster">Inclusions</div>


                </a>


                <?php if (strpos($LoginUserDetails["permissionView"], 'RoomType') !== false) { ?><a
                    href="display.html?ga=roomType">


                    <img
                        src="data:image/png;base64,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" />


                    <div class="titilemaster">Room Type</div>


                </a>


                <?php } ?>





















                <?php if ($_SESSION['userid'] == 1) { ?>
                <a href="display.html?ga=mealplan">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAAE0UlEQVRYhe2YW2xURRjH/zPnspeuLLTQm/QGpDSGIqGBUmkTkdIGozE8CPpgwosJCRhjorXxAdsXWyExRkJSIi8+KKY+6IOiBZM2UbogTQotElrabndb2l12aXfb3T27PefM+LB0ZS8lmsXdmvBPTnLONzNnfvPNNzNfBniq9EQSDQc+se2VZaFb0/TiTIKIojCja+zIL617fo+zJ1aUZeHbXds2FxeuX5s5OgCzHl/xwJ/jFwCUPGqniRV1nRXn51kzBrasovVroen6s4n2JMDVpjjAg6eubKaEaDQ5NP9zcQKIRFhq7ujf8qg9LgYpkbp2VRVLG9dmHhAAdj9XLA/cmTkHYH+MafmlucPWKEtiQ83WQkIJkI2nprKIGGTxhaZO28E4wJpzA5Io0vP7a8oNAs1eWFJK8FJNhVES6JcHv7hoiAHmzWvvbsi15G8qyuzWkkrlBVYU5FlyWTD3BPAQUCBob9pZYcou2t9q3FlhEgTSDjxcJIxz84JuwIKPZ5csJgN0xnKAf7APTkzdV91ef0ryxaCC4VGnulLb4VGnuhhQUpa5vX4+7nSv2HZZFAAIIXPBcCSpkAO4ddep35mc9qdq7Jz1qmNOl5SqbUiJYMzpkhyznpQQIxPT/tvjU3qqkQeVCAghczFADv7NyMQ9b2LF+14/COD3LypSUImHYIzB6XoQoYSMOWe8SRCOWa9KCRmbcs9FGGNJAL6gIoHDf9+bPPaRiXsPGOdfA4AAAJX1b19ZjISPBkLhXKvFBM45Zjw+PnjbHlQZe4MScnvaNVe/xmKWjbKIhYCC67fGgmFFvawRvOXzB44CXMwxGwVN1zEx5VJHHbOLOiENlPEt7jlfqdWSI4uCAM98AFdv3g0yxk5qnHe5vb5DRpMsGWWJRJZUDI06cc895yIKjoz1nY/EjowX23otJrN5kUQ9GhRFOhQO6x9c/qjuCgA0ddiOGCShXWOsglLqZYyftZQ7Pv3u8GG9seP6JqPEP9d1tg8ABIH26kx97+eWveOvd3cLgcmyDyklxxlj60VK7UuafrKnta4biKZ3Bln8TNO15ymhBg5ACYWe6WvbF0hybXOnjTd32rK2lFP1///KZlajngKmq7h8UCAEOufI5kIRaHwuGgeoc46uY7UZBUrUsa5rcd+rfoqfAqarVQ+YdLOwrCHHPC7dcMHpiR6JZRssaNpRiOqydRmDA1YA/P7qNPpHPKjfXoqm2kpwDthdPnzVZ0dDVRCv1W7MHuCQYx79Ix682bgNJoMUs28tyUNJ/hpc+HUYmwpzMubJpBi8dMOF+u2lMTiH2weHO5pUmg0S6qtLcfmmKyNwQOJJQsmC3R1Yc2B3ZQzuh99GAACHGqpQWmBFedE6XBqYSNpQn5QEShZWBLzYssf68ulrYQCGqGWlKxAS6WndY0wHZPk47Wmte+w9S1IMSpTesrt8NVtL8lBWYMWhhioAQGlB9EpucnYeskiG04H7N0qKQUVX23oH7eFQRI2BLcOFwip6ByfD4SXelinAlO599fQfp4mAE/t2lBsritaBI+q53sHJMOP8zI/v17ak2/EZW4QDwDt1hsdO8YqFTaf6XzGJ4seqzqsBQBbJkBLh7T2ttT+lCwcAZ68thQDgeK1sfhL/y5r+AmE7+eBmriYAAAAAAElFTkSuQmCC" />


                    <div class="titilemaster">Meal Plan</div>


                </a>
                <?php } ?>













                <?php if (strpos($LoginUserDetails["permissionView"], 'Hotel') !== false) { ?>


                <a href="display.html?ga=hotel">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAAC60lEQVRYhe2XTU8TURSG3/vRL2cKmFhaNQFBxI9gXCgKNQHUEMMC/4Ablrp1YRSMaYyY4C9wY8LehQsXSiIRBIkkmrjQqA3ExmigNijQln4wc48LKaIptXVK6GKe3Z05751nbnLOZIAy0nN3qrPn7lRnOfeU5dyMFG4SGAEYL9eerJTi3Ok8vhpcF+gKPZNul3uYGHoBVK1dXmaER+lMum8sdMYolC+LYM+d5z4lnC0guv0rxW5wM/v2cX9HDADODb70S0FjAA6tRT4YJusaHWiLFpMvBC9GkJhDA9F9AEEAQRANKyarc/dHB9qiIIQ3JD7m5IrJWxZ8cr09whgN5taM0a2R68GZjTUM+AHOO8B5ByO2WGp+M4puEiKug+gyABC4nucl+jYsJ0rNb0ZJTfI3F4YmvVmSxzhnrZqLn1k1qc1U5JScv0lnzXET9MpUfGq0/9TC/z6jaMGu0DPpcmsHAeP4DrfsVgqdhqH8/p2eRFNA1xr8uqvOp2OHS+BzLIlINJmdmYsnIrGkBkYppxDTKxnjCRFeeZ3q9YMrwZQlwe6hyT1C8dPSIc46BD+dNVRzlUdmGv1eR2NA99T7NOzz6RCi8DsqIswvpvE5lsCnaDIzG42n5r6vaA4p5knRy/QqPWWMv2hPt74PhZjKK9g9NLmHkTjuYKzV6RAdq6Y64ZCM1+3SjQO7vfr+gM4aA144ZVE99U9MRfiysILZ+Thm5xOpSCxuLCUNp1PycNYwJwxTTQPy9ci1k+8kAHASX5v3Vi01767S99VqoqFWh+Yu60fmDwRnqPdpqPdpOHsUHgBIpg18+pY4GvmWPBKeW74Y/rpcDYCtW1zpPVzUXNoqNLdES10NWupqBLC3+tK9aQBFzsHtxBa0St5OGJmhgqHzTb9Hy1bV5qj4E7QFrWILWiVvF+frps3YqtocFX+CFS9oD2qr2IJWsQWtYnlQl4I9qLcDW9AqtqBV1sdM7k++3Dx8uiXbVg4/AQanLyudTyMxAAAAAElFTkSuQmCC" />


                    <div class="titilemaster">Hotel</div>


                </a>


                <?php } ?>















                <?php if (strpos($LoginUserDetails["permissionView"], 'Activity') !== false) { ?>


                <a href="display.html?ga=activity">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAFgElEQVR4nO2aWWxUZRTHf+fOdEs7XSAtXWhpSIEwwcQYLBElMUQN8IC8dIZSKpC4sccNDShMjOAOgiGgRtF0Sql9MGiM0Qd9EB4a4oMkLKIxEKlpwwNbS+kwc48Pd4ZUaOcOcGdG6f0lk7lz75n/d8655zvfNwu4uLi4uLi4uLiMTSRxEAzrYWB2Fn3JGKIcOtAqcwCMYefHRPAAKjyUOPbeePHpWZl1JtN83P3v18bIZmOHmyogwcHj0Hc5k66kj0ofLPSPfG3UCrhbggfoTRLLqBWQoHOpiJ3Nf5lgWDXZ9THfA7KagGBY1e4OpRvbKeAES9p1sqm8iYeXDzTL6WS2izu0XmO85RE27m+RP9PtW0YSYCqbFQJEuQYsTZwfqb9olDcQgjFlEFiRbt8ykoBYjE2Gl2viYYudrXjZoCaDZpRQJnzLSAK6lkkP8BRAU1jvEXhGYC4wKW5yGuFHQ9jb0SzHEraZIC0JiM/5zbEYm+LBs3yf5g/m8D6wkmEfwuL4UfymsjrYrrsLIrz0+Qq5CtD0hdZ4PGw1hNfT0RPSsgrElG0KywyvVcbL92n+lVy+BVYBQ8AHQOOVAQqvDFAINCLsRImgrLmSy9fzd2kegOElpLAspmxLh69pqQDx8IpGiSbm/GAu74oyF+gxDBZ0LJGjN7zlCHCkeb9+Zpp8J8qjvnG8A6wXgy0apUC8vJoOX9OSgPhStxSgKax+lFUoQ4ZnxOCv07FEjgbbdAHQLcLq5v26p6NZTjJs5XCatG+ERHkSMFT4KFnwCTpb5VcMPgE8pqa/Gd5RBTz8k3qrzvKIaTAPZabCZIEywFC4YCinFKZhnehMVdcUOg1lDSati9u00RSmCpQC1xB6UPpU6cbgG83hcFdAYrcbw20lYOGn6ivIYx1nWW8K5cQ3s8Nbu0CFChWJ1yp0LW7T3TnKzrYnZGAk3ZawFseU59Xk2bhIuUL5MN1clKnAVBHmoLwoQ5wLhPU9zeXDroAM3most5yAQJsuEmEvMAGB0nyYVAYTS6AwD4pyLbv+CAwMwdmLcOY8XLhKtQpbh4SVwXZd09kiB4frBtu1KarsQqgES7d+PFQVQVkB5HhABIaicOkq9FyydM8PUi7wtkRYF2zX5zpbpCstCQiF1DjewA6BdQDlRTCrFqqLR7YvzbceNSUwqw7+vgjdZ+FcPxNRvgqGdfv0P9hwzI8YEXagrAWYUAQza6FmFN1cD/jyLN3GWui5CL/0QO9lalA6A+16r/93XguFxHQsAaGQGicb6BAIGAKz62F6xc27mWRUl8CiEjjRB4fPIKq8cKKBCk8EUVjqEWisgxmVt6ZbU2JpH+uF7r+QmMnGEw1MafpSm1PpDSkl4MQUtqME8jzw2FSoGuXu2CGAfwKUFsAPpyASo1UBrwHzp92Z7oxKGF8I3/8GkRhNRoRe4tWaDNtlMNiuj6OsF7mz4IdTXWxpGfFbfV+NM7pVPpg37bru2kCbLrJ7j20CVNkD8GC9M04mqC6GB+qs42N9EE1pxtpT6bOmKICI5XsybBMgUFVeZM15p/FXQnkhDETgaK9zutMrrGYK1oqSjJR2grNqb60xpYpgNT6wmqNTX44JcH9dara2CSjNH32pc4KaYigpsKqg56JzutU+q9naYZuASWVOuJOc+lLrueeSs7qTx9nb2CZgYokTrqQ2Rl+/s7qVPnsb2wT48pxwJTmF8TH6I87qlubb29gmoCDXCVeSUxgf4+o1Z3Xzc+xtbBOQk4GfThJjOLUXSOBNwXf3p7FsO5Bt3ARk24FsY/tx+Mb/1KSbTI83agWkson4v5AsllErYLT/1NxtuD3gxhOZnoPZ5noFiHIom45kmJ+z7YCLi4uLi4uLi0u2+Qdzfp67OkOOLgAAAABJRU5ErkJggg==" />


                    <div class="titilemaster">Activity</div>


                </a>


                <?php } ?>















                <?php if (strpos($LoginUserDetails["permissionView"], 'Transfer') !== false) { ?>


                <a href="display.html?ga=transfer">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAADiUlEQVRYhe2XT2gUVxzHv2/e29lJZrPZf6ao2V1bKlFZLVZMrA3xIkpDUQSlvUTotYjSg38oCDlGPSXVkydtjwUv/gUvihoTFBVpmoD4J0KR4CZZZ3c2bmbe6yHummb+bAYniZX9nOa995vf7zPze8PMADVq1Ph/Q6oFfNfT3yfL7OepkkH9LKzI1DSmjd8uHd36i1ucq2Dnqf6DdQHWe6CzBellIZCqlzM/hACej+Vx+sowCiVy4NqRzWecYiW3RAFKf93dlsSqJv/kAIAQ4PPPQtjdmoLCxHG3WGdBISSToymTjPhnNocN6QgMLpq6uwVzinEU3HHq9j5VYYiG5IWxAxBRZagKw93g4B6nGEdBSbCuTDLsY2PtyTQ3EiLx/Y4eTgt1stSRSS1ce8tk0hEoQdbhtG4ruK/7r1DJ4A2rV4QXzuwdLSvDKE2b4V0nbjXYrdsK5pTJn+JhRahBx73rG/UyQ6JBEW9J0LbNtoKM0h++SkcWfP+V2bAqQhgxf7Rbq0h0nhz4HgTnTZNHA0zCtMEXyw8AwKgEw+SgVBrnQnRdPbLlMgC87yHBuW+/bonGG223wqKRndRidx6MnAeQAGa12DR5bKnlACAeaYBh8nh5XBGkVBrPTmpLYzWL7KQGRqVseVxpMRei6/aDkd9Nk8f2bG9dErkL1wfBqJTlJu+yCL7blPGdPf2iPJdqJOhIE0AAN0YFXuYE/MAt76XDbYnZsa5fMx0pAjUAqPLMsV94yesq+DHg+qq4MSqwLUUgANx88b4N47k8Hg49Ra4wNa8ijSEFG9d9gWg45JrXs+DLnMAfj60Jhp6MYtfm5di6pqnqP4MAcGd4DFcfjaJ90zrXvHZ4bjHnAhOajtYvE9V/aDDzqmpbncCEpoNz7w+ZZ0GtUERMDSLA5n8qoxKioSDyetFrOe+CubyOlQnVc6HmWD1yeR8EGZVQfFtyPEHL60gn6jwXSi+rg6YVHNeLUyVQar1flhkhgEd/P0Nxyl4yX9DRHK/3LNgcU5HXdUe5h8PPZorPwfIUm5xjRVzFzXtD0G0kqURw+vIbz4IAQAnBheuDlvl6RcbadAKvXueqCwJA+/ok2tcnK+PePwdw7dg3vn7A7uzpF4f2tv1n7v7IP5Y4S4sJgVksGZVxsWSAEGLMjftQ5lvHcgcDAdZ39uL9g4KDAgCRYMqM9fktuFh1atT45PkXqo0v3jOt3KgAAAAASUVORK5CYII=" />


                    <div class="titilemaster">Transfer</div>


                </a>


                <?php } ?>


                <a href="display.html?ga=dayitinerarysmaster">


                    <img
                        src="data:image/png;base64,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">


                    <div class="titilemaster">Day Itinerary</div>


                </a>


                <?php if ($_SESSION['userid'] == 1) { ?>
                <a href="display.html?ga=leadsource">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAACf0lEQVRYhe2W30tTYRyHn52dqS2n1YbJXMG2WkwhKdHootASDMOom5Do51W77cL/Iaigq9qlhHUVGKwLL0orKnOaXQil1TJbSjrXD380nO6sq4ntlJ73NC3oPFfj8HnP99n7cj7ngIGBgcH/jUl0QeOl8E0lpTSnSUtig0yKxSzdCrXUnBJZJ4vpgZJSmpsOVElmSciPlKJIoc7nJwAhQbEpQJq0sByAWZIQ3XXQsYMA7ffCepbpQpdgMLBH17BAsEd4jfhZrTH/vKCstzayWUgpdA9Ncicc5crZqlz5IYvWxu8ekBsPhumLxFGUdM7kAGS9tZHN3h0OfE4bbQ+Hl801XOzW9A8yxS5DbmrD7yqmPxJfMXesvkbT/TLFLoP+2lhNMsWuqwf/BNHTUgn2vpkk1DdKfHoOl93KyVo3W+zrcyInelKBYI9aMDY1x5k6Dw5bAa1dEW4/+cCFI/6cCGbT8WKMzoFPJJIp3CWFnK7z4LDl/5RRCTZWlS3+9jlt9L79rHngbq+doNeuOe/ZXMj+ip0k5xWu3h0kFP7IuYPe5QUzzCTmeToYo3qbQ/NAUXzOIgCseWArsFCQZ1Zlfik49iXB9Y7XODdZObxkR3PN1Pd52p9FGfuaoHidhaZqlyqjaujo5CyX219S7bUTaPBhNgt/dGtGlk14SgvxlxURGZ/m8asJdSb7Qtuj91S6N1JfWUoiuQCANX912siaJ7OvvAQAm1Um1DvKoV3O5QWjsVlGJmboHootXlutIu+PxKnYuoFEMsXAyDdcdqsqoxK8dl7bqygX3B8Yp7XrHRazxHZnEcdr3arMmr9JltJytHzFjEnr14WBgYGBwd/hB6ckytNUe6kNAAAAAElFTkSuQmCC" />


                    <div class="titilemaster">Lead Source</div>


                </a>
                <?php } ?>













                <?php if ($_SESSION['userid'] == 1) { ?>
                <a href="display.html?ga=package-theme">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAAA+0lEQVRYhe2XMQ7CMAwAXdSfwBtA7EiFEYlHsLHyBBi78QikjqhSdyhvKG+BKVVqkTauSfDgm1LFUk+2FScACo/ELLLT/R3zx+VxmQxHAaT2x3Y1D2ODKKqnd+wkoMdPUEEunR7MZl59y6ao/GPFZ1C8YOraKJv+YxG3AzXeF/EZVEEuzh7E4PFEOSq+xQ/NfjOrvQUBAA67Bc1qJPm1btfiS6yCXEg9uJnGmdW5tRafQfGCzhLj2YnPsdurf/bidqDGG8RnULxgp8T7S+2K+xut4NA7Nfa72SC+xCrIRQW5qCAX0nXLhnr1GntVE59B8YKkEq/Pj1AeSjA+gOAsUZYz9cUAAAAASUVORK5CYII=" />


                    <div class="titilemaster">Package Theme</div>


                </a>

                <?php } ?>


                <a href="display.html?ga=mailsetting">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAACQElEQVRYhe2X309SYRiAn3NABRESkJ/nQHDA1BFbc2Zzqwu3Wtf9N/0J/Tddt1w3Lls5W0tJjF/iAVLGQPEo5Uy7cLg5qdCjkdt57r7tO+/77Hvf93z7wMDA4GYjADx98e641yKdePV8RjC3F88eT/fS5Rwv5z4AIPbY468Ygnq5OYLzS2kaO1ovXQBo7GjML6VP16dTrMheFpdz2AYHSN4J4xga/Kdi2n6LL7ky9W2NsahErdE8Kyj5XAQ8ToqVGm8/ruF22kmOhrBaBq5VrPXjgLVCmUp1m3jYz1RCQRRFPqULZwUBRFEgKnsIBVxki5u8eZ8iInkYjQToN5s7Jrgsh4c/yZeqZIrfCPndPJlJ0td3PkfHrGaTiXFFIhL0kF4vM7ewTDzsJxb2YRL1zdXR0THFSo3VfIkRp53Z6QSD1t9X6Y/HYrH0c288SizUYjVf5vXCZ8YiEhF5BOHkluyeYyhX66SyKjbrAA8nx7rq867qZrdZmU7Gqe9opDIlcuomE4qE5HN15VatN0l9VRFMApOJKCPDjq6+61qwjevWEI+mxqnWm6xkNsiqW9yNy7iH7R33N5oaqYzK94NDJhSJoM910XO/mGAbr8vB7IMEG5Uaiys5nHYb0ZCPYcdJybab+xTULRq7e0woEuHgJVpCjyCAgMDtoIeQ3816pUY6V2Z3rwWctIQccHM/GUPUOVS6/x2iKKLIXhTZqzdU5/jXEvUKMQT1YgjqxRDUiyGol/9e8PSqa7/kDQwMDK6WXxBznsSZBOWzAAAAAElFTkSuQmCC" />


                    <div class="titilemaster">Mail Setting</div>


                </a>


                <?php if ($_SESSION['userid'] == 1) { ?>


                <a href="#" onclick="loadpop('Edit organisation settings',this,'600px')" data-toggle="modal"
                    data-target=".bs-example-modal-center" popaction="action=organisationsettings">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAAA60lEQVRYhe2YMQ6CQBBFP4YD2RpDRQnxGPSWeAAo6T0GwZKKGFuP4S2w0sRil53dZRiTeS0L/OTvDi8AShgJ58tOl9tMWd83RZKuFcZElh2d1k3THQCwWzNMDMQHjFpxVXfWPfbyeGb0PXhtz8aDRz0kwB9ULD4g+5j5jA9XWAP2TUH+MIivWAOGIj5gCgCPPCcN0MM4ellQkM3sy9LppucwEGP9ojbDjdegtlmL7RqbzZiMpaq7WW1GGt+KQ8eHK1SbicqS8vsgvmINGIr4gKzKr/9mtkB8wOgVi7AZEzaTAdRmtkH8vxnxvAGSZ0YJC3KevAAAAABJRU5ErkJggg==" />


                    <div class="titilemaster">Org. Settings</div>


                </a>


                <a href="#" onclick="loadpop('Update default settings',this,'600px')" data-toggle="modal"
                    data-target=".bs-example-modal-center" popaction="action=setlogoandinclusion">


                    <img
                        src="data:image/png;base64,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" />


                    <div class="titilemaster">Default Settings</div>


                </a>


                <a href="display.html?ga=automation">


                    <img
                        src="data:image/png;base64,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" />


                    <div class="titilemaster">Automation</div>


                </a>


                <a href="display.html?ga=callbackrequest">


                    <img
                        src="data:image/png;base64,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" />


                    <div class="titilemaster">Call Back Request</div>


                </a>


                <a href="display.html?ga=branches">


                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAADx0lEQVRIie2XXWxTZRjH/+95T9sd2rqWuY5VmMoYjpXZUryQxERwi4Vlg5FAFSNDvTBk1xoMybCGyY3EC8OiNxo2qi5d1MCydhs4DFHxojvbQFeTfYQsc6PbKGxrZW3Pe443a1L7sS6AcCH/q/O8z8fvPCc553kO8IhEko26pm6LmnIOKSYvKIh2Xji1L5gt0e0VK96ssQ/fK5hLXDhPXnQZdPq+0k2lp8uee/ZzQdCL+109r2RKar80+K5CZPFeocByx3VN3RaDXtf3fOVWU8LBJAZxYHBCuX5rY0eHkwGAx/OrgAKhNV+nrV78+650YJfVlK1wLvEAoCLc7mJzcWGyg/IU+U/o826Wx8sB/PF170CZTEhP2XrT+ifX6lT+32/Mn/P6j6V3QkIKh8uHd28fzQlmkjzPpDhL2AnFJSYzmYUBQHXn7iQKBP/cnbChwKA1AkSSOaU/tSAnK2Yo5ONz3n6qUL6xwWGdyQQmALD3+PkiQdCL22xWM+UpACAcjiAwHBjyfFhtS074tlc8qlGrPpIYUzurbMZsHbX6xB0clNNxhdS/U2OfTbtBALhwal8wxuKHxYHBidGRkUggEAgFhgNDUiRWm5pw6FX7F0vR6MsSkzN2ktCRPfarMsh7KiKfWSkOAHDwoId+8s3VlubWn1/LFdvWM6TNWRCA2+f3nPX6S1PPuWSjo8PJ1hn52adNmqzvb0INDmtkNWAAXRxRdq4I/m/ETQKkOPWUzxT6IKWAMZKB8xA6zqzH4Mfg/wOYEEZA6cMHA9MyYeZHACY/EYWkTaVMWs2gmLgZWzcdipp2ui7/6+uVBl7eHDi3t//FXEU5JX7d3eWvzOSrO9ZZcsB18dr4bdoyNqc+YuLksfoTvVVZwQAQV7hGEPnTVp+4YyWwWsUb1+g0P7ZfGmhM9WkEoXNrpaWyfEv52k2bN6+xb7OVaFR8235XjwlIWW+T9ZVXLFQTuWXZ7GJE+Ss1RqfJa99uKSkYn5y7PRNa/CXGyOsNDmuk/gPfM8ZCw28VFVuKkuODwaA0Pjp+9PvmPV9mnU7L64rzrNdfSjns4hS8BELykmMIgYoQgnytoJu5tWihRDYDGIlzTMdTmtYUpTwFiAFYxVh8q+aFMQBjmXzf9V17e+RGUA4thK/EZO6NBoctAgARtfbP+YXFJSYxJHY4AJiamp5VIHmBFR71auTu7o9SQt4/5LB/luqrP9FbpVHxbRs2PGWilKdTU9Oz0djSGU9T9cn7B+f4jdl7/HwRx6lrKU/zZSnm+6G5NnA/vAeifwBGHV/UAG55tgAAAABJRU5ErkJggg==">


                    <div class="titilemaster">Branches</div>


                </a>


                <a href="display.html?ga=roles">


                    <img
                        src="data:image/png;base64,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">


                    <div class="titilemaster">Roles</div>


                </a>


                <?php } ?>


            </div>


        </div>


        <div class="contnetin createnotification">


            <div class="head17" style="position:relative;">Notifications<i class="fa fa-times" aria-hidden="true"
                    style="position: absolute; right: 0px; top: -5px; color: #666666; font-size: 18px; cursor: pointer;"
                    onclick="closeusermenu();"></i></div>


            <div id="loadnotificationscreate" style="height:600px;">


            </div>


        </div>

        <div class="contnetin showreminders">

            <div class="head17" style="position:relative;">Reminders<i class="fa fa-close" aria-hidden="true"
                    style="position: absolute; right: 0px; top: -5px; color: #666666; font-size: 18px; cursor: pointer;"
                    onclick="closeusermenu();"></i>
            </div>

            <div id="loadreminders" style="height:600px;">

            </div>

        </div>

    </div>


</div>


</div>


<div class="header-bg sticky">


    <!-- Navigation Bar-->


    <header id="topnav">


        <!-- end topbar-main -->
        <!-- MENU Start -->


        <div class="navbar-custom">


            <div class="container-fluid">


                <!-- Logo-->


                <div class="d-none d-lg-block">


                    <!-- Text Logo



                        <a href="index.html" class="logo">



                            Foxia



                        </a>



                         -->
                    <!-- Image Logo -->


                    <a href="<?php echo $fullurl; ?>" class="logo">


                    </a>


                </div>


                <!-- End Logo-->


                <div id="navigation">


                    <!-- Navigation Menu-->


                    <ul class="navigation-menu">


                        <li class="has-submenu"><a href="<?php echo $fullurl; ?>"><i
                                    class="dripicons-meter"></i>Dashboard</a>
                        </li>


                        <?php if (strpos($LoginUserDetails["permissionView"], 'Query') !== false) { ?>
                        <li class="has-submenu<?php if ($selectedmenu == 4) { ?> active<?php } ?>"><a
                                href="display.html?ga=query"><i class="dripicons-archive"></i>Query</a>
                        </li><?php } ?>



                        <?php if (strpos($LoginUserDetails["permissionView"], 'Itinerary') !== false) { ?>
                        <li class="has-submenu<?php if ($selectedmenu == 2) { ?> active<?php } ?>"><a
                                href="display.html?ga=itineraries"><i class="dripicons-briefcase"></i>Itineraries</a>
                        </li><?php } ?>


                        <?php if (strpos($LoginUserDetails["permissionView"], 'Client') !== false) { ?>
                        <li class="has-submenu<?php if ($selectedmenu == 3) { ?> active<?php } ?>"><a
                                href="display.html?ga=clients"><i class="dripicons-user"></i>Clients</a>
                        </li><?php } ?>


                        <li class="has-submenu<?php if ($selectedmenu == 8) { ?> active<?php } ?>"><a
                                href="display.html?ga=collection"><i class="dripicons-briefcase"></i>Collection </a>
                        </li>
                        <li class="has-submenu<?php if ($selectedmenu == 9) { ?> active<?php } ?>"><a
                                href="display.html?ga=taggings"><i class="dripicons-briefcase"></i>Taggings</a></li>


                        <?php if ($_SESSION['userid'] == 1 || $_SESSION['userid'] == 4045) { ?>



                        <li class="has-submenu<?php if ($_REQUEST['ga'] == 'company-expense') { ?> active<?php } ?>"><a
                                href="display.html?ga=company-expense"><i class="dripicons-export"></i>Expenses</a>
                        </li><?php } ?>







                        <?php if (strpos($LoginUserDetails["permissionView"], 'Report') !== false) { ?>
                        <li class="has-submenu"><a href="#"><i class="dripicons-graph-pie"></i>Reports</a>


                            <ul class="submenu">
                                <!--



                        <li><a href="display.html?ga=systemreport">System Report</a></li> -->


                                <li><a href="display.html?ga=attandancesreport">Attandance Report</a></li>


                                <li><a href="display.html?ga=notesreport">Notes Report</a></li>


                                <li><a href="display.html?ga=collectreport">Collection Report</a></li>


                                <li><a href="display.html?ga=travelreport">Tours Report</a></li>


                                <li><a href="display.html?ga=todoreport">Task's / Followup's Report</a></li>


                                <li><a href="display.html?ga=misreport">MIS Report</a></li>

                                <li><a href="display.html?ga=leisurereport">Ledger Report</a></li>
                                <li><a href="display.html?ga=masterreport">Master Report</a></li>

                                <?php
                                    $b = GetPageRecord('*', 'roleMaster', 'id=(select branchId from sys_userMaster where id="'                                      . $_SESSION['userid'] . '")');
                                    $clientData = mysqli_fetch_assoc($b);

                                    $c = GetPageRecord('*', 'sys_userMaster', 'id=1');
                                    $adminData = mysqli_fetch_assoc($c);

                                    if ($clientData['name'] == 'Accounts' ||  $adminData['roleId'] == 1) { ?>

                                <li><a href="display.html?ga=verifyreceipts">Verification Report</a></li>
                                <?php } ?>


                            </ul>
                        </li><?php } ?>



















                        <?php if ($_SESSION['userid'] == 1 || $_SESSION['userid'] == 4045 || strpos($LoginUserDetails["permissionView"], 'ManualVoucher') !== false) { ?>


                        <li class="has-submenu<?php if ($selectedmenu == 6) { ?> active<?php } ?>"><a
                                style="cursor:pointer;"><i class="fa fa-globe" aria-hidden="true"></i>Marketing</a>


                            <ul class="submenu" style="left:80px;top: -80px;">


                                <li><a href="display.html?ga=maketing-dashboard">Maketing Dashboard</a></li>


                                <li><a href="display.html?ga=clients-group">Clients Group</a></li>


                                <li><a href="display.html?ga=mailing-templates">Email Templates</a></li>


                                <li><a href="display.html?ga=campaigns">Campaigns</a></li>


                                <li><a href="display.html?ga=landingpages">Landing Pages</a></li>


                            </ul>
                        </li>


                        <?php if ($withwebsite == 'yes') { ?>


                        <li class="has-submenu<?php if ($selectedmenu == 6) { ?> active<?php } ?>"><a
                                style="cursor:pointer;"><i class="fa fa-desktop" aria-hidden="true"></i>Website</a>


                            <ul class="submenu" style="left:80px;top: -230px;">


                                <li><a href="display.html?ga=website-setting">Website Setting</a></li>


                                <li><a href="display.html?ga=cms-pages">CMS Pages</a></li>


                                <li><a href="display.html?ga=home-banner">Home Banner</a></li>


                                <li><a href="display.html?ga=testimonials">Testimonials</a></li>


                                <li><a href="display.html?ga=website-destinations">Website Destinations</a></li>


                                <li><a href="display.html?ga=about-website-destinations">About Destinations</a>
                                </li>


                                <li><a href="display.html?ga=website-photo-gallery">Photo Gallery</a></li>


                                <li><a href="display.html?ga=website-blog">Website Blog</a></li>


                            </ul>
                        </li>


                        <?php } ?>


                        <?php } ?>


                    </ul>


                    <!-- End navigation menu -->


                </div>


                <!-- end #navigation -->


            </div>


            <!-- end container -->


        </div>


        <!-- end navbar-custom -->


    </header>


</div>


<div class="alert alert-success bg-success text-white headersavealert" role="alert"
    style=" display:none; <?php if ($_REQUEST['save'] == 3) { ?> display:block;<?php } ?>">Congratulations! Your
    itinerary has been successfully shared
</div>


<div class="alert alert-success bg-success text-white headersavealert" role="alert"
    style=" display:none; <?php if ($_REQUEST['save'] == 1) { ?> display:block;<?php } ?>">Successfully Save
</div>

<?php if ($_SESSION['break_scheduled'] == 1) { ?>
<div class="alert alert-success bg-success text-white headersavealert" role="alert" style="display:block">Activity
    Scheduled Successfully
</div>
<?php }
unset($_SESSION['break_scheduled']); ?>


<?php if ($LoginUserDetails['fromName'] == '' || $LoginUserDetails['emailAccount'] == '' || $LoginUserDetails['emailPassword'] == '' || $LoginUserDetails['smtpServer'] == '' || $LoginUserDetails['emailPort'] == '') { ?>


<div class="alert alert-success bg-success text-white" role="alert"
    style="display: block; background-color: #a7193a !important; margin-top: -58px; text-align: center; position: fixed; width: 100%; border-radius: 0px; padding-top: 22px; padding-bottom: 3px;">
    Please update mail setting! <a href="display.html?ga=mailsetting"
        style="color:#fff; text-decoration:underline;">Click Here</a></div>


<?php } ?>

<script>
function cancelSchedule(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You Want To Cancel Your Scheduled Activity !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes'
    }).then(function(e) {
        if (e.isConfirmed) {
            $.ajax({
                type: 'post',
                url: 'actionpage.php',
                data: {
                    id: id,
                    action: 'cancelSchedule'
                },
                success: function(response) {
                    if (response.success === true) {
                        Swal.fire("Success", response.msg, "success");
                        setTimeout(function() {
                            window.location.reload();
                        }, 1200);
                    } else {
                        Swal.fire("Error", response.msg, "error");
                    }
                }
            });
        }
    });
}
</script>
<script>






function openusermenu() {


    $('.rnblk').show();


    $('.headerslideright').show("slide", {
        direction: "right"
    }, 100);


    $('html').css('overflow', 'hidden');


}


function closeusermenu() {


    $('.headerslideright').hide("slide", {
        direction: "right"
    }, 100);


    $('html').css('overflow', 'visible');


    $('.rnblk').hide();


}
</script>

<?php
$a=GetPageRecord('SUM(totalMinutes) as totalMinutes','userLogs',' checkoutTime is not null and  userId="'.$_SESSION['userid'].'" and date(cLogin)="'.date('Y-m-d').'"');
$rest=mysqli_fetch_array($a);

 $workingminutes = 0;

$break_time = GetPageRecord('end_time', 'useractivities', 'activity_type="1" and user_id="' . $_SESSION['userid'] . '" and date(add_date)="' . date('Y-m-d') . '"');
$break_rest=mysqli_fetch_array($break_time);

$breakmins=0;
if($break_rest && $break_rest['end_time']){
    $breaktimeseconds = strtotime($break_rest['end_time']) - strtotime('00:00:00');
    $breakmins =  round($breaktimeseconds/ 60);
}

$workingminutes = $rest['totalMinutes'] - $breakmins;
?>
