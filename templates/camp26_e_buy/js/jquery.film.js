(function($) {jQuery.extend({
init_news: function(option){

 option = $.extend({
    firstname:"",
	secondname:"",
	thirdname:"",
	fourthname:"",
	playingtitle:"Now Playing:",
	nexttitle:"Next News:",
	prevtitle:"Prev News:",
	newsspeed:6000,
	effectis:0,
	mouseover:true,
	effectspeed:600,
	imagedir:"",
	newscountname:"",
	disablenewscount:false
  }, option);
		
 var firstname=option.firstname;
		var secondname=option.secondname;
		var thirdname=option.thirdname;
		var fourthname=option.fourthname;
		var newsspeed=option.newsspeed;
		var effectis=option.effectis;
		var playingtitle=option.playingtitle;
		var nexttitle=option.nexttitle;
		var prevtitle=option.prevtitle;
		var mouseover=option.mouseover;
		var effectspeed=option.effectspeed;
		var imagedir=option.imagedir;
		var newscountname=option.newscountname;
		var disablenewscount=option.disablenewscount;

		if (newscountname){var news_sp=1;}if (disablenewscount===true){var news_dis=1;}
		effectis=parseInt(effectis,10);
		effectspeed=parseInt(effectspeed,10);
		var myprevimg=$('#news_prev').attr('src'); if (!myprevimg){myprevimg=imagedir+'prev.png';}
	var mynextimg=$('#news_next').attr('src'); if (!mynextimg){mynextimg=imagedir+'next.png';}
	var mypauseimg=$('#news_pause').attr('src'); if (!mypauseimg){mypauseimg=imagedir+'pause.png';}
	var myprevimg0=$('#news_prev0').attr('src'); if (!myprevimg0){myprevimg0=imagedir+'prev0.png';}
	var mynextimg0=$('#news_next0').attr('src'); if (!mynextimg0){mynextimg0=imagedir+'next0.png';}
	var mypauseimg0=$('#news_pause0').attr('src'); if (!mypauseimg0){mypauseimg0=imagedir+'pause0.png';}

	var activechk,activechkmore,mysize,myfirst,myfirst_explain,active,timer,splaynum;
			mysize=$('#'+firstname+' .news_style').size();
			myfirst=$('#'+firstname+' .news_style').eq(0).html();
			myfirst_explain=$('#'+firstname+' .news_style').eq(1).attr('rel');
			active=0;
				$('#'+secondname).append(myfirst);
				if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html('1/'+mysize);}
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).html('&nbsp;&nbsp;'+playingtitle+'1/'+mysize+'&nbsp;&nbsp;<br>');}
				$('#'+thirdname).append(nexttitle+myfirst_explain);

			$('#'+fourthname+' #news_next').click(function(){
					clearTimeout(timer);
						$(this).attr({src:mynextimg0});
					$('#'+fourthname+' #news_prev').attr({src:myprevimg});
					$('#'+fourthname+' #news_pause').attr({src:mypauseimg});
						active=active+1;
				if (active==mysize){active=0;}
					var mynum=active+1;
					var mynow=$('#'+firstname+' .news_style').eq(active).html();
					var nextnum=mynum;
							if (nextnum==mysize){nextnum=0;}
				var mynow_explain=$('#'+firstname+' .news_style').eq(nextnum).attr('rel');
				
				switch (effectis)
				{
					
				case 0:
				$('#'+secondname).fadeOut(effectspeed,function(){
					$('#'+secondname).empty();
					$('#'+secondname).html(mynow);
				if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html(mynum+'/'+mysize);$('#'+thirdname).html(nexttitle+mynow_explain);}				
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).empty().html('&nbsp;&nbsp;'+playingtitle+''+mynum+'/'+mysize+'&nbsp;&nbsp;<br>');$('#'+thirdname).append(nexttitle+mynow_explain);}				
				if (news_dis===1)
				{$('#'+thirdname).html(nexttitle+mynow_explain);}					
				$('#'+secondname).fadeIn(effectspeed);
						
				});
				break;
				case 1:
				$('#'+secondname).slideUp(effectspeed,function(){
					$('#'+secondname).empty();
					$('#'+secondname).html(mynow);
				if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html(mynum+'/'+mysize);$('#'+thirdname).html(nexttitle+mynow_explain);}				
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).empty().html('&nbsp;&nbsp;'+playingtitle+''+mynum+'/'+mysize+'&nbsp;&nbsp;<br>');$('#'+thirdname).append(nexttitle+mynow_explain);}				
				if (news_dis===1)
				{$('#'+thirdname).html(nexttitle+mynow_explain);}
					$('#'+secondname).slideDown(effectspeed);
						
				});
				break;
				case 2:
					$('#'+secondname).animate({width:"0px",opacity: 0.33},effectspeed,function(){
					$('#'+secondname).empty();
					$('#'+secondname).html(mynow);
					$('#'+secondname).animate({width:"100%",opacity: 1},effectspeed,function(){
				if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html(mynum+'/'+mysize);$('#'+thirdname).html(nexttitle+mynow_explain);}				
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).empty().html('&nbsp;&nbsp;'+playingtitle+''+mynum+'/'+mysize+'&nbsp;&nbsp;<br>');$('#'+thirdname).append(nexttitle+mynow_explain);}				
				if (news_dis===1)
				{$('#'+thirdname).html(nexttitle+mynow_explain);}

					});
									
					});
					
					
					break;
					
				case 3:
					$('#'+secondname).html(mynow);
				if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html(mynum+'/'+mysize);$('#'+thirdname).html(nexttitle+mynow_explain);}				
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).empty().html('&nbsp;&nbsp;'+playingtitle+''+mynum+'/'+mysize+'&nbsp;&nbsp;<br>');$('#'+thirdname).append(nexttitle+mynow_explain);}				
				if (news_dis===1)
				{$('#'+thirdname).html(nexttitle+mynow_explain);}					

						
				
				break;
					default:
					$('#'+secondname).fadeOut(effectspeed,function(){
					$('#'+secondname).empty();
					$('#'+secondname).html(mynow);
				if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html(mynum+'/'+mysize);$('#'+thirdname).html(nexttitle+mynow_explain);}				
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).empty().html('&nbsp;&nbsp;'+playingtitle+''+mynum+'/'+mysize+'&nbsp;&nbsp;<br>');$('#'+thirdname).append(nexttitle+mynow_explain);}				
				if (news_dis===1)
				{$('#'+thirdname).html(nexttitle+mynow_explain);}
					$('#'+secondname).fadeIn(effectspeed);
						
				});
				break;
				}
					
					timer=setTimeout(autonext,newsspeed,active);
		});
					$('#'+fourthname+' #news_prev').click(function(){
						clearTimeout(timer);
							$(this).attr({src:myprevimg0});
						$('#'+fourthname+' #news_next').attr({src:mynextimg});
						$('#'+fourthname+' #news_pause').attr({src:mypauseimg});
							active=active-1;
					if (active<0){active=mysize-1;}
						var mynum=active+1;
						var myprevnum=mynum-2;
					if (myprevnum<0){myprevnum=mysize-1;}
							var mynow=$('#'+firstname+' .news_style').eq(active).html();
							var mynow_explain=$('#'+firstname+' .news_style').eq(myprevnum).attr('rel');
							switch (effectis)
				{
						case 0:
								$('#'+secondname).fadeOut(effectspeed,function(){
						$('#'+secondname).empty();
						$('#'+secondname).html(mynow);
				if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html(mynum+'/'+mysize);$('#'+thirdname).html(prevtitle+mynow_explain);}				
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).empty().html('&nbsp;&nbsp;'+playingtitle+''+mynum+'/'+mysize+'&nbsp;&nbsp;<br>');$('#'+thirdname).append(prevtitle+mynow_explain);}				
				if (news_dis===1)
				{$('#'+thirdname).html(prevtitle+mynow_explain);}
						$('#'+secondname).fadeIn(effectspeed);
						});
							break;
							case 1:
								$('#'+secondname).slideUp(effectspeed,function(){
						$('#'+secondname).empty();
						$('#'+secondname).html(mynow);
				if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html(mynum+'/'+mysize);$('#'+thirdname).html(prevtitle+mynow_explain);}				
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).empty().html('&nbsp;&nbsp;'+playingtitle+''+mynum+'/'+mysize+'&nbsp;&nbsp;<br>');$('#'+thirdname).append(prevtitle+mynow_explain);}				
				if (news_dis===1)
				{$('#'+thirdname).html(prevtitle+mynow_explain);}	
						$('#'+secondname).slideDown(effectspeed);
						});
							break;
							case 2:
								$('#'+secondname).animate({width:"0px",opacity: 0.33},effectspeed,function(){
					$('#'+secondname).empty();
					$('#'+secondname).html(mynow);
					$('#'+secondname).animate({width:"100%",opacity: 1},effectspeed,function(){
				if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html(mynum+'/'+mysize);$('#'+thirdname).html(prevtitle+mynow_explain);}				
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).empty().html('&nbsp;&nbsp;'+playingtitle+''+mynum+'/'+mysize+'&nbsp;&nbsp;<br>');$('#'+thirdname).append(prevtitle+mynow_explain);}				
				if (news_dis===1)
				{$('#'+thirdname).html(prevtitle+mynow_explain);}		


					});
									
					});
							break;
						case 3:
								
						$('#'+secondname).html(mynow);
						if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html(mynum+'/'+mysize);$('#'+thirdname).html(prevtitle+mynow_explain);}				
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).empty().html('&nbsp;&nbsp;'+playingtitle+''+mynum+'/'+mysize+'&nbsp;&nbsp;<br>');$('#'+thirdname).append(prevtitle+mynow_explain);}				
				if (news_dis===1)
				{$('#'+thirdname).html(prevtitle+mynow_explain);}	
						
							break;
				
							default:
						$('#'+secondname).fadeOut(effectspeed,function(){
						$('#'+secondname).empty();
						$('#'+secondname).html(mynow);

				if (news_sp===1 && news_dis!=1)
				{$('#'+newscountname).html(mynum+'/'+mysize);$('#'+thirdname).html(nexttitle+mynow_explain);}				
				if (news_sp!=1 && news_dis!=1){$('#'+thirdname).empty().html('&nbsp;&nbsp;'+playingtitle+''+mynum+'/'+mysize+'&nbsp;&nbsp;<br>');$('#'+thirdname).append(prevtitle+mynow_explain);}				
				if (news_dis===1)
				{$('#'+thirdname).html(prevtitle+mynow_explain);}		
						$('#'+secondname).fadeIn(effectspeed);
						});
							break;
							}

					
							timer=setTimeout(autoprev,newsspeed,active);
					});

					$('#'+fourthname+' #news_pause').click(function(){
							$(this).attr({src:mypauseimg0});
						$('#'+fourthname+' #news_next').attr({src:mynextimg});
						$('#'+fourthname+' #news_prev').attr({src:myprevimg});
							clearTimeout(timer);
						});
					//add by request
					if (mouseover===true)
					{					
					$('#'+secondname).hover(function(){
						clearTimeout(timer);
						activechk=$('#'+fourthname+' #news_next').attr('src');
						activechkmore=$('#'+fourthname+' #news_prev').attr('src');	
						$('#'+fourthname+' #news_pause').attr({src:mypauseimg0});
						$('#'+fourthname+' #news_next').attr({src:mynextimg});
						$('#'+fourthname+' #news_prev').attr({src:myprevimg});
							},function(){
						$('#'+fourthname+' #news_pause').attr({src:mypauseimg});
						if (activechk==mynextimg && activechkmore==myprevimg){
						timer=setTimeout(autonext,100,active);
							}
						if (activechk==mynextimg0){timer=setTimeout(autonext,100,active);}
						if (activechk==mynextimg && activechkmore==myprevimg0){timer=setTimeout(autoprev,100,active);}
					});
					}
					//end
					var _st = window.setTimeout; 
						window.setTimeout = function(fRef, mDelay) { 
							if(typeof fRef == 'function'){ 
								var argu = Array.prototype.slice.call(arguments,2); 
								var f = (function(){ fRef.apply(null, argu); }); 
								return _st(f, mDelay); 
							} 
						 return _st(fRef,mDelay); 
						}; 

					function autonext(q){
						if (!q){q=0;}
							myend=$('#'+firstname+' .news_hide_style').size();
							myend=myend-1;
							if (q >= myend){q=0;}
								$('#'+fourthname+' #news_next').eq(q).click();
								q=q+1;					
					}
					function autoprev(q){
						if (!q){q=0;}
							myend=$(".news_hide_style").size();
							myend=myend-1;
							if (q >= myend){q=0;}
								$('#'+fourthname+' #news_prev').eq(q).click();
								q=q+1;					
					}
					timer=setTimeout(autonext,newsspeed,1);


}
});
})(jQuery);