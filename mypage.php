<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Template</title>
    <script  src="/WebBuilder/js/tinymce/tinymce.min.js" ></script>
	<script  src="/WebBuilder/js/jquery-2.1.1.min.js" ></script>
	
</head>

<?php 
session_start( );

if(!isset($_SESSION['isLogged']) || !$_SESSION['isLogged'] )
{
	header('Location: ./../user_manager/login.php');				
}
else 
{
	include './manager/user_Manager/HtmlHelper.php';
	
	$helper=new HTMLHelper();
	$html=$helper->readHtmlFromDB($_SESSION['id']);
	//echo sizeof($html);
//	print_r($html);
}

?>

<div style="border: 1px solid gray;">
	<h2 style="text-align: center;" >My Tempaltes</h2>
	<?php 
		for($i=0;$i<sizeof($html);$i++)
		{
			?>
			<form action="/WebBuilder/manager/content_manager/template_editor.php" method="post" 
			id="f_<?php echo $i?>" onsubmit="return setHtml(this)">
			
			 <input type="hidden" name="template" id="val_<?php echo $i ?>" />
				
			<iframe id="frame_<?php echo $i ?>" srcdoc="<?php echo $html[$i]; ?>" src=""></iframe>
			<button type="submit" >Edit</button>
			</form>
			
		
	<?php 
		}
	?>
	
	
</div>



</body>

<script type="text/javascript">

function setHtml(form)
{	
	var no= form.id.split("_")[1];
	

	$("#val_"+no).val($("#frame_"+no).html());
//	alert(no);
	return true;
}


$(function(){

	$('#save').on('submit',function(e){
//			e.preventDefault();
			$('#html').val($('#frame').html());
			
			console.log( $('#html').val() );
		});

	$('.text').css('color','red');
	 
	// $("#frame").load("<?php echo $turl ?>"); 
	 


//	
//	tinymce.init({
//    selector: ".text",
//    inline: true,
//    toolbar: "undo redo",
//    menubar: false
//});


	tinymce.init({
    selector: "#frame",
    inline: true,
      plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
});

	

//    tinymce.init({
 //       selector: "h1",
//        setup: function(ed) {
//            ed.on('init', function(e) {
//                e.target.hide();
//            });
//        },


});


</script>

</html>