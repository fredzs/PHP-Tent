
var isIE=navigator.appVersion.indexOf('MSIE')>0?true:false;function $(o){return document.getElementById(o);}
function $F(o){return $(o).value;}
function checkFormData()
{$('submit').value=Lang['submit'];$('submit').disabled=true;return true;}
function highlight(o,css)
{o.className='text_center heightlight';o.onmouseout=function(){o.className='text_center '+css;}}
function imgRefresh(name)
{$('vimg').src='vimg.php?n='+name+'&'+Math.random();}
function cnLength(str)
{if(''==str)return 0;var arr=str.match(/[^\x00-\xff]/ig);return str.length+(arr==null?0:arr.length);}
function panelDeploy(id,click)
{var _p='panel_'+id;if(!$(_p))return false;var _p_button=_p+'_button';var panel_open=getCookie(_p);if(0==panel_open)
{if(1==click)
{setCookie(_p,'1');$(_p).style.display='';if('bt_file_list'==id)
{$(_p_button).innerHTML=Lang['file_list_close'];}
else
{$(_p_button).src='images/collapse.gif';$(_p_button).title=Lang['collapse'];}}
else
{$(_p).style.display='none';if('bt_file_list'==id)
{$(_p_button).innerHTML=Lang['file_list_open'];}
else
{$(_p_button).src='images/expand.gif';$(_p_button).title=Lang['expand'];}}}
else
{if(1==click)
{setCookie(_p,'0');$(_p).style.display='none';if('bt_file_list'==id)
{$(_p_button).innerHTML=Lang['file_list_open'];}
else
{$(_p_button).src='images/expand.gif';$(_p_button).title=Lang['expand'];}}
else
{$(_p).style.display='';if('bt_file_list'==id)
{$(_p_button).innerHTML=Lang['file_list_close'];}
else
{$(_p_button).src='images/collapse.gif';$(_p_button).title=Lang['collapse'];}}}}
function setCookie(name,value)
{var expires=new Date();expires.setTime(expires.getTime()+(86400000*7));document.cookie=name+'='+escape(value)+('; expires='+expires.toGMTString())+'; path=/';}
function getCookie(name)
{var arg=name+'=';var alen=arg.length;var clen=document.cookie.length;var i=0;while(i<clen)
{var j=i+alen;if(document.cookie.substring(i,j)==arg)
{return fetchCookie(j);}
i=document.cookie.indexOf(' ',i)+1;if(0==i)break;}
return null;}
function fetchCookie(offset)
{var endstr=document.cookie.indexOf(';',offset);if(-1==endstr)
{endstr=document.cookie.length;}
return unescape(document.cookie.substring(offset,endstr));}
function displaySortMenu(s_o,id)
{s_o.onmouseout=function(){$('sub_sort_'+id).style.display='none';};$('sub_sort_'+id).style.display='block';}
function bodyResize(size)
{var body_width=document.body.clientWidth;if(size>body_width)
{document.body.style.width=size+'px';}
else
{document.body.style.width='auto';}}
function imgResize(o,size)
{if(o.width>size||o.height>size)
{if(o.width>o.height)
{o.width=size;}
else
{o.height=size;}
o.title=Lang['open_image'];o.style.cursor='hand';o.onclick=function(){window.open(o.src)};}}