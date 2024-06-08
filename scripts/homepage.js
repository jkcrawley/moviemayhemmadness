

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

