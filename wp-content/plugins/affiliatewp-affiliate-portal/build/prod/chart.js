window.AFFWP=window.AFFWP||{},window.AFFWP.portal=window.AFFWP.portal||{},window.AFFWP.portal.chart=function(e){var r={};function t(n){if(r[n])return r[n].exports;var o=r[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,t),o.l=!0,o.exports}return t.m=e,t.c=r,t.d=function(e,r,n){t.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:n})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,r){if(1&r&&(e=t(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(t.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var o in e)t.d(n,o,function(r){return e[r]}.bind(null,o));return n},t.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(r,"a",r),r},t.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},t.p="",t(t.s=31)}({0:function(e,r){e.exports=window.regeneratorRuntime},2:function(e,r){function t(e,r,t,n,o,u,a){try{var i=e[u](a),c=i.value}catch(e){return void t(e)}i.done?r(c):Promise.resolve(c).then(n,o)}e.exports=function(e){return function(){var r=this,n=arguments;return new Promise((function(o,u){var a=e.apply(r,n);function i(e){t(a,o,u,i,c,"next",e)}function c(e){t(a,o,u,i,c,"throw",e)}i(void 0)}))}},e.exports.__esModule=!0,e.exports.default=e.exports},20:function(e,r){e.exports=window.AFFWP.portal.alpineChart},31:function(e,r,t){"use strict";t.r(r);var n=t(2),o=t.n(n),u=t(5),a=t.n(u),i=t(0),c=t.n(i),f=t(20),p=t.n(f),l=t(6);function s(e,r){var t=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);r&&(n=n.filter((function(r){return Object.getOwnPropertyDescriptor(e,r).enumerable}))),t.push.apply(t,n)}return t}function d(e){for(var r=1;r<arguments.length;r++){var t=null!=arguments[r]?arguments[r]:{};r%2?s(Object(t),!0).forEach((function(r){a()(e,r,t[r])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(t)):s(Object(t)).forEach((function(r){Object.defineProperty(e,r,Object.getOwnPropertyDescriptor(t,r))}))}return e}r.default=function(e){var r=d(d({},p.a),e);return r.fetchPortalData=function(){var e=o()(c.a.mark((function e(r){var t=this;return c.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.abrupt("return",new Promise(function(){var e=o()(c.a.mark((function e(n,o){var u;return c.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,Object(l.portalSchemaRows)(t.type,{range:r});case 2:u=e.sent,t.label=u.x_label_key,n(u.rows.map((function(e){return{label:e.title,borderColor:e.color,data:e.data,borderWidth:3,backgroundColor:"transparent"}})));case 5:case"end":return e.stop()}}),e)})));return function(r,t){return e.apply(this,arguments)}}()));case 1:case"end":return e.stop()}}),e)})));return function(r){return e.apply(this,arguments)}}(),r}},5:function(e,r){e.exports=function(e,r,t){return r in e?Object.defineProperty(e,r,{value:t,enumerable:!0,configurable:!0,writable:!0}):e[r]=t,e},e.exports.__esModule=!0,e.exports.default=e.exports},6:function(e,r){e.exports=window.AFFWP.portal.sdk}});