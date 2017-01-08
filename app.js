var main=function(){
	$('.js-button').toggle()
	$(".php-button").toggle()

	$('.js-button').click(function(){
		N1=$('#name').val()
		E1=$('#email').val()
		C1=$('#comment').val()
		code=grecaptcha.getResponse()

		if (code.length!=0)
		{
			if (N1.length!=0 && E1.length!=0 && C1.length!=0)
			{
				if (ValidateEmail(E1))
				{
					$('body').css({cursor:"progress"})
					$.post("contactform-js.php",{name:N1,Email:E1,comment:C1,cap:code},function(data){
						$('.errortext').text(data)
						$('body').css({cursor:"auto"})
					})
				}
				else
				{
					$('.errortext').text("Please enter a valid email.")
				}
			}
			else
			{
				$('.errortext').text("Please ensure all inputs are filled out.")
			}	
		}
		else
		{
			$('.errortext').text("Please ensure the CAPTCHA is filled out.")
		}
	})
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