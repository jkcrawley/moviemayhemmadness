//Add movie section

    //file upload preview
    let input = '';

    if(document.getElementById('imgupload')){
        input = document.getElementById('imgupload');
    

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
    }


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

    if(selectMenu.value == 'actor'){
        document.querySelector('.character').style.display = 'table-row';
        document.getElementById('actor').innerHTML = 'Played By: '
    }  else if(selectMenu.value == 'director'){
        document.querySelector('.character').style.display = 'none';
        document.getElementById('actor').innerHTML = 'Directed By: '
    } else if(selectMenu.value == 'producer'){
        document.querySelector('.character').style.display = 'none';
        document.getElementById('actor').innerHTML = 'Produced By: '
    } else if(selectMenu.value == 'screenwriter'){
        document.querySelector('.character').style.display = 'none';
        document.getElementById('actor').innerHTML = 'Written By: '
    }

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
    let crewChar = document.getElementById('character').value;
    const movieid = document.getElementById('movieid').value;

    //add new items to object.
    if(crewRole != ''){
    crewObj.push({"mc_movie": movieid, "mc_crew": id, "mc_role": crewRole, "mc_character": crewChar});
    }



    //Check if directors have been added to javascript object
    let directorsArr = crewObj.filter(artist => artist.mc_role == 'director');

    //compare filtered directors array to JSON crew object
    const dirResults = crew.filter((el) => {
        return directorsArr.some((f) => {
            return f.mc_crew === el.cr_id;
        });
    });
    
    //If there is more than one entry with the role of 'director', then display all directors.
    if(dirResults.length > 0){
        document.querySelector('.directors').style.display = 'block';
        let disDirectors = [];

        for(let i = 0; i < dirResults.length; i++){
            disDirectors.push(`<li>${dirResults[i].cr_fname} ${dirResults[i].cr_lname}</li>`);
        }
        document.getElementById('directors-list').innerHTML = disDirectors.join(' ');
        
    }





    //Repeat process with actors
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

    //Repeat process with producers
    const prodsArr = crewObj.filter(artist => artist.mc_role == 'producer');

    const prodResults = crew.filter((el) => {
        return prodsArr.some((f) => {
            return f.mc_crew === el.cr_id;
        });
    });
    
    if(prodResults.length > 0){
        document.querySelector('.producers').style.display = 'block';
        let disProducers = [];
        console.log(crewObj);
        for(let i = 0; i < prodResults.length; i++){
            disProducers.push(`<li>${prodResults[i].cr_fname} ${prodResults[i].cr_lname}</li>`);
        }
        document.getElementById('producers-list').innerHTML = disProducers.join(' ');
        
    }

    //Repeat process with screenwriters
    const swArr = crewObj.filter(artist => artist.mc_role == 'screenwriter');

    const swResults = crew.filter((el) => {
        return swArr.some((f) => {
            return f.mc_crew === el.cr_id;
        });
    });
    
    if(swResults.length > 0){
        document.querySelector('.screenwriters').style.display = 'block';
        let disScreenwriters = [];
        console.log(crewObj);
        for(let i = 0; i < swResults.length; i++){
            disScreenwriters.push(`<li>${swResults[i].cr_fname} ${swResults[i].cr_lname}</li>`);
        }
        document.getElementById('screenwriters-list').innerHTML = disScreenwriters.join(' ');
        
    }

    console.log(crewObj);
    //reset inputs and displayed data
    crewRole = '';
    document.getElementById('crewSearch').innerHTML = '';
    document.getElementById('crewname').value = '';
    document.getElementById('role').value = '';
    document.getElementById('character').value = '';
    document.querySelector('.crewsection').style.display = 'none';

    document.querySelector('.character').style.display = 'none';
    //console.log(crewObj);
    fetch("../json/javascript-json.php", {
        "method": "POST",
        "headers": {
            "Content-Type": "application/json; charset=utf-8"
        },
        "body": JSON.stringify(crewObj)
    }).then(function(response){
        return response.text();
    }).then(function(data){
        console.log(data);
    }) 
 
}

  
