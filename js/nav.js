let bars = document.querySelector('#bars');

$("#bars").click(function(){
    $(".nav").slideToggle("slow");
    if(bars.classList == 'fa-solid fa-bars'){
        bars.classList = 'fa-solid fa-xmark';
    }
    else{
        bars.classList = 'fa-solid fa-bars';
    }
    // console.log(bars.classList);
});

// bars.addEventListener('click', function(){
    
// });

