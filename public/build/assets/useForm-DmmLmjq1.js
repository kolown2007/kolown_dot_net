import{D as a,v as h,w as E,x as p}from"./app-DD_hUmKF.js";function m(...i){const l=typeof i[0]=="string"?i[0]:null,f=(typeof i[0]=="string"?i[1]:i[0])||{},u=l?a.restore(l):null;let n=h(f),c=null,g=null,d=e=>e;const S=E({...u?u.data:f,isDirty:!1,errors:u?u.errors:{},hasErrors:!1,progress:null,wasSuccessful:!1,recentlySuccessful:!1,processing:!1,setStore(e,s){S.update(r=>Object.assign(r,typeof e=="string"?{[e]:s}:e))},data(){return Object.keys(f).reduce((e,s)=>(e[s]=this[s],e),{})},transform(e){return d=e,this},defaults(e,s){return typeof e>"u"?(n=Object.assign(n,h(this.data())),this):(n=Object.assign(n,h(s?{[e]:s}:e)),this)},reset(...e){let s=h(n);return e.length===0?this.setStore(s):this.setStore(Object.keys(s).filter(r=>e.includes(r)).reduce((r,o)=>(r[o]=s[o],r),{})),this},setError(e,s){return this.setStore("errors",{...this.errors,...s?{[e]:s}:e}),this},clearErrors(...e){return this.setStore("errors",Object.keys(this.errors).reduce((s,r)=>({...s,...e.length>0&&!e.includes(r)?{[r]:this.errors[r]}:{}}),{})),this},submit(e,s,r={}){const o=d(this.data()),b={...r,onCancelToken:t=>{if(c=t,r.onCancelToken)return r.onCancelToken(t)},onBefore:t=>{if(this.setStore("wasSuccessful",!1),this.setStore("recentlySuccessful",!1),clearTimeout(g),r.onBefore)return r.onBefore(t)},onStart:t=>{if(this.setStore("processing",!0),r.onStart)return r.onStart(t)},onProgress:t=>{if(this.setStore("progress",t),r.onProgress)return r.onProgress(t)},onSuccess:async t=>{if(this.setStore("processing",!1),this.setStore("progress",null),this.clearErrors(),this.setStore("wasSuccessful",!0),this.setStore("recentlySuccessful",!0),g=setTimeout(()=>this.setStore("recentlySuccessful",!1),2e3),r.onSuccess)return r.onSuccess(t)},onError:t=>{if(this.setStore("processing",!1),this.setStore("progress",null),this.clearErrors().setError(t),r.onError)return r.onError(t)},onCancel:()=>{if(this.setStore("processing",!1),this.setStore("progress",null),r.onCancel)return r.onCancel()},onFinish:()=>{if(this.setStore("processing",!1),this.setStore("progress",null),c=null,r.onFinish)return r.onFinish()}};e==="delete"?a.delete(s,{...b,data:o}):a[e](s,o,b)},get(e,s){this.submit("get",e,s)},post(e,s){this.submit("post",e,s)},put(e,s){this.submit("put",e,s)},patch(e,s){this.submit("patch",e,s)},delete(e,s){this.submit("delete",e,s)},cancel(){c&&c.cancel()}});return S.subscribe(e=>{e.isDirty===p(e.data(),n)&&e.setStore("isDirty",!e.isDirty);const s=Object.keys(e.errors).length>0;e.hasErrors!==s&&e.setStore("hasErrors",!e.hasErrors),l&&a.remember({data:e.data(),errors:e.errors},l)}),S}export{m as u};
