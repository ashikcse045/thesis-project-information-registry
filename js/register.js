const actualBtn = document.getElementById('file');

const fileChosen = document.getElementById('file-chosen');

actualBtn.addEventListener('change', function(){
  fileChosen.textContent = this.files[0].name
  // let fileNumber = this.files.length;
  // fileChosen.textContent = fileNumber + ' files choosen';
})
