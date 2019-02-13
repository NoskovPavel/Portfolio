window.onload=function(  ){
	document.querySelector('h2.menu').onclick=function(){
		var list=this.parentNode.querySelector("ul");
		if (getComputedStyle(this).cursor==='pointer'){
			if (list.style.display!='block') {
				list.style.display='block';
			} else {
					list.removeAttribute('style');
			};
		};
	};
	
	document.querySelector('.secondery-navigation').onmouseleave=function(){
		
		if (getComputedStyle(this.querySelector('.menu')).cursor==='pointer'){	
			this.querySelector('ul').removeAttribute('style');
		};
	};
	
	document.querySelector('.menu-button').onclick=function(){
		var list=this.parentNode.querySelector('ul');
		if (getComputedStyle(this).display==='block'){
			if (list.style.display!='block') {
				list.style.display='block';
			} else {
				list.removeAttribute('style');
			};
		};
	};
	
	document.querySelector('nav').onmouseleave=function(){
		
		if (getComputedStyle(this.querySelector('.menu-button')).display==='block'){	
			this.querySelector('ul').removeAttribute('style');
		};
	};
}