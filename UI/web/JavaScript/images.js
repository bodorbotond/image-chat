function imageSizeChange (key)
{
	var clickedImg = document.getElementsByClassName("SmallImage")[key];
	if (clickedImg.style.width != "100%" && clickedImg.style.height != "70%")
	{
		clickedImg.style.width = "100%";
		clickedImg.style.height = "70%";
	}
	else
	{
		clickedImg.style.width = "170px";
		clickedImg.style.height = "130px";
	}
}

function selectImage (key)
{
	var images = document.getElementsByClassName("SelectImage");
	var clickedImg = document.getElementsByClassName("SelectImage")[key];
	for (i = 0; i < images.length; i++)
	{
		images[i].style.border = "solid 1px black";
	}
	clickedImg.style.border = "solid 3px blue";
}