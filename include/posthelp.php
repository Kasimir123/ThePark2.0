<style>
#post-textarea {
	height: 87px;
	border: solid 1px #E0E0E0;
	border-radius: 4px;
	resize: none;
	background: #FFF;
}
</style>
<!-- php for posting request -->
<?php
	$user = $sesuser['username'];
	$helprequest = @$_POST['post-textarea'];
	if ($helprequest != "") {
	$date_added = date("Y-m-d");
	$added_by = $user;
	$page = "all";
	$sqlCommand = "INSERT INTO helpwanted VALUES('', '$helprequest','$date_added','$added_by','$page')";  
	$query = mysql_query($sqlCommand) or die (mysql_error()); 
	}
 function filterwords($helpwanted){
 $filterWords = array('darn','fuck','mother fucker','motherfucking','motherfucker','shit','poo','goddamn','dick','dicks','fux','whore','vagina','vaginas','pussy','damn','tit','tits','crap','fucker','fuckable','fuckboy','fucky','nigger','negro','ass','boobies','boobs','porn','fucking','retarded','sex','69','truffle butter','sexy','poussey','cum','cumm','arse','arsehole','arse hole','g-spot','g spot','nigga' );
 $filterCount = sizeof($filterWords);
 for($i=0; $i<$filterCount; $i++){
  $body = preg_replace('/\b'.$filterWords[$i].'\b/ie',"str_repeat('*',strlen('$0'))",$helpwanted);
 }
 return $body;
 }
?>

<div class="masonry-grid">

	<!-- Write post card -->
	<div class="grid-item card grey lighten-5">
		<form style="margin-bottom: 0px;" method="POST">
			<div class="card-content">            
				<textarea id="post-textarea" name="post-textarea" placeholder="Write a help request!" style="padding: 8px;"></textarea>
			</div>
			<div class="card-action">
				<button type="submit" class="teal-text btn-flat" name="send" style="height: 24px; line-height: 0px; padding: 0px;">Post</button>
			</div>
		</form>
	</div>
</div>
