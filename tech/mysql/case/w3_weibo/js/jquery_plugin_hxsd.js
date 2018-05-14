$.modal=function(){
	//创建模态层
	var oModal=document.createElement('div');
	oModal.className="modal";
	document.body.appendChild(oModal);
	
	return function(){
		document.body.removeChild(oModal);
	}
	
};

//判断屏幕上下
$.halfScreen=function(obj){
	var obj_top=obj.offset().top;
	var screenH=$(window).height();
	var windowScrollTop=$(window).scrollTop();
	return obj_top>screenH/2+windowScrollTop ? false:true;
};




$.confirm_box=function(txt,fn){
	var delM=$.modal();
	
	var oBox=document.createElement('div');
	oBox.className="confirm_box";
	oBox.innerHTML='<p>'+txt+'</p><button type="button">yes</button><button type="button">no</button>';
	document.body.appendChild(oBox);
	var aBtn=oBox.getElementsByTagName('button');
	
	
	aBtn[0].onclick=function(){//确定按钮
		fn && fn();
		document.body.removeChild(oBox);
		delM();
	};
	aBtn[1].onclick=function(){
		document.body.removeChild(oBox);
		delM();
	};
}