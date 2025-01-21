"use strict";window.jscolor||(window.jscolor=function(){var e,n,t,o,r,i,v={register:function(){v.attachDOMReadyEvent(v.init),v.attachEvent(document,"mousedown",v.onDocumentMouseDown),v.attachEvent(document,"touchstart",v.onDocumentTouchStart),v.attachEvent(window,"resize",v.onWindowResize)},init:function(){v.jscolor.lookupClass&&v.jscolor.installByClassName(v.jscolor.lookupClass)},tryInstallOnElements:function(e,t){for(var n=new RegExp("(^|\\s)("+t+")(\\s*(\\{[^}]*\\})|\\s|$)","i"),r=0;r<e.length;r+=1){var o;if(void 0===e[r].type||"color"!=e[r].type.toLowerCase()||!v.isColorAttrSupported)if(!e[r].jscolor&&e[r].className&&(o=e[r].className.match(n))){var i=e[r],s=null,l=v.getDataAttr(i,"jscolor");null!==l?s=l:o[4]&&(s=o[4]);var a={};if(s)try{a=new Function("return ("+s+")")()}catch(e){v.warn("Error parsing jscolor options: "+e+":\n"+s)}i.jscolor=new v.jscolor(i,a)}}},isColorAttrSupported:(i=document.createElement("input"),!(!i.setAttribute||(i.setAttribute("type","color"),"color"!=i.type.toLowerCase()))),isCanvasSupported:(r=document.createElement("canvas"),!(!r.getContext||!r.getContext("2d"))),fetchElement:function(e){return"string"==typeof e?document.getElementById(e):e},isElementType:function(e,t){return e.nodeName.toLowerCase()===t.toLowerCase()},getDataAttr:function(e,t){var n="data-"+t,r=e.getAttribute(n);return null!==r?r:null},attachEvent:function(e,t,n){e.addEventListener?e.addEventListener(t,n,!1):e.attachEvent&&e.attachEvent("on"+t,n)},detachEvent:function(e,t,n){e.removeEventListener?e.removeEventListener(t,n,!1):e.detachEvent&&e.detachEvent("on"+t,n)},_attachedGroupEvents:{},attachGroupEvent:function(e,t,n,r){v._attachedGroupEvents.hasOwnProperty(e)||(v._attachedGroupEvents[e]=[]),v._attachedGroupEvents[e].push([t,n,r]),v.attachEvent(t,n,r)},detachGroupEvents:function(e){if(v._attachedGroupEvents.hasOwnProperty(e)){for(var t=0;t<v._attachedGroupEvents[e].length;t+=1){var n=v._attachedGroupEvents[e][t];v.detachEvent(n[0],n[1],n[2])}delete v._attachedGroupEvents[e]}},attachDOMReadyEvent:function(e){var t=!1,n=function(){t||(t=!0,e())};if("complete"!==document.readyState){if(document.addEventListener)document.addEventListener("DOMContentLoaded",n,!1),window.addEventListener("load",n,!1);else if(document.attachEvent&&(document.attachEvent("onreadystatechange",function(){"complete"===document.readyState&&(document.detachEvent("onreadystatechange",arguments.callee),n())}),window.attachEvent("onload",n),document.documentElement.doScroll&&window==window.top)){var r=function(){if(document.body)try{document.documentElement.doScroll("left"),n()}catch(e){setTimeout(r,1)}};r()}}else setTimeout(n,1)},warn:function(e){window.console&&window.console.warn&&window.console.warn(e)},preventDefault:function(e){e.preventDefault&&e.preventDefault(),e.returnValue=!1},captureTarget:function(e){e.setCapture&&(v._capturedTarget=e,v._capturedTarget.setCapture())},releaseTarget:function(){v._capturedTarget&&(v._capturedTarget.releaseCapture(),v._capturedTarget=null)},fireEvent:function(e,t){if(e)if(document.createEvent)(n=document.createEvent("HTMLEvents")).initEvent(t,!0,!0),e.dispatchEvent(n);else if(document.createEventObject){var n=document.createEventObject();e.fireEvent("on"+t,n)}else e["on"+t]&&e["on"+t]()},classNameToList:function(e){return e.replace(/^\s+|\s+$/g,"").split(/\s+/)},hasClass:function(e,t){return!!t&&-1!=(" "+e.className.replace(/\s+/g," ")+" ").indexOf(" "+t+" ")},setClass:function(e,t){for(var n=v.classNameToList(t),r=0;r<n.length;r+=1)v.hasClass(e,n[r])||(e.className+=(e.className?" ":"")+n[r])},unsetClass:function(e,t){for(var n=v.classNameToList(t),r=0;r<n.length;r+=1){var o=new RegExp("^\\s*"+n[r]+"\\s*|\\s*"+n[r]+"\\s*$|\\s+"+n[r]+"(\\s+)","g");e.className=e.className.replace(o,"$1")}},getStyle:function(e){return window.getComputedStyle?window.getComputedStyle(e):e.currentStyle},setStyle:(n=document.createElement("div"),t=function(e){for(var t=0;t<e.length;t+=1)if(e[t]in n.style)return e[t]},o={borderRadius:t(["borderRadius","MozBorderRadius","webkitBorderRadius"]),boxShadow:t(["boxShadow","MozBoxShadow","webkitBoxShadow"])},function(e,t,n){switch(t.toLowerCase()){case"opacity":var r=Math.round(100*parseFloat(n));e.style.opacity=n,e.style.filter="alpha(opacity="+r+")";break;default:e.style[o[t]]=n}}),setBorderRadius:function(e,t){v.setStyle(e,"borderRadius",t||"0")},setBoxShadow:function(e,t){v.setStyle(e,"boxShadow",t||"none")},getElementPos:function(e,t){var n=0,r=0,o=e.getBoundingClientRect();if(n=o.left,r=o.top,!t){var i=v.getViewPos();n+=i[0],r+=i[1]}return[n,r]},getElementSize:function(e){return[e.offsetWidth,e.offsetHeight]},getAbsPointerPos:function(e){e||(e=window.event);var t=0,n=0;return void 0!==e.changedTouches&&e.changedTouches.length?(t=e.changedTouches[0].clientX,n=e.changedTouches[0].clientY):"number"==typeof e.clientX&&(t=e.clientX,n=e.clientY),{x:t,y:n}},getRelPointerPos:function(e){e||(e=window.event);var t=(e.target||e.srcElement).getBoundingClientRect(),n=0,r=0;return void 0!==e.changedTouches&&e.changedTouches.length?(n=e.changedTouches[0].clientX,r=e.changedTouches[0].clientY):"number"==typeof e.clientX&&(n=e.clientX,r=e.clientY),{x:n-t.left,y:r-t.top}},getViewPos:function(){var e=document.documentElement;return[(window.pageXOffset||e.scrollLeft)-(e.clientLeft||0),(window.pageYOffset||e.scrollTop)-(e.clientTop||0)]},getViewSize:function(){var e=document.documentElement;return[window.innerWidth||e.clientWidth,window.innerHeight||e.clientHeight]},redrawPosition:function(){if(v.picker&&v.picker.owner){var e,t,n=v.picker.owner;n.fixed?(e=v.getElementPos(n.targetElement,!0),t=[0,0]):(e=v.getElementPos(n.targetElement),t=v.getViewPos());var r,o,i,s=v.getElementSize(n.targetElement),l=v.getViewSize(),a=v.getPickerOuterDims(n);switch(n.position.toLowerCase()){case"left":o=0,i=-(r=1);break;case"right":o=0,i=r=1;break;case"top":r=0,i=-(o=1);break;default:r=0,i=o=1}var d=(s[o]+a[o])/2;if(n.smartPosition)c=[-t[r]+e[r]+a[r]>l[r]&&-t[r]+e[r]+s[r]/2>l[r]/2&&0<=e[r]+s[r]-a[r]?e[r]+s[r]-a[r]:e[r],-t[o]+e[o]+s[o]+a[o]-d+d*i>l[o]?-t[o]+e[o]+s[o]/2>l[o]/2&&0<=e[o]+s[o]-d-d*i?e[o]+s[o]-d-d*i:e[o]+s[o]-d+d*i:0<=e[o]+s[o]-d+d*i?e[o]+s[o]-d+d*i:e[o]+s[o]-d-d*i];else var c=[e[r],e[o]+s[o]-d+d*i];var h=c[r],p=c[o],u=n.fixed?"fixed":"absolute",m=(c[0]+a[0]>e[0]||c[0]<e[0]+s[0])&&c[1]+a[1]<e[1]+s[1];v._drawPosition(n,h,p,u,m)}},_drawPosition:function(e,t,n,r,o){var i=o?0:e.shadowBlur;v.picker.wrap.style.position=r,v.picker.wrap.style.left=t+"px",v.picker.wrap.style.top=n+"px",v.setBoxShadow(v.picker.boxS,e.shadow?new v.BoxShadow(0,i,e.shadowBlur,0,e.shadowColor):null)},getPickerDims:function(e){var t=!!v.getSliderComponent(e);return[2*e.insetWidth+2*e.padding+e.width+(t?2*e.insetWidth+v.getPadToSliderPadding(e)+e.sliderSize:0),2*e.insetWidth+2*e.padding+e.height+(e.closable?2*e.insetWidth+e.padding+e.buttonHeight:0)]},getPickerOuterDims:function(e){var t=v.getPickerDims(e);return[t[0]+2*e.borderWidth,t[1]+2*e.borderWidth]},getPadToSliderPadding:function(e){return Math.max(e.padding,1.5*(2*e.pointerBorderWidth+e.pointerThickness))},getPadYComponent:function(e){switch(e.mode.charAt(1).toLowerCase()){case"v":return"v"}return"s"},getSliderComponent:function(e){if(2<e.mode.length)switch(e.mode.charAt(2).toLowerCase()){case"s":return"s";case"v":return"v"}return null},onDocumentMouseDown:function(e){e||(e=window.event);var t=e.target||e.srcElement;t._jscLinkedInstance?t._jscLinkedInstance.showOnClick&&t._jscLinkedInstance.show():t._jscControlName?v.onControlPointerStart(e,t,t._jscControlName,"mouse"):v.picker&&v.picker.owner&&v.picker.owner.hide()},onDocumentTouchStart:function(e){e||(e=window.event);var t=e.target||e.srcElement;t._jscLinkedInstance?t._jscLinkedInstance.showOnClick&&t._jscLinkedInstance.show():t._jscControlName?v.onControlPointerStart(e,t,t._jscControlName,"touch"):v.picker&&v.picker.owner&&v.picker.owner.hide()},onWindowResize:function(e){v.redrawPosition()},onParentScroll:function(e){v.picker&&v.picker.owner&&v.picker.owner.hide()},_pointerMoveEvent:{mouse:"mousemove",touch:"touchmove"},_pointerEndEvent:{mouse:"mouseup",touch:"touchend"},_pointerOrigin:null,_capturedTarget:null,onControlPointerStart:function(n,r,o,i){var e=r._jscInstance;v.preventDefault(n),v.captureTarget(r);var t=function(e,t){v.attachGroupEvent("drag",e,v._pointerMoveEvent[i],v.onDocumentPointerMove(n,r,o,i,t)),v.attachGroupEvent("drag",e,v._pointerEndEvent[i],v.onDocumentPointerEnd(n,r,o,i))};if(t(document,[0,0]),window.parent&&window.frameElement){var s=window.frameElement.getBoundingClientRect(),l=[-s.left,-s.top];t(window.parent.window.document,l)}var a=v.getAbsPointerPos(n),d=v.getRelPointerPos(n);switch(v._pointerOrigin={x:a.x-d.x,y:a.y-d.y},o){case"pad":switch(v.getSliderComponent(e)){case"s":0===e.hsv[1]&&e.fromHSV(null,100,null);break;case"v":0===e.hsv[2]&&e.fromHSV(null,null,100)}v.setPad(e,n,0,0);break;case"sld":v.setSld(e,n,0)}v.dispatchFineChange(e)},onDocumentPointerMove:function(e,n,r,t,o){return function(e){var t=n._jscInstance;switch(r){case"pad":e||(e=window.event),v.setPad(t,e,o[0],o[1]),v.dispatchFineChange(t);break;case"sld":e||(e=window.event),v.setSld(t,e,o[1]),v.dispatchFineChange(t)}}},onDocumentPointerEnd:function(e,n,t,r){return function(e){var t=n._jscInstance;v.detachGroupEvents("drag"),v.releaseTarget(),v.dispatchChange(t)}},dispatchChange:function(e){e.valueElement&&v.isElementType(e.valueElement,"input")&&v.fireEvent(e.valueElement,"change")},dispatchFineChange:function(e){e.onFineChange&&("string"==typeof e.onFineChange?new Function(e.onFineChange):e.onFineChange).call(e)},setPad:function(e,t,n,r){var o=v.getAbsPointerPos(t),i=n+o.x-v._pointerOrigin.x-e.padding-e.insetWidth,s=r+o.y-v._pointerOrigin.y-e.padding-e.insetWidth,l=i*(360/(e.width-1)),a=100-s*(100/(e.height-1));switch(v.getPadYComponent(e)){case"s":e.fromHSV(l,a,null,v.leaveSld);break;case"v":e.fromHSV(l,null,a,v.leaveSld)}},setSld:function(e,t,n){var r=100-(n+v.getAbsPointerPos(t).y-v._pointerOrigin.y-e.padding-e.insetWidth)*(100/(e.height-1));switch(v.getSliderComponent(e)){case"s":e.fromHSV(null,r,null,v.leavePad);break;case"v":e.fromHSV(null,null,r,v.leavePad)}},_vmlNS:"jsc_vml_",_vmlCSS:"jsc_vml_css_",_vmlReady:!1,initVML:function(){if(!v._vmlReady){var e=document;if(e.namespaces[v._vmlNS]||e.namespaces.add(v._vmlNS,"urn:schemas-microsoft-com:vml"),!e.styleSheets[v._vmlCSS]){var t=["shape","shapetype","group","background","path","formulas","handles","fill","stroke","shadow","textbox","textpath","imagedata","line","polyline","curve","rect","roundrect","oval","arc","image"],n=e.createStyleSheet();n.owningElement.id=v._vmlCSS;for(var r=0;r<t.length;r+=1)n.addRule(v._vmlNS+"\\:"+t[r],"behavior:url(#default#VML);")}v._vmlReady=!0}},createPalette:function(){var e={elm:null,draw:null};if(v.isCanvasSupported){var i=document.createElement("canvas"),s=i.getContext("2d"),t=function(e,t,n){i.width=e,i.height=t,s.clearRect(0,0,i.width,i.height);var r=s.createLinearGradient(0,0,i.width,0);r.addColorStop(0,"#F00"),r.addColorStop(1/6,"#FF0"),r.addColorStop(2/6,"#0F0"),r.addColorStop(.5,"#0FF"),r.addColorStop(4/6,"#00F"),r.addColorStop(5/6,"#F0F"),r.addColorStop(1,"#F00"),s.fillStyle=r,s.fillRect(0,0,i.width,i.height);var o=s.createLinearGradient(0,0,0,i.height);switch(n.toLowerCase()){case"s":o.addColorStop(0,"rgba(255,255,255,0)"),o.addColorStop(1,"rgba(255,255,255,1)");break;case"v":o.addColorStop(0,"rgba(0,0,0,0)"),o.addColorStop(1,"rgba(0,0,0,1)")}s.fillStyle=o,s.fillRect(0,0,i.width,i.height)};e.elm=i,e.draw=t}else{v.initVML();var r=document.createElement("div");r.style.position="relative",r.style.overflow="hidden";var o=document.createElement(v._vmlNS+":fill");o.type="gradient",o.method="linear",o.angle="90",o.colors="16.67% #F0F, 33.33% #00F, 50% #0FF, 66.67% #0F0, 83.33% #FF0";var l=document.createElement(v._vmlNS+":rect");l.style.position="absolute",l.style.left="-1px",l.style.top="-1px",l.stroked=!1,l.appendChild(o),r.appendChild(l);var a=document.createElement(v._vmlNS+":fill");a.type="gradient",a.method="linear",a.angle="180",a.opacity="0";var d=document.createElement(v._vmlNS+":rect");d.style.position="absolute",d.style.left="-1px",d.style.top="-1px",d.stroked=!1,d.appendChild(a),r.appendChild(d);t=function(e,t,n){switch(r.style.width=e+"px",r.style.height=t+"px",l.style.width=d.style.width=e+1+"px",l.style.height=d.style.height=t+1+"px",o.color="#F00",o.color2="#F00",n.toLowerCase()){case"s":a.color=a.color2="#FFF";break;case"v":a.color=a.color2="#000"}};e.elm=r,e.draw=t}return e},createSliderGradient:function(){var e={elm:null,draw:null};if(v.isCanvasSupported){var i=document.createElement("canvas"),s=i.getContext("2d"),t=function(e,t,n,r){i.width=e,i.height=t,s.clearRect(0,0,i.width,i.height);var o=s.createLinearGradient(0,0,0,i.height);o.addColorStop(0,n),o.addColorStop(1,r),s.fillStyle=o,s.fillRect(0,0,i.width,i.height)};e.elm=i,e.draw=t}else{v.initVML();var o=document.createElement("div");o.style.position="relative",o.style.overflow="hidden";var l=document.createElement(v._vmlNS+":fill");l.type="gradient",l.method="linear",l.angle="180";var a=document.createElement(v._vmlNS+":rect");a.style.position="absolute",a.style.left="-1px",a.style.top="-1px",a.stroked=!1,a.appendChild(l),o.appendChild(a);t=function(e,t,n,r){o.style.width=e+"px",o.style.height=t+"px",a.style.width=e+1+"px",a.style.height=t+1+"px",l.color=n,l.color2=r};e.elm=o,e.draw=t}return e},leaveValue:1,leaveStyle:2,leavePad:4,leaveSld:8,BoxShadow:(e=function(e,t,n,r,o,i){this.hShadow=e,this.vShadow=t,this.blur=n,this.spread=r,this.color=o,this.inset=!!i},e.prototype.toString=function(){var e=[Math.round(this.hShadow)+"px",Math.round(this.vShadow)+"px",Math.round(this.blur)+"px",Math.round(this.spread)+"px",this.color];return this.inset&&e.push("inset"),e.join(" ")},e),jscolor:function(e,t){for(var n in this.value=null,this.valueElement=e,this.styleElement=e,this.required=!0,this.refine=!0,this.hash=!1,this.uppercase=!0,this.onFineChange=null,this.activeClass="jscolor-active",this.overwriteImportant=!1,this.minS=0,this.maxS=100,this.minV=0,this.maxV=100,this.hsv=[0,0,100],this.rgb=[255,255,255],this.width=181,this.height=101,this.showOnClick=!0,this.mode="HSV",this.position="bottom",this.smartPosition=!0,this.sliderSize=16,this.crossSize=8,this.closable=!1,this.closeText="Close",this.buttonColor="#000000",this.buttonHeight=18,this.padding=12,this.backgroundColor="#FFFFFF",this.borderWidth=1,this.borderColor="#BBBBBB",this.borderRadius=8,this.insetWidth=1,this.insetColor="#BBBBBB",this.shadow=!0,this.shadowBlur=15,this.shadowColor="rgba(0,0,0,0.2)",this.pointerColor="#4C4C4C",this.pointerBorderColor="#FFFFFF",this.pointerBorderWidth=1,this.pointerThickness=2,this.zIndex=1e3,this.container=null,t)t.hasOwnProperty(n)&&(this[n]=t[n]);function c(e,t,n){var r=n/100*255;if(null===e)return[r,r,r];e/=60,t/=100;var o=Math.floor(e),i=r*(1-t),s=r*(1-t*(o%2?e-o:1-(e-o)));switch(o){case 6:case 0:return[r,s,i];case 1:return[s,r,i];case 2:return[i,r,s];case 3:return[i,s,r];case 4:return[s,i,r];case 5:return[r,i,s]}}function r(){h._processParentElementsInDOM(),v.picker||(v.picker={owner:null,wrap:document.createElement("div"),box:document.createElement("div"),boxS:document.createElement("div"),boxB:document.createElement("div"),pad:document.createElement("div"),padB:document.createElement("div"),padM:document.createElement("div"),padPal:v.createPalette(),cross:document.createElement("div"),crossBY:document.createElement("div"),crossBX:document.createElement("div"),crossLY:document.createElement("div"),crossLX:document.createElement("div"),sld:document.createElement("div"),sldB:document.createElement("div"),sldM:document.createElement("div"),sldGrad:v.createSliderGradient(),sldPtrS:document.createElement("div"),sldPtrIB:document.createElement("div"),sldPtrMB:document.createElement("div"),sldPtrOB:document.createElement("div"),btn:document.createElement("div"),btnT:document.createElement("span")},v.picker.pad.appendChild(v.picker.padPal.elm),v.picker.padB.appendChild(v.picker.pad),v.picker.cross.appendChild(v.picker.crossBY),v.picker.cross.appendChild(v.picker.crossBX),v.picker.cross.appendChild(v.picker.crossLY),v.picker.cross.appendChild(v.picker.crossLX),v.picker.padB.appendChild(v.picker.cross),v.picker.box.appendChild(v.picker.padB),v.picker.box.appendChild(v.picker.padM),v.picker.sld.appendChild(v.picker.sldGrad.elm),v.picker.sldB.appendChild(v.picker.sld),v.picker.sldB.appendChild(v.picker.sldPtrOB),v.picker.sldPtrOB.appendChild(v.picker.sldPtrMB),v.picker.sldPtrMB.appendChild(v.picker.sldPtrIB),v.picker.sldPtrIB.appendChild(v.picker.sldPtrS),v.picker.box.appendChild(v.picker.sldB),v.picker.box.appendChild(v.picker.sldM),v.picker.btn.appendChild(v.picker.btnT),v.picker.box.appendChild(v.picker.btn),v.picker.boxB.appendChild(v.picker.box),v.picker.wrap.appendChild(v.picker.boxS),v.picker.wrap.appendChild(v.picker.boxB));var e,t,n=v.picker,r=!!v.getSliderComponent(h),o=v.getPickerDims(h),i=2*h.pointerBorderWidth+h.pointerThickness+2*h.crossSize,s=v.getPadToSliderPadding(h),l=Math.min(h.borderRadius,Math.round(h.padding*Math.PI));n.wrap.style.clear="both",n.wrap.style.width=o[0]+2*h.borderWidth+"px",n.wrap.style.height=o[1]+2*h.borderWidth+"px",n.wrap.style.zIndex=h.zIndex,n.box.style.width=o[0]+"px",n.box.style.height=o[1]+"px",n.boxS.style.position="absolute",n.boxS.style.left="0",n.boxS.style.top="0",n.boxS.style.width="100%",n.boxS.style.height="100%",v.setBorderRadius(n.boxS,l+"px"),n.boxB.style.position="relative",n.boxB.style.border=h.borderWidth+"px solid",n.boxB.style.borderColor=h.borderColor,n.boxB.style.background=h.backgroundColor,v.setBorderRadius(n.boxB,l+"px"),n.padM.style.background=n.sldM.style.background="#FFF",v.setStyle(n.padM,"opacity","0"),v.setStyle(n.sldM,"opacity","0"),n.pad.style.position="relative",n.pad.style.width=h.width+"px",n.pad.style.height=h.height+"px",n.padPal.draw(h.width,h.height,v.getPadYComponent(h)),n.padB.style.position="absolute",n.padB.style.left=h.padding+"px",n.padB.style.top=h.padding+"px",n.padB.style.border=h.insetWidth+"px solid",n.padB.style.borderColor=h.insetColor,n.padM._jscInstance=h,n.padM._jscControlName="pad",n.padM.style.position="absolute",n.padM.style.left="0",n.padM.style.top="0",n.padM.style.width=h.padding+2*h.insetWidth+h.width+s/2+"px",n.padM.style.height=o[1]+"px",n.padM.style.cursor="crosshair",n.cross.style.position="absolute",n.cross.style.left=n.cross.style.top="0",n.cross.style.width=n.cross.style.height=i+"px",n.crossBY.style.position=n.crossBX.style.position="absolute",n.crossBY.style.background=n.crossBX.style.background=h.pointerBorderColor,n.crossBY.style.width=n.crossBX.style.height=2*h.pointerBorderWidth+h.pointerThickness+"px",n.crossBY.style.height=n.crossBX.style.width=i+"px",n.crossBY.style.left=n.crossBX.style.top=Math.floor(i/2)-Math.floor(h.pointerThickness/2)-h.pointerBorderWidth+"px",n.crossBY.style.top=n.crossBX.style.left="0",n.crossLY.style.position=n.crossLX.style.position="absolute",n.crossLY.style.background=n.crossLX.style.background=h.pointerColor,n.crossLY.style.height=n.crossLX.style.width=i-2*h.pointerBorderWidth+"px",n.crossLY.style.width=n.crossLX.style.height=h.pointerThickness+"px",n.crossLY.style.left=n.crossLX.style.top=Math.floor(i/2)-Math.floor(h.pointerThickness/2)+"px",n.crossLY.style.top=n.crossLX.style.left=h.pointerBorderWidth+"px",n.sld.style.overflow="hidden",n.sld.style.width=h.sliderSize+"px",n.sld.style.height=h.height+"px",n.sldGrad.draw(h.sliderSize,h.height,"#000","#000"),n.sldB.style.display=r?"block":"none",n.sldB.style.position="absolute",n.sldB.style.right=h.padding+"px",n.sldB.style.top=h.padding+"px",n.sldB.style.border=h.insetWidth+"px solid",n.sldB.style.borderColor=h.insetColor,n.sldM._jscInstance=h,n.sldM._jscControlName="sld",n.sldM.style.display=r?"block":"none",n.sldM.style.position="absolute",n.sldM.style.right="0",n.sldM.style.top="0",n.sldM.style.width=h.sliderSize+s/2+h.padding+2*h.insetWidth+"px",n.sldM.style.height=o[1]+"px",n.sldM.style.cursor="default",n.sldPtrIB.style.border=n.sldPtrOB.style.border=h.pointerBorderWidth+"px solid "+h.pointerBorderColor,n.sldPtrOB.style.position="absolute",n.sldPtrOB.style.left=-(2*h.pointerBorderWidth+h.pointerThickness)+"px",n.sldPtrOB.style.top="0",n.sldPtrMB.style.border=h.pointerThickness+"px solid "+h.pointerColor,n.sldPtrS.style.width=h.sliderSize+"px",n.sldPtrS.style.height=u+"px",n.btn.style.display=h.closable?"block":"none",n.btn.style.position="absolute",n.btn.style.left=h.padding+"px",n.btn.style.bottom=h.padding+"px",n.btn.style.padding="0 15px",n.btn.style.height=h.buttonHeight+"px",n.btn.style.border=h.insetWidth+"px solid",e=h.insetColor.split(/\s+/),t=e.length<2?e[0]:e[1]+" "+e[0]+" "+e[0]+" "+e[1],n.btn.style.borderColor=t,n.btn.style.color=h.buttonColor,n.btn.style.font="12px sans-serif",n.btn.style.textAlign="center";try{n.btn.style.cursor="pointer"}catch(e){n.btn.style.cursor="hand"}n.btn.onmousedown=function(){h.hide()},n.btnT.style.lineHeight=h.buttonHeight+"px",n.btnT.innerHTML="",n.btnT.appendChild(document.createTextNode(h.closeText)),a(),d(),v.picker.owner&&v.picker.owner!==h&&v.unsetClass(v.picker.owner.targetElement,h.activeClass),v.picker.owner=h,v.isElementType(p,"body")?v.redrawPosition():v._drawPosition(h,0,0,"relative",!1),n.wrap.parentNode!=p&&p.appendChild(n.wrap),v.setClass(h.targetElement,h.activeClass)}function a(){switch(v.getPadYComponent(h)){case"s":var e=1;break;case"v":e=2}var t=Math.round(h.hsv[0]/360*(h.width-1)),n=Math.round((1-h.hsv[e]/100)*(h.height-1)),r=2*h.pointerBorderWidth+h.pointerThickness+2*h.crossSize,o=-Math.floor(r/2);switch(v.picker.cross.style.left=t+o+"px",v.picker.cross.style.top=n+o+"px",v.getSliderComponent(h)){case"s":var i=c(h.hsv[0],100,h.hsv[2]),s=c(h.hsv[0],0,h.hsv[2]),l="rgb("+Math.round(i[0])+","+Math.round(i[1])+","+Math.round(i[2])+")",a="rgb("+Math.round(s[0])+","+Math.round(s[1])+","+Math.round(s[2])+")";v.picker.sldGrad.draw(h.sliderSize,h.height,l,a);break;case"v":var d=c(h.hsv[0],h.hsv[1],100);l="rgb("+Math.round(d[0])+","+Math.round(d[1])+","+Math.round(d[2])+")",a="#000";v.picker.sldGrad.draw(h.sliderSize,h.height,l,a)}}function d(){var e=v.getSliderComponent(h);if(e){switch(e){case"s":var t=1;break;case"v":t=2}var n=Math.round((1-h.hsv[t]/100)*(h.height-1));v.picker.sldPtrOB.style.top=n-(2*h.pointerBorderWidth+h.pointerThickness)-Math.floor(u/2)+"px"}}function o(){return v.picker&&v.picker.owner===h}if(this.hide=function(){o()&&(v.unsetClass(h.targetElement,h.activeClass),v.picker.wrap.parentNode.removeChild(v.picker.wrap),delete v.picker.owner)},this.show=function(){r()},this.redraw=function(){o()&&r()},this.importColor=function(){this.valueElement&&v.isElementType(this.valueElement,"input")?this.refine?!this.required&&/^\s*$/.test(this.valueElement.value)?(this.valueElement.value="",this.styleElement&&(this.styleElement.style.backgroundImage=this.styleElement._jscOrigStyle.backgroundImage,this.styleElement.style.backgroundColor=this.styleElement._jscOrigStyle.backgroundColor,this.styleElement.style.color=this.styleElement._jscOrigStyle.color),this.exportColor(v.leaveValue|v.leaveStyle)):this.fromString(this.valueElement.value)||this.exportColor():this.fromString(this.valueElement.value,v.leaveValue)||(this.styleElement&&(this.styleElement.style.backgroundImage=this.styleElement._jscOrigStyle.backgroundImage,this.styleElement.style.backgroundColor=this.styleElement._jscOrigStyle.backgroundColor,this.styleElement.style.color=this.styleElement._jscOrigStyle.color),this.exportColor(v.leaveValue|v.leaveStyle)):this.exportColor()},this.exportColor=function(e){if(!(e&v.leaveValue)&&this.valueElement){var t=this.toString();this.uppercase&&(t=t.toUpperCase()),this.hash&&(t="#"+t),v.isElementType(this.valueElement,"input")?this.valueElement.value=t:this.valueElement.innerHTML=t}if(!(e&v.leaveStyle)&&this.styleElement){var n="#"+this.toString(),r=this.isLight()?"#000":"#FFF";this.styleElement.style.backgroundImage="none",this.styleElement.style.backgroundColor=n,this.styleElement.style.color=r,this.overwriteImportant&&this.styleElement.setAttribute("style","background: "+n+" !important; color: "+r+" !important;")}e&v.leavePad||!o()||a(),e&v.leaveSld||!o()||d()},this.fromHSV=function(e,t,n,r){if(null!==e){if(isNaN(e))return!1;e=Math.max(0,Math.min(360,e))}if(null!==t){if(isNaN(t))return!1;t=Math.max(0,Math.min(100,this.maxS,t),this.minS)}if(null!==n){if(isNaN(n))return!1;n=Math.max(0,Math.min(100,this.maxV,n),this.minV)}this.rgb=c(null===e?this.hsv[0]:this.hsv[0]=e,null===t?this.hsv[1]:this.hsv[1]=t,null===n?this.hsv[2]:this.hsv[2]=n),this.exportColor(r)},this.fromRGB=function(e,t,n,r){if(null!==e){if(isNaN(e))return!1;e=Math.max(0,Math.min(255,e))}if(null!==t){if(isNaN(t))return!1;t=Math.max(0,Math.min(255,t))}if(null!==n){if(isNaN(n))return!1;n=Math.max(0,Math.min(255,n))}var o=function(e,t,n){e/=255,t/=255,n/=255;var r=Math.min(Math.min(e,t),n),o=Math.max(Math.max(e,t),n),i=o-r;if(0===i)return[null,0,100*o];var s=e===r?3+(n-t)/i:t===r?5+(e-n)/i:1+(t-e)/i;return[60*(6===s?0:s),i/o*100,100*o]}(null===e?this.rgb[0]:e,null===t?this.rgb[1]:t,null===n?this.rgb[2]:n);null!==o[0]&&(this.hsv[0]=Math.max(0,Math.min(360,o[0]))),0!==o[2]&&(this.hsv[1]=null===o[1]?null:Math.max(0,this.minS,Math.min(100,this.maxS,o[1]))),this.hsv[2]=null===o[2]?null:Math.max(0,this.minV,Math.min(100,this.maxV,o[2]));var i=c(this.hsv[0],this.hsv[1],this.hsv[2]);this.rgb[0]=i[0],this.rgb[1]=i[1],this.rgb[2]=i[2],this.exportColor(r)},this.fromString=function(e,t){var n;if(n=e.match(/^\W*([0-9A-F]{3}([0-9A-F]{3})?)\W*$/i))return 6===n[1].length?this.fromRGB(parseInt(n[1].substr(0,2),16),parseInt(n[1].substr(2,2),16),parseInt(n[1].substr(4,2),16),t):this.fromRGB(parseInt(n[1].charAt(0)+n[1].charAt(0),16),parseInt(n[1].charAt(1)+n[1].charAt(1),16),parseInt(n[1].charAt(2)+n[1].charAt(2),16),t),!0;if(n=e.match(/^\W*rgba?\(([^)]*)\)\W*$/i)){var r,o,i,s=n[1].split(","),l=/^\s*(\d*)(\.\d+)?\s*$/;if(3<=s.length&&(r=s[0].match(l))&&(o=s[1].match(l))&&(i=s[2].match(l))){var a=parseFloat((r[1]||"0")+(r[2]||"")),d=parseFloat((o[1]||"0")+(o[2]||"")),c=parseFloat((i[1]||"0")+(i[2]||""));return this.fromRGB(a,d,c,t),!0}}return!1},this.toString=function(){return(256|Math.round(this.rgb[0])).toString(16).substr(1)+(256|Math.round(this.rgb[1])).toString(16).substr(1)+(256|Math.round(this.rgb[2])).toString(16).substr(1)},this.toHEXString=function(){return"#"+this.toString().toUpperCase()},this.toRGBString=function(){return"rgb("+Math.round(this.rgb[0])+","+Math.round(this.rgb[1])+","+Math.round(this.rgb[2])+")"},this.isLight=function(){return 127.5<.213*this.rgb[0]+.715*this.rgb[1]+.072*this.rgb[2]},this._processParentElementsInDOM=function(){if(!this._linkedElementsProcessed){this._linkedElementsProcessed=!0;var e=this.targetElement;do{var t=v.getStyle(e);t&&"fixed"===t.position.toLowerCase()&&(this.fixed=!0),e!==this.targetElement&&(e._jscEventsAttached||(v.attachEvent(e,"scroll",v.onParentScroll),e._jscEventsAttached=!0))}while((e=e.parentNode)&&!v.isElementType(e,"body"))}},"string"==typeof e){var i=e,s=document.getElementById(i);s?this.targetElement=s:v.warn("Could not find target element with ID '"+i+"'")}else e?this.targetElement=e:v.warn("Invalid target element: '"+e+"'");if(this.targetElement._jscLinkedInstance)v.warn("Cannot link jscolor twice to the same element. Skipping.");else{(this.targetElement._jscLinkedInstance=this).valueElement=v.fetchElement(this.valueElement),this.styleElement=v.fetchElement(this.styleElement);var h=this,p=this.container?v.fetchElement(this.container):document.getElementsByTagName("body")[0],u=3;if(v.isElementType(this.targetElement,"button"))if(this.targetElement.onclick){var l=this.targetElement.onclick;this.targetElement.onclick=function(e){return l.call(this,e),!1}}else this.targetElement.onclick=function(){return!1};if(this.valueElement&&v.isElementType(this.valueElement,"input")){var m=function(){h.fromString(h.valueElement.value,v.leaveValue),v.dispatchFineChange(h)};v.attachEvent(this.valueElement,"keyup",m),v.attachEvent(this.valueElement,"input",m),v.attachEvent(this.valueElement,"blur",function(){h.importColor()}),this.valueElement.setAttribute("autocomplete","off")}this.styleElement&&(this.styleElement._jscOrigStyle={backgroundImage:this.styleElement.style.backgroundImage,backgroundColor:this.styleElement.style.backgroundColor,color:this.styleElement.style.color}),this.value?this.fromString(this.value)||this.exportColor():this.importColor()}}};return v.jscolor.lookupClass="jscolor",v.jscolor.installByClassName=function(e){var t=document.getElementsByTagName("input"),n=document.getElementsByTagName("button");v.tryInstallOnElements(t,e),v.tryInstallOnElements(n,e)},v.register(),v.jscolor}());