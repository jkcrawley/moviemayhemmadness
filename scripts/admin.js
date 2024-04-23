//add crew member modal

function openModal(){
    const modalDis = document.getElementById('modal');
    if(modalDis.style.maxWidth = '0%'){
        modalDis.style.maxWidth = '80%';
        modalDis.style.maxHeight = '80%';
        modalDis.style.opacity = '1';
        document.querySelector('.overlay').style.display = 'block';
        document.getElementById('modalbtn').style.display = 'block';
    }
}

function closeModal(){
    const modalDis = document.getElementById('modal');
    const overlay = document.querySelector('.overlay');

    if(overlay.style.display = 'block'){
        overlay.style.display = 'none';
        modalDis.style.maxWidth = '0%';
        modalDis.style.maxHeight = '0%';
        modalDis.style.opacity = '0';
        document.getElementById('modalbtn').style.display = 'none';
    }
}