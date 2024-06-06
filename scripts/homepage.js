

const discoverSect = document.querySelector('.hidden');

const options = {
    root: null,
    threshold: 0,
    rootMargin: "-300px"
};

const observer = new IntersectionObserver(function(entries, observer){
    entries.forEach(entry => {
        console.log(entry.target);
        if(entry.isIntersecting){
            entry.target.classList.add('show');
        } else {
            entry.target.classList.remove('show');
        }
    })
}, options);

observer.observe(discoverSect);

//image slider

let counter = 1;



setInterval(()=>{
    document.querySelector('.movies.showimg').classList.remove('showimg');
    const img = document.querySelector(`.movie${counter}`);
    img.classList.add('showimg');
    counter++;

    if(counter > 5){
        counter = 1;
    }
}, 2000)

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