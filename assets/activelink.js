var link = window.location.pathname;
var linktag = document.querySelector("a[href='"+link+"']");
if(linktag !== null)
{
    linktag.classList.add("active","pe-none","border-bottom");
}