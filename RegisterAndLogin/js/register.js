

<<<<<<< HEAD:RegisterAndLogin/js/register.js


=======
>>>>>>> origin/master:js/register.js
var pwd="notlow";//全局变量，判断密码是否是若密码，若为弱密码，禁止用户注册使用
var pwd2="notlow";
//判断用户口令强度
$(function(){
	$('#pass').keyup(function () {
		var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
		var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
		var enoughRegex = new RegExp("(?=.{6,}).*", "g");

    //密码小于六位的时候，密码强度图片都为灰色，为弱密码
		if (false == enoughRegex.test($(this).val())) {
			$('#level').removeClass('pw-weak');
			$('#level').removeClass('pw-medium');
			$('#level').removeClass('pw-strong');
			$('#level').addClass(' pw-defule');
      pwd="low";

		}
    //密码为八位及以上并且大小写字母数字特殊字符四项都包括,强度最强
		else if (strongRegex.test($(this).val())) {
			$('#level').removeClass('pw-weak');
			$('#level').removeClass('pw-medium');
			$('#level').removeClass('pw-strong');
			$('#level').addClass(' pw-strong');
      pwd="notlow";

		}
    //密码为七位及以上且字母、数字、特殊字符三项中有两项，强度是中等
		else if (mediumRegex.test($(this).val())) {
			$('#level').removeClass('pw-weak');
			$('#level').removeClass('pw-medium');
			$('#level').removeClass('pw-strong');
			$('#level').addClass(' pw-medium');
      pwd="notlow";
		}
    //如果密码为六位及以下，就算字母、数字、特殊字符三项都包括，也为弱密码
		else {
			$('#level').removeClass('pw-weak');
			$('#level').removeClass('pw-medium');
			$('#level').removeClass('pw-strong');
			$('#level').addClass('pw-weak');
      pwd="low";

		}
		return true;
	});
})

$(function(){
	$('#pass2').keyup(function () {
		var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
		var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
		var enoughRegex = new RegExp("(?=.{6,}).*", "g");

    //密码小于六位的时候，密码强度图片都为灰色，为弱密码
		if (false == enoughRegex.test($(this).val())) {
			$('#level2').removeClass('pw-weak');
			$('#level2').removeClass('pw-medium');
			$('#level2').removeClass('pw-strong');
			$('#level2').addClass(' pw-defule');
      pwd2="low";

		}
    //密码为八位及以上并且大小写字母数字特殊字符四项都包括,强度最强
		else if (strongRegex.test($(this).val())) {
			$('#level2').removeClass('pw-weak');
			$('#level2').removeClass('pw-medium');
			$('#level2').removeClass('pw-strong');
			$('#level2').addClass(' pw-strong');
      pwd2="notlow";

		}
    //密码为七位及以上且字母、数字、特殊字符三项中有两项，强度是中等
		else if (mediumRegex.test($(this).val())) {
			$('#level2').removeClass('pw-weak');
			$('#level2').removeClass('pw-medium');
			$('#level2').removeClass('pw-strong');
			$('#level2').addClass(' pw-medium');
      pwd2="notlow";
		}
    //如果密码为六位及以下，就算字母、数字、特殊字符三项都包括，也为弱密码
		else {
			$('#level2').removeClass('pw-weak');
			$('#level2').removeClass('pw-medium');
			$('#level2').removeClass('pw-strong');
			$('#level2').addClass('pw-weak');
      pwd2="low";

		}
		return true;
	});
})


// 验证手机号注册表单数据有效性的函数
function Check1()
{
    //用户名为空
    if (document.send_phone.username.value=="")
    {
        alert('请输入用户名!');
        return false;
    }
    //密码为空
    if (document.send_phone.password.value=="")
    {
        alert('请输入密码!');
        return false;
    }
    // if (document.send_phone.password.value.length>36)
    // {
    //     alert('密码过长，请重新输入!');
    //
    //     return false;
    // }

    //用户名中存在非法字符
    // var regu1 = "^[\u4e00-\u9fa5a-zA-Z0-9]+$";
    // var re = new RegExp(regu1);
    // if (re.test(document.send_phone.username.value) !=true)
    // {
    //     alert('用户名不合法，只能由中文、英文以及数字组成！');
    //     return false;
    // }
    //手机号格式错误
    var regu2 = "^1[34578][0-9]{9}";
    var re2 = new RegExp(regu2);
    if (re2.test(document.send_phone.phonenumber.value)!=true)
    {
        alert('请输入正确的手机号码！');
        return false;
    }

    //为弱密码
    // if(pwd=="low")
    // {
    //   alert('密码强度太弱，请重新输入！')
    //   return false;
    // }

    return true;
}

// 验证邮箱地址注册表单数据有效性的函数
function Check2()// 验证表单数据有效性的函数
{

    if (document.send_Email.username.value=="")
    {
        alert('请输入用户名!');
        return false;
    }

    if (document.send_Email.password.value=="")
    {
        alert('请输入密码!');
        return false;
    }
    // if (document.send_Email.password.value.length>36)
    // {
    //     alert('密码过长，请重新输入!');
    //
    //     return false;
    // }


    // var regu = "^[\u4e00\u9fa5a-zA-Z0-9]+$";
    // var re = new RegExp(regu);
    // if (re.test(document.send_Email.username.value)!=true)
    // {
    //   alert('用户名不合法，只能由中文、英文以及数字组成！');
    //   return false;
    // }

    //邮箱格式错误
    var regu2 = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
    var re2 = new RegExp(regu2);
    if (re2.test(document.send_Email.Email.value)!=true)
    {
      alert('请输入正确的邮箱地址！');
      return false;
    }

<<<<<<< HEAD:RegisterAndLogin/js/register.js
    // if(pwd2=="low")
    // {
    //   alert('密码强度太弱，请重新输入！')
    //   return false;
    // }
=======
    if(pwd2=="low")
    {
      alert('密码强度太弱，请重新输入！')
      return false;
    }
>>>>>>> origin/master:js/register.js

    return true;
}

