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
alert(arrayOfIds);
});

