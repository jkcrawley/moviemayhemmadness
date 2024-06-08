//profile drop-down

const closemenu = document.querySelector('.closemenu');
const dropmenu = document.getElementById('prof-menu');
const dropbtn = document.querySelector('.dropbtn');

function dropdown(){

    if(dropmenu.style.transform == 'scaleY(1)'){
        dropmenu.style.scale = '0';
        dropbtn.style.scale = '1';
        closemenu.style.display = 'none';
        
    } else {
        dropmenu.style.scale = '1';
        dropbtn.style.scale = '.9';
        closemenu.style.display = 'block';
    }
}

function closefunc(){

    if(closemenu.style.display == 'none'){
        closemenu.style.display = 'block';
        dropmenu.style.scale = '1';
        dropbtn.style.scale = '.9';
        
    } else {
        closemenu.style.display = 'none';
        dropmenu.style.scale = '0';
        dropbtn.style.scale = '1';
    }
}