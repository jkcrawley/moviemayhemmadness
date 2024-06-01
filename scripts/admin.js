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



function movieRes(){
    let buttonArr = [];
    for(let i = 0; i < movies.length; i++){
        if(movies[i].m_title.toLowerCase().indexOf(document.getElementById('searchmovie').value.toLowerCase()) !== -1){
            
            
            let movieBtn = `<button name='moviebtn' type='button' id='addmovie' onclick="addMovie('${movies[i].m_id}', '${movies[i].m_title}', '${movies[i].m_title}', '${movies[i].m_release}')" style='margin-bottom: 18px;'  value='${movies[i].m_id}'> ${movies[i].m_title} (${movies[i].m_release.slice(0, 4)}) </button>`;
            buttonArr.push(movieBtn);
        }
    }

    if(document.getElementById('searchmovie').value === ''){
        buttonArr = [];
    }

    document.getElementById('movielist').innerHTML = buttonArr.join('<br />');

}



function addMovie(id, arrName, disName, year){
    document.querySelector('.movierow').style.display = 'none';
    document.querySelector('.moviedisplay').style.display = 'none';
    document.querySelector('.roleselect').style.display = 'table-row';

    //create form input to submit movie id
    const movieid = `<input type='hidden' name='movieid' id='movieid' value='${id}' />`;

    document.getElementById('movieinput').innerHTML = movieid;

    //display movie section
    const crewDisplay = document.querySelector('.crew-display');
    crewDisplay.style.display = 'block';
    document.getElementById('movietitle').innerHTML = `${disName} (${year.slice(0,4)})`;
}

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




//return results for crew member search
function searchRes(){
    let returnDis = [];
    let crewName = [];

    for (let i = 0; i < crew.length; i++){
        crewName.push(crew[i].cr_fname + ' ' + crew[i].cr_lname);

        
            

            if(crewName[i].toLowerCase().indexOf(document.getElementById('crewname').value.toLowerCase()) !== -1){

                let returnStyle = `<button type='button' name='addcrew' id='crewbtn' onclick="addCrew('${crew[i].cr_id}', '${crewName[i]}')">${crewName[i]}</button>`;
    
                returnDis.push(returnStyle);
    
            }
        

        
        
    }
    
    if(document.getElementById('crewname').value === ''){
        returnDis = [];
    }

    document.getElementById('crewSearch').innerHTML = returnDis.join('<br />');
}



function addCrew(id, name){
    let crewRole = document.getElementById('role').value;
    const movieid = document.getElementById('movieid').value;

    //add new items to object
    crewObj.push({mc_movie: movieid, mc_crew: id, mc_role: crewRole});

    //check if directors have been added
    let directorsArr = crewObj.filter(artist => artist.mc_role == 'director');

    const dirResults = crew.filter((el) => {
        return directorsArr.some((f) => {
            return f.mc_crew === el.cr_id;
        });
    });
    
    if(dirResults.length > 0){
        document.querySelector('.directors').style.display = 'block';
        let disDirectors = [];

        for(let i = 0; i < dirResults.length; i++){
            disDirectors.push(`<li>${dirResults[i].cr_fname} ${dirResults[i].cr_lname}</li>`);
        }
        document.getElementById('directors-list').innerHTML = disDirectors.join(' ');
        
    }

    //check if actors have been added
    const actorsArr = crewObj.filter(artist => artist.mc_role == 'actor');

    const actResults = crew.filter((el) => {
        return actorsArr.some((f) => {
            return f.mc_crew === el.cr_id;
        });
    });
    
    if(actResults.length > 0){
        document.querySelector('.actors').style.display = 'block';
        let disActors = [];
        console.log(crewObj);
        for(let i = 0; i < actResults.length; i++){
            disActors.push(`<li>${actResults[i].cr_fname} ${actResults[i].cr_lname}</li>`);
        }
        document.getElementById('actors-list').innerHTML = disActors.join(' ');
        
    }
    console.log(crewObj);

    crewRole = '';
    document.getElementById('crewSearch').innerHTML = '';
    document.getElementById('crewname').value = '';
    document.getElementById('role').value = '';
}


