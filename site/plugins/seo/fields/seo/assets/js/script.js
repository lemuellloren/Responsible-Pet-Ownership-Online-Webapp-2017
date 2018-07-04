!function($){"use strict";var e,t="",n=[],i="";$.fn.seo=function(){return this.each(function(){var e=$(this),t="seo";if(e.data("seo"))return!0;e.data("seo",!0),$.fn.controller(),$.fn.loadData(),$.fn.updateData(),$.fn.actions(),$.fn.preview("title"),$.fn.preview("description"),$.fn.emptyDescription(),$.fn.countTitle(),$.fn.countDescription()})},$.fn.actions=function(){$(".seo").on("click",".seo-wrap-title",function(){$.fn.toggle("title")}),$(".seo").on("click",".seo-wrap-description",function(){$.fn.toggle("description"),$(".seo-input-description").trigger("autosize.resize")}),$(".seo-input-title, .seo-input-description").on("keyup keypress",function(){$.fn.updateData(),$.fn.renderValue(),$.fn.preview("title"),$.fn.preview("description"),$.fn.emptyDescription(),$.fn.countTitle(),$.fn.countDescription()}),$(document).keyup(function(e){27==e.keyCode&&($(".seo-input-title").is(":focus")||$(".seo-input-description").is(":focus"))&&$.fn.close()})},$.fn.emptyDescription=function(){""==$(".seo-input-description").val()?$(".seo").attr("data-seo-description-empty",!0):$(".seo").removeAttr("data-seo-description-empty")},$.fn.preview=function(t){var i="";n[t]?i=n[t]:e[t].fallback&&(i=e[t].fallback),i=$.fn.replaceValues(i);var o=e[t].prefix?e[t].prefix:"",s=e[t].suffix?e[t].suffix:"",r=o+i+s;"description"==t&&(r=$.fn.sliceDescription(r)),r=$.fn.escapeTags(r),$(".seo-view-"+t).html(r)},$.fn.replaceValues=function(t){return e.values&&t&&$.each(e.values,function(e,n){var i="{{"+e+"}}",o=new RegExp(i,"g");t=t.replace(o,n)}),t},$.fn.controller=function(){var t=$(".seo").attr("data-seo-controller");e=jQuery.parseJSON(t)},$.fn.toggle=function(e){var t=$(".seo").attr("data-"+e+"-active");$.fn.close(),"true"==t?$(".seo").removeAttr("data-"+e+"-active"):$(".seo").attr("data-"+e+"-active",!0)},$.fn.close=function(){$(".seo").removeAttr("data-title-active"),$(".seo").removeAttr("data-description-active")},$.fn.renderValue=function(){var e="";e='  -\n  seo-title: "'+$.fn.escapeDoubleQuotes(n.title)+'"\n',e+='  seo-description: "'+$.fn.escapeDoubleQuotes(n.description)+'"',$(".seo-render").val(e)},$.fn.loadData=function(){$(".seo-input-title").val(e.title.field),$(".seo-input-description").val(e.description.field)},$.fn.updateData=function(){n.title=$.fn.sanitize($(".seo-input-title").val()),n.description=$.fn.sanitize($(".seo-input-description").val())},$.fn.sanitize=function(e){return e=e.replace(/(\r\n|\n|\r)/gm," "),e=e.replace(/\s\s+/g," ")},$.fn.sliceDescription=function(t){var n=t.slice(0,e.description.limit);return t=t==n?t:n+"..."},$.fn.escapeDoubleQuotes=function(e){return e.replace(/\"/g,'\\"')},$.fn.escapeTags=function(e){return e=e.replace(/\</g,"&lt;"),e=e.replace(/\>/g,"&gt;")},$.fn.countTitle=function(){var e=$(".seo-view-title");e[0]?($(".seo-title-count").html(e[0].scrollWidth+"/512"),e.outerWidth()<e[0].scrollWidth||0==e.text().length?$(".seo-title-count").addClass("seo-warning"):$(".seo-title-count").removeClass("seo-warning")):($(".seo-title-count").html("0/512"),$(".seo-title-count").addClass("seo-warning"))},$.fn.countDescription=function(){var t=0;n.description.length>0&&(t=n.description.length+e.description.prefix.length+e.description.suffix.length),$(".seo-description .seo-count").html(t+"/"+e.description.limit),n.description.length>e.description.limit||0==n.description.length?$(".seo-description .seo-count").addClass("seo-warning"):$(".seo-description .seo-count").removeClass("seo-warning")}}(jQuery);