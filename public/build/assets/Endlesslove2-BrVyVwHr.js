import{A as v,S as V,a as B,s as F,e as h,d as _,o as w,f as k,B as d,C as g,E as A,j as y,p as G,v as C,F as I,y as H,b as O,G as E,g as S,l as R,H as z,I as D}from"./app-DX_VjkU8.js";import{a as J}from"./ably-WGFgY3Gw.js";function K(a){const s=a-1;return s*s*s+1}function L(a,{delay:s=0,duration:t=400,easing:e=K,x:r=0,y:o=0,opacity:i=0}={}){const l=getComputedStyle(a),n=+l.opacity,u=l.transform==="none"?"":l.transform,p=n*(1-i),[c,f]=v(r),[m,M]=v(o);return{delay:s,duration:t,easing:e,css:(b,T)=>`
			transform: ${u} translate(${(1-b)*c}${f}, ${(1-b)*m}${M});
			opacity: ${n-p*T}`}}function U(a,s,t){const e=a.slice();return e[8]=s[t],e[10]=t,e}function j(a){let s,t=[],e=new Map,r,o=C(a[2]);const i=l=>l[8].id;for(let l=0;l<o.length;l+=1){let n=U(a,o,l),u=i(n);e.set(u,t[l]=q(u,n))}return{c(){s=h("div");for(let l=0;l<t.length;l+=1)t[l].c();_(s,"class","grid grid-cols-3 gap-10 px-10 py-10")},m(l,n){k(l,s,n);for(let u=0;u<t.length;u+=1)t[u]&&t[u].m(s,null);r=!0},p(l,n){n&12&&(o=C(l[2]),I(),t=H(t,n,i,1,l,o,e,s,D,q,null,U),A())},i(l){if(!r){for(let n=0;n<o.length;n+=1)d(t[n]);r=!0}},o(l){for(let n=0;n<t.length;n+=1)g(t[n]);r=!1},d(l){l&&y(s);for(let n=0;n<t.length;n+=1)t[n].d()}}}function q(a,s){let t,e,r,o,i,l,n,u;function p(){return s[4](s[10])}return{key:a,first:null,c(){t=h("div"),e=h("img"),o=O(),E(e.src,r=s[8].url)||_(e,"src",r),_(e,"alt","Image"),_(e,"class","w-16"),this.first=t},m(c,f){k(c,t,f),S(t,e),S(t,o),l=!0,n||(u=R(e,"click",p),n=!0)},p(c,f){s=c,(!l||f&4&&!E(e.src,r=s[8].url))&&_(e,"src",r)},i(c){l||(i&&i.end(1),l=!0)},o(c){c&&(i=z(t,L,{y:-200,duration:500})),l=!1},d(c){c&&y(t),c&&i&&i.end(),n=!1,u()}}}function N(a){let s,t,e=a[0]&&j(a);return{c(){s=h("main"),e&&e.c(),_(s,"class","relative w-screen h-screen overflow-hidden flex justify-center items-center"),w(s,"background-color",a[1])},m(r,o){k(r,s,o),e&&e.m(s,null),t=!0},p(r,[o]){r[0]?e?(e.p(r,o),o&1&&d(e,1)):(e=j(r),e.c(),d(e,1),e.m(s,null)):e&&(I(),g(e,1,1,()=>{e=null}),A()),(!t||o&2)&&w(s,"background-color",r[1])},i(r){t||(d(e),t=!0)},o(r){g(e),t=!1},d(r){r&&y(s),e&&e.d()}}}function P(a,s,t){let e,r=0,o="#080101",i,l;G(()=>{i=new J.Realtime({authUrl:"/ablyauth"}),i.connection.once("connected",()=>{l=i.channels.get("get-started")}),t(0,e=!0)});let n=Array(15).fill(null).map((c,f)=>({id:f,url:"https://kolown.net/assets/gitm/heart.svg"}));async function u(c){r+=1,console.log("click:"+r),r===5&&(t(1,o="blue"),l.publish("state","state3")),r===10&&(t(1,o="green"),l.publish("state","state3")),r===15&&(t(1,o="red"),l.publish("state","state6"),setTimeout(()=>{i.connection.close(),t(1,o="#080101")},100)),t(2,n=n.filter((f,m)=>m!==c)),n.length===0&&t(0,e=!1),l.publish("endless","love")}return[e,o,n,u,c=>u(c)]}class X extends V{constructor(s){super(),B(this,s,P,N,F,{})}}export{X as default};
