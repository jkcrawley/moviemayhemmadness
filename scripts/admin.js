//Add movie section

    //file upload preview

    const input = document.getElementById('imgupload');

    const previewPhoto = () => {
        const file = input.files;

        if(file){
            const fileReader = new FileReader();
            const preview = document.getElementById('file-preview');
            preview.style.display = 'inline-block';
            fileReader.onload = event => {
                preview.setAttribute('src', event.target.result);
            }
            fileReader.readAsDataURL(file[0]);
        }
    }

    input.addEventListener('change', previewPhoto);



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

function roleSelect(){
    const selectMenu = document.getElementById('role');
    let crewSection = document.querySelectorAll('.crewsection');
    
    for(let i = 0; i < crewSection.length; i++){
        crewSection[i].style.display = 'table-row';
    }; 

}



//array to be filled by which ever crew member the user decides to add.
let crewAdded = [];


//return results for crew member search
function searchRes(){

    let returnArr = [];
    let returnDis = [];

    for (i = 0; i < crewArr.length; i++){
        

        if(crewArr[i][1].indexOf(document.getElementById('crewname').value.toLowerCase()) !== -1){
            returnArr.push(crewArr[i][1]);

            let returnStyle = `<button type='button' id='crewbtn' onclick="addCrew('${crewArr[i][0]}', '${crewArr[i][1]}')">${crewArr[i][1]}</button>`;

            returnDis.push(returnStyle);

        }
        
    }
    
    if(document.getElementById('crewname').value === ''){
        returnDis = [];
    }

    document.getElementById('crewSearch').innerHTML = returnDis.join('<br />');
}




//add chosen crew members to new array by clicking their names
function addCrew(id, name){

    crewAdded.push([document.getElementById('role').value, id, name]);

    console.log(crewAdded);

    //reset form

    document.getElementById('role').value = '';
    document.getElementById('crewname').value = '';
    document.getElementById('crewSearch').innerHTML = '';
    document.querySelector('.crewsection').style.display = 'none';

    //display added crew
    const crewDisplay = document.querySelector('.crew-display');
    crewDisplay.style.display = 'block';

    let crewMember = '';
    let crewRole = '';

    //loop through crew array
    for (let i = 0; i < crewAdded.length; i++){
        
        //display crew lists

        
        crewMember = crewAdded[i][2];
        
        if(crewAdded[i][0] === 'director'){
            const dirList = document.querySelector('.directors');
            dirList.style.display = 'block';
            crewRole = 'directors-list';
        }

        if(crewAdded[i][0] === 'actor'){
            const dirList = document.querySelector('.actors');
            dirList.style.display = 'block';
            crewRole = 'actors-list';
        }
        
        if(crewAdded[i][0] === 'producer'){
            const dirList = document.querySelector('.producers');
            dirList.style.display = 'block';
            crewRole = 'producers-list';
        }

        if(crewAdded[i][0] === 'screenwriter'){
            const dirList = document.querySelector('.screenwriters');
            dirList.style.display = 'block';
            crewRole = 'screenwriters-list';
        }

    }

    //append list elements to be shown
    const node = document.createElement("li");
    const textNode = document.createTextNode(crewMember);
    node.appendChild(textNode);
    document.getElementById(crewRole).appendChild(node);
    
}

