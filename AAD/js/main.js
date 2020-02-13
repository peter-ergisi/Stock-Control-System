/**
 * @author Mathew
 **/
var counter = 0;
function loadNavBar()
{
	document.getElementById("nav").className = "navbarPostMain";
	document.getElementById("content").className = "contentPost";
}
function showForm()
{
	document.getElementById("form").style.zIndex = "1";
	document.getElementById("searchBar").style.zIndex = "1";
}
function toggleMenu()
{
	document.getElementById("menuBtn").classList.toggle("openMenu");
	
	counter++;
	if (counter % 2 == 1) {
		document.getElementById("mobileMenu").style.height = "100%";
		document.getElementById("form").style.zIndex = "-1";
		document.getElementById("searchBar").style.zIndex = "-1";
	}else{
		document.getElementById("mobileMenu").style.height = "0%";
		setTimeout(showForm,500);
	}
	
}
function changeSlide(ID)
{
	console.log(ID);
	document.getElementById("imgXbox").style.zIndex = "-4";
	document.getElementById("imgPS4").style.zIndex = "-4";
	document.getElementById("imgSwitch").style.zIndex = "-4";
	document.getElementById("img3DS").style.zIndex = "-4";
	document.getElementById("pXbox").style.zIndex = "-4";
	document.getElementById("pPS4").style.zIndex = "-4";
	document.getElementById("pSwitch").style.zIndex = "-4";
	document.getElementById("p3DS").style.zIndex = "-4";
	
	switch(ID)
	{
		case "1":
			document.getElementById("imgXbox").style.zIndex = "-2";
			document.getElementById("pXbox").style.zIndex = "-1";
			break;
		case "2":
			document.getElementById("imgPS4").style.zIndex = "-2";
			document.getElementById("pPS4").style.zIndex = "-1";
			break;
		case "3":
			document.getElementById("imgSwitch").style.zIndex = "-2";
			document.getElementById("pSwitch").style.zIndex = "-1";
			break;
		case "4":
			document.getElementById("img3DS").style.zIndex = "-2";
			document.getElementById("p3DS").style.zIndex = "-1";
			break;
	}
}

var timer=0;
function autoSlideshow(){
	timer++;
	console.log(timer);
	document.getElementById("imgXbox").style.zIndex = "-4";
	document.getElementById("imgPS4").style.zIndex = "-4";
	document.getElementById("imgSwitch").style.zIndex = "-4";
	document.getElementById("img3DS").style.zIndex = "-4";
	document.getElementById("pXbox").style.zIndex = "-4";
	document.getElementById("pPS4").style.zIndex = "-4";
	document.getElementById("pSwitch").style.zIndex = "-4";
	document.getElementById("p3DS").style.zIndex = "-4";
	switch(timer % 4)
	{
		case 1:
			document.getElementById("imgXbox").style.zIndex = "-2";
			document.getElementById("pXbox").style.zIndex = "-1";
			break;
		case 2:
			document.getElementById("imgPS4").style.zIndex = "-2";
			document.getElementById("pPS4").style.zIndex = "-1";
			break;
		case 3:
			document.getElementById("imgSwitch").style.zIndex = "-2";
			document.getElementById("pSwitch").style.zIndex = "-1";
			break;
		case 4:
			document.getElementById("img3DS").style.zIndex = "-2";
			document.getElementById("p3DS").style.zIndex = "-1";
			break;
	}
	setTimeout(autoSlideshow,8000);
}
