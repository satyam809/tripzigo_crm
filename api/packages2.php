<?php
include "../config/database.php";
include "../config/function.php";
include "../config/setting.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
header('Access-Control-Max-Age: 1728000');
header('Content-Type: application/json');
 mysqli_set_charset(db(), "utf8");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

        if(isset($_GET['package_id']) && trim($_GET['package_id'])!=""){
            $data_query = "select i.id,i.name, i.relate_key, i.keywords, i.description, i.aboutPackage, i.coverPhoto as cover_image, i.sliderPhoto1, i.imgAlt1, i.sliderPhoto2, i.imgAlt2, i.sliderPhoto3, i.imgAlt3, i.sliderPhoto4, i.imgAlt4, i.sliderPhoto5, i.imgAlt5, i.sliderPhoto6, i.imgAlt6, i.mapURL,i.web_pack_price, i.startDate as start_date, i.endDate as end_date, i.days as duration, i.adult, i.child, i.destinations, i.location, i.notes, i.hotel as star_rating, i.hotel, i.grossNoGSTPrice as total_price, i.grossPrice as gross_price, i.totaligst + i.totalsgst + i.totalcgst as gst_amount, i.grosstcs as tcs_amount, i.totalDiscount as discount, i.destination_type, i.tour_type, i.activity_type, i.landscape_type, i.dateAdded,i.slug,i.package_rating,i.hotel_facility  from sys_packageBuilder i where i.website_visible=1 and queryId=0 and archiveThis=0 and i.id=".$_GET['package_id']." ";
            $data_rs = mysqli_query(db(), $data_query) or die(mysqli_error());
            $data_item = mysqli_fetch_array($data_rs,MYSQLI_ASSOC);      
            if($data_item){                
                $data_tags_rs = mysqli_query(db(), "select t.name from Taggings ts, Tags t where t.id=ts.tags_id and ts.taggable_type='itinerary' and ts.tagable_id=".$_GET['package_id']) or die(mysqli_error());
                $data_tags = mysqli_fetch_all($data_tags_rs,MYSQLI_ASSOC);             
                $data_item["tags"]=$data_tags;
                $data_item["total_price"]=number_format((float)$data_item["total_price"], 2, '.', ''); 
                $data_item["gross_price"]=number_format((float)$data_item["gross_price"], 2, '.', ''); 
                $data_item["gst_amount"]=number_format((float)$data_item["gst_amount"], 2, '.', ''); 
                $data_item["tcs_amount"]=number_format((float)$data_item["tcs_amount"], 2, '.', ''); 
                $data_item["discount"]=number_format((float)$data_item["discount"], 2, '.', ''); 
                // $data_item["cover_image"]= ($data_item["cover_image"])?$fullurl."package_image/".str_replace('','',$data_item["cover_image"]): "";
                $data_image_rs = mysqli_query(db(), "select image_path from sys_packageBuilder_image where itinerary_id=".$data_item['id']) or die(mysqli_error());
                $data_images = mysqli_fetch_all($data_image_rs,MYSQLI_ASSOC);             
                $data_item["data_images"]=$data_images;
                
                  $days_event = [];
                    $n = 1;
                    $begin = new DateTime($data_item['start_date']);
                    $end = new DateTime($data_item['end_date']);
                    
                    // Prepare the query to fetch events for the given package_id and packageDays range
                    $q = "SELECT * FROM sys_packageBuilderEvent WHERE packageId=" . $_GET['package_id'] . " AND packageDays BETWEEN $n AND " . ($n + $end->diff($begin)->days);
                    
                    $event_rs = mysqli_query(db(), $q) or die(mysqli_error());
                    $events_data = mysqli_fetch_all($event_rs, MYSQLI_ASSOC);
                    
                    // Reorganize the events data into a structure indexed by packageDays
                    $events_by_day = [];
                    foreach ($events_data as $event) {
                        $packageDay = $event['packageDays'];
                        $events_by_day[$packageDay][] = $event;
                    }
                    
                    // Populate the $days_event array with events data
                    for ($i = $n; $i <= $end->diff($begin)->days + 1; $i++) {
                        $days_event[] = $events_by_day[$i];
                    }
                    
                    $data_item["days_event"] = $days_event;
              
                // $days_event=[];
                // $n=1;
                // $begin = new DateTime( $data_item['start_date'] );
                // $end   = new DateTime( $data_item['end_date'] );
                // for($i = $begin; $i <= $end; $i->modify('+1 day')){
                //     $q="select * from sys_packageBuilderEvent where packageId=".$_GET['package_id']." and packageDays=".$n;
                //     $event_rs = mysqli_query(db(), $q) or die(mysqli_error());
                //     $event=mysqli_fetch_all($event_rs,MYSQLI_ASSOC);
                //     $days_event[]=$event;
                //     $n++;
                // }
                // $data_item["days_event"]=$days_event;
    
                $q="select * from sys_PackageTips where packageId=".$_GET['package_id']." order by id asc";
                $tips_rs = mysqli_query(db(), $q) or die(mysqli_error());
                $packageTipsData=mysqli_fetch_all($tips_rs,MYSQLI_ASSOC); 
                $data_item["package_terms"]=$packageTipsData;

                $q="select * from sys_packageFAQs where packageId=".$_GET['package_id']." order by id asc";
                $FAQ_rs = mysqli_query(db(), $q) or die(mysqli_error());
                $packageFAQsData=mysqli_fetch_all($FAQ_rs,MYSQLI_ASSOC); 
                $data_item["package_FAQs"]=$packageFAQsData;

            }
            $response["package_baseurl"]= $fullurl."package_image/";
            $response["data"]=$data_item;
            echo json_encode($response); 
             
        }else{
            $query_flug=0;
            $data_query = "select distinct i.id,i.name,i.description,i.relate_key, i.keywords, i.coverPhoto as cover_image, i.startDate as start_date, i.endDate as end_date, i.days as duration, i.adult, i.child, i.destinations, i.location, i.notes, i.hotel as star_rating, i.hotel, i.grossNoGSTPrice as total_price,i.web_pack_price,i.grossPrice as gross_price, i.totaligst + i.totalsgst + i.totalcgst as gst_amount, i.grosstcs as tcs_amount, i.totalDiscount as discount, i.destination_type, i.destination_search, i.tour_type, i.activity_type, i.landscape_type, i.dateAdded,i.slug,i.package_rating,i.hotel_facility   from sys_packageBuilder i ";
            if(isset($_GET['q']) && trim($_GET['q'])!=""){
                $data_query .= ",Taggings ts, Tags t ";
            }
            $data_query .= "where 1 and i.website_visible=1 and queryId=0 and archiveThis=0 ";
            if(isset($_GET['ids']) && trim($_GET['ids'])!=""){
                $data_query .= "and i.id in (".$_GET['ids'].") ";
                $query_flug=1;
            }
            if(isset($_GET['q']) && trim($_GET['q'])!=""){
                $data_query .= "and (LOWER(i.name) like LOWER('%".$_GET['q']."%') or LOWER(i.destinations) like LOWER('%".$_GET['q']."%') or LOWER(i.location) like LOWER('%".$_GET['q']."%') or LOWER(i.description) like LOWER('%".$_GET['q']."%') or (i.id=ts.tagable_id and ts.taggable_type='itinerary' and ts.tags_id=t.id and LOWER(t.name) like LOWER('%".$_GET['q']."%'))) ";
                $query_flug=1;
            }
            if(isset($_GET['destination_type']) && trim($_GET['destination_type'])!=""){
                $data_query .= "and i.destination_type='".$_GET['destination_type']."' ";
                $query_flug=1;
            }
            if(isset($_GET['duration']) && trim($_GET['duration'])!=""){
                $duration_range=explode("_",$_GET['duration']);
                $data_query .= "and i.days between ".$duration_range[0]." and ".$duration_range[1]." ";
                $query_flug=1;
            }
            if(isset($_GET['tour_type']) && trim($_GET['tour_type'])!=""){
                $data_query .= "and i.tour_type='".$_GET['tour_type']."' ";
                $query_flug=1;
            }
            if(isset($_GET['activity_type']) && trim($_GET['activity_type'])!=""){
                $data_query .= "and i.activity_type='".$_GET['activity_type']."' ";
                $query_flug=1;
            }
            if(isset($_GET['landscape_type']) && trim($_GET['landscape_type'])!=""){
                $data_query .= "and i.landscape_type='".$_GET['landscape_type']."' ";
                $query_flug=1;
            }
            
            if(isset($_GET['budget']) && trim($_GET['budget'])!=""){
                $budget_range=explode("_",$_GET['budget']);
                $data_query .= "and i.grossNoGSTPrice between ".$budget_range[0]." and ".$budget_range[1]." ";
                $query_flug=1;
            }
            if(isset($_GET['order_by']) && trim($_GET['order_by'])!=""){
                $data_query .= " order by ".$_GET['order_by']." ";
                if(isset($_GET['order_by_type']) && trim($_GET['order_by_type'])!=""){
                    $data_query .= $_GET['order_by_type']." ";
                }
            }
            if(isset($_GET['page']) && trim($_GET['page'])!="" && isset($_GET['per_page']) && trim($_GET['per_page'])!=""){
                $data_count_rs = mysqli_query(db(), $data_query) or die(mysqli_error());
                $data_count = mysqli_fetch_all($data_count_rs,MYSQLI_ASSOC);
                $count=count($data_count);
                $pages=ceil($count/$_GET['per_page']);
                $meta['total']=$count;
                $meta['per_page']=$_GET['per_page'];
                $meta['pages']=$pages;
                $meta['current_page']=$_GET['page'];
                $response["data"]=[];
                $response["meta"]=$meta;
                $start=($_GET['page']*$_GET['per_page']) - $_GET['per_page'];
                $data_query .= "limit $start, ".$_GET['per_page'];
                $query_flug=1;      
            }
            if(!$query_flug){
                $data_query .= "limit 0, 0";
            }
            $data_rs = mysqli_query(db(), $data_query) or die(mysqli_error());
            $data_items=[];
            while($data_item = mysqli_fetch_array($data_rs,MYSQLI_ASSOC)){
                $data_tags_rs = mysqli_query(db(), "select t.name from Taggings ts, Tags t where t.id=ts.tags_id and ts.taggable_type='itinerary' and ts.tagable_id=".$data_item['id']) or die(mysqli_error());
                $data_tags = mysqli_fetch_all($data_tags_rs,MYSQLI_ASSOC);             
                $data_item["tags"]=$data_tags;
                $data_item["total_price"]=number_format((float)$data_item["total_price"], 2, '.', ''); 
                $data_item["gross_price"]=number_format((float)$data_item["gross_price"], 2, '.', ''); 
                $data_item["gst_amount"]=number_format((float)$data_item["gst_amount"], 2, '.', ''); 
                $data_item["tcs_amount"]=number_format((float)$data_item["tcs_amount"], 2, '.', ''); 
                $data_item["discount"]=number_format((float)$data_item["discount"], 2, '.', ''); 
                $data_image_rs = mysqli_query(db(), "select image_path from sys_packageBuilder_image where itinerary_id=".$data_item['id']) or die(mysqli_error());
                $data_images = mysqli_fetch_all($data_image_rs,MYSQLI_ASSOC);             
                $data_item["data_images"]=$data_images;
                  // $data_item["cover_image"]= ($data_item["cover_image"])?$fullurl."package_image/".str_replace('','',$data_item["cover_image"]): "";
                $data_items[]=$data_item;
            }
           

            $response["package_baseurl"]= $fullurl."package_image/";
            $response["data"]=$data_items;
            echo json_encode($response); 
        }       
        break;
    case 'POST':
        // echo "POST Method";
        break;
}
?>