var main=function(){
	
}


function ValidateEmail(mail){
//yeah, I know this is a little hokey; this is the email validation
mm=mail.split('@')
if (mm.length==2)
{//ensuring there's only 1 @ sign
	mp=mm[1].split('.')
	//ensuring there's exactly 1 period after the @ sign.
	if (mp.length==2)
	{
		ret=true
	}
	else
	{
		ret=false
	}
}
else
{
	ret=false
}

return ret
}

$(document).ready(main)