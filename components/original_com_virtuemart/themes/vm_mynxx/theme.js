/**
 * RokVM - VirtueMart Class for handling RocketTheme templates
 * Djamil Legato - (c) RocketTheme, LLC
 * 
 */

eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('9 2={};2.o={1g:7.1B,19:6(){2.o.11();2.3.10()},1j:6(z){z=$(z);4(!z)r 2.o;9 Q=z.1C(\'.S-P-1A\');9 w=0;Q.H(6(Z){w=1z.w(Z.1x().1y.y,w)});Q.13(\'1E\',w)},11:6(){9 U=$$(\'.t-1I-x, .S-P-1w\');4(U.E){U.H(6(x){9 C=x.k(\'.1F\');9 D=x.k(\'.1G\');9 b=x.k(\'.1r\');4(!C||!D||!b)r;9 1p=b.h().d();b.g(\'1o\',6(e){e=c q(e).p();9 5=8.5;4(5<0)5=0;4(Y(5)){8.5=1;5=1}4(e.V==\'C\')4($v(8.h().d())==\'l\')8.5=++5;4(e.V==\'D\')4(5>0&&$v(8.h().d())==\'l\')8.5=--5});b.g(\'1q\',6(e){e=c q(e).p();9 5=8.5;4(5<0)5=0;4(Y(5)){8.5=1;5=1}4(e.14==1)4($v(8.h().d())==\'l\')8.5=++5;4(e.14==-1)4(5>0&&$v(8.h().d())==\'l\')8.5=--5});C.g(\'F\',6(e){c q(e).p();4($v(b.h().d())==\'l\')b.5=++b.5});D.g(\'F\',6(e){c q(e).p();4(b.h().d()>0&&$v(b.h().d())==\'l\')b.5=--b.5})})}}};2.3={10:6(){2.3.n=$(\'t-12\');2.3.i=$(\'t-R\');2.3.L=$(\'t-12-1Z\');4(!2.3.n||!2.3.i||!2.3.L)r 2.3;4(!2.3.f)2.3.f=c f.1L(2.3.n,{26:2b,25:f.24.23.21}).T();2.3.L.13(\'2a\',\'29\');2.3.i.N(\'a\').g(\'F\',6(e){c q(e).p();4(!2.3.n.I().E)r;9 j=2.3.i.k(\'1m\');4(!j||!j.I().d())r;2.3.u=16;4(7.m&&7.m.B)7.m.A();4(7.s&&7.s.B)7.s.A();2.3.f.A()});2.1h=c f.22(7);2.3.M();2.3.15()},15:6(){9 J=$$(\'.1Q\');4(!J.E)r 2.3;J.H(6(G){G.g(\'1P\',2.3.W.1O(G,16))})},W:6(e,u){c q(e).p();c 1f(8.1S(\'1T\'),{17:$(8),X:6(){2.3.M();2.3.u=u||18}}).1b()},M:6(){9 1a={X:2.3.1c,17:{1V:1,2c:"1U.1W",1X:"1Y"}};c 1f(2.o.1g+\'1N.1M\',1a).1b()},1c:6(O){2.3.n.1R(O);9 K=2.3.n.k(\'.20\'),j=0;4(K)j=K.I().28(" ")[0].d();4(!j)2.3.i.N().1i(\'1k\',\'t-R-1e\');27 2.3.i.N().1i(\'1k\',\'t-R-1e-1t\');2.3.i.k(\'1m\').1v(j);4(2.3.u&&O.E){4(7.m&&7.m.B)7.m.A();4(7.s&&7.s.B)7.s.A();2.1h.1n();2.3.1d();2.3.T.1u(1s)};2.3.u=18},1d:6(){2.3.f.1K()},T:6(){2.3.f.1H()}};7.g(\'1l\',2.o.19);7.g((7.1J)?\'1D\':\'1l\',6(){2.o.1j(\'S-P\')});',62,137,'||RokVM|Cart|if|value|function|window|this|var||input|new|toInt||Fx|addEvent|getValue|cartButton|total|getElement|number|fontFx|cartPanel|Base|stop|Event|return|loginFx|cart|clicked|type|max|box||id|toggle|open|up|down|length|click|form|each|getText|forms|products|cartSurround|getShortList|getFirst|response|featured|divs|button|home|hide|boxes|key|add|onComplete|isNaN|div|init|quantityBox|panel|setStyle|wheel|XHRify|true|data|false|start|options|request|update|show|desc|Ajax|uri|scrollWindow|setProperty|featuredHeight|class|domready|strong|toTop|keyup|val|mousewheel|inputboxquantity|3000|full|delay|setText|cartblock|getSize|size|Math|inner|templatePath|getElements|load|height|quantity_box_button_up|quantity_box_button_down|slideOut|quantity|webkit|slideIn|Slide|php|index2|bindWithEvent|submit|addtocart_form|setHTML|getProperty|action|shop|only_page|basket_short|option|com_virtuemart|surround|total_products|easeOut|Scroll|Expo|Transitions|transition|duration|else|split|visible|visibility|400|page'.split('|'),0,{}))



