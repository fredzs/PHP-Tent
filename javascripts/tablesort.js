
function SortableTable(oTable,oSortTypes){this.sortTypes=oSortTypes||[];this.sortColumn=null;this.descending=null;var oThis=this;this._headerOnclick=function(e){oThis.headerOnclick(e);};if(oTable){this.setTable(oTable);this.document=oTable.ownerDocument||oTable.document;}
else{this.document=document;}
var win=this.document.defaultView||this.document.parentWindow;this._onunload=function(){oThis.destroy();};if(win&&typeof win.attachEvent!="undefined"){win.attachEvent("onunload",this._onunload);}}
SortableTable.gecko=navigator.product=="Gecko";SortableTable.msie=/msie/i.test(navigator.userAgent);SortableTable.removeBeforeSort=SortableTable.gecko;SortableTable.prototype.onsort=function(){};SortableTable.prototype.defaultDescending=true;SortableTable.prototype._sortTypeInfo={};SortableTable.prototype.setTable=function(oTable){if(this.tHead)
this.uninitHeader();this.element=oTable;this.setTHead(oTable.tHead);this.setTBody(oTable.tBodies[0]);};SortableTable.prototype.setTHead=function(oTHead){if(this.tHead&&this.tHead!=oTHead)
this.uninitHeader();this.tHead=oTHead;this.initHeader(this.sortTypes);};SortableTable.prototype.setTBody=function(oTBody){this.tBody=oTBody;};SortableTable.prototype.setSortTypes=function(oSortTypes){if(this.tHead)
this.uninitHeader();this.sortTypes=oSortTypes||[];if(this.tHead)
this.initHeader(this.sortTypes);};SortableTable.prototype.initHeader=function(oSortTypes){if(!this.tHead)return;var cells=this.tHead.rows[0].cells;var doc=this.tHead.ownerDocument||this.tHead.document;this.sortTypes=oSortTypes||[];var l=cells.length;var img,c;for(var i=0;i<l;i++){c=cells[i];if(this.sortTypes[i]!=null&&this.sortTypes[i]!="None"){img=doc.createElement("IMG");img.src="images/blank.gif";img.width=img.height=0;c.appendChild(img);if(this.sortTypes[i]!=null)
c._sortType=this.sortTypes[i];if(typeof c.addEventListener!="undefined")
c.addEventListener("click",this._headerOnclick,false);else if(typeof c.attachEvent!="undefined")
c.attachEvent("onclick",this._headerOnclick);else
c.onclick=this._headerOnclick;}
else
{c.setAttribute("_sortType",oSortTypes[i]);c._sortType="None";}}
this.updateHeaderArrows();};SortableTable.prototype.uninitHeader=function(){if(!this.tHead)return;var cells=this.tHead.rows[0].cells;var l=cells.length;var c;for(var i=0;i<l;i++){c=cells[i];if(c._sortType!=null&&c._sortType!="None"){c.removeChild(c.lastChild);if(typeof c.removeEventListener!="undefined")
c.removeEventListener("click",this._headerOnclick,false);else if(typeof c.detachEvent!="undefined")
c.detachEvent("onclick",this._headerOnclick);c._sortType=null;c.removeAttribute("_sortType");}}};SortableTable.prototype.updateHeaderArrows=function(){if(!this.tHead)return;var cells=this.tHead.rows[0].cells;var l=cells.length;var img;for(var i=0;i<l;i++){if(cells[i]._sortType!=null&&cells[i]._sortType!="None"){img=cells[i].lastChild;if(i==this.sortColumn)
{img.src='imgs/icon_'+(this.descending?"desc":"asc")+'.gif';img.width=10;img.height=12;img.align='absmiddle';}
else
{img.src='images/blank.gif';img.width=img.height=0;}
cells[i].className='sort-arrow';}}};SortableTable.prototype.headerOnclick=function(e){var el=e.target||e.srcElement;while(el.tagName!="TD")
el=el.parentNode;this.sort(SortableTable.msie?SortableTable.getCellIndex(el):el.cellIndex);};SortableTable.getCellIndex=function(oTd){var cells=oTd.parentNode.childNodes
var l=cells.length;var i;for(i=0;cells[i]!=oTd&&i<l;i++);return i;};SortableTable.prototype.getSortType=function(nColumn){return this.sortTypes[nColumn]||"String";};SortableTable.prototype.sort=function(nColumn,bDescending,sSortType){if(!this.tBody)return;if(sSortType==null)
sSortType=this.getSortType(nColumn);if(sSortType=="None")
return;if(bDescending==null){if(this.sortColumn!=nColumn)
this.descending=this.defaultDescending;else
this.descending=!this.descending;}
else
this.descending=bDescending;this.sortColumn=nColumn;if(typeof this.onbeforesort=="function")
this.onbeforesort();var f=this.getSortFunction(sSortType,nColumn);var a=this.getCache(sSortType,nColumn);var tBody=this.tBody;a.sort(f);if(this.descending)
a.reverse();if(SortableTable.removeBeforeSort){var nextSibling=tBody.nextSibling;var p=tBody.parentNode;p.removeChild(tBody);}
var l=a.length;for(var i=0;i<l;i++)
tBody.appendChild(a[i].element);if(SortableTable.removeBeforeSort){p.insertBefore(tBody,nextSibling);}
this.updateHeaderArrows();this.destroyCache(a);if(typeof this.onsort=="function")
this.onsort();};SortableTable.prototype.asyncSort=function(nColumn,bDescending,sSortType){var oThis=this;this._asyncsort=function(){oThis.sort(nColumn,bDescending,sSortType);};window.setTimeout(this._asyncsort,1);};SortableTable.prototype.getCache=function(sType,nColumn){if(!this.tBody)return[];var rows=this.tBody.rows;var l=rows.length;var a=new Array(l);var r;for(var i=0;i<l;i++){r=rows[i];a[i]={value:this.getRowValue(r,sType,nColumn),element:r};};return a;};SortableTable.prototype.destroyCache=function(oArray){var l=oArray.length;for(var i=0;i<l;i++){oArray[i].value=null;oArray[i].element=null;oArray[i]=null;}};SortableTable.prototype.getRowValue=function(oRow,sType,nColumn){if(this._sortTypeInfo[sType]&&this._sortTypeInfo[sType].getRowValue)
return this._sortTypeInfo[sType].getRowValue(oRow,nColumn);var s;var c=oRow.cells[nColumn];if(typeof c.innerText!="undefined")
s=c.innerText;else
s=SortableTable.getInnerText(c);return this.getValueFromString(s,sType);};SortableTable.getInnerText=function(oNode){var s="";var cs=oNode.childNodes;var l=cs.length;for(var i=0;i<l;i++){switch(cs[i].nodeType){case 1:s+=SortableTable.getInnerText(cs[i]);break;case 3:s+=cs[i].nodeValue;break;}}
return s;};SortableTable.prototype.getValueFromString=function(sText,sType){if(this._sortTypeInfo[sType])
{return this._sortTypeInfo[sType].getValueFromString(sText);}
return sText;};SortableTable.prototype.getSortFunction=function(sType,nColumn){if(this._sortTypeInfo[sType])
return this._sortTypeInfo[sType].compare;return SortableTable.basicCompare;};SortableTable.prototype.destroy=function(){this.uninitHeader();var win=this.document.parentWindow;if(win&&typeof win.detachEvent!="undefined"){win.detachEvent("onunload",this._onunload);}
this._onunload=null;this.element=null;this.tHead=null;this.tBody=null;this.document=null;this._headerOnclick=null;this.sortTypes=null;this._asyncsort=null;this.onsort=null;};SortableTable.prototype.addSortType=function(sType,fGetValueFromString,fCompareFunction,fGetRowValue){this._sortTypeInfo[sType]={type:sType,getValueFromString:fGetValueFromString||SortableTable.idFunction,compare:fCompareFunction||SortableTable.basicCompare,getRowValue:fGetRowValue};};SortableTable.prototype.removeSortType=function(sType){delete this._sortTypeInfo[sType];};SortableTable.basicCompare=function compare(n1,n2){if(n1.value<n2.value)
return-1;if(n2.value<n1.value)
return 1;return 0;};SortableTable.idFunction=function(x){return x;};SortableTable.toUpperCase=function(s){return s.toUpperCase();};SortableTable.toDate=function(s){var parts=s.split("-");var d=new Date(0);d.setFullYear(parts[0]);d.setDate(parts[2]);d.setMonth(parts[1]-1);return d.valueOf();};SortableTable.toTransitionSize=function(s){var m=s.match(/(\d+(\.\d+)?)([a-z]+)/i);var unit=m[3];var size=Number(m[1]);switch(unit)
{case'GB':s=size*1073741824;break;case'MB':s=size*1048576;break;case'KB':s=size*1024;break;default:s=size;break;}
return s;};SortableTable.toNumber=function(s){s='-'==s?-1:s;return Number(s);};SortableTable.prototype.addSortType("Number",SortableTable.toNumber);SortableTable.prototype.addSortType("CaseInsensitiveString",SortableTable.toUpperCase);SortableTable.prototype.addSortType("String");SortableTable.prototype.addSortType("Size",SortableTable.toTransitionSize);var ts=new SortableTable($('main_list'),['String','CaseInsensitiveString','String','Number','Number','Number','Size','CaseInsensitiveString']);