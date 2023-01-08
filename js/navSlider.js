let pageWidth = document.body.offsetWidth;
if(pageWidth < 992){
    let sideNav = document.querySelector('#sideNav');
    sideNav.style.display = 'none';
    // let arow = document.querySelector('#side_arow');
    
    // arow.addEventListener('click', function(){
    //     sideNav.style.marginLeft = '0px';
    // })

    $(document).ready(function(){
        $("#side_arow").click(function(){
            $("#sideNav").animate({
                width: "toggle"
            });
            
        });
    });

}