var live_site = RokVM.Base.uri;


/// Following is VM stuff, kept for compatibility


/**
 * This file holds javscript functions that are used by the templates in the Theme
 * 
 */
 
 // AJAX FUNCTIONS 
function loadNewPage( el, url ) {
	
	var theEl = $(el);
	var callback = {
		success : function(responseText) {
			theEl.innerHTML = responseText;
			if( Lightbox ) Lightbox.init();
		}
	}
	var opt = {
	    // Use POST
	    method: 'get',
	    // Handle successful response
	    onComplete: callback.success
    }
	new Ajax( url + '&only_page=1', opt ).request();
}

function handleGoToCart() { document.location = live_site + '/index.php?option=com_virtuemart&page=shop.cart&product_id=' + formCartAdd.product_id.value ; }

function handleAddToCart( formId, parameters ) {
	formCartAdd = document.getElementById( formId );
	
	var callback = function(responseText) {
		updateMiniCarts();
		// close an existing mooPrompt box first, before attempting to create a new one (thanks wellsie!)
		/*if (document.boxB) {
			document.boxB.close();
			clearTimeout(timeoutID);
		}

		document.boxB = new MooPrompt(notice_lbl, responseText, {
				buttons: 2,
				width:400,
				height:150,
				overlay: false,
				button1: ok_lbl,
				button2: cart_title,
				onButton2: 	handleGoToCart
			});
			
		setTimeout( 'document.boxB.close()', 3000 );*/
	}
	
	var opt = {
	    // Use POST
	    method: 'post',
	    // Send this lovely data
	    data: $(formId),
	    // Handle successful response
	    onComplete: callback,
	    
	    evalScripts: true
	}

	new Ajax(formCartAdd.action, opt).request();
}
/**
* This function searches for all elements with the class name "vmCartModule" and
* updates them with the contents of the page "shop.basket_short" after a cart modification event
*/
function updateMiniCarts() {
	var callbackCart = function(responseText) {
		carts = $$( '.vmCartModule' );
		if( carts ) {
			try { 
				for (var i=0; i<carts.length; i++){
					carts[i].innerHTML = responseText;
		
					try {
					color = carts[i].getStyle( 'color' );
					bgcolor = carts[i].getStyle( 'background-color' );
					if( bgcolor == 'transparent' ) {
						// If the current element has no background color, it is transparent.
						// We can't make a highlight without knowing about the real background color,
						// so let's loop up to the next parent that has a BG Color
						parent = carts[i].getParent();
						while( parent && bgcolor == 'transparent' ) {
							bgcolor = parent.getStyle( 'background-color' );
							parent = parent.getParent();
						}
					}
					var fxc = new Fx.Style(carts[i], 'color', {duration: 1000});
					var fxbgc = new Fx.Style(carts[i], 'background-color', {duration: 1000});

					fxc.start( '#222', color );							
					fxbgc.start( '#fff68f', bgcolor );
					
					
					
					if( parent ) {
						setTimeout( "carts[" + i + "].setStyle( 'background-color', 'transparent' )", 1000 );
					}
					} catch(e) {}
				}
			} catch(e) {}
		}
	}
	var option = { method: 'post', onComplete: callbackCart, data: { only_page:1,page: "shop.basket_short", option: "com_virtuemart" } }
	new Ajax( live_site + '/index2.php', option).request();
}
/**
* This function allows you to present contents of a URL in a really nice stylish dhtml Window
* It uses the WindowJS, so make sure you have called
* vmCommonHTML::loadWindowsJS();
* before
*/
function fancyPop( url, parameters ) {
	
	parameters = parameters || {};
	popTitle = parameters.title || '';
	popWidth = parameters.width || 700;
	popHeight = parameters.height || 600;
	popModal = parameters.modal || false;
	
	window_id = new Window('window_id', {className: "mac_os_x", 
										title: popTitle,
										showEffect: Element.show,
										hideEffect: Element.hide,
										width: popWidth, height: popHeight}); 
	window_id.setAjaxContent( url, {evalScripts:true}, true, popModal );
	window_id.setCookie('window_size');
	window_id.setDestroyOnClose();
}