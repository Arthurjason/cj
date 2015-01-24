(function () {

	var setStorage = function () {
		if(localStorage.userid && localStorage.password) {
			$('input[name="zjh"]').val(localStorage.userid);
			$('input[name="mm"]').val(localStorage.password);
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
		localStorage.userid = data.user.userid;
		localStorage.password = data.user.password;
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
		setMessage();		
		addGoogle();
		addDuoshuo();
	}

	var restart = function () {
		changePage();
	}

	var setData = function () {
		var text = '';
		for ( var i = 0; i < data.score.score.length; i++ ){
			
			if(!data.score.score[i].cj) data.score.score[i].cj = "?";

			if ( (/[0-9]g/).test(parseInt(data.score.score[i].cj))) {
				data.score.score[i].cj = parseInt(data.score.score[i].cj);
			}


			var uiStyle;
			if (data.score.score[i].cj == "?"){
				uiStyle = '0';
			} else if (data.score.score[i].cj == 0) {
				uiStyle = 'un';
			} else if (data.score.score[i].cj < 60) {
				uiStyle = '50';
			} else if (data.score.score[i].cj < 80) {
				uiStyle = '60';
			} else if (data.score.score[i].cj < 100) {
				uiStyle = '80';
			} else if (data.score.score[i].cj == 100) {
				uiStyle = '100';
			} else {
				uiStyle = 'un';
			}
			text += '<li class="cj-item">'
					+ '<div class="cj-top clearfix">'
						+ '<div class="title">' + data.score.score[i].kcm + '</div>'
						+ '<div class="content cj-ui ui-'+ uiStyle +'">' + data.score.score[i].cj + '</div>'
					+ '</div>'
					+ '<ul class="cj-info">'
						+ '<li class="cj-td clearfix">'
							+ '<div class="de-title">课程号</div>'
							+ '<div class="de-content">' + data.score.score[i].kch + '</div>'
						+ '</li>'
						+ '<li class="cj-td clearfix">'
							+ '<div class="de-title">课序号</div>'
							+ '<div class="de-content">' + data.score.score[i].kxh + '</div>'
						+ '</li>'
						+ '<li class="cj-td clearfix">'
							+ '<div class="de-title">英文名</div>'
							+ '<div class="de-content">' + data.score.score[i].ywkcm + '</div>'
						+ '</li>'
						+ '<li class="cj-td clearfix">'
							+ '<div class="de-title">学分</div>'
							+ '<div class="de-content">' + data.score.score[i].xf + '</div>'
						+ '</li>'
						+ '<li class="cj-td clearfix">'
							+ '<div class="de-title">课程属性</div>'
							+ '<div class="de-content">' + data.score.score[i].kcsx + '</div>'
						+ '</li>'
						+ '</ul>'
				+ '</li>';
		}
		$(text).appendTo('.cj-box');
	}

	var setMessage = function () {

		var url = {
			1: 'http://wap.koudaitong.com/v2/showcase/goods?alias=1f5rvdug7&showsku=true',
			2: 'http://wap.koudaitong.com/v2/showcase/goods?alias=16htnu4hl&showsku=true',
			3: 'http://wap.koudaitong.com/v2/showcase/goods?alias=kgb5lxgo&showsku=true',	
			4: 'http://wap.koudaitong.com/v2/showcase/goods?alias=a5kiaab5&showsku=true',	
			5: 'http://wap.koudaitong.com/v2/showcase/goods?alias=2hlrogjn&showsku=true',
			6: 'http://wap.koudaitong.com/v2/showcase/goods?alias=a4epoxkd&showsku=true',
			7: 'http://wap.koudaitong.com/v2/showcase/goods?alias=nzaclnws&showsku=true',	
			8: 'http://wap.koudaitong.com/v2/showcase/goods?alias=1fvk2n0v1&showsku=true',	
			9: 'http://wap.koudaitong.com/v2/showcase/goods?alias=71nqjr&showsku=true',	
			10: 'http://wap.koudaitong.com/v2/showcase/goods?alias=li3pjirk&showsku=true',	
			11: 'http://wap.koudaitong.com/v2/showcase/goods?alias=qbihxxh9&showsku=true',	
			12: 'http://wap.koudaitong.com/v2/showcase/goods?alias=qp7a91ke&showsku=true',
			13: 'http://wap.koudaitong.com/v2/showcase/goods?alias=zdpcebnc&showsku=true',
			14: 'http://wap.koudaitong.com/v2/showcase/goods?alias=170dadevj&showsku=true',
			15: 'http://wap.koudaitong.com/v2/showcase/goods?alias=ip17befh&showsku=true'
		}

		var price = 3;

		var count = data.score.score.length,
			uncount  = 0;
		for (var i = 0; i < count; i++) {
			if(data.score.score[i].cj == '?') {
			uncount ++;
			}
		}
		var money = price * uncount / 10;

		var text = "同学你好，还在为无时无刻查成绩而烦恼吗？快来定制成绩短信提醒吧！您当前有" + uncount + "科成绩没有出，只需" + money + "元，从此告别 查 时代！";
		$('.cj-message-tip').text(text);
		$('.cj-message-get').css('display','block');
		$('.cj-message-get').click(function () {
			location.href=url[uncount];		
		});
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
