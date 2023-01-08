let btn = document.querySelector('#view_btn');

document.querySelector('.show_team_mate').style.display = 'none';
// document.querySelector('.show_team_mate').style.height = '0';
// document.querySelector('.show_team_mate').style.transition = 'all .5s ease .5s';

// btn.addEventListener('click', function(){
//     let team = document.querySelector('.show_team_mate');
//     if(team.style.display === 'none'){
//         team.style.display = 'block';
//         team.style.height = '100px';
//     }
//     else{
//         team.style.display = 'none';
//         team.style.height = '0';
//     }
// })

$("#view_btn").click(function(){
    $(".show_team_mate").slideToggle("slow");
  });