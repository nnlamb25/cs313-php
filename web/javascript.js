var slideIndex = 0;
var timeoutHandler;

function showSlides() 
{
    var slides = document.getElementsByClassName("-slideimg");
    slideIndex++;
    for (var i = 0; i < slides.length; i++) 
      {
          slides[i].style.display = "none"; 
      }

      if (slideIndex > slides.length) 
      {
          slideIndex = 1
      } 
      else if (slideIndex < 1) 
      {
          slideIndex = slides.length
      }

    slides[slideIndex-1].style.display = "block";

    timeoutHandler = setTimeout(showSlides, 5000);
}

function imageForward()
{
    clearTimeout(timeoutHandler);
    showSlides(slideIndex);
}

function imageBack()
{
    clearTimeout(timeoutHandler);
    slideIndex-= 2;
    showSlides(slideIndex);
}