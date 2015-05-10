function $(obj) {return (typeof obj == "object") ? obj:document.getElementById(obj);}
function tags(el,tag) {n = $(el); return n.getElementsByTagName(tag);}