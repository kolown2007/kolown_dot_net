import{S as x,i as _,s as S,e as u,a as b,b as a,c as j,d as i,f as v,l as w,n as y,g as k,r as C,q as $,h as E,j as T}from"./app-CPsLQVNl.js";import{a as q}from"./ably-CbuUW7j5.js";import{u as D}from"./useForm-Dou8zvfH.js";function F(c){let s,p,t,m,r,o,e,f,l,n,h;return{c(){s=u("main"),p=u("div"),t=u("h1"),t.textContent=`KoloWn App ${c[1]}`,m=b(),r=u("div"),o=u("div"),e=u("input"),f=b(),l=u("button"),l.textContent="Send",a(e,"id","sms"),a(e,"type","string"),a(e,"placeholder","Type a message"),a(e,"class","w-full max-w-96 px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-red-500"),a(l,"id","send-button"),a(l,"class","bg-red-500 text-white px-4 py-2 rounded-r-md hover:bg-red-400 transition duration-300"),a(o,"class","p-4 flex"),a(r,"class","h-screen flex flex-col justify-center"),a(s,"class","h-screen flex flex-col justify-between items-center px-4 py-4 bg-black text-red-900 font-mono")},m(d,g){j(d,s,g),i(s,p),i(p,t),i(s,m),i(s,r),i(r,o),i(o,e),v(e,c[0].sms),i(o,f),i(o,l),n||(h=[w(e,"input",c[4]),w(l,"click",c[3])],n=!0)},p(d,[g]){g&1&&v(e,d[0].sms)},i:y,o:y,d(d){d&&k(s),n=!1,C(h)}}}function M(c,s,p){let t,m=new Date().getFullYear(),r,o;$(()=>{r=new q.Realtime({authUrl:"/ablyauth"}),r.connection.once("connected",()=>{o=r.channels.get("ghostwriter")})});let e=D({sms:""});E(c,e,n=>p(0,t=n));async function f(){o.publish("message",t.sms),console.log(t.sms);try{const n=await fetch("/api/ghostwritermessage",{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({content:t.sms})});if(!n.ok)throw new Error("Network response was not ok");const h=await n.json();console.log("Message saved to database",h)}catch(n){console.error("Error saving message:",n)}T(e,t.sms="",t)}function l(){t.sms=this.value,e.set(t)}return[t,m,e,f,l]}class J extends x{constructor(s){super(),_(this,s,M,F,S,{})}}export{J as default};
