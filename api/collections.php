<?php
include "../config/database.php";
include "../config/function.php";
include "../config/setting.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: token, Content-Type');
header('Access-Control-Max-Age: 1728000');
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $query_flug=0;
        $data_query = "select distinct c.* from Collection c ";
        if(isset($_GET['q']) && trim($_GET['q'])!=""){
            $data_query .= ",Taggings ts, Tags t ";
        }
        if((isset($_GET['duration']) && trim($_GET['duration'])!="") || (isset($_GET['tour_type']) && trim($_GET['tour_type'])!="") || (isset($_GET['activity_type']) && trim($_GET['activity_type'])!="") || (isset($_GET['landscape_type']) && trim($_GET['landscape_type'])!="") || (isset($_GET['budget']) && trim($_GET['budget'])!="")){
            $data_query .= ",Collection_itineraries ci, sys_packageBuilder i where 1 and i.publicly_visible=1 ";
        }else{
            $data_query .= " where 1 ";
        }  
        if(isset($_GET['ids']) && trim($_GET['ids'])!=""){
            $data_query .= "and c.id in (".$_GET['ids'].") ";
            $query_flug=1;
        }
        if(isset($_GET['q']) && trim($_GET['q'])!=""){
            $data_query .= "and (LOWER(c.name) like LOWER('%".$_GET['q']."%') or LOWER(c.location) like LOWER('%".$_GET['q']."%') or LOWER(c.description) like LOWER('%".$_GET['q']."%') or (c.id=ts.tagable_id and ts.taggable_type='collection' and ts.tags_id=t.id and LOWER(t.name) like LOWER('%".$_GET['q']."%'))) ";
            $query_flug=1;
        }
        if(isset($_GET['destination_type']) && trim($_GET['destination_type'])!=""){
            $data_query .= "and c.destination_type='".$_GET['destination_type']."' ";
            $query_flug=1;
        }
        if(isset($_GET['duration']) && trim($_GET['duration'])!=""){
            $duration_range=explode("_",$_GET['duration']);
            $data_query .= "and c.id=ci.collection_id and ci.itinerary_id=i.id and i.days between ".$duration_range[0]." and ".$duration_range[1]." ";
            $query_flug=1;
        }
        if(isset($_GET['location_type']) && trim($_GET['location_type'])!=""){
            $data_query .= "and c.location_type='".$_GET['location_type']."' ";
            $query_flug=1;
        }
        if(isset($_GET['tour_type']) && trim($_GET['tour_type'])!=""){
            $data_query .= "and c.id=ci.collection_id and ci.itinerary_id=i.id and i.tour_type = '".$_GET['tour_type']."' ";
            $query_flug=1;
        }
        if(isset($_GET['activity_type']) && trim($_GET['activity_type'])!=""){
            $data_query .= "and c.id=ci.collection_id and ci.itinerary_id=i.id and i.activity_type = '".$_GET['activity_type']."' ";
            $query_flug=1;
        }
        if(isset($_GET['landscape_type']) && trim($_GET['landscape_type'])!=""){
            $data_query .= "and c.id=ci.collection_id and ci.itinerary_id=i.id and i.landscape_type = '".$_GET['landscape_type']."' ";
            $query_flug=1;
        }
        
        if(isset($_GET['budget']) && trim($_GET['budget'])!=""){
            $budget_range=explode("_",$_GET['budget']);
            $data_query .= "and c.id=ci.collection_id and ci.itinerary_id=i.id and i.grossNoGSTPrice between ".$budget_range[0]." and ".$budget_range[1]." ";
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
            $data_tags_rs = mysqli_query(db(), "select t.name from Taggings ts, Tags t where t.id=ts.tags_id and ts.taggable_type='collection' and ts.tagable_id=".$data_item['id']) or die(mysqli_error());
            $data_tags = mysqli_fetch_all($data_tags_rs,MYSQLI_ASSOC);             
            $data_item["tags"]=$data_tags;
            
            $data_image_rs = mysqli_query(db(), "select image_path from Collection_image where collection_id=".$data_item['id']) or die(mysqli_error());
            $data_images = mysqli_fetch_all($data_image_rs,MYSQLI_ASSOC);             
            if($data_images){
                $data_item["cover_image"]=$data_images[0]['image_path'];
                $data_item["data_images"]=$data_images;
            }else{
                $data_item["cover_image"]="";
                $data_item["Images"]="";        
            }
          
            $data_itineraries_rs = mysqli_query(db(), "select min(i.hotel) as star_rating_min ,max(i.hotel) as star_rating_max, min(days) as duration_min, max(days) as duration_max , min(grossNoGSTPrice) as price_min, max(grossNoGSTPrice) as price_max from Collection_itineraries ci, sys_packageBuilder i where i.publicly_visible=1 and ci.itinerary_id=i.id and ci.collection_id=".$data_item['id']) or die(mysqli_error());
            $data_itinerary = mysqli_fetch_array($data_itineraries_rs,MYSQLI_ASSOC);             
            if($data_itinerary){
                $data_item["star_rating_range"]=$data_itinerary['star_rating_min']."_star__".$data_itinerary['star_rating_max']."_star";
                $data_item["duration_range"]=$data_itinerary['duration_min']."__".$data_itinerary['duration_max'];
                $data_item["price_range"]=$data_itinerary['price_min']."__".$data_itinerary['price_max'];
            }else{
                $data_item["star_rating_range"]="";
                $data_item["duration_range"]="";
                $data_item["price_range"]="";
            }
            $data_itinerary_rs = mysqli_query(db(), "select itinerary_id from Collection_itineraries ci,sys_packageBuilder i where ci.itinerary_id=i.id and i.publicly_visible=1 and ci.collection_id=".$data_item['id']) or die(mysqli_error());
            $data_itinerary = mysqli_fetch_all($data_itinerary_rs,MYSQLI_ASSOC);             
            $data_item["itineraries"]=$data_itinerary;
            $data_items[]=$data_item;
        }
        $response["collection_baseurl"]= $fullurl."collectionphotos/";
        $response["data"]=$data_items;
        echo json_encode($response); 
        break;       
    case 'POST':
        // echo "POST Method";
        break;
}
?>