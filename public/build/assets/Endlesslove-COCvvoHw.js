import{k as T,S as U,i as V,s as D,e as m,a as P,b as d,m as C,c as k,d as y,t as g,o as v,p as q,g as w,q as H,u as L,v as M,w as N,x as j,l as Y,y as z,z as A}from"./app-DoGiCMao.js";import{a as G}from"./ably-BgQAiiXj.js";function I(i){const e=i-1;return e*e*e+1}function J(i,{delay:e=0,duration:t=400,easing:r=I,x:o=0,y:a=0,opacity:s=0}={}){const n=getComputedStyle(i),l=+n.opacity,u=n.transform==="none"?"":n.transform,_=l*(1-s),[c,f]=T(o),[p,h]=T(a);return{delay:e,duration:t,easing:r,css:(b,O)=>`
			transform: ${u} translate(${(1-b)*c}${f}, ${(1-b)*p}${h});
			opacity: ${l-_*O}`}}function E(i,e,t){const r=i.slice();return r[8]=e[t],r[10]=t,r}function S(i){let e,t=[],r=new Map,o,a=L(i[2]);const s=n=>n[8].id;for(let n=0;n<a.length;n+=1){let l=E(i,a,n),u=s(l);r.set(u,t[n]=$(u,l))}return{c(){e=m("div");for(let n=0;n<t.length;n+=1)t[n].c();d(e,"class","grid grid-cols-3 gap-10 px-10 py-10")},m(n,l){k(n,e,l);for(let u=0;u<t.length;u+=1)t[u]&&t[u].m(e,null);o=!0},p(n,l){l&12&&(a=L(n[2]),M(),t=N(t,l,s,1,n,a,r,e,A,$,null,E),q())},i(n){if(!o){for(let l=0;l<a.length;l+=1)g(t[l]);o=!0}},o(n){for(let l=0;l<t.length;l+=1)v(t[l]);o=!1},d(n){n&&w(e);for(let l=0;l<t.length;l+=1)t[l].d()}}}function $(i,e){let t,r,o,a,s,n,l,u;function _(){return e[4](e[10])}return{key:i,first:null,c(){t=m("div"),r=m("img"),a=P(),j(r.src,o=e[8].url)||d(r,"src",o),d(r,"alt","Heart"),d(r,"class","w-16"),this.first=t},m(c,f){k(c,t,f),y(t,r),y(t,a),n=!0,l||(u=Y(r,"click",_),l=!0)},p(c,f){e=c,(!n||f&4&&!j(r.src,o=e[8].url))&&d(r,"src",o)},i(c){n||(s&&s.end(1),n=!0)},o(c){c&&(s=z(t,J,{y:-200,duration:500})),n=!1},d(c){c&&w(t),c&&s&&s.end(),l=!1,u()}}}function x(i){let e;return{c(){e=m("div"),e.innerHTML=`<div class="fixed bottom-3 text-center text-white font-mono"><p class="text-4xl">Thank you for participating.</p> <script>setTimeout(() => {
                        window.location.href = "https://instagram.com/kolown";
                    }, 3000);<\/script></div>`,d(e,"class","full-screen-bg svelte-17swels")},m(t,r){k(t,e,r)},d(t){t&&w(e)}}}function R(i){let e,t,r,o=i[0]&&S(i),a=!i[0]&&x();return{c(){e=m("main"),o&&o.c(),t=P(),a&&a.c(),d(e,"class","relative w-screen h-screen overflow-hidden flex justify-center items-center"),C(e,"background-color",i[1])},m(s,n){k(s,e,n),o&&o.m(e,null),y(e,t),a&&a.m(e,null),r=!0},p(s,[n]){s[0]?o?(o.p(s,n),n&1&&g(o,1)):(o=S(s),o.c(),g(o,1),o.m(e,t)):o&&(M(),v(o,1,1,()=>{o=null}),q()),s[0]?a&&(a.d(1),a=null):a||(a=x(),a.c(),a.m(e,null)),(!r||n&2)&&C(e,"background-color",s[1])},i(s){r||(g(o),r=!0)},o(s){v(o),r=!1},d(s){s&&w(e),o&&o.d(),a&&a.d()}}}async function B(){try{const i=await fetch("/api/updatelove",{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({})});if(!i.ok)throw new Error("Network response was not ok");const e=await i.json();console.log("Love count updated:",e)}catch(i){console.error("Error updating love count:",i)}}function F(i,e,t){let r=!0,o=0,a="#080101",s,n;H(()=>{let c="G-VP97YYDPP0";window.dataLayer=window.dataLayer||[];function f(...h){window.dataLayer.push(h)}f("js",new Date),f("config",c);const p=document.createElement("script");p.src=`https://www.googletagmanager.com/gtm.js?id=${c}`,document.head.append(p),s=new G.Realtime({authUrl:"/ablyauth"}),s.connection.once("connected",()=>{n=s.channels.get("get-started"),fetch("/api/kolown_bot")}),s.connection.on("failed",h=>{console.error("Connection failed:",h)}),t(0,r=!0),alert("click the hearts to interact with the installation")});let l=Array(10).fill(null).map((c,f)=>({id:f,url:"https://kolown.net/assets/gitm/heart.svg"}));async function u(c){o+=1,console.log("click:"+o),n.publish("endless","love"),t(2,l=l.filter((f,p)=>p!==c)),l.length===0&&(t(0,r=!1),setTimeout(()=>{s.connection.close(),B(),t(1,a="#080101")},100))}return[r,a,l,u,c=>u(c)]}class W extends U{constructor(e){super(),V(this,e,F,R,D,{})}}export{W as default};
