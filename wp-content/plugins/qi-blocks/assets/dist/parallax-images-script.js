!function(){"use strict";document.addEventListener("DOMContentLoaded",(function(){t.init()}));const t={init:function(){this.holder=document.querySelectorAll(".qi-block-parallax-images"),this.holder.length&&[...this.holder].map((e=>{t.initItem(e)}))},getRealCurrentItem:function(t){return"string"==typeof t&&""!==t&&(t=qiBlocksEditor.qodefGetCurrentBlockElement.get(t)),t},initItem:function(e){if(!(e=t.getRealCurrentItem(e)))return;("object"!=typeof qiBlocksEditor?qiBlocks:qiBlocksEditor).qodefWaitForImages.check(e,(function(){t.setParallaxElements(e)}))},setParallaxElements:function(t){const e=t.querySelectorAll(".qodef-e-parallax-image"),a=t.querySelector(".qodef-e-main-image");if(!a)return;const n=a.querySelector("img"),r=a.getAttribute("data-parallax-main");let i=40,l=-50,o=30,s=15;window.innerWidth>1024&&(r&&(i=r,o=Math.abs(parseInt(i,10)/.9)),n.setAttribute("data-parallax",'{"y" : '+i+' , "smoothness": '+o+"}"),e.forEach((t=>{const e=t.querySelector("img"),a=t.getAttribute("data-parallax");e&&(a&&(l=a,s=Math.abs(parseInt(l,10)/2.5)),e.setAttribute("data-parallax",'{"y" : '+l+' , "smoothness": '+s+"}"))})),setTimeout((()=>{t.querySelectorAll("[data-parallax]").length&&ParallaxScroll.init()}),document.body.classList.contains("wp-admin")?600:0))}}}();