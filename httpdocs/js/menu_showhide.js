/************************************************************************************************************
(C) www.dhtmlgoodies.com, November 2005

This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	

Terms of use:
You are free to use this script as long as the copyright message is kept intact. However, you may not
redistribute, sell or repost it without our permission.

Thank you!

www.dhtmlgoodies.com
Alf Magne Kalleland

************************************************************************************************************/

var dhtmlgoodies_slideSpeed_menu = 10;	// Higher value = faster
var dhtmlgoodies_timer_menu = 10;	// Lower value = faster

var objectIdToSlideDown_menu = false;
var dhtmlgoodies_activeId_menu = false;
var dhtmlgoodies_slideInProgress_menu = false;
function showHideContent_menu(e,inputId)
{
	if(dhtmlgoodies_slideInProgress_menu)return;
	dhtmlgoodies_slideInProgress_menu = true;
	if(!inputId)inputId = this.id;
	inputId = inputId + '';
	var numericId_menu = inputId.replace(/[^0-9]/g,'');
	var answerDiv_menu = document.getElementById('dhtmlgoodies_i' + numericId_menu);

	objectIdToSlideDown_menu = false;
	
	if(!answerDiv_menu.style.display || answerDiv_menu.style.display=='none'){		
		if(dhtmlgoodies_activeId_menu &&  dhtmlgoodies_activeId_menu!=numericId_menu){			
			objectIdToSlideDown_menu = numericId_menu;
			slideContent_menu(dhtmlgoodies_activeId_menu,(dhtmlgoodies_slideSpeed_menu*-1));
		}else{
			
			answerDiv_menu.style.display='block';
			answerDiv_menu.style.visibility = 'visible';
			
			slideContent_menu(numericId_menu,dhtmlgoodies_slideSpeed_menu);
		}
	}else{
		slideContent_menu(numericId_menu,(dhtmlgoodies_slideSpeed_menu*-1));
		dhtmlgoodies_activeId_menu = false;
	}	
}

function slideContent_menu(inputId,direction)
{
	
	var obj_menu =document.getElementById('dhtmlgoodies_i' + inputId);
	var contentObj_menu = document.getElementById('dhtmlgoodies_ic' + inputId);
	height_menu = obj_menu.clientHeight;
	if(height_menu==0)height_menu = obj_menu.offsetHeight;
	height_menu = height_menu + direction;
	rerunFunction = true;
	if(height_menu>contentObj_menu.offsetHeight){
		height_menu = contentObj_menu.offsetHeight;
		rerunFunction = false;
	}
	if(height_menu<=1){
		height_menu = 1;
		rerunFunction = false;
	}

	obj_menu.style.height = height_menu + 'px';
	var topPos_menu = height_menu - contentObj_menu.offsetHeight;
	if(topPos_menu>0)topPos_menu=0;
	contentObj_menu.style.top = topPos_menu + 'px';
	if(rerunFunction){
		setTimeout('slideContent_menu(' + inputId + ',' + direction + ')',dhtmlgoodies_timer_menu);
	}else{
		if(height_menu<=1){
			obj_menu.style.display='none'; 
			if(objectIdToSlideDown_menu && objectIdToSlideDown_menu!=inputId){
				document.getElementById('dhtmlgoodies_i' + objectIdToSlideDown_menu).style.display='block';
				document.getElementById('dhtmlgoodies_i' + objectIdToSlideDown_menu).style.visibility='visible';
				slideContent_menu(objectIdToSlideDown_menu,dhtmlgoodies_slideSpeed_menu);				
			}else{
				dhtmlgoodies_slideInProgress_menu = false;
			}
		}else{
			dhtmlgoodies_activeId_menu = inputId;
			dhtmlgoodies_slideInProgress_menu = false;
		}
	}
}



function initShowHideDivs_menu()
{
	var divs_menu = document.getElementsByTagName('DIV');
	var divCounter_menu = 1;
	for(var no=0;no<divs_menu.length;no++){
		if(divs_menu[no].className=='dhtmlgoodies_grouper'){
			divs_menu[no].onclick = showHideContent_menu;
			divs_menu[no].id = 'dhtmlgoodies_g'+divCounter_menu;
			var answer_menu = divs_menu[no].nextSibling;
			while(answer_menu && answer_menu.tagName!='DIV'){
				answer_menu = answer_menu.nextSibling;
			}
			answer_menu.id = 'dhtmlgoodies_i'+divCounter_menu;	
			contentDiv = answer_menu.getElementsByTagName('DIV')[0];
			contentDiv.style.top = 0 - contentDiv.offsetHeight + 'px'; 	
			contentDiv.className='dhtmlgoodies_item_content';
			contentDiv.id = 'dhtmlgoodies_ic' + divCounter_menu;
			answer_menu.style.display='none';
			answer_menu.style.height='1px';
			divCounter_menu++;
		}		
	}	
}