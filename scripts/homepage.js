

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



function dropdown(){
    const dropmenu = document.getElementById('prof-menu');
    const dropbtn = document.querySelector('.dropbtn');

    if(dropmenu.style.scale == '1'){
        dropmenu.style.scale = '0';
        dropbtn.style.scale = '1';
        dropbtn.style.backgroundColor = '#aa0000';
        
    } else {
        dropmenu.style.scale = '1';
        dropbtn.style.scale = '.9';
        dropbtn.style.backgroundColor = '#990000';
    }
}