(function () {

	var setStorage = function () {
		localStorage.user = data.user;
		if(localStorage.user) {
			$('input[name="zjh"]').val(localStorage.user.userid);
			$('input[name="mm"]').val(localStorage.user.password);
		}
	}

	var data = {};
		data.user = {};
		data.score = {};

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
		data.user.userid = zjh;
		data.user.password = mm;
	};

	var changePage = function () {
		if ($('#second').css('display') === 'block') {
			$('.adsbygoogle').css('display','none');
			$('.ds-thread').css('display','none');
			$('#second').slideToggle();
			$('#first').slideToggle('normal',function(){
				data = {};
				data.user = {};
				data.score = {};
			});
			
		} else {
			$('#second').slideToggle();
			$('#first').slideToggle("normal",function(){
				$('.adsbygoogle').css('display','block');
				$('.ds-thread').css('display','block');
			});
		}
	
	};

	var addGoogle = function () {
		if ($('script[src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"]').length == 0){
			var adg = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
			$(adg).appendTo('body');
		}
	};

	var addDuoshuo = function () {
		if($('.duo-shuo').length == 0) {
			var ds = '<script type="text/javascript" id="duo-shuo">var duoshuoQuery = {short_name:"ldu"};(function() {var ds = document.createElement("script");ds.type = "text/javascript";ds.async = true;ds.src = (document.location.protocol == "https:" ? "https:" : "http:") + "//static.duoshuo.com/embed.js";ds.charset = "UTF-8";(document.getElementsByTagName("head")[0]  || document.getElementsByTagName("body")[0]).appendChild(ds);})();</script>';
			$(ds).appendTo('body');
		}
	}

	var loading = function (flag) {
		if(flag) {
			$('.loading').css('display','block');
		} else {
			$('.loading').css('display','none');
		}
	};

	var getScore = function () {
		$.ajax({
			type:'POST',
			url:'cha.php',
			data:'userid=' + data.user.userid + '&password=' + data.user.password,
			success:function(d){
				var result;
				try {
					result = $.parseJSON(d);
				} catch (e) {
					result = d;
				}
				data.score = result;
				$('.cj-box').empty();
				getScoreSuccess();
			},
			error:function(){
				alert('出现未知链接错误，请联系管理员或重试！');
				changePage();
				return;
			}
		});
	};

	var cha = function () {
		check();
		loading(true);
		changePage();
		$('.cj-box').empty();
		getScore();
	};

	var getScoreSuccess = function () {
		loading(false);
		if (data.score.error > 0) {
			if (data.score.error == 7){
				alert('密码错误或教务系统服务器出现问题，请重试！');
				changePage();
				return;
			} else if (data.score.error == 8) {
				alert('本学习成绩查询还没有开始,或者你已经没有考试科目了！');
				changePage();
				return;
			} else {
				alert('出现未知错误，请联系管理员或重试！');
				changePage();
				return;
			}
		}

		setData();
		addGoogle();
		addDuoshuo();
	}

	var restart = function () {
		changePage();
	}

	var setData = function () {
		var text = '';
		for ( var i = 0; i < data.score.score.length; i++ ){
			if(!data.score.score[i].cj) data.score.score[i].cj = '还没出';
			text += '<li class="cj-item">'
					+ '<div class="cj-top clearfix">'
						+ '<div class="title">' + data.score.score[i].kcm + '</div>'
						+ '<div class="content">' + data.score.score[i].cj + '</div>'
					+ '</div>'
					+ '<ul class="cj-info">'
						+ '<li class="cj-td clearfix">'
							+ '<div class="title">课程号</div>'
							+ '<div class="content">' + data.score.score[i].kch + '</div>'
						+ '</li>'
						+ '<li class="cj-td clearfix">'
							+ '<div class="title">课序号</div>'
							+ '<div class="content">' + data.score.score[i].kxh + '</div>'
						+ '</li>'
						+ '<li class="cj-td clearfix">'
							+ '<div class="title">英文名</div>'
							+ '<div class="content">' + data.score.score[i].ywkcm + '</div>'
						+ '</li>'
						+ '<li class="cj-td clearfix">'
							+ '<div class="title">学分</div>'
							+ '<div class="content">' + data.score.score[i].xf + '</div>'
						+ '</li>'
						+ '<li class="cj-td clearfix">'
							+ '<div class="title">课程属性</div>'
							+ '<div class="content">' + data.score.score[i].kcsx + '</div>'
						+ '</li>'
						+ '</ul>'
				+ '</li>';
		}
		$(text).appendTo('.cj-box');
	}



	var bindEvent = function () {
		$('.form_box').keydown(function (event) {
			if(event.keyCode == 13) {
				cha();
			}
		});
		$('.submit_btn').click(function() {
			cha();
		});
		$('#restart').click(function () {
			restart();
		});
		$('.cj-box').on('click', '.cj-item', function(e){
			$(this).find('.cj-info').slideToggle();
		});
	}

	var init = function () {
		setStorage();
		bindEvent();
	}
	init();
	

})()
