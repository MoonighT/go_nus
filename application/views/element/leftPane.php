
<style type="text/css">
.chatdiv
{
background-image: url('../application/views/images/chatbg.png');
<!--background-color:blue;
color:white;
font-family: sans-serif;
-->
background-size: 100%;
width:300px;
table-layout:fixed;
font-weight:300; 


}
.chatdiv td
{
	overflow:hidden;
	white-space:nowrap; 
	padding:15px;
}
.chatdiv tr
{
	text-align: center;
}

</style>
<script>
function addPeopleToList(listOfPeople)
{
	$('#listOfNearbyPeople').empty();
	$('#listOfNearbyPeople').append('<li data-corners="false" data-shadow="false"  data-wrapperels="div" data-icon="false"  data-theme="b" class="ui-btn ui-li ui-btn-up-c ul-li-last"><div class="ui-btn-inner ui-li" style="text-align:center;font-size:x-large">Nearby</div><br/></li>');
	var name;
	var gender;
	for(var i = 0; listOfPeople[i]; i++)
	{
		name = "";
		gender = "";
		for (x in listOfPeople[i])
		{
			if(x == "name")
				name = listOfPeople[i][x];
			if(x == "gender")
				gender = listOfPeople[i][x];
		}
		addPerson(name, gender);
	}
	//$('#listOfNearbyPeople').append('<li data-corners="false" data-shadow="false"  data-wrapperels="div" data-icon="false"  data-theme="c" class="ui-btn ui-li ui-btn-up-c ul-li-last"><div class="ui-btn-inner ui-li"></div></li>');
}

function addPerson(name, gender)
{
	$('#listOfNearbyPeople').append('<li data-corners="false" data-shadow="false"  data-wrapperels="div" data-icon="false"  data-theme="c" class="ui-btn ui-li ui-btn-up-c"><div class="ui-btn-inner ui-li"><div class="ui-btn-text" style="text-align:center;"><a class="center '+gender+'">'+name+'</a></div></div><br/></li>');
	
	$('#slideOutDiv').animate({
				'min-height' : '+=50px',
			},'slow');
}
</script>
<div id="slideOutDiv" style="overflow-y: scroll;overflow-x:hidden;">
<ul id="listOfNearbyPeople" data-role="listview" class="ui-listview">
</ul>
</div>