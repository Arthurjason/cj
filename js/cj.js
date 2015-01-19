//(function () {

	var data = {};
	var data.user = {};
	var data.score = {};

	var check = function () {
		var zjh = $('input[name="zjh"]').val();
		var mm = $('input[name="mm"]').val();
		if (zjh == "") {
			alert('请填写学号。');
			return 0;
		}
		if (mm == "") {
			alert('请填写密码。');
			return 0;
		}
		data.user.zjh = zjh;
		data.user.mm = mm;
	};

	var changePage = function () {
		if ($('#second').css('display').toLowerCase() === 'block') {
			$('#second').css('display','none');
			$('#first').css('display','block');
		} else {
			$('#second').css('display','block');
			$('#first').css('display','none');
		}
	};

	var addGoogle = function () {
		if (!$('script[src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"]'){
			var adg = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
			$(adg).appendTo('body');
		}
	};

	var loading = function () {
		if($('loading').css('display').toLowerCase() === 'none') {
			$('loading').css('display','block');
		} else {
			$('loading').css('display','none');
		}
	}

	var setData = function () {

	}

	var cha = function () {
		changePage();
		loading();
	};




	var bindEvent = function () {
		$('.form_box').keydown(function (event) {
			if(event.keyCode == 13) {
				cha();
			}
		});
	}
	

//})()



