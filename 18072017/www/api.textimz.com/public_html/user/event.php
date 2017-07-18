<?php
//to create, edit, delete(inactivate) a single event event

/**
$_POST[event_id] - 0/false or not set ->new event
$_POST[edit] - 1/true ->view/edit an event
				$_POST[edit] - 0/false or not set ->view
				$_POST[edit] - 1/true ->edit
*/

session_start();
require_once ('./functions.php');
check_login();
if(isset($_GET['id'])) {
    $event_id = intval($_GET['id']);
    $new_event = false;
        
    $res = get_event_details($event_id);
    if($res == null) {
        echo "Invalid ID No";
        exit();
    }
    if(isset($_GET['edit'])) {
        if($_GET['edit']=='true') {
            $edit = true;
            $title = "Edit event #$event_id";
        }
        else {
            $edit = false;
            $title = "View event #$event_id";
        }        
    }
    else {
        $edit = false;
        $title = "View event #$event_id";
    }
    
    $sql = "SELECT s_source FROM t_media_events where fk_i_item_id = $event_id ORDER BY pk_i_id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if($img= ($stmt->fetch(PDO::FETCH_ASSOC)));
        $img_loc = $img['s_source'];
}
else {
    $new_event = true;
    $edit = true;
    $title = "Add a new event";
}
?>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#999;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;border-top-width:1px;border-bottom-width:1px;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;border-top-width:1px;border-bottom-width:1px;}
.tg .tg-yw4l{vertical-align:top}
.tg .tg-6k2t{background-color:#D2E4FC;vertical-align:top}
@media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;}}</style>

<h1><?php echo $title;?></h1>
<form method="POST" action="./event_action.php" enctype="multipart/form-data">
<?php if($new_event) { ?><input type="hidden" name="is_new" id="is_new" value="true"/><?php }?>
<?php if(isset($event_id)) { ?><input type="hidden" name="event_id" id="event_id" value="<?php echo $event_id;?>"/><?php } ?>
<div class="tg-wrap"><table class="tg">
  <tr>
    <th class="tg-yw4l" >Event name</th>
    <th class="tg-yw4l" ><input type="text" name="event" id="event" style="width: 400;" <?php if(!$new_event) echo "value='".$res['s_event_name']."'";?> <?php if(!$edit) echo "disabled" ;?>/></th>
  </tr>
    <tr>
    <th class="tg-6k2t" >Time</th>
    <th class="tg-6k2t" ><input type="text" name="time" id="time" style="width: 400;" <?php if(!$new_event) echo "value='".$res['s_time']."'";?> <?php if(!$edit) echo "disabled" ;?>/></th>
  </tr>
   <tr>
    <th class="tg-yw4l" >Date</th>
    <th class="tg-yw4l" ><input type="text" name="date" id="date" style="width: 400;" <?php if(!$new_event) echo "value='".$res['s_date']."'";?> <?php if(!$edit) echo "disabled" ;?>/></th>
  </tr>
  <tr>
    <th class="tg-6k2t" >Venue</th>
    <th class="tg-6k2t" ><input type="text" name="venue" id="venue" style="width: 400;" <?php if(!$new_event) echo "value='".$res['s_venue']."'";?> <?php if(!$edit) echo "disabled" ;?>/></th>
  </tr>
  <tr>
    <th class="tg-yw4l" >Details</th>
    <th class="tg-yw4l" ><input type="text" name="details" id="details" style="width: 400; height: 300;" <?php if(!$new_event) echo "value='".$res['s_details']."'";?> <?php if(!$edit) echo "disabled" ;?>/></th>
  </tr>
  <tr>
    <th class="tg-6k2t" >Links</th>
    <th class="tg-6k2t" ><input type="text" name="link" id="link" style="width: 400;" <?php if(!$new_event) echo "value='".$res['s_link']."'";?> <?php if(!$edit) echo "disabled" ;?>/></th>
  </tr>  
  <tr>
    <th class="tg-yw4l" >Tags</th>
    <th class="tg-yw4l" ><input type="text" name="tags" id="tags" style="width: 400;" <?php if(!$new_event) echo "value='".$res['s_tags']."'";?> <?php if(!$edit) echo "disabled" ;?>/></th>
  </tr>  

  
  
 <!-- 
  <tr>
    <td class="tg-6k2t"></td>
    <td class="tg-6k2t"><label id="chars" >Characters left: </label></td>
  </tr>
 --> 
<?php if(!$new_event) { ?>
  <tr>
    <td class="tg-6k2t">Image</td>
    <td class="tg-6k2t"><img src="<?php echo $img_loc; ?>"/></td>
  </tr>
<?php } ?>
<?php if($edit) {?>
  <tr>
    <td class="tg-6k2t"><?php if($new_event) echo "Add an Image"; else echo "Change Image"; ?></td>
    <td class="tg-6k2t"><input type="file" name="fileToUpload" id="fileToUpload"></td>
  </tr>
<?php } ?>

</table></div>


<?php if($new_event) { ?>
<br /><br />
<input type="submit" value="Add this event"/>
<?php } else if ($edit) {?>
<br /><br />
<input type="submit" value="Update this event"/>
<?php } ?>
</form>


<?php if(!$new_event && !$edit) { ?>
<br />
<a href="./event.php?id=<?php echo $event_id ?>&edit=true"><button>Edit this event</button</a>
<?php } ?>


<?php /*
<script type="text/javascript">

document.getElementById('chars').innerHTML = "Characters left: " + (650 - content.value.length);
document.getElementById('content').oninput = function () {
document.getElementById('chars').innerHTML = "Characters left: " + (650 - this.value.length);
};
document.getElementById('content').onkeypress = function () {
document.getElementById('chars').innerHTML = "Characters left: " + (650 - this.value.length);
};
</script>
*/?>