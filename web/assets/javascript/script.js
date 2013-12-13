$('.ui.dropdown')
  .dropdown()
;

$(".item.exec-members-select").click(function(){
  // If this isn't already active
  if ($(this).hasClass("selected")) {
    // Remove the class from anything that is active
    $(this).removeClass("selected");
    }else{
    // And make this active
    $(this).addClass("selected");
  	}
});


$('#select-exec-members-list-next-button').click(function ()
{
	var arrayOfIds = $.map($(".item.exec-members-select.selected"), function(n, i){
  return n.id;
		});

$("#select-exec-members-list-next-button").toggleClass( "loading" );
//$.post( "/unisoc/web/register/step3/542287342516812", { exec_members: arrayOfIds} , function(document.location.href='/unisoc/web/register/step3/542287342516812';

//$.post( "/unisoc/web/register/step3/542287342516812", { exec_members: arrayOfIds}, alert( "Data Loaded: " + arrayOfIds ) );
// alert( "Data Loaded: " + arrayOfIds);
 $.post( "/unisoc/web/register/step3/542287342516812",{ exec_members: arrayOfIds} ,function( data ) {
  if (data == '1'){
  document.location.href='/unisoc/web/register/complete';
  }else {alert( "Error: " + data );}
});

//document.location.href='/unisoc/web/register/step3/542287342516812';
});

